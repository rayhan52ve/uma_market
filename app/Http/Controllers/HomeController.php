<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Division;
use App\Models\GeneralSetting;
use App\Models\Language;
use App\Models\Page;
use App\Models\Review;
use App\Models\SectionData;
use App\Models\Service;
use App\Models\Subscribe;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Purifier;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{
    public function index()
    {

        $pageTitle = 'Home';
        $desktopbanners = GeneralSetting::first();
        $desktopbanner = $desktopbanners->desktop_banner;
        $mobilebanners = GeneralSetting::first();
        $mobilebanner = $mobilebanners->mobile_banner;
        // for banner2
        $desktopbanners2 = GeneralSetting::first();
        $desktopbanner2 = $desktopbanners2->desktop_banner2;
        $mobilebanners2 = GeneralSetting::first();
        $mobilebanner2 = $mobilebanners2->mobile_banner2;

        $sections = Page::where('name', 'home')->first();

        if (!$sections) {

            $sections = Page::create([
                'name' => 'home',
                'sections' => ['blog'],
                'slug' => 'home',
                'seo_description' => 'home',
                'page_order' => 1
            ]);
        }
        return view('frontend.home', compact('pageTitle', 'sections', 'mobilebanner', 'desktopbanner','mobilebanner2', 'desktopbanner2'));
    }

    public function pages(Request $request)
    {
        $page = Page::where('slug', $request->pagename)->first();

        if (!$page) {
            abort(404);
        }

        $pageTitle = "{$page->name}";

        return view('frontend.pages', compact('pageTitle', 'page'));
    }


    public function contact()
    {
        $pageTitle = 'Contact Us';

        $contact = content('contact.content');

        return view('frontend.contact', compact('pageTitle', 'contact'));
    }

    public function contactSend(Request $request)
    {
        $general = GeneralSetting::first();
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',
            'g-recaptcha-response' => Rule::requiredIf($general->allow_recaptcha == 1)
        ], [
            'g-recaptcha-response.required' => 'You Have To fill recaptcha'
        ]);

        sendGeneralMail($data);

        $notify[] = ['success', 'Contact With us successfully'];

        return back()->withNotify($notify);
    }

    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), ['email' => 'required|email|unique:subscribes,email']);

        if ($validator->fails()) {
            return response()->json(['fails' => true, 'errorMsg' => $validator->getMessageBag()]);
        }

        Subscribe::create(['email' => $request->email]);

        return response()->json(['success' => true, 'successMsg' => changeDynamic('Successfully Subscribe to our System')]);
    }

    public function categoryDetails(Request $request)
    {

        $category = Category::where('status', 1)->where('slug', $request->slug)->firstOrFail();

        $pageTitle = $category->name;

        $users = User::where('user_type', 2)->whereHas('services.category', function ($q) use ($category) {
            $q->where('id', $category->id);
        })->get();

        return view('frontend.category_details', compact('pageTitle', 'users'));
    }

    public function userDetails(User $user)
    {
        // dd($user);
        // $user = User::where('slug', $user)->firstOrFail();

        $pageTitle = "{$user->fullname}";

        $services = $user->services()->where('status', 1)->where('admin_approval', 1)->get();

        $workingHour = $user->schedules()->where('status', 1)->get()->groupBy('week_name');

        $rating = Review::whereIn('service_id', $services->pluck('id')->toArray())->avg('review');

        $jobSuccess = Booking::whereIn('service_id', $services->pluck('id')->toArray())->where('is_completed', 1)->count();

        return view('frontend.provider_details', compact('pageTitle', 'user', 'services', 'workingHour', 'rating', 'jobSuccess'));
    }

    public function experts()
    {
        $pageTitle = 'Our Experts';


// dd($pageTitle);
        return view('frontend.experts', compact('pageTitle', 'experts'));
    }

    public function searchExperts(Request $request)
    {
        // dd($request);
        if (!$request->has('search') || !$request->has('vehicle') || !$request->has('location')) {
            $notify[] = ['error', 'Invalid Parameters'];
            return redirect()->route('home')->withNotify($notify);
        }

        $search = $request->search;
        $vehicleSearch = $request->vehicle;
        $location = $request->location;

        $experts = User::with('userDetails')->where('status', 1)->serviceProvider()->where(DB::raw('fname'), 'LIKE', "%$search%")->when($location, function ($q) use ($location) {
            $q->whereHas('services', function ($q) use ($location) {
                $q->where('location', 'LIKE', "%$location%");
            });
        })->whereHas('services', function ($q) {
            $q->where('status', 1);
        })->whereHas('services', function ($q) {
            $q->where('admin_approval', 1);
        })->whereHas('services', function ($q) use ($vehicleSearch) {
            $q->where('vehicle', 'LIKE', "%" . $vehicleSearch . "%");
        })->get();

        $pageTitle = 'Your Searched Experts';
        $vehicle = $vehicleSearch;

        $vehicle_id = Vehicle::where('name', 'LIKE', '%' . $vehicle . '%')->first();

        if ($vehicle_id) {
            $vehicle_id = $vehicle_id->id;
        }

        return view('frontend.experts', compact('pageTitle', 'experts', 'vehicle', 'vehicle_id'));
    }

    public function serviceRedirecting($name)
    {
        $divisions = Division::all();
        $vehicle = $name;
        $pageTitle = 'Your Searched Experts';

        if ($name == 'ট্রাক ভাড়া') {
            $vehicle = 'ট্রাক';
            $experts = User::with('userDetails')->where('status', 1)->serviceProvider()->whereHas('services', function ($q) use ($vehicle) {
                $q->where('vehicle', 'LIKE', '%' . $vehicle . '%');
            })->whereHas('services', function ($q) {
                $q->where('status', 1);
            })->whereHas('services', function ($q) {
                $q->where('admin_approval', 1);
            })->get();

            $vehicle = 'ট্রাক';
            $vehicle_id = Vehicle::where('name', 'LIKE', '%' . $vehicle . '%')->first()->id;
        } elseif ($name == 'অন্যান্য যানবাহন ভাড়া') {
            // $vehicle = 'ট্রাক';
            // $experts = User::with('userDetails')->where('status', 1)->serviceProvider()->whereHas('services', function ($q) use ($vehicle) {
            //     $q->where('vehicle', 'NOT LIKE', '%' . $vehicle . '%');
            // })->whereHas('services', function ($q) {
            //     $q->where('status', 1);
            // })->get();

            return view('frontend.other_vehicles', compact('pageTitle'));
        } elseif (($name == 'ট্রাক') || ($name == 'প্রাইভেট কার') || ($name == 'মাইক্রো') || ($name == 'এম্বুল্যান্স') || ($name == 'মোটরসাইকেল') || ($name == 'সিএনজি') || ($name == 'ভ্যান') || ($name == 'মাহিন্দ্রা') || ($name == 'ইজিবাইক') || ($name == 'বাস')) {
            $experts = User::with('userDetails')->where('status', 1)->serviceProvider()->whereHas('services', function ($q) use ($name) {
                $q->where('vehicle', 'LIKE', '%' . $name . '%');
            })->whereHas('services', function ($q) {
                $q->where('status', 1);
            })->whereHas('services', function ($q) {
                $q->where('admin_approval', 1);
            })->get();

            $vehicle_id = Vehicle::where('name', 'LIKE', '%' . $name . '%')->first()->id;
        } else {
            return redirect()->route('upcoming');
        }

        return view('frontend.experts', compact('pageTitle', 'experts', 'vehicle', 'vehicle_id', 'divisions'));
    }

    public function categoryAll()
    {
        $pageTitle = "All Categories";

        $categories = Category::where('status', 1)->whereHas('services.user', function ($q) {
            $q->where('status', 1)->serviceProvider();
        })->latest()->paginate(9);


        return view('frontend.all_category', compact('pageTitle', 'categories'));
    }

    public function blog()
    {
        $pageTitle = "Blog";

        $blogs = SectionData::where('key', 'blog.element')->latest()->paginate(9);

        return view('frontend.all_blog', compact('pageTitle', 'blogs'));
    }

    public function blogDetails(Request $request, SectionData $blog)
    {
        // $data = str_replace('-', ' ', $request->blog);

        // $blog = SectionData::where('key', 'blog.element')->where('data->heading', $data)->withCount('blogComments')->firstOrFail();
        // dd($blog);

        $recentPosts = SectionData::where('id', '!=', $blog->id)->where('key', 'blog.element')->latest()->take(10)->get();

        $categories = BlogCategory::whereHas('blogs')->latest()->get();

        $pageTitle = "Blog Details";


        return view('frontend.blog_details', compact('blog', 'pageTitle', 'categories', 'recentPosts'));
    }

    // public function showBlog(SectionData $blog)
    // {

    // }

    public function blogComment(Request $request)
    {
        $blog = SectionData::findOrFail($request->id);

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'comment' => 'required'
        ]);

        BlogComment::create([
            'blog_id' => $blog->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'comment' => $request->comment
        ]);

        $notify[] = ['success', 'successfully placed your comment'];

        return back()->withNotify($notify);
    }

    public function blogCategory(Request $request)
    {
        $blogCategory = BlogCategory::where('slug', $request->category)->firstOrFail();

        $blogs = SectionData::where('key', 'blog.element')->where('category', $blogCategory->id)->latest()->paginate(9);

        $pageTitle = "{$request->category}";


        return view('frontend.category_blog', compact('pageTitle', 'blogs'));
    }

    public function policy(Request $request)
    {
        $divisions = Division::all();
        $policy = SectionData::where('key', 'policy.element')->where('data->slug', $request->policy)->firstOrFail();


        $pageTitle = $policy->data->page_name;

        return view("frontend.sections.policy", compact('pageTitle', 'policy', 'divisions'));
    }

    public function serviceDetails(Request $request)
    {

        $service = Service::where('id', $request->id)->where('status', 1)->with('user')->withCount('reviews')->firstOrFail();

        $pageTitle = "{$service->name}";

        return view('frontend.service_details', compact('pageTitle', 'service'));
    }

    public function sendproviderMail(Request $request)
    {
        $general = GeneralSetting::first();
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
            'g-recaptcha-response' => Rule::requiredIf($general->allow_recaptcha == 1)
        ], [
            'g-recaptcha-response.required' => 'You Have To fill recaptcha'
        ]);

        $provider = User::where('id', $request->id)->serviceProvider()->where('status', 1)->firstOrFail();

        sendGeneralMail($data);

        $notify[] = ['success', 'Email Send Successfully'];

        return redirect()->back()->withNotify($notify);
    }



    public function writeReview(Request $request, Service $service)
    {
        $general = GeneralSetting::first();

        $request->validate([
            'review' => 'required|integer|between:1,5',
            'review_comment' => 'required',
            'g-recaptcha-response' => Rule::requiredIf($general->allow_recaptcha == 1)
        ], [
            'g-recaptcha-response.required' => 'You Have To fill recaptcha'
        ]);

        $isServiceBooked = auth()->user()->bookings()->whereHas('service.user', function ($q) use ($service) {
            $q->where('id', $service->user->id);
        })->where('payment_confirmed', 1)->count();

        if ($isServiceBooked == 0) {
            $notify[] = ['error', 'You can not review without taking any service'];

            return back()->withNotify($notify);
        }

        if ($service->user_id == auth()->id()) {
            $notify[] = ['error', 'You can not Review Your Own Service'];

            return back()->withNotify($notify);
        }

        $isReviewd = Review::where('user_id', auth()->id())->where('service_id', $service->id)->count();

        if ($isReviewd > 0) {
            $notify[] = ['error', 'You already Review this service'];

            return back()->withNotify($notify);
        }

        Review::create([
            'service_id' => $service->id,
            'user_id' => auth()->id(),
            'review' => $request->review,
            'review_message' => $request->review_comment
        ]);


        $notify[] = ['success', 'Successfully Reviewed this service'];

        return back()->withNotify($notify);
    }

    public function upcoming()
    {
        $pageTitle = 'Coming Soon';
        return view('frontend.upcoming',compact('pageTitle'));
    }

}
