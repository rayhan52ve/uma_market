@extends('employee.layout.master')

@section('page_title','Search Employee')
@section('employee_content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
               <h4></h4>
                <div class="card-header-form">
                    <form method="GET" action="{{ route('agent.search') }}">
                        <div class="row">
                            <div class="input-group ">
                                <input type="text" class="form-control" placeholder="Enter Referral Code " name="search">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

            <div class="card mt-4 mx-auto bg-gradient-secondary " style="width: 30rem;">
                <div class="card-body">
                    @if ($employee)
                    <div class="text-center">
                        <h6 class="card-title"><b>@changeLang('User Details')</b></h6>
                    </div>
                        <p class="card-text"><b>@changeLang('Full Name') :</b> {{ __($employee->fullname) }}</p>
                        <p class="card-text"><b>@changeLang('Phone') :</b> {{ __($employee->mobile) }}</p>
                        <p class="card-text"><b>@changeLang('Email') :</b> {{ __($employee->email) }}</p>
                        <p class="card-text"><b>@changeLang('Location') : </b> {{ __(@$employee->division->bn_name) }},{{ __(@$employee->district->bn_name) }},{{ __(@$employee->upazila->bn_name) }}</p>
                    @else
                        <p class="card-text">@changeLang('No users Found')</p>
                    @endif
                </div>


        </div>

          </div>
          <div class="container-fluid px-4">
            <div class="row">
                <div class="col-xl-3  col-md-4">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">Vendor
                            <h1 class="">{{ $totalProvider }}</h1>
                        </div>

                    </div>
                </div>
                <div class="col-xl-3 col-md-4">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Customer
                            <h1 class="">{{ $totalCustomer}}</h1>
                        </div>

                    </div>
                </div>
                <div class="col-xl-3 col-md-4">
                    <div class="card bg-success  text-white mb-4">
                        <div class="card-body">Order Confirm
                            <h1 class="">{{ $confirmedOrders }}</h1>
                        </div>

                    </div>
                </div>
            </div>
          </div>

          <div class="row">

            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">

                        <ul class="nav nav-pills" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" id="all_trips_tab" data-toggle="tab" href="#all_trips"
                                    role="tab" aria-controls="all_trips" aria-selected="true">All Trips</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="current_trips_tab" data-toggle="tab" href="#current_trips"
                                    role="tab" aria-controls="current_trips" aria-selected="false">Current Trips</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="canceled_trips_tab" data-toggle="tab" href="#canceled_trips"
                                    role="tab" aria-controls="canceled_trips" aria-selected="false">Canceled Trips</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="pending_trips_tab" data-toggle="tab" href="#pending_trips"
                                    role="tab" aria-controls="pending_trips" aria-selected="false">Pending Trips</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="previous_trips_tab" data-toggle="tab" href="#previous_trips"
                                    role="tab" aria-controls="previous_trips" aria-selected="false">Previous Trips</a>
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
                                            <th>Customer</th>
                                            <th>Load Location</th>
                                            <th>Unload Location</th>
                                            <th>Loading Date/Time</th>
                                            <th>Status</th>
                                        </tr>
                                        @forelse ($all_trips as $all_trip)
                                            <tr class="text-left">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $all_trip->customer->fname }}</td>
                                                <td>{{ $all_trip->start_location }}</td>
                                                <td>{{ $all_trip->end_location }}</td>
                                                <td>{{ date('d-M-y', strtotime($all_trip->starting_date)) }} | {{ date('h:i A', strtotime($all_trip->starting_time)) }}</td>
                                                <td><span
                                                        class="badge {{ $all_trip->status == 'ordered' ? 'bg-warning' : ($all_trip->status == 'in-progress' ? 'bg-info' : ($all_trip->status == 'completed' ? 'bg-success' : 'bg-danger')) }}">
                                                        {{ $all_trip->status }}
                                                    </span></td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center" colspan="100%">@changeLang('No Data Found')</td>
                                            </tr>
                                        @endforelse
                                    </table>
                                </div>
                                @if ($all_trips->hasPages())
                                    {{ $all_trips->links('agent.partials.paginate') }}
                                @endif
                            </div>
                            <div class="tab-pane fade" id="current_trips" role="tabpanel" aria-labelledby="current_trips_tab">

                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tr class="text-left">
                                            <th>@changeLang('Sl')</th>
                                            <th>Customer</th>
                                            <th>Load Location</th>
                                            <th>Unload Location</th>
                                            <th>Loading Date/Time</th>
                                            <th>Status</th>
                                        </tr>
                                        @forelse ($current_trips as $current_trip)
                                            <tr class="text-left">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $current_trip->customer->fname }}</td>
                                                <td>{{ $current_trip->start_location }}</td>
                                                <td>{{ $current_trip->end_location }}</td>
                                                <td>{{ date('d-M-y', strtotime($current_trip->starting_date)) }} | {{ date('h:i A', strtotime($current_trip->starting_time)) }}</td>
                                                <td><span
                                                        class="badge {{ $current_trip->status == 'ordered' ? 'bg-warning' : ($current_trip->status == 'in-progress' ? 'bg-info' : ($current_trip->status == 'completed' ? 'bg-success' : 'bg-danger')) }}">
                                                        {{ $current_trip->status }}
                                                    </span></td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center" colspan="100%">@changeLang('No Data Found')</td>
                                            </tr>
                                        @endforelse
                                    </table>
                                </div>
                                @if ($current_trips->hasPages())
                                    {{ $current_trips->links('agent.partials.paginate') }}
                                @endif
                            </div>
                            <div class="tab-pane fade" id="canceled_trips" role="tabpanel" aria-labelledby="canceled_trips_tab">

                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tr class="text-left">
                                            <th>@changeLang('Sl')</th>
                                            <th>Customer</th>
                                            <th>Load Location</th>
                                            <th>Unload Location</th>
                                            <th>Loading Date/Time</th>
                                            <th>Status</th>
                                        </tr>
                                        @forelse ($canceled_trips as $canceled_trip)
                                            <tr class="text-left">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $canceled_trip->customer->fname }}</td>
                                                <td>{{ $canceled_trip->start_location }}</td>
                                                <td>{{ $canceled_trip->end_location }}</td>
                                                <td>{{ date('d-M-y', strtotime($canceled_trip->starting_date)) }} | {{ date('h:i A', strtotime($canceled_trip->starting_time)) }}
                                                </td>
                                                <td><span
                                                        class="badge {{ $canceled_trip->status == 'ordered' ? 'bg-warning' : ($canceled_trip->status == 'in-progress' ? 'bg-info' : ($canceled_trip->status == 'completed' ? 'bg-success' : 'bg-danger')) }}">
                                                        {{ $canceled_trip->status }}
                                                    </span></td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center" colspan="100%">@changeLang('No Data Found')</td>
                                            </tr>
                                        @endforelse
                                    </table>
                                </div>
                                @if ($canceled_trips->hasPages())
                                    {{ $canceled_trips->links('agent.partials.paginate') }}
                                @endif
                            </div>

                            <div class="tab-pane fade" id="pending_trips" role="tabpanel" aria-labelledby="pending_trips_tab">

                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tr class="text-left">
                                            <th>@changeLang('Sl')</th>
                                            <th>Customer</th>
                                            <th>Load Location</th>
                                            <th>Unload Location</th>
                                            <th>Loading Date/Time</th>
                                            <th>Status</th>
                                        </tr>
                                        @forelse ($pending_trips as $pending_trip)
                                            <tr class="text-left">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $pending_trip->customer->fname }}</td>
                                                <td>{{ $pending_trip->start_location }}</td>
                                                <td>{{ $pending_trip->end_location }}</td>
                                                <td>{{ date('d-M-y', strtotime($pending_trip->starting_date)) }} | {{ date('h:i A', strtotime($pending_trip->starting_time)) }}
                                                </td>
                                                <td><span
                                                        class="badge {{ $pending_trip->status == 'ordered' ? 'bg-warning' : ($pending_trip->status == 'in-progress' ? 'bg-info' : ($pending_trip->status == 'completed' ? 'bg-success' : 'bg-danger')) }}">
                                                        {{ $pending_trip->status }}
                                                    </span></td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center" colspan="100%">@changeLang('No Data Found')</td>
                                            </tr>
                                        @endforelse
                                    </table>
                                </div>
                                @if ($pending_trips->hasPages())
                                    {{ $pending_trips->links('agent.partials.paginate') }}
                                @endif
                            </div>

                            <div class="tab-pane fade" id="previous_trips" role="tabpanel"
                                aria-labelledby="previous_trips_tab">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tr class="text-left">
                                            <th>@changeLang('Sl')</th>
                                            <th>Customer</th>
                                            <th>Load Location</th>
                                            <th>Unload Location</th>
                                            <th>Loading Date/Time</th>
                                            <th>Status</th>
                                        </tr>
                                        @forelse ($previous_trips as $previous_trip)
                                            <tr class="text-left">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $previous_trip->customer->fname }}</td>
                                                <td>{{ $previous_trip->start_location }}</td>
                                                <td>{{ $previous_trip->end_location }}</td>
                                                <td>{{ date('d-M-y', strtotime($previous_trip->starting_date)) }} | {{ date('h:i A', strtotime($previous_trip->starting_time)) }}
                                                </td>
                                                <td><span
                                                        class="badge {{ $previous_trip->status == 'ordered' ? 'bg-warning' : ($previous_trip->status == 'in-progress' ? 'bg-info' : ($previous_trip->status == 'completed' ? 'bg-success' : 'bg-danger')) }}">
                                                        {{ $previous_trip->status }}
                                                    </span></td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center" colspan="100%">@changeLang('No Data Found')</td>
                                            </tr>
                                        @endforelse
                                    </table>
                                </div>
                                @if ($previous_trips->hasPages())
                                    {{ $previous_trips->links('agent.partials.paginate') }}
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>




    </div>
</div>


@endsection
