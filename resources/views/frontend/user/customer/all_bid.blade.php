@extends('frontend.layout.customer')
@section('customer-breadcumb', 'বিডিং দেখুন')
@section('customer-content')
    <div class="case-study-home-page case-study-area pt_50 pb_20">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-6">
                    <div class="case-item">
                        <a href="{{route('user.seeBidding',1)}}">
                            <div class="">
                                <div class="case-image">
                                    <img src="{{ asset('frontend/images/truck.jpg') }}" alt="">
                                    <div class="overlay"><a href="" class="btn-case">@changeLang('See Details')</a>
                                    </div>
                                </div>
                                <div class="case-content">
                                    <h5 class="font-weight-bold"><a href="{{route('user.seeBidding',1)}}">বিডিং সংখ্যা : {{ $truck }} টি</a>
                                    </h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="case-item">
                        <a href="{{route('user.seeBidding',2)}}">
                            <div class="">
                                <div class="case-image">
                                    <img src="{{ asset('frontend/images/car.jpg') }}" alt="">
                                    <div class="overlay"><a href="" class="btn-case">@changeLang('See Details')</a>
                                    </div>
                                </div>
                                <div class="case-content">
                                    <h5 class="font-weight-bold"><a href="{{route('user.seeBidding',2)}}">বিডিং সংখ্যা : {{ $car }} টি</a>
                                    </h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="case-item">
                        <a href="{{route('user.seeBidding',3)}}">
                            <div class="">
                                <div class="case-image">
                                    <img src="{{ asset('frontend/images/micro.jpg') }}" alt="">
                                    <div class="overlay"><a href="" class="btn-case">@changeLang('See Details')</a>
                                    </div>
                                </div>
                                <div class="case-content">
                                    <h5 class="font-weight-bold"><a href="{{route('user.seeBidding',3)}}">বিডিং সংখ্যা : {{ $micro }} টি</a>
                                    </h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-6">
                    <div class="case-item">
                        <a href="{{route('user.seeBidding',4)}}">
                            <div class="">
                                <div class="case-image">
                                    <img src="{{ asset('frontend/images/ambulance.jpg') }}" alt="">
                                    <div class="overlay"><a href="}" class="btn-case">@changeLang('See Details')</a>
                                    </div>
                                </div>
                                <div class="case-content">
                                    <h5 class="font-weight-bold"><a href="{{route('user.seeBidding',4)}}">বিডিং সংখ্যা : {{ $ambulance }} টি</a>
                                    </h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="case-item">
                        <a href="{{route('user.seeBidding',5)}}">
                            <div class="">
                                <div class="case-image">
                                    <img src="{{ asset('frontend/images/bike.jpg') }}" alt="">
                                    <div class="overlay"><a href="" class="btn-case">@changeLang('See Details')</a>
                                    </div>
                                </div>
                                <div class="case-content">
                                    <h5 class="font-weight-bold"><a href="{{route('user.seeBidding',5)}}">বিডিং সংখ্যা : {{ $motorcycle }} টি</a>
                                    </h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="case-item">
                        <a href="{{route('user.seeBidding',10)}}">
                            <div class="">
                                <div class="case-image">
                                    <img src="{{ asset('frontend/images/bus.jpg') }}" alt="">
                                    <div class="overlay"><a href="" class="btn-case">@changeLang('See Details')</a>
                                    </div>
                                </div>
                                <div class="case-content">
                                    <h5 class="font-weight-bold"><a href="{{route('user.seeBidding',10)}}">বিডিং সংখ্যা : {{ $bus }}
                                            টি</a>
                                    </h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="case-item">
                        <a href="{{route('user.seeBidding',8)}}">
                            <div class="">
                                <div class="case-image">
                                    <img src="{{ asset('frontend/images/mahindra.jpg') }}" alt="">
                                    <div class="overlay"><a href="{{route('user.seeBidding',1)}}" class="btn-case">@changeLang('See Details')</a>
                                    </div>
                                </div>
                                <div class="case-content">
                                    <h5 class="font-weight-bold"><a href="{{route('user.seeBidding',8)}}">বিডিং সংখ্যা : {{ $mahindra }}
                                            টি</a>
                                    </h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="case-item">
                        <a href="{{route('user.seeBidding',6)}}">
                            <div class="">
                                <div class="case-image">
                                    <img src="{{ asset('frontend/images/cng.png') }}" alt="">
                                    <div class="overlay"><a href="" class="btn-case">@changeLang('See Details')</a>
                                    </div>
                                </div>
                                <div class="case-content">
                                    <h5 class="font-weight-bold"><a href="{{route('user.seeBidding',6)}}">বিডিং সংখ্যা : {{ $cng }}
                                            টি</a>
                                    </h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="case-item">
                        <a href="{{route('user.seeBidding',9)}}">
                            <div class="">
                                <div class="case-image">
                                    <img src="{{ asset('frontend/images/easybike.jpeg') }}" alt="">
                                    <div class="overlay"><a href="" class="btn-case">@changeLang('See Details')</a>
                                    </div>
                                </div>
                                <div class="case-content">
                                    <h5 class="font-weight-bold"><a href="{{route('user.seeBidding',9)}}">বিডিং সংখ্যা : {{ $easy_bike }}
                                            টি</a>
                                    </h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="case-item">
                        <a href="{{route('user.seeBidding',7)}}">
                            <div class="">
                                <div class="case-image">
                                    <img src="{{ asset('frontend/images/van.webp') }}" alt="">
                                    <div class="overlay"><a href="" class="btn-case">@changeLang('See Details')</a>
                                    </div>
                                </div>
                                <div class="case-content">
                                    <h5 class="font-weight-bold"><a href="{{route('user.seeBidding',7)}}">বিডিং সংখ্যা : {{ $van }}
                                            টি</a>
                                    </h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
