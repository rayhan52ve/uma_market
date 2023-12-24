<?php

namespace App\Http\Controllers;

use App\Models\BikeBrand;
use App\Models\BikeModel;
use App\Models\Category;
use App\Models\Schedule;
use App\Models\Service;
use App\Models\TruckType;
use App\Models\UserDetail;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Purifier;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use Illuminate\Support\Facades\Auth;

class ServiceProviderController extends Controller
{
    public function index(Request $request)
    {
        // dd($request);
        $pageTitle = 'All Services';
        $user = Auth::user();
        $userDetails = UserDetail::where('user_id', $user->id)->get();
        $search = $request->search;
        $services = Service::where('user_id', auth()->id())->with('bikeBrand', 'bikeModel')
        ->latest()
        ->paginate();
        return view('frontend.user.provider.index', compact('pageTitle', 'services', 'userDetails'));
    }

    public function createService($vehicle_id)
    {
        // dd($vehicle_id);
        $pageTitle = "Service Create";
        $vehicle = Vehicle::find($vehicle_id);
        $upazilas = Upazila::all();
        $truck_types = TruckType::all();
        $bikeBrands = BikeBrand::all();
        $bikeModels = BikeModel::all();
        $user = auth()->user();
        $user_details = UserDetail::where('user_id', auth()->id())->first();
        $categories = Category::where('status', 1)->latest()->get();
        $driver_lisence_check = UserDetail::where('user_id', auth()->id())->where('provider_type', 'মালিক')->first();
        return view('frontend.user.provider.service_create', compact('pageTitle', 'bikeBrands', 'bikeModels', 'categories', 'vehicle', 'upazilas', 'truck_types', 'user', 'user_details','driver_lisence_check'));
    }

