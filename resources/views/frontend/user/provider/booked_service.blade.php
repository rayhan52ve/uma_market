@extends('frontend.layout.master')
@section('breadcrumb')
 <section class="section">
          <div class="section-header">
        
            <h1>@changeLang('Booked Services')</h1>
      
          
        
          </div>
</section>
@endsection
@section('content')

    <div class="row">

        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">

                    <h4>
                    </h4>

                    <div class="card-header-form">
                        <form method="GET" action="{{ route('user.provider.booking.search') }}">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="card-body text-center">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>@changeLang('Sl')</th>
                                <th>@changeLang('Service Name')</th>
                                <th>@changeLang('Rate')</th>
                                <th>@changeLang('Duration')</th>
                                <th>@changeLang('Amount')</th>
                                <th>@changeLang('Status')</th>
                                <th>@changeLang('Action')</th>
                            </tr>

                            @forelse ($bookings as $key => $booking)
                                <tr>
                                    <td>{{ $key + $bookings->firstItem() }}</td>

                                    <td>{{ @$booking->service->name }}</td>

                                    <td>{{ $general->currency_icon . '' . $booking->service->rate }}</td>
                                    <td>
                                       
                                        @switch($booking->service->duration)
                                            @case(0)
                                                @changeLang('Hourly')
                                            @break
                                            @case(1)
                                                @changeLang('Daily')
                                            @break
                                            @case(2)
                                                @changeLang('Weekly')
                                            @break

                                            @case(3)
                                                @changeLang('Monthly')
                                            @break

                                            @case(4)
                                                @changeLang('Yearly')
                                            @break

                                            @default
                                                @changeLang('Fixed')

                                        @endswitch


                                    </td>
                                    <td>{{ $general->currency_icon . '' . $booking->amount }}</td>
                                    <td>
                                       
                                        @if ($booking->is_completed)
                                            <span class="badge badge-success">@changeLang('Completed')</span>
                                        @elseif($booking->payment_confirmed == 1)
                                            <span class="badge badge-success">@changeLang('In Progress')</span>
                                        @elseif($booking->payment_confirmed == 2)
                                            <span class="badge badge-warning">@changeLang('Payment Pending')</span>
                                        @elseif($booking->payment_confirmed == 3)
                                            <span class="badge badge-danger">@changeLang('Payment Rejected')</span>
                                        @elseif ($booking->is_accepted == 0)
                                            <span class="badge badge-warning">@changeLang('Pending')</span>
                                        @elseif ($booking->is_accepted == 1)
                                            <span class="badge badge-success">@changeLang('Accepted')</span>
                                        @elseif($booking->is_accepted == 2)
                                            <span class="badge badge-danger">@changeLang('Rejected')</span>

                                        @endif


                                    </td>
                                    <td>
                                   
                                        @if ($booking->is_accepted == 0)
                                            <button class="btn btn-success accept"
                                                data-url="{{ route('user.service.booking.accept', $booking) }}">@changeLang('Accept')</button>
                                            <button class="btn btn-danger reject"
                                                data-url="{{ route('user.service.booking.reject', $booking) }}">@changeLang('Reject')</button>

                                        @endif

                                        @if ($booking->is_completed && $booking->job_end == 0)

                                            <button class="btn btn-primary contract"
                                                data-url="{{ route('user.end.contract', $booking) }}">
                                                @changeLang('End Contract')</button>

                                        @endif

                                        <button class="btn btn-info userdata" data-user="{{ $booking->user }}"
                                            data-booking="{{ $booking }}" data-hours="{{ $booking->hours . 'h' }}"
                                            data-date="{{ \Carbon\Carbon::parse($booking->start_time)->format('h:i A') }}"
                                            data-service_date="{{ \Carbon\Carbon::parse($booking->service_date)->format('d F Y') }}">@changeLang('Details')</button>
                                        @if ($booking->job_end == 0)
                                            <a class="btn btn-primary"
                                                href="{{ route('user.chat', $booking->trx) }}">@changeLang('Chat')</a>
                                        @endif
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
                </div>
            </div>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="" method="post">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <p class="alert-text">@changeLang('Are you Sure To Accept This Booking')</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">@changeLang('Close')</button>
                            <button type="submit" class="btn btn-primary">@changeLang('Save')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@changeLang('Booking Details')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">

                                <div class="col-md-12">
                                    <table class="user-data table table-bordered p-0">




                                    </table>
                                </div>



                            </div>



                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@changeLang('Close')</button>
                    </div>
                </div>
            </div>
        </div>

    @endsection

    @push('custom-script')
        <script>
            $(function() {
                'use strict'

                $('.accept').on('click', function(e) {
                    e.preventDefault();

                    const modal = $('#modelId');

                    modal.find('.alert-text').text("{{changeDynamic('Are you sure to accept this booking')}}?");

                    modal.find('.modal-title').text("{{changeDynamic('Accept Booking')}}");

                    modal.find('form').attr('action', $(this).data('url'));

                    modal.modal('show');

                })

                $('.reject').on('click', function(e) {
                    e.preventDefault();

                    const modal = $('#modelId');

                    modal.find('.alert-text').text("{{changeDynamic('Are you sure to reject this booking')}}?");

                    modal.find('.modal-title').text("{{changeDynamic('Reject Booking')}}");

                    modal.find('form').attr('action', $(this).data('url'));

                    modal.modal('show');

                })

                $('.contract').on('click', function(e) {
                    e.preventDefault();

                    const modal = $('#modelId');

                    modal.find('.alert-text').text("{{changeDynamic('Are you sure to end this contract')}}?");

                    modal.find('.modal-title').text("{{changeDynamic('Request admin to end contract')}}");

                    modal.find('form').attr('action', $(this).data('url'));

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
                                        <td>@changeLang('Service Message From User')</td>
                                        <td>${booking.message}</td>
                                    </tr>
                                   
                
                
                
                `;

                    modal.find('.user-data').html(html);

                    modal.modal('show');

                })



            })
        </script>
    @endpush
