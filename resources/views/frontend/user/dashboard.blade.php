@extends('frontend.layout.master')
@section('breadcrumb')
    <section class="section">
        <div class="section-header">

            <h1>@changeLang('Dashboard')</h1>

        </div>
    </section>
@endsection
@section('content')

    @if (auth()->user()->user_type == 2)
        <div class="text-center mb-3">
            @foreach ($vehicleTypes as $vehicleType)
                <span>
                    <a href="{{ route('user.vehicle.dashboard', $vehicleType->id) }}"
                        class="btn custom_btn_lg btn-info mb-2">{{ $vehicleType->name }}</a>
                </span>
            @endforeach

            <span>
                <a href="#" class="btn custom_btn_lg btn-info mb-2">ক্রেন</a>
            </span>
            <span>
                <a href="#" class="btn custom_btn_lg btn-info mb-2">কার্গো জাহাজ ভাড়া</a>
            </span>
            <span>
                <a href="#" class="btn custom_btn_lg btn-info mb-2">ডাক্তার</a>
            </span>
            <span>
                <a href="#" class="btn custom_btn_lg btn-info mb-2">ডায়গনস্টিক সেন্টার</a>
            </span>
            <span>
                <a href="#" class="btn custom_btn_lg btn-info mb-2">ফারমেসি</a>
            </span>
            <span>
                <a href="#" class="btn custom_btn_lg btn-info mb-2">বাসা ভাড়া</a>
            </span>
            <span>
                <a href="#" class="btn custom_btn_lg btn-info mb-2">হোটেল ভাড়া</a>
            </span>
            <span>
                <a href="#" class="btn custom_btn_lg btn-info mb-2">হিউমান রেন্ট</a>
            </span>
            <span>
                <a href="#" class="btn custom_btn_lg btn-info mb-2">সকল সার্ভিস</a>
            </span>

            <span>
                <a href="#" class="btn custom_btn_lg btn-info mb-2">পাইকারি বাঁজার</a>
            </span>

            <span>
                <a href="#" class="btn custom_btn_lg btn-info mb-2">নিত্যপ্রয়োজনীয় জিনিসপত্র</a>
            </span>

            <span>
                <a href="#" class="btn custom_btn_lg btn-info mb-2">সার্ভিসকৃষি যানবাহন ভাড়া</a>
            </span>

            <span>
                <a href="#" class="btn custom_btn_lg btn-info mb-2">জেনে রাখা ভাল</a>
            </span>

        </div>

        <div class="row mt-5">

            <div class="col-12">

                <div class="alert alert-primary alert-has-icon">
                    <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                    <div class="alert-body">
                        <div class="alert-title" style="font-size: 1.4em">Welcome to our provider panel!</div>
                        We are excited to have you as a new provider on our platform.
                        Please make sure to set up your services by creating a <a
                            href="{{ route('user.service.create', ['vehicle_id' => 0]) }}"
                            style="font-weight: 700; font-size:1.3em; text-decoration:underline">Service</a>
                    </div>
                </div>

            </div>
        </div>





        <h1> </h1>
    @else
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
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
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
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
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
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
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
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
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
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
            </div>


            <div class="col-md-12">

                <div class="card">


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
                                                class="badge {{ $trip->status == 'ordered' ? 'badge-warning' : ($trip->status == 'in-progress' ? 'badge-info' : ($trip->status == 'completed' ? 'badge-success' : 'badge-danger')) }}">
                                                {{ $trip->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('user.trip.show', $trip->id) }}"
                                                class="btn custom_btn_lg btn-icon btn-primary icon-left"><i
                                                    class="far fa-eye"></i>
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

            </div>
        </div>
    @endif





@endsection

@push('custom-style')
    <style>
        .font-25 {
            font-size: 25px;
        }
    </style>
@endpush


@push('custom-script')
    <script>
        $(function() {
            'use strict'

            $('.complete').on('click', function() {
                const modal = $('#complete');
                modal.find('form').attr('action', $(this).data('url'))
                modal.modal('show');
            })
        })
    </script>
@endpush


@push('custom-script')
    <script>
        $(function() {
            'use strict'

            $('.accept').on('click', function(e) {
                e.preventDefault();

                const modal = $('#modelId');

                modal.find('.alert-text').text('Are you sure to accept this booking ?');

                modal.find('.modal-title').text('Accept Booking');

                modal.find('form').attr('action', $(this).data('url'));

                modal.modal('show');

            })

            $('.reject').on('click', function(e) {
                e.preventDefault();

                const modal = $('#modelId');

                modal.find('.alert-text').text("@changeLang('Are you sure to reject this booking')?");

                modal.find('.modal-title').text("@changeLang('Reject Booking')");

                modal.find('form').attr('action', $(this).data('url'));

                modal.modal('show');

            })

            $('.delete').on('click', function() {
                const modal = $('#delete');

                modal.find('form').attr('action', $(this).data('href'));

                modal.modal('show');
            })

            $('.userdata').on('click', function(e) {
                e.preventDefault();

                const modal = $('#confirm');

                let user = $(this).data('user');
                let booking = $(this).data('booking');

                let userAddress = '';

                user.address != null ? userAddress = user.address.address : '';



                let html = `

                                    <tr>
                                        <td>@changeLang('Booking Id')</td>
                                        <td>${booking.trx}</td>
                                    </tr>
                                    <tr>
                                        <td>@changeLang('Total Hours')</td>
                                        <td>${$(this).data('hours')}</td>
                                    </tr>

                                     <tr>
                                        <td>@changeLang('Service Date')</td>
                                        <td>${new Date(booking.service_date).toDateString()}</td>
                                    </tr>

                                    <tr>
                                        <td>@changeLang('Service Location')</td>
                                        <td>${booking.location}</td>
                                    </tr>

                                    <tr>
                                        <td>@changeLang('Booking Time')</td>
                                        <td>${$(this).data('date')}</td>
                                    </tr>

                                    <tr>
                                        <td>@changeLang('User Name')</td>
                                        <td>${user.fname +' '+ user.lname}</td>
                                    </tr>

                                    <tr>
                                        <td>@changeLang('Mobile Number')</td>
                                        <td>${user.mobile ?? 'N/A'}</td>
                                    </tr>

                                    <tr>
                                        <td>@changeLang('Email')</td>
                                        <td>${user.email}</td>
                                    </tr>

                                    <tr>
                                        <td>@changeLang('Address')</td>
                                        <td>${userAddress ?? 'N/A'}</td>
                                    </tr>

                                    <tr>
                                        <td>@changeLang('City')</td>
                                        <td>${user.address.city ?? 'N/A'}</td>
                                    </tr>

                                    <tr>
                                        <td>@changeLang('Zip')</td>
                                        <td>${user.address.zip ?? 'N/A'}</td>
                                    </tr>

                                    <tr>
                                        <td>@changeLang('Country')</td>
                                        <td>${user.address.country ?? 'N/A'}</td>
                                    </tr>


                                    <tr>
                                        <td>@changeLang('Message')</td>
                                        <td>${booking.message}</td>
                                    </tr>




                `;

                modal.find('.user-data').html(html);

                modal.modal('show');

            })

            $('.contract').on('click', function(e) {
                e.preventDefault();

                const modal = $('#modelId');

                modal.find('.alert-text').text("@changeLang('Are you sure to end this contract')?");

                modal.find('.modal-title').text("@changeLang('Request admin to end contract')");

                modal.find('form').attr('action', $(this).data('url'));

                modal.modal('show');

            })


        })
    </script>
@endpush
