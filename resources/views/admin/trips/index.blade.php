@extends('admin.layout.master')
@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            <h1>সকল
                ট্রিপ</h1>
        </div>
    </section>
@endsection
@section('content')
    <div class="row">

        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">

                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show" id="all_trips_tab" data-toggle="tab" href="#all_trips"
                                role="tab" aria-controls="all_trips" aria-selected="true">@changeLang('All Trips')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="current_trips_tab" data-toggle="tab" href="#current_trips"
                                role="tab" aria-controls="current_trips" aria-selected="false">@changeLang('Running Trips')</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="canceled_trips_tab" data-toggle="tab" href="#canceled_trips"
                                role="tab" aria-controls="canceled_trips" aria-selected="false">@changeLang('Canceled Trips')</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="pending_trips_tab" data-toggle="tab" href="#pending_trips"
                                role="tab" aria-controls="pending_trips" aria-selected="false">@changeLang('Pending Trips')</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="previous_trips_tab" data-toggle="tab" href="#previous_trips"
                                role="tab" aria-controls="previous_trips" aria-selected="false">@changeLang('Previous Trips')</a>
                        </li>
                    </ul>

                </div>
                <div class="card-body text-center">

                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="all_trips" role="tabpanel"
                            aria-labelledby="all_trips_tab">

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr class="text-left">
                                        <th>@changeLang('Sl')</th>
                                        <th>@changeLang('Customer')</th>

                                        <th>@changeLang('Vehicle Name')</th>
                                        <th>@changeLang('Start Location')</th>
                                        <th>@changeLang('End Location')</th>
                                        <th>@changeLang('Loading Date/Time')</th>
                                        <th>@changeLang('Status')</th>
                                        <th>@changeLang('Action')</th>
                                    </tr>
                                    @forelse ($all_trips as $all_trip)
                                        <tr class="text-left">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $all_trip->customer->fname }}</td>
                                            <td>{{ $all_trip->vehicle->name }}</td>
                                            <td>{{ $all_trip->start_location }}</td>
                                            <td>{{ $all_trip->end_location }}</td>
                                            <td>{{ date('d-M-y', strtotime($all_trip->starting_date)) }} |
                                                {{ date('h:i A', strtotime($all_trip->starting_time)) }}</td>
                                            <td><span
                                                    class="badge {{ $all_trip->status == 'ordered' ? 'badge-warning' : ($all_trip->status == 'in-progress' ? 'badge-info' : ($all_trip->status == 'completed' ? 'badge-success' : 'badge-danger')) }}">
                                                    {{ $all_trip->status }}
                                                </span></td>
                                            <td>
                                                <button class="btn btn-info details" data-toggle="modal"
                                                    data-target="#tripInfo{{ $all_trip->id }}">@changeLang('Details')</button>
                                                <button class="btn btn-danger delete"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        {{-- modal start --}}
                                        <div class="modal fade" id="tripInfo{{ $all_trip->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">

                                                <form action="" method="post">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">@changeLang('Trip Info')</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="col-md-12 col-sm-12 col-lg-12">

                                                                <div class="row justify-content-between">
                                                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                                                        <p class="text-left font-weight-bold"
                                                                            style="color: black;">

                                                                            
                                                                            {{ __('@changeLang('Customer')') }} :
                                                                            {{ __($all_trip->customer->fname ? $all_trip->customer->fname : 'N/A') }}<br>
                                                                            {{ __('@changeLang('Vehicle Name')') }} :
                                                                            {{ __($all_trip->vehicle->name ? $all_trip->vehicle->name : 'N/A') }}<br>
                                                                            {{ __('@changeLang('Start Location')') }} :
                                                                            {{ __($all_trip->start_location ? $all_trip->start_location : 'N/A') }}<br>
                                                                            {{ __('@changeLang('End Location')') }} :
                                                                            {{ __($all_trip->end_location ? $all_trip->end_location : 'N/A') }}<br>
                                                                            {{ __('@changeLang('Trip Duration')') }} :
                                                                            {!! __($all_trip->duration_month ? '<span>Months:</span>' . $all_trip->duration_month : '') !!}
                                                                            {!! __($all_trip->duration_day ? '<span>,Days:</span>' . $all_trip->duration_day : '') !!}
                                                                            {!! __($all_trip->duration_hour ? '<span>,Hours:</span>' . $all_trip->duration_hour : '') !!}<br>
                                                                            {{ __('@changeLang('Trip Date/Time')') }} :
                                                                            {{ date('d-M-y', strtotime($all_trip->starting_date)) }}|
                                                                            {{ date('h:i A', strtotime($all_trip->starting_time)) }}<br>
                                                                            {{ __('@changeLang('Status')') }} :
                                                                            <span
                                                                                class="badge {{ $all_trip->status == 'ordered' ? 'badge-warning' : ($all_trip->status == 'in-progress' ? 'badge-info' : ($all_trip->status == 'completed' ? 'badge-success' : 'badge-danger')) }}">
                                                                                {{ $all_trip->status }}
                                                                            </span><br>
                                                                            {{ __('@changeLang('Passenger Count')') }} :
                                                                            {{ __($all_trip->passenger_count ? $all_trip->passenger_count : 'N/A') }}<br>
                                                                            {{ __('@changeLang('Trip Type')') }} :
                                                                            {{ __($all_trip->trip_type ? $all_trip->trip_type : 'N/A') }}<br>
                                                                            {{ __('@changeLang('Ac Type')') }} :
                                                                            {{ __($all_trip->ac_type ? $all_trip->ac_type : 'N/A') }}<br>
                                                                            {{ __('@changeLang('Rent Description')') }} :
                                                                            {{ __($all_trip->rent_description ? $all_trip->rent_description : 'N/A') }}<br>
                                                                            {{ __('@changeLang('Driver')') }} :
                                                                            {{ __($all_trip->without_driver ? 'No' : 'Yes') }}<br>


                                                                        </p>

                                                                    </div>

                                                                </div>
                                                            </div>


                                                        </div>

                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">@changeLang('Close')</button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                        {{-- modal end --}}
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
                                        <th>@changeLang('Vehicle Name')</th>
                                        <th>@changeLang('Start Location')</th>
                                        <th>@changeLang('End Location')</th>
                                        <th>@changeLang('Loading Date/Time')</th>
                                        <th>@changeLang('Status')</th>
                                        <th>@changeLang('Action')</th>
                                    </tr>
                                    @forelse ($current_trips as $current_trip)
                                        <tr class="text-left">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $current_trip->customer->fname }}</td>
                                            <td>{{ $current_trip->vehicle->name }}</td>
                                            <td>{{ $current_trip->start_location }}</td>
                                            <td>{{ $current_trip->end_location }}</td>
                                            <td>{{ date('d-M-y', strtotime($current_trip->starting_date)) }} |
                                                {{ date('h:i A', strtotime($current_trip->starting_time)) }}</td>
                                            <td><span
                                                    class="badge {{ $current_trip->status == 'ordered' ? 'badge-warning' : ($current_trip->status == 'in-progress' ? 'badge-info' : ($current_trip->status == 'completed' ? 'badge-success' : 'badge-danger')) }}">
                                                    {{ $current_trip->status }}
                                                </span></td>
                                            <td>
                                                <button class="btn btn-info details" data-toggle="modal"
                                                    data-target="#tripInfo{{ $current_trip->id }}">@changeLang('Details')</button>
                                                <button class="btn btn-danger delete"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        {{-- modal start --}}
                                        <div class="modal fade" id="tripInfo{{ $current_trip->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">

                                                <form action="" method="post">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">@changeLang('Trip Info')</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="col-md-12 col-sm-12 col-lg-12">

                                                                <div class="row justify-content-between">
                                                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                                                        <p class="text-left font-weight-bold"
                                                                            style="color: black;">

                                                                            
                                                                            {{ __('@changeLang('Customer')') }} :
                                                                            {{ __($current_trip->customer->name ? $current_trip->customer->name : 'N/A') }}<br>
                                                                            {{ __('@changeLang('Vehicle Name')') }} :
                                                                            {{ __($current_trip->vehicle->name ? $current_trip->vehicle->name : 'N/A') }}<br>
                                                                            {{ __('@changeLang('Start Location')') }} :
                                                                            {{ __($current_trip->start_location ? $current_trip->start_location : 'N/A') }}<br>
                                                                            {{ __('@changeLang('End Location')') }} :
                                                                            {{ __($current_trip->end_location ? $current_trip->end_location : 'N/A') }}<br>
                                                                            {{ __('@changeLang('Trip Duration')') }} :
                                                                            {!! __($current_trip->duration_month ? '<span>Months:</span>' . $current_trip->duration_month : '') !!}
                                                                            {!! __($current_trip->duration_day ? '<span>,Days:</span>' . $current_trip->duration_day : '') !!}
                                                                            {!! __($current_trip->duration_hour ? '<span>,Hours:</span>' . $current_trip->duration_hour : '') !!}<br>
                                                                            {{ __('@changeLang('Trip Date/Time')') }} :
                                                                            {{ date('d-M-y', strtotime($current_trip->starting_date)) }}|
                                                                            {{ date('h:i A', strtotime($current_trip->starting_time)) }}<br>
                                                                            {{ __('@changeLang('Status')') }} :
                                                                            <span
                                                                                class="badge {{ $current_trip->status == 'ordered' ? 'badge-warning' : ($current_trip->status == 'in-progress' ? 'badge-info' : ($current_trip->status == 'completed' ? 'badge-success' : 'badge-danger')) }}">
                                                                                {{ $current_trip->status }}
                                                                            </span><br>
                                                                            {{ __('@changeLang('Passenger Count')') }} :
                                                                            {{ __($current_trip->passenger_count ? $current_trip->passenger_count : 'N/A') }}<br>
                                                                            {{ __('@changeLang('Trip Type')') }} :
                                                                            {{ __($current_trip->trip_type ? $current_trip->trip_type : 'N/A') }}<br>
                                                                            {{ __('@changeLang('Ac Type')') }} :
                                                                            {{ __($current_trip->ac_type ? $current_trip->ac_type : 'N/A') }}<br>
                                                                            {{ __('@changeLang('Rent Description')') }} :
                                                                            {{ __($current_trip->rent_description ? $current_trip->rent_description : 'N/A') }}<br>
                                                                            {{ __('@changeLang('Driver')') }} :
                                                                            {{ __($current_trip->without_driver ? 'No' : 'Yes') }}<br>


                                                                        </p>

                                                                    </div>

                                                                </div>
                                                            </div>


                                                        </div>

                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">@changeLang('Close')</button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                        {{-- modal end --}}
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
                        <div class="tab-pane fade" id="canceled_trips" role="tabpanel"
                            aria-labelledby="canceled_trips_tab">

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr class="text-left">
                                        <th>@changeLang('Sl')</th>
                                        <th>@changeLang('Customer')</th>
                                        <th>@changeLang('Vehicle Name')</th>
                                        <th>@changeLang('Start Location')</th>
                                        <th>@changeLang('End Location')</th>
                                        <th>@changeLang('Loading Date/Time')</th>
                                        <th>@changeLang('Status')</th>
                                        <th>@changeLang('Action')</th>
                                    </tr>
                                    @forelse ($canceled_trips as $canceled_trip)
                                        <tr class="text-left">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $canceled_trip->customer->fname }}</td>
                                            <td>{{ $canceled_trip->vehicle->name }}</td>
                                            <td>{{ $canceled_trip->start_location }}</td>
                                            <td>{{ $canceled_trip->end_location }}</td>
                                            <td>{{ date('d-M-y', strtotime($canceled_trip->starting_date)) }} |
                                                {{ date('h:i A', strtotime($canceled_trip->starting_time)) }}
                                            </td>
                                            <td><span
                                                    class="badge {{ $canceled_trip->status == 'ordered' ? 'badge-warning' : ($canceled_trip->status == 'in-progress' ? 'badge-info' : ($canceled_trip->status == 'completed' ? 'badge-success' : 'badge-danger')) }}">
                                                    {{ $canceled_trip->status }}
                                                </span></td>
                                            <td>
                                                <button class="btn btn-info details" data-toggle="modal"
                                                    data-target="#tripInfo{{ $canceled_trip->id }}">@changeLang('Details')</button>
                                                <button class="btn btn-danger delete"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        {{-- modal start --}}
                                        <div class="modal fade" id="tripInfo{{ $canceled_trip->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">

                                                <form action="" method="post">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">@changeLang('Trip Info')</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="col-md-12 col-sm-12 col-lg-12">

                                                                <div class="row justify-content-between">
                                                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                                                        <p class="text-left font-weight-bold"
                                                                            style="color: black;">

                                                                            
                                                                            {{ __('@changeLang('Customer')') }} :
                                                                            {{ __($canceled_trip->customer->name ? $canceled_trip->customer->name : 'N/A') }}<br>
                                                                            {{ __('@changeLang('Vehicle Name')') }} :
                                                                            {{ __($canceled_trip->vehicle->name ? $canceled_trip->vehicle->name : 'N/A') }}<br>
                                                                            {{ __('@changeLang('Start Location')') }} :
                                                                            {{ __($canceled_trip->start_location ? $canceled_trip->start_location : 'N/A') }}<br>
                                                                            {{ __('@changeLang('End Location')') }} :
                                                                            {{ __($canceled_trip->end_location ? $canceled_trip->end_location : 'N/A') }}<br>
                                                                            {{ __('@changeLang('Trip Duration')') }} :
                                                                            {!! __($canceled_trip->duration_month ? '<span>Months:</span>' . $canceled_trip->duration_month : '') !!}
                                                                            {!! __($canceled_trip->duration_day ? '<span>,Days:</span>' . $canceled_trip->duration_day : '') !!}
                                                                            {!! __($canceled_trip->duration_hour ? '<span>,Hours:</span>' . $canceled_trip->duration_hour : '') !!}<br>
                                                                            {{ __('@changeLang('Trip Date/Time')') }} :
                                                                            {{ date('d-M-y', strtotime($canceled_trip->starting_date)) }}|
                                                                            {{ date('h:i A', strtotime($canceled_trip->starting_time)) }}<br>
                                                                            {{ __('@changeLang('Status')') }} :
                                                                            <span
                                                                                class="badge {{ $canceled_trip->status == 'ordered' ? 'badge-warning' : ($canceled_trip->status == 'in-progress' ? 'badge-info' : ($canceled_trip->status == 'completed' ? 'badge-success' : 'badge-danger')) }}">
                                                                                {{ $canceled_trip->status }}
                                                                            </span><br>
                                                                            {{ __('@changeLang('Passenger Count')') }} :
                                                                            {{ __($canceled_trip->passenger_count ? $canceled_trip->passenger_count : 'N/A') }}<br>
                                                                            {{ __('@changeLang('Trip Type')') }} :
                                                                            {{ __($canceled_trip->trip_type ? $canceled_trip->trip_type : 'N/A') }}<br>
                                                                            {{ __('@changeLang('Ac Type')') }} :
                                                                            {{ __($canceled_trip->ac_type ? $canceled_trip->ac_type : 'N/A') }}<br>
                                                                            {{ __('@changeLang('Rent Description')') }} :
                                                                            {{ __($canceled_trip->rent_description ? $canceled_trip->rent_description : 'N/A') }}<br>
                                                                            {{ __('@changeLang('Driver')') }} :
                                                                            {{ __($canceled_trip->without_driver ?  'No' : 'Yes') }}<br>


                                                                        </p>

                                                                    </div>

                                                                </div>
                                                            </div>


                                                        </div>

                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">@changeLang('Close')</button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                        {{-- modal end --}}
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

                        <div class="tab-pane fade" id="pending_trips" role="tabpanel"
                            aria-labelledby="pending_trips_tab">

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr class="text-left">
                                        <th>@changeLang('Sl')</th>
                                        <th>@changeLang('Customer')</th>
                                        <th>@changeLang('Vehicle Name')</th>
                                        <th>@changeLang('Start Location')</th>
                                        <th>@changeLang('End Location')</th>
                                        <th>@changeLang('Loading Date/Time')</th>
                                        <th>@changeLang('Status')</th>
                                        <th>@changeLang('Action')</th>
                                    </tr>
                                    @forelse ($pending_trips as $pending_trip)
                                        <tr class="text-left">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pending_trip->customer->fname }}</td>
                                            <td>{{ $pending_trip->vehicle->name }}</td>
                                            <td>{{ $pending_trip->start_location }}</td>
                                            <td>{{ $pending_trip->end_location }}</td>
                                            <td>{{ date('d-M-y', strtotime($pending_trip->starting_date)) }} |
                                                {{ date('h:i A', strtotime($pending_trip->starting_time)) }}
                                            </td>
                                            <td><span
                                                    class="badge {{ $pending_trip->status == 'ordered' ? 'badge-warning' : ($pending_trip->status == 'in-progress' ? 'badge-info' : ($pending_trip->status == 'completed' ? 'badge-success' : 'badge-danger')) }}">
                                                    {{ $pending_trip->status }}
                                                </span></td>
                                            <td>
                                                <button class="btn btn-info details" data-toggle="modal"
                                                    data-target="#tripIpending_trip->id }}">@changeLang('Details')</button>
                                                <button class="btn btn-danger delete"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        {{-- modal start --}}
                                        <div class="modal fade" id="tripInfo{{ $pending_trip->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">

                                                <form action="" method="post">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">@changeLang('Trip Info')</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="col-md-12 col-sm-12 col-lg-12">

                                                                <div class="row justify-content-between">
                                                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                                                        <p class="text-left font-weight-bold"
                                                                            style="color: black;">

                                                                            
                                                                            {{ __('@changeLang('Customer')') }} :
                                                                            {{ __($pending_trip->customer->name ? $pending_trip->customer->name : 'N/A') }}<br>
                                                                            {{ __('@changeLang('Vehicle Name')') }} :
                                                                            {{ __($pending_trip->vehicle->name ? $pending_trip->vehicle->name : 'N/A') }}<br>
                                                                            {{ __('@changeLang('Start Location')') }} :
                                                                            {{ __($pending_trip->start_location ? $pending_trip->start_location : 'N/A') }}<br>
                                                                            {{ __('@changeLang('End Location')') }} :
                                                                            {{ __($pending_trip->end_location ? $pending_trip->end_location : 'N/A') }}<br>
                                                                            {{ __('@changeLang('Trip Duration')') }} :
                                                                            {!! __($pending_trip->duration_month ? '<span>Months:</span>' . $pending_trip->duration_month : '') !!}
                                                                            {!! __($pending_trip->duration_day ? '<span>,Days:</span>' . $pending_trip->duration_day : '') !!}
                                                                            {!! __($pending_trip->duration_hour ? '<span>,Hours:</span>' . $pending_trip->duration_hour : '') !!}<br>
                                                                            {{ __('@changeLang('Trip Date/Time')') }} :
                                                                            {{ date('d-M-y', strtotime($pending_trip->starting_date)) }}|
                                                                            {{ date('h:i A', strtotime($pending_trip->starting_time)) }}<br>
                                                                            {{ __('@changeLang('Status')') }} :
                                                                            <span
                                                                                class="badge {{ $pending_trip->status == 'ordered' ? 'badge-warning' : ($pending_trip->status == 'in-progress' ? 'badge-info' : ($pending_trip->status == 'completed' ? 'badge-success' : 'badge-danger')) }}">
                                                                                {{ $pending_trip->status }}
                                                                            </span><br>
                                                                            {{ __('@changeLang('Passenger Count')') }} :
                                                                            {{ __($pending_trip->passenger_count ? $pending_trip->passenger_count : 'N/A') }}<br>
                                                                            {{ __('@changeLang('Trip Type')') }} :
                                                                            {{ __($pending_trip->trip_type ? $pending_trip->trip_type : 'N/A') }}<br>
                                                                            {{ __('@changeLang('Ac Type')') }} :
                                                                            {{ __($pending_trip->ac_type ? $pending_trip->ac_type : 'N/A') }}<br>
                                                                            {{ __('@changeLang('Rent Description')') }} :
                                                                            {{ __($pending_trip->rent_description ? $pending_trip->rent_description : 'N/A') }}<br>
                                                                            {{ __('@changeLang('Driver')') }} :
                                                                            {{ __($pending_trip->without_driver ? 'No' : 'Yes')}}<br>


                                                                        </p>

                                                                    </div>

                                                                </div>
                                                            </div>


                                                        </div>

                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">@changeLang('Close')</button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                        {{-- modal end --}}
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

                        <div class="tab-pane fade" id="previous_trips" role="tabpanel"
                            aria-labelledby="previous_trips_tab">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr class="text-left">
                                        <th>@changeLang('Sl')</th>
                                        <th>@changeLang('Customer')</th>
                                        <th>@changeLang('Vehicle Name')</th>
                                        <th>@changeLang('Start Location')</th>
                                        <th>@changeLang('End Location')</th>
                                        <th>@changeLang('Loading Date/Time')</th>
                                        <th>@changeLang('Status')</th>
                                        <th>@changeLang('Action')</th>
                                    </tr>
                                    @forelse ($previous_trips as $previous_trip)
                                        <tr class="text-left">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $previous_trip->customer->fname }}</td>
                                            <td>{{ $previous_trip->vehicle->name }}</td>

                                            <td>{{ $previous_trip->start_location }}</td>
                                            <td>{{ $previous_trip->end_location }}</td>
                                            <td>{{ date('d-M-y', strtotime($previous_trip->starting_date)) }} |
                                                {{ date('h:i A', strtotime($previous_trip->starting_time)) }}
                                            </td>
                                            <td><span
                                                    class="badge {{ $previous_trip->status == 'ordered' ? 'badge-warning' : ($previous_trip->status == 'in-progress' ? 'badge-info' : ($previous_trip->status == 'completed' ? 'badge-success' : 'badge-danger')) }}">
                                                    {{ $previous_trip->status }}
                                                </span></td>
                                            <td>
                                                <button class="btn btn-info details" data-toggle="modal"
                                                    data-target="#tripInfo{{ $previous_trip->id }}">@changeLang('Details')</button>
                                                <button class="btn btn-danger delete"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        {{-- modal start --}}
                                        {{-- <div class="modal fade" id="tripInfo{{ $previous_trip->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">

                                                <form action="" method="post">
                                                    @csrf --}}
                                        <div class="modal fade" id="tripInfo{{ $previous_trip->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">

                                                <form action="" method="post">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">@changeLang('Trip Info')</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="col-md-12 col-sm-12 col-lg-12">

                                                                <div class="row justify-content-between">
                                                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                                                        <p class="text-left font-weight-bold"
                                                                            style="color: black;">

                                                                            
                                                                            {{ __('@changeLang('Customer')') }} :
                                                                            {{ __($previous_trip->customer->name ? $previous_trip->customer->name : 'N/A') }}<br>
                                                                            {{ __('@changeLang('Vehicle Name')') }} :
                                                                            {{ __($previous_trip->vehicle->name ? $previous_trip->vehicle->name : 'N/A') }}<br>
                                                                            {{ __('@changeLang('Start Location')') }} :
                                                                            {{ __($previous_trip->start_location ? $previous_trip->start_location : 'N/A') }}<br>
                                                                            {{ __('@changeLang('End Location')') }} :
                                                                            {{ __($previous_trip->end_location ? $previous_trip->end_location : 'N/A') }}<br>
                                                                            {{ __('@changeLang('Trip Duration')') }} :
                                                                            {!! __($previous_trip->duration_month ? '<span>Months:</span>' . $previous_trip->duration_month : '') !!}
                                                                            {!! __($previous_trip->duration_day ? '<span>,Days:</span>' . $previous_trip->duration_day : '') !!}
                                                                            {!! __($previous_trip->duration_hour ? '<span>,Hours:</span>' . $previous_trip->duration_hour : '') !!}<br>
                                                                            {{ __('@changeLang('Trip Date/Time')') }} :
                                                                            {{ date('d-M-y', strtotime($previous_trip->starting_date)) }}|
                                                                            {{ date('h:i A', strtotime($previous_trip->starting_time)) }}<br>
                                                                            {{ __('@changeLang('Status')') }} :
                                                                            <span
                                                                                class="badge {{ $previous_trip->status == 'ordered' ? 'badge-warning' : ($previous_trip->status == 'in-progress' ? 'badge-info' : ($previous_trip->status == 'completed' ? 'badge-success' : 'badge-danger')) }}">
                                                                                {{ $previous_trip->status }}
                                                                            </span><br>
                                                                            {{ __('@changeLang('Passenger Count')') }} :
                                                                            {{ __($previous_trip->passenger_count ? $previous_trip->passenger_count : 'N/A') }}<br>
                                                                            {{ __('@changeLang('Trip Type')') }} :
                                                                            {{ __($previous_trip->trip_type ? $previous_trip->trip_type : 'N/A') }}<br>
                                                                            {{ __('@changeLang('Ac Type')') }} :
                                                                            {{ __($previous_trip->ac_type ? $previous_trip->ac_type : 'N/A') }}<br>
                                                                            {{ __('@changeLang('Rent Description')') }} :
                                                                            {{ __($previous_trip->rent_description ? $previous_trip->rent_description : 'N/A') }}<br>
                                                                            {{ __('@changeLang('Driver')') }} :
                                                                            {{ __($previous_trip->without_driver ? 'No' : 'Yes') }}<br>


                                                                        </p>

                                                                    </div>

                                                                </div>
                                                            </div>


                                                        </div>

                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">@changeLang('Close')</button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                        {{-- modal end --}}
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="100%">@changeLang('No Data Found')</td>
                                        </tr>
                                    @endforelse
                                </table>
                            </div>
                            @if ($previous_trips->hasPages())
                                {{ $previous_trips->links('admin.partials.paginate') }}
                            @endif
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
@endsection


@push('custom-script')
    <script></script>
@endpush
