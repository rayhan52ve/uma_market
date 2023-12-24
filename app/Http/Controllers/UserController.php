<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Bidding;
use App\Models\Booking;
use App\Models\Chat;
use App\Models\GeneralSetting;
use App\Models\Review;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\TripInfo;
use App\Models\Division;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Vehicle;
use App\Models\Withdraw;
use App\Models\WithdrawLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Nette\Utils\Random;
use Purifier;

use Illuminate\Pagination\Paginator;


class UserController extends Controller
{
    public function dashboard()
    {
        $pageTitle = 'DashBoard';
        $divisions = Division::all();

        $user = auth()->user();

        if ($user->user_type == 2) {
            $balance = $user->balance;
            $service = $user->services->first();

            if ($service) {
                $vehicle_id = Vehicle::where('name', $service->vehicle)->first()->id;

                return redirect()->route('user.vehicle.dashboard', $vehicle_id);
            }

            $jobCompleted = Booking::where('is_completed', 1)->whereHas('service', function ($q) {
                $q->where('user_id', auth()->id());
            })->count();

            $serve = Service::where('user_id', $user->id)->pluck('id')->toArray();

            $myRatings = Review::whereIn('service_id', $serve)->avg('review');


            $services = Service::where('user_id', $user->id)->paginate(10);


            $bookings = Booking::whereHas('service', function ($q) {
                $q->where('user_id', auth()->id());
            })->latest()->with('user', 'service')->paginate(10);

            $current_trips = TripInfo::whereIn('id', Bidding::where('status', 1)->where('provider_id', auth()->user()->id)->pluck('trip_id'))->paginate(10);
            $vehicleTypes = Vehicle::all();

            return view('frontend.user.dashboard', compact('current_trips', 'pageTitle', 'balance', 'service', 'jobCompleted', 'services', 'myRatings', 'bookings', 'vehicleTypes', 'divisions'));
        }

        if ($user->user_type == 1) {

            $booking = Booking::where('user_id', $user->id)->count();
            $bookingPending = Booking::where('user_id', $user->id)->where('is_accepted', 0)->count();
            $bookingComplete = Booking::where('user_id', $user->id)->where('is_completed', 1)->count();
            $totalTransactionAmount = Transaction::where('user_id', $user->id)->sum('amount');
            $totalTransactionCharge = Transaction::where('user_id', $user->id)->sum('charge');

            $totalTransaction = $totalTransactionAmount + $totalTransactionCharge;

            $bookings = Booking::whereHas('service')->where('user_id', $user->id)->latest()->paginate();
            $total_trips = TripInfo::where('user_id', auth()->user()->id)->count();
            $total_ordered_trips = TripInfo::where('user_id', auth()->user()->id)->where('status', 'ordered')->count();
            $total_in_progress_trips = TripInfo::where('user_id', auth()->user()->id)->where('status', 'in-progress')->count();
            $total_completed_trips = TripInfo::where('user_id', auth()->user()->id)->where('status', 'completed')->count();
            $all_trips = TripInfo::withCount('bids')->where('user_id', auth()->user()->id)->latest()->get()->take(5);

            return view('frontend.user.customer.customer_dashboard', compact('all_trips', 'pageTitle', 'booking', 'bookingPending', 'bookingComplete', 'totalTransaction', 'bookings', 'total_trips', 'total_ordered_trips', 'total_in_progress_trips', 'total_completed_trips', 'divisions'));
        }
    }

