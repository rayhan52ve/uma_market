@extends('frontend.layout.frontend')
@push('custom-css')
    <link rel="stylesheet" href="{{ asset('frontend/css/user-style.css') }}">
@endpush
@section('breadcumb')
    @php

        $content = content('breadcrumb.content');

    @endphp
    <!--Banner Start-->
    <div class="banner-area flex" style="background-image:url({{ getFile('breadcrumb', @$content->data->image) }});">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="banner-text">
                        <h1>ট্রীপসমূহ</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Banner End-->
@endsection

@section('content')
    <div class="team-page pt_30 pb_60">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-head text-center mt-3">
                            <h2>আমার ট্রীপসমূহ</h2>
                        </div>
                        <div class="card-body text-center">

                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                  <a class="nav-link active" id="all_trips_tab" data-toggle="pill" href="#all_trips" role="tab" aria-controls="all_trips" aria-selected="true">@changeLang('All Trips')</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="current_trips_tab" data-toggle="pill" href="#current_trips" role="tab" aria-controls="current_trips" aria-selected="false">@changeLang('Current Trips')</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="pending_trips_tab" data-toggle="pill" href="#pending_trips" role="tab" aria-controls="pending_trips" aria-selected="false">@changeLang('Pending Trips')</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="trip_history_tab" data-toggle="pill" href="#trip_history" role="tab" aria-controls="trip_history" aria-selected="false">@changeLang('Trip History')</a>
                                  </li>
                              </ul>
                              <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="all_trips" role="tabpanel" aria-labelledby="all_trips_tab">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <tr class="text-left">
                                                <th>@changeLang('Sl')</th>
                                                <th>@changeLang('Customer')</th>
                                                <th>@changeLang('Service')</th>
                                                <th>@changeLang('Start Location')</th>
                                                <th>@changeLang('End Location')</th>
                                                <th>@changeLang('Trip Date/Time')</th>
                                                <th>@changeLang('Total Bids')</th>
                                                <th>@changeLang('Status')</th>
                                                <th>@changeLang('Action')</th>
                                            </tr>
                                            @forelse ($all_trips as $trip)
                                                <tr class="text-left">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $trip->customer->fname }}</td>
                                                    <td>{{ $trip->vehicle->name }} </td>
                                                    <td>{{ $trip->start_location }}</td>
                                                    <td>{{ $trip->end_location }}</td>
                                                    <td>{{ date('d-M-y', strtotime($trip->starting_date)) }} | {{ date('h:i A', strtotime($trip->starting_time)) }}</td>
                                                    <td>{{ $trip->bids_count }}</td>
                                                    <td><span
                                                            class="badge {{ $trip->status == 'ordered' ? 'badge-warning' : ($trip->status == 'in-progress' ? 'badge-info' : ($trip->status == 'completed' ? 'badge-success' : 'badge-danger')) }}">
                                                            {{ $trip->status }}
                                                        </span></td>
                                                    <td>

                                                        <a href="{{ route('user.trip-info.show', $trip->id) }}"
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
                                    @if ($all_trips->hasPages())
                                        {{ $all_trips->links('admin.partials.paginate') }}
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="current_trips" role="tabpanel" aria-labelledby="current_trips_tab">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <tr class="text-left">
                                                <th>@changeLang('Sl')</th>
                                                <th>@changeLang('Customer')</th>
                                                <th>@changeLang('Service')</th>
                                                <th>@changeLang('Start Location')</th>
                                                <th>@changeLang('End Location')</th>
                                                <th>@changeLang('Trip Date/Time')</th>
                                                <th>@changeLang('Total Bids')</th>
                                                <th>@changeLang('Status')</th>
                                                <th>@changeLang('Action')</th>
                                            </tr>
                                            @forelse ($current_trips as $trip)
                                                <tr class="text-left">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $trip->customer->fname }}</td>
                                                    <td>{{ $trip->vehicle->name }} </td>
                                                    <td>{{ $trip->start_location }}</td>
                                                    <td>{{ $trip->end_location }}</td>
                                                    <td>{{ date('d-M-y', strtotime($trip->starting_date)) }} | {{ date('h:i A', strtotime($trip->starting_time)) }}</td>
                                                    <td>{{ $trip->bids_count }}</td>
                                                    <td><span
                                                            class="badge {{ $trip->status == 'ordered' ? 'badge-warning' : ($trip->status == 'in-progress' ? 'badge-info' : ($trip->status == 'completed' ? 'badge-success' : 'badge-danger')) }}">
                                                            {{ $trip->status }}
                                                        </span></td>
                                                    <td>

                                                        <a href="{{ route('user.trip-info.show', $trip->id) }}"
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
                                <div class="tab-pane fade" id="pending_trips" role="tabpanel" aria-labelledby="pending_trips_tab">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <tr class="text-left">
                                                <th>@changeLang('Sl')</th>
                                                <th>@changeLang('Customer')</th>
                                                <th>@changeLang('Service')</th>
                                                <th>@changeLang('Start Location')</th>
                                                <th>@changeLang('End Location')</th>
                                                <th>@changeLang('Trip Date/Time')</th>
                                                <th>@changeLang('Total Bids')</th>
                                                <th>@changeLang('Status')</th>
                                                <th>@changeLang('Action')</th>
                                            </tr>
                                            @forelse ($pending_trips as $trip)
                                                <tr class="text-left">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $trip->customer->fname }}</td>
                                                    <td>{{ $trip->vehicle->name }} </td>
                                                    <td>{{ $trip->start_location }}</td>
                                                    <td>{{ $trip->end_location }}</td>
                                                    <td>{{ date('d-M-y', strtotime($trip->starting_date)) }} | {{ date('h:i A', strtotime($trip->starting_time)) }}</td>
                                                    <td>{{ $trip->bids_count }}</td>
                                                    <td><span
                                                            class="badge {{ $trip->status == 'ordered' ? 'badge-warning' : ($trip->status == 'in-progress' ? 'badge-info' : ($trip->status == 'completed' ? 'badge-success' : 'badge-danger')) }}">
                                                            {{ $trip->status }}
                                                        </span></td>
                                                    <td>

                                                        <a href="{{ route('user.trip-info.show', $trip->id) }}"
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
                                <div class="tab-pane fade" id="trip_history" role="tabpanel" aria-labelledby="trip_history_tab">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <tr class="text-left">
                                                <th>@changeLang('Sl')</th>
                                                <th>@changeLang('Customer')</th>
                                                <th>@changeLang('Service')</th>
                                                <th>@changeLang('Start Location')</th>
                                                <th>@changeLang('End Location')</th>
                                                <th>@changeLang('Trip Date/Time')</th>
                                                <th>@changeLang('Total Bids')</th>
                                                <th>@changeLang('Status')</th>
                                                <th>@changeLang('Action')</th>
                                            </tr>
                                            @forelse ($trip_history as $trip)
                                                <tr class="text-left">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $trip->customer->fname }}</td>
                                                    <td>{{ $trip->vehicle->name }} </td>
                                                    <td>{{ $trip->start_location }}</td>
                                                    <td>{{ $trip->end_location }}</td>
                                                    <td>{{ date('d-M-y', strtotime($trip->starting_date)) }} | {{ date('h:i A', strtotime($trip->starting_time)) }}</td>
                                                    <td>{{ $trip->bids_count }}</td>
                                                    <td><span
                                                            class="badge {{ $trip->status == 'ordered' ? 'badge-warning' : ($trip->status == 'in-progress' ? 'badge-info' : ($trip->status == 'completed' ? 'badge-success' : 'badge-danger')) }}">
                                                            {{ $trip->status }}
                                                        </span></td>
                                                    <td>

                                                        <a href="{{ route('user.trip-info.show', $trip->id) }}"
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
                                    @if ($trip_history->hasPages())
                                        {{ $trip_history->links('admin.partials.paginate') }}
                                    @endif
                                </div>
                              </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
