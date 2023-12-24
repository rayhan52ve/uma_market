@extends('employee.layout.master')

@section('page_title','ড্যাশবোর্ড')

@section('employee_content')



    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-xl-3 col-md-3">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">@changeLang('Total Registration')
                        <h1 class="">{{$totalReg}}</h1>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{route('employee.totalReg')}}">@changeLang('View Details')</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-3">
                <div class="card bg-secondary text-white mb-4">
                    <div class="card-body">@changeLang('Todays Registration')
                        <h1 class="">{{$todaysReg}}</h1>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{route('employee.todaysReg')}}">@changeLang('View Details')</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-3">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">@changeLang('Vendor')
                        <h1 class="">{{$totalVendor}}</h1>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{route('vendor.index')}}">@changeLang('View Details')</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-3">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">@changeLang('Customer')
                        <h1 class="">{{$totalCustomer}}</h1>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{route('employee-customer.index')}}">@changeLang('View Details')</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-3">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">@changeLang('Running Order')
                        <h1 class="">{{$totalRunningOrder}}</h1>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{route('employee.runningOrder')}}">@changeLang('View Details')</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        
            <div class="col-xl-3 col-md-3">
                <div class="card bg-dark text-white mb-4">
                    <div class="card-body">@changeLang('Confirm Order')
                        <h1 class="">{{$totalConfirmOrder}}</h1>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{route('employee.confirmOrder')}}">@changeLang('View Details')</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-3">
                <div class="card bg-info text-white mb-4">
                    <div class="card-body">@changeLang('Cancel Order')
                        <h1 class="">{{$totalCanceledOrder}}</h1>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{route('employee.cancelOrder')}}">@changeLang('View Details')</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
