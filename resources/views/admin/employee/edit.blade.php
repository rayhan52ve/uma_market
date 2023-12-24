@extends('admin.layout.master')
@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            <h1>@changeLang('Edit Employee')</h1>
        </div>
    </section>
@endsection
@section('content')
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body ">
                    <div class="table-responsive">
                        <form action="{{ route('admin.employee.update', @$employees) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <table class="table table-bordered">
                                <tr>
                                    <td class="w-50">@changeLang('First Name')<span class="text-danger">*</span></td>
                                    <td class="w-50">
                                        <input type="text" value="{{ @$employees->fname }}" class="form-control"
                                            name="fname" placeholder="@changeLang('First Name')" required>
                                        @error('fname')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-50">@changeLang('Last Name')</td>
                                    <td class="w-50">
                                        <input type="text" value="{{ @$employees->lname }}" class="form-control"
                                            name="lname" placeholder="@changeLang('Last Name')">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-50">@changeLang('User Name')<span class="text-danger">*</span></td>
                                    <td class="w-50">
                                        <input type="text" value="{{ @$employees->username }}" class="form-control"
                                            name="username" placeholder="@changeLang('User Name')" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-50">@changeLang('Employee Role')<span class="text-danger">*</span></td>
                                    <td class="w-50">
                                        <select id="has_agent_id" name="employee_role" class="form-control form-select" >
                                            <option selected disabled>@changeLang('Select Role')</option>
                                            <option class="text-dark" value="Zone Manager" @if ($employees->employee_role=='Zone Manager')selected @endif>@changeLang('Zone Manager')</option>
                                            <option class="text-dark" value="Team Leader" @if ($employees->employee_role=='Team Leader')selected @endif>@changeLang('Team Leader')</option>
                                            <option class="text-dark" value="Brand Promoter" @if ($employees->employee_role=='Brand Promoter')selected @endif>@changeLang('Brand Promoter')</option>
                                        </select>
                                        @error('has_agent_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-50">@changeLang('Location')<span class="text-danger">*</span></td>
                                    <td class="">
                                        <div class="row" >
                                            <div class="col-md-6" >
                                              <select id="division" name="division_id" class="form-control form-select" value="{{ old('division_id') }}">
                                                <option selected value="{{ @$employees->division_id }}">{{ @$employees->division->bn_name }}</option>
                                                @foreach ($divisions as $division)
                                                <option class="text-dark" value="{{$division->id}}">{{$division->bn_name}}</option>
                                                @endforeach
                                              </select>
                                            </div>
                                            <div class="col-md-6" >
                                              <select id="district" name="district_id" class="form-control form-select" value="{{ old('district_id') }}">
                                                <option selected value="{{ @$employees->district_id }}">{{ @$employees->district->bn_name }}</option>
                                                {{-- @foreach ($districts as $district) --}}
                                                <option >@changeLang('Select District')</option>
                                                {{-- @endforeach --}}
                                              </select>
                                            </div>
                                           <div class="col-md-6" >
                                              <select id="upazila" name="upazila_id" class="form-control form-select" value="{{ old('upazila_id') }}">
                                                <option selected value="{{ @$employees->upazila_id }}">{{ @$employees->upazila->bn_name }}</option>
                                            {{-- @foreach ($upazilas as $upazila) --}}
                                                <option >@changeLang('Select Upazila')</option>
                                                 {{-- @endforeach --}}
                                              </select>
                                            </div>
                                             <div class="col-md-6" >
                                              <select id="union" name="union_id" class="form-control form-select" value="{{ old('union_id') }}">
                                                <option selected value="{{ @$employees->union_id }}">{{ @$employees->union->bn_name }}</option>
                                                {{-- @foreach ($unions as $union) --}}
                                                <option >@changeLang('Select Union')</option>
                                                {{-- @endforeach --}}
                                              </select>
                                            </div>
                                           </div>
                                       </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-50">@changeLang('Email')<span class="text-danger">*</span></td>
                                    <td class="w-50">
                                        <input type="email" value="{{ @$employees->email }}" class="form-control"
                                            name="email" placeholder="@changeLang('Email')" required>
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-50">@changeLang('Mobile')<span class="text-danger">*</span></td>
                                    <td class="w-50">
                                        <input type="tel" value="{{ @$employees->mobile }}" class="form-control"
                                            name="mobile" placeholder="@changeLang('Mobile')" required>
                                        @error('mobile')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-50">@changeLang('Designition')</td>
                                    <td class="w-50">
                                        <input type="text" value="{{ @$employees->designation }}" class="form-control"
                                            name="designation" placeholder="@changeLang('Designition')">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-50">@changeLang('Details')</td>
                                    <td class="w-50">
                                        <input type="text" value="{{ @$employees->details }}" class="form-control"
                                            name="details" placeholder="@changeLang('Details')">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-50">@changeLang('Experience')</td>
                                    <td class="w-50">
                                        <input type="text" value="{{ @$employees->experience }}" class="form-control"
                                            name="experience" placeholder="@changeLang('Experience')">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-50">@changeLang('Qualifications')</td>
                                    <td class="w-50">
                                        <input type="text" value="{{ @$employees->qualification }}" class="form-control"
                                            name="qualification" placeholder="@changeLang('Qualifications')">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-50">@changeLang('Status')<span class="text-danger">*</span></td>
                                    <td class="w-50">
                                        <select name="status" class="form-control">
                                            <option value="0" @if (@$employees->status == 0) selected @endif>@changeLang('Inactive')</option>
                                            <option value="1" @if (@$employees->status == 1) selected @endif>@changeLang('Active')</option>
                                        </select>
                                        @error('status')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                            </table>
                            <button type="submit" class="btn btn-primary">@changeLang('Update Employee')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('footer_js')
{{-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    document.getElementById('has_agent_id').addEventListener('change', function () {
        var selectedValue = this.value;
        var selectedText = this.options[this.selectedIndex].text;
        document.getElementById('has_agent_name').value = selectedText;

        axios.post('/ajax-request', {
            selectedValue: selectedValue,
            selectedText: selectedText
        })
        .then(function (response) {
            //
        })
        .catch(function (error) {
            console.error(error);
        });
    });
</script> --}}
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


@endsection
