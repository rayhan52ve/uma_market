<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\GeneralSetting;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AgentVendorRegController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = User::where('created_by',Auth::user()->id)->where('user_type',2)->paginate(10);

        $employeeIds = $vendors->pluck('created_by');
        $employeeNames = User::whereIn('id', $employeeIds)->pluck('fname', 'id');

        return view('agent.modules.registration.vendor.index',compact('vendors', 'employeeNames'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisions = Division::all();
        return view('agent.modules.registration.vendor.create',compact('divisions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_details = new UserDetail();
        $general = GeneralSetting::first();

        $request->validate([
            // 'user_type' => 'required|in:1,2',
            'fname' => 'required',
            // 'lname' => 'required',
            // 'username' => 'required|unique:users',
            'email' => 'nullable|email|unique:users',
            // 'mobile' => 'required|unique:users',
            'nid_no' => 'required',
            'nid_front' => 'required|image|mimes:jpg,png,jpeg',
            'nid_back' => 'required|image|mimes:jpg,png,jpeg',
            'password' => 'required',
            'division_id' => 'required',
            'district_id' => 'nullable',
            'upazila_id' => 'nullable',
            'union_id' => 'nullable',
            // 'g-recaptcha-response' => Rule::requiredIf($general->allow_recaptcha == 1)
        ], [
            'fname.required' => 'First name is required',
            // 'lname.required' => 'Last name is required',
            // 'g-recaptcha-response.required' => 'You Have To fill recaptcha'
        ]);

        $slug = Str::slug($request->username);


        $user = $this->createUser($request, $slug);

        $user_details->user_id = $user->id;
        $user_details->nid_no = $request->nid_no;
        if ($request->hasFile('nid_front')) {
            $filename = uploadImage($request->nid_front, filePath('user_details'), $user->nid_front);
            $user_details->nid_front = $filename;
        }

        if ($request->hasFile('nid_back')) {
            $filename = uploadImage($request->nid_back, filePath('user_details'), $user->nid_back);
            $user_details->nid_back = $filename;
        }

        $user_details->save();

        $user->save();

        session()->flash('msg','Vendor Created Successfully');
        session()->flash('cls','success');
        return redirect()->route('agent-vendor.index');
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
        $vendor = User::find($id);
        $vendor->destroy($id);
        session()->flash('msg','Vendor Deleted Successfully');
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
            'status' => 1,
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'upazila_id' => $request->upazila_id,
            'union_id' => $request->union_id,
            'created_by' => $request->created_by,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'mobile_verified_at' => Carbon::now(),
            'password' => bcrypt($request->password),
            'slug' => $slug
        ]);
    }

}