    public function vehicleDashboard($vehicle_id)
    {
        $pageTitle = 'DashBoard';
        $user = auth()->user();
        $vehicle = Vehicle::find($vehicle_id)->name;
        $vehicleTypes = Vehicle::all();

        $all_bid_trips = TripInfo::query()
            ->with(['vehicle', 'customer'])
            ->where('vehicle_id', $vehicle_id)
            ->whereIn('id', Bidding::query()
                ->where('provider_id', $user->id)
                ->pluck('trip_id'))
            ->paginate(10);

        $current_trips = TripInfo::query()
            ->with(['vehicle', 'customer'])
            ->whereIn('id', Bidding::query()
                ->where('status', 1)
                ->where('provider_id', $user->id)
                ->pluck('trip_id'))
            ->where('vehicle_id', $vehicle_id)
            ->where('starting_date', '>', Carbon::yesterday())
            ->where('starting_date', '<', Carbon::tomorrow())
            ->paginate(10);

        $pending_trips = TripInfo::query()
            ->with(['vehicle', 'customer'])
            ->whereIn('id', Bidding::query()
                ->where('status', 1)
                ->where('provider_id', $user->id)
                ->pluck('trip_id'))
            ->where('vehicle_id', $vehicle_id)
            ->where('starting_date', '>=', Carbon::tomorrow())
            ->paginate(10);

        $completed_trips = TripInfo::query()
            ->with(['vehicle', 'customer'])
            ->whereIn('id', Bidding::query()
                ->where('provider_id', $user->id)
                ->pluck('trip_id'))
            ->where('vehicle_id', $vehicle_id)
            ->where('status', 'completed')
            ->paginate(10);

        $requested_trips =  TripInfo::query()
            ->with(['vehicle', 'customer'])
            ->whereHas('bids')
            ->whereIn('id', Bidding::query()
                ->where('status', 0)
                ->where('provider_id', $user->id)
                ->pluck('trip_id'))
            ->where('vehicle_id', $vehicle_id)
            ->paginate(10);

        $rejected_trips = TripInfo::query()
            ->with(['vehicle', 'customer'])
            ->whereHas('bids')
            ->whereIn('id', Bidding::query()
                ->where('status', 3)
                ->where('provider_id', $user->id)
                ->pluck('trip_id'))
            ->where('vehicle_id', $vehicle_id)
            ->paginate(10);

        return view('frontend.user.vehicle_dashboard', compact('pageTitle', 'vehicle_id', 'vehicleTypes', 'all_bid_trips', 'current_trips', 'rejected_trips', 'completed_trips', 'requested_trips', 'pending_trips', 'vehicle'));
    }

    public function vehicleTripDashboard($vehicle_id)
    {
        $pageTitle = 'AllTrips';
        $user = auth()->user();
        $vehicle = Vehicle::find($vehicle_id)->name;
        $vehicleTypes = Vehicle::all();
        $generalSetting = GeneralSetting::first();

        // $current_trips = TripInfo::query()
        //     ->with(['vehicle', 'customer'])
        //     ->join('biddings', 'trip_infos.id', '=', 'biddings.trip_id')
        //     ->whereIn('trip_infos.id', Bidding::query()
        //         ->where('status', 1)
        //         ->where('provider_id', $user->id)
        //         ->pluck('trip_id'))
        //     ->where('vehicle_id', $vehicle_id)
        //     ->where('biddings.provider_id', auth()->user()->id)
        //     ->select('trip_infos.*', 'biddings.id as bidding_id', 'biddings.bid_amount')
        //     ->paginate(10);

        $current_trips = TripInfo::with(['vehicle', 'customer', 'biddings'])
        ->where('vehicle_id', $vehicle_id)
        ->where('status', 'in-progress')
        ->whereRelation('biddings', 'provider_id', auth()->user()->id)
        ->whereRelation('biddings', 'status', 1)
        ->paginate(10);
        // dd($current_trips);

        // $current_trips = TripInfo::query()
        //     ->with(['vehicle', 'customer'])
        //     ->whereIn('id', Bidding::query()
        //         ->where('provider_id', $user->id)
        //         ->pluck('trip_id'))
        //     ->where('vehicle_id', $vehicle_id)
        //     ->where('status', 'in-progress')
        //     ->select('trip_infos.*', 'biddings.id as bidding_id', 'biddings.bid_amount')
        //     ->paginate(10);

        $pending_trips = TripInfo::query()
            ->with(['vehicle', 'customer'])
            ->whereIn('id', Bidding::query()
                ->where('status', 1)
                ->where('provider_id', $user->id)
                ->pluck('trip_id'))
            ->where('vehicle_id', $vehicle_id)
            ->where('starting_date', '>=', Carbon::tomorrow())
            ->paginate(10);

        $completed_trips = TripInfo::query()
            ->with(['vehicle', 'customer'])
            ->whereIn('id', Bidding::query()
                ->where('provider_id', $user->id)
                ->pluck('trip_id'))
            ->where('vehicle_id', $vehicle_id)
            ->where('status', 'completed')
            ->paginate(10);

        $requested_trips =  TripInfo::query()
            ->with(['vehicle', 'customer'])
            ->whereHas('bids')
            ->whereIn('id', Bidding::query()
                ->where('status', 0)
                ->where('provider_id', $user->id)
                ->pluck('trip_id'))
            ->where('vehicle_id', $vehicle_id)
            ->paginate(10);

        $canceled_trips = TripInfo::query()
            ->with(['vehicle', 'customer'])
            ->whereHas('bids')
            ->whereIn('id', Bidding::query()
                ->where('provider_id', $user->id)
                ->pluck('trip_id'))
            ->where('vehicle_id', $vehicle_id)
            ->where('status', 'canceled')
            ->paginate(10);

        return view('frontend.user.vehicle_trip_dashboard', compact('pageTitle', 'vehicle_id', 'vehicleTypes',  'current_trips', 'canceled_trips', 'completed_trips', 'requested_trips', 'pending_trips', 'vehicle', 'generalSetting'));
    }


