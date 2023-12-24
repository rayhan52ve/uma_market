@extends('frontend.layout.master')
@section('breadcrumb')
    <section class="section">

        <div class="section-header d-flex justify-content-between">

            <h1>@changeLang('Edit Service')</h1>
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
                    <form action="{{ route('user.service.serviceUpdate', $service->id) }}" method="post"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <h4 class="text-dark text-center">গাড়ীর তথ্য</h4>
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <label class="">গাড়ীর ছবি<span class="text-danger">*</span></label>
                                <div id="image-preview" class="image-preview w-100"
                                    style="background-image:url({{ getFile('provider-service', $service->service_image) }});">
                                    <label for="image-upload" id="image-label">@changeLang('Choose File')</label>
                                    <input type="file" name="service_image" id="image-upload" />
                                </div>
                            </div>

                            <div class="col-12 col-md-6 col-lg-9">
                                <div class="row">
                                    <div class="form-group col-md-6 col-lg-6">
                                        <label for="">গাড়ীর ধরণ<span class="text-danger">*</span></label>
                                        <input type="text" name="vehicle" id="vehicle"
                                            class="form-control form_control" value="{{ $service->vehicle }}" readonly>
                                    </div>

                                    <div id="truck_type" class="form-group col-md-6 col-lg-6">
                                        <label for="">ট্রাকের ধরণ<span class="text-danger">*</span></label>
                                        <select name="truck_type" id="" class="form-control select2">
                                            <option selected disabled></option>
                                            @foreach ($truck_types as $truck_type)
                                                <option value="{{ $truck_type->name }}"
                                                    {{ $truck_type->name == $service->truck_type ? 'selected' : '' }}>
                                                    {{ $truck_type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div id="seat" class="form-group col-md-6 col-lg-6">
                                        <label for="">কত সিট<span class="text-danger">*</span></label>
                                        <input type="text" value="{{ $service->vehicle_seat }}" name="vehicle_seat"
                                            class="form-control form_control">
                                    </div>

                                    <div id="ton" class="form-group col-md-6 col-lg-6">
                                        <label for="">কত টন বহনযোগ্য<span class="text-danger">*</span></label>
                                        <input type="text" value="{{ $service->ton_capacity }}" name="ton_capacity"
                                            class="form-control form_control">
                                    </div>
                                    <div id="bikebrand" class="form-group col-md-6 col-lg-6">
                                        <label for="bikeBrand">গাড়ীর কোম্পানী<span class="text-danger">*</span></label>
                                        <select name="bike_brand_id" id="bikeBrand" class="form-control">
                                            <!-- Populate options dynamically, you can use a loop here -->
                                            <option value="">ব্র্যান্ড নির্বাচন করুন</option>
                                            @foreach ($bikeBrands as $brand)
                                                <option value="{{ $brand->id }}"
                                                    {{ $service->bike_brand_id == $brand->id || old('bike_brand_id') == $brand->id ? 'selected' : '' }}>
                                                    {{ $brand->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div id="bikemodel" class="form-group col-md-6 col-lg-6">
                                        <label for="bikeModel">গাড়ীর মডেল<span class="text-danger">*</span></label>
                                        <select name="bike_model_id" id="bikeModel" class="form-control">
                                            <!-- Populate options dynamically, you can use a loop here -->
                                            <option value="">মডেল নির্বাচন করুন</option>
                                            @foreach ($bikeModels as $model)
                                                <option value="{{ $model->id }}"
                                                    {{ $service->bike_model_id == $model->id || old('bike_model_id') == $model->id ? 'selected' : '' }}>
                                                    {{ $model->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div id="vehicleModel" class="form-group col-md-6 col-lg-6">
                                        <label for="">গাড়ীর মডেল<span class="text-danger">*</span></label>
                                        <input type="text" value="{{ $service->car_model }}" name="car_model"
                                            class="form-control form_control">
                                    </div>

                                    <div id="bikeOil" class="form-group col-md-6 col-lg-6">
                                        <label for="">গাড়ীর জ্বালানির নাম<span class="text-danger">*</span></label>
                                        <select name="bike_oil" id="" class="form-control select2">
                                            <option selected disabled></option>
                                            <option {{ $service->bike_oil == 'পেট্রোল' ? 'selected' : '' }}
                                                value="পেট্রোল">পেট্রোল</option>
                                            <option {{ $service->bike_oil == 'অকটেন' ? 'selected' : '' }} value="অকটেন">
                                                অকটেন</option>
                                            <option {{ $service->bike_oil == 'ব্যাটারি চালিত' ? 'selected' : '' }}
                                                value="ব্যাটারি চালিত">ব্যাটারি চালিত</option>
                                        </select>
                                    </div>

                                    <div id="serialNumber" class="form-group col-md-6 col-lg-6">
                                        <label for="">গাড়ীর নম্বর<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">মেট্রো </span>
                                            </div>
                                            @php
                                                $serial = explode('-', $service->serial_number);
                                            @endphp
                                            <select name="serial_prefix" class="custom-select" id="inputGroupSelect05">
                                                <option selected="" disabled>সিরিয়াল </option>

                                                {{-- <option value="ক" {{ $serial[0] == 'ক' ? 'selected' : '' }}>ক</option>
                                                <option value="খ" {{ $serial[0] == 'খ' ? 'selected' : '' }}>খ</option>
                                                <option value="গ" {{ $serial[0] == 'গ' ? 'selected' : '' }}>গ</option>
                                                <option value="ঘ" {{ $serial[0] == 'ঘ' ? 'selected' : '' }}>ঘ
                                                </option>
                                                <option value="ঙ" {{ $serial[0] == 'ঙ' ? 'selected' : '' }}>ঙ
                                                </option> --}}
                                                <option value="অ" {{ $serial[0] == 'অ' ? 'selected' : '' }}>অ
                                                </option>
                                                <option value="আ" {{ $serial[0] == 'আ' ? 'selected' : '' }}>আ
                                                </option>
                                                <option value="ই" {{ $serial[0] == 'ই' ? 'selected' : '' }}>ই
                                                </option>
                                                <option value="ঈ" {{ $serial[0] == 'ঈ' ? 'selected' : '' }}>ঈ
                                                </option>
                                                <option value="উ" {{ $serial[0] == 'উ' ? 'selected' : '' }}>উ
                                                </option>
                                                <option value="ঊ" {{ $serial[0] == 'ঊ' ? 'selected' : '' }}>ঊ
                                                </option>
                                                <option value="ঋ" {{ $serial[0] == 'ঋ' ? 'selected' : '' }}>ঋ
                                                </option>
                                                <option value="এ" {{ $serial[0] == 'এ' ? 'selected' : '' }}>এ
                                                </option>
                                                <option value="ঐ" {{ $serial[0] == 'ঐ' ? 'selected' : '' }}>ঐ
                                                </option>
                                                <option value="ও" {{ $serial[0] == 'ও' ? 'selected' : '' }}>ও
                                                </option>
                                                <option value="ঔ" {{ $serial[0] == 'ঔ' ? 'selected' : '' }}>ঔ
                                                </option>

                                                <option value="ক" {{ $serial[0] == 'ক' ? 'selected' : '' }}>ক
                                                </option>
                                                <option value="খ" {{ $serial[0] == 'খ' ? 'selected' : '' }}>খ
                                                </option>
                                                <option value="গ" {{ $serial[0] == 'গ' ? 'selected' : '' }}>গ
                                                </option>
                                                <option value="ঘ" {{ $serial[0] == 'ঘ' ? 'selected' : '' }}>ঘ
                                                </option>
                                                <option value="ঙ" {{ $serial[0] == 'ঙ' ? 'selected' : '' }}>ঙ
                                                </option>
                                                <option value="চ" {{ $serial[0] == 'চ' ? 'selected' : '' }}>চ
                                                </option>
                                                <option value="ছ" {{ $serial[0] == 'ছ' ? 'selected' : '' }}>ছ
                                                </option>
                                                <option value="জ" {{ $serial[0] == 'জ' ? 'selected' : '' }}>জ
                                                </option>
                                                <option value="ঝ" {{ $serial[0] == 'ঝ' ? 'selected' : '' }}>ঝ
                                                </option>
                                                <option value="ঞ" {{ $serial[0] == 'ঞ' ? 'selected' : '' }}>ঞ
                                                </option>
                                                <option value="ট" {{ $serial[0] == 'ট' ? 'selected' : '' }}>ট
                                                </option>
                                                <option value="ঠ" {{ $serial[0] == 'ঠ' ? 'selected' : '' }}>ঠ
                                                </option>
                                                <option value="ড" {{ $serial[0] == 'ড' ? 'selected' : '' }}>ড
                                                </option>
                                                <option value="ঢ" {{ $serial[0] == 'ঢ' ? 'selected' : '' }}>ঢ
                                                </option>
                                                <option value="ণ" {{ $serial[0] == 'ণ' ? 'selected' : '' }}>ণ
                                                </option>
                                                <option value="ত" {{ $serial[0] == 'ত' ? 'selected' : '' }}>ত
                                                </option>
                                                <option value="থ" {{ $serial[0] == 'থ' ? 'selected' : '' }}>থ
                                                </option>
                                                <option value="দ" {{ $serial[0] == 'দ' ? 'selected' : '' }}>দ
                                                </option>
                                                <option value="ধ" {{ $serial[0] == 'ধ' ? 'selected' : '' }}>ধ
                                                </option>
                                                <option value="ন" {{ $serial[0] == 'ন' ? 'selected' : '' }}>ন
                                                </option>
                                                <option value="প" {{ $serial[0] == 'প' ? 'selected' : '' }}>প
                                                </option>
                                                <option value="ফ" {{ $serial[0] == 'ফ' ? 'selected' : '' }}>ফ
                                                </option>
                                                <option value="ব" {{ $serial[0] == 'ব' ? 'selected' : '' }}>ব
                                                </option>
                                                <option value="ভ" {{ $serial[0] == 'ভ' ? 'selected' : '' }}>ভ
                                                </option>
                                                <option value="ম" {{ $serial[0] == 'ম' ? 'selected' : '' }}>ম
                                                </option>
                                                <option value="য" {{ $serial[0] == 'য' ? 'selected' : '' }}>য
                                                </option>
                                                <option value="র" {{ $serial[0] == 'র' ? 'selected' : '' }}>র
                                                </option>
                                                <option value="ল" {{ $serial[0] == 'ল' ? 'selected' : '' }}>ল
                                                </option>
                                                <option value="শ" {{ $serial[0] == 'শ' ? 'selected' : '' }}>শ
                                                </option>
                                                <option value="ষ" {{ $serial[0] == 'ষ' ? 'selected' : '' }}>ষ
                                                </option>
                                                <option value="স" {{ $serial[0] == 'স' ? 'selected' : '' }}>স
                                                </option>
                                                <option value="হ" {{ $serial[0] == 'হ' ? 'selected' : '' }}>হ
                                                </option>
                                                <option value="ড়" {{ $serial[0] == 'ড়' ? 'selected' : '' }}>ড়
                                                </option>
                                                <option value="ঢ়" {{ $serial[0] == 'ঢ়' ? 'selected' : '' }}>ঢ়
                                                </option>
                                                <option value="য়" {{ $serial[0] == 'য়' ? 'selected' : '' }}>য়
                                                </option>
                                                <option value="ক্ষ"> {{ $serial[0] == 'ক্ষ' ? 'selected' : '' }}ক্ষ
                                                </option>

                                            </select>
                                            <input name="serial_number" type="text" value="{{ @$serial[1] }}"
                                                class="form-control form_control" placeholder="সংখ্যা ">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6 col-lg-6">
                                        <label>গাড়ীর মালিকের মোবাইল নম্বর<span class="text-danger">*</span></label>
                                        <input type="number" class="form-control form_control" name="owner_mobile"
                                            value="{{ $service->owner_mobile }}" required>
                                    </div>

                                    <div class="form-group col-md-6 col-lg-6">
                                        <label for="">সার্ভিস লোকেশন<span class="text-danger">*</span></label>
                                        <select name="location" class="form-control select2" id="" required>
                                            <option selected disabled></option>
                                            @foreach ($upazilas as $upazila)
                                                <option value="{{ $upazila->bn_name }}"
                                                    {{ $upazila->bn_name == $service->location ? 'selected' : '' }}>
                                                    {{ $upazila->bn_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div id="numberPlate" class="form-group col-md-6 col-lg-4">
                                <label>গাড়ীর নম্বর প্লেটসহ গাড়ীর ছবি<span class="text-danger">*</span></label>
                                <div id="image-preview1" class="image-preview w-100"
                                    style="background-image:url({{ getFile('provider-service', $service->car_plate_image) }});">
                                    <label for="image-upload1" id="image-label1">@changeLang('Choose File')</label>
                                    <input type="file" name="car_plate_image" id="image-upload1" />
                                </div>
                            </div>

                            <div id="brtaFront" class="form-group col-md-6 col-lg-4">
                                <label>বিআরটিএ ডকুমেন্টসের ছবি (সামনের অংশ)<span class="text-danger">*</span></label>
                                <div id="image-preview2" class="image-preview w-100"
                                    style="background-image:url({{ getFile('provider-service', $service->brta_front) }});">
                                    <label for="image-upload2" id="image-label2">@changeLang('Choose File')</label>
                                    <input type="file" name="brta_front" id="image-upload2" />
                                </div>
                            </div>

                            <div id="brtaBack" class="form-group col-md-6 col-lg-4">
                                <label>বিআরটিএ ডকুমেন্টসের ছবি (পিছনের অংশ)<span class="text-danger">*</span></label>
                                <div id="image-preview3" class="image-preview w-100"
                                    style="background-image:url({{ getFile('provider-service', $service->brta_back) }});">
                                    <label for="image-upload3" id="image-label3">@changeLang('Choose File')</label>
                                    <input type="file" name="brta_back" id="image-upload3" />
                                </div>
                            </div>
                        </div>

                        <div class="row bg-light">
                            <h4 class="text-dark text-center pt-4 pb-3">গাড়ীর মালিক/ড্রাইভারের তথ্য</h4>
                            <div class="form-group col-md-6 col-12">
                                <label>প্রোভাইডার অ্যাকাউন্ট ব্যবহারকারীর পেশা</label>
                                @if(@$service->userDetail->provider_type != 'ড্রাইভার') 
                                <input type="text" class="form-control" name="provider_type" id="provider_type" value="{{$user_details->provider_type}}" readonly>
                                {{-- <select class="form-control form-select" name="provider_type" id="provider_type"
                                    required>
                                    <option selected disabled>নির্বাচন করুন </option>
                                    <option
                                        {{ $user_details != '' ? ($user_details->provider_type != '' ? ($user_details->provider_type == 'মালিক' ? 'selected' : '') : '') : '' }}
                                        value="মালিক">মালিক </option>
                                    <option
                                        {{ $user_details != '' ? ($user_details->provider_type != '' ? ($user_details->provider_type == 'ড্রাইভার' ? 'selected' : '') : '') : '' }}
                                        value="ড্রাইভার">ড্রাইভার </option>
                                </select> --}}
                                @endif
                                @if(@$service->userDetail->provider_type == 'ড্রাইভার') 
                                <input type="text" class="form-control" name="provider_type" id="provider_type" value="{{$service->userDetail->provider_type}}" readonly>
                                {{-- <select class="form-control form-select" name="provider_type" id="provider_type"
                                    required>
                                    <option selected disabled>নির্বাচন করুন </option>
                                    <option
                                        {{ $service->userDetail != '' ? ($service->userDetail->provider_type != '' ? ($service->userDetail->provider_type == 'মালিক' ? 'selected' : '') : '') : '' }}
                                        value="মালিক">মালিক </option>
                                    <option
                                        {{ $service->userDetail != '' ? ($service->userDetail->provider_type != '' ? ($service->userDetail->provider_type == 'ড্রাইভার' ? 'selected' : '') : '') : '' }}
                                        value="ড্রাইভার">ড্রাইভার </option>
                                </select> --}}
                                @endif
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label>প্রোভাইডার অ্যাকাউন্ট ব্যবহারকারীর মোবাইল নম্বর/ইমেইল<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control form_control" name="mobile"
                                    value="{{ $user->mobile . ' / ' . $user->email }}" readonly>
                            </div>

                            @if(@$service->userDetail->provider_type != 'ড্রাইভার') 
                            <div class="form-group col-md-6 col-12">
                                <label>প্রতিষ্ঠানের নাম</label>
                                <input type="text" class="form-control form_control" name="company_name"
                                    value="{{ $user_details != '' ? $user_details->company_name : '' }}">
                            </div>
                            @endif
                            @if(@$service->userDetail->provider_type == 'ড্রাইভার') 
                            <div class="form-group col-md-6 col-12">
                                <label>প্রতিষ্ঠানের নাম</label>
                                <input type="text" class="form-control form_control" name="company_name"
                                    value="{{ $service->userDetail != '' ? $service->userDetail->company_name : '' }}">
                            </div>
                            @endif

                            @if(@$service->userDetail->provider_type != 'ড্রাইভার') 
                            <div class="form-group col-md-6 col-12">
                                <label>প্রতিষ্ঠানের ঠিকানা<span class="text-danger">*</span></label>
                                <textarea name="company_address" class="form-control" rows="1" required> {{ $user_details != '' ? $user_details->company_address : '' }}</textarea>
                            </div>
                            @endif
                            @if(@$service->userDetail->provider_type == 'ড্রাইভার') 
                            <div class="form-group col-md-6 col-12">
                                <label>প্রতিষ্ঠানের ঠিকানা<span class="text-danger">*</span></label>
                                <textarea name="company_address" class="form-control" rows="1" required> {{ $service->userDetail != '' ? $service->userDetail->company_address : '' }}</textarea>
                            </div>
                            @endif

                            @if(@$service->userDetail->provider_type != 'ড্রাইভার') 
                            <div class="form-group col-md-6 col-12">
                                <label>জাতীয় পরিচয়পত্র নম্বর<span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_control" name="nid_no" required
                                    value="{{ $user_details != '' ? $user_details->nid_no : '' }}">
                            </div>
                            @endif
                            @if(@$service->userDetail->provider_type == 'ড্রাইভার') 
                            <div class="form-group col-md-6 col-12">
                                <label>জাতীয় পরিচয়পত্র নম্বর<span class="text-danger">*</span></label>
                                <input type="text" class="form-control form_control" name="nid_no" required
                                    value="{{ $service->userDetail != '' ? $service->userDetail->nid_no : '' }}">
                            </div>
                            @endif

                            @if(@$service->userDetail->provider_type != 'ড্রাইভার') 
                            <div class="form-group col-md-6 col-12">
                                <label>ড্রাইভিং কাজের অভিজ্ঞতা কত বছর</label>
                                <input type="text" class="form-control form_control" name="driving_experience"
                                    value="{{ $user_details != '' ? $user_details->driving_experience : '' }}">
                            </div>
                            @endif
                            @if(@$service->userDetail->provider_type == 'ড্রাইভার') 
                            <div class="form-group col-md-6 col-12">
                                <label>ড্রাইভিং কাজের অভিজ্ঞতা কত বছর</label>
                                <input type="text" class="form-control form_control" name="driving_experience"
                                    value="{{ $service->userDetail != '' ? $service->userDetail->driving_experience : '' }}">
                            </div>
                            @endif

                            @if(@$service->userDetail->provider_type == 'ড্রাইভার') 
                            <div class="form-group col-md-6 col-12">
                                <label>ড্রাইভিং লাইসেন্সের ছবি (সামনের অংশ) <span class="text-danger"
                                        id="required">[ড্রাইভারের জন্য বাধ্যতামূলক]</span></label>
                                <div id="image-preview4" class="image-preview w-100"
                                    style="background-image:url({{ getFile('user_details', $service->userDetail->driving_license_front) }});">
                                    <label for="image-upload4" id="image-label4">@changeLang('Choose File')</label>
                                    <input type="file" name="driving_license_front" id="image-upload4" />
                                </div>
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label>ড্রাইভিং লাইসেন্সের ছবি (পিছনের অংশ) <span class="text-danger"
                                        id="required">[ড্রাইভারের জন্য বাধ্যতামূলক]</span></label>
                                <div id="image-preview5" class="image-preview w-100"
                                    style="background-image:url({{ getFile('user_details', $service->userDetail->driving_license_back) }});">
                                    <label for="image-upload5" id="image-label5">@changeLang('Choose File')</label>
                                    <input type="file" name="driving_license_back" id="image-upload5" />
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="row">
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

                                    @php $j=1 @endphp
                                    @foreach (json_decode($service->car_gallery_image) as $item)
                                    <div class="form-gorup col-md-4 mt-3 remove-gallery">
                                        <div class="w-100 image-area" style="background-image:url({{ getFile('provider-service', $item) }});">
                                            <button class="delete-image"><i class="fa fa-times"></i></button>
                                            <img src="" alt="" class="image-prev-{{$j++}} w-100 d-none">
                                        </div>

                                        <input type="file" name="car_gallery_image[]" class="form-control image mt-2">
                                    </div>
                                @endforeach
                                </div>
                            </div> --}}

                            <div class="form-group col-md-12 mt-5">
                                <button class="btn btn-primary" type="submit">@changeLang('Update Service')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom-script')
    <script>
        $(document).ready(function() {
            switch ('{{ $service->vehicle }}') {
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
                    $('#bikeOil').hide();
                    $('#bikebrand').hide();
                    $('#bikemodel').hide();
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
                    $('#vehicleModel').hide();
                    $('#bikeBrand').hide();
                    $('#bikeOil').show();
                    $('#numberPlate').show();
                    $('#brtaFront').show();
                    $('#brtaBack').show();
                    $('#bikeBrand').show();
                    $('#bikeOil').show();
                    $('#bikebrand').show();
                    $('#bikemodel').show();
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
        // Get references to the select fields
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

        // Trigger the change event if a brand is already selected
        if (bikeBrandSelect.value) {
            bikeBrandSelect.dispatchEvent(new Event('change'));
        }

        $(function() {
            'use strict'
            var i = 1;


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
