@extends('frontend.layout.master')
@section('breadcrumb')
    <section class="section">

        <div class="section-header d-flex justify-content-between">

            <h1 class=" w-100 text-center">@changeLang('Trips in Progress')</h1>

            <a href="{{ route('user.dashboard') }}" class="btn btn-link">
                <i class="fa fa-home"></i>
            </a>
        </div>
    </section>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5>ট্রিপের তথ্য </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3 row">
                            <label class="custom_label col-md-6">গাড়ির ধরন: </label>
                            <span class="custom_text col-md-6">{{ $trip->vehicle->name }}</span>
                        </div>

                        <div class="col-md-6 mb-3 row">
                            @if ($trip->vehicle_id == 1)
                                <label class="custom_label col-md-6">লোড লোকেশন : </label>
                            @else
                                <label class="custom_label col-md-6">যাত্রা শুরুর স্থান: </label>
                            @endif
                            <span class="custom_text col-md-6">{{ $trip->start_location }}</span>
                        </div>

                        <div class="col-md-6 mb-3 row">
                            @if ($trip->vehicle_id == 1)
                                <label class="custom_label col-md-6">আনলোড লোকেশন : </label>
                            @else
                                <label class="custom_label col-md-6">গন্তব্যস্থান: </label>
                            @endif
                            <span class="custom_text col-md-6">{{ $trip->end_location }}</span>
                        </div>
                        @if ($trip->vehicle_id == 5 && $trip->without_driver == 1)
                            <div class="col-md-6 mb-3 row">
                                @if ($trip->bike_model_id)
                                    <label class="custom_label col-md-6">চালকের ধরন : </label>
                                    <span class="custom_text col-md-6">চালক ছাড়া </span>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3 row">
                                @if ($trip->bike_brand_id)
                                    <label class="custom_label col-md-6">বাইকের ব্রান্ড : </label>
                                    <span class="custom_text col-md-6">{{ $trip->bikeBrand->name }}</span>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3 row">
                                @if ($trip->bike_model_id)
                                    <label class="custom_label col-md-6">বাইকের মডেল : </label>
                                    <span class="custom_text col-md-6">{{ $trip->bikeModel->name }}</span>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3 row">
                                @if ($trip->bike_model_id)
                                    <label class="custom_label col-md-6">বাইকের সিসি : </label>
                                    <span class="custom_text col-md-6">{{ $trip->bikeModel->engine_displacement }} CC</span>
                                @endif
                            </div>
                        @endif
                        @if (!empty($trip->starting_date))
                            <div class="col-md-6 mb-3 row">
                                <label class="custom_label col-md-6">লোডের তারিখ : </label>
                                <span class="custom_text col-md-6">
                                    {{ date('d-M-y', strtotime($trip->starting_date)) }}</span>
                            </div>
                        @endif
                        {{-- aktar --}}
                        @if (!empty($trip->starting_time))
                            <div class="col-md-6 mb-3 row">
                                <label class="custom_label col-md-6">লোডের সময় : </label>
                                <span class="custom_text col-md-6">
                                    {{ date('h:i A', strtotime($trip->starting_time)) }}
                                    </span>
                            </div>
                        @endif

                        @if (!empty($trip->passenger_count))
                            <div class="col-md-6 mb-3 row">
                                <label class="custom_label col-md-6">যাত্রী সংখা: </label>
                                <span class="custom_text col-md-6"> {{ $trip->passenger_count }}</span>
                            </div>
                        @endif

                        @if (!empty($trip->receiver_mobile))
                            <div class="col-md-6 mb-3 row">
                                <label class="custom_label col-md-6">পণ্য গ্রহনকারীর মোবাইল নাম্বার : </label>
                                <span class="custom_text col-md-6"> {{ $trip->receiver_mobile }}</span>
                            </div>
                        @endif

                        @if (!empty($trip->truck_type))
                            <div class="col-md-6 mb-3 row">
                                <label class="custom_label col-md-6">ট্রাকের ধরন : </label>
                                <span class="custom_text col-md-6"> {{ $trip->truck->name }}</span>
                            </div>
                        @endif

                        @if (!empty($trip->ton))
                            <div class="col-md-6 mb-3 row">
                                <label class="custom_label col-md-6"> কত টন : </label>
                                <span class="custom_text col-md-6"> {{ $trip->ton }}</span>
                            </div>
                        @endif

                        @if (!empty($trip->feet))
                            <div class="col-md-6 mb-3 row">
                                <label class="custom_label col-md-6"> কত ফিট : </label>
                                <span class="custom_text col-md-6"> {{ $trip->feet }}</span>
                            </div>
                        @endif

                        @if (!empty($trip->second_load_location))
                            <div class="col-md-6 mb-3 row">
                                <label class="custom_label col-md-6"> দ্বিতীয় লোড লোকেশন : </label>
                                <span class="custom_text col-md-6"> {{ $trip->second_load_location }}</span>
                            </div>
                        @endif

                        @if (!empty($trip->second_unload_location))
                            <div class="col-md-6 mb-3 row">
                                <label class="custom_label col-md-6"> দ্বিতীয় আনলোড লোকেশন : </label>
                                <span class="custom_text col-md-6"> {{ $trip->second_unload_location }}</span>
                            </div>
                        @endif

                        @if (!empty($trip->second_provider_mobile))
                            <div class="col-md-6 mb-3 row">
                                <label class="custom_label col-md-6"> দ্বিতীয় পণ্য প্রদানকারীর মোবাইল নম্বর : </label>
                                <span class="custom_text col-md-6"> {{ $trip->second_provider_mobile }}</span>
                            </div>
                        @endif

                        @if (!empty($trip->second_receiver_mobile))
                            <div class="col-md-6 mb-3 row">
                                <label class="custom_label col-md-6"> দ্বিতীয় পণ্য গ্রহণকারীর মোবাইল নম্বর : </label>
                                <span class="custom_text col-md-6"> {{ $trip->second_receiver_mobile }}</span>
                            </div>
                        @endif


                        @if (!empty($trip->third_load_location))
                            <div class="col-md-6 mb-3 row">
                                <label class="custom_label col-md-6"> তৃতীয় লোড লোকেশন : </label>
                                <span class="custom_text col-md-6"> {{ $trip->third_load_location }}</span>
                            </div>
                        @endif

                        @if (!empty($trip->third_unload_location))
                            <div class="col-md-6 mb-3 row">
                                <label class="custom_label col-md-6"> তৃতীয় আনলোড লোকেশন : </label>
                                <span class="custom_text col-md-6"> {{ $trip->third_unload_location }}</span>
                            </div>
                        @endif

                        @if (!empty($trip->third_provider_mobile))
                            <div class="col-md-6 mb-3 row">
                                <label class="custom_label col-md-6"> তৃতীয় পণ্য প্রদানকারীর মোবাইল নম্বর : </label>
                                <span class="custom_text col-md-6"> {{ $trip->third_provider_mobile }}</span>
                            </div>
                        @endif

                        @if (!empty($trip->third_receiver_mobile))
                            <div class="col-md-6 mb-3 row">
                                <label class="custom_label col-md-6"> তৃতীয় পণ্য গ্রহণকারীর মোবাইল নম্বর: </label>
                                <span class="custom_text col-md-6"> {{ $trip->third_receiver_mobile }}</span>
                            </div>
                        @endif

                        @if (!empty($trip->trip_type))
                            <div class="col-md-6 mb-3 row">

                                <label class="custom_label col-md-6">ট্রিপের ধরন: </label>
                                <span class="custom_text col-md-6">
                                    {{ $trip->trip_type == 'single' ? 'সিঙ্গেল ট্রিপ' : 'আপ-ডাউন ট্রিপ' }}</span>
                            </div>
                        @endif

                        @if (!empty($trip->ac_type))
                            <div class="col-md-6 mb-3 row">
                                <label class="custom_label col-md-6">এসি বিবরণ : </label>
                                <span class="custom_text col-md-6">
                                    {{ $trip->ac_type == 'ac' ? 'এসি সহ' : 'এসি ছাড়া' }}</span>
                            </div>
                        @endif

                        @if (!empty($trip->duration_month) || !empty($trip->duration_day) || !empty($trip->duration_hour))
                            <div class="col-md-6 mb-3 row">

                                <label class="custom_label col-md-6">ট্রিপের সময় : </label>

                                <span class="col-md-6">
                                    @if (!empty($trip->duration_month))
                                        <span class="custom_text "> {{ $trip->duration_month }} মাস</span>
                                    @endif

                                    @if (!empty($trip->duration_day))
                                        <span class="custom_text "> {{ $trip->duration_day }} দিন</span>
                                    @endif

                                    @if (!empty($trip->duration_hour))
                                        <span class="custom_text "> {{ $trip->duration_hour }} ঘন্টা</span>
                                    @endif

                                </span>

                            </div>
                        @endif


                        @if (!empty($trip->rent_description))
                            <div class="col-md-6 mb-3 row">
                                <label class="custom_label col-md-6">ট্রিপের বিবরণ : </label>
                                <span class="custom_text col-md-6"> {{ $trip->rent_description }}</span>
                            </div>
                        @endif

                        @if (!empty($trip->life_support_type))
                            <div class="col-md-6 mb-3 row">
                                <label class="custom_label col-md-6">লাইফ সাপোর্ট : </label>
                                <span class="custom_text col-md-6">
                                    {{ $trip->life_support_type == 'basic' ? 'বেসিক লাইফ সাপোর্ট' : 'এডভান্স লাইফ সাপোর্ট' }}</span>
                            </div>
                        @endif

                        @if (!empty($trip->patient_type))
                            <div class="col-md-6 mb-3 row">
                                <label class="custom_label col-md-6">রোগীর ধরন: </label>
                                <span class="custom_text col-md-6"> {{ $trip->patient_type }}</span>
                            </div>
                        @endif



                        @if (!empty($trip->product_description))
                            <div class="col-md-6 mb-3 row">
                                <label class="custom_label col-md-6">পণ্যের বিবরণ : </label>
                                <span class="custom_text col-md-6"> {{ $trip->product_description }}</span>

                            </div>
                        @endif
                        @if (!empty($bid->customerMobile->mobile))
                            <div class="col-md-6 mb-3 row">
                                <label class="custom_label col-md-6">কাস্টমারের মোবাইল নম্বর : </label>
                                <span class="custom_text col-md-6"> {{ $bid->customerMobile->mobile }}</span>
                            </div>
                        @endif

                        @if ($trip->product_tags)
                            <div class="col-md-12 row mb-3">
                                <label class="custom_label col-md-3">পণ্যের ধরণ: </label>
                                <span class="custom_text col-md-9">
                                    @foreach (explode(',', $trip->product_tags) as $tag)
                                        <span class="badge badge-info mr-2 mb-2">{{ $tag }}</span>
                                    @endforeach
                                </span>
                            </div>
                        @endif

                        @if (!empty($bid))
                            <div class="col-md-12 mb-3 mt-3">
                                <h3 class=" text-primary">বিডিং তথ্য</h3>

                                <div class="row">
                                    <div class="col-md-6 row mb-3">
                                        <label class="custom_label col-md-6">বিডিং ডেট: </label>
                                        <span class="custom_text col-md-6">
                                            {{ date('d-M-y h:i A', strtotime($bid->created_at)) }}</span>
                                    </div>

                                    <div class="col-md-6 row mb-3">
                                        <label class="custom_label col-md-6">বিডিং আমউন্ট: </label>
                                        <span class="custom_text col-md-6"> {{ $bid->bid_amount }}</span>
                                    </div>


                                </div>

                            </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>




    </div>
@endsection

@push('custom-style')
    <style>
        .custom_label {
            font-weight: 700;
            font-size: 1.5em;
            color: #828282;
        }

        .custom_text {
            font-weight: 500;
            font-size: 1.4em;
            color: #222222;
        }
    </style>
@endpush
