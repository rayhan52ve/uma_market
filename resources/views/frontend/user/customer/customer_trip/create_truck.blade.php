@extends('frontend.layout.customer')
@section('customer-breadcumb', 'ট্রাক ভাড়া নিতে ফরম পুরন করুন')
@section('customer-content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-12 ">


                <form action="{{ route('user.trip-info.create-step-one.post') }}" method="POST">
                    @csrf

                    <input type="hidden" name="vehicle_id" value="{{ $vehicle_id }}">
                    <div class="card">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>লোড লোকেশন <span class=" text-danger">*</span></label>

                                        <select name="start_location" class="form-control form-select select2">
                                            <option value="">নির্বাচন করুন </option>
                                            @foreach ($upazilas as $upazila)
                                                <option value="{{ $upazila->bn_name }}"
                                                    @if ($trip) {{ $trip->start_location == $upazila->bn_name ? 'selected' : '' }}
                                                    @else {{ old('start_location') == $upazila->bn_name ? 'selected' : '' }} @endif>
                                                    {{ $upazila->bn_name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>আনলোড লোকেশন <span class=" text-danger">*</span></label>
                                        <select name="end_location" class="form-control form-select select2">
                                            <option value="">নির্বাচন করুন </option>
                                            @foreach ($upazilas as $upazila)
                                                <option value="{{ $upazila->bn_name }}"
                                                    @if ($trip) {{ $trip->end_location == $upazila->bn_name ? 'selected' : '' }}
                                                    @else {{ old('end_location') == $upazila->bn_name ? 'selected' : '' }} @endif>
                                                    {{ $upazila->bn_name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>পণ্য গ্রহণকারীর মোবাইল নম্বর <span class=" text-danger">*</span></label>
                                        <input type="text" class="form-control" name="receiver_mobile"
                                            value="{{ $trip->receiver_mobile ?? old('receiver_mobile') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>লোডের তারিখ নির্ধারণ করুন <span class=" text-danger">*</span></label>
                                        <input type="date" class="form-control" name="starting_date"
                                            value="{{ $trip->starting_date ?? old('starting_date') }}" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>লোডের সময় নির্ধারণ করুন <span class=" text-danger">*</span></label>
                                        <input type="time" class="form-control" name="starting_time"
                                            value="{{ $trip->starting_time ?? old('starting_time') }}" autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">

                                    <div class="form-group">
                                        <label>গাড়ী নির্বাচন করুন <span class=" text-danger">*</span></label>
                                        <div>

                                            @foreach ($trucks as $truck)
                                                <input type="radio" class="btn-check " name="truck_type"
                                                    id="truck-{{ $truck->id }}" value="{{ $truck->id }}"
                                                    @if ($trip) {{ $trip->truck_type == $truck->id ? 'checked' : '' }} @else {{ old('truck_type') == $truck->id ? 'checked' : '' }} @endif>
                                                <label class="btn btn-outline-primary mr-2"
                                                    for="truck-{{ $truck->id }}">{{ $truck->name }}</label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>কত টন <span class=" text-danger">*</span></label>
                                        <input type="number" class="form-control" name="ton" step=".01"
                                            value="{{ $trip->ton ?? old('ton') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>কত ফিট</label>
                                        <input type="number" class="form-control" name="feet" step=".01"
                                            value="{{ $trip->feet ?? old('feet') }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>পণ্যের বিবরণ <span class=" text-danger">*</span></label> 
                                        <textarea class="form-control"  rows="5" name="product_description">{{ $trip->product_description ?? old('product_description') }}</textarea>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <input type="radio" class="btn-check " name="second_load" id="one-load"
                                        value="0" autocomplete="off" checked
                                        @if ($trip) {{ $trip->second_load == 0 ? 'checked' : '' }} @else {{ old('second_load') == 0 ? 'checked' : '' }} @endif>
                                    <label class="btn btn-outline-primary btn-block" for="one-load">একটি লোড লোকেশন</label>


                                </div>

                                <div class="col-md-6">
                                    <input type="radio" class="btn-check " name="second_load" id="multi-load"
                                        value="1" autocomplete="off"
                                        @if ($trip) {{ $trip->second_load == 1 ? 'checked' : '' }} @else {{ old('second_load') == 1 ? 'checked' : '' }} @endif>
                                    <label class="btn btn-outline-primary btn-block" for="multi-load">একাধিক লোড
                                        লোকেশন</label>


                                </div>
                            </div>

                            <div class="row mt-4 d-none" id="second_load_section">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>দ্বিতীয় লোড লোকেশন</label>


                                        <select name="second_load_location" class="form-control form-select select2">
                                            <option value="">নির্বাচন করুন </option>
                                            @foreach ($upazilas as $upazila)
                                                <option value="{{ $upazila->bn_name }}"
                                                    @if ($trip) {{ $trip->second_load_location == $upazila->bn_name ? 'selected' : '' }} @else {{ old('second_load_location') == $upazila->bn_name ? 'selected' : '' }} @endif>
                                                    {{ $upazila->bn_name }}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>দ্বিতীয় পণ্য প্রদানকারীর মোবাইল নম্বর</label>
                                        <input type="text" class="form-control" name="second_provider_mobile"
                                            value="{{ $trip->second_provider_mobile ?? old('second_provider_mobile') }}">

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>দ্বিতীয় আনলোড লোকেশন</label>


                                        <select name="second_unload_location" class="form-control form-select select2">
                                            <option value="">নির্বাচন করুন </option>
                                            @foreach ($upazilas as $upazila)
                                                <option value="{{ $upazila->bn_name }}"
                                                    @if ($trip) {{ $trip->second_unload_location == $upazila->bn_name ? 'selected' : '' }} @else {{ old('second_unload_location') == $upazila->bn_name ? 'selected' : '' }} @endif>
                                                    {{ $upazila->bn_name }}</option>
                                            @endforeach

                                        </select>


                                    </div>

                                    <div class="form-group">
                                        <label>দ্বিতীয় পণ্য গ্রহণকারীর মোবাইল নম্বর</label>
                                        <input type="text" class="form-control" name="second_receiver_mobile"
                                            value="{{ $trip->second_receiver_mobile ?? old('second_receiver_mobile') }}">
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-center">

                                    <input type="hidden"
                                        value="@if ($trip) {{ $trip->third_load ?? 0 }} @else {{ old('third_load') ?? 0 }} @endif"
                                        name="third_load" id="third_load">
                                    <button class="btn btn-icon btn-primary" id="add_third_button"><i
                                            class="fas fa-plus"></i></button>
                                </div>
                            </div>

                            <div class="row mt-4 d-none" id="third_load_section">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>তৃতীয় লোড লোকেশন</label>


                                        <select name="third_load_location" class="form-control form-select select2">
                                            <option value="">নির্বাচন করুন </option>
                                            @foreach ($upazilas as $upazila)
                                                <option value="{{ $upazila->bn_name }}"
                                                    @if ($trip) {{ $trip->third_load_location == $upazila->bn_name ? 'selected' : '' }} @else {{ old('third_load_location') == $upazila->bn_name ? 'selected' : '' }} @endif>
                                                    {{ $upazila->bn_name }}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>তৃতীয় পণ্য প্রদানকারীর মোবাইল নম্বর</label>
                                        <input type="text" class="form-control" name="third_provider_mobile"
                                            value="{{ $trip->third_provider_mobile ?? old('third_provider_mobile') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>তৃতীয় আনলোড লোকেশন</label>
                                        <select name="third_unload_location" class="form-control form-select select2">
                                            <option value="">নির্বাচন করুন </option>
                                            @foreach ($upazilas as $upazila)
                                                <option value="{{ $upazila->bn_name }}"
                                                    @if ($trip) {{ $trip->third_unload_location == $upazila->bn_name ? 'selected' : '' }} @else {{ old('third_unload_location') == $upazila->bn_name ? 'selected' : '' }} @endif>
                                                    {{ $upazila->bn_name }}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>তৃতীয় পণ্য গ্রহণকারীর মোবাইল নম্বরঃ</label>
                                        <input type="text" class="form-control" name="third_receiver_mobile"
                                            value="{{ $trip->third_receiver_mobile ?? old('third_receiver_mobile') }}">
                                    </div>
                                </div>

                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    @foreach ($product_tags as $product_tag)
                                        <input type="checkbox" class="btn-check " name="product_tags[]"
                                            id="product_tag-{{ $product_tag->id }}" value="{{ $product_tag->name }}"
                                            @if ($trip) @if ($trip->product_tags)
                                                {{ in_array($product_tag->name, $trip->product_tags) ? 'checked' : '' }} @endif
                                        @else
                                            @if (old('product_tags')) {{ in_array($product_tag->name, old('product_tags')) ? 'checked' : '' }} @endif
                                            @endif>
                                        <label class="btn btn-outline-primary mr-2"
                                            for="product_tag-{{ $product_tag->id }}">{{ $product_tag->name }}</label>
                                    @endforeach
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
        $(document).ready(function() {
            if ($('#notLoggedIn').length) {
                $('#loginModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $('#loginModal').modal('show');
            }

            let checked = $('#multi-load').is(":checked");

            if (checked) {
                $('#second_load_section').removeClass('d-none');
            }

            let third = $('#third_load').val();


            if (third == 1) {
                $('#third_load_section').removeClass('d-none');
                $('#add_third_button').html('<i class="fas fa-times"></i>')
            } else {
                $('#third_load_section').addClass('d-none');
                $('#add_third_button').html('<i class="fas fa-plus"></i>')
            }



        });


        $('#add_third_button').click(function(e) {
            e.preventDefault();



            let hidden = $('#third_load_section').hasClass('d-none');
            if (hidden) {
                $('#third_load_section').removeClass('d-none');
                $('#add_third_button').html('<i class="fas fa-times"></i>')
                $('#third_load').val(1)

            } else {
                $('#third_load_section').addClass('d-none');
                $('#add_third_button').html('<i class="fas fa-plus"></i>')
                $('#third_load').val(0)

            }


        });




        $('input[name=second_load]').on('change', function() {

            let third = $('#third_load').val();
            if ($(this).val() == 1) {

                if (third == 1) {
                    $('#third_load_section').removeClass('d-none');
                }
                $('#second_load_section').removeClass('d-none');
            } else {
                $('#second_load_section').addClass('d-none');
                $('#third_load_section').addClass('d-none');
                $('#third_load').val(0)
            }
        })
    </script>
@endpush