    public function storeService(Request $request)
    {
        // dd($request);
        $request->validate([
            'vehicle' => 'required',
            'location' => 'required',
            'owner_mobile' => 'required',
            'service_image' => 'required|image|mimes:jpg,jpeg,png,webp',
            'car_gallery_image.*' => 'image|mimes:jpg,png,jpeg,webp',

            'provider_type' => 'required',
            'nid_no' => 'required',
            'company_address' => 'required',
        ]);

        $user_details = UserDetail::where('user_id', auth()->id())->first();
        $createUserDetail = new UserDetail;

        if ($request->provider_type == 'ড্রাইভার') {
            // if ($user_details->driving_license_front == '' || $user_details->driving_license_back == '') {
            $request->validate([
                'driving_license_front' => 'required|image|mimes:jpg,png,jpeg',
                'driving_license_back' => 'required|image|mimes:jpg,png,jpeg'
            ]);
            // }

            if ($request->hasFile('driving_license_front')) {
                $filename = uploadImage($request->driving_license_front, filePath('user_details'), $request->driving_license_front);
                $createUserDetail->driving_license_front = $filename;
            }

            if ($request->hasFile('driving_license_back')) {
                $filename = uploadImage($request->driving_license_back, filePath('user_details'), $request->driving_license_back);
                $createUserDetail->driving_license_back = $filename;
            }


            $createUserDetail->user_id = auth()->user()->id;
            $createUserDetail->provider_type = $request->provider_type;
            $createUserDetail->company_name = $request->company_name;
            $createUserDetail->company_address = $request->company_address;
            $createUserDetail->nid_no = $request->nid_no;
            $createUserDetail->driving_experience = $request->driving_experience;
            // $createUserDetail->driving_license_front = $request->driving_license_front ?? '';
            // $createUserDetail->driving_license_back = $request->driving_license_back ?? '';
            $createUserDetail->save();
        }

        if ($request->provider_type == 'মালিক') {
            $user_details->provider_type = $request->provider_type;
            $user_details->company_name = $request->company_name;
            $user_details->company_address = $request->company_address;
            $user_details->nid_no = $request->nid_no;
            $user_details->driving_experience = $request->driving_experience;

            if ($request->hasFile('driving_license_front')) {
                $filename = uploadImage($request->driving_license_front, filePath('user_details'), $request->driving_license_front);
                $user_details->driving_license_front = $filename;
            }

            if ($request->hasFile('driving_license_back')) {
                $filename = uploadImage($request->driving_license_back, filePath('user_details'), $request->driving_license_back);
                $user_details->driving_license_back = $filename;
            }

            $user_details->save();
        }

        switch ($request->vehicle) {
            case 'ট্রাক':
                $request->validate([
                    'truck_type' => 'required',
                    'ton_capacity' => 'required',
                    'serial_prefix' => 'required',
                    'serial_number' => 'required',
                    'car_model' => 'required',
                    'car_plate_image' => 'required|image|mimes:jpg,jpeg,png,webp',
                    'brta_front' => 'required|image|mimes:jpg,jpeg,png,webp',
                    'brta_back' => 'required|image|mimes:jpg,jpeg,png,webp',
                ]);
                break;

            case 'প্রাইভেট কার':
            case 'মাইক্রো':
            case 'বাস':
                $request->validate([
                    'vehicle_seat' => 'required',
                    'serial_prefix' => 'required',
                    'serial_number' => 'required',
                    'car_model' => 'required',
                    'car_plate_image' => 'required|image|mimes:jpg,jpeg,png,webp',
                    'brta_front' => 'required|image|mimes:jpg,jpeg,png,webp',
                    'brta_back' => 'required|image|mimes:jpg,jpeg,png,webp',
                ]);
                break;

            case 'এম্বুল্যান্স':
                $request->validate([
                    'serial_prefix' => 'required',
                    'serial_number' => 'required',
                    'car_plate_image' => 'required|image|mimes:jpg,jpeg,png,webp',
                    'brta_front' => 'required|image|mimes:jpg,jpeg,png,webp',
                    'brta_back' => 'required|image|mimes:jpg,jpeg,png,webp',
                ]);
                break;

            case 'মোটরসাইকেল':
                $request->validate([
                    'bike_brand_id' => 'required',
                    'bike_model_id' => 'nullable',
                    'bike_oil' => 'required',
                    'serial_prefix' => 'required',
                    'serial_number' => 'required',
                    // 'car_model' => 'required',
                    'car_plate_image' => 'required|image|mimes:jpg,jpeg,png,webp',
                    'brta_front' => 'required|image|mimes:jpg,jpeg,png,webp',
                    'brta_back' => 'required|image|mimes:jpg,jpeg,png,webp',
                ]);
                break;

            case 'মাহিন্দ্রা':
                $request->validate([
                    'serial_prefix' => 'required',
                    'serial_number' => 'required',
                    'car_plate_image' => 'required|image|mimes:jpg,jpeg,png,webp',
                    'brta_front' => 'required|image|mimes:jpg,jpeg,png,webp',
                    'brta_back' => 'required|image|mimes:jpg,jpeg,png,webp',
                ]);
                break;

            case 'সিএনজি':
                $request->validate([
                    'serial_prefix' => 'required',
                    'serial_number' => 'required',
                    'car_plate_image' => 'required|image|mimes:jpg,jpeg,png,webp',
                    'brta_front' => 'required|image|mimes:jpg,jpeg,png,webp',
                    'brta_back' => 'required|image|mimes:jpg,jpeg,png,webp',
                ]);
                break;

            case 'ভ্যান':
            case 'ইজিবাইক':
                break;

            default:
                break;
        }

        $images = [];

        if ($request->hasFile('service_image')) {
            $service_image = uploadImage($request->service_image, filePath('provider-service'));
        }

        if ($request->hasFile('car_plate_image')) {
            $car_plate_image = uploadImage($request->car_plate_image, filePath('provider-service'));
        }

        if ($request->hasFile('brta_front')) {
            $brta_front = uploadImage($request->brta_front, filePath('provider-service'));
        }

        if ($request->hasFile('brta_back')) {
            $brta_back = uploadImage($request->brta_back, filePath('provider-service'));
        }

        $service = Service::create([
            'vehicle' => $request->vehicle,
            'truck_type' => $request->truck_type,
            'vehicle_seat' => $request->vehicle_seat,
            'ton_capacity' => $request->ton_capacity,
            // 'bike_brand' => $request->bike_brand,
            'bike_oil' => $request->bike_oil,
            'bike_brand_id' => $request->bike_brand_id,
            'bike_model_id' => $request->bike_model_id,
            // 'serial_number' => $request->serial_prefix . '-' . $request->serial_number,
            'car_model' => $request->car_model,
            'owner_mobile' => $request->owner_mobile,
            'user_id' => auth()->id(),
            'user_detail_id' => $createUserDetail->id,
            'status' => 1,
            'admin_approval' => 0,
            'location' => $request->location,
            'service_image' => $service_image ?? '',
            'car_plate_image' => $car_plate_image ?? '',
            'brta_front' => $brta_front ?? '',
            'brta_back' => $brta_back ?? '',
            // 'car_gallery_image' => json_encode($images),
        ]);
        if (!($request->vehicle == 'ভ্যান' || $request->vehicle == 'ইজিবাইক ')) {
            $service->update([
                'serial_number' => $request->serial_prefix . '-' . $request->serial_number
            ]);
        }



        $notify[] = ['success', 'Service Created Successfully'];

        return redirect()->route('user.service')->withNotify($notify);
    }

