@extends('frontend.layout.master')
@section('breadcrumb')
    <section class="section">

        <div class="section-header d-flex justify-content-between">

            <h1 class=" w-100 text-center">ট্রিপ নিশ্চিত করুন</h1>
            </h1>
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
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3 row">
                            <label class="custom_label col-md-6">গাড়ির ধরন: </label>
                            <span class="custom_text col-md-6">{{ $trip->vehicle->name }}</span>
                        </div>

                        <div class="col-md-4 mb-3 row">
                            @if ($trip->vehicle_id == 1)
                                <label class="custom_label col-md-6">লোড লোকেশন : </label>
                            @else
                                <label class="custom_label col-md-6">যাত্রা শুরুর স্থান: </label>
                            @endif
                            <span class="custom_text col-md-6">{{ $trip->start_location }}</span>

                        </div>

                        <div class="col-md-4 mb-3 row">

                            @if ($trip->vehicle_id == 1)
                                <label class="custom_label col-md-6">আনলোড লোকেশন : </label>
                            @else
                                <label class="custom_label col-md-6">গন্তব্যস্থান: </label>
                            @endif
                            <span class="custom_text col-md-6">{{ $trip->end_location }}</span>

                        </div>

                        @if (!empty($trip->passenger_count))
                            <div class="col-md-4 mb-3 row">
                                <label class="custom_label col-md-6">পণ্যের বিবরণ : </label>
                                <span class="custom_text col-md-6"> {{ $trip->passenger_count }}</span>
                            </div>
                        @endif

                        {{-- @if (!empty($trip->receiver_mobile))
                            <div class="col-md-4 mb-3 row">
                                <label class="custom_label col-md-6">পণ্য গ্রহনকারীর মোবাইল নাম্বার : </label>
                                <span class="custom_text col-md-6"> {{ $trip->receiver_mobile }}</span>
                            </div>
                        @endif --}}

                        @if (!empty($trip->truck_type))
                            <div class="col-md-4 mb-3 row">
                                <label class="custom_label col-md-6">ট্রাকের ধরন : </label>
                                <span class="custom_text col-md-6"> {{ $trip->truck->name }}</span>
                            </div>
                        @endif

                        @if (!empty($trip->ton))
                            <div class="col-md-4 mb-3 row">
                                <label class="custom_label col-md-6"> কত টন : </label>
                                <span class="custom_text col-md-6"> {{ $trip->ton }}</span>
                            </div>
                        @endif

                        @if (!empty($trip->feet))
                            <div class="col-md-4 mb-3 row">
                                <label class="custom_label col-md-6"> কত ফিট : </label>
                                <span class="custom_text col-md-6"> {{ $trip->feet }}</span>
                            </div>
                        @endif

                        @if (!empty($trip->second_load_location))
                            <div class="col-md-4 mb-3 row">
                                <label class="custom_label col-md-6"> দ্বিতীয় লোড লোকেশন : </label>
                                <span class="custom_text col-md-6"> {{ $trip->second_load_location }}</span>
                            </div>
                        @endif

                        @if (!empty($trip->second_unload_location))
                            <div class="col-md-4 mb-3 row">
                                <label class="custom_label col-md-6"> দ্বিতীয় আনলোড লোকেশন : </label>
                                <span class="custom_text col-md-6"> {{ $trip->second_unload_location }}</span>
                            </div>
                        @endif

                        @if (!empty($trip->second_provider_mobile))
                            <div class="col-md-4 mb-3 row">
                                <label class="custom_label col-md-6"> দ্বিতীয় পণ্য প্রদানকারীর মোবাইল নম্বর : </label>
                                <span class="custom_text col-md-6"> {{ $trip->second_provider_mobile }}</span>
                            </div>
                        @endif

                        @if (!empty($trip->second_receiver_mobile))
                            <div class="col-md-4 mb-3 row">
                                <label class="custom_label col-md-6"> দ্বিতীয় পণ্য গ্রহণকারীর মোবাইল নম্বর : </label>
                                <span class="custom_text col-md-6"> {{ $trip->second_receiver_mobile }}</span>
                            </div>
                        @endif


                        @if (!empty($trip->third_load_location))
                            <div class="col-md-4 mb-3 row">
                                <label class="custom_label col-md-6"> তৃতীয় লোড লোকেশন : </label>
                                <span class="custom_text col-md-6"> {{ $trip->third_load_location }}</span>
                            </div>
                        @endif

                        @if (!empty($trip->third_unload_location))
                            <div class="col-md-4 mb-3 row">
                                <label class="custom_label col-md-6"> তৃতীয় আনলোড লোকেশন : </label>
                                <span class="custom_text col-md-6"> {{ $trip->third_unload_location }}</span>
                            </div>
                        @endif

                        @if (!empty($trip->third_provider_mobile))
                            <div class="col-md-4 mb-3 row">
                                <label class="custom_label col-md-6"> তৃতীয় পণ্য প্রদানকারীর মোবাইল নম্বর : </label>
                                <span class="custom_text col-md-6"> {{ $trip->third_provider_mobile }}</span>
                            </div>
                        @endif

                        @if (!empty($trip->third_receiver_mobile))
                            <div class="col-md-4 mb-3 row">
                                <label class="custom_label col-md-6"> তৃতীয় পণ্য গ্রহণকারীর মোবাইল নম্বর: </label>
                                <span class="custom_text col-md-6"> {{ $trip->third_receiver_mobile }}</span>
                            </div>
                        @endif

                        @if (!empty($trip->trip_type))
                            <div class="col-md-4 mb-3 row">

                                <label class="custom_label col-md-6">ট্রিপের বিবরণ : </label>
                                <span class="custom_text col-md-6">
                                    {{ $trip->trip_type == 'single' ? 'সিঙ্গেল ট্রিপ' : 'আপ-ডাউন ট্রিপ' }}</span>
                            </div>
                        @endif

                        @if (!empty($trip->ac_type))
                            <div class="col-md-4 mb-3 row">
                                <label class="custom_label col-md-6">এসি বিবরণ : </label>
                                <span class="custom_text col-md-6">
                                    {{ $trip->ac_type == 'ac' ? 'এসি সহ' : 'এসি ছাড়া' }}</span>
                            </div>
                        @endif

                        @if (!empty($trip->duration_month) || !empty($trip->duration_day) || !empty($trip->duration_hour))
                            <div class="col-md-4 mb-3 row">

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
                            <div class="col-md-4 mb-3 row">
                                <label class="custom_label col-md-6">ট্রিপের বিবরণ : </label>
                                <span class="custom_text col-md-6"> {{ $trip->rent_description }} মাস</span>
                            </div>
                        @endif

                        @if (!empty($trip->life_support_type))
                            <div class="col-md-4 mb-3 row">
                                <label class="custom_label col-md-6">লাইফ সাপোর্ট : </label>
                                <span class="custom_text col-md-6">
                                    {{ $trip->life_support_type == 'basic' ? 'বেসিক লাইফ সাপোর্ট' : 'এডভান্স লাইফ সাপোর্ট' }}</span>
                            </div>
                        @endif

                        @if (!empty($trip->patient_type))
                            <div class="col-md-4 mb-3 row">
                                <label class="custom_label col-md-6">রোগীর ধরন: </label>
                                <span class="custom_text col-md-6"> {{ $trip->patient_type }}</span>
                            </div>
                        @endif

                        @if (!empty($trip->product_description))
                            <div class="col-md-12 mb-3b row">
                                <label class="custom_label col-md-6">পণ্যের বিবরণ : </label>
                                <span class="custom_text col-md-6"> {{ $trip->product_description }}</span>
                            </div>
                        @endif

                        @if ($trip->product_tags)
                            <div class="col-md-4 mb-3b row">
                                <label class="custom_label col-md-6">পণ্যের ধরণ: </label>
                                <span class="custom_text col-md-6">
                                    @foreach (explode(',', $trip->product_tags) as $tag)
                                        <span class="badge badge-info mr-2 mb-2">{{ $tag }}</span>
                                    @endforeach
                                </span>
                            </div>
                        @endif

                        @if (!empty($trip->starting_date))
                            <div class="col-md-8 mb-3 row">
                                @if ($trip->vehicle_id == 1)
                                    <label class="custom_label col-md-3">লোডের তারিখ : </label>
                                @else
                                    <label class="custom_label col-md-3">যাত্রা শুরুর তারিখ : </label>
                                @endif
                                <span class="custom_text col-md-6">
                                    {{ date('d-M-y', strtotime($trip->starting_date)) }}</span>
                            </div>
                        @endif

                        @if (!empty($trip->starting_time))
                            <div class="col-md-8 mb-3 row">
                                @if ($trip->vehicle_id == 1)
                                    <label class="custom_label col-md-3">লোডের সময়: </label>
                                @else
                                    <label class="custom_label col-md-3">যাত্রা শুরুর সময় : </label>
                                @endif
                                <span class="custom_text col-md-6">
                                    {{ date('h:i A', strtotime($trip->starting_time)) }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('user.trip.provider.bidding', $trip->id) }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h4 class=" mb-3">আপনি কি ট্রিপটি অন্য কাউকে দিতে চান ?</h4>
                                    <input type="radio" class="btn-check " checked value="1" name="confirm_bid"
                                        id="bid-no" autocomplete="off">
                                    <label class="btn btn-outline-primary " for="bid-no">না</label>

                                    <input type="radio" class="btn-check " value="2" name="confirm_bid"
                                        id="bid-yes" autocomplete="off">
                                    <label class="btn btn-outline-primary mr-2" for="bid-yes">হ্যা</label>
                                </div>
                            </div>

                            <div class="col-12 row d-none" id="driver_info">
                                <div class="form-group col-md-6 col-12">
                                    <h6>ড্রাইভারের পূর্ণ নাম লিখুন<span class="text-danger">*</span> </h6>
                                    <input type="text" class="form-control" name="driver_name">
                                </div>

                                <div class="form-group col-md-6 col-12">
                                    <h6>ড্রাইভারের মোবাইল নম্বর লিখুন<span class="text-danger">*</span> </h6>
                                    <input type="number" class="form-control" name="driver_mobile">
                                </div>

                                <div class="form-group col-md-6 col-12">

                                    <h6>ট্রাক নম্বর লিখুন<span class="text-danger">*</span> </h6>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">মেট্রো </span>
                                        </div>
                                        <select name="serial_prefix" class="custom-select" id="inputGroupSelect05">
                                            <option selected="" disabled>সিরিয়াল </option>

                                            <option value="অ">অ</option>
                                            <option value="আ">আ</option>
                                            <option value="ই">ই</option>
                                            <option value="ঈ">ঈ</option>
                                            <option value="উ">উ</option>
                                            <option value="ঊ">ঊ</option>
                                            <option value="ঋ">ঋ</option>
                                            <option value="এ">এ</option>
                                            <option value="ঐ">ঐ</option>
                                            <option value="ও">ও</option>
                                            <option value="ঔ">ঔ</option>

                                            <option value="ক">ক</option>
                                            <option value="খ">খ</option>
                                            <option value="গ">গ</option>
                                            <option value="ঘ">ঘ</option>
                                            <option value="ঙ">ঙ</option>
                                            <option value="চ">চ</option>
                                            <option value="ছ">ছ</option>
                                            <option value="জ">জ</option>
                                            <option value="ঝ">ঝ</option>
                                            <option value="ঞ">ঞ</option>
                                            <option value="ট">ট</option>
                                            <option value="ঠ">ঠ</option>
                                            <option value="ড">ড</option>
                                            <option value="ঢ">ঢ</option>
                                            <option value="ণ">ণ</option>
                                            <option value="ত">ত</option>
                                            <option value="থ">থ</option>
                                            <option value="দ">দ</option>
                                            <option value="ধ">ধ</option>
                                            <option value="ন">ন</option>
                                            <option value="প">প</option>
                                            <option value="ফ">ফ</option>
                                            <option value="ব">ব</option>
                                            <option value="ভ">ভ</option>
                                            <option value="ম">ম</option>
                                            <option value="য">য</option>
                                            <option value="র">র</option>
                                            <option value="ল">ল</option>
                                            <option value="শ">শ</option>
                                            <option value="ষ">ষ</option>
                                            <option value="স">স</option>
                                            <option value="হ">হ</option>
                                            <option value="ড়">ড়</option>
                                            <option value="ঢ়">ঢ়</option>
                                            <option value="য়">য়</option>
                                            <option value="ক্ষ">ক্ষ</option>
                                        </select>
                                        <input name="serial_number" type="number" class="form-control form_control"
                                            placeholder="সংখ্যা ">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group row mt-5">
                                    <h4>ট্রিপটি ভাড়া নিতে টাকার পরিমাণ লিখুন <span class="text-danger">*</span></h4>
                                    <div class="input-group mb-3 col-md-6 mt-3">
                                        <input name="bid_amount" type="number" id="bid-amount" class="form-control" placeholder=""
                                            aria-label="" required>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">বিডিং করুন</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <h5><span class="text-danger" id="umamarket-percent">উমামার্কেট কমিশন: {{ $generalSetting->commission }}%
                                        </span></h5>
                                    <h5><span class="text-danger" id="umamarket-amount">কমিশন পরিমান:</span></h5>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const bidAmountInput = document.getElementById('bid-amount');
        const umamarketAmountDisplay = document.getElementById('umamarket-amount');

        // Function to calculate Umamarket Amount and update the display
        function calculateUmamarketAmount() {
            const bidAmount = parseFloat(bidAmountInput.value);
            if (!isNaN(bidAmount)) {
                // You should replace this with the actual commission value
                const commission = {{ $generalSetting->commission }}; // Example commission value (replace with your actual value)
                const umamarketAmount = (bidAmount * commission) / 100;
                umamarketAmountDisplay.textContent = 'কমিশন পরিমান: ' + umamarketAmount.toFixed(2) + ' টাকা' ;
            } else {
                umamarketAmountDisplay.textContent = 'কমিশন পরিমান: 0  টাকা';
            }
        }

        // Attach an input event listener to the bid amount input field
        bidAmountInput.addEventListener('input', calculateUmamarketAmount);

        // Trigger initial calculation when the page loads
        calculateUmamarketAmount();
    });
</script>
@push('custom-script')
    <script>
        $('input[name=confirm_bid]').on('change', function() {

            if ($(this).val() == 2) {
                $('#driver_info').removeClass('d-none');
            } else {
                $('#driver_info').addClass('d-none');
            }
        });
    </script>
@endpush


@push('custom-style')
    <style>
        .custom_label {
            font-weight: 700;
            font-size: 1.1em;
            color: #828282;
        }

        .custom_text {
            font-weight: 500;
            font-size: 1em;
            color: #222222;
        }
    </style>
@endpush
