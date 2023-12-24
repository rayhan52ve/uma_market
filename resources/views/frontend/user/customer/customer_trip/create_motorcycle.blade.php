@extends('frontend.layout.customer')
@section('customer-breadcumb', 'মোটরসাইকেল ভাড়া নিতে ফরম পুরন করুন')
@section('customer-content')

    <div class="container mt-5">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Check if old('without_driver') is 0 (with-driver option) and set as checked if true -->
                            <input type="radio" class="btn-check" name="without_driver" id="with-driver" value="0"
                                autocomplete="off"
                                @if (old('without_driver')) {{ old('without_driver') == 0 ? 'checked' : '' }}
                                @else checked @endif>
                            <label class="btn btn-outline-primary btn-block" for="with-driver">চালক-সহ ভাড়া
                                নিন</label>
                        </div>

                        <div class="col-md-6">
                            <!-- Check if old('without_driver') is 1 (without-driver option) and set as checked if true -->
                            <input type="radio" class="btn-check" name="without_driver" id="without-driver" value="1"
                                autocomplete="off" {{ old('without_driver') == 1 ? 'checked' : '' }}>
                            <label class="btn btn-outline-primary btn-block" for="without-driver">চালক-ছাড়া ভাড়া
                                নিন</label>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-12 ">
                {{-- With driver section --}}
                <div class="row d-none" id="with-driver-section">
                    <form action="{{ route('user.trip-info.create-step-two.post') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="vehicle_id" value="{{ $vehicle_id }}">
                        <div class="card">

                            <div class="card-body">

                                <div class="row " id="with-driver-section">
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label>যাত্রা শুরুর স্থান লিখুন<span class=" text-danger">*</span></label>

                                            <select name="start_location" class="form-control form-select select2" required >
                                                <option value="" >নির্বাচন করুন </option>
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
                                            <select name="end_location" class="form-control form-select select2" required>
                                                <option value="">নির্বাচন করুন </option>
                                                @foreach ($upazilas as $upazila)
                                                    <option value="{{ $upazila->bn_name }}"
                                                        {{ old('end_location') == $upazila->bn_name ? 'selected' : '' }}>
                                                        {{ $upazila->bn_name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>যাত্রার তারিখ নির্ধারণ করুন <span class=" text-danger">*</span></label>
                                            <input type="date" class="form-control" name="starting_date"
                                                value="{{ old('starting_date') }}" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>যাত্রার সময় নির্ধারণ করুন <span class=" text-danger">*</span></label>
                                            <input type="time" class="form-control" name="starting_time"
                                                value="{{ old('starting_time') }}" autocomplete="off" required>
                                        </div>
                                    </div>

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
                                                    {{ old('trip_type') == 'up-down' ? 'checked' : '' }}>
                                                <label class="btn btn-outline-primary mr-2" for="trip-up-down">আপডাউন
                                                    ট্রিপ</label>
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
                                    <input type="hidden" name="without_driver" value="0">
                                </div>
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
                    </form>
                </div>


                {{-- without driver --}}
                <div class="row d-none" id="without-driver-section">
                    <form id="mainForm" action="{{ route('user.trip-info.create-step-two-bike-brand.post') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- bike brand --}}

                        <div class="modal fade" id="bikeModal" tabindex="-1" role="dialog"
                            aria-labelledby="bikeModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="bikeModalLabel">Select Bike Brand and Model</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label for="bikeBrand">Select Bike Brand</label>
                                            <select name="bike_brand_id" id="bikeBrand" class="form-control" >
                                                <!-- Populate options dynamically, you can use a loop here -->
                                                <option value="">Select Brand</option>
                                                @foreach ($bikeBrands as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="bikeModel">Select Bike Model</label>

                                            <select name="bike_model_id" id="bikeModel" class="form-control">
                                                <!-- Initially, the model select field is empty -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" id="bikeModalSubmitBtn">Select
                                            Bike</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        {{-- close modal  --}}

                        <input type="hidden" name="vehicle_id" value="{{ $vehicle_id }}">
                        <div class="card">

                            <div class="card-body">

                                <div class="row ">
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label>যাত্রা শুরুর স্থান লিখুন<span class=" text-danger">*</span></label>

                                            <select name="start_location" class="form-control form-select select2" required>
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
                                            <select name="end_location" class="form-control form-select select2"required>
                                                <option value="">নির্বাচন করুন </option>
                                                @foreach ($upazilas as $upazila)
                                                    <option value="{{ $upazila->bn_name }}"
                                                        {{ old('end_location') == $upazila->bn_name ? 'selected' : '' }}>
                                                        {{ $upazila->bn_name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>যাত্রার তারিখ নির্ধারণ করুন <span class=" text-danger">*</span></label>
                                            <input type="date" class="form-control" name="starting_date"
                                                value="{{ old('starting_date') }}" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>যাত্রার সময় নির্ধারণ করুন <span class=" text-danger">*</span></label>
                                            <input type="time" class="form-control" name="starting_time"
                                                value="{{ old('starting_time') }}" autocomplete="off" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">


                                        <div class="form-group">
                                            <label>কত সময়ের জন্য ভাড়া নিতে চান<span class="text-danger">*</span></label>

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
                                                            {{ old('duration_day') == 5 ? 'selected' : '' }}>৫ দিন
                                                        </option>
                                                        <option value="6"
                                                            {{ old('duration_day') == 6 ? 'selected' : '' }}>৬ দিন
                                                        </option>
                                                        <option value="7"
                                                            {{ old('duration_day') == 7 ? 'selected' : '' }}>৭ দিন
                                                        </option>
                                                        <option value="8"
                                                            {{ old('duration_day') == 8 ? 'selected' : '' }}>৮ দিন
                                                        </option>
                                                        <option value="9"
                                                            {{ old('duration_day') == 9 ? 'selected' : '' }}>৯ দিন
                                                        </option>
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

                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label>জাতীয় পরিচয়পত্র অনুযায়ী আপনার পূর্ণ নাম<span
                                                    class=" text-danger">*</span></label>
                                            <input type="text" name="customer_full_name" class="form-control"
                                                value="{{ old('customer_full_name') }}" required>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label>ঠিকানা<span class=" text-danger">*</span></label>
                                            <input type="text" name="customer_address" class="form-control"
                                                value="{{ old('customer_address') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label>আপনার জাতীয় পরিচয়পত্র নাম্বার <span
                                                    class=" text-danger">*</span></label>
                                            <input type="number" name="customer_nid_no" class="form-control"
                                                value="{{ old('customer_nid_no') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>আপনার জাতীয় পরিচয়পত্রের ছবি (সামনের অংশ)<span
                                                    class=" text-danger">*</span></label>
                                            <div class="custom-file">
                                                <input type="file" name="customer_nid_image_front"
                                                    class="custom-file-input" id="customer_nid_image_front"
                                                    onchange="displayFileNames()" required>
                                                <label class="custom-file-label" for="customer_nid_image_front" >Choose
                                                    file...</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>আপনার জাতীয় পরিচয়পত্রের ছবি (পিছনের অংশ)<span
                                                    class=" text-danger">*</span></label>
                                            <div class="custom-file">
                                                <input type="file" name="customer_nid_image_back"
                                                    class="custom-file-input" id="customer_nid_image_back"
                                                    onchange="displayFileNames()" required>
                                                <label class="custom-file-label" for="customer_nid_image_back">Choose
                                                    file...</label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>আপনার ড্রাইভিং লাইসেন্সের ছবি (সামনের অংশ)<span
                                                    class=" text-danger">*</span></label>
                                            <div class="custom-file">
                                                <input type="file" name="customer_driving_license_image_front"
                                                    class="custom-file-input" id="customer_driving_license_image_front"
                                                    onchange="displayFileNames()" required>
                                                <label class="custom-file-label"
                                                    for="customer_driving_license_image_front">Choose file...</label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label>আপনার ড্রাইভিং লাইসেন্সের ছবি (পিছনের অংশ)<span
                                                    class=" text-danger">*</span></label>
                                            <div class="custom-file">
                                                <input type="file" name="customer_driving_license_image_back"
                                                    class="custom-file-input" id="customer_driving_license_image_back"
                                                    onchange="displayFileNames()" required>
                                                <label class="custom-file-label"
                                                    for="customer_driving_license_image_back">Choose
                                                    file...</label>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label>পিতা/মাতার নাম<span class=" text-danger">*</span></label>
                                            <input type="text" name="parent_name" class="form-control"
                                                value="{{ old('parent_name') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label>পিতা/মাতার মোবাইল নাম্বার<span class=" text-danger">*</span></label>
                                            <input type="number" name="parent_mobile" class="form-control"
                                                value="{{ old('parent_mobile') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label>পিতা অথবা মাতার জাতীয় পরিচয়পত্র নাম্বার <span
                                                    class=" text-danger">*</span></label>
                                            <input type="number" name="parent_nid_no" class="form-control"
                                                value="{{ old('parent_nid_no') }}" required>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label>পিতা অথবা মাতার জাতীয় পরিচয়পত্রের ছবি (সামনের অংশ)<span
                                                    class=" text-danger">*</span></label>
                                            <div class="custom-file">
                                                <input type="file" name="parent_nid_image_front"
                                                    class="custom-file-input" id="parent_nid_image_front"
                                                    value="{{ old('') }}" onchange="displayFileNames()" required>
                                                <label class="custom-file-label" for="parent_nid_image_front">Choose
                                                    file...</label>

                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="without_driver" value="1">

                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label>পিতা অথবা মাতার জাতীয় পরিচয়পত্রের ছবি (পিছনের অংশ)<span
                                                    class=" text-danger">*</span></label>
                                            <div class="custom-file">
                                                <input type="file" name="parent_nid_image_back"
                                                    class="custom-file-input" id="parent_nid_image_back"
                                                    value="{{ old('') }}" onchange="displayFileNames()" required>
                                                <label class="custom-file-label" for="parent_nid_image_back">Choose
                                                    file...</label>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="authentic-info-check">
                                            <label class="form-check-label" for="authentic-info-check">
                                                আমি কোন ভুল তথ্য প্রদান করি নাই
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row mt-5">
                                <div class="col-12 d-flex justify-content-end">
                                    @auth
                                        {{-- <button type="submit" class="btn btn-primary" data-toggle="modal"
                                            data-target="#bikeModal">পরবর্তী ধাপ</button> --}}
                                        <button type="submit" class="btn btn-primary">পরবর্তী ধাপ</button>
                                    @else
                                        <a href="#" type="button" data-toggle="modal" data-target="#loginModal"
                                            class="btn btn-primary">পরবর্তী ধাপ</a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
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
        // Get references to the bike brand and model select fields
        const bikeBrandSelect = document.getElementById('bikeBrand');
        const bikeModelSelect = document.getElementById('bikeModel');
        // Define a JavaScript object containing bike models data
        const bikeModelsData = {
            @foreach ($bikeModels as $model)
                '{{ $model->brand_id }}': [
                    @foreach ($bikeModels as $modelInBrand)
                        @if ($modelInBrand->brand_id == $model->brand_id)
                            {
                                'id': '{{ $modelInBrand->id }}',
                                'name': '{{ $modelInBrand->name }}'
                            },
                        @endif
                    @endforeach
                ],
            @endforeach
        };

        // Add an event listener to the bike brand select field
        bikeBrandSelect.addEventListener('change', () => {
            const selectedBrandId = bikeBrandSelect.value;
            // Clear existing options in the bike model select field
            bikeModelSelect.innerHTML = '';
            // Add a default option
            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.text = 'Select Model';
            bikeModelSelect.appendChild(defaultOption);

            // Populate the bike model select field based on the selected brand ID
            if (selectedBrandId) {
                bikeModelsData[selectedBrandId].forEach(model => {
                    const option = document.createElement('option');
                    option.value = model.id;
                    option.text = model.name;

                    bikeModelSelect.appendChild(option);
                });

            }
        });

        $(document).ready(function() {
            var isModalOpen = false; // Variable to track modal state

            // Handle the "পরবর্তী ধাপ" button click event for the main form
            $('#mainForm').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                // Check if the modal is open
                if (!isModalOpen) {
                    // Open the bike selection modal
                    $('#bikeModal').modal('show');
                    isModalOpen = true; // Set modal state to open

                    // Prevent the main form submission until the bike model is selected
                    return false;
                }
            });

            // Event delegation for dynamically generated button
            $('#mainForm').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission
                // Get the selected bike brand and model
                var bikeBrand = $('#bikeBrand').val();
                var bikeModel = $('#bikeModel').val();

                // Check if the bike model is selected
                if (!bikeBrand) {
                    // Show an alert or message indicating that the bike model is required
                    alert('Please Select a Bike Brand Before Submitting.');
                } else {
                    // Add the selected bike brand and model to the main form
                    $('#mainForm').append('<input type="hidden" name="bike_brand" value="' + bikeBrand +
                        '">');
                    $('#mainForm').append('<input type="hidden" name="bike_model_id" value="' + bikeModel +
                        '">');

                    // Close the bike selection modal
                    $('#bikeModal').modal('hide');
                    isModalOpen = false; // Set modal state to closed

                    // Allow the main form submission
                    $('#mainForm').off('submit').submit();
                }
            });

            // Handle the modal close event (including clicking outside of the modal)
            $('#bikeModal').on('hidden.bs.modal', function(e) {
                isModalOpen = false; // Set modal state to closed
            });
        });


        $(document).ready(function() {
            if ($('#notLoggedIn').length) {
                $('#loginModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $('#loginModal').modal('show');
            }

            let checked = $('#with-driver').is(":checked");

            if (checked) {
                $('#with-driver-section').removeClass('d-none');
                $('#without-driver-section').addClass('d-none');
            } else {
                $('#with-driver-section').addClass('d-none');
                $('#without-driver-section').removeClass('d-none');

                let authentic_info = $('#authentic-info-check').is(":checked");
                if (authentic_info) {
                    $('#motorcycle_submit_button').attr('disabled', false);
                } else {
                    $('#motorcycle_submit_button').attr('disabled', true);
                }
            }

        });


        $('input[name=without_driver]').on('change', function() {

            if ($(this).val() == 1) {
                $('#with-driver-section').addClass('d-none');
                $('#without-driver-section').removeClass('d-none');
                let authentic_info = $('#authentic-info-check').is(":checked");
                if (authentic_info) {
                    $('#motorcycle_submit_button').attr('disabled', false);
                } else {
                    $('#motorcycle_submit_button').attr('disabled', true);
                }

            } else {
                $('#with-driver-section').removeClass('d-none');
                $('#without-driver-section').addClass('d-none');
                $('#motorcycle_submit_button').attr('disabled', false);

            }
        })


        $('#authentic-info-check').on('change', function() {
            let authentic_info = $(this).is(":checked");
            if (authentic_info) {
                $('#motorcycle_submit_button').attr('disabled', false);
            } else {
                $('#motorcycle_submit_button').attr('disabled', true);
            }
        })

        function displayFileNames() {
            const fileInputs = document.querySelectorAll('input[type="file"]');
            fileInputs.forEach((fileInput) => {
                const fileNameLabel = document.querySelector(`[for=${fileInput.id}]`);
                const selectedFiles = Array.from(fileInput.files).map((file) => file.name).join(', ');

                if (selectedFiles) {
                    fileNameLabel.textContent = selectedFiles;
                } else {
                    fileNameLabel.textContent = 'Choose file...';
                }
            });
        }
    </script>
@endpush