    public function serviceEdit(Service $service)
    {
        $pageTitle = "Service Edit";
        $vehicles = Vehicle::all();
        $upazilas = Upazila::all();
        $truck_types = TruckType::all();
        $bikeBrands = BikeBrand::all();
        $bikeModels = BikeModel::all();
        $user = auth()->user();
        $user_details = UserDetail::where('user_id', auth()->id())->first();

        return view('frontend.user.provider.service_edit', compact('pageTitle', 'bikeBrands', 'bikeModels', 'service', 'vehicles', 'upazilas', 'truck_types', 'user', 'user_details'));
    }

    public function serviceUpdate(Request $request, Service $service)
    {

        $request->validate([
            'vehicle' => 'required',
            'location' => 'required',
            'owner_mobile' => 'required',
            'service_image' => 'image|mimes:jpg,jpeg,png,webp',
            'car_gallery_image.*' => 'image|mimes:jpg,png,jpeg,webp',

            'provider_type' => 'required',
            'nid_no' => 'required',
            'company_address' => 'required',
        ]);

        switch ($request->vehicle) {
            case 'ট্রাক':
                $request->validate([
                    'truck_type' => 'required',
                    'ton_capacity' => 'required',
                    'serial_prefix' => 'required',
                    'serial_number' => 'required',
                    'car_model' => 'required',
                    'car_plate_image' => 'image|mimes:jpg,jpeg,png,webp',
                    'brta_front' => 'image|mimes:jpg,jpeg,png,webp',
                    'brta_back' => 'image|mimes:jpg,jpeg,png,webp',
                ]);
                break;

            case 'প্রাইভেট কার':
            case 'মাইক্রো':
            case 'বাস':
                $request->validate([
                    'vehicle_seat' => 'required',
                    'serial_prefix' => 'required',
                    'serial_number' => 'required',
                    'car_model' => 'required',
                    'car_plate_image' => 'image|mimes:jpg,jpeg,png,webp',
                    'brta_front' => 'image|mimes:jpg,jpeg,png,webp',
                    'brta_back' => 'image|mimes:jpg,jpeg,png,webp',
                ]);
                break;

            case 'এম্বুল্যান্স':
                $request->validate([
                    'serial_prefix' => 'required',
                    'serial_number' => 'required',
                    'car_plate_image' => 'image|mimes:jpg,jpeg,png,webp',
                    'brta_front' => 'image|mimes:jpg,jpeg,png,webp',
                    'brta_back' => 'image|mimes:jpg,jpeg,png,webp',
                ]);
                break;

            case 'মোটরসাইকেল':
                $request->validate([
                    'bike_brand_id' => 'required',
                    'bike_oil' => 'required',
                    'serial_prefix' => 'required',
                    'serial_number' => 'required',
                    // 'car_model' => 'required',
                    'car_plate_image' => 'image|mimes:jpg,jpeg,png,webp',
                    'brta_front' => 'image|mimes:jpg,jpeg,png,webp',
                    'brta_back' => 'image|mimes:jpg,jpeg,png,webp',
                ]);
                break;

            case 'মাহিন্দ্রা':
                $request->validate([
                    'serial_prefix' => 'required',
                    'serial_number' => 'required',
                    'car_plate_image' => 'image|mimes:jpg,jpeg,png,webp',
                    'brta_front' => 'image|mimes:jpg,jpeg,png,webp',
                    'brta_back' => 'image|mimes:jpg,jpeg,png,webp',
                ]);
                break;

            case 'সিএনজি':
                $request->validate([
                    'serial_prefix' => 'required',
                    'serial_number' => 'required',
                    'car_plate_image' => 'image|mimes:jpg,jpeg,png,webp',
                    'brta_front' => 'image|mimes:jpg,jpeg,png,webp',
                    'brta_back' => 'image|mimes:jpg,jpeg,png,webp',
                ]);
                break;

            case 'ভ্যান':
            case 'ইজিবাইক':
                break;

            default:
                break;
        }

        $images = [];

        if ($request->hasFile('service_image')) {
            if (($service->service_image != '') && (file_exists(public_path('backend/images/provider-service/' . $service->service_image)))) {
                unlink(public_path('backend/images/provider-service/' . $service->service_image));
            }
            $service_image = uploadImage($request->service_image, filePath('provider-service'));
        }

        if ($request->hasFile('car_plate_image')) {
            if (($service->car_plate_image != '') && (file_exists(public_path('backend/images/provider-service/' . $service->car_plate_image)))) {
                unlink(public_path('backend/images/provider-service/' . $service->car_plate_image));
            }
            $car_plate_image = uploadImage($request->car_plate_image, filePath('provider-service'));
        }

        if ($request->hasFile('brta_front')) {
            if (($service->brta_front != '') && (file_exists(public_path('backend/images/provider-service/' . $service->brta_front)))) {
                unlink(public_path('backend/images/provider-service/' . $service->brta_front));
            }
            $brta_front = uploadImage($request->brta_front, filePath('provider-service'));
        }

        if ($request->hasFile('brta_back')) {
            if (($service->brta_back != '') && (file_exists(public_path('backend/images/provider-service/' . $service->brta_back)))) {
                unlink(public_path('backend/images/provider-service/' . $service->brta_back));
            }
            $brta_back = uploadImage($request->brta_back, filePath('provider-service'));
        }


        $service->update([
            'vehicle' => $request->vehicle,
            'truck_type' => $request->truck_type,
            'vehicle_seat' => $request->vehicle_seat,
            'ton_capacity' => $request->ton_capacity,
            'bike_brand_id' => $request->bike_brand_id,
            'bike_oil' => $request->bike_oil,
            // 'serial_number' => $request->serial_prefix . '-' . $request->serial_number,
            'car_model' => $request->car_model,
            'owner_mobile' => $request->owner_mobile,
            'user_id' => auth()->id(),
            // 'user_detail_id' => $service->user_detail_id,
            'status' => 1,
            'location' => $request->location,
            'service_image' => $service_image ?? $service->service_image,
            'car_plate_image' => $car_plate_image ?? $service->car_plate_image,
            'brta_front' => $brta_front ?? $service->brta_front,
            'brta_back' => $brta_back ?? $service->brta_back,
            // 'car_gallery_image' => $gallery,
        ]);

        if (!($request->vehicle == 'ভ্যান' || $request->vehicle == 'ইজিবাইক ')) {
            $service->update([
                'serial_number' => $request->serial_prefix . '-' . $request->serial_number

            ]);
        }
        if ($request->bike_model_id != null) {
            // dd($request);
            $service->update([
                'bike_model_id' => $request->bike_model_id
            ]);
        }

        $user_details = UserDetail::where('user_id', auth()->id())->first();
        $userDetailId = UserDetail::find($service->user_detail_id);
        // dd($userDetailId);

        if ($request->provider_type == 'ড্রাইভার') {
            if ($userDetailId->driving_license_front == '' || $userDetailId->driving_license_back == '') {
                $request->validate([
                    'driving_license_front' => 'required|image|mimes:jpg,png,jpeg',
                    'driving_license_back' => 'required|image|mimes:jpg,png,jpeg'
                ]);
            }
        }

        if ($request->provider_type != 'ড্রাইভার') {
            $user_details->provider_type = $request->provider_type;
            $user_details->company_name = $request->company_name;
            $user_details->company_address = $request->company_address;
            $user_details->nid_no = $request->nid_no;
            $user_details->driving_experience = $request->driving_experience;
            $user_details->save();

        }

        if ($request->provider_type == 'ড্রাইভার') {
            $userDetailId->provider_type = $request->provider_type;
            $userDetailId->company_name = $request->company_name;
            $userDetailId->company_address = $request->company_address;
            $userDetailId->nid_no = $request->nid_no;
            $userDetailId->driving_experience = $request->driving_experience;

            if ($request->hasFile('driving_license_front')) {
                $filename = uploadImage($request->driving_license_front, filePath('user_details'), $request->driving_license_front);
                $userDetailId->driving_license_front = $filename;
            }

            if ($request->hasFile('driving_license_back')) {
                $filename = uploadImage($request->driving_license_back, filePath('user_details'), $request->driving_license_back);
                $userDetailId->driving_license_back = $filename;
            }

            $userDetailId->save();

        }


        $notify[] = ['success', 'Service Updated Successfully'];

        return redirect()->route('user.service')->withNotify($notify);
    }

