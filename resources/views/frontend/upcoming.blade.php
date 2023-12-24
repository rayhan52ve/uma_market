@extends('frontend.layout.customer')
@section('customer-breadcumb', 'Coming Soon')
@section('customer-content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="card" style="width: 100rem;">
                <div class="d-flex justify-content-center">
                    <h3 class="text-center">
                        Service Coming Soon. Thank you for staying with us.
                    </h3>
                    <div class="cd100"></div>
                </div>
                <div class="card-body">
                    <img class="card-img-top" src="{{ asset('frontend/upcoming/upcoming.png') }}" alt="Card image cap">
                </div>
            </div>
        </div>
    </div>
@endsection
