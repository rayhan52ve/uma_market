<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\TripInfo;
use App\Models\Upazila;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function topService()
    {
        $pageTitle = 'Top Service';

        //daily
        $trucks['daily'] = TripInfo::where('vehicle_id', 1)
            ->where('created_at', '>=', Carbon::today())->count();
        // dd($trucks);
        $buses['daily'] = TripInfo::where('vehicle_id', 10)
            ->where('created_at', '>=', Carbon::today())->count();
        $cars['daily'] = TripInfo::where('vehicle_id', 2)
            ->where('created_at', '>=', Carbon::today())->count();
        $micros['daily'] = TripInfo::where('vehicle_id', 3)
            ->where('created_at', '>=', Carbon::today())->count();
        $ambulances['daily'] = TripInfo::where('vehicle_id', 4)
            ->where('created_at', '>=', Carbon::today())->count();
        $motor_cycles['daily'] = TripInfo::where('vehicle_id', 5)
            ->where('created_at', '>=', Carbon::today())->count();
        $cngs['daily'] = TripInfo::where('vehicle_id', 6)
            ->where('created_at', '>=', Carbon::today())->count();
        $vans['daily'] = TripInfo::where('vehicle_id', 7)
            ->where('created_at', '>=', Carbon::today())->count();
        $mahindras['daily'] = TripInfo::where('vehicle_id', 8)
            ->where('created_at', '>=', Carbon::today())->count();
        $easy_bikes['daily'] = TripInfo::where('vehicle_id', 9)
            ->where('created_at', '>=', Carbon::today())->count();

        $data['daily'] = collect([
            ['name' => 'ট্রাক', 'count' => $trucks['daily']],
            ['name' => 'বাস', 'count' => $buses['daily']],
            ['name' => 'প্রাইভেট কার', 'count' => $cars['daily']],
            ['name' => 'মাইক্রো', 'count' => $micros['daily']],
            ['name' => 'এ্যাম্বুলেন্স', 'count' => $ambulances['daily']],
            ['name' => 'মোটর সাইকেল', 'count' => $motor_cycles['daily']],
            ['name' => 'সি.এন.জি', 'count' => $cngs['daily']],
            ['name' => 'ভ্যান', 'count' => $vans['daily']],
            ['name' => 'মাহিন্দ্রা', 'count' => $mahindras['daily']],
            ['name' => 'ইজিবাইক', 'count' => $easy_bikes['daily']]


        ]);

        $collections['daily'] = $data['daily']->sortByDesc('count');
        // DAILY END

        // WEEKLY START
        $trucks['weekly'] = TripInfo::where('vehicle_id', 1)
            ->where('created_at', '>=', Carbon::today()->subDays(7))->count();
        $buses['weekly'] = TripInfo::where('vehicle_id', 10)
            ->where('created_at', '>=', Carbon::today()->subDays(7))->count();
        $cars['weekly'] = TripInfo::where('vehicle_id', 2)
            ->where('created_at', '>=', Carbon::today()->subDays(7))->count();
        $micros['weekly'] = TripInfo::where('vehicle_id', 3)
            ->where('created_at', '>=', Carbon::today()->subDays(7))->count();
        $ambulances['weekly'] = TripInfo::where('vehicle_id', 4)
            ->where('created_at', '>=', Carbon::today()->subDays(7))->count();
        $motor_cycles['weekly'] = TripInfo::where('vehicle_id', 5)
            ->where('created_at', '>=', Carbon::today()->subDays(7))->count();
        $cngs['weekly'] = TripInfo::where('vehicle_id', 6)
            ->where('created_at', '>=', Carbon::today()->subDays(7))->count();
        $vans['weekly'] = TripInfo::where('vehicle_id', 7)
            ->where('created_at', '>=', Carbon::today()->subDays(7))->count();
        $mahindras['weekly'] = TripInfo::where('vehicle_id', 8)
            ->where('created_at', '>=', Carbon::today()->subDays(7))->count();
        $easy_bikes['weekly'] = TripInfo::where('vehicle_id', 9)
            ->where('created_at', '>=', Carbon::today()->subDays(7))->count();



        $data['weekly'] = collect([
            ['name' => 'ট্রাক', 'count' => $trucks['weekly']],
            ['name' => 'বাস', 'count' => $buses['weekly']],
            ['name' => 'প্রাইভেট কার', 'count' => $cars['weekly']],
            ['name' => 'মাইক্রো', 'count' => $micros['weekly']],
            ['name' => 'এ্যাম্বুলেন্স', 'count' => $ambulances['weekly']],
            ['name' => 'মোটর সাইকেল', 'count' => $motor_cycles['weekly']],
            ['name' => 'সি.এন.জি', 'count' => $cngs['weekly']],
            ['name' => 'ভ্যান', 'count' => $vans['weekly']],
            ['name' => 'মাহিন্দ্রা', 'count' => $mahindras['weekly']],
            ['name' => 'ইজিবাইক', 'count' => $easy_bikes['weekly']]


        ]);

        $collections['weekly'] = $data['weekly']->sortByDesc('count');
        // WEEKLY END


        //MONHLY START
        $trucks['monthly'] = TripInfo::where('vehicle_id', 1)
            ->where('created_at', '>=', Carbon::today()->subDays(30))->count();
        // dd($trucks);
        $buses['monthly'] = TripInfo::where('vehicle_id', 10)
            ->where('created_at', '>=', Carbon::today()->subDays(30))->count();
        $cars['monthly'] = TripInfo::where('vehicle_id', 2)
            ->where('created_at', '>=', Carbon::today()->subDays(30))->count();
        $micros['monthly'] = TripInfo::where('vehicle_id', 3)
            ->where('created_at', '>=', Carbon::today()->subDays(30))->count();
        $ambulances['monthly'] = TripInfo::where('vehicle_id', 4)
            ->where('created_at', '>=', Carbon::today()->subDays(30))->count();
        $motor_cycles['monthly'] = TripInfo::where('vehicle_id', 5)
            ->where('created_at', '>=', Carbon::today()->subDays(30))->count();
        $cngs['monthly'] = TripInfo::where('vehicle_id', 6)
            ->where('created_at', '>=', Carbon::today()->subDays(30))->count();
        $vans['monthly'] = TripInfo::where('vehicle_id', 7)
            ->where('created_at', '>=', Carbon::today()->subDays(30))->count();
        $mahindras['monthly'] = TripInfo::where('vehicle_id', 8)
            ->where('created_at', '>=', Carbon::today()->subDays(30))->count();
        $easy_bikes['monthly'] = TripInfo::where('vehicle_id', 9)
            ->where('created_at', '>=', Carbon::today()->subDays(30))->count();


        $data['monthly'] = collect([
            ['name' => 'ট্রাক', 'count' => $trucks['monthly']],
            ['name' => 'বাস', 'count' => $buses['monthly']],
            ['name' => 'প্রাইভেট কার', 'count' => $cars['monthly']],
            ['name' => 'মাইক্রো', 'count' => $micros['monthly']],
            ['name' => 'এ্যাম্বুলেন্স', 'count' => $ambulances['monthly']],
            ['name' => 'মোটর সাইকেল', 'count' => $motor_cycles['monthly']],
            ['name' => 'সি.এন.জি', 'count' => $cngs['monthly']],
            ['name' => 'ভ্যান', 'count' => $vans['monthly']],
            ['name' => 'মাহিন্দ্রা', 'count' => $mahindras['monthly']],
            ['name' => 'ইজিবাইক', 'count' => $easy_bikes['monthly']]


        ]);

        $collections['monthly'] = $data['monthly']->sortByDesc('count');
        //MONTHLY END
        $contact = content('contact.content');
        return view('admin.reports.top_service', compact('pageTitle', 'contact', 'trucks', 'buses', 'cars', 'micros', 'ambulances', 'motor_cycles', 'cngs', 'vans', 'mahindras', 'easy_bikes', 'collections'));
    }

    public function tripReport(Request $request)
    {
        $search = $request->search;

        $upazilas = Upazila::all();
        $all_trips['all'] = TripInfo::when($search, function ($q) use ($search) {
            $q->where(function ($query) use ($search) {
                $query->where('start_location', 'LIKE', '%' . $search . '%')
                    ->orWhere('end_location', 'LIKE', '%' . $search . '%');
            });
        })->whereIn('status', ['in-progress', 'ordered'])->with('customer', 'bidding', 'vehicle')->get();

        $all_trips['running'] = TripInfo::when($search, function ($q) use ($search) {
            $q->where(function ($query) use ($search) {
                $query->where('start_location', 'LIKE', '%' . $search . '%')
                    ->orWhere('end_location', 'LIKE', '%' . $search . '%');
            });
        })->where('status', 'in-progress')->with('customer', 'bidding', 'vehicle')->get();

        $all_trips['completed'] = TripInfo::when($search, function ($q) use ($search) {
            $q->where(function ($query) use ($search) {
                $query->where('start_location', 'LIKE', '%' . $search . '%')
                    ->orWhere('end_location', 'LIKE', '%' . $search . '%');
            });
        })->where('status', 'completed')->with('customer', 'bidding', 'vehicle')->get();
        $contact = content('contact.content');
        return view('admin.reports.trip_report', compact('all_trips', 'upazilas','contact'));
    }

    public function duereport(Request $request)
    {
        $search = $request->searchLocation;
        if ($request->searchByDate) {
            $all_trips['running'] = TripInfo::when($request->searchByDate, function ($q) use ($request) {
                $q->where('created_at', 'like', '%' . $request->searchByDate . '%');
            })->where('status', 'in-progress')->with('customer', 'bidding', 'vehicle')->get();
        };
        $upazilas = Upazila::all();

        $all_trips['running'] = TripInfo::when($search, function ($q) use ($search) {
            $q->where(function ($query) use ($search) {
                $query->where('start_location', 'LIKE', '%' . $search . '%')
                    ->orWhere('end_location', 'LIKE', '%' . $search . '%');
            });
        })->where('status', 'in-progress')->with('customer', 'bidding', 'vehicle')->get();

        $all_trips['pending'] = TripInfo::when($search, function ($q) use ($search) {
            $q->where(function ($query) use ($search) {
                $query->where('start_location', 'LIKE', '%' . $search . '%')
                    ->orWhere('end_location', 'LIKE', '%' . $search . '%');
            });
        })->where('status', 'ordered')->with('customer', 'bidding', 'vehicle')->get();
        $contact = content('contact.content');
        return view('admin.reports.due_payment_report', compact('all_trips', 'upazilas', 'search','contact'));
    }

    public function dailyDue(Request $request)
    {
        $search = $request->search;

        $all_trips['running'] = TripInfo::when($request->search, function ($q) use ($request) {
            $q->where('created_at', 'like', '%' . $request->search . '%');
        })->where('status', 'in-progress')->with('customer', 'bidding', 'vehicle')->get();

        $upazilas = Upazila::all();
        $contact = content('contact.content');
        return view('admin.reports.daily_due', compact('all_trips', 'upazilas', 'search','contact'));
    }
    public function vendorWiseReport(Request $request)
    {
        $search = $request->search;
        $providers = User::vendor()
            ->where('status', 1)
            ->whereHas('biddings')
            ->with('biddings')
            ->withSum('biddings', 'bid_amount')
            ->get();
            $contact = content('contact.content');
        return view('admin.reports.vendor_due_report', compact('providers','search','contact'));
    }

    public function selfSalesReport(Request $request)
    {
        $search = $request->search;

        $upazilas = Upazila::all();
        $all_trips = TripInfo::whereIn('status', ['in-progress', 'ordered'])
            ->whereRelation('customer', 'created_by', 0)
            ->when($search, function ($q) use ($search) {
                $q->where(function ($innerQuery) use ($search) {
                    $innerQuery->where('start_location', 'LIKE', '%' . $search . '%')
                        ->orWhere('end_location', 'LIKE', '%' . $search . '%');
                });
            })
            ->with('customer', 'bidding', 'vehicle')
            ->get();
            $contact = content('contact.content');
        return view('admin.reports.self_sale_report', compact('all_trips', 'upazilas','contact'));
    }


    public function agentTripReport(Request $request)
    {
        $search = $request->search;

        $agents = User::where('user_type', 4)->get();

        // Get the employee & Agent ID
        $agentIds = User::where('user_type', 4)->pluck('id');

        // Retrieve customer IDs created by employee
        $customerVendorIds = User::whereIn('created_by', $agentIds)
            ->whereIn('user_type', [1, 2])
            ->pluck('id')
            ->toArray();
        //   dd($customerVendorIds);


        $all_trips['daily'] = TripInfo::where('created_at', '>=', Carbon::today())->whereIn('status', ['in-progress', 'ordered'])->whereIn('user_id', $customerVendorIds)->when($search, function ($q) use ($search) {
            $q->whereRelation('customer', 'created_by', 'LIKE', '%' . $search . '%');
        })->with('customer.agent', 'bidding')->get();


        $all_trips['weekly'] = TripInfo::where('created_at', '>=', Carbon::today()->subDays(7))->whereIn('status', ['in-progress', 'ordered'])->whereIn('user_id', $customerVendorIds)->when($search, function ($q) use ($search) {
            $q->whereRelation('customer', 'created_by', 'LIKE', '%' . $search . '%');
        })->with('customer.agent', 'bidding')->get();


        $all_trips['monthly'] = TripInfo::where('created_at', '>=', Carbon::today()->subDays(30))->whereIn('status', ['in-progress', 'ordered'])->whereIn('user_id', $customerVendorIds)->when($search, function ($q) use ($search) {
            $q->whereRelation('customer', 'created_by', 'LIKE', '%' . $search . '%');
        })->with('customer.agent', 'bidding')->get();
        $contact = content('contact.content');
        return view('admin.reports.agent_trip_report', compact('all_trips', 'agents','contact'));
    }

    public function employeeTripReport(Request $request)
    {
        $search = $request->search;

        $employees = User::where('user_type', 3)->get();

        // Get the employee & Agent ID
        $employeeIds = User::where('user_type', 3)->pluck('id');

        // Retrieve customer IDs created by employee
        $customerVendorIds = User::whereIn('created_by', $employeeIds)
            ->whereIn('user_type', [1, 2])
            ->pluck('id')
            ->toArray();

        $all_trips['daily'] = TripInfo::where('created_at', '>=', Carbon::today())->whereIn('status', ['in-progress', 'ordered'])->whereIn('user_id', $customerVendorIds)->when($search, function ($q) use ($search) {
            $q->whereRelation('customer', 'created_by', 'LIKE', '%' . $search . '%');
        })->with('customer', 'bidding')->get();


        $all_trips['weekly'] = TripInfo::where('created_at', '>=', Carbon::today()->subDays(7))->whereIn('status', ['in-progress', 'ordered'])->whereIn('user_id', $customerVendorIds)->when($search, function ($q) use ($search) {
            $q->whereRelation('customer', 'created_by', 'LIKE', '%' . $search . '%');
        })->with('customer', 'bidding')->get();


        $all_trips['monthly'] = TripInfo::where('created_at', '>=', Carbon::today()->subDays(30))->whereIn('status', ['in-progress', 'ordered'])->whereIn('user_id', $customerVendorIds)->when($search, function ($q) use ($search) {
            $q->whereRelation('customer', 'created_by', 'LIKE', '%' . $search . '%');
        })->with('customer', 'bidding')->get();
        $contact = content('contact.content');

        return view('admin.reports.employee_trip_report', compact('all_trips', 'employees','contact'));
    }




    public function transactionReport(Request $request)
    {
        $transactions = Transaction::when($request->search, function ($q) use ($request) {
            $q->where('created_at', 'like', '%' . $request->search . '%');
        })->latest()->with('user')->get();
        $contact = content('contact.content');
        return view('admin.reports.transaction_report', compact('transactions','contact'));
    }

    public function totalEarningReport(Request $request)
    {
        $divisions = Division::all();

        $transactions['daily'] = Transaction::where('created_at', '>=', Carbon::today())
            ->when($request->division_id, function ($q) use ($request) {
                $q->whereRelation('user', 'division_id', 'like', '%' . $request->division_id . '%');
            })->when($request->district_id, function ($q) use ($request) {
                $q->whereRelation('user', 'district_id', 'like', '%' . $request->district_id . '%');
            })->when($request->upazila_id, function ($q) use ($request) {
                $q->whereRelation('user', 'upazila_id', 'like', '%' . $request->upazila_id . '%');
            })->when($request->union_id, function ($q) use ($request) {
                $q->whereRelation('user', 'union_id', 'like', '%' . $request->union_id . '%');
            })->latest()->with('user')->get();

        $transactions['weekly'] = Transaction::where('created_at', '>=', Carbon::today()->subDays(7))
            ->when($request->division_id, function ($q) use ($request) {
                $q->whereRelation('user', 'division_id', 'like', '%' . $request->division_id . '%');
            })->when($request->district_id, function ($q) use ($request) {
                $q->whereRelation('user', 'district_id', 'like', '%' . $request->district_id . '%');
            })->when($request->upazila_id, function ($q) use ($request) {
                $q->whereRelation('user', 'upazila_id', 'like', '%' . $request->upazila_id . '%');
            })->when($request->union_id, function ($q) use ($request) {
                $q->whereRelation('user', 'union_id', 'like', '%' . $request->union_id . '%');
            })->latest()->with('user')->get();

        $transactions['monthly'] = Transaction::where('created_at', '>=', Carbon::today()->subDays(30))
            ->when($request->division_id, function ($q) use ($request) {
                $q->whereRelation('user', 'division_id', 'like', '%' . $request->division_id . '%');
            })->when($request->district_id, function ($q) use ($request) {
                $q->whereRelation('user', 'district_id', 'like', '%' . $request->district_id . '%');
            })->when($request->upazila_id, function ($q) use ($request) {
                $q->whereRelation('user', 'upazila_id', 'like', '%' . $request->upazila_id . '%');
            })->when($request->union_id, function ($q) use ($request) {
                $q->whereRelation('user', 'union_id', 'like', '%' . $request->union_id . '%');
            })->latest()->with('user')->get();

        $transactions['yearly'] = Transaction::where('created_at', '>=', Carbon::today()->subDays(365))
            ->when($request->division_id, function ($q) use ($request) {
                $q->whereRelation('user', 'division_id', 'like', '%' . $request->division_id . '%');
            })->when($request->district_id, function ($q) use ($request) {
                $q->whereRelation('user', 'district_id', 'like', '%' . $request->district_id . '%');
            })->when($request->upazila_id, function ($q) use ($request) {
                $q->whereRelation('user', 'upazila_id', 'like', '%' . $request->upazila_id . '%');
            })->when($request->union_id, function ($q) use ($request) {
                $q->whereRelation('user', 'union_id', 'like', '%' . $request->union_id . '%');
            })->latest()->with('user')->get();
            $contact = content('contact.content');
        return view('admin.reports.total_earning_report', compact('transactions', 'divisions','contact'));
    }
}
