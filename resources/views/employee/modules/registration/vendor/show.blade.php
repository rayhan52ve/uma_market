
@extends('employee.layout.master')

@section('page_title','Vendor Trip List')

@section('employee_content')
<div class="row">

    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">

                <ul class="nav nav-pills" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" id="trucks_tab" data-toggle="tab" href="#trucks" role="tab"
                            aria-controls="trucks" aria-selected="true">@changeLang('Truck')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="buses_tab" data-toggle="tab" href="#buses" role="tab"
                            aria-controls="buses" aria-selected="false">@changeLang('Bus')</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="cars_tab" data-toggle="tab" href="#cars" role="tab"
                            aria-controls="cars" aria-selected="false">@changeLang('Private Car')</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="micro_tab" data-toggle="tab" href="#micro" role="tab"
                            aria-controls="micro" aria-selected="false">@changeLang('Micro')</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="ambulance_tab" data-toggle="tab" href="#ambulance" role="tab"
                            aria-controls="ambulance" aria-selected="false">@changeLang('Ambulance')</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="motor_cycle_tab" data-toggle="tab" href="#motor_cycle" role="tab"
                            aria-controls="motor_cycle" aria-selected="false">@changeLang('Motor Cycle')</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="cng_tab" data-toggle="tab" href="#cng" role="tab"
                            aria-controls="cng" aria-selected="false">@changeLang('C.N.G')</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="van_tab" data-toggle="tab" href="#van" role="tab"
                            aria-controls="van" aria-selected="false">@changeLang('Van')</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="mahindra_tab" data-toggle="tab" href="#mahindra" role="tab"
                            aria-controls="mahindra" aria-selected="false">@changeLang('Mahindra')</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="easy_bike_tab" data-toggle="tab" href="#easy_bike" role="tab"
                            aria-controls="easy_bike" aria-selected="false">@changeLang('Easy Bike')</a>
                    </li>


                </ul>


            </div>
            <div class="card-body text-center">

                <div class="tab-content">
                    <div class="tab-pane fade active show" id="trucks" role="tabpanel" aria-labelledby="trucks_tab">

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr class="text-left">
                                    <th>@changeLang('Sl')</th>
                                    <th>@changeLang('Customer')</th>
                                    <th>@changeLang('Load Location')</th>
                                    <th>@changeLang('Unload Location')</th>
                                    <th>@changeLang('Loading Date/Time')</th>
                                    <th>@changeLang('Truck Type')</th>
                                    <th>@changeLang('Capacity')(টন)</th>
                                    <th>@changeLang('Feet')</th>
                                    <th>@changeLang('Product Description')</th>
                                    <th>@changeLang('Product Tags')</th>
                                </tr>
                                @forelse ($trucks as $truck)
                                    <tr class="text-left">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $truck->customer->fname }}</td>
                                        <td>{{ $truck->start_location }}</td>
                                        <td>{{ $truck->end_location }}</td>
                                        <td>{{ date('d-M-y', strtotime($truck->starting_date)) }} |
                                            {{ date('h:i A', strtotime($truck->starting_time)) }}</td>
                                        <td>{{ $truck->truck_type }}</td>
                                        <td>{{ $truck->ton }}</td>
                                        <td>{{ $truck->feet }}</td>
                                        <td>{{ $truck->product_description }}</td>
                                        <td>{{ $truck->product_tags }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">@changeLang('No Data Found')</td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>
                        @if ($trucks->hasPages())
                            {{ $trucks->links('admin.partials.paginate') }}
                        @endif
                    </div>
                    <div class="tab-pane fade" id="buses" role="tabpanel" aria-labelledby="buses_tab">

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr class="text-left">
                                    <th>@changeLang('Sl')</th>
                                    <th>@changeLang('Customer')</th>
                                    <th>@changeLang('Start Location')</th>
                                    <th>@changeLang('End Location')</th>
                                    <th>@changeLang('Loading Date/Time')</th>
                                    <th>@changeLang('Passenger Count')</th>
                                    <th>@changeLang('Trip Type')</th>
                                    <th>@changeLang('Ac Type')</th>
                                </tr>
                                @forelse ($buses as $bus)
                                    <tr class="text-left">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $bus->customer->fname }}</td>
                                        <td>{{ $bus->start_location }}</td>
                                        <td>{{ $bus->end_location }}</td>
                                        <td>{{ date('d-M-y', strtotime($bus->starting_date)) }} |
                                            {{ date('h:i A', strtotime($bus->starting_time)) }}</td>
                                        <td>{{ $bus->passenger_count }}</td>
                                        <td>{{ $bus->trip_type }}</td>
                                        <td>{{ $bus->ac_type }}</td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">@changeLang('No Data Found')</td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>
                        @if ($buses->hasPages())
                            {{ $buses->links('admin.partials.paginate') }}
                        @endif
                    </div>
                    <div class="tab-pane fade" id="cars" role="tabpanel" aria-labelledby="cars_tab">

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr class="text-left">
                                    <th>@changeLang('Sl')</th>
                                    <th>@changeLang('Customer')</th>
                                    <th>@changeLang('Start Location')</th>
                                    <th>@changeLang('End Location')</th>
                                    <th>@changeLang('Loading Date/Time')</th>
                                    <th>@changeLang('Passenger Count')</th>
                                    <th>@changeLang('Trip Type')</th>
                                    <th>@changeLang('Ac Type')</th>
                                    {{-- <th>Duration(months)</th>
                                    <th>Duration(Days)</th>
                                    <th>Duration(Hours)</th> --}}
                                </tr>
                                @forelse ($cars as $car)
                                    <tr class="text-left">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $car->customer->fname }}</td>
                                        <td>{{ $car->start_location }}</td>
                                        <td>{{ $car->end_location }}</td>
                                        <td>{{ date('d-M-y', strtotime($car->starting_date)) }} |
                                            {{ date('h:i A', strtotime($car->starting_time)) }}
                                        </td>
                                        <td>{{ $car->passenger_count }}</td>
                                        <td>{{ $car->trip_type }}</td>
                                        <td>{{ $car->ac_type }}</td>
                                        {{-- <td>{{ $car->duration_month }}</td>
                                        <td>{{ $car->duration_day }}</td>
                                        <td>{{ $car->duration_hour }}</td> --}}
                                        
                                        {{-- <td><span
                                            class="badge {{ $car->status == 'ordered' ? 'badge-warning' : ($car->status == 'in-progress' ? 'badge-info' : ($car->status == 'completed' ? 'badge-success' : 'badge-danger')) }}">
                                            {{ $car->status }}
                                        </span></td>
                                    <td>

                                        <button class="btn btn-danger delete"><i class="fa fa-trash"></i></button>
                                    </td> --}}
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">@changeLang('No Data Found')</td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>
                        @if ($cars->hasPages())
                            {{ $cars->links('admin.partials.paginate') }}
                        @endif
                    </div>
                    <div class="tab-pane fade" id="micro" role="tabpanel" aria-labelledby="micro_tab">

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr class="text-left">
                                    <th>@changeLang('Sl')</th>
                                    <th>@changeLang('Customer')</th>
                                    <th>@changeLang('Start Location')</th>
                                    <th>@changeLang('End Location')</th>
                                    <th>@changeLang('Loading Date/Time')</th>
                                    <th>@changeLang('Passenger Count')</th>
                                    <th>@changeLang('Trip Type')</th>
                                    <th>@changeLang('Ac Type')</th>
                                </tr>
                                @forelse ($micros as $micro)
                                    <tr class="text-left">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $micro->customer->fname }}</td>
                                        <td>{{ $micro->start_location }}</td>
                                        <td>{{ $micro->end_location }}</td>
                                        <td>{{ date('d-M-y', strtotime($micro->starting_date)) }} |
                                            {{ date('h:i A', strtotime($micro->starting_time)) }}</td>
                                        <td>{{ $micro->passenger_count }}</td>
                                        <td>{{ $micro->trip_type }}</td>
                                        <td>{{ $micro->ac_type }}</td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">@changeLang('No Data Found')</td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>
                        @if ($micros->hasPages())
                            {{ $micros->links('admin.partials.paginate') }}
                        @endif
                    </div>
                    <div class="tab-pane fade" id="ambulance" role="tabpanel" aria-labelledby="ambulance_tab">

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr class="text-left">
                                    <th>@changeLang('Sl')</th>
                                    <th>@changeLang('Customer')</th>
                                    <th>@changeLang('Start Location')</th>
                                    <th>@changeLang('End Location')</th>
                                    <th>@changeLang('Loading Date/Time')</th>
                                    <th>@changeLang('Passenger Count')</th>
                                    <th>@changeLang('Trip Type')</th>
                                    <th>@changeLang('Ac Type')</th>
                                </tr>
                                @forelse ($ambulances as $ambulance)
                                    <tr class="text-left">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $ambulance->customer->fname }}</td>
                                        <td>{{ $ambulance->start_location }}</td>
                                        <td>{{ $ambulance->end_location }}</td>
                                        <td>{{ date('d-M-y', strtotime($ambulance->starting_date)) }} |
                                            {{ date('h:i A', strtotime($ambulance->starting_time)) }}</td>
                                        <td>{{ $ambulance->passenger_count }}</td>
                                        <td>{{ $ambulance->trip_type }}</td>
                                        <td>{{ $ambulance->ac_type }}</td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">@changeLang('No Data Found')</td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>
                        @if ($ambulances->hasPages())
                            {{ $ambulances->links('admin.partials.paginate') }}
                        @endif
                    </div>
                    <div class="tab-pane fade" id="motor_cycle" role="tabpanel" aria-labelledby="motor_cycle_tab">

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr class="text-left">
                                    <th>@changeLang('Sl')</th>
                                    <th>@changeLang('Customer')</th>
                                    <th>@changeLang('Start Location')</th>
                                    <th>@changeLang('End Location')</th>
                                    <th>@changeLang('Loading Date/Time')</th>
                                    <th>@changeLang('Passenger Count')</th>
                                    <th>@changeLang('Trip Type')</th>
                                    <th>@changeLang('Ac Type')</th>
                                </tr>
                                @forelse ($motor_cycles as $motor_cycle)
                                    <tr class="text-left">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $motor_cycle->customer->fname }}</td>
                                        <td>{{ $motor_cycle->start_location }}</td>
                                        <td>{{ $motor_cycle->end_location }}</td>
                                        <td>{{ date('d-M-y', strtotime($motor_cycle->starting_date)) }} |
                                            {{ date('h:i A', strtotime($motor_cycle->starting_time)) }}</td>
                                        <td>{{ $motor_cycle->passenger_count }}</td>
                                        <td>{{ $motor_cycle->trip_type }}</td>
                                        <td>{{ $motor_cycle->ac_type }}</td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">@changeLang('No Data Found')</td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>
                        @if ($motor_cycles->hasPages())
                            {{ $motor_cycles->links('admin.partials.paginate') }}
                        @endif
                    </div>
                    <div class="tab-pane fade" id="cng" role="tabpanel" aria-labelledby="cng_tab">

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr class="text-left">
                                    <th>@changeLang('Sl')</th>
                                    <th>@changeLang('Customer')</th>
                                    <th>@changeLang('Start Location')</th>
                                    <th>@changeLang('End Location')</th>
                                    <th>@changeLang('Loading Date/Time')</th>
                                    <th>@changeLang('Passenger Count')</th>
                                    <th>@changeLang('Trip Type')</th>
                                    <th>@changeLang('Ac Type')</th>
                                </tr>
                                @forelse ($cngs as $cng)
                                    <tr class="text-left">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $cng->customer->fname }}</td>
                                        <td>{{ $cng->start_location }}</td>
                                        <td>{{ $cng->end_location }}</td>
                                        <td>{{ date('d-M-y', strtotime($cng->starting_date)) }} |
                                            {{ date('h:i A', strtotime($cng->starting_time)) }}</td>
                                        <td>{{ $cng->passenger_count }}</td>
                                        <td>{{ $cng->trip_type }}</td>
                                        <td>{{ $cng->ac_type }}</td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">@changeLang('No Data Found')</td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>
                        @if ($cngs->hasPages())
                            {{ $cngs->links('admin.partials.paginate') }}
                        @endif
                    </div>
                    <div class="tab-pane fade" id="van" role="tabpanel" aria-labelledby="van_tab">

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr class="text-left">
                                    <th>@changeLang('Sl')</th>
                                    <th>@changeLang('Customer')</th>
                                    <th>@changeLang('Start Location')</th>
                                    <th>@changeLang('End Location')</th>
                                    <th>@changeLang('Loading Date/Time')</th>
                                    <th>@changeLang('Passenger Count')</th>
                                    <th>@changeLang('Trip Type')</th>
                                    <th>@changeLang('Ac Type')</th>
                                </tr>
                                @forelse ($vans as $van)
                                    <tr class="text-left">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $van->customer->fname }}</td>
                                        <td>{{ $van->start_location }}</td>
                                        <td>{{ $van->end_location }}</td>
                                        <td>{{ date('d-M-y', strtotime($van->starting_date)) }} |
                                            {{ date('h:i A', strtotime($van->starting_time)) }}</td>
                                        <td>{{ $van->passenger_count }}</td>
                                        <td>{{ $van->trip_type }}</td>
                                        <td>{{ $van->ac_type }}</td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">@changeLang('No Data Found')</td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>
                        @if ($vans->hasPages())
                            {{ $vans->links('admin.partials.paginate') }}
                        @endif
                    </div>
                    <div class="tab-pane fade" id="mahindra" role="tabpanel" aria-labelledby="mahindra_tab">

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr class="text-left">
                                    <th>@changeLang('Sl')</th>
                                    <th>@changeLang('Customer')</th>
                                    <th>@changeLang('Start Location')</th>
                                    <th>@changeLang('End Location')</th>
                                    <th>@changeLang('Loading Date/Time')</th>
                                    <th>@changeLang('Passenger Count')</th>
                                    <th>@changeLang('Trip Type')</th>
                                    <th>@changeLang('Ac Type')</th>
                                </tr>
                                @forelse ($mahindras as $mahindra)
                                    <tr class="text-left">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $mahindra->customer->fname }}</td>
                                        <td>{{ $mahindra->start_location }}</td>
                                        <td>{{ $mahindra->end_location }}</td>
                                        <td>{{ date('d-M-y', strtotime($mahindra->starting_date)) }} |
                                            {{ date('h:i A', strtotime($mahindra->starting_time)) }}</td>
                                        <td>{{ $mahindra->passenger_count }}</td>
                                        <td>{{ $mahindra->trip_type }}</td>
                                        <td>{{ $mahindra->ac_type }}</td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">@changeLang('No Data Found')</td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>
                        @if ($mahindras->hasPages())
                            {{ $mahindras->links('admin.partials.paginate') }}
                        @endif
                    </div>
                    <div class="tab-pane fade" id="easy_bike" role="tabpanel" aria-labelledby="easy_bike_tab">

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr class="text-left">
                                    <th>@changeLang('Sl')</th>
                                    <th>@changeLang('Customer')</th>
                                    <th>@changeLang('Start Location')</th>
                                    <th>@changeLang('End Location')</th>
                                    <th>@changeLang('Loading Date/Time')</th>
                                    <th>@changeLang('Passenger Count')</th>
                                    <th>@changeLang('Trip Type')</th>
                                    <th>@changeLang('Ac Type')</th>
                                </tr>
                                @forelse ($easy_bikes as $easy_bike)
                                    <tr class="text-left">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $easy_bike->customer->fname }}</td>
                                        <td>{{ $easy_bike->start_location }}</td>
                                        <td>{{ $easy_bike->end_location }}</td>
                                        <td>{{ date('d-M-y', strtotime($easy_bike->starting_date)) }} |
                                            {{ date('h:i A', strtotime($easy_bike->starting_time)) }}</td>
                                        <td>{{ $easy_bike->passenger_count }}</td>
                                        <td>{{ $easy_bike->trip_type }}</td>
                                        <td>{{ $easy_bike->ac_type }}</td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">@changeLang('No Data Found')</td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>
                        @if ($easy_bikes->hasPages())
                            {{ $easy_bikes->links('admin.partials.paginate') }}
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

