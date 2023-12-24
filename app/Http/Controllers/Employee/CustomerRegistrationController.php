<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
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

class CustomerRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = User::where('created_by', Auth::user()->id)->where('user_type', 1)->paginate(10);
        return view('employee.modules.registration.customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisions = Division::all();
        return view('employee.modules.registration.customer.create', compact('divisions'));
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
            // 'mobile_verified_at' => Carbon::now(),
        ], [
            'fname.required' => 'First name is required',
            // 'lname.required' => 'Last name is required',
        ]);
        $slug = Str::slug($request->username);


        $user = $this->createUser($request, $slug);


        $worksheet = Worksheet::where('employee_id', Auth::user()->id)->whereDate('created_at', Carbon::today())->first();

        if ($worksheet) {
            $worksheet->target_achive += 1;
            $worksheet->save();
        } else {

        }

        $user->save();

        session()->flash('msg', 'Customer Registration Successsfull');
        session()->flash('cls', 'success');
        return redirect()->route('employee-customer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trucks = TripInfo::with('customer')->where('vehicle_id',1)->where('user_id',$id)->paginate(10);
        $buses = TripInfo::with('customer')->where('vehicle_id',10)->where('user_id',$id)->paginate(10);
        $cars = TripInfo::with('customer')->where('vehicle_id',2)->where('user_id',$id)->paginate(10);  
        $micros = TripInfo::with('customer')->where('vehicle_id',3)->where('user_id',$id)->paginate(10);  
        $ambulances = TripInfo::with('customer')->where('vehicle_id',4)->where('user_id',$id)->paginate(10);  
        $motor_cycles = TripInfo::with('customer')->where('vehicle_id',5)->where('user_id',$id)->paginate(10);  
        $cngs = TripInfo::with('customer')->where('vehicle_id',6)->where('user_id',$id)->paginate(10);  
        $vans = TripInfo::with('customer')->where('vehicle_id',7)->where('user_id',$id)->paginate(10);  
        $mahindras = TripInfo::with('customer')->where('vehicle_id',8)->where('user_id',$id)->paginate(10);  
        $easy_bikes = TripInfo::with('customer')->where('vehicle_id',9)->where('user_id',$id)->paginate(10);  
        return view('employee.modules.registration.customer.show', compact( 'trucks', 'buses', 'cars','micros','ambulances','motor_cycles','cngs','vans','mahindras','easy_bikes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $customer = User::find($id);
        // return view('employee.modules.registration.customer.edit',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, User $users)
    {
        // dd($request);
        // $request->validate([
        //     // 'user_type' => 'required|in:1,2',
        //     'fname' => 'required',
        //     // 'lname' => 'required',
        //     // 'username' => 'required|unique:users',
        //     // 'email' => 'nullable|email|unique:users,'.$users->id,
        //     // 'mobile' => 'required|unique:users,'.$users->id,
        //     // 'password' => 'required',
        // ], [
        //     'fname.required' => 'First name is required',
        //     // 'lname.required' => 'Last name is required',
        // ]);

        // $slug = Str::slug($request->username);


        // $user = $this->createUser($request, $slug);

        // $user->update();

        // session()->flash('msg','Customer Registration Successsfull');
        // session()->flash('cls','success');
        // return redirect()->route('employee-customer.index');
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
        session()->flash('msg', 'Customer Deleted Successfully');
        session()->flash('cls', 'success');
        return redirect()->back();
    }

    public function createUser($request, $slug)
    {

        return User::create([
            'user_type' => $request->user_type,
            // 'status' => $request->status,
            'fname' => $request->fname,
            // 'lname' => $request->lname,
            // 'username' => $request->username,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'status' => 1,
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'upazila_id' => $request->upazila_id,
            'union_id' => $request->union_id,
            'mobile_verified_at' => Carbon::now(),
            'created_by' => $request->created_by,
            'password' => bcrypt($request->password),
            'slug' => $slug
        ]);
    }
}
