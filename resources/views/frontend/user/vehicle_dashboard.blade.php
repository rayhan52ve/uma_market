@extends('frontend.layout.master')
@section('breadcrumb')
    <section class="section">
        <div class="section-header">

            <h1>@changeLang('Dashboard') {{ ' ( ' . $vehicle . ' )' }}</h1>

        </div>
    </section>
@endsection
@section('content')
    <div class="text-center mb-5">
        @foreach ($vehicleTypes as $vehicleType)
            <span>
                <a href="{{ route('user.vehicle.dashboard', $vehicleType->id) }}"
                    class="btn custom_btn_lg mb-2 {{ $vehicleType->id == $vehicle_id ? 'btn-primary' : 'btn-info' }}"
                    {{ $vehicleType->id == $vehicle_id ? 'disabled' : ' ' }}>{{ $vehicleType->name }}</a>
            </span>
        @endforeach

        <span>
            <a href="{{route('upcoming')}}" class="btn custom_btn_lg btn-info mb-2">ক্রেন</a>
        </span>
        <span>
            <a href="{{route('upcoming')}}" class="btn custom_btn_lg btn-info mb-2">কার্গো জাহাজ ভাড়া</a>
        </span>
        <span>
            <a href="{{route('upcoming')}}" class="btn custom_btn_lg btn-info mb-2">ডাক্তার</a>
        </span>
        <span>
            <a href="{{route('upcoming')}}" class="btn custom_btn_lg btn-info mb-2">ডায়গনস্টিক সেন্টার</a>
        </span>
        <span>
            <a href="{{route('upcoming')}}" class="btn custom_btn_lg btn-info mb-2">ফারমেসি</a>
        </span>
        <span>
            <a href="{{route('upcoming')}}" class="btn custom_btn_lg btn-info mb-2">বাসা ভাড়া</a>
        </span>
        <span>
            <a href="{{route('upcoming')}}" class="btn custom_btn_lg btn-info mb-2">হোটেল ভাড়া</a>
        </span>
        <span>
            <a href="{{route('upcoming')}}" class="btn custom_btn_lg btn-info mb-2">হিউমান রেন্ট</a>
        </span>
        <span>
            <a href="{{route('upcoming')}}" class="btn custom_btn_lg btn-info mb-2">সকল সার্ভিস</a>
        </span>

        <span>
            <a href="{{route('upcoming')}}" class="btn custom_btn_lg btn-info mb-2">পাইকারি বাঁজার</a>
        </span>

        <span>
            <a href="{{route('upcoming')}}" class="btn custom_btn_lg btn-info mb-2">নিত্যপ্রয়োজনীয় জিনিসপত্র</a>
        </span>

        <span>
            <a href="{{route('upcoming')}}" class="btn custom_btn_lg btn-info mb-2">সার্ভিসকৃষি যানবাহন ভাড়া</a>
        </span>

        <span>
            <a href="{{route('upcoming')}}" class="btn custom_btn_lg btn-info mb-2">জেনে রাখা ভাল</a>
        </span>
    </div>


    <div class="d-flex justify-content-center mb-5 ">
        <div class="col-lg-6 col-md-6">

            @if ($vehicle_id == 1)
                @php
                    $services = App\Models\Service::where('user_id', auth()->id())
                        ->where('admin_approval', 1)
                        ->where('vehicle', 'ট্রাক ')
                        ->latest()
                        ->first();
                @endphp

                @if ($services)
                    <img src="{{ $services->service_image ? getFile('/provider-service', $services->service_image) : asset('frontend/images/truck.jpg') }}"
                        class="w-100 rounded">
                @else
                    <img src="{{ asset('frontend/images/truck.jpg') }}" class="w-100 rounded">
                @endif

                {{-- <img src="{{ asset('frontend/images/truck.jpg') }}" class=" w-100 rounded "   alt="Responsive image"> --}}
            @elseif ($vehicle_id == 2)
                @php
                    $services = App\Models\Service::where('user_id', auth()->id())
                        ->where('admin_approval', 1)
                        ->where('vehicle', 'প্রাইভেট কার')
                        ->latest()
                        ->first();
                @endphp

                @if ($services)
                    <img src="{{ $services->service_image ? getFile('/provider-service', $services->service_image) : asset('frontend/images/car.jpg') }}"
                        class="w-100 rounded">
                @else
                    <img src="{{ asset('frontend/images/car.jpg') }}" class="w-100 rounded">
                @endif


                {{-- <img src="{{ asset('frontend/images/car.jpg') }}" class=" w-100 rounded" alt="Responsive image"> --}}
            @elseif ($vehicle_id == 3)
                @php
                    $services = App\Models\Service::where('user_id', auth()->id())
                        ->where('admin_approval', 1)
                        ->where('vehicle', 'মাইক্রো')
                        ->latest()
                        ->first();
                @endphp

                @if ($services)
                    <img src="{{ $services->service_image ? getFile('/provider-service', $services->service_image) : asset('frontend/images/truck.jpg') }}"
                        class="w-100 rounded">
                @else
                    <img src="{{ asset('frontend/images/micro.jpg') }}" class="w-100 rounded">
                @endif
                {{-- <img src="{{ asset('frontend/images/micro.jpg') }}" class=" w-100 rounded" alt="Responsive image"> --}}
            @elseif ($vehicle_id == 4)
                @php
                    $services = App\Models\Service::where('user_id', auth()->id())
                        ->where('admin_approval', 1)
                        ->where('vehicle', 'এম্বুল্যান্স')
                        ->latest()
                        ->first();
                @endphp

                @if ($services)
                    <img src="{{ $services->service_image ? getFile('/provider-service', $services->service_image) : asset('frontend/images/ambulance.jpg') }}"
                        class="w-100 rounded">
                @else
                    <img src="{{ asset('frontend/images/ambulance.jpg') }}" class="w-100 rounded">
                @endif
                {{-- <img src="{{ asset('frontend/images/ambulance.jpg') }}" class=" w-100 rounded" alt="Responsive image"> --}}
            @elseif ($vehicle_id == 5)
                @php
                    $services = App\Models\Service::where('user_id', auth()->id())
                        ->where('admin_approval', 1)
                        ->where('vehicle', 'মোটরসাইকেল')
                        ->latest()
                        ->first();
                @endphp

                @if ($services)
                    <img src="{{ $services->service_image ? getFile('/provider-service', $services->service_image) : asset('frontend/images/bike.jpg') }}"
                        class="w-100 rounded">
                @else
                    <img src="{{ asset('frontend/images/bike.jpg') }}" class="w-100 rounded">
                @endif
                {{-- <img src="{{ asset('frontend/images/bike.jpg') }}" class=" w-100 rounded" alt="Responsive image"> --}}
            @elseif ($vehicle_id == 6)
                @php
                    $services = App\Models\Service::where('user_id', auth()->id())
                        ->where('admin_approval', 1)
                        ->where('vehicle', 'সিএনজি')
                        ->latest()
                        ->first();
                @endphp

                @if ($services)
                    <img src="{{ $services->service_image ? getFile('/provider-service', $services->service_image) : asset('frontend/images/cng.png') }}"
                        class="w-100 rounded">
                @else
                    <img src="{{ asset('frontend/images/cng.png') }}" class="w-100 rounded">
                @endif
                {{-- <img src="{{ asset('frontend/images/cng.png') }}" class=" w-100 rounded" alt="Responsive image"> --}}
            @elseif ($vehicle_id == 7)
                @php
                    $services = App\Models\Service::where('user_id', auth()->id())
                        ->where('admin_approval', 1)
                        ->where('vehicle', 'ভ্যান')
                        ->latest()
                        ->first();
                @endphp

                @if ($services)
                    <img src="{{ $services->service_image ? getFile('/provider-service', $services->service_image) : asset('frontend/images/micro.jpg') }}"
                        class="w-100 rounded">
                @else
                    <img src="{{ asset('frontend/images/van.webp') }}" class="w-100 rounded">
                @endif
                {{-- <img src="{{ asset('frontend/images/van.webp') }}" class=" w-100 rounded" alt="Responsive image"> --}}
            @elseif ($vehicle_id == 8)
                @php
                    $services = App\Models\Service::where('user_id', auth()->id())
                        ->where('admin_approval', 1)
                        ->where('vehicle', 'মাহিন্দ্রা')
                        ->latest()
                        ->first();
                @endphp

                @if ($services)
                    <img src="{{ $services->service_image ? getFile('/provider-service', $services->service_image) : asset('frontend/images/mahindra.jpg') }}"
                        class="w-100 rounded">
                @else
                    <img src="{{ asset('frontend/images/mahindra.jpg') }}" class="w-100 rounded">
                @endif
                {{-- <img src="{{ asset('frontend/images/mahindra.jpg') }}" class=" w-100 rounded" alt="Responsive image"> --}}
            @elseif ($vehicle_id == 9)
                @php
                    $services = App\Models\Service::where('user_id', auth()->id())
                        ->where('admin_approval', 1)
                        ->where('vehicle', 'ইজিবাইক')
                        ->latest()
                        ->first();
                @endphp

                @if ($services)
                    <img src="{{ $services->service_image ? getFile('/provider-service', $services->service_image) : asset('frontend/images/easyBike.jpeg') }}"
                        class="w-100 rounded">
                @else
                    <img src="{{ asset('frontend/images/easyBike.jpeg') }}" class="w-100 rounded">
                @endif
                {{-- <img src="{{ asset('frontend/images/easyBike.jpeg') }}" class=" w-100 rounded" alt="Responsive image"> --}}
            @else
                <img src="{{ asset('frontend/images/bus.jpg') }}" class=" w-100 rounded" alt="Responsive image">
            @endif
        </div>
    </div>


    <div class="container">
        <div class="row-sm">
            <div class="d-md-flex justify-content-center gap-5 mb-5 btn-group-sm">
                <a href="{{ route('user.profile') }}" class="btn btn-lg btn-icon icon-left btn-primary w-100 mb-2"><i
                        class="fa fa-user"></i>
                    প্রোফাইল দেখুন</a>
                <a href="{{ route('user.service.create', $vehicle_id) }}"
                    class="btn btn-lg btn-icon icon-left btn-primary w-100 mb-2"><i class="fa fa-plus"></i>
                    {{ $vehicle }}
                    যোগ করুন</a>
                <a href="{{ route('user.provider-trip.index') }}?vehicle_id={{ $vehicle_id }}"
                    class="btn btn-lg btn-icon icon-left btn-primary w-100 mb-2"><i class="fa fa-truck"></i> সকল ট্রিপ
                    দেখুন</a>
                <a href="{{ route('user.vehicle.trip_dashboard', $vehicle_id) }}"
                    class="btn btn-lg btn-icon icon-left btn-primary w-100 mb-2"><i class="fas fa-truck-moving"></i> চলতি
                    ট্রিপ দেখুন</a>
                <a href="{{ route('user.vehicle.bid_trips', $vehicle_id) }}"
                    class="btn btn-lg btn-icon icon-left btn-primary w-100 mb-2"><i class="fas fa-user-tag"></i> আমার বিড
                    দেখুন</a>
                <a href="{{ route('user.transaction') }}" class="btn btn-lg btn-icon icon-left btn-primary w-100 mb-2"><i
                        class="fas fa-money-bill-wave"></i> পেমেন্ট দেখুন</a>
            </div>

        </div>
    </div>

    {{-- <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">

                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show" id="all_bid_trips_tab" data-toggle="tab" href="#all_bid_trips"
                                role="tab" aria-controls="all_bid_trips" aria-selected="true">All Bid Trips</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="current_trips_tab" data-toggle="tab" href="#current_trips"
                                role="tab" aria-controls="current_trips" aria-selected="false">Current Trips</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="pending_trips_tab" data-toggle="tab" href="#pending_trips"
                                role="tab" aria-controls="pending_trips" aria-selected="false">Pending Trips</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="completed_trips_tab" data-toggle="tab" href="#completed_trips"
                                role="tab" aria-controls="completed_trips" aria-selected="false">Completed Trips</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="requested_trips_tab" data-toggle="tab" href="#requested_trips"
                                role="tab" aria-controls="requested_trips" aria-selected="false">Requested Trips</a>
                        </li>


                    </ul>


                </div>
                <div class="card-body text-center">

                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="all_bid_trips" role="tabpanel"
                            aria-labelledby="all_bid_trips_tab">

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr class="text-left">
                                        <th>@changeLang('Sl')</th>
                                        <th>Customer</th>
                                        <th>Service</th>
                                        <th>Start Location</th>
                                        <th>End Location</th>
                                        <th>Startind Date/Time</th>
                                        <th>Status</th>
                                        <th>@changeLang('Action')</th>
                                    </tr>
                                    @forelse ($all_bid_trips as $all_trip)
                                        <tr class="text-left">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $all_trip->customer->fname }}</td>
                                            <td>{{ $all_trip->vehicle->name }} </td>
                                            <td>{{ $all_trip->start_location }}</td>
                                            <td>{{ $all_trip->end_location }}</td>
                                            <td>{{ date('d-M-y | h:i A', strtotime($all_trip->starting_date_time)) }}</td>
                                            <td><span
                                                    class="badge {{ $all_trip->status == 'ordered' ? 'badge-warning' : ($all_trip->status == 'in-progress' ? 'badge-info' : ($all_trip->status == 'completed' ? 'badge-success' : 'badge-danger')) }}">
                                                    {{ $all_trip->status }}
                                                </span></td>
                                            <td>

                                                <a href="{{ route('user.provider-trip.show', $all_trip->id) }}"
                                                    class="btn btn-icon btn-primary icon-left"><i class="far fa-eye"></i>
                                                    View</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="100%">@changeLang('No Data Found')</td>
                                        </tr>
                                    @endforelse
                                </table>
                            </div>
                            @if ($all_bid_trips->hasPages())
                                {{ $all_bid_trips->links('admin.partials.paginate') }}
                            @endif
                        </div>
                        <div class="tab-pane fade" id="current_trips" role="tabpanel" aria-labelledby="current_trips_tab">

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr class="text-left">
                                        <th>@changeLang('Sl')</th>
                                        <th>Customer</th>
                                        <th>Service</th>
                                        <th>Start Location</th>
                                        <th>End Location</th>
                                        <th>Startind Date/Time</th>
                                        <th>Status</th>
                                        <th>@changeLang('Action')</th>
                                    </tr>
                                    @forelse ($current_trips as $current_trip)
                                        <tr class="text-left">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $current_trip->customer->fname }}</td>
                                            <td>{{ $current_trip->vehicle->name }} </td>
                                            <td>{{ $current_trip->start_location }}</td>
                                            <td>{{ $current_trip->end_location }}</td>
                                            <td>{{ date('d-M-y | h:i A', strtotime($current_trip->starting_date_time)) }}
                                            <td><span
                                                    class="badge {{ $current_trip->status == 'ordered' ? 'badge-warning' : ($current_trip->status == 'in-progress' ? 'badge-info' : ($current_trip->status == 'completed' ? 'badge-success' : 'badge-danger')) }}">
                                                    {{ $current_trip->status }}
                                                </span></td>
                                            <td>

                                                <a href="{{ route('user.provider-trip.show', $current_trip->id) }}"
                                                    class="btn btn-icon btn-primary icon-left"><i class="far fa-eye"></i>
                                                    View</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="100%">@changeLang('No Data Found')</td>
                                        </tr>
                                    @endforelse
                                </table>
                            </div>
                            @if ($current_trips->hasPages())
                                {{ $current_trips->links('admin.partials.paginate') }}
                            @endif
                        </div>


                        <div class="tab-pane fade" id="pending_trips" role="tabpanel"
                            aria-labelledby="pending_trips_tab">

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr class="text-left">
                                        <th>@changeLang('Sl')</th>
                                        <th>Customer</th>
                                        <th>Service</th>
                                        <th>Start Location</th>
                                        <th>End Location</th>
                                        <th>Startind Date/Time</th>
                                        <th>Status</th>
                                        <th>@changeLang('Action')</th>
                                    </tr>
                                    @forelse ($pending_trips as $pending_trip)
                                        <tr class="text-left">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pending_trip->customer->fname }}</td>
                                            <td>{{ $pending_trip->vehicle->name }} </td>
                                            <td>{{ $pending_trip->start_location }}</td>
                                            <td>{{ $pending_trip->end_location }}</td>
                                            <td>{{ date('d-M-y | h:i A', strtotime($pending_trip->starting_date_time)) }}
                                            </td>
                                            <td><span
                                                    class="badge {{ $pending_trip->status == 'ordered' ? 'badge-warning' : ($pending_trip->status == 'in-progress' ? 'badge-info' : ($pending_trip->status == 'completed' ? 'badge-success' : 'badge-danger')) }}">
                                                    {{ $pending_trip->status }}
                                                </span></td>
                                            <td>

                                                <a href="{{ route('user.provider-trip.show', $pending_trip->id) }}"
                                                    class="btn btn-icon btn-primary icon-left"><i class="far fa-eye"></i>
                                                    View</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="100%">@changeLang('No Data Found')</td>
                                        </tr>
                                    @endforelse
                                </table>
                            </div>
                            @if ($pending_trips->hasPages())
                                {{ $pending_trips->links('admin.partials.paginate') }}
                            @endif
                        </div>

                        <div class="tab-pane fade" id="completed_trips" role="tabpanel"
                            aria-labelledby="completed_trips_tab">

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr class="text-left">
                                        <th>@changeLang('Sl')</th>
                                        <th>Customer</th>
                                        <th>Service</th>
                                        <th>Start Location</th>
                                        <th>End Location</th>
                                        <th>Startind Date/Time</th>
                                        <th>Status</th>
                                        <th>@changeLang('Action')</th>
                                    </tr>
                                    @forelse ($completed_trips as $completed_trip)
                                        <tr class="text-left">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $completed_trip->customer->fname }}</td>
                                            <td>{{ $completed_trip->vehicle->name }} </td>
                                            <td>{{ $completed_trip->start_location }}</td>
                                            <td>{{ $completed_trip->end_location }}</td>
                                            <td>{{ date('d-M-y | h:i A', strtotime($completed_trip->starting_date_time)) }}
                                            </td>
                                            <td><span
                                                    class="badge {{ $completed_trip->status == 'ordered' ? 'badge-warning' : ($completed_trip->status == 'in-progress' ? 'badge-info' : ($completed_trip->status == 'completed' ? 'badge-success' : 'badge-danger')) }}">
                                                    {{ $completed_trip->status }}
                                                </span></td>
                                            <td>

                                                <a href="{{ route('user.provider-trip.show', $completed_trip->id) }}"
                                                    class="btn btn-icon btn-primary icon-left"><i class="far fa-eye"></i>
                                                    View</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="100%">@changeLang('No Data Found')</td>
                                        </tr>
                                    @endforelse
                                </table>
                            </div>
                            @if ($completed_trips->hasPages())
                                {{ $completed_trips->links('admin.partials.paginate') }}
                            @endif
                        </div>

                        <div class="tab-pane fade" id="requested_trips" role="tabpanel"
                            aria-labelledby="requested_trips_tab">

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr class="text-left">
                                        <th>@changeLang('Sl')</th>
                                        <th>Customer</th>
                                        <th>Service</th>
                                        <th>Start Location</th>
                                        <th>End Location</th>
                                        <th>Startind Date/Time</th>
                                        <th>Status</th>
                                        <th>@changeLang('Action')</th>
                                    </tr>
                                    @forelse ($requested_trips as $requested_trip)
                                        <tr class="text-left">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $requested_trip->customer->fname }}</td>
                                            <td>{{ $requested_trip->vehicle->name }} </td>
                                            <td>{{ $requested_trip->start_location }}</td>
                                            <td>{{ $requested_trip->end_location }}</td>
                                            <td>{{ date('d-M-y | h:i A', strtotime($requested_trip->starting_date_time)) }}
                                            </td>
                                            <td><span
                                                    class="badge {{ $requested_trip->status == 'ordered' ? 'badge-warning' : ($requested_trip->status == 'in-progress' ? 'badge-info' : ($requested_trip->status == 'completed' ? 'badge-success' : 'badge-danger')) }}">
                                                    {{ $requested_trip->status }}
                                                </span></td>
                                            <td>

                                                <a href="{{ route('user.provider-trip.show', $requested_trip->id) }}"
                                                    class="btn btn-icon btn-primary icon-left"><i class="far fa-eye"></i>
                                                    View</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="100%">@changeLang('No Data Found')</td>
                                        </tr>
                                    @endforelse
                                </table>
                            </div>
                            @if ($requested_trips->hasPages())
                                {{ $requested_trips->links('admin.partials.paginate') }}
                            @endif
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div> --}}
@endsection

@push('custom-style')
    <style>
        .font-25 {
            font-size: 25px;
        }
    </style>
@endpush