    public function vehicleBidTrips($vehicle_id)
    {

        $pageTitle = 'DashBoard';
        $user = auth()->user();
        $vehicle = Vehicle::find($vehicle_id)->name;
        $vehicleTypes = Vehicle::all();


        // $all_bid_trips = TripInfo::query()
        //     ->with(['vehicle', 'customer'])
        //     ->where('vehicle_id', $vehicle_id)
        //     ->whereIn('id', Bidding::query()
        //         ->where('provider_id', $user->id)
        //         ->pluck('trip_id'))
        //     ->join('')
        //     ->get();

        $all_bids = Bidding::with('trip', 'trip.customer')->where('provider_id', auth()->id())->join('trip_infos', 'biddings.trip_id', '=', 'trip_infos.id')->where('trip_infos.vehicle_id', $vehicle_id)->select('trip_infos.*', 'biddings.*')->orderBy('biddings.created_at')->get();

        return view('frontend.user.vehicle_bid_trips', compact('pageTitle', 'vehicle_id', 'vehicleTypes', 'all_bids',  'vehicle'));
    }

    public function profile()
    {
        $divisions = Division::all();
        $pageTitle = 'Profile Setting';
        $vehicles = Vehicle::all();
        // $vehicles = Vehicle::all();
        $user = auth()->user();
        $user_details = UserDetail::where('user_id', auth()->user()->id)->first();
        $vendordetails = User::where('id', auth()->user()->id)->first();
        // dd($user_details);
        // dd($vendordetails->division->name);

        return view('frontend.user.profile', compact('pageTitle', 'user', 'vehicles', 'user_details', 'divisions', 'vendordetails'));
    }