    public function serviceDelete(Service $service)
    {

        if (!$service->bookings || $service->bookings()->where('is_completed', 0)->count() == 0) {

            if ($service->service_image) {
                unlink(filePath('provider-service') . '/' . $service->service_image);
            }
            if ($service->car_plate_image) {
                unlink(filePath('provider-service') . '/' . $service->car_plate_image);
            }
            if ($service->brta_front) {
                unlink(filePath('provider-service') . '/' . $service->brta_front);
            }
            if ($service->brta_back) {
                unlink(filePath('provider-service') . '/' . $service->brta_back);
            }

            if (@$service->userDetail->provider_type == 'ড্রাইভার') {
                $user_detail = UserDetail::find($service->user_detail_id);
                $user_detail->delete();
            }
            $service->delete();

            $notify[] = ['success', 'Service Deleted Successfully'];

            return back()->withNotify($notify);
        }

        if (@$service->userDetail->provider_type == 'ড্রাইভার') {
            $user_detail = UserDetail::find($service->user_detail_id);
            $user_detail->delete();
        }
        $service->delete();

        $notify[] = ['success', 'Service Deleted Successfully'];

        return back()->withNotify($notify);
    }


    public function serviceProfile()
    {
        $pageTitle = "Service Profile";

        return view('frontend.user.provider.service_profile', compact('pageTitle'));
    }

