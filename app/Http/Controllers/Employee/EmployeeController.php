<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
// use App\Http\Controllers\Employee\TripInfo;
// use App\Http\Controllers\Controller;
use App\Http\Controllers\Employee\Vehicles;
use App\Models\TripInfo;
use App\Models\Worksheet;
use Carbon\Carbon;
use Illuminate\Support\Carbon as SupportCarbon;

class EmployeeController extends Controller
{

    public function dashboard()
    {
        $employee_role = Auth::user()->employee_role;
        // dd($employee_role);
        $totalReg = User::where('created_by', Auth::user()->id)->count();
        $todaysReg = User::where('created_by', Auth::user()->id)->where('created_at', '>=', Carbon::today())->count();
        // dd($todaysReg);
        $totalCustomer = User::where('user_type', '1')->where('created_by', Auth::user()->id)->count();
        $totalVendor = User::where('user_type', '2')->where('created_by', Auth::user()->id)->count();

        // Get the logged-in user's ID
        $loggedInUserId = Auth::id();

        // Retrieve customer IDs created by the logged-in user
        $customerIds = User::where('created_by', $loggedInUserId)
            ->where('user_type', 1)
            ->pluck('id')
            ->toArray();

        // Retrieve TripInfo records with status = "ordered" and associated with the customers created by the logged-in user
        $totalRunningOrder = TripInfo::with(['customer', 'vehicle'])
            ->whereIn('user_id', $customerIds)
            ->where('status', 'in-progress')
            // ->where('vehicle_id', 2)
            ->count();
        $totalConfirmOrder = TripInfo::with(['customer', 'vehicle'])
            ->whereIn('user_id', $customerIds)
            ->where('status', 'ordered')
            // ->where('vehicle_id', 1)
            ->count();
        $totalCanceledOrder = TripInfo::with(['customer', 'vehicle'])
            ->whereIn('user_id', $customerIds)
            ->where('status', 'caneled')
            // ->where('vehicle_id', 1)
            ->count();


        return view('employee.dashboard', compact('totalReg', 'todaysReg', 'totalCustomer', 'totalVendor', 'employee_role', 'totalRunningOrder', 'totalConfirmOrder', 'totalCanceledOrder'));
    }

    public function profile()
    {
        return view('employee.modules.profile.profile');
    }

    public function edit_profile()
    {
        return view('employee.modules.profile.edit_profile');
    }

    public function profile_update(Request $request, $id)
    {
        if ($request->isMethod('PUT')) {
            $user  = User::find($id);
            if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');

                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    @unlink(public_path('uploads/profile' . $user->image));
                    $image_name = $image_tmp->getClientOriginalName();
                    // $extension = $image_tmp->getClientOriginalExtension();
                    // $fileName = $image_name . '-' . rand(111, 99999) . '.' . $extension;
                    $image_path = 'backend/images/user' . '/' . $image_name;

                    Image::make($image_tmp)->resize(1000, 1000)->save($image_path);
                }
            } elseif (Auth::user()->image) {
                $image_path = Auth::user()->image;
            }




