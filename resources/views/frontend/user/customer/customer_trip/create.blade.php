@extends('frontend.layout.customer')
@section('customer-breadcumb', $vehicle . ' ভাড়া নিতে ফরম পুরন করুন')
@section('customer-content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-12 ">
                <form action="{{ route('user.trip-info.create-step-two.post') }}" method="POST">
                    @csrf

                    <input type="hidden" name="vehicle_id" value="{{ $vehicle_id }}">
                    <div class="card">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">

                                        <label>যাত্রা শুরুর স্থান লিখুন<span class=" text-danger">*</span></label>

                                        <select name="start_location" class="form-control form-select select2">
                                            <option value="">নির্বাচন করুন </option>
                                            @foreach ($upazilas as $upazila)
                                                <option value="{{ $upazila->bn_name }}"
                                                    {{ old('start_location') == $upazila->bn_name ? 'selected' : '' }}>
                                                    {{ $upazila->bn_name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>গন্তব্য স্থান লিখুন<span class=" text-danger">*</span></label>
                                        <select name="end_location" class="form-control form-select select2">
                                            <option value="">নির্বাচন করুন </option>
                                            @foreach ($upazilas as $upazila)
                                                <option value="{{ $upazila->bn_name }}"
                                                    {{ old('end_location') == $upazila->bn_name ? 'selected' : '' }}>
                                                    {{ $upazila->bn_name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>



                                @if ($vehicle_id != 7)
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>যাত্রার তারিখ নির্ধারণ করুন <span class=" text-danger">*</span></label>
                                            <input type="date" class="form-control" name="starting_date"
                                                autocomplete="off" value="{{ old('starting_date') }}"  min="{{ date('y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>যাত্রার সময় নির্ধারণ করুন <span class=" text-danger">*</span></label>
                                            <input type="time" class="form-control" name="starting_time"
                                                autocomplete="off" value="{{ old('starting_time') }}">
                                        </div>
                                    </div>
                                @endif


                                @if ($vehicle_id == 4)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>কি ধরনের রোগী<span class=" text-danger">*</span></label>
                                            <input type="text" name="patient_type" class="form-control"
                                                value="{{ old('patient_type') }}">
                                        </div>
                                    </div>
                                @endif


                                @if ($vehicle_id != 4 && $vehicle_id != 7)
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>যাত্রী সংখ্যা<span class=" text-danger">*</span></label>
                                            <div>

                                                @foreach ($passenger_count as $passenger)
                                                    <input type="radio" class="btn-check " name="passenger_count"
                                                        id="passenger-{{ $passenger->id }}" autocomplete="off"
                                                        value="{{ $passenger->number }}"
                                                        {{ old('passenger_count') == $passenger->number ? 'checked' : '' }}>
                                                    <label class="btn btn-outline-primary mr-2"
                                                        for="passenger-{{ $passenger->id }}">{{ $passenger->number }}</label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif



                                @if ($vehicle_id != 7)
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>ট্রিপের ধরন<span class=" text-danger">*</span></label>
                                            <div>


                                                <input type="radio" class="btn-check " name="trip_type" id="trip-single"
                                                    value="single"
                                                    @if (old('trip_type')) {{ old('trip_type') == 'single' ? 'checked' : '' }}
                                                     @else checked @endif>
                                                <label class="btn btn-outline-primary mr-2" for="trip-single">সিংগেল
                                                    ট্রিপ</label>

                                                <input type="radio" class="btn-check " name="trip_type" id="trip-up-down"
                                                    autocomplete="off" value="up-down"
                                                    @if (old('trip_type')) {{ old('trip_type') == 'up-down' ? 'checked' : '' }} @endif>
                                                <label class="btn btn-outline-primary mr-2" for="trip-up-down">আপডাউন
                                                    ট্রিপ</label>

                                                @if ($vehicle_id != 6 && $vehicle_id != 8 && $vehicle_id != 9)
                                                    <input type="radio" class="btn-check "autocomplete="off"
                                                        name="ac_type" id="trip-ac" value="ac">
                                                    <label class="btn btn-outline-primary mr-2" for="trip-ac">এসি</label>

                                                    <input type="radio" class="btn-check " name="ac_type"
                                                        id="trip-none-ac" autocomplete="off" value="none-ac"
                                                        @if (old('ac_type')) {{ old('ac_type') == 'none-ac' ? 'checked' : '' }}@else checked @endif>
                                                    <label class="btn btn-outline-primary mr-2" for="trip-none-ac">নন
                                                        এসি</label>
                                                @endif

                                                @if ($vehicle_id == 4)
                                                    <input type="radio" class="btn-check " name="life_support_type"
                                                        id="life-support-basic" value="basic" {{-- @if (old('life_support_type')) {{ old('life_support_type') == 'ac' ? 'checked' : '' }}
                                                        @else checked @endif --}}>
                                                    <label class="btn btn-outline-primary mr-2"
                                                        for="life-support-basic">বেসিক লাইফ সাপোর্ট</label>

                                                    <input type="radio" class="btn-check " name="life_support_type"
                                                        id="life-support-advance" autocomplete="off" value="advance">
                                                    <label class="btn btn-outline-primary mr-2"
                                                        for="life-support-advance">এডভান্স লাইফ সাপোর্ট</label>
                                                @endif


                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-md-6">


                                        <div class="form-group">
                                            <label>কত সময়ের জন্য ভাড়া নিতে চান</label>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <select name="duration_month" class="form-control form-select">
                                                        <option value="">কত মাস </option>
                                                        <option value="1"
                                                            {{ old('duration_month') == 1 ? 'selected' : '' }}>১ মাস
                                                        </option>
                                                        <option value="2"
                                                            {{ old('duration_month') == 2 ? 'selected' : '' }}>২ মাস
                                                        </option>
                                                        <option value="3"
                                                            {{ old('duration_month') == 3 ? 'selected' : '' }}>৩ মাস
                                                        </option>
                                                        <option value="4"
                                                            {{ old('duration_month') == 4 ? 'selected' : '' }}>৪ মাস
                                                        </option>
                                                        <option value="5"
                                                            {{ old('duration_month') == 5 ? 'selected' : '' }}>৫ মাস
                                                        </option>
                                                        <option value="6"
                                                            {{ old('duration_month') == 6 ? 'selected' : '' }}>৬ মাস
                                                        </option>
                                                        <option value="7"
                                                            {{ old('duration_month') == 7 ? 'selected' : '' }}>৭ মাস
                                                        </option>
                                                        <option value="8"
                                                            {{ old('duration_month') == 8 ? 'selected' : '' }}>৮ মাস
                                                        </option>
                                                        <option value="9"
                                                            {{ old('duration_month') == 9 ? 'selected' : '' }}>৯ মাস
                                                        </option>
                                                        <option value="10"
                                                            {{ old('duration_month') == 10 ? 'selected' : '' }}>১০ মাস
                                                        </option>
                                                        <option value="11"
                                                            {{ old('duration_month') == 11 ? 'selected' : '' }}>১১ মাস
                                                        </option>
                                                        <option value="12"
                                                            {{ old('duration_month') == 12 ? 'selected' : '' }}>১২ মাস
                                                        </option>

                                                    </select>
                                                </div>

                                                <div class="col-md-4">
                                                    <select name="duration_day" class="form-control form-select">
                                                        <option value="">কত দিন </option>
                                                        <option value="1"
                                                            {{ old('duration_day') == 1 ? 'selected' : '' }}>
                                                            ১ দিন</option>
                                                        <option value="2"
                                                            {{ old('duration_day') == 2 ? 'selected' : '' }}>
                                                            ২ দিন</option>
                                                        <option value="3"
                                                            {{ old('duration_day') == 3 ? 'selected' : '' }}>
                                                            ৩ দিন</option>
                                                        <option value="4"
                                                            {{ old('duration_day') == 4 ? 'selected' : '' }}>
                                                            ৪ দিন</option>
                                                        <option value="5"
                                                            {{ old('duration_day') == 5 ? 'selected' : '' }}>৫ দিন</option>
                                                        <option value="6"
                                                            {{ old('duration_day') == 6 ? 'selected' : '' }}>৬ দিন</option>
                                                        <option value="7"
                                                            {{ old('duration_day') == 7 ? 'selected' : '' }}>৭ দিন</option>
                                                        <option value="8"
                                                            {{ old('duration_day') == 8 ? 'selected' : '' }}>৮ দিন</option>
                                                        <option value="9"
                                                            {{ old('duration_day') == 9 ? 'selected' : '' }}>৯ দিন</option>
                                                        <option value="10"
                                                            {{ old('duration_day') == 10 ? 'selected' : '' }}>১০ দিন
                                                        </option>
                                                        <option value="11"
                                                            {{ old('duration_day') == 11 ? 'selected' : '' }}>১১ দিন
                                                        </option>
                                                        <option value="12"
                                                            {{ old('duration_day') == 12 ? 'selected' : '' }}>১২ দিন
                                                        </option>
                                                        <option value="13"
                                                            {{ old('duration_day') == 13 ? 'selected' : '' }}>১৩ দিন
                                                        </option>
                                                        <option value="14"
                                                            {{ old('duration_day') == 14 ? 'selected' : '' }}>১৪ দিন
                                                        </option>
                                                        <option value="15"
                                                            {{ old('duration_day') == 15 ? 'selected' : '' }}>১৫ দিন
                                                        </option>
                                                        <option value="16"
                                                            {{ old('duration_day') == 16 ? 'selected' : '' }}>১৬ দিন
                                                        </option>
                                                        <option value="17"
                                                            {{ old('duration_day') == 17 ? 'selected' : '' }}>১৭ দিন
                                                        </option>
                                                        <option value="18"
                                                            {{ old('duration_day') == 18 ? 'selected' : '' }}>১৮ দিন
                                                        </option>
                                                        <option value="19"
                                                            {{ old('duration_day') == 19 ? 'selected' : '' }}>১৯ দিন
                                                        </option>
                                                        <option value="20"
                                                            {{ old('duration_day') == 20 ? 'selected' : '' }}>২০ দিন
                                                        </option>
                                                        <option value="21"
                                                            {{ old('duration_day') == 21 ? 'selected' : '' }}>২১ দিন
                                                        </option>
                                                        <option value="22"
                                                            {{ old('duration_day') == 22 ? 'selected' : '' }}>২২ দিন
                                                        </option>
                                                        <option value="23"
                                                            {{ old('duration_day') == 23 ? 'selected' : '' }}>২৩ দিন
                                                        </option>
                                                        <option value="24"
                                                            {{ old('duration_day') == 24 ? 'selected' : '' }}>২৪ দিন
                                                        </option>
                                                        <option value="25"
                                                            {{ old('duration_day') == 25 ? 'selected' : '' }}>২৫ দিন
                                                        </option>
                                                        <option value="26"
                                                            {{ old('duration_day') == 26 ? 'selected' : '' }}>২৬ দিন
                                                        </option>
                                                        <option value="27"
                                                            {{ old('duration_day') == 29 ? 'selected' : '' }}>২৭ দিন
                                                        </option>
                                                        <option value="28"
                                                            {{ old('duration_day') == 28 ? 'selected' : '' }}>২৮ দিন
                                                        </option>
                                                        <option value="29"
                                                            {{ old('duration_day') == 29 ? 'selected' : '' }}>২৯ দিন
                                                        </option>


                                                    </select>
                                                </div>

                                                <div class="col-md-4">
                                                    <select name="duration_hour" class="form-control form-select">
                                                        <option value="">কত ঘন্টা </option>
                                                        <option value="1"
                                                            {{ old('duration_hour') == 1 ? 'selected' : '' }}>১ ঘন্টা
                                                        </option>
                                                        <option value="2"
                                                            {{ old('duration_hour') == 2 ? 'selected' : '' }}>২ ঘন্টা
                                                        </option>
                                                        <option value="3"
                                                            {{ old('duration_hour') == 3 ? 'selected' : '' }}>৩ ঘন্টা
                                                        </option>
                                                        <option value="4"
                                                            {{ old('duration_hour') == 4 ? 'selected' : '' }}>৪ ঘন্টা
                                                        </option>
                                                        <option value="5"
                                                            {{ old('duration_hour') == 5 ? 'selected' : '' }}>৫ ঘন্টা
                                                        </option>
                                                        <option value="6"
                                                            {{ old('duration_hour') == 6 ? 'selected' : '' }}>৬ ঘন্টা
                                                        </option>
                                                        <option value="7"
                                                            {{ old('duration_hour') == 7 ? 'selected' : '' }}>৭ ঘন্টা
                                                        </option>
                                                        <option value="8"
                                                            {{ old('duration_hour') == 8 ? 'selected' : '' }}>৮ ঘন্টা
                                                        </option>
                                                        <option value="9"
                                                            {{ old('duration_hour') == 9 ? 'selected' : '' }}>৯ ঘন্টা
                                                        </option>
                                                        <option value="10"
                                                            {{ old('duration_hour') == 10 ? 'selected' : '' }}>১০ ঘন্টা
                                                        </option>
                                                        <option value="11"
                                                            {{ old('duration_hour') == 11 ? 'selected' : '' }}>১১ ঘন্টা
                                                        </option>
                                                        <option value="12"
                                                            {{ old('duration_hour') == 12 ? 'selected' : '' }}>১২ ঘন্টা
                                                        </option>
                                                        <option value="13"
                                                            {{ old('duration_hour') == 13 ? 'selected' : '' }}>১৩ ঘন্টা
                                                        </option>
                                                        <option value="14"
                                                            {{ old('duration_hour') == 14 ? 'selected' : '' }}>১৪ ঘন্টা
                                                        </option>
                                                        <option value="15"
                                                            {{ old('duration_hour') == 15 ? 'selected' : '' }}>১৫ ঘন্টা
                                                        </option>
                                                        <option value="16"
                                                            {{ old('duration_hour') == 16 ? 'selected' : '' }}>১৬ ঘন্টা
                                                        </option>
                                                        <option value="17"
                                                            {{ old('duration_hour') == 17 ? 'selected' : '' }}>১৭ ঘন্টা
                                                        </option>
                                                        <option value="18"
                                                            {{ old('duration_hour') == 18 ? 'selected' : '' }}>১৮ ঘন্টা
                                                        </option>
                                                        <option value="19"
                                                            {{ old('duration_hour') == 19 ? 'selected' : '' }}>১৯ ঘন্টা
                                                        </option>
                                                        <option value="20"
                                                            {{ old('duration_hour') == 20 ? 'selected' : '' }}>২০ ঘন্টা
                                                        </option>
                                                        <option value="21"
                                                            {{ old('duration_hour') == 21 ? 'selected' : '' }}>২১ ঘন্টা
                                                        </option>
                                                        <option value="22"
                                                            {{ old('duration_hour') == 22 ? 'selected' : '' }}>২২ ঘন্টা
                                                        </option>
                                                        <option value="23"
                                                            {{ old('duration_hour') == 23 ? 'selected' : '' }}>২৩ ঘন্টা
                                                        </option>
                                                        <option value="24"
                                                            {{ old('duration_hour') == 24 ? 'selected' : '' }}>২৪ ঘন্টা
                                                        </option>

                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endif


                                @if ($vehicle_id == 7)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>যাত্রার তারিখ নির্ধারণ করুন <span class=" text-danger">*</span></label>
                                            <input type="date" class="form-control" name="starting_date"
                                                autocomplete="off" value="{{ old('starting_date') }}"  min="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>যাত্রার সময় নির্ধারণ করুন <span class=" text-danger">*</span></label>
                                            <input type="time" class="form-control" name="starting_time"
                                                autocomplete="off" value="{{ old('starting_time') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>ভাড়ার বিবরন<span class=" text-danger">*</span></label>
                                            <textarea name="rent_description" rows="4" cols="50" class="form-control"
                                                value="{{ old('rent_description') }}"></textarea>
                                        </div>
                                    </div>
                                @endif

                            </div>


                            <div class="row mt-5">
                                <div class="col-12 d-flex justify-content-end">
                                    @auth
                                        <button type="submit" class="btn btn-primary ">পরবর্তী ধাপ</button>
                                    @else
                                        <a href="#" type="button" data-toggle="modal" data-target="#loginModal"
                                            class="btn btn-primary ">পরবর্তী ধাপ</a>
                                    @endauth
                                </div>
                            </div>



                        </div>
                    </div>

                </form>

            </div>

        </div>
    </div>

@endsection


@push('custom-css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@endpush

@push('script')
    <script>
        function showCard(cardNumber) {
            // Hide all cards
            var cards = document.querySelectorAll('.card');
            cards.forEach(function(card) {
                card.style.display = 'none';
            });

            // Show the selected card
            var selectedCard = document.getElementById('card' + cardNumber);
            if (selectedCard) {
                selectedCard.style.display = 'block';
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            if ($('#notLoggedIn').length) {
                $('#loginModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $('#loginModal').modal('show');
            }
        });
    </script>
@endpush
