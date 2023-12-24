
@extends('employee.layout.master')

@section('page_title','Customer Registration')

@section('employee_content')
<div class="container-fluid col-md-8 mt-2">
    <div class="row justify-content-center">
        <div class="card m-4" >
            <div class="card-header">
              <h3>Register Customer</h3>
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
                    <form action="{{ route('employee-customer.store') }}" method="POST" class="needs-validation"
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

                        <input type="hidden" name="created_by" value="{{Auth::user()->id}}" >
                        <input type="hidden" name="user_type" value="1" >
                        {{-- <input type="hidden" name="status" value="1" > --}}

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

