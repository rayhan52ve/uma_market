@extends('frontend.layout.master')
@section('breadcrumb')
    <section class="section">
        <div class="section-header">

            <h1>আমার বিডিং {{ ' ( ' . $vehicle . ' )' }}</h1>

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


    @forelse ($all_bids as $bid)
        <div class="row" id="searchResults">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2 ">
                                @if ($bid->trip->customer->image != '')
                                    <img src="{{ getFile('user', $bid->trip->customer->image) }}" alt=""
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
                                                <label class="custom_label">লোডের তারিখ : </label>
                                                {{ date('d-M-y', strtotime($bid->trip->starting_date)) }}
                                            </div>
                                        </div>
                                    @endif

                                    @if (!empty($bid->trip->starting_time))
                                        <div class="col-md-4">
                                            <div class="customer_text">
                                                <label class="custom_label">লোডের সময় : </label>
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
                <h5 class="text-center">No Data available</h5>
            </div>
        </div>
    @endforelse
@endsection

@push('custom-style')
    <style>
        .customer_image {
            width: 100%;
            border-radius: 50%;
        }

        .customer_text {
            font-size: 1.4em;
        }

        .custom_label {
            font-weight: 600;
            font-size: 1em;
            color: #828282;
        }

        @media (max-width: 480px) {

            .customer_image {
                margin-bottom: 1rem
            }

        }
    </style>
@endpush
