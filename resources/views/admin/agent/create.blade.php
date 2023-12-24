@extends('admin.layout.master')
@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            <h1>@changeLang('Add Agent')</h1>
        </div>
    </section>



@endsection
@section('content')
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body ">
                    <div class="table-responsive">
                        <form action="{{ route('admin.agent.store') }}" method="POST">
                            @csrf
                            <table class="table table-bordered">
                                <tr>
                                    <td class="w-50">@changeLang('First Name')<span class="text-danger">*</span></td>
                                    <td class="w-50">
                                        <input type="text" value="{{ old('fname') }}" class="form-control"
                                            name="fname" placeholder="@changeLang('First Name')" required>
                                        @error('fname')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-50">@changeLang('Last Name')</td>
                                    <td class="w-50">
                                        <input type="text" value="{{ old('lname') }}" class="form-control"
                                            name="lname" placeholder="@changeLang('Last Name')">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-50">@changeLang('User Name')<span class="text-danger">*</span></td>
                                    <td class="w-50">
                                        <input autocomplete="off" type="text" value="{{ old('username') }}" class="form-control"
                                            name="username" placeholder="@changeLang('User Name')" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-50">@changeLang('Location')</td>
                                    <td class="">
                                        <div class="row" >
                                            <div class="col-md-6" >
                                            <select id="division" name="division_id" class="form-control form-select" value="{{ old('division_id') }}" required>
                                                <option selected disabled>@changeLang('Select Division')<span class="text-danger">*</option>
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
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-50">@changeLang('Email')<span class="text-danger">*</span></td>
                                    <td class="w-50">
                                        <input type="email" value="{{ old('email') }}" class="form-control"
                                            name="email" placeholder="@changeLang('Email')" required>
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-50">@changeLang('Mobile')<span class="text-danger">*</span></td>
                                    <td class="w-50">
                                        <input type="tel" value="{{ old('mobile') }}" class="form-control"
                                            name="mobile" placeholder="@changeLang('Mobile')" required>
                                        @error('mobile')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-50">@changeLang('Agent Referral Code')<span class="text-danger">*</span></td>
                                    <td class="w-50">
                                        <input type="text" value="{{ old('referral') }}" class="form-control"
                                            name="referral" placeholder="@changeLang('Agent Referral Code')" required>
                                        @error('referral')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-50">@changeLang('Password')<span class="text-danger">*</span></td>
                                    <td class="w-50">
                                        <input type="password" class="form-control" name="password" placeholder="@changeLang('Password')"
                                            required>
                                        @error('password')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                            </table>
                            <button type="submit" class="btn btn-primary">@changeLang('Add Agent')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@push('custom-script')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
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

