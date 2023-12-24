<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\TripInfo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class AgentController extends Controller
{
    public function index(Request $request)
    {
        $pageTitle = 'All Agents';

        $search = $request->search;

        $agents = User::when($search, function($q) use($search){
            $q->where('fname','LIKE','%'.$search.'%')
              ->orWhere('lname','LIKE','%'.$search.'%')
              ->orWhere('username','LIKE','%'.$search.'%')
              ->orWhere('referral','LIKE','%'.$search.'%')
              ->orWhere('mobile','LIKE','%'.$search.'%');

        })->where('user_type', 4)->paginate();


        return view('admin.agent.index', compact('pageTitle', 'agents'));
    }

    public function create()
    {
        $divisions = Division::get();
        // $districts = District::get();
        // $upazilas = Upazila::get();
        $pageTitle = 'Add Agent';
        return view('admin.agent.create', compact('pageTitle','divisions'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'fname' => ['required'],
            'lname' => ['nullable'],
            'username' => ['required'],
            'email' => ['required', 'email'],
            'division_id' => ['required'],
            'district_id' => ['nullable'],
            'upazila_id' => ['nullable'],
            'union_id' => ['nullable'],
            'referral' => ['alpha_num:ascii','unique:users,referral'],
            'mobile' => ['required'],
            'password' => ['required'],

        ]);
// dd($validated);
        $agent = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'username' => $request->username,
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'upazila_id' => $request->upazila_id,
            'union_id' => $request->union_id,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'referral'=>$request->referral,
            'password' => Hash::make($request->password),
            'status' => 1,
            'user_type' => 4,

        ]);
        // dd($agent);

        if($agent) {
            $notify[] = ['success','agent added successfully!'];
            return redirect()->route('admin.agent')->withNotify($notify);
        }
    }

    public function show(User $agent)
    {
        $pageTitle = 'Show agent';

        //counter
        $totalReg = User::where('created_by',$agent->id)->count();
        $totalCustomer = User::where('user_type', '1')->where('created_by',$agent->id)->count();
        $totalProvider = User::where('user_type', '2')->where('created_by',$agent->id)->count();


                        // Retrieve customer IDs created by the Agent Id
                        $customerIds = User::where('created_by', $agent->id)
                            ->where('user_type', 1)
                            ->pluck('id')
                            ->toArray();
                
                        // Retrieve TripInfo records with status = "ordered" and associated with the customers created by the logged-in user
                    $totalRunningOrder = TripInfo::
                        whereIn('user_id', $customerIds)
                        ->where('status', 'in-progress')
                        ->where('vehicle_id', 1)
                        ->count();
                    $totalConfirmOrder = TripInfo::
                        whereIn('user_id', $customerIds)
                        ->where('status', 'ordered')
                        ->where('vehicle_id', 1)
                        ->count();
                    $totalCanceledOrder = TripInfo::
                        whereIn('user_id', $customerIds)
                        ->where('status', 'caneled')
                        ->where('vehicle_id', 1)
                        ->count();

        $customer_vendors = User::where('created_by',$agent->id)->whereIn('user_type',[1,2])->get();

        return view('admin.agent.show', compact('pageTitle','agent','customer_vendors','totalReg','totalCustomer','totalProvider','totalRunningOrder','totalConfirmOrder','totalCanceledOrder'));
    }

    public function edit(User $agent)
    {
        $pageTitle = 'Edit agent';
        $divisions = Division::get();
        return view('admin.agent.edit', compact('pageTitle','agent','divisions'));
    }

    public function update(Request $request, User $agent)
    {
        // $validated = $request->validate([
        //     'fname' => ['required'],
        //     'lname' => ['nullable'],
        //     'username' => ['required'],
        //     'email' => ['required', 'email'],
        //     'mobile' => ['required'],
        //     'designation' => ['nullable'],
        //     'division_id' => ['required'],
        //     'district_id' => ['required'],
        //     'upazila_id' => ['required'],
        //     'details' => ['nullable'],
        //     'experience' => ['nullable'],
        //     'qualification' => ['nullable'],
        //     'status' => ['required'],
        // ]);

        $agent->update([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'username' => $request->username,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'upazila_id' => $request->upazila_id,
            'union_id' => $request->union_id,
            'designation' => $request->designation,
            'details' => $request->details,
            'experience' => $request->experience,
            'qualification' => $request->qualification,
            'status' => $request->status,
        ]);

        if($agent) {
            $notify[] = ['success','agent updated successfully!'];
            return redirect()->route('admin.agent')->withNotify($notify);
        }
    }

    public function destroy(User $agent)
    {
        $agent->delete();

        $notify[] = ['success','agent deleted successfully!'];
        return redirect()->back()->withNotify($notify);
    }
}
