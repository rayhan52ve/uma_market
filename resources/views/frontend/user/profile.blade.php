@extends(auth()->user()->user_type == 2 ? 'frontend.layout.master' : 'frontend.layout.customer')
@if (auth()->user()->user_type == 2)
    @section('breadcrumb')
        <section class="section">
            <div class="section-header">
                <h1>@changeLang('Update Profile')</h1>
            </div>
        </section>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <form method="post" action="{{ route('user.profile.update', @$user->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-12 col-md-6 col-lg-3">
                                    <label class="">@changeLang('profile Image')</label>

                                    <div id="image-preview" class="image-preview w-100"
                                        style="background-image:url({{ getFile('user', @$user->image) }});">
                                        <label for="image-upload" id="image-label">@changeLang('Choose File')</label>
                                        <input type="file" name="image" id="image-upload" />
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6 col-12">
                                    <label>নাম <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form_control" name="name"
                                        value="{{ @$user->fname }}" required>
                                </div>
                                {{-- <div class="form-group col-md-6 col-12">
                                    <div class="form-group">
                                        <label>প্রোভাইডার ক্যাটাগরি <span class="text-danger">*</span></label>
                                        <select class="form-control form-select" name="provider_category" required>
                                            <option selected disabled>নির্বাচন করুন </option>
                                            @foreach ($vehicles as $vehicle)
                                                <option
                                                    {{ @$user_details != '' && $vehicle->name == @$user_details->provider_category ? 'selected' : '' }}
                                                    value="{{ $vehicle->name }}">{{ $vehicle->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}

                                {{-- <div class="form-group col-md-6 col-12">
                                    <label>ড্রাইভার/মালিক সিলেক্ট করুন<span class="text-danger">*</span></label>
                                    <select class="form-control form-select" name="provider_type" required>
                                        <option selected disabled>নির্বাচন করুন </option>
                                        <option
                                            {{ @$user_details != '' && 'মালিক' == @$user_details->provider_type ? 'selected' : '' }}
                                            value="মালিক">মালিক </option>
                                        <option
                                            {{ @$user_details != '' && 'ড্রাইভার' == @$user_details->provider_type ? 'selected' : '' }}
                                            value="ড্রাইভার">ড্রাইভার </option>
                                    </select>
                                </div> --}}

                                {{-- <div class="form-group col-md-6 col-12">
                                    <label>গাড়ীর মালিকের মোবাইল নম্বর<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control form_control" name="owner_mobile" required
                                        value="{{ @$user_details != '' ? @$user_details->owner_mobile : '' }}">
                                </div> --}}
                                <div class="form-group col-md-6 col-12">
                                    <label>প্রোভাইডার অ্যাকাউন্ট ব্যবহারকারীর পেশা<span class="text-danger">*</span></label>
                                    <select class="form-control form-select" name="provider_type" id="provider_type"
                                        required>
                                        <option selected disabled>নির্বাচন করুন </option>
                                        <option
                                            {{ @$user_details != '' ? (@$user_details->provider_type != '' ? (@$user_details->provider_type == 'মালিক' ? 'selected' : '') : '') : '' }}
                                            value="মালিক">মালিক </option>
                                        <option
                                            {{ @$user_details != '' ? (@$user_details->provider_type != '' ? (@$user_details->provider_type == 'ড্রাইভার' ? 'selected' : '') : '') : '' }}
                                            value="ড্রাইভার">ড্রাইভার </option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6 col-12">
                                    <label>প্রোভাইডার অ্যাকাউন্ট ব্যবহারকারীর মোবাইল নম্বর<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control form_control" name="mobile"
                                        placeholder="{{ @$user->mobile }}" readonly>
                                </div>

                                <div class="form-group col-md-6 col-12">
                                    <label>প্রোভাইডার অ্যাকাউন্ট ব্যবহারকারীর ইমেইল<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control form_control" name="mobile"
                                        placeholder="{{ @$user->email }}" readonly>
                                </div>

                                <div class="form-group col-md-6 col-12">
                                    <label>প্রতিষ্ঠানের নাম</label>
                                    <input type="text" class="form-control form_control" name="company_name"
                                        value="{{ @$user_details != '' ? @$user_details->company_name : '' }}">
                                </div>

                                <div class="form-group col-md-6 col-12">
                                    <label>প্রতিষ্ঠানের ঠিকানা<span class="text-danger">*</span></label>
                                    <textarea name="company_address" class="form-control" rows="1" required> {{ @$user_details != '' ? @$user_details->company_address : '' }}</textarea>
                                </div>

                                <div class="form-group col-md-6 col-12">
                                    <label>ড্রাইভিং কাজের অভিজ্ঞতা কত বছর</label>
                                    <input type="text" class="form-control form_control" name="driving_experience"
                                        value="{{ @$user_details != '' ? @$user_details->driving_experience : '' }}">
                                </div>

                                <div class="form-group col-md-6 col-12">
                                    <label>জাতীয় পরিচয়পত্র নম্বর<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form_control" required
                                        value="{{ @$user_details != '' ? @$user_details->nid_no : '' }}" readonly>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>@changeLang('Referral')</label>
                                    <input type="text" class="form-control form_control" required
                                        value="{{ $vendordetails != '' ? $vendordetails->referral : '' }}" readonly>
                                </div>
                                <div class="form-group col-md-6 col-12">

                                    <label for="">@changeLang('Location')</label>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-6" >
                                                <select id="division" name="division_id" class="form-select"
                                                    value="{{ old('division_id') }}">
                                                    <option selected disabled>@changeLang('Select Division')</option>
                                                    @foreach ($divisions as $division)
                                                        <option class="text-dark" value="{{ $division->id }}">
                                                            {{ $division->bn_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <select id="district" name="district_id" class="form-select"
                                                    value="{{ old('district_id') }}">
                                                    <option selected disabled>@changeLang('Select District')</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <select id="upazila" name="upazila_id" class="form-select"
                                                    value="{{ old('upazila_id') }}">
                                                    <option selected disabled >@changeLang('Select Upazila')</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <select id="union" name="union_id" class="form-select"
                                                    value="{{ old('union_id') }}">
                                                    <option selected disabled>@changeLang('Select Union')</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-12">
                                    <label>জাতীয় পরিচয়পত্রের ছবি (সামনের অংশ)<span class="text-danger">*</span></label>
                                    {{-- <div class="custom-file">
                                        <input type="file" name="nid_front" class="custom-file-input" id="customFile1"
                                            value="{{ @$user_details != '' ? getFile('user_details', @$user_details->nid_front) : '' }}">
                                        <label class="custom-file-label" for="customFile1">Choose file</label>
                                    </div> --}}
                                    <div id="image-preview1" class="image-preview w-100"

                                        style="background-image:url({{ getFile('user_details', @$user_details->nid_front) }});">
                                        {{-- <label for="image-upload" id="image-label">@changeLang('Choose File')</label> --}}
                                        {{-- <input type="file" name="nid_front" id="image-upload" /> --}}
                                    </div>
                                </div>

                                <div class="form-group col-md-6 col-12">
                                    <label>জাতীয় পরিচয়পত্রের ছবি (পিছনের অংশ)<span class="text-danger">*</span></label>
                                    {{-- <div class="custom-file">
                                        <input type="file" name="nid_back" class="custom-file-input" id="customFile2"
                                            value="{{ @$user_details != '' ? getFile('user_details', @$user_details->nid_back) : '' }}">
                                        <label class="custom-file-label" for="customFile2">Choose file</label>
                                    </div> --}}
                                    <div id="image-preview2" class="image-preview w-100"
                                        style="background-image:url({{ getFile('user_details', @$user_details->nid_back) }});">
                                        {{-- <label for="image-upload" id="image-label">@changeLang('Choose File')</label> --}}
                                        {{-- <input type="file" name="nid_front" id="image-upload" /> --}}
                                    </div>
                                </div>


                                <div class="form-group col-md-6 col-12">
                                    <label>ড্রাইভিং লাইসেন্সের ছবি (সামনের অংশ) <span class="text-danger"
                                            id="required">[ড্রাইভারের জন্য বাধ্যতামূলক]</span></label>
                                    {{-- <div class="custom-file">
                                        <input type="file" name="driving_license_front" class="custom-file-input"
                                            id="driving_license_front"
                                            value="{{ @$user_details != '' ? getFile('user_details', @$user_details->driving_license_front) : '' }}">
                                        <label class="custom-file-label" for="driving_license_front">Choose file</label>
                                    </div> --}}
                                    <div id="image-preview3" class="image-preview w-100"
                                        style="background-image:url({{ getFile('user_details', @$user_details->driving_license_front) }});">
                                        <label for="image-upload3" id="image-label3">@changeLang('Choose File')</label>
                                        <input type="file" name="driving_license_front" id="image-upload3" />
                                    </div>
                                </div>

                                <div class="form-group col-md-6 col-12">
                                    <label>ড্রাইভিং লাইসেন্সের ছবি (পিছনের অংশ) <span class="text-danger"
                                            id="required">[ড্রাইভারের জন্য বাধ্যতামূলক]</span></label>
                                    {{-- <div class="custom-file">
                                        <input type="file" name="driving_license_back" class="custom-file-input"
                                            id="driving_license_back"
                                            value="{{ @$user_details != '' ? getFile('user_details', @$user_details->driving_license_back) : '' }}">
                                        <label class="custom-file-label" for="driving_license_back">Choose file</label>
                                    </div> --}}
                                    <div id="image-preview4" class="image-preview w-100"
                                        style="background-image:url({{ getFile('user_details', @$user_details->driving_license_back) }});">
                                        <label for="image-upload4" id="image-label4">@changeLang('Choose File')</label>
                                        <input type="file" name="driving_license_back" id="image-upload4" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">@changeLang('Update Profile')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection

    @push('custom-script')
        <script>
            'use strict'
            $(function() {
                $.uploadPreview({
                    input_field: "#image-upload", // Default: .image-upload
                    preview_box: "#image-preview", // Default: .image-preview
                    label_field: "#image-label", // Default: .image-label
                    label_default: "@changeLang('File')", // Default: Choose File
                    label_selected: "@changeLang('Upload File')", // Default: Change File
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
            })



            $(document).ready(function() {
                $('#division').change(function() {
                    var divisionId = $(this).val();
                    $('#district').empty();
                    $('#upazila').empty();
                    $('#union').empty();

                    if (divisionId !== '') {
                        $.ajax({
                            url: '/getDistricts/' + divisionId,
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                $('#district').append(
                                    '<option selected disabled >@changeLang('Select District')</option>');
                                data.forEach(function(district) {
                                    $('#district').append('<option value="' + district.id +
                                        '">' + district.bn_name + '</option>');
                                });
                            }
                        });
                    }
                });

                $('#district').change(function() {
                    var districtId = $(this).val();
                    $('#upazila').empty();
                    $('#union').empty();

                    if (districtId !== '') {
                        $.ajax({
                            url: '/getUpazilas/' + districtId,
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                $('#upazila').append(
                                    '<option selected disabled >@changeLang('Select Upazila')</option>');
                                data.forEach(function(upazila) {
                                    $('#upazila').append('<option value="' + upazila.id +
                                        '">' + upazila.bn_name + '</option>');
                                });
                            }
                        });
                    }
                });

                $('#upazila').change(function() {
                    var upazilaId = $(this).val();
                    $('#union').empty();

                    if (upazilaId !== '') {
                        $.ajax({
                            url: '/getUnions/' + upazilaId,
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                $('#union').append(
                                    '<option selected disabled >@changeLang('Select Union')</option>');
                                data.forEach(function(union) {
                                    $('#union').append('<option value="' + union.id + '">' +
                                        union.bn_name + '</option>');
                                });
                            }
                        });
                    }
                });
            });
        </script>
    @endpush
@else
    @section('customer-breadcumb', 'প্রোফাইল')
    @section('customer-content')
        <div class="team-page pt_30 pb_60">
            <div class="container">
                <div class="row py-5">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form method="post" action="{{ route('user.profile.update', @$user->id) }}"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group col-lg-8 col-sm-6 col-md-10">
                                                <label class="">@changeLang('profile Image')</label>

                                                <div id="image-preview" class="image-preview w-100"
                                                    style="background-image:url({{ getFile('user', @$user->image) }});">
                                                    <label for="image-upload" id="image-label">@changeLang('Choose File')</label>
                                                    <input type="file" name="image" id="image-upload" />
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="form-group col-3 col-md-6 col-12">
                                                    <label>নাম <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control form_control"
                                                        name="name" value="{{ @$user->fname }}" required>
                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <label>@changeLang('Address')</label>
                                                    <input type="text" name="address"
                                                        value="{{ @$user_details != '' ? @$user_details->address ?? old('address') : '' }}"
                                                        class="form-control form_control">
                                                </div>
                                                <div class="form-group col-3 col-md-6 col-12">
                                                    <label>মোবাইল <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control form_control"
                                                        name="mobile" value="{{ @$user->mobile }}" disabled>
                                                </div>
                                                <div class="form-group col-3 col-md-6 col-12">
                                                    <label>ইমেইল <span class="text-danger">*</span></label>
                                                    <input type="email" class="form-control form_control"
                                                        name="email" value="{{ @$user->email }}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right pr-4 pb-5">
                                    <button type="submit" class="btn btn-primary">@changeLang('Update Profile')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('script')
        <script>
            'use strict'
            $(function() {
                $.uploadPreview({
                    input_field: "#image-upload", // Default: .image-upload
                    preview_box: "#image-preview", // Default: .image-preview
                    label_field: "#image-label", // Default: .image-label
                    label_default: "@changeLang('File')", // Default: Choose File
                    label_selected: "@changeLang('Upload File')", // Default: Change File
                    no_label: false, // Default: false
                    success_callback: null // Default: null
                });

                $('#country option').each(function(index) {

                    let country = "{{ @$user->address->country }}"

                    if ($(this).val() == country) {
                        $(this).attr('selected', 'selected')
                    }
                })
            })
        </script>
    @endpush
@endif
