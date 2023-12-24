<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Division;
use App\Models\Employee;
use App\Models\Union;
use App\Models\TripInfo;
use App\Models\Upazila;
use App\Models\User;
use App\Models\Worksheet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManageEmployeeController extends Controller
{
    public function index(Request $request)
    {
        $pageTitle = 'All Employees';

        $search = $request->search;

        $employees = User::when($search, function ($q) use ($search) {
            $q->where('fname', 'LIKE', '%' . $search . '%')
                ->orWhere('lname', 'LIKE', '%' . $search . '%')
                ->orWhere('username', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('mobile', 'LIKE', '%' . $search . '%');
        })->where('user_type', 3)->paginate();
        return view('admin.employee.index', compact('pageTitle', 'employees'));
    }

    public function create()
    {
        $divisions = Division::all();
        $pageTitle = 'Add Employee';
        return view('admin.employee.create', compact('pageTitle', 'divisions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fname' => ['required'],
            'lname' => ['nullable'],
            'username' => ['required'],
            'division_id' => ['required'],
            'district_id' => ['nullable'],
            'upazila_id' => ['nullable'],
            'union_id' => ['nullable'],
            'email' => ['required', 'email'],
            'mobile' => ['required'],
            'employee_role' => ['required'],
            'referral' => ['alpha_num:ascii', 'unique:users,referral'],
            'password' => ['required'],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['status'] = 1;
        $validated['user_type'] = 3;
        $employee = User::create($validated);

        $lastWorksheet = Worksheet::where('employee_id', $employee->id)->latest()->first();
        if ($employee && $lastWorksheet == null) {
            Worksheet::create([
                'employee_id' => $employee->id,
            ]);
        }

        if ($employee) {
            $notify[] = ['success', 'Employee added successfully!'];
            return redirect()->route('admin.employee')->withNotify($notify);
        } else {
            $notify[] = ['error', 'No Employee Added Please Try Again!'];
            return redirect()->back()->withNotify($notify);
        }
    }

    public function show(User $employee)
    {
        $pageTitle = 'Show Employee';

        //counter
        $totalReg = User::where('created_by', $employee->id)->count();
        $totalCustomer = User::where('user_type', '1')->where('created_by', $employee->id)->count();
        $totalProvider = User::where('user_type', '2')->where('created_by', $employee->id)->count();


        // Retrieve customer IDs created by the employee Id
        $customerIds = User::where('created_by', $employee->id)
            ->where('user_type', 1)
            ->pluck('id')
            ->toArray();

        // Retrieve TripInfo records with status = "ordered" and associated with the customers created by the logged-in user
        $totalRunningOrder = TripInfo::whereIn('user_id', $customerIds)
            ->where('status', 'in-progress')
            ->where('vehicle_id', 1)
            ->count();
        $totalConfirmOrder = TripInfo::whereIn('user_id', $customerIds)
            ->where('status', 'ordered')
            ->where('vehicle_id', 1)
            ->count();
        $totalCanceledOrder = TripInfo::whereIn('user_id', $customerIds)
            ->where('status', 'caneled')
            ->where('vehicle_id', 1)
            ->count();

        $customer_vendors = User::where('created_by', $employee->id)->whereIn('user_type', [1, 2])->get();
        return view('admin.employee.show', compact('pageTitle', 'employee', 'customer_vendors', 'totalReg', 'totalCustomer', 'totalProvider', 'totalRunningOrder', 'totalConfirmOrder', 'totalCanceledOrder'));
    }

    public function edit($id)
    {
        $divisions = Division::all();
        $districts = District::all();
        $upazilas = Upazila::all();
        $unions = Union::all();
        $pageTitle = 'Edit Employee';
        $employees = User::find($id);

        return view('admin.employee.edit', compact('pageTitle', 'unions', 'districts', 'upazilas', 'employees', 'divisions'));
    }

    public function update(Request $request, User $employee)
    {
        $validated = $request->validate([
            'fname' => ['required'],
            'lname' => ['nullable'],
            'username' => ['required'],
            'division_id' => ['required'],
            'district_id' => ['nullable'],
            'upazila_id' => ['nullable'],
            'union_id' => ['nullable'],
            'email' => ['required', 'email'],
            'mobile' => ['required'],
            // 'employee_role'=>['required'],
            'designation' => ['nullable'],
            'details' => ['nullable'],
            'experience' => ['nullable'],
            'qualification' => ['nullable'],
            'status' => ['required'],
        ]);

        $employee->update([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'username' => $request->username,
            'employee_role' => $request->employee_role,
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'upazila_id' => $request->upazila_id,
            'union_id' => $request->union_id,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'designation' => $request->designation,
            'details' => $request->details,
            'experience' => $request->experience,
            'qualification' => $request->qualification,
            'status' => $request->status,
        ]);

        if ($employee) {
            $notify[] = ['success', 'Employee updated successfully!'];
            return redirect()->route('admin.employee')->withNotify($notify);
        }
    }

    public function destroy(User $employee)
    {
        $employee->delete();

        $notify[] = ['success', 'Employee deleted successfully!'];
        return redirect()->back()->withNotify($notify);
    }

    function crm()
    {
        $pageTitle = 'Show Employee CRM';
        $employees = User::where('user_type', 3)->paginate();
        return view('admin.employee.crm.crm_index', compact('pageTitle', 'employees'));
    }

    public function search(Request $request)
    {
        // dd($employee);
        $pageTitle = 'Employee';

        $search = $request->search;

        $employee = User::when($search, function ($q) use ($search) {
            $q->where('referral', '=', $search);
        })->where('user_type', 3)->first();
        // dd( $employee);
        if (!$employee) {
            $notify[] = ['error', 'No Employee found with the provided referral code.'];

            return redirect()->route('admin.employee.crm')->withNotify($notify);

            // return redirect()->route('agent.index1')->with('message', 'No agent found with the provided referral code.');
        } else {
            $orderedid = User::where('created_by', $employee->id)->pluck('id')->toArray();

            $confirmedOrders = TripInfo::whereIn('user_id', $orderedid)->where('status', 'ordered')->count();
            $totalCustomer = User::where('user_type', '1')->where('created_by', $employee->id)->count();
            $totalProvider = User::where('user_type', '2')->where('created_by', $employee->id)->count();
            // trip
            $all_trips = TripInfo::with('customer')->whereIn('user_id', $orderedid)->paginate(10);
            $current_trips = TripInfo::with('customer')->whereIn('user_id', $orderedid)->where('starting_date', '>', Carbon::yesterday())->where('starting_date', '<', Carbon::tomorrow())->paginate(10);

            $canceled_trips = TripInfo::with('customer')->whereIn('user_id', $orderedid)->where('status', 'canceled')->paginate(10);
            $pending_trips = TripInfo::with('customer')->whereIn('user_id', $orderedid)->where('starting_date', '>=', Carbon::tomorrow())->paginate(10);
            $previous_trips = TripInfo::with('customer')->whereIn('user_id', $orderedid)->where('starting_date', '<', Carbon::today())->paginate(10);
            return view('admin.employee.crm.search_crm', compact('pageTitle', 'employee', 'totalCustomer', 'totalProvider', 'confirmedOrders', 'all_trips', 'current_trips', 'canceled_trips', 'pending_trips', 'previous_trips'));
        }
    }
    public function view($id)
    {
        $pageTitle = 'Employee';
        $employee = User::where('id', $id)->first();
        // dd($employee);
        $orderedid = User::where('created_by', $id)->pluck('id')->toArray();

        $confirmedOrders = TripInfo::whereIn('user_id', $orderedid)->where('status', 'ordered')->count();
        $totalCustomer = User::where('user_type', '1')->where('created_by', $id)->count();
        $totalProvider = User::where('user_type', '2')->where('created_by', $id)->count();
        // trip
        $all_trips = TripInfo::with('customer')->whereIn('user_id', $orderedid)->paginate(10);
        $current_trips = TripInfo::with('customer')->whereIn('user_id', $orderedid)->where('starting_date', '>', Carbon::yesterday())->where('starting_date', '<', Carbon::tomorrow())->paginate(10);

        $canceled_trips = TripInfo::with('customer')->whereIn('user_id', $orderedid)->where('status', 'canceled')->paginate(10);
        $pending_trips = TripInfo::with('customer')->whereIn('user_id', $orderedid)->where('starting_date', '>=', Carbon::tomorrow())->paginate(10);
        $previous_trips = TripInfo::with('customer')->whereIn('user_id', $orderedid)->where('starting_date', '<', Carbon::today())->paginate(10);
        return view('admin.employee.crm.search_crm', compact('pageTitle', 'employee', 'totalCustomer', 'totalProvider', 'confirmedOrders', 'all_trips', 'current_trips', 'canceled_trips', 'pending_trips', 'previous_trips'));
    }
}
