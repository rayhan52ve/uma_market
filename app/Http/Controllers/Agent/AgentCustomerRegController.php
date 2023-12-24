<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AgentCustomerRegController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = User::where('created_by',Auth::user()->id)->where('user_type', 1)->paginate(10);
    
        $employeeIds = $customers->pluck('created_by');
        $employeeNames = User::whereIn('id', $employeeIds)->pluck('fname', 'id');
    
        return view('agent.modules.registration.customer.index', compact('customers', 'employeeNames'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisions = Division::all();
        return view('agent.modules.registration.customer.create',compact('divisions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_type' => 'required|in:1,2',
            'fname' => 'required',
            // 'lname' => 'required',
            // 'username' => 'required|unique:users',
            'email' => 'nullable|email|unique:users',
            'mobile' => 'required|unique:users',
            'password' => 'required',
            'division_id' => 'required',
            'district_id' => 'nullable',
            'upazila_id' => 'nullable',
            'union_id' => 'nullable',
        ], [
            'fname.required' => 'First name is required',
            // 'lname.required' => 'Last name is required',
        ]);

        $slug = Str::slug($request->username);


        $user = $this->createUser($request, $slug);

        $user->save();

        session()->flash('msg','Customer Registration Successsfull');
        session()->flash('cls','success');
        return redirect()->route('agent-customer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        $customer = User::find($id);
        $customer->destroy($id);
        session()->flash('msg','Customer Deleted Successfully');
        session()->flash('cls','success');
        return redirect()->back();
    }

    public function createUser($request, $slug)
    {

        return User::create([
            'user_type' => $request->user_type,
            'fname' => $request->fname,
            // 'lname' => $request->lname,
            // 'username' => $request->username,
            'email' => $request->email,
            'status' => 1,
            'mobile' => $request->mobile,
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'upazila_id' => $request->upazila_id,
            'union_id' => $request->union_id,
            'mobile_verified_at' => Carbon ::now(),
            'created_by' => $request->created_by,
            'password' => bcrypt($request->password),
            'slug' => $slug
        ]);
    }

}