    public function profileUpdate(Request $request, $id)
    {

        $user = User::find($id);

        $request->validate([
            'name' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,jfif,webp',
        ]);

        $user->fname = $request->name;
        if ($request->hasFile('image')) {
            $filename = uploadImage($request->image, filePath('user'), $user->image);
            $user->image = $filename;
            $user->save();
        }
        // dd($user);

        if ($user->save()) {
            // if (UserDetail::where('user_id', $id)->first()) {
            $user_details = UserDetail::where('user_id', $id)->first();
            // } else {
            //     $user_details = new UserDetail();
            // }

            if ($user->user_type == 1) {

                $user_details = User::where('id', $id)->first();
                $user1 = UserDetail::where('user_id', $id)->first();
                // dd($user);
                if ($request->hasFile('image')) {
                    $filename = uploadImage($request->image, filePath('user'), $user_details->image);
                    $user_details->fname = $request->name;
                    $user_details->image = $filename;
                    $user_details->save();
                }
                if ($request->has('address') && $user1 !== null) {
                    $user1->address = $request->address;
                    $user1->save(); // Save the changes to the UserDetail model
                }
            }


            if ($user->user_type == 2) {
                // dd($user);

                $request->validate([
                    'nid_front' => 'image|mimes:jpg,png,jpeg',
                    'nid_back' => 'image|mimes:jpg,png,jpeg',
                    'company_address' => 'required'
                ]);

                if ($request->provider_type == 'ড্রাইভার') {
                    if ($user_details->driving_license_front == '' || $user_details->driving_license_back == '') {
                        $request->validate([
                            'driving_license_front' => 'required|image|mimes:jpg,png,jpeg',
                            'driving_license_back' => 'required|image|mimes:jpg,png,jpeg'
                        ]);
                    }
                }

                $user_details->user_id = $id;
                $user_details->provider_type = $request->provider_type;
                $user_details->company_name = $request->company_name;
                $user_details->company_address = $request->company_address;
                // dd($user_details);
                $user_details->driving_experience = $request->driving_experience;

                if ($request->hasFile('nid_front')) {
                    $filename = uploadImage($request->nid_front, filePath('user_details'), $user->nid_front);
                    $user_details->nid_front = $filename;
                }

                if ($request->hasFile('nid_back')) {
                    $filename = uploadImage($request->nid_back, filePath('user_details'), $user->nid_back);
                    $user_details->nid_back = $filename;
                }

                if ($request->hasFile('driving_license_front')) {
                    $filename = uploadImage($request->driving_license_front, filePath('user_details'), $user->driving_license_front);
                    $user_details->driving_license_front = $filename;
                }

                if ($request->hasFile('driving_license_back')) {
                    $filename = uploadImage($request->driving_license_back, filePath('user_details'), $user->driving_license_back);
                    $user_details->driving_license_back = $filename;
                }
                // dd($request);
                if (
                    $request->has('division_id') && $request->has('district_id')
                    && $request->has('upazila_id') && $request->has('union_id')
                ) {
                    $request->validate([
                        'division_id' => 'required',
                        'district_id' => 'required',
                        'upazila_id' => 'required',
                        'union_id' => 'required'
                    ]);
                    // dd($request);

                    $useraddress = User::where('id', $id)->first();
                    $useraddress->division_id = $request->division_id;
                    $useraddress->district_id = $request->district_id;
                    $useraddress->upazila_id = $request->upazila_id;
                    $useraddress->union_id = $request->union_id;
                    // dd( $useraddress);
                    $useraddress->save();
                }

                $user_details->save();
                // dd($request);
            }

            $notify[] = ['success', 'Successfully Updated Profile'];

            return back()->withNotify($notify);
        }
    }

    public function changePassword()
    {
        $divisions = Division::all();
        $pageTitle = "Change Password";

        return view('frontend.user.change_password', compact('pageTitle', 'divisions'));
    }

    public function changePasswordUpdate(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        $user = auth()->user();

        if (Hash::check($request->current_password, $user->password)) {
            $user->password = bcrypt($request->password);
            $user->save();
            $notify[] = ['success', 'Password changed Successfully'];
        } else {
            $notify[] = ['error', 'Current password is wrong!'];
        }

        return back()->withNotify($notify);
    }

    public function transaction()
    {
        Paginator::useBootstrap();

        $divisions = Division::all();
        $pageTitle = "Transactions";

        $transactions = Transaction::where('user_id', auth()->id())->latest()->with('user')->paginate(10);

        return view('frontend.user.transaction', compact('pageTitle', 'transactions', 'divisions'));
    }

    public function withdraw()
    {
        $pageTitle = 'Withdraw Money';

        $withdraws = Withdraw::where('status', 1)->latest()->get();

        return view('frontend.user.provider.withdraw', compact('pageTitle', 'withdraws'));
    }

