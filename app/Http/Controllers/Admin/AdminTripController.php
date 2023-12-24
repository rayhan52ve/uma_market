<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidding;
use App\Models\TripInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;

class AdminTripController extends Controller
{
    public function index()
    {

        $pageTitle = 'All Trips';
        $all_trips = TripInfo::with('customer')
        // ->first();
        ->paginate(10);
        $current_trips = TripInfo::with('customer')->where('starting_date', '>', Carbon::yesterday())->where('starting_date', '<', Carbon::tomorrow())->paginate(10);

        $canceled_trips = TripInfo::with('customer')->where('status', 'canceled')->paginate(10);
        $pending_trips = TripInfo::with('customer')->where('starting_date', '>=', Carbon::tomorrow())->paginate(10);
        $previous_trips = TripInfo::with('customer')->where('starting_date', '<', Carbon::today())->paginate(10);
        return view('admin.trips.index', compact('pageTitle', 'all_trips', 'current_trips', 'canceled_trips', 'pending_trips', 'previous_trips'));
    }

    public function bidding()
    {
        $pageTitle = 'All Bidding';
        // $search = $request->search;
        // $agents =User::when($search, function($q) use($search){
        //     $q->where('fname','LIKE','%'.$search.'%')
        //     ->orWhere('lname','LIKE','%'.$search.'%')
        //     ->orWhere('username','LIKE','%'.$search.'%')
        //     ->orWhere('referral','LIKE','%'.$search.'%')
        //     ->orWhere('mobile','LIKE','%'.$search.'%');
        // })->where('user_type', 4)->first();

        // dd($agents);
        $biddings = Bidding::with('provider', 'customer')->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.trips.bidding', compact('pageTitle', 'biddings'));
    }

    // show_provider_trips
    public function show_provider($biddings)
    {
        $pageTitle = 'See Trips ';
        $bid = Bidding::where('id', $biddings)->first();
        $all_trips = TripInfo::where('user_id', $bid->customer_id)->orderBy('created_at', 'desc')
        ->paginate(10);
        // ->first();
        $customer_name=$bid->customer->fname;
        return view('admin.trips.show_provider', compact('pageTitle', 'biddings','all_trips','customer_name'));
    }

    // show_provider_bidding
    public function show_provider_bidding($id)
    {
        $pageTitle = 'TripShow';
        $trip = TripInfo::with('vehicle')->find($id);


        // dd($trip );

            // dd($biddings);
            $accepted_bid = Bidding::where('trip_id', $id)->where('status', 1)->first();

            $all_bids = Bidding::where('trip_id', $id)->where('status', 0)->where('status', '!=', 2)->get();
            // dd($biddings);


        // dd($all_bids);


        return view('admin.trips.show_bidding', compact('pageTitle', 'trip', 'all_bids','accepted_bid'));
    }


}
