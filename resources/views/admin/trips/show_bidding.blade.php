@extends('admin.layout.master')
@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            <h1>ট্রিপের তথ্য
            </h1>
        </div>
    </section>
    <style>
        .bidder_image {
            width: 200px;
            /* Adjust as needed */
            height: 250px;
            /* Adjust as needed */
            object-fit: cover;
            /* This ensures the image fills the designated space */
        }
    </style>
@endsection

@section('content')
    <div class="team-page pt_30 pb_60 position-relative">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="bg-primary text-center pt-2">
                            <h2 class="text-light">ট্রিপের তথ্য </h2>
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

                                @if (!empty($trip->starting_date))
                                    <div class="col-md-6 mb-3 row">
                                        <label class="custom_label col-md-6">লোডের তারিখ : </label>
                                        <span class="custom_text col-md-6">
                                            {{ date('d-M-y', strtotime($trip->starting_date)) }}</span>
                                    </div>
                                @endif

                                @if (!empty($trip->starting_time))
                                    <div class="col-md-6 mb-3 row">
                                        <label class="custom_label col-md-6">লোডের সময় : </label>
                                        <span class="custom_text col-md-6">
                                            {{ $trip->starting_time }}</span>
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
                                        <label class="custom_label col-md-6"> দ্বিতীয় পণ্য প্রদানকারীর মোবাইল নম্বর :
                                        </label>
                                        <span class="custom_text col-md-6"> {{ $trip->second_provider_mobile }}</span>
                                    </div>
                                @endif

                                @if (!empty($trip->second_receiver_mobile))
                                    <div class="col-md-6 mb-3 row">
                                        <label class="custom_label col-md-6"> দ্বিতীয় পণ্য গ্রহণকারীর মোবাইল নম্বর :
                                        </label>
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
                                        <span class="custom_text col-md-6"> {{ $trip->rent_description }} মাস</span>
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
                                    <div class="col-md-12 mb-3 row">

                                        <label class="custom_label col-md-3">পণ্যের বিবরণ : </label>
                                        <span class="custom_text col-md-3"> {{ $trip->product_description }}</span>


                                    </div>
                                @endif

                                @if ($trip->product_tags)
                                    <div class="col-md-12 mb-3 row">

                                        <label class="custom_label col-md-6">পণ্যের ধরণ: </label>
                                        <span class="custom_text col-md-6">
                                            @foreach (explode(',', $trip->product_tags) as $tag)
                                                <span class="badge badge-info mr-2 mb-2">{{ $tag }}</span>
                                            @endforeach
                                        </span>



                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>

                @if ($accepted_bid)
                    <div class="col-md-12">
                        <div class="card">

                            <div class="bg-primary text-center pt-2">
                                <h2 class="text-light"> নির্বাচিত প্রোভাইডার </h2>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        {{-- @php
                                        dd($accepted_bid);
                                    @endphp --}}
                                        @if (!$accepted_bid->reffered_service_provider)
                                            <img src="{{ $accepted_bid->provider->image != null ? getFile('user', $accepted_bid->provider->image) : asset('backend/images/default-user.png') }}"
                                                alt="" class="bidder_image">
                                        @endif
                                    </div>

                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-8">
                                                @if ($accepted_bid->reffered_service_provider)
                                                    @php
                                                        $decodedData = json_decode($accepted_bid->reffered_service_provider, true);
                                                        // dd($decodedData);
                                                    @endphp

                                                    <div>
                                                        <h3>{{ $decodedData['driver_name'] }} </h3>

                                                        <div class="bidder_text">
                                                            <label class="custom_label">চালকের মোবাইল নং : </label>
                                                            {{ $decodedData['driver_mobile'] }}
                                                        </div>

                                                        <div class="bidder_text">
                                                            <label class="custom_label">গাড়ির সিরিয়াল নাম্বার : </label>
                                                            {{ $decodedData['serial_prefix'] }} -
                                                            {{ $decodedData['serial_number'] }}
                                                        </div>
                                                    </div>
                                                @else
                                                    <h3>{{ $accepted_bid->provider->fname }} </h3>
                                                    <div class="bidder_text">
                                                        <label class="custom_label">প্রতিষ্ঠানের ঠিকানা : </label>
                                                        {{ @$accepted_bid->provider->userDetails->company_name }}
                                                    </div>
                                                    <div class="bidder_text">
                                                        <label class="custom_label">ড্রাইভিং কাজের অভিজ্ঞতা : </label>
                                                        {{ @$accepted_bid->provider->userDetails->driving_experience }}
                                                    </div>
                                                    @if ($accepted_bid->status == 1)
                                                        <div class="bidder_text">
                                                            <label class="custom_label">চালকের মোবাইল নং : </label>
                                                            {{ @$accepted_bid->provider->mobile }}
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>

                                            <div class="col-md-4">
                                                <div class="col-md-12 d-flex align-items-center">
                                                    <div class="w-100">
                                                        <h3 class=" text-center">ভাড়া </h3>
                                                        <h4 class=" text-center"> {{ $accepted_bid->bid_amount }} </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($all_bids->isEmpty())
                @else
                    <div class="col-md-12">
                        <div class="card">
                            <div class="bg-primary text-center pt-2">
                                <h2 class="text-light"> অনির্বাচিত প্রোভাইডার </h2>
                            </div>
                            <div class="card-body">
                                @foreach ($all_bids as $bid)
                                    <div class="row my-3">
                                        <div class="col-md-3">
                                            @if (!$bid->reffered_service_provider)
                                                <img src="{{ $bid->provider->image != null ? getFile('user', $bid->provider->image) : asset('backend/images/default-user.png') }}"
                                                    alt="" class="bidder_image">
                                            @endif
                                        </div>

                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    @if ($bid->reffered_service_provider)
                                                        @php
                                                            $decodedData = json_decode($bid->reffered_service_provider, true);
                                                            // dd($decodedData);
                                                        @endphp

                                                        <div>
                                                            <h3>{{ $decodedData['driver_name'] }} </h3>

                                                            <div class="bidder_text">
                                                                <label class="custom_label">চালকের মোবাইল নং : </label>
                                                                {{ $decodedData['driver_mobile'] }}
                                                            </div>

                                                            <div class="bidder_text">
                                                                <label class="custom_label">গাড়ির সিরিয়াল নাম্বার :
                                                                </label>
                                                                {{ $decodedData['serial_prefix'] }} -
                                                                {{ $decodedData['serial_number'] }}
                                                            </div>
                                                        </div>
                                                    @else
                                                        <h3>{{ $bid->provider->fname }} </h3>
                                                        <div class="bidder_text">
                                                            <label class="custom_label">প্রতিষ্ঠানের ঠিকানা : </label>
                                                            {{ @$bid->provider->userDetails->company_name }}
                                                        </div>
                                                        <div class="bidder_text">
                                                            <label class="custom_label">ড্রাইভিং কাজের অভিজ্ঞতা :
                                                            </label>
                                                            {{ @$bid->provider->userDetails->driving_experience }}
                                                        </div>
                                                        {{-- @if ($bid->status == 1)
                                                            <div class="bidder_text">
                                                                <label class="custom_label">চালকের মোবাইল নং : </label>
                                                                {{ @$bid->provider->mobile }}
                                                            </div>
                                                        @endif --}}
                                                    @endif
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="col-md-12 d-flex align-items-center">
                                                        <div class="w-100">
                                                            <h3 class=" text-center">ভাড়া </h3>
                                                            <h4 class=" text-center"> {{ $bid->bid_amount }} </h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if (!$loop->last)
                                        <hr>
                                    @endif
                                @endforeach
                            </div>

                        </div>
                    </div>

                @endif

                {{-- <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    @if (!$bidding->reffered_service_provider)
                                        <img src="{{ $bidding->provider->image != null ? getFile('user', $bidding->provider->image) : asset('backend/images/default-user.png') }}"
                                            alt="" class="bidder_image">
                                    @endif
                                </div>

                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-8">
                                            @if ($bidding->reffered_service_provider)
                                                @php
                                                    $decodedData = json_decode($bidding->reffered_service_provider, true);
                                                    // dd($decodedData);
                                                @endphp

                                                <div>
                                                    <h3>{{ $decodedData['driver_name'] }} </h3>

                                                    <div class="bidder_text">
                                                        <label class="custom_label">চালকের মোবাইল নং : </label>
                                                        {{ $decodedData['driver_mobile'] }}
                                                    </div>

                                                    <div class="bidder_text">
                                                        <label class="custom_label">গাড়ির সিরিয়াল নাম্বার : </label>
                                                        {{ $decodedData['serial_prefix'] }} -
                                                        {{ $decodedData['serial_number'] }}
                                                    </div>
                                                </div>
                                            @else
                                                <h3>{{ $bidding->provider->fname }} </h3>
                                                <div class="bidder_text">
                                                    <label class="custom_label">প্রতিষ্ঠানের ঠিকানা : </label>
                                                    {{ @$bidding->provider->userDetails->company_name }}
                                                </div>
                                                <div class="bidder_text">
                                                    <label class="custom_label">ড্রাইভিং কাজের অভিজ্ঞতা : </label>
                                                    {{ @$bidding->provider->userDetails->driving_experience }}
                                                </div>
                                                @if ($bidding->status == 1)
                                                    <div class="bidder_text">
                                                        <label class="custom_label">চালকের মোবাইল নং : </label>
                                                        {{ @$bidding->provider->mobile }}
                                                    </div>
                                                @endif
                                            @endif
                                        </div>

                                        <div class="col-md-4">
                                            <div class="col-md-12 d-flex align-items-center">
                                                <div class="w-100">
                                                    <h3 class=" text-center">ভাড়া </h3>
                                                    <h4 class=" text-center"> {{ $bidding->bid_amount }} </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}




            </div>
        </div>
    @endsection
