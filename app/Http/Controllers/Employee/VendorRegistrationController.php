<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Bidding;
use App\Models\Division;
use App\Models\GeneralSetting;
use App\Models\TripInfo;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Worksheet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;


class VendorRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = User::where('created_by', Auth::user()->id)->where('user_type', 2)->paginate(10);
        return view('employee.modules.registration.vendor.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisions = Division::all();
        return view('employee.modules.registration.vendor.create', compact('divisions'));
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
        $worksheet = Worksheet::where('employee_id', Auth::user()->id)->whereDate('created_at', Carbon::today())->first();

        if ($worksheet) {
            $worksheet->target_achive += 1;
            $worksheet->save();
        } else {
        }

        $user_details->save();

        $user->save();

        session()->flash('msg', 'Vendor Created Successfully');
        session()->flash('cls', 'success');
        return redirect()->route('vendor.index');
    }





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trucks = TripInfo::with('customer')
        ->where('vehicle_id',1)
        ->with(['vehicle', 'customer'])
        ->whereIn('id', Bidding::query()
            ->where('status', 1)
            ->where('provider_id', $id)
            ->pluck('trip_id'))
            ->paginate(10);

        $buses = TripInfo::with('customer')
        ->where('vehicle_id',10)
        ->with(['vehicle', 'customer'])
        ->whereIn('id', Bidding::query()
            ->where('status', 1)
            ->where('provider_id', $id)
            ->pluck('trip_id'))
            ->paginate(10);
        $cars = TripInfo::with('customer')
        ->where('vehicle_id',2)
        ->with(['vehicle', 'customer'])
        ->whereIn('id', Bidding::query()
            ->where('status', 1)
            ->where('provider_id', $id)
            ->pluck('trip_id'))
            ->paginate(10);  
        $micros = TripInfo::with('customer')
        ->where('vehicle_id',3)
        ->with(['vehicle', 'customer'])
        ->whereIn('id', Bidding::query()
            ->where('status', 1)
            ->where('provider_id', $id)
            ->pluck('trip_id'))->paginate(10);  
        $ambulances = TripInfo::with('customer')
        ->where('vehicle_id',4)
        ->with(['vehicle', 'customer'])
        ->whereIn('id', Bidding::query()
            ->where('status', 1)
            ->where('provider_id', $id)
            ->pluck('trip_id'))->paginate(10);  
        $motor_cycles = TripInfo::with('customer')
        ->where('vehicle_id',5)
        ->with(['vehicle', 'customer'])
        ->whereIn('id', Bidding::query()
            ->where('status', 1)
            ->where('provider_id', $id)
            ->pluck('trip_id'))->paginate(10);  
        $cngs = TripInfo::with('customer')
        ->where('vehicle_id',6)
        ->with(['vehicle', 'customer'])
        ->whereIn('id', Bidding::query()
            ->where('status', 1)
            ->where('provider_id', $id)
            ->pluck('trip_id'))->paginate(10);  
        $vans = TripInfo::with('customer')
        ->where('vehicle_id',7)
        ->with(['vehicle', 'customer'])
        ->whereIn('id', Bidding::query()
            ->where('status', 1)
            ->where('provider_id', $id)
            ->pluck('trip_id'))->paginate(10);  
        $mahindras = TripInfo::with('customer')
        ->where('vehicle_id',8)
        ->with(['vehicle', 'customer'])
        ->whereIn('id', Bidding::query()
            ->where('status', 1)
            ->where('provider_id', $id)
            ->pluck('trip_id'))->paginate(10);  
        $easy_bikes = TripInfo::with('customer')
        ->where('vehicle_id',9)
        ->with(['vehicle', 'customer'])
        ->whereIn('id', Bidding::query()
            ->where('status', 1)
            ->where('provider_id', $id)
            ->pluck('trip_id'))->paginate(10);  
        return view('employee.modules.registration.vendor.show', compact( 'trucks', 'buses', 'cars','micros','ambulances','motor_cycles','cngs','vans','mahindras','easy_bikes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $vendor = User::find($id);
        // return view('employee.modules.registration.vendor.edit',compact('vendor'));
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

        // $user_details = new UserDetail();
        // $general = GeneralSetting::first();

        // $request->validate([
        //     // 'user_type' => 'required|in:1,2',
        //     'fname' => 'required',
        //     // 'lname' => 'required',
        //     // 'username' => 'required|unique:users',
        //     'email' => 'nullable|email|unique:users',
        //     // 'mobile' => 'required|unique:users',
        //     'nid_no' => 'required',
        //     'nid_front' => 'required|image|mimes:jpg,png,jpeg',
        //     'nid_back' => 'required|image|mimes:jpg,png,jpeg',
        //     'password' => 'required',
        //     // 'g-recaptcha-response' => Rule::requiredIf($general->allow_recaptcha == 1)
        // ], [
        //     'fname.required' => 'First name is required',
        //     // 'lname.required' => 'Last name is required',
        //     // 'g-recaptcha-response.required' => 'You Have To fill recaptcha'
        // ]);

        // $slug = Str::slug($request->username);


        // $user = $this->createUser($request, $slug);

        // $user_details->user_id = $user->id;
        // $user_details->nid_no = $request->nid_no;
        // if ($request->hasFile('nid_front')) {
        //     $filename = uploadImage($request->nid_front, filePath('user_details'), $user->nid_front);
        //     $user_details->nid_front = $filename;
        // }

        // if ($request->hasFile('nid_back')) {
        //     $filename = uploadImage($request->nid_back, filePath('user_details'), $user->nid_back);
        //     $user_details->nid_back = $filename;
        // }

        // $user_details->update();

        // $user->update();

        // session()->flash('msg','Vendor Created Successfully');
        // session()->flash('cls','success');
        // return redirect()->route('vendor.index');
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
        session()->flash('msg', 'Vendor Deleted Successfully');
        session()->flash('cls', 'success');
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
            'mobile_verified_at' => Carbon::now(),
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'upazila_id' => $request->upazila_id,
            'union_id' => $request->union_id,
            'created_by' => $request->created_by,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => bcrypt($request->password),
            'slug' => $slug
        ]);
    }
}
