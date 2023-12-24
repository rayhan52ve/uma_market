<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\TripInfo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;



class AgentDashboardController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $vendors = User::createdby()->serviceprovider()->get();
        $customers = User::createdby()->customer()->get();
        // dd(TripInfo::confirmorder()->get());
        $totalConfirmedOrders = 0;
        $totalRunningOrders = 0;
        $totalCancelOrders = 0;
        // dd(TripInfo::all());

        foreach($vendors as $vendor)
        {
            $vendorConfirmedOrders = TripInfo::confirmOrder()->where('user_id',$vendor->id)->count();
            $totalConfirmedOrders += $vendorConfirmedOrders;
            $vendorRunningOrders = TripInfo::runningOrder()->where('user_id',$vendor->id)->count();
            $totalRunningOrders += $vendorRunningOrders;
            $vendorCancelOrders = TripInfo::cancelOrder()->where('user_id',$vendor->id)->count();
            $totalCancelOrders += $vendorCancelOrders;
        }

        foreach($customers as $customer)
        {
            $customerConfirmedOrders = TripInfo::confirmorder()->where('user_id',$customer->id)->count();
            $totalConfirmedOrders += $customerConfirmedOrders;
            $customerRunningOrders = TripInfo::runningorder()->where('user_id',$customer->id)->count();
            $totalRunningOrders += $customerRunningOrders;
            $customerCancelOrders = TripInfo::cancelorder()->where('user_id',$customer->id)->count();
            $totalCancelOrders += $customerCancelOrders;
        }

        $totalReg = User::where('created_by',Auth::user()->id)->count();
        $totalCustomer = User::where('user_type', '1')->where('created_by',Auth::user()->id)->count();
        $totalProvider = User::where('user_type', '2')->where('created_by',Auth::user()->id)->count();
        return view('agent.dashboard', compact('totalReg', 'totalCustomer', 'totalProvider','totalConfirmedOrders','totalRunningOrders','totalCancelOrders'));
    }

    public function profile(){
        return view('agent.modules.profile.profile');
    }

    public function edit_profile(){
        return view('agent.modules.profile.edit_profile');
    }

    public function profile_update(Request $request, $id){
        if($request->isMethod('PUT')){
            $user  = User::find($id);
            if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');

                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    @unlink(public_path('uploads/profile' .$user->image));
                    $image_name = $image_tmp->getClientOriginalName();
                    // $extension = $image_tmp->getClientOriginalExtension();
                    // $fileName = $image_name . '-' . rand(111, 99999) . '.' . $extension;
                    $image_path = 'backend/images/user' . '/' . $image_name;

                    Image::make($image_tmp)->resize(1000, 1000)->save($image_path);

                }
            }elseif(Auth::user()->image){
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
        $notify[] = ['success','Profile Updated Successfully.'];
        return redirect()->route('agent.profile')->withNotify($notify);
    }


    public function password(){
        return view('agent.modules.profile.changepass');

    }

    public function changePassword(Request $request){
        $request->validate([
            'current_password' => ['required','string','min:4'],
            'password' => ['required', 'string', 'min:4', 'confirmed']
        ]);

        $currentPasswordStatus = Hash::check($request->current_password, Auth::user()->password);
        if($currentPasswordStatus){

            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password),
            ]);

            $notify[] = ['success','Password Updated Successfully.'];
            return redirect()->route('agent.profile')->withNotify($notify);

        }else{

            return redirect()->back()->with('message','Current Password does not match with Old Password');
        }
    }


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

        return view('agent.modules.order.confirm_order', compact('trucks', 'buses', 'cars','micros','ambulances','motor_cycles','cngs','vans','mahindras','easy_bikes'));
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

        return view('agent.modules.order.running_order', compact('trucks', 'buses', 'cars','micros','ambulances','motor_cycles','cngs','vans','mahindras','easy_bikes'));
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

        return view('agent.modules.order.cancel_order', compact('trucks', 'buses', 'cars','micros','ambulances','motor_cycles','cngs','vans','mahindras','easy_bikes'));
    }

    public function performance(){
        return view('agent.modules.performance');
    }



    public function search(Request $request)
    {
        $pageTitle = 'All agents';

        $search = $request->search;

        $employee = User::when($search, function($q) use($search){
            $q->where('referral', '=', $search);
        })->where('user_type',3)->first();
// dd( $employee);
        if (!$employee) {
            $notify[] = ['error', 'No agent found with the provided referral code.'];

            return redirect()->route('agent.index1')->withNotify($notify);

            // return redirect()->route('agent.index1')->with('message', 'No agent found with the provided referral code.');
        }


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
        return view('agent.search', compact('pageTitle', 'employee', 'totalCustomer', 'totalProvider', 'confirmedOrders','all_trips', 'current_trips', 'canceled_trips', 'pending_trips', 'previous_trips'));
    }


public function agentindex(Request $request){
    // dd($request);
    return view('agent.index');

}

}
