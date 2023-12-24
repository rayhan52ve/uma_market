@extends('frontend.layout.customer')
@section('customer-breadcumb', 'ড্যাশবোর্ড')
@section('customer-content')
    <div class="team-page pb_60">
        <div class="container">
            <div class="row py-5 justify-content-center">
                <div class="col-lg-2 col-md-6 col-sm-6 col-12 my-1">
                    <a href="{{ route('user.trip-info.index') }}" class="btn btn-block btn-primary bg-orange py-2">আমার অর্ডার
                        দেখুন</a>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 col-12 my-1">
                    <a href="{{ route('user.allBid') }}" class="btn btn-block btn-primary py-2"> ড্রাইভার বিডিং দেখুন </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 my-1">
                    <a href="{{ route('user.profile') }}" class="btn btn-block btn-primary py-2"> প্রোফাইল আপডেট করুন </a>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 col-12 my-1">
                    <a href="{{ route('user.change.password') }}" class="btn btn-block btn-primary py-2">পাসওয়ার্ড
                        পরিবর্তন</a>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 col-12 my-1">
                    <a href="{{ route('user.transaction') }}" class="btn btn-block btn-primary py-2">পেমেন্ট হিস্ট্রি</a>
                </div>
            </div>

            <div class="row justify-content-center mb-5">
                <img src="{{ asset('frontend/images/dashboard_truck.png') }}" alt="" width="40%">
            </div>

            <div class="row">
                <a href="{{ route('user.trip-info.index') }}" class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-truck-pickup"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>@changeLang('Total Trips')</h4>
                            </div>
                            <div class="card-body">
                                {{ $total_trips }}
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('user.trip-info.index') }}" class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-truck-pickup"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>@changeLang('Ordered')</h4>
                            </div>
                            <div class="card-body">
                                {{ $total_ordered_trips }}
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('user.trip-info.index') }}" class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-truck-pickup"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>@changeLang('In Progress')</h4>
                            </div>
                            <div class="card-body">
                                {{ $total_in_progress_trips }}
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('user.trip-info.index') }}" class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-truck-pickup"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>@changeLang('Completed')</h4>
                            </div>
                            <div class="card-body">
                                {{ $total_completed_trips }}
                            </div>
                        </div>
                    </div>
                </a>

                {{-- <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-money-bill"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>@changeLang('Transaction Amount')</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalTransaction . ' ' . $general->site_currency }}
                            </div>
                        </div>
                    </div>
                </div> --}}

                {{-- <div class="col-md-12">
                    <div class="card">
                        <div class="card-head text-center mt-3">
                            <h2>আমার ট্রীপসমূহ</h2>
                        </div>
                        <div class="card-body text-center">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th scope="col">@changeLang('SL')</th>
                                        <th scope="col">@changeLang('Service Name')</th>
                                        <th scope="col">@changeLang('Load Location')</th>
                                        <th scope="col">@changeLang('Unload Location')</th>
                                        <th scope="col">@changeLang('Date / Time')</th>
                                        <th scope="col">@changeLang('Bid Count')</th>
                                        <th scope="col">@changeLang('Status')</th>
                                        <th scope="col">@changeLang('Action')</th>
                                    </tr>

                                    @forelse ($all_trips as $trip)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $trip->vehicle->name }}</td>
                                            <td>{{ $trip->load_location }} </td>
                                            <td>{{ $trip->unload_location }} </td>
                                            <td>{{ date('d-M-Y H:i A', strtotime($trip->loading_date_time)) }}</td>
                                            <td>{{ $trip->bids_count }}</td>
                                            <td>
                                                <span
                                                    class="badge  @if ($trip->status == 0) badge-warning
                                                @elseif ($trip->status == 1)
                                                    badge-info
                                                @elseif ($trip->status == 2)
                                                    badge-success
                                                @else
                                                    badge-danger @endif">
                                                    @if ($trip->status == 0)
                                                        Ordered
                                                    @elseif ($trip->status == 1)
                                                        In Process
                                                    @elseif ($trip->status == 2)
                                                        Completed
                                                    @else
                                                        Canceled
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('user.trip.show', $trip->id) }}"
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
                        </div>

                        @if ($bookings->hasPages())
                            <div class="card-footer">

                                {{ $bookings->links('frontend.partials.paginate') }}

                            </div>
                        @endif
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
