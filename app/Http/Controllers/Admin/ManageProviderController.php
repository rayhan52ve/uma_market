<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ManageProviderController extends Controller
{
    public function index(Request $request)
    {
        $pageTitle = 'All Providers';

        $search = $request->search;

        $providers = User::where('status', 1)->when($search, function ($q) use ($search) {
            $q->where('fname', 'LIKE', '%' . $search . '%')
                ->orWhere('lname', 'LIKE', '%' . $search . '%')
                ->orWhere('username', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('mobile', 'LIKE', '%' . $search . '%');
        })->latest()->with('reviews', 'services')->serviceProvider()->paginate();

        // Extract unique vehicle values from the providers
        $uniqueVehicles = $providers->flatMap(function ($provider) {
            return $provider->services->pluck('vehicle');
        })->unique();

        return view('admin.providers.index', compact('pageTitle', 'providers','uniqueVehicles'));
    }

    public function pendingProvider(Request $request)
    {
        $pageTitle = 'Pending Providers';

        $search = $request->search;

        $providers = User::where('status', 0)->when($search, function ($q) use ($search) {
            $q->where('fname', 'LIKE', '%' . $search . '%')
                ->orWhere('lname', 'LIKE', '%' . $search . '%')
                ->orWhere('username', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('mobile', 'LIKE', '%' . $search . '%');
        })->latest()->with('reviews', 'services')->serviceProvider()->paginate();

        return view('admin.providers.pending_provider', compact('pageTitle', 'providers'));
    }

    public function providerDetails(Request $request)
    {
        $provider = User::where('id', $request->provider)->with('services')->withCount('services')->serviceProvider()->firstOrFail();

        $serviceId = $provider->services()->pluck('id')->toArray();

        $uniqueVehicles = $provider->services->pluck('vehicle')->unique();

        $reviews = Review::whereIn('service_id', $serviceId)->avg('review');

        $completeService = Booking::whereIn('service_id', $serviceId)->where('is_completed', 1)->count();


        $pageTitle = "Service Provider Details";

        return view('admin.providers.details', compact('pageTitle', 'provider', 'reviews', 'completeService', 'uniqueVehicles'));
    }

    public function sendProviderMail(Request $request, User $provider)
    {
        $data = $request->validate([
            'subject' => 'required',
            "message" => 'required',
        ]);

        $data['name'] = $provider->fullname;
        $data['email'] = $provider->email;

        sendGeneralMail($data);

        $notify[] = ['success', 'Send Email To Provider Successfully'];

        return back()->withNotify($notify);
    }

    public function providerUpdate(Request $request, User $provider)
    {
        $request->validate([
            'fname' => 'required',
            // 'lname' => 'required',
            // 'country' => 'required',
            // 'city' => 'required',
            // 'zip' => 'required',
            // 'state' => 'required',
            'status' => 'required|in:0,1', 'featured' => 'required|in:0,1'
        ]);

        // $data = [
        //     'country' => $request->country,
        //     'city' => $request->city,
        //     'zip' => $request->zip,
        //     'state' => $request->state,
        // ];


        // $provider->fname = $request->fname;
        // $provider->lname = $request->lname;
        // $provider->address = $data;
        $provider->featured = $request->featured;
        $provider->status = $request->status;

        $provider->save();



        $notify[] = ['success', 'Provider Updated Successfully'];

        return back()->withNotify($notify);
    }

    public function providerStatus($id)
    {
        $providers = User::find($id);
        if ($providers) {
            if ($providers->status) {
                $providers->status = 0;
                // $providers->approved_at = Carbon::now();
            } else {
                $providers->status = 1;
                $providers->approved_at = Carbon::now();
            }
            $providers->save();
        }
        return back();
    }

    public function featuredProvider(Request $request)
    {
        $pageTitle = 'Featured Providers';

        $search = $request->search;

        $providers = User::when($search, function ($q) use ($search) {
            $q->where('fname', 'LIKE', '%' . $search . '%')
                ->orWhere('lname', 'LIKE', '%' . $search . '%')
                ->orWhere('username', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('mobile', 'LIKE', '%' . $search . '%');
        })->where('featured', 1)->latest()->serviceProvider()->paginate();

        return view('admin.providers.index', compact('pageTitle', 'providers'));
    }
}
