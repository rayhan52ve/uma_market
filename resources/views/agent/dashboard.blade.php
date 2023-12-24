@extends('agent.layout.master')

@section('page_title', 'ড্যাশবোর্ড')

@section('agent_content')
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-xl-3 col-md-3" hidden>
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">@changeLang('Total Registration') 
                        <h1 class="">{{ $totalReg }}</h1>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">@changeLang('View Details')</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-3">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">@changeLang('Vendor')
                        <h1 class="">{{ $totalProvider }}</h1>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('agent-vendor.index') }}">@changeLang('View Details')</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-3">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">@changeLang('Customer')
                        <h1 class="">{{ $totalCustomer }}</h1>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('agent-customer.index') }}">@changeLang('View Details')</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-3">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">@changeLang('Running Order')
                        <h1 class="">{{ $totalRunningOrders }}</h1>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('agent.runningOrder') }}">@changeLang('View Details')</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-3">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">@changeLang('Confirm Order')
                        <h1 class="">{{ $totalConfirmedOrders }}</h1>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('agent.confirmOrder') }}">@changeLang('View Details')</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-xl-3 col-md-3">
                <div class="card bg-info text-white mb-4">
                    <div class="card-body">@changeLang('Cancel Order')
                        <h1 class="">{{ $totalCancelOrders }}</h1>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('agent.cancelOrder') }}">@changeLang('View Details')</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