    public function withdrawCompleted(Request $request)
    {

        $request->validate([
            'method' => 'required|integer',
            'amount' => 'required|numeric',
            'final_amo' => 'required|numeric',
            'email' => 'required|email'
        ]);

        $withdraw = Withdraw::findOrFail($request->method);

        if (auth()->user()->balance < $request->final_amo) {
            $notify[] = ['error', 'Insuficient Balance'];

            return back()->withNotify($notify);
        }

        if ($request->final_amo < $withdraw->min_withdraw || $request->final_amo > $withdraw->max_withdraw) {
            $notify[] = ['error', 'Please follow the withdraw limits'];

            return back()->withNotify($notify);
        }

        if ($withdraw->charge_type == 'percent') {

            $total = $request->amount + ($withdraw->charge * $request->amount) / 100;
        } else {
            $total = $request->amount + $withdraw->charge;
        }

        if ($total != $request->final_amo) {
            $notify[] = ['error', 'Invalid Amount'];

            return back()->withNotify($notify);
        }



        auth()->user()->balance = auth()->user()->balance - $total;
        auth()->user()->save();


        $data = [
            'email' => $request->email,
            'account_information' => Purifier::clean($request->account_information),
            'note' => Purifier::clean($request->note)
        ];


        $mailData = WithdrawLog::create([
            'user_id' => auth()->id(),
            'withdraw_gateway_id' => $request->method,
            'trx' => strtoupper(Random::generate(15)),
            'user_data' => $data,
            'charge' => $withdraw->charge,
            'amount' => $total,
            'balance_remains' => auth()->user()->balance,
            'status' => 0
        ]);

        $admin = Admin::first();

        sendMail('WITHDRAW_BALANCE', ['trx' => $mailData->trx, 'amount' => $mailData->amount, 'user' => auth()->user()->fullname, 'method' => $withdraw->name], $admin);


        $notify[] = ['success', 'Withdraw Successfully done'];

        return back()->withNotify($notify);
    }

    public function withdrawFetch(Request $request)
    {
        $withdraw = Withdraw::findOrFail($request->id);

        return $withdraw;
    }

    public function allWithdraw()
    {
        $pageTitle = 'All withdraw';

        $withdrawlogs = WithdrawLog::where('user_id', auth()->id())->latest()->with('withdraw')->paginate(10);

        return view('frontend.user.provider.withdraw_all', compact('pageTitle', 'withdrawlogs'));
    }

    public function pendingWithdraw()
    {
        $pageTitle = 'Pending withdraw';

        $withdrawlogs = WithdrawLog::where('user_id', auth()->id())->where('status', 0)->latest()->with('withdraw')->paginate(10);

        return view('frontend.user.provider.withdraw_pending', compact('pageTitle', 'withdrawlogs'));
    }

    public function chat(Request $request)
    {

        $booking = Booking::where('trx', $request->transaction)->first();

        if ($booking->job_end == 1) {
            $notify[] = ['error', 'Job Expired'];

            return back()->withNotify($notify);
        }

        $pageTitle = "Chat with {$booking->user->fullname}";

        $chats  = Chat::where('provider_id', auth()->id())->where('user_id', $booking->user->id)->where('booking_id', $booking->id)->get();

        return view('frontend.user.provider.chat', compact('pageTitle', 'booking', 'chats'));
    }

    public function chatSend(Request $request)
    {
        $booking = Booking::where('trx', $request->transaction)->first();

        $request->validate([
            'message' => 'required',
            'user' => 'required',
            'provider' => 'required'
        ]);

        Chat::create([
            'message' => $request->message,
            'user_id' => $request->user,
            'booking_id' => $booking->id,
            'provider_id' => $request->provider,
            'sender' => 'provider'
        ]);

        sendMail("SEND_MESSAGE", ['user' => $booking->service->user->fullname, 'message' => $request->message], $booking->user);


        $notify[] = ['success', 'Message Send Successfully'];

        return back()->withNotify($notify);
    }


    public function chatProvider(Request $request)
    {

        $booking = Booking::where('trx', $request->transaction)->first();

        if ($booking->job_end == 1) {
            $notify[] = ['error', 'Job Expired'];

            return back()->withNotify($notify);
        }

        $pageTitle = "Chat with {$booking->service->user->fullname}";

        $chats  = Chat::where('provider_id', $booking->service->user->id)->where('user_id', auth()->id())->where('booking_id', $booking->id)->get();


        return view('frontend.user.chat_user', compact('pageTitle', 'booking', 'chats'));
    }

    public function chatSendProvider(Request $request)
    {
        $booking = Booking::where('trx', $request->transaction)->first();

        $request->validate([
            'message' => 'required',
            'user' => 'required',
            'provider' => 'required'
        ]);

        Chat::create([
            'message' => $request->message,
            'user_id' => $request->user,
            'provider_id' => $request->provider,
            'sender' => 'user',
            'booking_id' => $booking->id,
        ]);

        sendMail("SEND_MESSAGE", ['user' => $booking->user->fullname, 'message' => $request->message], $booking->service->user);


        $notify[] = ['success', 'Message Send Successfully'];

        return back()->withNotify($notify);
    }
}
