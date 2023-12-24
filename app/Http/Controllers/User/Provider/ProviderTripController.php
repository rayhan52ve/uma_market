<?php

namespace App\Http\Controllers\User\Provider;

use App\Http\Controllers\Controller;
use App\Models\Bidding;
use App\Models\BikeBrand;
use App\Models\Category;
use App\Models\GeneralSetting;
use App\Models\Service;
use App\Models\TripInfo;
use App\Models\TruckType;
use App\Models\UserDetail;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use Illuminate\Support\Facades\Auth;

class ProviderTripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pageTitle = 'Trip List';
        $vehicle_id = $request->vehicle_id ?? 1;
        $vehicle = Vehicle::find($vehicle_id)->name;

        $upazilas = Upazila::all();
        $truck_types = TruckType::all();
        // $trips = TripInfo::with('customer', 'vehicle')->where('vehicle_id', $vehicle_id)->get();
        return view('frontend.user.provider.trip.index', compact('pageTitle', 'vehicle_id', 'upazilas', 'truck_types', 'vehicle'));
    }

    public function searchTrip(Request $request)
    {
        $load_location = !empty($request->load_location) ? $request->load_location : '';
        $unload_location = !empty($request->unload_location) ? $request->unload_location : '';
        $truck_type = !empty($request->truck_type) ? $request->truck_type : '';
        $biddings = Bidding::where('provider_id', $request->provider_id)->pluck('trip_id');
        // $trips=BikeBrand::where('id',$request->bike_brand_id)->pluck('name');

        $trips = TripInfo::with('customer', 'vehicle', 'bikeBrand', 'bikeModel', 'truck')
            ->where('vehicle_id', $request->vehicle_id)
            ->where('status', 'ordered')
            ->whereNotIn('id', $biddings);
        if ($load_location != '') {
            $trips->where('start_location', $load_location);
        }
        if ($unload_location != '') {
            $trips->where('end_location', $unload_location);
        }
        if ($truck_type != '') {
            $trips->where('truck_type', $truck_type);
        }
        $trips = $trips->orderBy('created_at', 'desc') // Order by created_at in descending order (latest first)
            ->get();
        $data = [
            'data' => $trips,
            'status' => 'ok',
            'code' => 200
        ];
        // dd($data);
        return response()->json($data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pageTitle = "TripDetails";
        $trip = TripInfo::find($id);
        // dd($trip);
        $bid = Bidding::with('provider')->where('trip_id', $id)->where('provider_id', auth()->user()->id)->first();
        return view('frontend.user.provider.trip.show', compact('trip', 'pageTitle', 'bid'));
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


    public function confirm_bid($id)
    {
        $pageTitle = "ConfirmTrip";
        $trip = TripInfo::with('vehicle')->find($id);
        $generalSetting = GeneralSetting::first();
        return view('frontend.user.provider.trip.trip_confirm', compact('pageTitle', 'trip', 'generalSetting'));
    }

    public function bidding(Request $request, $id)
    {
        // dd($id);
        $customer = TripInfo::with('vehicle')->find($id);
        $providerName = Auth::user();
        $bid = new Bidding();
        $bid->trip_id = $id;
        // dd($customer);
        $bid->customer_id = $customer->user_id;

        $bid->provider_id = auth()->user()->id;
        $bid->bid_amount = $request->bid_amount;

        $pendingService = Service::where([['vehicle', $customer->vehicle->name], ['user_id', auth()->id()]])->where('admin_approval', 0)
            ->get();

        // dd($vehicle_id);
        if ($request->confirm_bid == 2) {

            $validdata = $request->validate([
                'driver_name' => 'required',
                'driver_mobile' => 'required',
                'serial_prefix' => 'required',
                'serial_number' => 'required',
            ]);
            $bid->reffered_service_provider = json_encode($validdata);
            // dd($bid);
            // $bid->save();

            //sms congigurtion start
            $url = env('url');
            $api_key = env('api_key');
            $senderid = env('senderid');
            $number = $request->driver_mobile;
            $message = "Dear" . ' ' . $request->driver_name . ' ' . "You have been referred a trip on behalf of" . ' ' . $providerName->fname . ' ' . "\n\nRegards,\n" . '' . "Umamarket";

            $data = [
                "api_key" => $api_key,
                "senderid" => $senderid,
                "number" => $number,
                "message" => $message
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            curl_close($ch);
            //sms configuration end
            // dd($bid);
            // dd( $bid);
            $bid->save();

            $notify[] = ['success', 'Successfully Bid The Trip'];
            return redirect('user/provider-trip?vehicle_id=' . $customer->vehicle->id)->withNotify($notify);
        } else {
            $vehicle_id = $customer->vehicle->id;
            $service = Service::where([['vehicle', $customer->vehicle->name], ['user_id', auth()->id()]])->where('admin_approval', 1)
                // ->first();
                ->get();

            $without_driver = $customer->without_driver;
            if ($vehicle_id == 5 && $without_driver == 1) {
                $matched_brand = $service->where('bike_brand_id', $customer->bike_brand_id);
                $matched_model = $matched_brand->where('bike_model_id', $customer->bike_model_id);

                // ($service->bike_brand_id == $customer->bike_brand_id) || ($service->bike_model_id == $customer->bike_model_id)
                if (count($matched_brand) > 0) {

                    // $customer has a non-null bike_model_id and matched service provider bike brand id
                    if (($customer->bike_model_id !== null) && count($matched_model) > 0) {
                        // create bid
                        if (count($service) > 0) {
                            $isTripAvailable = Bidding::where('provider_id', auth()->user()->id)->where('status', 1)
                                ->whereRelation('trip', 'starting_date', $customer->starting_date)
                                ->whereRelation('trip', 'vehicle_id', $vehicle_id)
                                ->first();
                            if ($isTripAvailable) {
                                if ($vehicle_id != $isTripAvailable->trip->vehicle_id) {
                                    $bid->save();
                                    $notify[] = ['success', 'Successfully Bid The Trip'];
                                    return redirect()->route('user.provider-trip.index')->withNotify($notify);
                                } else {
                                    $notify[] = ['error', 'You Already Have A Trip On This Date'];
                                    return redirect()->back()->withNotify($notify);
                                }
                            } else {
                                $bid->save();
                                $notify[] = ['success', 'Successfully Bid The Trip'];
                                return redirect()->route('user.provider-trip.index')->withNotify($notify);
                            }
                        } else {
                            $notify[] = ['error', 'You dont have an approved service yet,Create one or wait for approval.'];
                            return redirect()->route('user.service.create', $customer->vehicle->id)->withNotify($notify);
                        }
                    } elseif (($customer->bike_model_id == null)) {
                        // $customer does not have a bike_model_id then create the bid
                        if (count($service) > 0) {
                            $isTripAvailable = Bidding::where('provider_id', auth()->user()->id)->where('status', 1)
                                ->whereRelation('trip', 'starting_date', $customer->starting_date)
                                ->whereRelation('trip', 'vehicle_id', $vehicle_id)
                                ->first();

                            if ($isTripAvailable) {
                                if ($vehicle_id != $isTripAvailable->trip->vehicle_id) {
                                    $bid->save();
                                    $notify[] = ['success', 'Successfully Bid The Trip'];
                                    return redirect()->route('user.provider-trip.index')->withNotify($notify);
                                } else {

                                    $notify[] = ['error', 'You Already Have A Trip On This Date'];
                                    return redirect()->back()->withNotify($notify);
                                }
                            } else {
                                $bid->save();
                                $notify[] = ['success', 'Successfully Bid The Trip'];
                                return redirect()->route('user.provider-trip.index')->withNotify($notify);
                            }
                        } else {
                            $notify[] = ['error', 'You dont have an approved service yet,Create one or wait for approval.'];
                            return redirect()->route('user.service.create', $customer->vehicle->id)->withNotify($notify);
                        }
                    } else {
                        $notify[] = ['error', 'You dont have Approve Same Model Bike Service Yet,Create one or wait for approval.'];
                        return redirect()->route('user.service.create', $customer->vehicle->id)->withNotify($notify);
                        // dd($matched_brand, $matched_model);
                    }
                } else {
                    $notify[] = ['error', 'You dont have Approve Same Brand Bike Service Yet,Create one or wait for approval.'];
                    return redirect()->route('user.service.create', $customer->vehicle->id)->withNotify($notify);
                }
            } else {
                if (count($service) > 0) {
                    $isTripAvailable = Bidding::where('provider_id', auth()->user()->id)->where('status', 1)
                        ->whereRelation('trip', 'starting_date', $customer->starting_date)
                        ->whereRelation('trip', 'vehicle_id', $vehicle_id)
                        ->first();

                    if ($isTripAvailable) {
                        if ($vehicle_id != $isTripAvailable->trip->vehicle_id) {
                            $bid->save();
                            $notify[] = ['success', 'Successfully Bid The Trip'];
                            return redirect()->route('user.provider-trip.index')->withNotify($notify);
                        } else {
                            $notify[] = ['error', 'You Already Have A Trip On This Date'];
                            return redirect()->back()->withNotify($notify);
                        }
                    } else {
                        $bid->save();
                        $notify[] = ['success', 'Successfully Bid The Trip'];
                        return redirect()->route('user.provider-trip.index')->withNotify($notify);
                    }
                } elseif (count($pendingService) > 0) {
                    $notify[] = ['error', 'Your service han not been approved yet,please wait for approval.'];
                    return redirect()->route('user.service')->withNotify($notify);
                } else {
                    $notify[] = ['error', 'You dont have an approved service yet,Create one or wait for approval.'];
                    return redirect()->route('user.service.create', $customer->vehicle->id)->withNotify($notify);
                }
            }
        }
    }

    public function payment(Request $request, $id)
    {
        $user = Auth::user();
        $tirpInfo = Bidding::where('trip_id', $id)->first();

        $baseURL = 'https://pay.umamarket.com/';
        $apiKEY = '9b60646bfe3fd38ad354b7d6bdbf6c6aed3543a0';
        $fields = [
            'full_name'     => $user->fname,
            'email'         => $user->email ? $user->email : 'test@gmail.com',
            'amount'        => $request->pay_amount,
            'metadata'      => [
                'user_id'   => $user->id,
                'order_id'  => $tirpInfo->trip_id,
                'bidding_id' => $tirpInfo->id
            ],
            // 'redirect_url'  => 'http://umamarket.com/',
            'redirect_url'  => Route('user.verify_payment'),

            'cancel_url'    => 'http://umamarket.com/',
            'webhook_url'   => 'http://umamarket.com/'
        ];

        // Store 'order_id' and 'bidding_id' in the session
       session()->put('verify', ['trip_id' => $tirpInfo->trip_id, 'bidding_id' => $tirpInfo->id]);
        // uddoktapay v1
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $baseURL . "api/checkout",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($fields),
            CURLOPT_HTTPHEADER => [
                "RT-UDDOKTAPAY-API-KEY: " . $apiKEY,
                "accept: application/json",
                "content-type: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $responseDetail = json_decode($response);
        $urlLink =  $responseDetail->payment_url;
        return redirect($urlLink);
    }
}