    public function schedule()
    {
        $pageTitle = 'Schedule For Service';

        $weeks = Schedule::where('user_id', auth()->id())->paginate();

        return view('frontend.user.provider.service_schedule', compact('pageTitle', 'weeks'));
    }

    public function scheduleCreate(Request $request)
    {
        $request->validate([
            'weekname' => 'required',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'status' => 'required|in:0,1'
        ]);


        $start_time = Carbon::createFromFormat('h:i A', $request->start_time);

        $end_time = Carbon::createFromFormat('h:i A', $request->end_time);

        $weeks = Schedule::where('user_id', auth()->id())->where('week_name', $request->weekname)->get();

        foreach ($weeks as $week) {
            if (Carbon::parse($week->start_time)->between($start_time, $end_time, true) || Carbon::parse($week->end_time)->between($start_time, $end_time, true)) {
                $notify[] = ['error', 'Already Have a Schedule in This Time'];

                return back()->withNotify($notify);
            }
        }

        Schedule::create([
            'user_id' => auth()->id(),
            'week_name' => $request->weekname,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'status' => $request->status
        ]);


        $notify[] = ['success', 'Successfully Added Schedule'];

        return back()->withNotify($notify);
    }

    public function scheduleUpdate(Request $request, Schedule $schedule)
    {
        $request->validate([
            'weekname' => 'required',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'status' => 'required|in:0,1'
        ]);


        $start_time = Carbon::createFromFormat('h:i A', $request->start_time);

        $end_time = Carbon::createFromFormat('h:i A', $request->end_time);



        $weeks = Schedule::where('id', '!=', $schedule->id)->where('user_id', auth()->id())->where('week_name', $request->weekname)->get();



        foreach ($weeks as $week) {
            if (Carbon::parse($week->start_time)->between($start_time, $end_time, true) || Carbon::parse($week->end_time)->between($start_time, $end_time, true)) {
                $notify[] = ['error', 'Already Have a Schedule in This Time'];

                return back()->withNotify($notify);
            }
        }



        $schedule->update([
            'user_id' => auth()->id(),
            'week_name' => $request->weekname,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'status' => $request->status
        ]);


        $notify[] = ['success', 'Successfully updated Schedule'];

        return back()->withNotify($notify);
    }
}