            $user->fname = $request->fname;
            $user->lname = $request->lname;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->designation = $request->designation;
            $user->details = $request->details;
            $user->experience = $request->experience;
            $user->qualification = $request->qualification;
            $user->image = @$image_path;
            $user->update();
        }
        $notify[] = ['success', 'Profile Updated Successfully.'];
        return redirect()->route('employee.profile')->withNotify($notify);
    }


    public function password()
    {
        return view('employee.modules.profile.changepass');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string', 'min:4'],
            'password' => ['required', 'string', 'min:4', 'confirmed']
        ]);

        $currentPasswordStatus = Hash::check($request->current_password, Auth::user()->password);
        if ($currentPasswordStatus) {

            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password),
            ]);

            $notify[] = ['success', 'Password Updated Successfully.'];
            return redirect()->route('employee.profile')->withNotify($notify);
        } else {

            return redirect()->back()->with('message', 'Current Password does not match with Old Password');
        }
    }

    //Todays registration Page

    public function todaysReg()
    {
        $todays_regs['customer'] = User::where('created_by', Auth::user()->id)->where('user_type', 1)->where('created_at', '>=', Carbon::today())->paginate(10);
        $todays_regs['vendor'] = User::where('created_by', Auth::user()->id)->where('user_type', 2)->where('created_at', '>=', Carbon::today())->paginate(10);
        return view('employee.modules.registration.todays_reg', compact('todays_regs'));
    }

    //Total registration Page

    public function totalReg()
    {
        $total_regs = User::where('created_by', Auth::user()->id)->paginate(10);
        return view('employee.modules.registration.total_reg', compact('total_regs'));
    }

    // Confirm order Aigenst employe
    public function confirm_order()
    {
        // $pageTitle = 'All Confirm Order';

        // Get the logged-in user's ID
        $loggedInUserId = Auth::id();

        // Retrieve customer IDs created by the logged-in user
        $customerIds = User::where('created_by', $loggedInUserId)
            ->where('user_type', 1)
            ->pluck('id')
            ->toArray();

        // Retrieve TripInfo records with status = "ordered" and associated with the customers created by the logged-in user
        $trucks = TripInfo::with(['customer', 'vehicle'])
            ->whereIn('user_id', $customerIds)
            ->where('status', 'ordered')
            ->where('vehicle_id', 1)
            ->paginate(10);
        $buses = TripInfo::with(['customer', 'vehicle'])
            ->whereIn('user_id', $customerIds)
            ->where('status', 'ordered')
            ->where('vehicle_id', 10)
            ->paginate(10);
        $cars = TripInfo::with(['customer', 'vehicle'])
            ->whereIn('user_id', $customerIds)
            ->where('status', 'ordered')
            ->where('vehicle_id', 2)
            ->paginate(10);
        $micros = TripInfo::with(['customer', 'vehicle'])
            ->whereIn('user_id', $customerIds)
            ->where('status', 'ordered')
            ->where('vehicle_id', 3)
            ->paginate(10);
        $ambulances = TripInfo::with(['customer', 'vehicle'])
            ->whereIn('user_id', $customerIds)
            ->where('status', 'ordered')
            ->where('vehicle_id', 4)
            ->paginate(10);
        $motor_cycles = TripInfo::with(['customer', 'vehicle'])
            ->whereIn('user_id', $customerIds)
            ->where('status', 'ordered')
            ->where('vehicle_id', 5)
            ->paginate(10);
        $cngs = TripInfo::with(['customer', 'vehicle'])
            ->whereIn('user_id', $customerIds)
            ->where('status', 'ordered')
            ->where('vehicle_id', 6)
            ->paginate(10);
        $vans = TripInfo::with(['customer', 'vehicle'])
            ->whereIn('user_id', $customerIds)
            ->where('status', 'ordered')
            ->where('vehicle_id', 7)
            ->paginate(10);
        $mahindras = TripInfo::with(['customer', 'vehicle'])
            ->whereIn('user_id', $customerIds)
            ->where('status', 'ordered')
            ->where('vehicle_id', 8)
            ->paginate(10);
        $easy_bikes = TripInfo::with(['customer', 'vehicle'])
            ->whereIn('user_id', $customerIds)
            ->where('status', 'ordered')
            ->where('vehicle_id', 9)
            ->paginate(10);

        return view('employee.modules.orders.confirm_order', compact('trucks', 'buses', 'cars', 'micros', 'ambulances', 'motor_cycles', 'cngs', 'vans', 'mahindras', 'easy_bikes'));
    }
    public function running_order()
    {
        // $pageTitle = 'All Confirm Order';

        // Get the logged-in user's ID
        $loggedInUserId = Auth::id();

        // Retrieve customer IDs created by the logged-in user
        $customerIds = User::where('created_by', $loggedInUserId)
            ->where('user_type', 1)
            ->pluck('id')
            ->toArray();

        // Retrieve TripInfo records with status = "ordered" and associated with the customers created by the logged-in user
        $trucks = TripInfo::with(['customer', 'vehicle'])
            ->whereIn('user_id', $customerIds)
            ->where('status', 'in-progress')
            ->where('vehicle_id', 1)
            ->paginate(10);
        $buses = TripInfo::with(['customer', 'vehicle'])
            ->whereIn('user_id', $customerIds)
            ->where('status', 'in-progress')
            ->where('vehicle_id', 10)
            ->paginate(10);
        $cars = TripInfo::with(['customer', 'vehicle'])
            ->whereIn('user_id', $customerIds)
            ->where('status', 'in-progress')
            ->where('vehicle_id', 2)
            ->paginate(10);
        $micros = TripInfo::with(['customer', 'vehicle'])
            ->whereIn('user_id', $customerIds)
            ->where('status', 'in-progress')
            ->where('vehicle_id', 3)
            ->paginate(10);
        $ambulances = TripInfo::with(['customer', 'vehicle'])
            ->whereIn('user_id', $customerIds)
            ->where('status', 'in-progress')
            ->where('vehicle_id', 4)
            ->paginate(10);
        $motor_cycles = TripInfo::with(['customer', 'vehicle'])
            ->whereIn('user_id', $customerIds)
            ->where('status', 'in-progress')
            ->where('vehicle_id', 5)
            ->paginate(10);
        $cngs = TripInfo::with(['customer', 'vehicle'])
            ->whereIn('user_id', $customerIds)
            ->where('status', 'in-progress')
            ->where('vehicle_id', 6)
            ->paginate(10);
        $vans = TripInfo::with(['customer', 'vehicle'])
            ->whereIn('user_id', $customerIds)
            ->where('status', 'in-progress')
            ->where('vehicle_id', 7)
            ->paginate(10);
        $mahindras = TripInfo::with(['customer', 'vehicle'])
            ->whereIn('user_id', $customerIds)
            ->where('status', 'in-progress')
            ->where('vehicle_id', 8)
            ->paginate(10);
        $easy_bikes = TripInfo::with(['customer', 'vehicle'])
            ->whereIn('user_id', $customerIds)
            ->where('status', 'in-progress')
            ->where('vehicle_id', 9)
            ->paginate(10);

        return view('employee.modules.orders.running_order', compact('trucks', 'buses', 'cars', 'micros', 'ambulances', 'motor_cycles', 'cngs', 'vans', 'mahindras', 'easy_bikes'));
    }
    public function cancel_order()
    {
        // $pageTitle = 'All Confirm Order';

        // Get the logged-in user's ID
        $loggedInUserId = Auth::id();

        // Retrieve customer IDs created by the logged-in user
        $customerIds = User::where('created_by', $loggedInUserId)
            ->where('user_type', 1)
            ->pluck('id')
            ->toArray();

        // Retrieve TripInfo records with status = "ordered" and associated with the customers created by the logged-in user
        $trucks = TripInfo::with(['customer', 'vehicle'])
            ->whereIn('user_id', $customerIds)
            ->where('status', 'canceled')
            ->where('vehicle_id', 1)
            ->paginate(10);
        $buses = TripInfo::with(['customer', 'vehicle'])
            ->whereIn('user_id', $customerIds)
            ->where('status', 'canceled')
            ->where('vehicle_id', 10)
            ->paginate(10);
        $cars = TripInfo::with(['customer', 'vehicle'])
            ->whereIn('user_id', $customerIds)
            ->where('status', 'canceled')
            ->where('vehicle_id', 2)
            ->paginate(10);
        $micros = TripInfo::with(['customer', 'vehicle'])
            ->whereIn('user_id', $customerIds)
            ->where('status', 'canceled')
            ->where('vehicle_id', 3)
            ->paginate(10);
        $ambulances = TripInfo::with(['customer', 'vehicle'])
            ->whereIn('user_id', $customerIds)
            ->where('status', 'canceled')
            ->where('vehicle_id', 4)
            ->paginate(10);
        $motor_cycles = TripInfo::with(['customer', 'vehicle'])
            ->whereIn('user_id', $customerIds)
            ->where('status', 'canceled')
            ->where('vehicle_id', 5)
            ->paginate(10);
        $cngs = TripInfo::with(['customer', 'vehicle'])
            ->whereIn('user_id', $customerIds)
            ->where('status', 'canceled')
            ->where('vehicle_id', 6)
            ->paginate(10);
        $vans = TripInfo::with(['customer', 'vehicle'])
            ->whereIn('user_id', $customerIds)
            ->where('status', 'canceled')
            ->where('vehicle_id', 7)
            ->paginate(10);
        $mahindras = TripInfo::with(['customer', 'vehicle'])
            ->whereIn('user_id', $customerIds)
            ->where('status', 'canceled')
            ->where('vehicle_id', 8)
            ->paginate(10);
        $easy_bikes = TripInfo::with(['customer', 'vehicle'])
            ->whereIn('user_id', $customerIds)
            ->where('status', 'canceled')
            ->where('vehicle_id', 9)
            ->paginate(10);

        return view('employee.modules.orders.cancel_order', compact('trucks', 'buses', 'cars', 'micros', 'ambulances', 'motor_cycles', 'cngs', 'vans', 'mahindras', 'easy_bikes'));
    }


    public function performance()
    {
        // $employee_role = Auth::user()->employee_role;
        // $pageTitle = "Work Sheet";

        $self_performance = Worksheet::where('employee_id', Auth::user()->id)->latest()->first();
        // dd($self_performance);

        if (auth()->user()->employee_role == 'Zone Manager') {
            $employeedata_today['teamleader'] = Worksheet::where('created_at', '>=', Carbon::today())->whereRelation('user', 'district_id', auth()->user()->district_id)->whereRelation('user', 'employee_role', 'Team Leader')->paginate(5);

            //week
            $week = \Carbon\Carbon::today()->subDays(7);
            $employeedata_week['teamleader'] = Worksheet::where('created_at', '>=', $week)->whereRelation('user', 'district_id', auth()->user()->district_id)->whereRelation('user', 'employee_role', 'Team Leader')->paginate(5);

            //month
            $month = \Carbon\Carbon::today()->subDays(30);
            $employeedata_month['teamleader'] = Worksheet::where('created_at', '>=', $month)->whereRelation('user', 'district_id', auth()->user()->district_id)->whereRelation('user', 'employee_role', 'Team Leader')->paginate(5);


            //brandpromoter
            $employeedata_today['brandpromoter'] = Worksheet::where('created_at', '>=', Carbon::today())->whereRelation('user', 'district_id', auth()->user()->district_id)->whereRelation('user', 'employee_role', 'Brand Promoter')->paginate(5);

            //week
            $week = \Carbon\Carbon::today()->subDays(7);
            $employeedata_week['brandpromoter'] = Worksheet::where('created_at', '>=', $week)->whereRelation('user', 'district_id', auth()->user()->district_id)->whereRelation('user', 'employee_role', 'Brand Promoter')->paginate(5);

            //month
            $month = \Carbon\Carbon::today()->subDays(30);
            $employeedata_month['brandpromoter'] = Worksheet::where('created_at', '>=', $month)->whereRelation('user', 'district_id', auth()->user()->district_id)->whereRelation('user', 'employee_role', 'Brand Promoter')->paginate(5);

            return view('employee.modules.performance', compact('self_performance', 'employeedata_today', 'employeedata_week', 'employeedata_month'));
        } elseif (auth()->user()->employee_role == 'Team Leader') {
            $employeedata_today['brandpromoter'] = Worksheet::where('created_at', '>=', Carbon::today())->whereRelation('user', 'upazila_id', auth()->user()->upazila_id)->whereRelation('user', 'employee_role', 'Brand Promoter')->paginate(10);
            //week
            $week = \Carbon\Carbon::today()->subDays(7);
            $employeedata_week['brandpromoter'] = Worksheet::where('created_at', '>=', $week)->whereRelation('user', 'upazila_id', auth()->user()->upazila_id)->whereRelation('user', 'employee_role', 'Brand Promoter')->paginate(10);

            //month
            $month = \Carbon\Carbon::today()->subDays(30);
            $employeedata_month['brandpromoter'] = Worksheet::where('created_at', '>=', $month)->whereRelation('user', 'upazila_id', auth()->user()->upazila_id)->whereRelation('user', 'employee_role', 'Brand Promoter')->paginate(10);
            return view('employee.modules.performance', compact('self_performance', 'employeedata_today', 'employeedata_week', 'employeedata_month'));
        } else {
            return view('employee.modules.performance', compact('self_performance'));
        }
    }


    public function searchEmployee(Request $request)
    {

        // $pageTitle = 'All Employees';
        $employee_role = Auth::user()->employee_role;
        $search = $request->search;

        $employee = User::when($search, function ($q) use ($search) {
            $q->where('referral', '=', $search );
        })->first();

        if (!$employee) {
            $notify[] = ['error', 'No employee found with the provided referral code.'];

            return redirect()->route('employee.search_index')->withNotify($notify);
        } else {
            $orderedid = User::where('created_by', $employee->id)->pluck('id')->toArray();

            $confirmedOrders = TripInfo::whereIn('user_id', $orderedid)->where('status', 'ordered')->count();
            $totalCustomer = User::where('user_type', '1')->where('created_by', $employee->id)->count();
            $totalProvider = User::where('user_type', '2')->where('created_by', $employee->id)->count();

            // trip
            $pageTitle = 'All Trips';

            $all_trips = TripInfo::with('customer')->whereIn('user_id', $orderedid)->paginate(10);
            $current_trips = TripInfo::with('customer')->whereIn('user_id', $orderedid)->where('starting_date', '>', Carbon::yesterday())->where('starting_date', '<', Carbon::tomorrow())->paginate(10);

            $canceled_trips = TripInfo::with('customer')->whereIn('user_id', $orderedid)->where('status', 'canceled')->paginate(10);
            $pending_trips = TripInfo::with('customer')->whereIn('user_id', $orderedid)->where('starting_date', '>=', Carbon::tomorrow())->paginate(10);
            $previous_trips = TripInfo::with('customer')->whereIn('user_id', $orderedid)->where('starting_date', '<', Carbon::today())->paginate(10);
            return view('employee.modules.search', compact('pageTitle', 'employee', 'totalCustomer', 'totalProvider', 'confirmedOrders', 'all_trips', 'current_trips', 'canceled_trips', 'pending_trips', 'previous_trips', 'employee_role'));
        }
    }
    public function searchindex()
    {
        $employee_role = Auth::user()->employee_role;
        return view('employee.modules.search_index', compact('employee_role'));
    }

    public function worksheet()
    {
        $employee_role = Auth::user()->employee_role;
        $pageTitle = "ওয়ার্ক শিট";

        $employeetdata = Worksheet::where('employee_id', Auth::user()->id)->latest()->paginate(10);
        // dd($employeetdata);
        return view('employee.worksheet.index', compact('pageTitle', 'employeetdata', 'employee_role'));
    }


    //selfie upload
    public function uploadpage(Request $request, $id)
    {
        $employee_role = Auth::user()->employee_role;
        $pageTitle = "Upload Image";
        $employeeid = Worksheet::findOrFail($id);
        return view('employee.worksheet.upload_selfie', compact('employeeid', 'pageTitle', 'employee_role'));
    }

    public function uploadSelfie(Request $request, $id)
    {

        $employeeid = Worksheet::findOrFail($id);

        if ($request->hasFile('selfie')) {
            $uploadedSelfie = $request->file('selfie');
            $imageName = time() . '_' . $uploadedSelfie->getClientOriginalName();
            $imagePath = 'uploads/selfies/' . $imageName;

            // Save the uploaded selfie
            $uploadedSelfie->move(public_path('uploads/selfies'), $imageName);

            // Update the worksheet with the uploaded selfie image path
            $employeeid->attendence_selfie = $imagePath;
            $employeeid->save();
            $notify[] = ['success', 'Selfie uploaded successfully.'];
            return redirect()->back()->withNotify($notify);
        }
        $notify[] = ['error', 'No selfie file was uploaded.'];
        return redirect()->back()->withNotify($notify);
    }
    public function image_view($id)
    {
        $pageTitle = "Preview image";
        $employeeid = Worksheet::findOrFail($id);
        return view('employee.worksheet.preview_image', compact('pageTitle', 'employeeid'));
    }
}
