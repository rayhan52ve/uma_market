@extends('frontend.layout.master')
@section('breadcrumb')
    <section class="section">
        <div class="section-header d-flex justify-content-between">

            <h1>@changeLang('Create Service')</h1>
            </h1>
            <a href="{{ route('user.dashboard') }}" class="btn btn-link">
                <i class="fa fa-home"></i>
            </a>
        </div>

    </section>
@endsection
@section('content')
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4><a href="{{ route('user.service') }}" class="btn btn-primary"> <i class="fa fa-arrow-left"></i>
                            @changeLang('Back')</a></h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.service.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <h4 class="text-dark text-center">গাড়ীর তথ্য</h4>
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <label class="">গাড়ীর ছবি<span class="text-danger">*</span></label>
                                <div id="image-preview" class="image-preview w-100">
                                    <label for="image-upload" id="image-label">@changeLang('Choose File')</label>
                                    <input type="file" name="service_image" id="image-upload" />
                                </div>
                            </div>

                            <div class="col-12 col-md-6 col-lg-9">
                                <div class="row">
                                    <div class="form-group col-md-6 col-lg-6">
                                        <label for="">গাড়ীর ধরণ<span class="text-danger">*</span></label>
                                        <input type="text" name="vehicle" id="vehicle"
                                            class="form-control form_control" value="{{ $vehicle->name }}" readonly>
                                        {{-- <select name="vehicle" id="vehicle" class="form-control select2" >
                                            <option selected disabled></option>
                                            @foreach ($vehicles as $vehicle)
                                                <option {{ $vehicle->id == $vehicle_id ? 'selected' : '' }}
                                                    value="{{ $vehicle->name }}">{{ $vehicle->name }}</option>
                                            @endforeach
                                        </select> --}}
                                    </div>

                                    <div id="truck_type" class="form-group col-md-6 col-lg-6">
                                        <label for="">ট্রাকের ধরণ<span class="text-danger">*</span></label>
                                        <select name="truck_type" id="" class="form-control select2">
                                            <option selected disabled></option>
                                            @foreach ($truck_types as $truck_type)
                                                <option value="{{ $truck_type->name }}"
                                                    {{ old('truck_type') == $truck_type->name ? 'selected' : '' }}>
                                                    {{ $truck_type->name }}
                                                    {{-- <option value="{{ $truck_type->name }}">{{ $truck_type->name }}</option> --}}
                                            @endforeach
                                        </select>
                                    </div>

                                    <div id="seat" class="form-group col-md-6 col-lg-6">
                                        <label for="">কত সিট<span class="text-danger">*</span></label>
                                        <input type="number" value="{{ old('vehicle_seat') }}" name="vehicle_seat"
                                            class="form-control form_control">
                                    </div>

                                    <div id="ton" class="form-group col-md-6 col-lg-6">
                                        <label for="">কত টন বহনযোগ্য<span class="text-danger">*</span></label>
                                        <input type="text" name="ton_capacity" value="{{ old('ton_capacity') }}"
                                            class="form-control form_control">
                                    </div>

                                    <div id="bikebrand" class="form-group col-md-6 col-lg-6">
                                        <label for="bikeBrand">গাড়ীর কোম্পানী<span class="text-danger">*</span></label>
                                        {{-- <input type="text" name="bike_brand" class="form-control form_control" > --}}
                                        <select name="bike_brand_id" id="bikeBrand" class="form-control">
                                            <!-- Populate options dynamically, you can use a loop here -->
                                            <option value="">ব্র্যান্ড নির্বাচন করুন</option>
                                            @foreach ($bikeBrands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div id="bikemodel" class="form-group col-md-6 col-lg-6">
                                        {{-- <label for="bikeModel">Select Bike Model</label> --}}
                                        <label for="bikeModel">গাড়ীর মডেল<span class="text-danger">*</span></label>

                                        <select name="bike_model_id" id="bikeModel" class="form-control">
                                            <!-- Initially, the model select field is empty -->
                                        </select>
                                    </div>

                                    <div id="vehicleModel" class="form-group col-md-6 col-lg-6">
                                        <label for="">গাড়ীর মডেল<span class="text-danger">*</span></label>
                                        <input type="text" name="car_model" value="{{ old('car_model') }}"
                                            class="form-control form_control">
                                    </div>

                                    {{-- <div id="bikeOil" class="form-group col-md-6 col-lg-6">
                                        <label for="">গাড়ীর জ্বালানির নাম<span
                                                class="text-danger">*</span></label>
                                        <select name="bike_oil" id="" class="form-control select2">
                                            <option selected disabled></option>
                                            <option value="পেট্রোল">পেট্রোল</option>
                                            <option value="অকটেন">অকটেন</option>
                                            <option value="ব্যাটারি চালিত">ব্যাটারি চালিত</option>
                                        </select>
                                    </div> --}}
                                    <div id="bikeOil" class="form-group col-md-6 col-lg-6">
                                        <label for="">গাড়ীর জ্বালানির নাম<span class="text-danger">*</span></label>
                                        <select name="bike_oil" class="form-control select2">
                                            <option value="" selected disabled></option>
                                            <option value="পেট্রোল" {{ old('bike_oil') == 'পেট্রোল' ? 'selected' : '' }}>
                                                পেট্রোল</option>
                                            <option value="অকটেন" {{ old('bike_oil') == 'অকটেন' ? 'selected' : '' }}>
                                                অকটেন</option>
                                            <option value="ব্যাটারি চালিত"
                                                {{ old('bike_oil') == 'ব্যাটারি চালিত' ? 'selected' : '' }}>ব্যাটারি চালিত
                                            </option>
                                        </select>
                                    </div>


                                    <div id="serialNumber" class="form-group col-md-6 col-lg-6">
                                        <label for="">গাড়ীর নম্বর<span class="text-danger">*</span></label>
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
                                                <!-- Add more options as needed -->
                                            </select>
                                            <input name="serial_number" value="{{ old('serial_number') }}"
                                                type="number" class="form-control form_control" placeholder="সংখ্যা ">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6 col-lg-6">
                                        <label>গাড়ীর মালিকের মোবাইল নম্বর<span class="text-danger">*</span></label>
                                        <input type="number" class="form-control form_control" name="owner_mobile"
                                            value="{{ old('owner_mobile') }}">
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6">
                                        <label for="">সার্ভিস লোকেশন<span class="text-danger">*</span></label>
                                        <select name="location" class="form-control select2" id="">
                                            <option selected disabled></option>
                                            @foreach ($upazilas as $upazila)
                                                <option value="{{ $upazila->bn_name }}"
                                                    {{ old('location') == $upazila->bn_name ? 'selected' : '' }}>
                                                    {{ $upazila->bn_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div id="numberPlate" class="form-group col-md-6 col-lg-4">
                                <label>গাড়ীর নম্বর প্লেটসহ গাড়ীর ছবি<span class="text-danger">*</span></label>
                                {{-- <div class="custom-file">
                                    <input type="file" name="car_plate_image" class="custom-file-input"
                                        id="customFile1" >
                                    <label class="custom-file-label" for="customFile1">Choose file</label>
                                </div> --}}
                                <div id="image-preview1" class="image-preview w-100">
                                    <label for="image-upload1" id="image-label1">@changeLang('Choose File')</label>
                                    <input type="file" name="car_plate_image" id="image-upload1" />
                                </div>
                            </div>

                            <div id="brtaFront" class="form-group col-md-6 col-lg-4">
                                <label>বিআরটিএ ডকুমেন্টসের ছবি (সামনের অংশ)<span class="text-danger">*</span></label>
                                {{-- <div class="custom-file">
                                    <input type="file" name="brta_front" class="custom-file-input"
                                        id="customFile3" >
                                    <label class="custom-file-label" for="customFile3">Choose file</label>
                                </div> --}}
                                <div id="image-preview2" class="image-preview w-100">
                                    <label for="image-upload2" id="image-label2">@changeLang('Choose File')</label>
                                    <input type="file" name="brta_front" id="image-upload2" />
                                </div>
                            </div>

                            <div id="brtaBack" class="form-group col-md-6 col-lg-4">
                                <label>বিআরটিএ ডকুমেন্টসের ছবি (পিছনের অংশ)<span class="text-danger">*</span></label>
                                {{-- <div class="custom-file">
                                    <input type="file" name="brta_back" class="custom-file-input"
                                        id="customFile4" >
                                    <label class="custom-file-label" for="customFile4">Choose file</label>
                                </div> --}}
                                <div id="image-preview3" class="image-preview w-100">
                                    <label for="image-upload3" id="image-label3">@changeLang('Choose File')</label>
                                    <input type="file" name="brta_back" id="image-upload3" />
                                </div>
                            </div>
                        </div>

                        <div class="row bg-light">
                            <h4 class="text-dark text-center pt-4 pb-3">গাড়ীর মালিক/ড্রাইভারের তথ্য</h4>
                            <div class="form-group col-md-6 col-12">
                                <label>প্রোভাইডার অ্যাকাউন্ট ব্যবহারকারীর পেশা<span class="text-danger">*</span></label>
                                <select class="form-control form-select" name="provider_type" id="provider_type">
                                    <option selected disabled>নির্বাচন করুন </option>
                                    <option
                                        {{ $user_details != '' ? ($user_details->provider_type != '' ? ($user_details->provider_type == 'মালিক' ? 'selected' : '') : '') : '' }}
                                        value="মালিক">মালিক </option>
                                    <option
                                        {{ $user_details != '' ? ($user_details->provider_type != '' ? ($user_details->provider_type == 'ড্রাইভার' ? 'selected' : '') : '') : '' }}
                                        value="ড্রাইভার">ড্রাইভার </option>
                                </select>
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label>প্রোভাইডার অ্যাকাউন্ট ব্যবহারকারীর মোবাইল নম্বর/ইমেইল<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control form_control" name="mobile"
                                    value="{{ $user->mobile . ' / ' . $user->email }}" readonly>
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label>প্রতিষ্ঠানের নাম</label>
                                <input type="text" class="form-control form_control" name="company_name"
                                    value="{{ $user_details != '' ? $user_details->company_name : '' }}">
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label>প্রতিষ্ঠানের ঠিকানা<span class="text-danger">*</span></label>
                                <textarea name="company_address" class="form-control" rows="1"> {{ $user_details != '' ? $user_details->company_address : '' }}</textarea>
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label>জাতীয় পরিচয়পত্র নম্বর<span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_control" name="nid_no"
                                    value="{{ $user_details != '' ? $user_details->nid_no : '' }}">
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label>ড্রাইভিং কাজের অভিজ্ঞতা কত বছর</label>
                                <input type="text" class="form-control form_control" name="driving_experience"
                                    value="{{ $user_details != '' ? $user_details->driving_experience : '' }}">
                            </div>

                            <div id="lisenceF" class="form-group col-md-6 col-12">
                                <label>ড্রাইভিং লাইসেন্সের ছবি (সামনের অংশ) <span class="text-danger"
                                        id="">[ড্রাইভারের জন্য বাধ্যতামূলক]</span></label>
                                {{-- <div class="custom-file">
                                    <input type="file" name="driving_license_front" class="custom-file-input"
                                        id="driving_license_front"
                                        value="{{ $user_details != '' ? getFile('user_details', $user_details->driving_license_front) : '' }}">
                                    <label class="custom-file-label" for="driving_license_front">Choose file</label>
                                </div> --}}
                                <div id="image-preview4" class="image-preview w-100">
                                    <label for="image-upload4" id="image-label4">@changeLang('Choose File')</label>
                                    <input type="file" name="driving_license_front" id="image-upload4" />
                                </div>
                            </div>

                            <div id="lisenceB" class="form-group col-md-6 col-12">
                                <label>ড্রাইভিং লাইসেন্সের ছবি (পিছনের অংশ) <span class="text-danger"
                                        id="">[ড্রাইভারের জন্য বাধ্যতামূলক]</span></label>
                                {{-- <div class="custom-file">
                                    <input type="file" name="driving_license_back" class="custom-file-input"
                                        id="driving_license_back"
                                        value="{{ $user_details != '' ? getFile('user_details', $user_details->driving_license_back) : '' }}">
                                    <label class="custom-file-label" for="driving_license_back">Choose file</label>
                                </div> --}}
                                <div id="image-preview5" class="image-preview w-100">
                                    <label for="image-upload5" id="image-label5">@changeLang('Choose File')</label>
                                    <input type="file" name="driving_license_back" id="image-upload5" />
                                </div>
                            </div>

                        </div>

                        <div class="row mt-5">
                            {{-- <div class="form-group col-md-12 pt-4">
                                <div class="col-md-12 text-right">
                                    <button class="btn btn-primary gallery-btn"> <i class="fa fa-plus"></i>
                                        @changeLang('Add Gallery')</button>
                                </div>

                                <h6 class="text-dark">গাড়ীর কয়েকটি ছবি আপলোড করুন</h6>
                                <div class="row addImage">
                                    <div class="form-gorup col-md-4 mt-3">
                                        <div class="w-100 image-area">
                                            <img src="" alt="@changeLang('image')" class="image-prev-0 d-none">
                                        </div>
                                        <input type="file" name="car_gallery_image[]" class="form-control image mt-2">
                                    </div>
                                </div>
                            </div> --}}

                            <div class="form-group col-md-12">
                                <button class="btn btn-primary" type="submit">@changeLang('Create Service')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-script')
    @if (@$driver_lisence_check->driving_license_front > 0 && @$driver_lisence_check->driving_license_back > 0)
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Get references to the select input and the driving license image fields
                var providerTypeSelect = document.getElementById("provider_type");
                var drivingLicenseFrontField = document.getElementById("lisenceF");
                var drivingLicenseBackField = document.getElementById("lisenceB");

                // Add an event listener to the select input
                providerTypeSelect.addEventListener("change", function() {
                    // Check the selected value
                    var selectedValue = providerTypeSelect.value;

                    // Toggle the visibility of the driving license image fields
                    if (selectedValue === "মালিক") {
                        drivingLicenseFrontField.style.display = "none";
                        drivingLicenseBackField.style.display = "none";
                    } else {
                        drivingLicenseFrontField.style.display = "block";
                        drivingLicenseBackField.style.display = "block";
                    }
                });

                // Initial visibility based on the default selected value
                var initialSelectedValue = providerTypeSelect.value;
                if (initialSelectedValue === "মালিক") {
                    drivingLicenseFrontField.style.display = "none";
                    drivingLicenseBackField.style.display = "none";
                }
            });
        </script>
    @endif
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
            defaultOption.text = 'মডেল নির্বাচন করুন';
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
    </script>
    <script>
        $(document).ready(function() {
            switch ('{{ $vehicle->name }}') {
                case 'ট্রাক':
                    $('#truck_type').show();
                    $('#ton').show();
                    $('#serialNumber').show();
                    $('#vehicleModel').show();
                    $('#numberPlate').show();
                    $('#brtaFront').show();
                    $('#brtaBack').show();

                    $('#seat').hide();
                    $('#bikeBrand').hide();
                    $('#bikeOil').hide();
                    $('#bikebrand').hide();
                    $('#bikemodel').hide();
                    break;

                case 'প্রাইভেট কার':
                case 'মাইক্রো':
                case 'বাস':
                    $('#seat').show();
                    $('#serialNumber').show();
                    $('#vehicleModel').show();
                    $('#bikeBrand').show();
                    $('#bikeOil').show();
                    $('#numberPlate').show();
                    $('#brtaFront').show();
                    $('#brtaBack').show();

                    $('#truck_type').hide();
                    $('#ton').hide();
                    $('#bikeBrand').hide();
                    $('#bikebrand').hide();
                    $('#bikemodel').hide();
                    $('#bikeOil').hide();
                    break;

                case 'এম্বুল্যান্স':
                    $('#serialNumber').show();
                    $('#numberPlate').show();
                    $('#brtaFront').show();
                    $('#brtaBack').show();

                    $('#seat').hide();
                    $('#truck_type').hide();
                    $('#ton').hide();
                    $('#vehicleModel').hide();
                    $('#bikeBrand').hide();
                    $('#bikeOil').hide();
                    $('#bikebrand').hide();
                    $('#bikemodel').hide();
                    break;

                case 'মোটরসাইকেল':
                    $('#serialNumber').show();
                    $('#bikemodel').show();
                    $('#bikebrand').show();
                    $('#bikeOil').show();
                    $('#numberPlate').show();
                    $('#brtaFront').show();
                    $('#brtaBack').show();
                    // $('#bikeBrand').show();
                    $('#bikeOil').show();
                    $('#vehicleModel').hide();
                    $('#seat').hide();
                    $('#truck_type').hide();
                    $('#ton').hide();
                    break;

                case 'মাহিন্দ্রা':
                    $('#serialNumber').show();
                    $('#numberPlate').show();
                    $('#brtaFront').show();
                    $('#brtaBack').show();

                    $('#seat').hide();
                    $('#truck_type').hide();
                    $('#ton').hide();
                    $('#vehicleModel').hide();
                    $('#bikeBrand').hide();
                    $('#bikeOil').hide();
                    $('#bikebrand').hide();
                    $('#bikemodel').hide();
                    break;

                case 'সিএনজি':
                    $('#serialNumber').show();
                    $('#numberPlate').show();
                    $('#brtaFront').show();
                    $('#brtaBack').show();

                    $('#seat').hide();
                    $('#truck_type').hide();
                    $('#ton').hide();
                    $('#vehicleModel').hide();
                    $('#bikeBrand').hide();
                    $('#bikeOil').hide();
                    $('#bikebrand').hide();
                    $('#bikemodel').hide();
                    break;

                case 'ইজিবাইক':
                case 'ভ্যান':
                    $('#seat').hide();
                    $('#truck_type').hide();
                    $('#ton').hide();
                    $('#serialNumber').hide();
                    $('#vehicleModel').hide();
                    $('#bikeBrand').hide();
                    $('#bikeOil').hide();
                    $('#numberPlate').hide();
                    $('#brtaFront').hide();
                    $('#brtaBack').hide();
                    $('#bikebrand').hide();
                    $('#bikemodel').hide();
                    break;

                default:
                    break;
            }
        });

        $(function() {
            'use strict'
            var i = 1;
            var j = 1;

            $('.gallery-btn').on('click', function(e) {

                e.preventDefault();

                var gallery = `
                                <div class="form-gorup col-md-4 mt-3 remove-gallery">
                                    <div class="w-100 image-area">
                                        <button class="delete-image"><i class="fa fa-times"></i></button>
                                            <img src="" alt="" class="image-prev-${j} w-100 d-none">
                                    </div>

                                        <input type="file" name="car_gallery_image[]" class="form-control image mt-2" >
                                </div>
                `;

                $('.addImage').append(gallery);
                j++;
            })

            $(document).on('click', '.delete', function() {
                $(this).closest('.deleteData').remove();
            });
            $(document).on('click', '.delete-v', function() {
                $(this).closest('.videoDelete').remove();
            });

            $(document).on('click', '.delete-image', function(e) {
                e.preventDefault();
                $(this).closest('.remove-gallery').remove();
            });


            function showImagePreview(input, index) {

                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {

                        $('.image-prev-' + index).removeClass('d-none')
                        $('.image-prev-' + index).attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $(document).on('change', '.image', function() {
                let index = $('.image').index(this);
                showImagePreview(this, index);
            });

            $.uploadPreview({
                input_field: "#image-upload", // Default: .image-upload
                preview_box: "#image-preview", // Default: .image-preview
                label_field: "#image-label", // Default: .image-label
                label_default: "{{ changeDynamic('Choose File') }}", // Default: Choose File
                label_selected: "{{ changeDynamic('Upload File') }}", // Default: Change File
                no_label: false, // Default: false
                success_callback: null // Default: null
            });

            $.uploadPreview({
                input_field: "#image-upload1", // Default: .image-upload
                preview_box: "#image-preview1", // Default: .image-preview
                label_field: "#image-label1",
                label_default: "{{ changeDynamic('Choose File') }}", // Default: Choose File
                label_selected: "{{ changeDynamic('Upload File') }}", // Default: Change File
                no_label: false, // Default: false
                success_callback: null // Default: null
            });

            $.uploadPreview({
                input_field: "#image-upload2", // Default: .image-upload
                preview_box: "#image-preview2", // Default: .image-preview
                label_field: "#image-label2",
                label_default: "{{ changeDynamic('Choose File') }}", // Default: Choose File
                label_selected: "{{ changeDynamic('Upload File') }}", // Default: Change File
                no_label: false, // Default: false
                success_callback: null // Default: null
            });

            $.uploadPreview({
                input_field: "#image-upload3", // Default: .image-upload
                preview_box: "#image-preview3", // Default: .image-preview
                label_field: "#image-label3",
                label_default: "{{ changeDynamic('Choose File') }}", // Default: Choose File
                label_selected: "{{ changeDynamic('Upload File') }}", // Default: Change File
                no_label: false, // Default: false
                success_callback: null // Default: null
            });

            $.uploadPreview({
                input_field: "#image-upload4", // Default: .image-upload
                preview_box: "#image-preview4", // Default: .image-preview
                label_field: "#image-label4",
                label_default: "{{ changeDynamic('Choose File') }}", // Default: Choose File
                label_selected: "{{ changeDynamic('Upload File') }}", // Default: Change File
                no_label: false, // Default: false
                success_callback: null // Default: null
            });

            $.uploadPreview({
                input_field: "#image-upload5", // Default: .image-upload
                preview_box: "#image-preview5", // Default: .image-preview
                label_field: "#image-label5",
                label_default: "{{ changeDynamic('Choose File') }}", // Default: Choose File
                label_selected: "{{ changeDynamic('Upload File') }}", // Default: Change File
                no_label: false, // Default: false
                success_callback: null // Default: null
            });

            $(".auto-tokenizer").select2({
                tags: true,
                tokenSeparators: [',', ' ']
            })

        })
    </script>
@endpush


@push('custom-style')
    <style>
        .image-area {
            border: 1px dashed gray;
            height: 300px;
            position: relative;
        }

        .image-area img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .delete-image {
            position: absolute;
            right: 0;
            background: red;
            border: none;
        }

        .delete-image i {
            color: #fff;
        }
    </style>
@endpush
