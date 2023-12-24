@php
    if (request()->routeIs('pages')) {
        $experts = App\Models\User::with('userDetails')
            ->whereHas('services', function ($q) {
                $q->where('status', 1)->where('admin_approval', 1);
            })
            ->latest()
            ->paginate();
    } else {
        $content = content('rewarded.content');
    
        $vendors = App\Models\User::where('created_by', '!=', null)
            ->where('user_type', 2)
            ->get();
        $agentEmployees = $vendors->groupBy('created_by');
        $totalAgentEmployeeTrips = [];
        foreach ($agentEmployees as $agentEmployeeId => $vendorList) {
            $totalTrips = 0;
            foreach ($vendorList as $vendor) {
                $trips = App\Models\TripInfo::confirmOrder()
                    ->where('user_id', $vendor->id)
                    ->count();
                $totalTrips += $trips;
            }
            $totalAgentEmployeeTrips[] = [
                'user_id' => $agentEmployeeId,
                'trip_count' => $totalTrips,
            ];
        }
        $sortedAgentEmployeeTrips = collect($totalAgentEmployeeTrips)->sortByDesc('trip_count');
        // dd($sortedAgentEmployeeTrips);
    
        $featureds = App\Models\User::with('userDetails')
            ->whereIn('user_type', [3, 4])
            ->whereIn('id', $sortedAgentEmployeeTrips->pluck('user_id'))
            ->limit(8)
            ->get();
    
        // $featureds = App\Models\User::with('userDetails')
        //     ->whereHas('services', function ($q) {
        //         $q->where('status', 1)->where('admin_approval', 1);
        //     })
        //     ->where('status', 1)
        //     ->get();
    }
    
@endphp

{{-- @if (request()->routeIs('pages'))

    <!--Service Start-->
    <div class="team-page pt_30 pb_60">
        <div class="container">
            <div class="row justify-content-center">
                @forelse ($experts as $expert)
                    <div class="col-lg-4 col-md-4 col-12 mt_30">
                        <div class="team-item">
                            <div class="team-photo">
                                <img src="@if ($expert->image) {{ getFile('user', $expert->image) }} @else {{ getFile('logo', $general->default_image) }} @endif"
                                    alt="Team Photo">
                            </div>
                            <div class="px-3 py-3">
                                <a href="{{ route('service.provider.details', $expert->slug) }}">
                                    <small>
                                        <table>
                                            <tr>
                                                <td class="font-weight-bold">নাম</td>
                                                <td class="px-2">: </td>
                                                <td>{{ $expert->fname }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">প্রতিষ্ঠান</td>
                                                <td class="px-2">: </td>
                                                <td>{{ @$expert->userDetails->company_name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">ঠিকানা</td>
                                                <td class="px-2">: </td>
                                                <td>{{ @$expert->userDetails->company_address }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">অভিজ্ঞতা</td>
                                                <td class="px-2">: </td>
                                                <td>{{ @$expert->userDetails->driving_experience }}</td>
                                            </tr>
                                        </table>
                                    </small>
                                </a>
                            </div>
                            @if ($expert->social)
                                <div class="team-social">
                                    <ul>
                                        @if ($expert->social->facebook)
                                            <li><a href="{{ $expert->social->facebook }}"><i
                                                        class="fab fa-facebook-f"></i></a></li>
                                        @endif
                                        @if ($expert->social->twitter)
                                            <li><a href="{{ $expert->social->twitter }}"><i
                                                        class="fab fa-twitter"></i></a></li>
                                        @endif
                                        @if ($expert->social->youtube)
                                            <li><a href="{{ $expert->social->youtube }}"><i
                                                        class="fab fa-youtube"></i></a></li>
                                        @endif
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty

                    <div class="col-12 col-md-6 col-sm-12">
                        <div class="card">

                            <div class="card-body">
                                <div class="empty-state" data-height="400">
                                    <div class="empty-state-icon">
                                        <i class="far fa-sad-tear"></i>
                                    </div>
                                    <h2>@changeLang('Sorry We could not find any data')</h2>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforelse

            </div>
        </div>
    </div>
    <!--Service End-->
@else --}}
@if (count($featureds) > 0)
    <!--Team Area Start-->
    <div class="team-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-headline text-center">
                        <h2 class="font-weight-bold">{{ __(@$content->data->title) }}</h2>
                        {{-- <p>{{ __(@$content->data->sub_title) }}</p> --}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="team-carousel owl-carousel d-flex justify-content-center">
                        @forelse ($featureds as $feature)
                            <div class="team-item">
                                <div class="team-photo">
                                    <img
                                        src="@if ($feature->image) {{$feature->image}} @else {{ getFile('logo', $general->default_image) }} @endif">
                                </div>
                                <div class="p-3">
                                    <a href="{{ route('service.provider.details', $feature->slug) }}">
                                        <h4 class="text-primary font-weight-bold">{{ __(@$feature->fullname) }}</h4>
                                        @if (@$feature->user_type == 4)
                                        <span>Agent</span>
                                        @elseif (@$feature->user_type == 3)
                                        <span>Employee</span>
                                        @endif
                                    </a>
                                </div>
                                @if ($feature->social)
                                    <div class="team-social">
                                        <ul>
                                            @if ($feature->social->facebook)
                                                <li><a href="{{ $feature->social->facebook }}"><i
                                                            class="fab fa-facebook-f"></i></a></li>
                                            @endif
                                            @if ($feature->social->twitter)
                                                <li><a href="{{ $feature->social->twitter }}"><i
                                                            class="fab fa-twitter"></i></a></li>
                                            @endif
                                            @if ($feature->social->youtube)
                                                <li><a href="{{ $feature->social->youtube }}"><i
                                                            class="fab fa-youtube"></i></a></li>
                                            @endif
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        @empty
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Team Area End-->
    {{-- @endif --}}
@endif


@push('custom-css')
    <style>
        .empty-state {
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 40px;
        }

        .empty-state .empty-state-icon {
            position: relative;
            background-color: #ca9520;
            width: 80px;
            height: 80px;
            line-height: 100px;
            border-radius: 5px;
        }

        .empty-state .empty-state-icon i {
            font-size: 40px;
            color: #fff;
            position: relative;
            z-index: 1;
        }

        .empty-state h2 {
            font-size: 20px;
            margin-top: 30px;
        }

        .empty-state p {
            font-size: 16px;
        }
    </style>
@endpush
