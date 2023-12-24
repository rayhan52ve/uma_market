@extends('frontend.layout.customer')
@section('customer-breadcumb', 'ড্রাইভার বিডিং দেখুন')
@section('customer-content')
    <div class="case-study-home-page case-study-area pt_50 pb_20">
        <div class="container">

            @forelse ($all_bids as $bid)
                <div class="row" id="searchResults">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2 ">
                                        @if (@$bid->provider->image != '')
                                            <img src="{{ getFile('user', $bid->provider->image) }}" alt=""
                                                class="customer_image">
                                        @else
                                            <img src="{{ asset('backend/images/default-user.png') }}" alt=""
                                                class="customer_image">
                                        @endif


                                    </div>
                                    <div class="col-md-10 d-flex align-items-center ">
                                        <div class="row">

                                            @if (!empty($bid->trip->start_location))
                                                <div class=" col-md-4">
                                                    <div class="customer_text">
                                                        @if ($bid->trip->vehicle_id == 1)
                                                            <label class="custom_label">লোড লোকেশন : </label>
                                                        @else
                                                            <label class="custom_label">যাত্রা শুরুর স্থান: </label>
                                                        @endif

                                                        {{ $bid->trip->start_location }}
                                                    </div>
                                                </div>
                                            @endif

                                            @if (!empty($bid->trip->end_location))
                                                <div class=" col-md-4">
                                                    <div class="customer_text">

                                                        @if ($bid->trip->vehicle_id == 1)
                                                            <label class="custom_label">আনলোড লোকেশন : </label>
                                                        @else
                                                            <label class="custom_label">গন্তব্যস্থান: </label>
                                                        @endif

                                                        {{ $bid->trip->end_location }}
                                                    </div>
                                                </div>
                                            @endif

                                            @if (!empty($bid->trip->product_description))
                                                <div class=" col-md-4">
                                                    <div class="customer_text">
                                                        <label class="custom_label">পণ্যের বিবরণ : </label>
                                                        {{ $bid->trip->product_description }}
                                                    </div>
                                                </div>
                                            @endif

                                            @if (!empty($bid->trip->ton))
                                                <div class=" col-md-4">
                                                    <div class="customer_text">
                                                        <label class="custom_label">টন : </label> {{ $bid->trip->ton }}
                                                    </div>
                                                </div>
                                            @endif

                                            @if (!empty($bid->trip->vehicle))
                                                <div class=" col-md-4">

                                                    <div class="customer_text">
                                                        <label class="custom_label">গাড়ীর ধরণ : </label>
                                                        {{ $bid->trip->vehicle->name }}
                                                    </div>

                                                </div>
                                            @endif

                                            @if (!empty($bid->trip->starting_date))
                                                <div class="col-md-4">
                                                    <div class="customer_text">
                                                        @if ($bid->trip->vehicle_id == 1)
                                                            <label class="custom_label">লোডের তারিখ : </label>
                                                        @else
                                                            <label class="custom_label">যাত্রার তারিখ : </label>
                                                        @endif
                                                        {{ date('d-M-y', strtotime($bid->trip->starting_date)) }}
                                                    </div>
                                                </div>
                                            @endif

                                            @if (!empty($bid->trip->starting_time))
                                                <div class="col-md-4">
                                                    <div class="customer_text">
                                                        @if ($bid->trip->vehicle_id == 1)
                                                            <label class="custom_label">লোডের সময় : </label>
                                                        @else
                                                            <label class="custom_label">যাত্রার সময় : </label>
                                                        @endif
                                                        {{ date('h:i A', strtotime($bid->trip->starting_time)) }}
                                                    </div>
                                                </div>
                                            @endif

                                            @if (!empty($bid->bid_amount))
                                                <div class="col-md-4">
                                                    <div class="customer_text">
                                                        <label class="custom_label"> বিড এমাউন্ট: </label>
                                                        {{ $bid->bid_amount }}
                                                    </div>
                                                </div>
                                            @endif

                                            @if (!empty($bid->trip->passenger_count))
                                                <div class="col-md-4">
                                                    <label class="custom_label">যাত্রী সংখা: </label>
                                                     {{ $bid->trip->passenger_count }}
                                                </div>
                                            @endif

                                            @if (!empty($bid->status))
                                                <div class="col-md-4">
                                                    <div class="customer_text">
                                                        <label class="custom_label"> @changeLang('Status'): </label>
                                                        {!! $bid->status == 2
                                                            ? "<span class='badge badge-danger'>Rejected</span>"
                                                            : "<span class='badge badge-success'>Accepted</span>" !!}
                                                    </div>
                                                </div>
                                            @endif

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @empty
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="text-center">@changeLang('No Data found')</h5>
                    </div>
                </div>
            @endforelse

        </div>
    </div>
@endsection
