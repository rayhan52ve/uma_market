@extends('frontend.layout.frontend')
@push('custom-css')
    <link rel="stylesheet" href="{{ asset('frontend/css/user-style.css') }}">
@endpush
@section('breadcumb')
    @php

        $content = content('breadcrumb.content');

    @endphp
    <!--Banner Start-->
    <div class="container banner-area flex" style="background-image:url({{getFile('breadcrumb',@$content->data->image)}});">
        <div class="text-center">
            <div class="row">
                <div class="col-md-12">
                    <div class="banner-text">
                        <h2>@yield('customer-breadcumb')</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Banner End-->
@endsection

@section('content')
    @yield('customer-content')
@endsection



