@extends('agent.layout.master')

@section('page_title','প্রভাইডার রেজিস্ট্রেশন')

@section('agent_content')
<div class="container-fluid col-md-8 mt-2">
    <div class="row justify-content-center">
        <div class="card m-4" >
            <div class="card-header">
              <h3>প্রভাইডার রেজিস্ট্রেশন</h3>
            </div>
                <div class="card-body">
                    @if($errors->any())
                      <div class="alert alert-danger">
                        <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{$error}}</li>
                          @endforeach
                        </ul>
                      </div>
                    @endif
                    <form action="{{ route('agent-vendor.store') }}" method="POST" class="needs-validation"
                    enctype="multipart/form-data">

                    @csrf
                    <div class="row ">

                        <div class="form-group col-md-6" id="fname">

                            <label for="">@changeLang('First Name') <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="fname" class="form-control">

                        </div>


                        <div class="form-group col-md-6">

                            <label for="">@changeLang('Email Address')<span class="text-danger"></span></label>
                            <input type="email" name="email" class="form-control">

                        </div>

                        <div class="form-group col-md-6">

                            <label for="">@changeLang('Phone')<span class="text-danger">*</span></label>
                            <input type="text" name="mobile" class="form-control">

                        </div>

                        <div class="form-group col-md-6" id="nidno">

                            <label for="">জাতীয় পরিচয়পত্র নং<span class="text-danger">*</span></label>
                            <input type="text" name="nid_no" class="form-control">

                        </div>
                        <div class="form-group col-md-6">

                            <label for="">@changeLang('Password')<span class="text-danger">*</span></label>
                            <div>
                                {{-- <span class="show-hide-password">
                                    <i class="fa fa-eye" style="position: absolute; right: 23; top: 45;"></i>
                                </span> --}}
                                <input type="password" name="password" class="form-control password">
                            </div>

                        </div>
                        <div class="form-group col-md-8">

                            <label for="">@changeLang('Location')<span class="text-danger">*</span></label>
                            <div>
                                <div class="row" >
                                    <div class="col-md-6" >
                                      <select id="division" name="division_id" class="form-control form-select" value="{{ old('division_id') }}">
                                        <option selected disabled>@changeLang('Select Division')</option>
                                        @foreach ($divisions as $division)
                                        <option class="text-dark" value="{{$division->id}}">{{$division->bn_name}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                    <div class="col-md-6" >
                                      <select id="district" name="district_id" class="form-control form-select" value="{{ old('district_id') }}">
                                        <option selected >@changeLang('Select District')</option>
                                      </select>
                                    </div>
                                    <div class="col-md-6" >
                                      <select id="upazila" name="upazila_id" class="form-control form-select" value="{{ old('upazila_id') }}">
                                        <option selected >@changeLang('Select Upazila')</option>
                                      </select>
                                    </div>
                                    <div class="col-md-6" >
                                      <select id="union" name="union_id" class="form-control form-select" value="{{ old('union_id') }}">
                                        <option selected >@changeLang('Select Union')</option>
                                      </select>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="form-group col-md-6" id="nidimagefront">

                            <label for="">জাতীয় পরিচয়পত্রের ছবি (সামনের অংশ)<span
                                    class="text-danger">*</span></label>
                            {{-- <div class="custom-file">
                                <input type="file" name="nid_front" class="custom-file-input"
                                    id="customFile1" value="">
                                <label class="custom-file-label" for="customFile1">Choose file</label>
                            </div> --}}
                            <div id="image-preview2" class="image-preview w-100">
                                <label for="image-upload2" id="image-label2">@changeLang('Choose File')</label>
                                <input type="file" name="nid_front" id="image-upload2" />
                            </div>

                        </div>
                        <div class="form-group col-md-6" id="nidimageback">

                            <label for="">জাতীয় পরিচয়পত্রের ছবি (পিছনের অংশ)<span
                                    class="text-danger">*</span></label>
                            {{-- <div class="custom-file">
                                <input type="file" name="nid_back" class="custom-file-input"
                                    id="customFile2" value="">
                                <label class="custom-file-label" for="customFile2">Choose file</label>
                            </div> --}}
                            <div id="image-preview3" class="image-preview w-100">
                                <label for="image-upload3" id="image-label3">@changeLang('Choose File')</label>
                                <input type="file" name="nid_back" id="image-upload3" />
                            </div>
                        </div>

                        {{-- <div class="form-group col-md-6">

                            <label for="">@changeLang('Confirm Password')<span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" class="form-control">

                        </div> --}}
                        <input type="hidden" name="created_by" value="{{Auth::user()->id}}" >
                        <input type="hidden" name="user_type" value="2" >

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-outline-info form-control">@changeLang('Register Now')</button>
                        </div>

                    </div>


                </form>
                </div>
            
        </div>
    </div>
        
</div> 

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

    $(document).ready(function () {
        $('#division').change(function () {
            var divisionId = $(this).val();
            $('#district').empty();
            $('#upazila').empty();
            $('#union').empty();

            if (divisionId !== '') {
                $.ajax({
                    url: '/getDistricts/' + divisionId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#district').append('<option selected disabled >@changeLang('Select District')</option>');
                        data.forEach(function (district) {
                            $('#district').append('<option value="' + district.id + '">' + district.bn_name + '</option>');
                        });
                    }
                });
            }
        });

        $('#district').change(function () {
            var districtId = $(this).val();
            $('#upazila').empty();
            $('#union').empty();

            if (districtId !== '') {
                $.ajax({
                    url: '/getUpazilas/' + districtId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#upazila').append('<option selected disabled >@changeLang('Select Upazila')</option>');
                        data.forEach(function (upazila) {
                            $('#upazila').append('<option value="' + upazila.id + '">' + upazila.bn_name + '</option>');
                        });
                    }
                });
            }
        });

        $('#upazila').change(function () {
            var upazilaId = $(this).val();
            $('#union').empty();

            if (upazilaId !== '') {
                $.ajax({
                    url: '/getUnions/' + upazilaId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#union').append('<option selected disabled >@changeLang('Select Union')</option>');
                        data.forEach(function (union) {
                            $('#union').append('<option value="' + union.id + '">' + union.bn_name + '</option>');
                        });
                    }
                });
            }
        });
    });

  </script>
@endpush
@endsection

