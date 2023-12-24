<?php

namespace App\Http\Controllers\User\Customer;

use App\Http\Controllers\Controller;
use App\Models\Bidding;
use App\Models\BikeBrand;
use App\Models\BikeModel;
use App\Models\Division;
use App\Models\PassengerCount;
use App\Models\ProductTag;
use App\Models\TripInfo;
use App\Models\TruckType;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Rakibhstu\Banglanumber\NumberToBangla;

class CustomerTripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $divisions = Division::all();
        $pageTitle = 'TripList';
        $user = auth()->user();


        $all_trips =  TripInfo::query()
            ->with(['vehicle', 'customer'])
            ->withCount('bids')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        $current_trips =  TripInfo::query()
            ->with(['vehicle', 'customer'])
            ->withCount('bids')
            ->where('user_id', $user->id)
            ->where('starting_date', '>', Carbon::yesterday())
            ->where('starting_date', '<', Carbon::tomorrow())
            ->latest()
            ->paginate(10);

        $pending_trips =  TripInfo::query()
            ->with(['vehicle', 'customer'])
            ->withCount('bids')
            ->where('user_id', $user->id)
            ->where('starting_date', '>=', Carbon::tomorrow())
            ->latest()
            ->paginate(10);


        $trip_history =  TripInfo::query()
            ->with(['vehicle', 'customer'])
            ->withCount('bids')
            ->where('user_id', $user->id)
            ->where('starting_date', '<', Carbon::today())
            ->latest()
            ->paginate(10);


        return view('frontend.user.customer.customer_trip.index', compact('pageTitle', 'all_trips', 'current_trips', 'pending_trips', 'trip_history', 'divisions'));
    }

    public function createStepOne(Request $request)
    {

        $pageTitle = 'Trip Create';
        $vehicle_id = $request->get('vehicle_id') ?? 1;

        // $request->session()->forget('trip');

        $trip = $request->session()->get('trip');

        $upazilas = Upazila::all();
        $trucks = TruckType::all();
        $product_tags = ProductTag::all();
        $passenger_count = PassengerCount::query();

        $vehicle = Vehicle::find($vehicle_id)->name;

        if ($vehicle_id == 1) {

            return view('frontend.user.customer.customer_trip.create_truck', compact('vehicle_id', 'pageTitle', 'upazilas', 'trucks', 'product_tags', 'trip', 'vehicle'));
        } else if ($vehicle_id == 5) {
            $bikeBrands = BikeBrand::all();
            $bikeModels = BikeModel::all();
            return view('frontend.user.customer.customer_trip.create_motorcycle', compact('vehicle_id', 'pageTitle', 'upazilas', 'trucks', 'product_tags', 'trip', 'vehicle', 'bikeBrands', 'bikeModels'));
        } else {
            if ($vehicle_id == 3) {
                $passenger_count = $passenger_count->where('is_bus', 0)->get()->take(13)->filter(function ($post, $key) {
                    return $key > 4;
                });;
            } else {
                if ($vehicle_id == 10) {
                    $passenger_count = $passenger_count->where('is_bus', 1)->get();
                } else {
                    $passenger_count = $passenger_count->where('is_bus', 0)->get()->take(($vehicle_id == 2 || $vehicle_id == 9) ? 6 : ($vehicle_id == 8 ? 8 : 4));
                }
            }

            return view('frontend.user.customer.customer_trip.create', compact('vehicle_id', 'pageTitle', 'upazilas', 'trucks', 'product_tags', 'trip', 'passenger_count', 'vehicle'));
        }
    }


    public function postCreateStepOne(Request $request)
    {
        $validatedData = $request->validate([
            'vehicle_id' => 'nullable',
            'start_location' => 'required',
            'end_location' => 'required',
            'receiver_mobile' => 'required',
            'starting_date' => 'required',
            'starting_time' => 'required',
            'feet' => 'nullable',
            'ton' => 'required',
            'truck_type' => 'required',
            'product_description' => 'required',
            'second_load' => 'required',
            'third_load' => 'nullable',
            'second_load_location' => 'required_if:second_load,1',
            'second_provider_mobile' => 'required_if:second_load,1',
            'second_unload_location' => 'required_if:second_load,1',
            'second_receiver_mobile' => 'required_if:second_load,1',
            'third_load_location' => 'required_if:third_load,1',
            'third_provider_mobile' => 'required_if:third_load,1',
            'third_unload_location' => 'required_if:third_load,1',
            'third_receiver_mobile' => 'required_if:third_load,1',
            'product_tags' => 'nullable'
        ], [
            'second_load_location.required_if' => 'The :attribute field is required.',
            'second_provider_mobile.required_if' => 'The :attribute field is required.',
            'second_unload_location.required_if' => 'The :attribute field is required.',
            'second_receiver_mobile.required_if' => 'The :attribute field is required.',
            'third_load_location.required_if' => 'The :attribute field is required.',
            'third_provider_mobile.required_if' => 'The :attribute field is required.',
            'third_unload_location.required_if' => 'The :attribute field is required.',
            'third_receiver_mobile.required_if' => 'The :attribute field is required.',
        ]);

        $trip = new TripInfo();
        $trip->fill($validatedData);
        $request->session()->put('trip', $trip);

        return redirect()->route('user.trip-info.create-step-two');
    }


    public function createStepTwo(Request $request)
    {
        // dd($request);
        $pageTitle = 'ConfirmTripInfo';

        $trip = $request->session()->get('trip');

        if (empty($trip)) {
            return redirect()->route('user.trip-info.index');
        }

        if ($trip->third_load == 0) {
            $trip->third_load_location = null;
            $trip->third_unload_location = null;
            $trip->third_provider_mobile = null;
            $trip->third_receiver_mobile = null;
        }
        // dd($trip);
        return view('frontend.user.customer.customer_trip.confirm-trip-info', compact('pageTitle', 'trip'));
    }

    public function postCreateStepTwo(Request $request)
    {
        $trip = $request->session()->get('trip');

        // dd($request->all());
        if ($trip) {
            if ($trip->second_load == 0) {
                $trip->second_load_location = null;
                $trip->second_unload_location = null;
                $trip->second_provider_mobile = null;
                $trip->second_receiver_mobile = null;
                $trip->third_load = 0;
                $trip->third_load_location = null;
                $trip->third_unload_location = null;
                $trip->third_provider_mobile = null;
                $trip->third_receiver_mobile = null;
            }
            $trip->user_id = auth()->user()->id;
            if (is_array($trip->product_tags) && count($trip->product_tags) > 0) {
                $trip->product_tags = implode(",", $trip->product_tags);
            } else {
                $trip->product_tags = null;
            }
            // $trip->starting_date = Carbon::createFromFormat('d/m/Y', $trip->starting_date)->format('Y-m-d');

            $trip->starting_time = date('h:ia', strtotime($trip->starting_time));
            // dd($trip);
            $trip->save();
            $request->session()->forget('trip');
        } else {

            $validatedData = $request->validate([
                'vehicle_id' => 'required',
                'start_location' => 'required_if:vehicle_id,1,2,3,4,5,6,7,8,9,10',
                'end_location' => 'required_if:vehicle_id,1,2,3,4,5,6,7,8,9,10',
                'starting_date' => 'required_if:vehicle_id,1,2,3,4,5,6,7,8,9,10',
                'starting_time' => 'required_if:vehicle_id,1,2,3,4,5,6,7,8,9,10',
                'passenger_count' => 'required_unless:vehicle_id,1,4,5,7',
                'trip_type' => 'required_unless:vehicle_id,1,7|required_if:without_driver,0',
                'ac_type' => 'required_if:vehicle_id,2,3,10',
                'rent_description' => 'required_if:vehicle_id,7',
                'patient_type' => 'required_if:vehicle_id,4',
                'life_support_type' => 'nullable',
                // 'life_support_type' => 'required_if:vehicle_id,4',
                'duration_month' => 'nullable',
                'duration_day' => 'nullable',
                'duration_hour' => 'nullable',
                'without_driver' => 'nullable',
                // 'customer_full_name' => 'required_if:without_driver,1',
                // 'customer_address' => 'required_if:without_driver,1',
                // 'customer_nid_no' => 'required_if:without_driver,1',
                // 'customer_nid_image_front' => 'required_if:without_driver,1|image|mimes:jpg,png,jpeg,webp',
                // 'customer_nid_image_back' => 'required_if:without_driver,1|image|mimes:jpg,png,jpeg,webp',
                // 'customer_driving_license_image_front' => 'required_if:without_driver,1|image|mimes:jpg,png,jpeg,webp',
                // 'customer_driving_license_image_back' => 'required_if:without_driver,1|image|mimes:jpg,png,jpeg,webp',
                // 'parent_name' => 'required_if:without_driver,1',
                // 'parent_mobile' => 'required_if:without_driver,1',
                // 'parent_nid_no' => 'required_if:without_driver,1',
                // 'parent_nid_image_front' => 'required_if:without_driver,1|image|mimes:jpg,png,jpeg,webp',
                // 'parent_nid_image_back' => 'required_if:without_driver,1|image|mimes:jpg,png,jpeg,webp',
            ]);


            // $validatedData['starting_date'] = Carbon::createFromFormat('d/m/Y', $validatedData['starting_date'])
            //     ->format('Y-m-d');
            // $validatedData['starting_time'] = Carbon::createFromFormat('H:i a', $validatedData['starting_time'])
            //     ->format('H:i:s');


            // if ($request->without_driver) {
            //     if ($request->hasFile('customer_nid_image_front')) {
            //         $customer_nid_image_front = time() . '.' . $request->customer_nid_image_front->extension();
            //         $request->customer_nid_image_front->move(public_path('backend/images/trip-info'), $customer_nid_image_front);
            //         $validatedData['customer_nid_image_front'] = 'backend/images/trip-info/' . $customer_nid_image_front;
            //     }

            //     if ($request->hasFile('customer_nid_image_front')) {
            //         $customer_nid_image_back = time() . '.' . $request->customer_nid_image_back->extension();
            //         $request->customer_nid_image_back->move(public_path('backend/images/trip-info'), $customer_nid_image_back);
            //         $validatedData['customer_nid_image_back'] = 'backend/images/trip-info/' . $customer_nid_image_back;
            //     }

            //     if ($request->hasFile('customer_nid_image_front')) {
            //         $customer_driving_license_image_front = time() . '.' . $request->customer_driving_license_image_front->extension();
            //         $request->customer_driving_license_image_front->move(public_path('backend/images/trip-info'), $customer_driving_license_image_front);
            //         $validatedData['customer_driving_license_image_front'] = 'backend/images/trip-info/' . $customer_driving_license_image_front;
            //     }


            //     if ($request->hasFile('customer_nid_image_front')) {

            //         $customer_driving_license_image_back = time() . '.' . $request->customer_driving_license_image_back->extension();
            //         $request->customer_driving_license_image_back->move(public_path('backend/images/trip-info'), $customer_driving_license_image_back);
            //         $validatedData['customer_driving_license_image_back'] = 'backend/images/trip-info/' . $customer_driving_license_image_back;
            //     }


            //     if ($request->hasFile('customer_nid_image_front')) {

            //         $parent_nid_image_front = time() . '.' . $request->parent_nid_image_front->extension();
            //         $request->parent_nid_image_front->move(public_path('backend/images/trip-info'), $parent_nid_image_front);
            //         $validatedData['parent_nid_image_front'] = 'backend/images/trip-info/' . $parent_nid_image_front;
            //     }



            //     if ($request->hasFile('customer_nid_image_front')) {

            //         $parent_nid_image_back = time() . '.' . $request->parent_nid_image_back->extension();
            //         $request->parent_nid_image_back->move(public_path('backend/images/trip-info'), $parent_nid_image_back);
            //         $validatedData['parent_nid_image_back'] = 'backend/images/trip-info/' . $parent_nid_image_back;
            //     }
            // }

            $trip = new TripInfo();
            $trip->fill($validatedData);
            $trip->user_id = auth()->user()->id;

            $trip->save();
        }
        $notify[] = ['success', 'Trip created successfully!'];
        return redirect()->route('user.trip-info.index')->withNotify($notify);
    }

    //bike brand when without driver
    public function postCreateStepTwoBikeBrand(Request $request)
    {
        // dd($request);

            $validatedData = $request->validate([
                'bike_brand_id' => 'required',
                'bike_model_id' => 'nullable',
                'vehicle_id' => 'required',
                'start_location' => 'required',
                'end_location' => 'required',
                'starting_date' => 'required',
                'starting_time' => 'required',
                'duration_month' => 'nullable',
                'duration_day' => 'nullable|required_without:duration_hour,without_driver',
                'duration_hour' => 'nullable|required_without:duration_day,without_driver',
                'without_driver' => 'nullable|required_without:duration_day,duration_hour',
                'customer_full_name' => 'required',
                'customer_address' => 'required',
                'customer_nid_no' => 'required',
                'customer_nid_image_front' => 'required|image|mimes:jpg,png,jpeg,webp',
                'customer_nid_image_back' => 'required|image|mimes:jpg,png,jpeg,webp',
                'customer_driving_license_image_front' => 'required|image|mimes:jpg,png,jpeg,webp',
                'customer_driving_license_image_back' => 'required|image|mimes:jpg,png,jpeg,webp',
                'parent_name' => 'required',
                'parent_mobile' => 'required',
                'parent_nid_no' => 'required',
                'parent_nid_image_front' => 'required|image|mimes:jpg,png,jpeg,webp',
                'parent_nid_image_back' => 'required|image|mimes:jpg,png,jpeg,webp',
            ]);


            if ($request->without_driver) {
                if ($request->hasFile('customer_nid_image_front')) {
                    $customer_nid_image_front = time() . '.' . $request->customer_nid_image_front->extension();
                    $request->customer_nid_image_front->move(public_path('backend/images/trip-info'), $customer_nid_image_front);
                    $validatedData['customer_nid_image_front'] = 'backend/images/trip-info/' . $customer_nid_image_front;
                }

                if ($request->hasFile('customer_nid_image_front')) {
                    $customer_nid_image_back = time() . '.' . $request->customer_nid_image_back->extension();
                    $request->customer_nid_image_back->move(public_path('backend/images/trip-info'), $customer_nid_image_back);
                    $validatedData['customer_nid_image_back'] = 'backend/images/trip-info/' . $customer_nid_image_back;
                }

                if ($request->hasFile('customer_nid_image_front')) {
                    $customer_driving_license_image_front = time() . '.' . $request->customer_driving_license_image_front->extension();
                    $request->customer_driving_license_image_front->move(public_path('backend/images/trip-info'), $customer_driving_license_image_front);
                    $validatedData['customer_driving_license_image_front'] = 'backend/images/trip-info/' . $customer_driving_license_image_front;
                }


                if ($request->hasFile('customer_nid_image_front')) {

                    $customer_driving_license_image_back = time() . '.' . $request->customer_driving_license_image_back->extension();
                    $request->customer_driving_license_image_back->move(public_path('backend/images/trip-info'), $customer_driving_license_image_back);
                    $validatedData['customer_driving_license_image_back'] = 'backend/images/trip-info/' . $customer_driving_license_image_back;
                }


                if ($request->hasFile('customer_nid_image_front')) {

                    $parent_nid_image_front = time() . '.' . $request->parent_nid_image_front->extension();
                    $request->parent_nid_image_front->move(public_path('backend/images/trip-info'), $parent_nid_image_front);
                    $validatedData['parent_nid_image_front'] = 'backend/images/trip-info/' . $parent_nid_image_front;
                }

                if ($request->hasFile('customer_nid_image_front')) {

                    $parent_nid_image_back = time() . '.' . $request->parent_nid_image_back->extension();
                    $request->parent_nid_image_back->move(public_path('backend/images/trip-info'), $parent_nid_image_back);
                    $validatedData['parent_nid_image_back'] = 'backend/images/trip-info/' . $parent_nid_image_back;
                }
                $trip = new TripInfo();
                $trip->fill($validatedData);
                $trip->user_id = auth()->user()->id;
                // dd($trip);
                $trip->save();
                $notify[] = ['success', 'Trip created successfully!'];
                return redirect()->route('user.trip-info.index')->withNotify($notify);
            }else{
                $notify[] = ['error', 'There is an Error please try again!'];
                return redirect()->back()->withNotify($notify);
            }



    }

    public function show($id)
    {
        $pageTitle = 'TripShow';
        $trip = TripInfo::with('vehicle')->find($id);
        if ($trip->status == 'ordered') {
            $biddings = Bidding::where('trip_id', $id)->where('status', 0)->where('status', '!=', 2)->get();
            // dd($biddings);
        } else {
            $biddings = Bidding::where('trip_id', $id)->where('status', 1)->get();
            // dd($biddings);
        }
        // dd($biddings);
        return view('frontend.user.customer.customer_trip.show', compact('pageTitle', 'trip', 'biddings'));
    }


    public function acceptBid($trip_id, $bidding_id)
    {
        $trip = TripInfo::find($trip_id);
        $trip->update([
            'status' => 'in-progress'
        ]);

        $bidding = Bidding::find($bidding_id);

        $bidding->update([
            'status' => 1
        ]);
        // dd($bidding->customerMobile->mobile);
        $url = env('url');
        $api_key = env('api_key');
        $senderid = env('senderid');
        // if bidding has reffered service provider
        if ($bidding->reffered_service_provider) {
            $decodedData = json_decode($bidding->reffered_service_provider, true);
            $mobileNumber = preg_replace('/[^0-9]/', '', $decodedData['driver_mobile']);

            // Check if the number starts with +88
            if (strpos($mobileNumber, '+88') === 0) {
                // If it starts with +88, format it as 0-11 digits
                $formattedNumber = '0' . substr($mobileNumber, 3);
            } elseif ($mobileNumber[0] !== '0') {
                // If the first digit is not 0, add 0 at the beginning
                $formattedNumber = '0' . $mobileNumber;
            } else {
                // Otherwise, keep the number as it is
                $formattedNumber = $mobileNumber;
            }

            $number = $formattedNumber;
            // $number='01750025266';
            $message = "Dear Referred Service Provider \n Your bid has been Approved.\n";
            $message .= "Trip Date: " . $trip->starting_date . "\n";
            $message .= "Start Location: " . $trip->start_location . "\n";
            $message .= "End Location: " . $trip->end_location . "\n";
            $message .= "Customer Mobile Number: " . $bidding->customerMobile->mobile . "\n";
            $message .= "Amount: " . $bidding->bid_amount;
            $data = [
                "api_key" => $api_key,
                "senderid" => $senderid,
                "number" => $number,
                "message" => $message
            ];
            // Rest of your code remains the same
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            curl_close($ch);
            $notify[] = ['success', 'Bid Accepted successfully!'];
            return redirect()->route('user.trip-info.show', $trip_id)->withNotify($notify);
        } else {
            # code...
            $provider = User::find($bidding->provider_id);

            //sms
            $number = $provider->mobile;
            // $number='01750025266';
            $message = "Dear Service Provider \n Your bid has been Approved.\n";
            $message .= "Trip Date: " . $trip->starting_date . "\n";
            $message .= "Start Location: " . $trip->start_location . "\n";
            $message .= "End Location: " . $trip->end_location . "\n";
            $message .= "Amount: " . $bidding->bid_amount;
            $data = [
                "api_key" => $api_key,
                "senderid" => $senderid,
                "number" => $number,
                "message" => $message
            ];
            // Rest of your code remains the same
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            curl_close($ch);
            $notify[] = ['success', 'Bid Accepted successfully!'];
            return redirect()->route('user.trip-info.show', $trip_id)->withNotify($notify);
        }
    }

    public function rejectBid($trip_id, $bidding_id)
    {

        Bidding::find($bidding_id)->update([
            'status' => 2
        ]);
        $notify[] = ['success', 'Bid Rejected successfully!'];

        return redirect()->route('user.trip-info.show', $trip_id)->withNotify($notify);
    }

    public function allBid()
    {
        $pageTitle = 'TripShow';
        $bangla = new NumberToBangla();

        // $trip = TripInfo::where('user_id', auth()->user()->id)->whereHas('bids');
        $truck = $bangla->bnNum(TripInfo::where('user_id', auth()->user()->id)->whereHas('bids')->where('vehicle_id', 1)->count());
        $car = $bangla->bnNum(TripInfo::where('user_id', auth()->user()->id)->whereHas('bids')->where('vehicle_id', 2)->count());
        $micro = $bangla->bnNum(TripInfo::where('user_id', auth()->user()->id)->whereHas('bids')->where('vehicle_id', 3)->count());
        $ambulance = $bangla->bnNum(TripInfo::where('user_id', auth()->user()->id)->whereHas('bids')->where('vehicle_id', 4)->count());
        $motorcycle = $bangla->bnNum(TripInfo::where('user_id', auth()->user()->id)->whereHas('bids')->where('vehicle_id', 5)->count());
        $cng = $bangla->bnNum(TripInfo::where('user_id', auth()->user()->id)->whereHas('bids')->where('vehicle_id', 6)->count());
        $van = $bangla->bnNum(TripInfo::where('user_id', auth()->user()->id)->whereHas('bids')->where('vehicle_id', 7)->count());
        $mahindra = $bangla->bnNum(TripInfo::where('user_id', auth()->user()->id)->whereHas('bids')->where('vehicle_id', 8)->count());
        $easy_bike = $bangla->bnNum(TripInfo::where('user_id', auth()->user()->id)->whereHas('bids')->where('vehicle_id', 9)->count());
        $bus = $bangla->bnNum(TripInfo::where('user_id', auth()->user()->id)->whereHas('bids')->where('vehicle_id', 10)->count());

        return view('frontend.user.customer.all_bid', compact('pageTitle', 'truck', 'car', 'micro', 'ambulance', 'motorcycle', 'cng', 'van', 'mahindra', 'easy_bike', 'bus'));
    }

    public function seeBidding($vehicle_id)
    {
        $pageTitle = 'Driver Bidding';

        $user = auth()->user();
        $vehicle = Vehicle::find($vehicle_id)->name;
        $vehicleTypes = Vehicle::all();

        $all_bids = Bidding::with('trip', 'trip.provider')->where('customer_id', auth()->id())->join('trip_infos', 'biddings.trip_id', '=', 'trip_infos.id')->where('trip_infos.vehicle_id', $vehicle_id)->select('trip_infos.*', 'biddings.*')->orderBy('biddings.created_at')->get();
        return view('frontend.user.customer.see_bidding', compact('pageTitle', 'vehicleTypes', 'all_bids'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
