@extends('admin.layout.master')
@section('breadcrumb')
    <section class="section">
        <div class="section-header">

            <h1>@changeLang('All Services')</h1>



        </div>
    </section>
@endsection

@section('content')
    <div class="row">

        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">


                    {{-- <div class="card-header-form">
                        <form method="GET" action="{{route('admin.service.search')}}">
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
                                <th>@changeLang('Sl')</th>
                                <th>@changeLang('Name')</th>
                                <th>@changeLang('Status')</th>
                                <th>@changeLang('Action')</th>
                            </tr>
                            @forelse ($services as $key=>$service)
                                <tr>

                                    <td>{{ $key + $services->firstItem() }}</td>
                                    <td>{{ __($service->vehicle) }}</td>
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
                                        <button class="btn btn-info details" data-toggle="modal"
                                            data-target="#servicedetails{{ $service->id }}">@changeLang('Details')</button>
                                        @if ($service->admin_approval == 0)
                                            <button class="btn btn-primary accept"
                                                data-href="{{ route('admin.service.accept', $service) }}">@changeLang('Accept')</button>
                                            <button class="btn btn-danger reject"
                                                data-href="{{ route('admin.service.reject', $service) }}">@changeLang('Reject')</button>
                                        @endif

                                        {{-- <button class="btn btn-info userdata" data-service="{{ $service }}" data-duration="@switch($service->duration)
                                            @case(0)
                                                @changeLang('Hourly')
                                            @break
                                            @case(1)
                                                @changeLang('Daily')
                                            @break
                                            @case(2)
                                                @changeLang('Weekly')
                                            @break

                                            @case(3)
                                                @changeLang('Monthly')
                                            @break

                                            @case(4)
                                                @changeLang('Yearly')
                                            @break

                                            @default
                                             @changeLang('Fixed')

                                        @endswitch" data-review="{{number_format($service->reviews()->avg('review')) ?? 'Not Reviewed Yet'}}">@changeLang('Details')</button>

                                        <a target="_blank" href="{{route('admin.service.message',$service)}}" class="btn btn-primary">@changeLang('Reviews')</a> --}}



                                    </td>


                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="servicedetails{{ $service->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">

                                        <form action="" method="post">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">@changeLang('Vehicle Information')</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
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
                    </div><!-- Modal -->
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
    <div class="modal fade" id="accept" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">

            <form action="" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@changeLang('Accept Service')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <p>@changeLang('Are You sure to accept this service')?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@changeLang('Close')</button>
                        <button type="submit" class="btn btn-primary">@changeLang('Accept')</button>
                    </div>
                </div>
            </form>
        </div>
    </div><!-- Modal -->

    <div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">

            <form action="" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@changeLang('Reject Service')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">

                                <div class="form-group col-md-12">

                                    <label for="">@changeLang('Reason of Rejection')</label>
                                    <textarea name="reason_of_reject" id="" cols="30" rows="5" class="form-control"></textarea>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@changeLang('Close')</button>
                        <button type="submit" class="btn btn-danger">@changeLang('Reject')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@changeLang('Service Details')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-md-12">
                                <table class="user-data table table-bordered p-0">
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@changeLang('Close')</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('custom-script')
    <script>
        $(function() {
            'use strict'

            $('.accept').on('click', function() {
                const modal = $('#accept');

                modal.find('form').attr('action', $(this).data('href'));

                modal.modal('show');
            })
            $('.reject').on('click', function() {
                const modal = $('#reject');

                modal.find('form').attr('action', $(this).data('href'));

                modal.modal('show');
            })


            $('.userdata').on('click', function(e) {
                e.preventDefault();

                const modal = $('#confirm');

                let service = $(this).data('service');
                let review = $(this).data('review');
                let duration = $(this).data('duration');

                let html = `

                                    <tr>
                                        <td>@changeLang('Provider Name')</td>
                                        <td>${service.user.fname+' '+service.user.lname}</td>
                                    </tr>

                                    <tr>
                                        <td>@changeLang('Service Rate')</td>
                                        <td>{{ $general->currency_icon }} ${service.rate}</td>
                                    </tr>

                                     <tr>
                                        <td>@changeLang('Service Category')</td>
                                        <td> ${service.category.name}</td>
                                    </tr>

                                    <tr>
                                        <td>@changeLang('Service Duration')</td>
                                        <td>${duration}</td>
                                    </tr>

                                    <tr>
                                        <td>@changeLang('Service Location')</td>
                                        <td>${service.location}</td>
                                    </tr>

                                     <tr>
                                        <td>@changeLang('Service Rating')</td>
                                        <td>${review}</td>
                                    </tr>




                `;

                modal.find('.user-data').html(html);

                modal.modal('show');

            })

        })
    </script>
@endpush
