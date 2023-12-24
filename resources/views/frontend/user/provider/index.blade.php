@extends('frontend.layout.master')
@section('breadcrumb')
    <section class="section">
        <div class="section-header d-flex justify-content-between">

            <h1>@changeLang('All Services')
            </h1>
            <a href="{{ route('user.dashboard') }}" class="btn btn-link">
                <i class="fa fa-home"></i>
            </a>
        </div>

    </section>
@endsection
@section('content')

    {{-- @if (auth()->user()->schedules()->count() == 0)
        <div class="row">

            <div class="col-md-12">

                <p class="alert alert-warning">@changeLang('Please Create Schedule Also, Otherwise your profile will not shown')</p>

            </div>

        </div>
    @endif --}}

    <div class="row">

        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">

                    {{-- <h4>
                        @if ($userDetails)
                            @if (@$userDetails->provider_type == 'ড্রাইভার')
                            @else
                                <a href="{{ route('user.service.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>
                                    @changeLang('Create Service')</a>
                            @endif
                        @else
                            <a href="{{ route('user.service.create') }}" class="btn btn-primary"><i
                                    class="fa fa-plus"></i>
                                @changeLang('Create Service')</a>
                        @endif

                    </h4> --}}

                    {{-- <div class="card-header-form">
                        <form method="GET" action="{{route('user.service.search')}}">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div> --}}

                </div>
                <div class="card-body text-center">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>@changeLang('Service Image')</th>
                                <th>@changeLang('Vehicle')</th>
                                <th>@changeLang('Serial Number')</th>
                                <th>@changeLang('Location')</th>
                                <th>@changeLang('Status')</th>
                                <th>@changeLang('Action')</th>
                            </tr>
                            @forelse ($services as $service)
                                <tr>

                                    <td>
                                        <img src="@if ($service->service_image) {{ getFile('provider-service', $service->service_image) }} @else {{ getFile('logo', $general->service_default_image) }} @endif"
                                            class="image-rounded">

                                    </td>
                                    <td>{{ __($service->vehicle) }}</td>
                                    <td>{{ __($service->serial_number) }}</td>
                                    <td>{{ __($service->location) }}</td>
                                    <td>

                                        @if ($service->admin_approval == 0)
                                            <span class="badge badge-warning">@changeLang('Pending')</span>
                                        @elseif($service->admin_approval == 2)
                                            <span class="badge badge-danger">@changeLang('Rejected')</span>
                                        @elseif($service->status)
                                            <span class="badge badge-success">@changeLang('Active')</span>
                                        @else
                                            <span class="badge badge-danger">@changeLang('Inactive')</span>
                                        @endif


                                    </td>

                                    <td>
                                        <button class="btn btn-info details text-white" data-toggle="modal"
                                            data-target="#servicedetails{{ $service->id }}">@changeLang('Details')</button>
                                        <a href="{{ route('user.service.edit', $service->id) }}" class="btn btn-primary"><i
                                                class="fa fa-pen"></i></a>
                                        <button data-href="{{ route('user.service.delete', $service) }}"
                                            class="btn btn-danger delete"><i class="fa fa-trash"></i></button>


                                    </td>


                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="servicedetails{{ $service->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">

                                        <form action="" method="post">
                                            @csrf
                                            <button type="button" class="close btn-danger" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">@changeLang('Vehicle Information')</h5>
                                                    {{-- <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button> --}}
                                                </div>

                                                <div class="modal-body">
                                                    @if ($service->vehicle == 'ট্রাক')
                                                        <div class="row">

                                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                                <img src="@if ($service->service_image) {{ getFile('provider-service', $service->service_image) }} @else {{ getFile('logo', $general->service_default_image) }} @endif"
                                                                    width="100%">
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                                <p class="text-left font-weight-bold" style="color: black;">

                                                                    {{ __('@changeLang('Vehicle Name')') }} :
                                                                    {{ __($service->vehicle ? $service->vehicle : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Truck Type')') }} :
                                                                    {{ __($service->truck_type ? $service->truck_type : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Ton Capacity')') }} :
                                                                    {{ __($service->ton_capacity ? $service->ton_capacity : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Serial Number')') }} :
                                                                    {{ __($service->serial_number ? $service->serial_number : 'N/A') }}<br>

                                                                    {{ __('@changeLang('Model')') }} :
                                                                    {{ __($service->car_model ? $service->car_model : 'N/A') }}<br>

                                                                    {{ __('@changeLang('Location')') }} :
                                                                    {{ __($service->location ? $service->location : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Owner Phone Number')') }} :
                                                                    {{ __($service->owner_mobile ? $service->owner_mobile : 'N/A') }}<br>
                                                                    <br>
                                                                    {{ __('গাড়ীর মালিক/ড্রাইভারের তথ্য') }}

                                                                    <br>
                                                                    {{-- driver or provider  --}}
                                                                    @if (@$service->userDetail->provider_type != 'ড্রাইভার')
                                                                    {{ __('@changeLang('Provider Type')') }}:
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->provider_type : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Company Name')') }}:
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->company_name : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Company Address')') }}:
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->company_address : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Nid No')') }}. :
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->nid_no : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Driving Experience')') }}:
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->driving_experience : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Address')') }}:
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->company_address : 'N/A') }}<br>
                                                                    @endif

                                                                    @if (@$service->userDetail->provider_type == 'ড্রাইভার')
                                                                    {{ __('@changeLang('Provider Type')') }}:
                                                                    {{ __($service->userDetail ? $service->userDetail->provider_type : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Company Name')') }}:
                                                                    {{ __($service->userDetail ? $service->userDetail->company_name : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Company Address')') }}:
                                                                    {{ __($service->userDetail ? $service->userDetail->company_address : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Nid No')') }}. :
                                                                    {{ __($service->userDetail ? $service->userDetail->nid_no : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Driving Experience')') }}:
                                                                    {{ __($service->userDetail ? $service->userDetail->driving_experience : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Address')') }}:
                                                                    {{ __($service->userDetail ? $service->userDetail->company_address : 'N/A') }}<br>
                                                                    @endif 
                                                                </p>

                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 col-sm-12 col-lg-12">

                                                            <div class="row justify-content-between">
                                                                <div class="col-md-6 col-sm-6 col-lg-6">
                                                                    <p class="text-left font-weight-bold"
                                                                        style="color: black;">

                                                                    <h5> {{ __('@changeLang('Number Plate')') }} :</h5> <br>
                                                                    <img src="@if ($service->car_plate_image) {{ getFile('provider-service', $service->car_plate_image) }} @else {{ getFile('logo', $general->service_default_image) }} @endif"
                                                                        width="100%" height="auto"><br>

                                                                    <h5> {{ __('@changeLang('BRTA Fornt Documents') ') }} :</h5> <br><img
                                                                        src="@if ($service->brta_front) {{ getFile('provider-service', $service->brta_front) }} @else {{ getFile('logo', $general->service_default_image) }} @endif"
                                                                        width="100%" height="auto"><br>

                                                                    <h5> {{ __('@changeLang('Drivers/Owners Nid Back') ') }} :</h5> <br>
                                                                    @php
                                                                        $userDetail = $userDetails->where('user_id', $service->user_id)->first();
                                                                    @endphp
                                                                    @if ($userDetail && $userDetail->nid_back)
                                                                        <img src="{{ getFile('user_details', $userDetail->nid_back) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @else
                                                                        <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @endif
                                                                    @if (@$service->userDetail->provider_type != 'ড্রাইভার')
                                                                    <h5>{{ __('@changeLang('Driving License Back')') }} :</h5><br>
                                                                    @php
                                                                        $userDetail = $userDetails->where('user_id', $service->user_id)->first();
                                                                    @endphp
                                                                    @if ($userDetail && $userDetail->driving_license_back)
                                                                        <img src="{{ getFile('user_details', $userDetail->driving_license_back) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @else
                                                                        <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @endif
                                                                    @endif
                                                                    @if (@$service->userDetail->provider_type == 'ড্রাইভার')
                                                                    <h5>{{ __('@changeLang('Driving License Back')') }} :</h5><br>
                                                                    @if ($service->userDetail->driving_license_back)
                                                                        <img src="{{ getFile('user_details', $service->userDetail->driving_license_back) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @else
                                                                        <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @endif
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-6 col-sm-6 col-lg-6">
                                                                    <p class="text-left font-weight-bold"
                                                                        style="color: black;">
                                                                    <h5> {{ __('@changeLang('BRTA Back Documents') ') }} : </h5> <br><img
                                                                        src="@if ($service->brta_back) {{ getFile('provider-service', $service->brta_back) }} @else {{ getFile('logo', $general->service_default_image) }} @endif"
                                                                        width="100%" height="auto"><br>

                                                                    <h5>{{ __('@changeLang('Drivers/Owners Nid Front')') }} :</h5><br>
                                                                    @php
                                                                        $userDetail = $userDetails->where('user_id', $service->user_id)->first();
                                                                    @endphp
                                                                    @if ($userDetail && $userDetail->nid_front)
                                                                        <img src="{{ getFile('user_details', $userDetail->nid_front) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @else
                                                                        <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @endif

                                                                    {{-- driving license --}}
                                                                    @if (@$service->userDetail->provider_type != 'ড্রাইভার')
                                                                    <h5>{{ __('@changeLang('Driving License Front')') }} :</h5><br>
                                                                    @php
                                                                        $userDetail = $userDetails->where('user_id', $service->user_id)->first();
                                                                        @endphp
                                                                    @if ($userDetail && $userDetail->driving_license_front)
                                                                    <img src="{{ getFile('user_details', $userDetail->driving_license_front) }}"
                                                                    width="100%" height="auto"><br>
                                                                    @else
                                                                    <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                    width="100%" height="auto"><br>
                                                                    @endif
                                                                    @endif
                                                                    @if (@$service->userDetail->provider_type == 'ড্রাইভার')
                                                                    <h5>{{ __('@changeLang('Driving License Front')') }} :</h5><br>
                                                                    @if ($service->userDetail->driving_license_front)
                                                                    <img src="{{ getFile('user_details', $service->userDetail->driving_license_front) }}"
                                                                    width="100%" height="auto"><br>
                                                                    @else
                                                                    <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                    width="100%" height="auto"><br>
                                                                    @endif
                                                                    @endif
                                                                    
                                                                    </p>
                                                                </div>
                                                                {{-- @php
                                                                    dd($userDetails);
                                                                @endphp --}}
                                                            </div>
                                                        </div>
                                                        {{-- <div class="col-12">
                                                            <p class="text-left">
                                                                {{ __('Vehicle Images') }} :<br> @foreach (json_decode($service->car_gallery_image, true) as $gallery_iamge)
                                                                    <img class="mb-1"
                                                                        src="@if ($gallery_iamge) {{ getFile('provider-service', $gallery_iamge) }} @else {{ getFile('logo', $general->service_default_image) }} @endif" width="200px" height="150px">
                                                                @endforeach
                                                            </div> --}}
                                                    @endif

                                                    {{-- micro --}}

                                                    @if ($service->vehicle == 'মাইক্রো' || $service->vehicle == 'প্রাইভেট কার'|| $service->vehicle == 'বাস' )
                                                        @php

                                                        @endphp
                                                        <div class="row">

                                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                                <img src="@if ($service->service_image) {{ getFile('provider-service', $service->service_image) }} @else {{ getFile('logo', $general->service_default_image) }} @endif"
                                                                    width="100%">
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                                <p class="text-left font-weight-bold" style="color: black;">

                                                                    {{ __('@changeLang('Vehicle Name')') }} :
                                                                    {{ __($service->vehicle ? $service->vehicle : 'N/A') }}<br>
                                                                    {{ __('Seat') }} :
                                                                    {{ __($service->vehicle_seat ? $service->vehicle_seat : 'N/A') }}<br>

                                                                    {{ __('@changeLang('Serial Number')') }} :
                                                                    {{ __($service->serial_number ? $service->serial_number : 'N/A') }}<br>

                                                                    {{ __('@changeLang('Model')') }} :
                                                                    {{ __($service->car_model ? $service->car_model : 'N/A') }}<br>

                                                                    {{ __('@changeLang('Location')') }} :
                                                                    {{ __($service->location ? $service->location : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Owner Phone Number')') }} :
                                                                    {{ __($service->owner_mobile ? $service->owner_mobile : 'N/A') }}<br>
                                                                    {{-- @php
                                                                        dd($service);
                                                                    @endphp --}}
                                                                    <br>
                                                                    {{ __('গাড়ীর মালিক/ড্রাইভারের তথ্য') }}

                                                                    <br>
                                                                    {{-- driver or provider  --}}
                                                                    @if (@$service->userDetail->provider_type != 'ড্রাইভার')
                                                                    {{ __('@changeLang('Provider Type')') }}:
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->provider_type : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Company Name')') }}:
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->company_name : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Company Address')') }}:
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->company_address : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Nid No')') }}. :
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->nid_no : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Driving Experience')') }}:
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->driving_experience : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Address')') }}:
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->company_address : 'N/A') }}<br>
                                                                    @endif

                                                                    @if (@$service->userDetail->provider_type == 'ড্রাইভার')
                                                                    {{ __('@changeLang('Provider Type')') }}:
                                                                    {{ __($service->userDetail ? $service->userDetail->provider_type : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Company Name')') }}:
                                                                    {{ __($service->userDetail ? $service->userDetail->company_name : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Company Address')') }}:
                                                                    {{ __($service->userDetail ? $service->userDetail->company_address : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Nid No')') }}. :
                                                                    {{ __($service->userDetail ? $service->userDetail->nid_no : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Driving Experience')') }}:
                                                                    {{ __($service->userDetail ? $service->userDetail->driving_experience : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Address')') }}:
                                                                    {{ __($service->userDetail ? $service->userDetail->company_address : 'N/A') }}<br>
                                                                    @endif 
                                                                </p>

                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 col-sm-12 col-lg-12">

                                                            <div class="row justify-content-between">
                                                                <div class="col-md-6 col-sm-6 col-lg-6">
                                                                    <p class="text-left font-weight-bold"
                                                                        style="color: black;">

                                                                    <h5> {{ __('@changeLang('Number Plate')') }} :</h5> <br>
                                                                    <img src="@if ($service->car_plate_image) {{ getFile('provider-service', $service->car_plate_image) }} @else {{ getFile('logo', $general->service_default_image) }} @endif"
                                                                        width="100%" height="auto"><br>

                                                                    <h5> {{ __('@changeLang('BRTA Fornt Documents') ') }} :</h5> <br><img
                                                                        src="@if ($service->brta_front) {{ getFile('provider-service', $service->brta_front) }} @else {{ getFile('logo', $general->service_default_image) }} @endif"
                                                                        width="100%" height="auto"><br>

                                                                    <h5> {{ __('@changeLang('Drivers/Owners Nid Back') ') }} :</h5> <br>
                                                                    @php
                                                                        $userDetail = $userDetails->where('user_id', $service->user_id)->first();
                                                                    @endphp
                                                                    @if ($userDetail && $userDetail->nid_back)
                                                                        <img src="{{ getFile('user_details', $userDetail->nid_back) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @else
                                                                        <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @endif
                                                                    @if (@$service->userDetail->provider_type != 'ড্রাইভার')
                                                                    <h5>{{ __('@changeLang('Driving License Back')') }} :</h5><br>
                                                                    @php
                                                                        $userDetail = $userDetails->where('user_id', $service->user_id)->first();
                                                                    @endphp
                                                                    @if ($userDetail && $userDetail->driving_license_back)
                                                                        <img src="{{ getFile('user_details', $userDetail->driving_license_back) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @else
                                                                        <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @endif
                                                                    @endif
                                                                    @if (@$service->userDetail->provider_type == 'ড্রাইভার')
                                                                    <h5>{{ __('@changeLang('Driving License Back')') }} :</h5><br>
                                                                    @if ($service->userDetail->driving_license_back)
                                                                        <img src="{{ getFile('user_details', $service->userDetail->driving_license_back) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @else
                                                                        <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @endif
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-6 col-sm-6 col-lg-6">
                                                                    <p class="text-left font-weight-bold"
                                                                        style="color: black;">
                                                                    <h5> {{ __('@changeLang('BRTA Back Documents') ') }} : </h5> <br><img
                                                                        src="@if ($service->brta_back) {{ getFile('provider-service', $service->brta_back) }} @else {{ getFile('logo', $general->service_default_image) }} @endif"
                                                                        width="100%" height="auto"><br>

                                                                    <h5>{{ __('@changeLang('Drivers/Owners Nid Front')') }} :</h5><br>
                                                                    @php
                                                                        $userDetail = $userDetails->where('user_id', $service->user_id)->first();
                                                                    @endphp
                                                                    @if ($userDetail && $userDetail->nid_front)
                                                                        <img src="{{ getFile('user_details', $userDetail->nid_front) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @else
                                                                        <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @endif

                                                                    {{-- driving license --}}
                                                                    @if (@$service->userDetail->provider_type != 'ড্রাইভার')
                                                                    <h5>{{ __('@changeLang('Driving License Front')') }} :</h5><br>
                                                                    @php
                                                                        $userDetail = $userDetails->where('user_id', $service->user_id)->first();
                                                                        @endphp
                                                                    @if ($userDetail && $userDetail->driving_license_front)
                                                                    <img src="{{ getFile('user_details', $userDetail->driving_license_front) }}"
                                                                    width="100%" height="auto"><br>
                                                                    @else
                                                                    <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                    width="100%" height="auto"><br>
                                                                    @endif
                                                                    @endif
                                                                    @if (@$service->userDetail->provider_type == 'ড্রাইভার')
                                                                    <h5>{{ __('@changeLang('Driving License Front')') }} :</h5><br>
                                                                    @if ($service->userDetail->driving_license_front)
                                                                    <img src="{{ getFile('user_details', $service->userDetail->driving_license_front) }}"
                                                                    width="100%" height="auto"><br>
                                                                    @else
                                                                    <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                    width="100%" height="auto"><br>
                                                                    @endif
                                                                    @endif
                                                                    
                                                                    </p>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        {{-- <div class="col-12">
                                                        <p class="text-left">
                                                            {{ __('Vehicle Images') }} :<br> @foreach (json_decode($service->car_gallery_image, true) as $gallery_iamge)
                                                                <img class="mb-1"
                                                                    src="@if ($gallery_iamge) {{ getFile('provider-service', $gallery_iamge) }} @else {{ getFile('logo', $general->service_default_image) }} @endif" width="200px" height="150px">
                                                            @endforeach
                                                        </div> --}}
                                                    @endif



                                                    {{-- ambulence --}}
                                                    @if ($service->vehicle == 'এম্বুল্যান্স')
                                                        @php

                                                        @endphp
                                                        <div class="row">

                                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                                <img src="@if ($service->service_image) {{ getFile('provider-service', $service->service_image) }} @else {{ getFile('logo', $general->service_default_image) }} @endif"
                                                                    width="100%">
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                                <p class="text-left font-weight-bold"
                                                                    style="color: black;">
                                                                    {{ __('@changeLang('Vehicle Name')') }} :
                                                                    {{ __($service->vehicle ? $service->vehicle : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Serial Number')') }} :
                                                                    {{ __($service->serial_number ? $service->serial_number : 'N/A') }}<br>

                                                                    {{ __('@changeLang('Location')') }} :
                                                                    {{ __($service->location ? $service->location : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Owner Phone Number')') }} :
                                                                    {{ __($service->owner_mobile ? $service->owner_mobile : 'N/A') }}<br>
                                                                    {{-- @php
                                                                    dd($service);
                                                                @endphp --}}
                                                                    <br>
                                                                    {{ __('গাড়ীর মালিক/ড্রাইভারের তথ্য') }}

                                                                    <br>
                                                                    {{-- driver or provider  --}}
                                                                    @if (@$service->userDetail->provider_type != 'ড্রাইভার')
                                                                    {{ __('@changeLang('Provider Type')') }}:
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->provider_type : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Company Name')') }}:
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->company_name : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Company Address')') }}:
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->company_address : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Nid No')') }}. :
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->nid_no : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Driving Experience')') }}:
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->driving_experience : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Address')') }}:
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->company_address : 'N/A') }}<br>
                                                                    @endif

                                                                    @if (@$service->userDetail->provider_type == 'ড্রাইভার')
                                                                    {{ __('@changeLang('Provider Type')') }}:
                                                                    {{ __($service->userDetail ? $service->userDetail->provider_type : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Company Name')') }}:
                                                                    {{ __($service->userDetail ? $service->userDetail->company_name : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Company Address')') }}:
                                                                    {{ __($service->userDetail ? $service->userDetail->company_address : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Nid No')') }}. :
                                                                    {{ __($service->userDetail ? $service->userDetail->nid_no : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Driving Experience')') }}:
                                                                    {{ __($service->userDetail ? $service->userDetail->driving_experience : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Address')') }}:
                                                                    {{ __($service->userDetail ? $service->userDetail->company_address : 'N/A') }}<br>
                                                                    @endif 
                                                                </p>

                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 col-sm-12 col-lg-12">

                                                            <div class="row justify-content-between">
                                                                <div class="col-md-6 col-sm-6 col-lg-6">
                                                                    <p class="text-left font-weight-bold"
                                                                        style="color: black;">

                                                                    <h5> {{ __('@changeLang('Number Plate')') }} :</h5> <br>
                                                                    <img src="@if ($service->car_plate_image) {{ getFile('provider-service', $service->car_plate_image) }} @else {{ getFile('logo', $general->service_default_image) }} @endif"
                                                                        width="100%" height="auto"><br>

                                                                    <h5> {{ __('@changeLang('BRTA Fornt Documents') ') }} :</h5> <br><img
                                                                        src="@if ($service->brta_front) {{ getFile('provider-service', $service->brta_front) }} @else {{ getFile('logo', $general->service_default_image) }} @endif"
                                                                        width="100%" height="auto"><br>

                                                                    <h5> {{ __('@changeLang('Drivers/Owners Nid Back') ') }} :</h5> <br>
                                                                    @php
                                                                        $userDetail = $userDetails->where('user_id', $service->user_id)->first();
                                                                    @endphp
                                                                    @if ($userDetail && $userDetail->nid_back)
                                                                        <img src="{{ getFile('user_details', $userDetail->nid_back) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @else
                                                                        <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @endif
                                                                    @if (@$service->userDetail->provider_type != 'ড্রাইভার')
                                                                    <h5>{{ __('@changeLang('Driving License Back')') }} :</h5><br>
                                                                    @php
                                                                        $userDetail = $userDetails->where('user_id', $service->user_id)->first();
                                                                    @endphp
                                                                    @if ($userDetail && $userDetail->driving_license_back)
                                                                        <img src="{{ getFile('user_details', $userDetail->driving_license_back) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @else
                                                                        <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @endif
                                                                    @endif
                                                                    @if (@$service->userDetail->provider_type == 'ড্রাইভার')
                                                                    <h5>{{ __('@changeLang('Driving License Back')') }} :</h5><br>
                                                                    @if ($service->userDetail->driving_license_back)
                                                                        <img src="{{ getFile('user_details', $service->userDetail->driving_license_back) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @else
                                                                        <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @endif
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-6 col-sm-6 col-lg-6">
                                                                    <p class="text-left font-weight-bold"
                                                                        style="color: black;">
                                                                    <h5> {{ __('@changeLang('BRTA Back Documents') ') }} : </h5> <br><img
                                                                        src="@if ($service->brta_back) {{ getFile('provider-service', $service->brta_back) }} @else {{ getFile('logo', $general->service_default_image) }} @endif"
                                                                        width="100%" height="auto"><br>

                                                                    <h5>{{ __('@changeLang('Drivers/Owners Nid Front')') }} :</h5><br>
                                                                    @php
                                                                        $userDetail = $userDetails->where('user_id', $service->user_id)->first();
                                                                    @endphp
                                                                    @if ($userDetail && $userDetail->nid_front)
                                                                        <img src="{{ getFile('user_details', $userDetail->nid_front) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @else
                                                                        <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @endif

                                                                    {{-- driving license --}}
                                                                    @if (@$service->userDetail->provider_type != 'ড্রাইভার')
                                                                    <h5>{{ __('@changeLang('Driving License Front')') }} :</h5><br>
                                                                    @php
                                                                        $userDetail = $userDetails->where('user_id', $service->user_id)->first();
                                                                        @endphp
                                                                    @if ($userDetail && $userDetail->driving_license_front)
                                                                    <img src="{{ getFile('user_details', $userDetail->driving_license_front) }}"
                                                                    width="100%" height="auto"><br>
                                                                    @else
                                                                    <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                    width="100%" height="auto"><br>
                                                                    @endif
                                                                    @endif
                                                                    @if (@$service->userDetail->provider_type == 'ড্রাইভার')
                                                                    <h5>{{ __('@changeLang('Driving License Front')') }} :</h5><br>
                                                                    @if ($service->userDetail->driving_license_front)
                                                                    <img src="{{ getFile('user_details', $service->userDetail->driving_license_front) }}"
                                                                    width="100%" height="auto"><br>
                                                                    @else
                                                                    <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                    width="100%" height="auto"><br>
                                                                    @endif
                                                                    @endif
                                                                    
                                                                    </p>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        {{-- <div class="col-12">
                                                    <p class="text-left">
                                                        {{ __('Vehicle Images') }} :<br> @foreach (json_decode($service->car_gallery_image, true) as $gallery_iamge)
                                                            <img class="mb-1"
                                                                src="@if ($gallery_iamge) {{ getFile('provider-service', $gallery_iamge) }} @else {{ getFile('logo', $general->service_default_image) }} @endif" width="200px" height="150px">
                                                        @endforeach
                                                    </div> --}}
                                                    @endif

                                                    {{-- মোটরসাইকেল --}}
                                                    @if ($service->vehicle == 'মোটরসাইকেল')

                                                        <div class="row">

                                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                                <img src="@if ($service->service_image) {{ getFile('provider-service', $service->service_image) }} @else {{ getFile('logo', $general->service_default_image) }} @endif"
                                                                    width="100%">
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                                <p class="text-left font-weight-bold"
                                                                    style="color: black;">

                                                                    {{ __('@changeLang('Bike Name')') }} :
                                                                    {{ __($service->vehicle ? $service->vehicle : 'N/A') }}<br>

                                                                    {{ __('@changeLang('Bike Brand')') }} :
                                                                    {{ __($service->bike_brand_id ? $service->bikeBrand->name : 'N/A') }}<br>
                                                                    {{ __(' @changeLang('Model')') }} :
                                                                    {{ __($service->bike_model_id ? $service->bikeModel->name : 'N/A') }}<br>
                                                                    {{ __(' @changeLang('Engine Displacement')') }} :
                                                                    {{ __($service->bike_model_id ? $service->bikeModel->engine_displacement : 'N/A') }}cc<br>
                                                                    {{ __(' @changeLang('Bike Oil')') }} :
                                                                    {{ __($service->bike_oil ? $service->bike_oil : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Serial Number')') }} :
                                                                    {{ __($service->serial_number ? $service->serial_number : 'N/A') }}<br>

                                                                    {{ __('@changeLang('Model')') }} :
                                                                    {{ __($service->car_model ? $service->car_model : 'N/A') }}<br>

                                                                    {{ __('@changeLang('Location')') }} :
                                                                    {{ __($service->location ? $service->location : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Owner Phone Number')') }} :
                                                                    {{ __($service->owner_mobile ? $service->owner_mobile : 'N/A') }}<br>
                                                                    {{-- @php
                                                                        dd($service);
                                                                    @endphp --}}
                                                                    <br>
                                                                    {{ __('গাড়ীর মালিক/ড্রাইভারের তথ্য') }}

                                                                    <br>
                                                                    {{-- driver or provider  --}}
                                                                    @if (@$service->userDetail->provider_type != 'ড্রাইভার')
                                                                    {{ __('@changeLang('Provider Type')') }}:
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->provider_type : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Company Name')') }}:
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->company_name : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Company Address')') }}:
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->company_address : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Nid No')') }}. :
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->nid_no : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Driving Experience')') }}:
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->driving_experience : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Address')') }}:
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->company_address : 'N/A') }}<br>
                                                                    @endif

                                                                    @if (@$service->userDetail->provider_type == 'ড্রাইভার')
                                                                    {{ __('@changeLang('Provider Type')') }}:
                                                                    {{ __($service->userDetail ? $service->userDetail->provider_type : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Company Name')') }}:
                                                                    {{ __($service->userDetail ? $service->userDetail->company_name : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Company Address')') }}:
                                                                    {{ __($service->userDetail ? $service->userDetail->company_address : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Nid No')') }}. :
                                                                    {{ __($service->userDetail ? $service->userDetail->nid_no : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Driving Experience')') }}:
                                                                    {{ __($service->userDetail ? $service->userDetail->driving_experience : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Address')') }}:
                                                                    {{ __($service->userDetail ? $service->userDetail->company_address : 'N/A') }}<br>
                                                                    @endif 
                                                                </p>

                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 col-sm-12 col-lg-12">

                                                            <div class="row justify-content-between">
                                                                <div class="col-md-6 col-sm-6 col-lg-6">
                                                                    <p class="text-left font-weight-bold"
                                                                        style="color: black;">

                                                                    <h5> {{ __('@changeLang('Number Plate')') }} :</h5> <br>
                                                                    <img src="@if ($service->car_plate_image) {{ getFile('provider-service', $service->car_plate_image) }} @else {{ getFile('logo', $general->service_default_image) }} @endif"
                                                                        width="100%" height="auto"><br>

                                                                    <h5> {{ __('@changeLang('BRTA Fornt Documents')') }} :</h5> <br><img
                                                                        src="@if ($service->brta_front) {{ getFile('provider-service', $service->brta_front) }} @else {{ getFile('logo', $general->service_default_image) }} @endif"
                                                                        width="100%" height="auto"><br>

                                                                    <h5> {{ __('@changeLang('Drivers/Owners Nid Back') ') }} :</h5> <br>
                                                                    @php
                                                                        $userDetail = $userDetails->where('user_id', $service->user_id)->first();
                                                                    @endphp
                                                                    @if ($userDetail && $userDetail->nid_back)
                                                                        <img src="{{ getFile('user_details', $userDetail->nid_back) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @else
                                                                        <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @endif
                                                                    @if (@$service->userDetail->provider_type != 'ড্রাইভার')
                                                                    <h5>{{ __('@changeLang('Driving License Back')') }} :</h5><br>
                                                                    @php
                                                                        $userDetail = $userDetails->where('user_id', $service->user_id)->first();
                                                                    @endphp
                                                                    @if ($userDetail && $userDetail->driving_license_back)
                                                                        <img src="{{ getFile('user_details', $userDetail->driving_license_back) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @else
                                                                        <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @endif
                                                                    @endif
                                                                    @if (@$service->userDetail->provider_type == 'ড্রাইভার')
                                                                    <h5>{{ __('@changeLang('Driving License Back')') }} :</h5><br>
                                                                    @if ($service->userDetail->driving_license_back)
                                                                        <img src="{{ getFile('user_details', $service->userDetail->driving_license_back) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @else
                                                                        <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @endif
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-6 col-sm-6 col-lg-6">
                                                                    <p class="text-left font-weight-bold"
                                                                        style="color: black;">
                                                                    <h5> {{ __('@changeLang('BRTA Back Documents') ') }} : </h5> <br><img
                                                                        src="@if ($service->brta_back) {{ getFile('provider-service', $service->brta_back) }} @else {{ getFile('logo', $general->service_default_image) }} @endif"
                                                                        width="100%" height="auto"><br>


                                                                    <h5>{{ __('@changeLang('Drivers/Owners Nid Front')') }} :</h5><br>
                                                                    @php
                                                                        $userDetail = $userDetails->where('user_id', $service->user_id)->first();
                                                                    @endphp
                                                                    @if ($userDetail && $userDetail->nid_front)
                                                                        <img src="{{ getFile('user_details', $userDetail->nid_front) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @else
                                                                        <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @endif

                                                                    {{-- driving license --}}
                                                                    @if (@$service->userDetail->provider_type != 'ড্রাইভার')
                                                                    <h5>{{ __('@changeLang('Driving License Front')') }} :</h5><br>
                                                                    @php
                                                                        $userDetail = $userDetails->where('user_id', $service->user_id)->first();
                                                                        @endphp
                                                                    @if ($userDetail && $userDetail->driving_license_front)
                                                                    <img src="{{ getFile('user_details', $userDetail->driving_license_front) }}"
                                                                    width="100%" height="auto"><br>
                                                                    @else
                                                                    <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                    width="100%" height="auto"><br>
                                                                    @endif
                                                                    @endif
                                                                    @if (@$service->userDetail->provider_type == 'ড্রাইভার')
                                                                    <h5>{{ __('@changeLang('Driving License Front')') }} :</h5><br>
                                                                    @if ($service->userDetail->driving_license_front)
                                                                    <img src="{{ getFile('user_details', $service->userDetail->driving_license_front) }}"
                                                                    width="100%" height="auto"><br>
                                                                    @else
                                                                    <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                    width="100%" height="auto"><br>
                                                                    @endif
                                                                    @endif
                                                                    
                                                                    </p>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        {{-- <div class="col-12">
                                                        <p class="text-left">
                                                            {{ __('Vehicle Images') }} :<br> @foreach (json_decode($service->car_gallery_image, true) as $gallery_iamge)
                                                                <img class="mb-1"
                                                                    src="@if ($gallery_iamge) {{ getFile('provider-service', $gallery_iamge) }} @else {{ getFile('logo', $general->service_default_image) }} @endif" width="200px" height="150px">
                                                            @endforeach
                                                        </div> --}}
                                                    @endif

                                                    {{-- সিএনজি --}}
                                                    @if ($service->vehicle == 'সিএনজি')
                                                        <div class="row">

                                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                                <img src="@if ($service->service_image) {{ getFile('provider-service', $service->service_image) }} @else {{ getFile('logo', $general->service_default_image) }} @endif"
                                                                    width="100%">
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                                <p class="text-left font-weight-bold"
                                                                    style="color: black;">

                                                                    {{ __('@changeLang('Vehicle Name')') }} :
                                                                    {{ __($service->vehicle ? $service->vehicle : 'N/A') }}<br>

                                                                    {{ __('@changeLang('Serial Number')') }} :
                                                                    {{ __($service->serial_number ? $service->serial_number : 'N/A') }}<br>

                                                                    {{ __('@changeLang('Location')') }} :
                                                                    {{ __($service->location ? $service->location : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Owner Phone Number')') }} :
                                                                    {{ __($service->owner_mobile ? $service->owner_mobile : 'N/A') }}<br>
                                                                    {{-- @php
                                                                    dd($service);
                                                                @endphp --}}
                                                                    <br>
                                                                    {{ __('গাড়ীর মালিক/ড্রাইভারের তথ্য') }}

                                                                    <br>
                                                                    {{-- driver or provider  --}}
                                                                    @if (@$service->userDetail->provider_type != 'ড্রাইভার')
                                                                    {{ __('@changeLang('Provider Type')') }}:
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->provider_type : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Company Name')') }}:
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->company_name : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Company Address')') }}:
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->company_address : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Nid No')') }}. :
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->nid_no : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Driving Experience')') }}:
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->driving_experience : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Address')') }}:
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->company_address : 'N/A') }}<br>
                                                                    @endif

                                                                    @if (@$service->userDetail->provider_type == 'ড্রাইভার')
                                                                    {{ __('@changeLang('Provider Type')') }}:
                                                                    {{ __($service->userDetail ? $service->userDetail->provider_type : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Company Name')') }}:
                                                                    {{ __($service->userDetail ? $service->userDetail->company_name : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Company Address')') }}:
                                                                    {{ __($service->userDetail ? $service->userDetail->company_address : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Nid No')') }}. :
                                                                    {{ __($service->userDetail ? $service->userDetail->nid_no : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Driving Experience')') }}:
                                                                    {{ __($service->userDetail ? $service->userDetail->driving_experience : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Address')') }}:
                                                                    {{ __($service->userDetail ? $service->userDetail->company_address : 'N/A') }}<br>
                                                                    @endif 
                                                                </p>

                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 col-sm-12 col-lg-12">

                                                            <div class="row justify-content-between">
                                                                <div class="col-md-6 col-sm-6 col-lg-6">
                                                                    <p class="text-left font-weight-bold"
                                                                        style="color: black;">

                                                                    <h5> {{ __('@changeLang('Number Plate')') }} :</h5> <br>
                                                                    <img src="@if ($service->car_plate_image) {{ getFile('provider-service', $service->car_plate_image) }} @else {{ getFile('logo', $general->service_default_image) }} @endif"
                                                                        width="100%" height="auto"><br>

                                                                    <h5> {{ __('@changeLang('BRTA Fornt Documents') ') }} :</h5> <br><img
                                                                        src="@if ($service->brta_front) {{ getFile('provider-service', $service->brta_front) }} @else {{ getFile('logo', $general->service_default_image) }} @endif"
                                                                        width="100%" height="auto"><br>

                                                                    <h5> {{ __('@changeLang('Drivers/Owners Nid Back') ') }} :</h5> <br>
                                                                    @php
                                                                        $userDetail = $userDetails->where('user_id', $service->user_id)->first();
                                                                    @endphp
                                                                    @if ($userDetail && $userDetail->nid_back)
                                                                        <img src="{{ getFile('user_details', $userDetail->nid_back) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @else
                                                                        <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @endif
                                                                    @if (@$service->userDetail->provider_type != 'ড্রাইভার')
                                                                    <h5>{{ __('@changeLang('Driving License Back')') }} :</h5><br>
                                                                    @php
                                                                        $userDetail = $userDetails->where('user_id', $service->user_id)->first();
                                                                    @endphp
                                                                    @if ($userDetail && $userDetail->driving_license_back)
                                                                        <img src="{{ getFile('user_details', $userDetail->driving_license_back) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @else
                                                                        <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @endif
                                                                    @endif
                                                                    @if (@$service->userDetail->provider_type == 'ড্রাইভার')
                                                                    <h5>{{ __('@changeLang('Driving License Back')') }} :</h5><br>
                                                                    @if ($service->userDetail->driving_license_back)
                                                                        <img src="{{ getFile('user_details', $service->userDetail->driving_license_back) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @else
                                                                        <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @endif
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-6 col-sm-6 col-lg-6">
                                                                    <p class="text-left font-weight-bold"
                                                                        style="color: black;">
                                                                    <h5> {{ __('@changeLang('BRTA Back Documents') ') }} : </h5> <br><img
                                                                        src="@if ($service->brta_back) {{ getFile('provider-service', $service->brta_back) }} @else {{ getFile('logo', $general->service_default_image) }} @endif"
                                                                        width="100%" height="auto"><br>


                                                                    <h5>{{ __('@changeLang('Drivers/Owners Nid Front')') }} :</h5><br>
                                                                    @php
                                                                        $userDetail = $userDetails->where('user_id', $service->user_id)->first();
                                                                    @endphp
                                                                    @if ($userDetail && $userDetail->nid_front)
                                                                        <img src="{{ getFile('user_details', $userDetail->nid_front) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @else
                                                                        <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @endif

                                                                    {{-- driving license --}}
                                                                    @if (@$service->userDetail->provider_type != 'ড্রাইভার')
                                                                    <h5>{{ __('@changeLang('Driving License Front')') }} :</h5><br>
                                                                    @php
                                                                        $userDetail = $userDetails->where('user_id', $service->user_id)->first();
                                                                        @endphp
                                                                    @if ($userDetail && $userDetail->driving_license_front)
                                                                    <img src="{{ getFile('user_details', $userDetail->driving_license_front) }}"
                                                                    width="100%" height="auto"><br>
                                                                    @else
                                                                    <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                    width="100%" height="auto"><br>
                                                                    @endif
                                                                    @endif
                                                                    @if (@$service->userDetail->provider_type == 'ড্রাইভার')
                                                                    <h5>{{ __('@changeLang('Driving License Front')') }} :</h5><br>
                                                                    @if ($service->userDetail->driving_license_front)
                                                                    <img src="{{ getFile('user_details', $service->userDetail->driving_license_front) }}"
                                                                    width="100%" height="auto"><br>
                                                                    @else
                                                                    <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                    width="100%" height="auto"><br>
                                                                    @endif
                                                                    @endif
                                                                    
                                                                    </p>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    @endif

                                                    {{-- ভ্যান --}}
                                                    @if ($service->vehicle == 'ভ্যান')
                                                        <div class="row">

                                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                                <img src="@if ($service->service_image) {{ getFile('provider-service', $service->service_image) }} @else {{ getFile('logo', $general->service_default_image) }} @endif"
                                                                    width="100%">
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                                <p class="text-left font-weight-bold"
                                                                    style="color: black;">

                                                                    {{ __('@changeLang('Vehicle Name')') }} :
                                                                    {{ __($service->vehicle ? $service->vehicle : 'N/A') }}<br>

                                                                    {{ __('@changeLang('Location')') }} :
                                                                    {{ __($service->location ? $service->location : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Owner Phone Number')') }} :
                                                                    {{ __($service->owner_mobile ? $service->owner_mobile : 'N/A') }}<br>
                                                                    {{-- @php
                                                                    dd($service);
                                                                @endphp --}}
                                                                    <br>
                                                                    {{ __('গাড়ীর মালিক/ড্রাইভারের তথ্য') }}

                                                                    <br>
                                                                    {{-- driver or provider  --}}
                                                                    @if (@$service->userDetail->provider_type != 'ড্রাইভার')
                                                                    {{ __('@changeLang('Provider Type')') }}:
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->provider_type : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Company Name')') }}:
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->company_name : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Company Address')') }}:
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->company_address : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Nid No')') }}. :
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->nid_no : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Driving Experience')') }}:
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->driving_experience : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Address')') }}:
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->company_address : 'N/A') }}<br>
                                                                    @endif

                                                                    @if (@$service->userDetail->provider_type == 'ড্রাইভার')
                                                                    {{ __('@changeLang('Provider Type')') }}:
                                                                    {{ __($service->userDetail ? $service->userDetail->provider_type : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Company Name')') }}:
                                                                    {{ __($service->userDetail ? $service->userDetail->company_name : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Company Address')') }}:
                                                                    {{ __($service->userDetail ? $service->userDetail->company_address : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Nid No')') }}. :
                                                                    {{ __($service->userDetail ? $service->userDetail->nid_no : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Driving Experience')') }}:
                                                                    {{ __($service->userDetail ? $service->userDetail->driving_experience : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Address')') }}:
                                                                    {{ __($service->userDetail ? $service->userDetail->company_address : 'N/A') }}<br>
                                                                    @endif 
                                                                </p>

                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 col-sm-12 col-lg-12">

                                                            <div class="row justify-content-between">
                                                                <div class="col-md-6 col-sm-6 col-lg-6">
                                                                    <p class="text-left font-weight-bold"
                                                                        style="color: black;">

                                                                    <h5> {{ __('@changeLang('Drivers/Owners Nid Back') ') }} :</h5> <br>
                                                                    @php
                                                                        $userDetail = $userDetails->where('user_id', $service->user_id)->first();
                                                                    @endphp
                                                                    @if ($userDetail && $userDetail->nid_back)
                                                                        <img src="{{ getFile('user_details', $userDetail->nid_back) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @else
                                                                        <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @endif
                                                                    @if (@$service->userDetail->provider_type != 'ড্রাইভার')
                                                                    <h5>{{ __('@changeLang('Driving License Back')') }} :</h5><br>
                                                                    @php
                                                                        $userDetail = $userDetails->where('user_id', $service->user_id)->first();
                                                                    @endphp
                                                                    @if ($userDetail && $userDetail->driving_license_back)
                                                                        <img src="{{ getFile('user_details', $userDetail->driving_license_back) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @else
                                                                        <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @endif
                                                                    @endif
                                                                    @if (@$service->userDetail->provider_type == 'ড্রাইভার')
                                                                    <h5>{{ __('@changeLang('Driving License Back')') }} :</h5><br>
                                                                    @if ($service->userDetail->driving_license_back)
                                                                        <img src="{{ getFile('user_details', $service->userDetail->driving_license_back) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @else
                                                                        <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @endif
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-6 col-sm-6 col-lg-6">
                                                                    <p class="text-left font-weight-bold"
                                                                        style="color: black;">

                                                                        {{-- Nid Front --}}
                                                                    <h5>{{ __('@changeLang('Drivers/Owners Nid Front')') }} :</h5><br>
                                                                    @php
                                                                        $userDetail = $userDetails->where('user_id', $service->user_id)->first();
                                                                    @endphp
                                                                    @if ($userDetail && $userDetail->nid_front)
                                                                        <img src="{{ getFile('user_details', $userDetail->nid_front) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @else
                                                                        <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @endif

                                                                    {{-- driving license --}}
                                                                    @if (@$service->userDetail->provider_type != 'ড্রাইভার')
                                                                    <h5>{{ __('@changeLang('Driving License Front')') }} :</h5><br>
                                                                    @php
                                                                        $userDetail = $userDetails->where('user_id', $service->user_id)->first();
                                                                        @endphp
                                                                    @if ($userDetail && $userDetail->driving_license_front)
                                                                    <img src="{{ getFile('user_details', $userDetail->driving_license_front) }}"
                                                                    width="100%" height="auto"><br>
                                                                    @else
                                                                    <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                    width="100%" height="auto"><br>
                                                                    @endif
                                                                    @endif
                                                                    @if (@$service->userDetail->provider_type == 'ড্রাইভার')
                                                                    <h5>{{ __('@changeLang('Driving License Front')') }} :</h5><br>
                                                                    @if ($service->userDetail->driving_license_front)
                                                                    <img src="{{ getFile('user_details', $service->userDetail->driving_license_front) }}"
                                                                    width="100%" height="auto"><br>
                                                                    @else
                                                                    <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                    width="100%" height="auto"><br>
                                                                    @endif
                                                                    @endif
                                                                    
                                                                    </p>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    @endif
                                                    {{-- মাহিন্দ্রা --}}
                                                    @if ($service->vehicle == 'মাহিন্দ্রা')

                                                        <div class="row">

                                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                                <img src="@if ($service->service_image) {{ getFile('provider-service', $service->service_image) }} @else {{ getFile('logo', $general->service_default_image) }} @endif"
                                                                    width="100%">
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                                <p class="text-left font-weight-bold"
                                                                    style="color: black;">

                                                                    {{ __('@changeLang('Vehicle Name')') }} :
                                                                    {{ __($service->vehicle ? $service->vehicle : 'N/A') }}<br>

                                                                    {{ __('@changeLang('Serial Number')') }} :
                                                                    {{ __($service->serial_number ? $service->serial_number : 'N/A') }}<br>

                                                                    {{ __('@changeLang('Location')') }} :
                                                                    {{ __($service->location ? $service->location : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Owner Phone Number')') }} :
                                                                    {{ __($service->owner_mobile ? $service->owner_mobile : 'N/A') }}<br>
                                                                    {{-- @php
                                                                        dd($service);
                                                                    @endphp --}}
                                                                    <br>
                                                                    {{ __('গাড়ীর মালিক/ড্রাইভারের তথ্য') }}

                                                                    <br>
                                                                    {{-- driver or provider  --}}
                                                                    @if (@$service->userDetail->provider_type != 'ড্রাইভার')
                                                                    {{ __('@changeLang('Provider Type')') }}:
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->provider_type : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Company Name')') }}:
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->company_name : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Company Address')') }}:
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->company_address : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Nid No')') }}. :
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->nid_no : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Driving Experience')') }}:
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->driving_experience : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Address')') }}:
                                                                    {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->company_address : 'N/A') }}<br>
                                                                    @endif

                                                                    @if (@$service->userDetail->provider_type == 'ড্রাইভার')
                                                                    {{ __('@changeLang('Provider Type')') }}:
                                                                    {{ __($service->userDetail ? $service->userDetail->provider_type : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Company Name')') }}:
                                                                    {{ __($service->userDetail ? $service->userDetail->company_name : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Company Address')') }}:
                                                                    {{ __($service->userDetail ? $service->userDetail->company_address : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Nid No')') }}. :
                                                                    {{ __($service->userDetail ? $service->userDetail->nid_no : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Driving Experience')') }}:
                                                                    {{ __($service->userDetail ? $service->userDetail->driving_experience : 'N/A') }}<br>
                                                                    {{ __('@changeLang('Address')') }}:
                                                                    {{ __($service->userDetail ? $service->userDetail->company_address : 'N/A') }}<br>
                                                                    @endif 
                                                                </p>

                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 col-sm-12 col-lg-12">

                                                            <div class="row justify-content-between">
                                                                <div class="col-md-6 col-sm-6 col-lg-6">
                                                                    <p class="text-left font-weight-bold"
                                                                        style="color: black;">

                                                                    <h5> {{ __('@changeLang('Number Plate')') }} :</h5> <br>
                                                                    <img src="@if ($service->car_plate_image) {{ getFile('provider-service', $service->car_plate_image) }} @else {{ getFile('logo', $general->service_default_image) }} @endif"
                                                                        width="100%" height="auto"><br>

                                                                    <h5> {{ __('@changeLang('BRTA Fornt Documents') ') }} :</h5> <br><img
                                                                        src="@if ($service->brta_front) {{ getFile('provider-service', $service->brta_front) }} @else {{ getFile('logo', $general->service_default_image) }} @endif"
                                                                        width="100%" height="auto"><br>

                                                                    <h5> {{ __('@changeLang('Drivers/Owners Nid Back') ') }} :</h5> <br>
                                                                    @php
                                                                        $userDetail = $userDetails->where('user_id', $service->user_id)->first();
                                                                    @endphp
                                                                    @if ($userDetail && $userDetail->nid_back)
                                                                        <img src="{{ getFile('user_details', $userDetail->nid_back) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @else
                                                                        <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @endif
                                                                    @if (@$service->userDetail->provider_type != 'ড্রাইভার')
                                                                    <h5>{{ __('@changeLang('Driving License Back')') }} :</h5><br>
                                                                    @php
                                                                        $userDetail = $userDetails->where('user_id', $service->user_id)->first();
                                                                    @endphp
                                                                    @if ($userDetail && $userDetail->driving_license_back)
                                                                        <img src="{{ getFile('user_details', $userDetail->driving_license_back) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @else
                                                                        <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @endif
                                                                    @endif
                                                                    @if (@$service->userDetail->provider_type == 'ড্রাইভার')
                                                                    <h5>{{ __('@changeLang('Driving License Back')') }} :</h5><br>
                                                                    @if ($service->userDetail->driving_license_back)
                                                                        <img src="{{ getFile('user_details', $service->userDetail->driving_license_back) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @else
                                                                        <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @endif
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-6 col-sm-6 col-lg-6">
                                                                    <p class="text-left font-weight-bold"
                                                                        style="color: black;">
                                                                    <h5> {{ __('@changeLang('BRTA Back Documents') ') }} : </h5> <br><img
                                                                        src="@if ($service->brta_back) {{ getFile('provider-service', $service->brta_back) }} @else {{ getFile('logo', $general->service_default_image) }} @endif"
                                                                        width="100%" height="auto"><br>

                                                                    <h5>{{ __('@changeLang('Drivers/Owners Nid Front')') }} :</h5><br>
                                                                    @php
                                                                        $userDetail = $userDetails->where('user_id', $service->user_id)->first();
                                                                    @endphp
                                                                    @if ($userDetail && $userDetail->nid_front)
                                                                        <img src="{{ getFile('user_details', $userDetail->nid_front) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @else
                                                                        <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                            width="100%" height="auto"><br>
                                                                    @endif

                                                                    {{-- driving license --}}
                                                                    @if (@$service->userDetail->provider_type != 'ড্রাইভার')
                                                                    <h5>{{ __('@changeLang('Driving License Front')') }} :</h5><br>
                                                                    @php
                                                                        $userDetail = $userDetails->where('user_id', $service->user_id)->first();
                                                                        @endphp
                                                                    @if ($userDetail && $userDetail->driving_license_front)
                                                                    <img src="{{ getFile('user_details', $userDetail->driving_license_front) }}"
                                                                    width="100%" height="auto"><br>
                                                                    @else
                                                                    <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                    width="100%" height="auto"><br>
                                                                    @endif
                                                                    @endif
                                                                    @if (@$service->userDetail->provider_type == 'ড্রাইভার')
                                                                    <h5>{{ __('@changeLang('Driving License Front')') }} :</h5><br>
                                                                    @if ($service->userDetail->driving_license_front)
                                                                    <img src="{{ getFile('user_details', $service->userDetail->driving_license_front) }}"
                                                                    width="100%" height="auto"><br>
                                                                    @else
                                                                    <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                    width="100%" height="auto"><br>
                                                                    @endif
                                                                    @endif
                                                                    
                                                                    </p>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    @endif

                                                     {{-- ইজিবাইক --}}
                                                     @if ($service->vehicle == 'ইজিবাইক')

                                                     <div class="row">

                                                         <div class="col-md-6 col-sm-6 col-lg-6">
                                                             <img src="@if ($service->service_image) {{ getFile('provider-service', $service->service_image) }} @else {{ getFile('logo', $general->service_default_image) }} @endif"
                                                                 width="100%">
                                                         </div>
                                                         <div class="col-md-6 col-sm-6 col-lg-6">
                                                             <p class="text-left font-weight-bold"
                                                                 style="color: black;">

                                                                 {{ __('@changeLang('Vehicle Name')') }} :
                                                                 {{ __($service->vehicle ? $service->vehicle : 'N/A') }}<br>
                                                                 {{ __('@changeLang('Location')') }} :
                                                                 {{ __($service->location ? $service->location : 'N/A') }}<br>
                                                                 {{ __('@changeLang('Owner Phone Number')') }} :
                                                                 {{ __($service->owner_mobile ? $service->owner_mobile : 'N/A') }}<br>
                                                                 {{-- @php
                                                                     dd($service);
                                                                 @endphp --}}
                                                                 <br>
                                                                 {{ __('গাড়ীর মালিক/ড্রাইভারের তথ্য') }}

                                                                 <br>
                                                                 {{-- driver or provider  --}}
                                                                 {{ __('@changeLang('Provider Type')') }}:
                                                                 {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->provider_type : 'N/A') }}<br>
                                                                 {{ __('@changeLang('Company Name')') }}:
                                                                 {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->company_name : 'N/A') }}<br>
                                                                 {{ __('@changeLang('Company Address')') }}:
                                                                 {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->company_address : 'N/A') }}<br>
                                                                 {{ __('@changeLang('Nid No')') }}. :
                                                                 {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->nid_no : 'N/A') }}<br>
                                                                 {{ __('@changeLang('Driving Experience')') }}:
                                                                 {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->driving_experience : 'N/A') }}<br>
                                                                 {{ __('@changeLang('Address')') }}:
                                                                 {{ __($userDetails->where('user_id', $service->user_id)->first() ? $userDetails->where('user_id', $service->user_id)->first()->address : 'N/A') }}<br>

                                                             </p>

                                                         </div>
                                                     </div>

                                                     <div class="col-md-12 col-sm-12 col-lg-12">

                                                         <div class="row justify-content-between">
                                                             <div class="col-md-6 col-sm-6 col-lg-6">
                                                                 <p class="text-left font-weight-bold"
                                                                     style="color: black;">

                                                                 <h5> {{ __('@changeLang('Drivers/Owners Nid Back') ') }} :</h5> <br>
                                                                 @php
                                                                     $userDetail = $userDetails->where('user_id', $service->user_id)->first();
                                                                 @endphp
                                                                 @if ($userDetail && $userDetail->nid_back)
                                                                     <img src="{{ getFile('user_details', $userDetail->nid_back) }}"
                                                                         width="100%" height="auto"><br>
                                                                 @else
                                                                     <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                         width="100%" height="auto"><br>
                                                                 @endif

                                                                 <h5>{{ __('@changeLang('Driving License Back')') }} :</h5><br>
                                                                 @php
                                                                     $userDetail = $userDetails->where('user_id', $service->user_id)->first();
                                                                 @endphp
                                                                 @if ($userDetail && $userDetail->driving_license_back)
                                                                     <img src="{{ getFile('user_details', $userDetail->driving_license_back) }}"
                                                                         width="100%" height="auto"><br>
                                                                 @else
                                                                     <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                         width="100%" height="auto"><br>
                                                                 @endif
                                                             </div>
                                                             <div class="col-md-6 col-sm-6 col-lg-6">
                                                                 <p class="text-left font-weight-bold"
                                                                     style="color: black;">


                                                                 <h5>{{ __('@changeLang('Drivers/Owners Nid Front')') }} :</h5><br>
                                                                 @php
                                                                     $userDetail = $userDetails->where('user_id', $service->user_id)->first();
                                                                 @endphp
                                                                 @if ($userDetail && $userDetail->nid_front)
                                                                     <img src="{{ getFile('user_details', $userDetail->nid_front) }}"
                                                                         width="100%" height="auto"><br>
                                                                 @else
                                                                     <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                         width="100%" height="auto"><br>
                                                                 @endif

                                                                 {{-- driving license --}}
                                                                 <h5>{{ __('@changeLang('Driving License Front')') }} :</h5><br>
                                                                 @php
                                                                     $userDetail = $userDetails->where('user_id', $service->user_id)->first();
                                                                 @endphp
                                                                 @if ($userDetail && $userDetail->driving_license_front)
                                                                     <img src="{{ getFile('user_details', $userDetail->driving_license_front) }}"
                                                                         width="100%" height="auto"><br>
                                                                 @else
                                                                     <img src="{{ getFile('logo', $general->service_default_image) }}"
                                                                         width="100%" height="auto"><br>
                                                                 @endif

                                                                 </p>
                                                             </div>

                                                         </div>
                                                     </div>
                                                 @endif

                                                </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">@changeLang('Close')</button>
                                            </div>
                                    </div>
                                    </form>
                                </div>

                                <!-- Modal -->
                            @empty

                                <tr>

                                    <td class="text-center" colspan="100%">@changeLang('No Data Found')</td>

                                </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
                @if ($services->hasPages())
                    {{ $services->links('admin.partials.paginate') }}
                @endif
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">

            <form action="" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@changeLang('Delete Service')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <p>@changeLang('Are You sure to delete this service')?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@changeLang('Close')</button>
                        <button type="submit" class="btn btn-danger">@changeLang('Delete')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>



@endsection


@push('custom-script')
    <script>
        $(function() {
            'use strict'

            $('.delete').on('click', function() {
                const modal = $('#delete');

                modal.find('form').attr('action', $(this).data('href'));

                modal.modal('show');
            })

        })
    </script>
@endpush
