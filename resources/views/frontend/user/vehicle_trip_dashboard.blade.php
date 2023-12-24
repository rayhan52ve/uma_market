@extends('frontend.layout.master')
@section('breadcrumb')
    <section class="section">
        <div class="section-header">

            <h1>সকল ট্রিপ {{ ' ( ' . $vehicle . ' )' }}</h1>

        </div>
    </section>
@endsection
@section('content')
    <div class="text-center mb-5">
        @foreach ($vehicleTypes as $vehicleType)
            <span>
                <a href="{{ route('user.vehicle.dashboard', $vehicleType->id) }}"
                    class="btn btn-lg custom_btn_lg mb-2 {{ $vehicleType->id == $vehicle_id ? 'btn-primary' : 'btn-info' }}"
                    {{ $vehicleType->id == $vehicle_id ? 'disabled' : ' ' }}>{{ $vehicleType->name }}</a>
            </span>
        @endforeach

        <span>
            <a href="#" class="btn btn-lg custom_btn_lg btn-info mb-2">ক্রেন</a>
        </span>
        <span>
            <a href="#" class="btn btn-lg custom_btn_lg btn-info mb-2">কার্গো জাহাজ ভাড়া</a>
        </span>
        <span>
            <a href="#" class="btn btn-lg custom_btn_lg btn-info mb-2">ডাক্তার</a>
        </span>
        <span>
            <a href="#" class="btn btn-lg custom_btn_lg btn-info mb-2">ডায়গনস্টিক সেন্টার</a>
        </span>
        <span>
            <a href="#" class="btn btn-lg custom_btn_lg btn-info mb-2">ফারমেসি</a>
        </span>
        <span>
            <a href="#" class="btn btn-lg custom_btn_lg btn-info mb-2">বাসা ভাড়া</a>
        </span>
        <span>
            <a href="#" class="btn btn-lg custom_btn_lg btn-info mb-2">হোটেল ভাড়া</a>
        </span>
        <span>
            <a href="#" class="btn btn-lg custom_btn_lg btn-info mb-2">হিউমান রেন্ট</a>
        </span>
        <span>
            <a href="#" class="btn btn-lg custom_btn_lg btn-info mb-2">সকল সার্ভিস</a>
        </span>

        <span>
            <a href="#" class="btn btn-lg custom_btn_lg btn-info mb-2">পাইকারি বাঁজার</a>
        </span>

        <span>
            <a href="#" class="btn btn-lg custom_btn_lg btn-info mb-2">নিত্যপ্রয়োজনীয় জিনিসপত্র</a>
        </span>

        <span>
            <a href="#" class="btn btn-lg custom_btn_lg btn-info mb-2">সার্ভিসকৃষি যানবাহন ভাড়া</a>
        </span>

        <span>
            <a href="#" class="btn btn-lg custom_btn_lg btn-info mb-2">জেনে রাখা ভাল</a>
        </span>
    </div>

    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">

                    <ul class="nav nav-pills" role="tablist">


                        <li class="nav-item">
                            <a class="nav-link active show" id="current_trips_tab" data-toggle="tab" href="#current_trips"
                                role="tab" aria-controls="current_trips" aria-selected="true">চলতি ট্রিপ</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="pending_trips_tab" data-toggle="tab" href="#pending_trips"
                                role="tab" aria-controls="pending_trips" aria-selected="false">অগ্রিম ট্রিপ</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="completed_trips_tab" data-toggle="tab" href="#completed_trips"
                                role="tab" aria-controls="completed_trips" aria-selected="false">রেকর্ড ট্রিপ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="canceled_trips_tab" data-toggle="tab" href="#canceled_trips"
                                role="tab" aria-controls="canceled_trips" aria-selected="false">বাতিল ট্রিপ</a>
                        </li>


                    </ul>


                </div>
                <div class="card-body text-center">

                    <div class="tab-content">

                        <div class="tab-pane fade active show" id="current_trips" role="tabpanel"
                            aria-labelledby="current_trips_tab">

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr class="text-left">
                                        <th>@changeLang('Sl')</th>
                                        <th>@changeLang('Customer')</th>
                                        <th>@changeLang('Service')</th>
                                        <th>@changeLang('Start Location')</th>
                                        <th>@changeLang('End Location')</th>
                                        <th style="min-width: 180px;">@changeLang('Trip Date/Time')</th>
                                        <th>@changeLang('Trip Amount')</th>
                                        <th>@changeLang('Umamarket Percent')</th>
                                        <th>@changeLang('Total Amount')</th>
                                        <th>@changeLang('Paid Status')</th>
                                        <th>@changeLang('Status')</th>
                                        <th class="text-center">@changeLang('Action')</th>
                                    </tr>
                                    @php
                                        $payAmount = 0;
                                    @endphp
                                    @forelse ($current_trips as $current_trip)
                                        <tr class="text-left">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $current_trip->customer->fname }}</td>
                                            <td>{{ $current_trip->vehicle->name }} </td>
                                            <td>{{ $current_trip->start_location }}</td>
                                            <td>{{ $current_trip->end_location }}</td>
                                            <td>{{ date('d-M-y', strtotime($current_trip->starting_date)) }} |
                                                {{ date('h:i A', strtotime($current_trip->starting_time)) }}</td>
                                            <td>{{ $current_trip->bid_amount }}</td>
                                            <td> {{ $generalSetting->commission }} % </td>
                                            <td> {{ $payAmount = ($current_trip->biddings[0]->bid_amount * $generalSetting->commission) / 100 }}
                                            </td>
                                            <td> <span class="badge badge-danger">Due</span></td>
                                            <td><span
                                                    class="badge {{ $current_trip->status == 'ordered' ? 'badge-warning' : ($current_trip->status == 'in-progress' ? 'badge-info' : ($current_trip->status == 'completed' ? 'badge-success' : 'badge-danger')) }}">
                                                    {{ $current_trip->status }}
                                                </span></td>
                                            <td>
                                                <ul class="d-flex pt-3">
                                                    <li class="list-inline-item"><a
                                                            href="{{ route('user.provider-trip.show', $current_trip->id) }}"
                                                            class="btn btn-primary">
                                                            View</a></li>
                                                    <li class="list-inline-item">
                                                        {{-- @php
                                                            dd($current_trip);
                                                        @endphp --}}
                                                        <form class=""
                                                            action="{{ route('user.trip.provider.payment', $current_trip->id) }}"
                                                            method="post">
                                                            @csrf
                                                            <input type="hidden" class="form-control"
                                                                value="{{ $payAmount }}" name="pay_amount">
                                                            <button type="submit" class="btn btn-success">
                                                                Payment</button>
                                                        </form>
                                                    </li>
                                                </ul>
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


                        <div class="tab-pane fade" id="pending_trips" role="tabpanel" aria-labelledby="pending_trips_tab">

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr class="text-left">
                                        <th>@changeLang('Sl')</th>
                                        <th>@changeLang('Customer')</th>
                                        <th>@changeLang('Service')</th>
                                        <th>@changeLang('Start Location')</th>
                                        <th>@changeLang('End Location')</th>
                                        <th style="min-width: 180px;">@changeLang('Trip Date/Time')</th>
                                        <th>@changeLang('Status')</th>
                                        <th>@changeLang('Action')</th>
                                    </tr>
                                    @forelse ($pending_trips as $pending_trip)
                                        <tr class="text-left">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pending_trip->customer->fname }}</td>
                                            <td>{{ $pending_trip->vehicle->name }} </td>
                                            <td>{{ $pending_trip->start_location }}</td>
                                            <td>{{ $pending_trip->end_location }}</td>
                                            <td>{{ date('d-M-y', strtotime($pending_trip->starting_date))}} | {{ date('h:i A', strtotime($pending_trip->starting_time))}}</td>
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
                                        <th>@changeLang('Customer')</th>
                                        <th>@changeLang('Service')</th>
                                        <th>@changeLang('Start Location')</th>
                                        <th>@changeLang('End Location')</th>
                                        <th>@changeLang('Trip Date/Time')</th>
                                        <th>@changeLang('Paid Status')</th>
                                        <th>@changeLang('Status')</th>
                                        <th>@changeLang('Action')</th>
                                    </tr>
                                    @forelse ($completed_trips as $completed_trip)
                                        <tr class="text-left">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $completed_trip->customer->fname }}</td>
                                            <td>{{ $completed_trip->vehicle->name }} </td>
                                            <td>{{ $completed_trip->start_location }}</td>
                                            <td>{{ $completed_trip->end_location }}</td>
                                            <td>{{ date('d-M-y', strtotime($completed_trip->starting_date)) }} |
                                                {{ date('h:i A', strtotime($completed_trip->starting_time)) }}
                                            </td>
                                            <td> <span class="badge badge-success">Paid</span></td>
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

                        <div class="tab-pane fade" id="canceled_trips" role="tabpanel"
                            aria-labelledby="canceled_trips_tab">

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr class="text-left">
                                        <th>@changeLang('Sl')</th>
                                        <th>@changeLang('Customer')</th>
                                        <th>@changeLang('Service')</th>
                                        <th>@changeLang('Start Location')</th>
                                        <th>@changeLang('End Location')</th>
                                        <th style="min-width: 180px;">@changeLang('Trip Date/Time')</th>
                                        <th>@changeLang('Status')</th>
                                        <th>@changeLang('Action')</th>
                                    </tr>
                                    @forelse ($canceled_trips as $requested_trip)
                                        <tr class="text-left">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $requested_trip->customer->fname }}</td>
                                            <td>{{ $requested_trip->vehicle->name }} </td>
                                            <td>{{ $requested_trip->start_location }}</td>
                                            <td>{{ $requested_trip->end_location }}</td>
                                            <td>{{ date('d-M-y', strtotime($requested_trip->starting_date)) }} |
                                                {{ date('h:i A', strtotime($requested_trip->starting_time)) }}
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
                            @if ($canceled_trips->hasPages())
                                {{ $canceled_trips->links('admin.partials.paginate') }}
                            @endif
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('custom-style')
    <style>
        .font-25 {
            font-size: 25px;
        }
    </style>
@endpush
