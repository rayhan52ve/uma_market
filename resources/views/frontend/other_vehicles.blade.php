@extends('frontend.layout.customer')
@section('customer-breadcumb', '')
@section('customer-content')
    <div class="case-study-home-page case-study-area pt_50 pb_20">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="case-item">
                        <div class="">
                            <div class="case-image">
                                <a href="{{ route('home.service', 'প্রাইভেট কার') }}" class="btn-case">
                                    <img src="{{ asset('frontend/images/car.jpg') }}" alt="">
                                </a>
                                <div class="overlay"><a href="{{ route('home.service', 'প্রাইভেট কার') }}"
                                        class="btn-case">ভাড়া করুন</a>
                                </div>
                            </div>
                            <div class="case-content">
                                <h5 class="font-weight-bold"><a href="{{ route('home.service', 'প্রাইভেট কার') }}">প্রাইভেট
                                        কার</a>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="case-item">
                        <div class="">
                            <div class="case-image">
                                <a href="{{ route('home.service', 'মাইক্রো') }}" class="btn-case">
                                    <img src="{{ asset('frontend/images/micro.jpg') }}" alt="">
                                </a>
                                <div class="overlay"><a href="{{ route('home.service', 'মাইক্রো') }}" class="btn-case">ভাড়া
                                        করুন</a>
                                </div>
                            </div>
                            <div class="case-content">
                                <h5 class="font-weight-bold"><a href="{{ route('home.service', 'মাইক্রো') }}">মাইক্রো</a>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12">
                    <div class="case-item">
                        <div class="">
                            <div class="case-image">
                                <a href="{{ route('home.service', 'এম্বুল্যান্স') }}" class="btn-case">
                                    <img src="{{ asset('frontend/images/ambulance.jpg') }}" alt="">
                                </a>
                                <div class="overlay"><a href="{{ route('home.service', 'এম্বুল্যান্স') }}"
                                        class="btn-case">ভাড়া করুন</a>
                                </div>
                            </div>
                            <div class="case-content">
                                <h5 class="font-weight-bold"><a
                                        href="{{ route('home.service', 'এম্বুল্যান্স') }}">এম্বুল্যান্স</a></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="case-item">
                        <div class="">
                            <div class="case-image">
                                <a href="{{ route('home.service', 'মোটরসাইকেল') }}" class="btn-case">
                                    <img src="{{ asset('frontend/images/bike.jpg') }}" alt="">
                                </a>
                                <div class="overlay"><a href="{{ route('home.service', 'মোটরসাইকেল') }}"
                                        class="btn-case">ভাড়া করুন</a>
                                </div>
                            </div>
                            <div class="case-content">
                                <h5 class="font-weight-bold"><a
                                        href="{{ route('home.service', 'মোটরসাইকেল') }}">মোটরসাইকেল</a></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="case-item">
                        <div class="">
                            <div class="case-image">
                                <a href="{{ route('home.service', 'বাস') }}" class="btn-case">
                                    <img src="{{ asset('frontend/images/bus.jpg') }}" alt="">
                                </a>
                                <div class="overlay"><a href="{{ route('home.service', 'বাস') }}" class="btn-case">ভাড়া
                                        করুন</a>
                                </div>
                            </div>
                            <div class="case-content">
                                <h5 class="font-weight-bold"><a href="{{ route('home.service', 'বাস') }}">বাস</a></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="case-item">
                        <div class="">
                            <div class="case-image">
                                <a href="{{ route('home.service', 'মাহিন্দ্রা') }}" class="btn-case">
                                    <img src="{{ asset('frontend/images/mahindra.jpg') }}" alt="">
                                </a>
                                <div class="overlay"><a href="{{ route('home.service', 'মাহিন্দ্রা') }}"
                                        class="btn-case">ভাড়া করুন</a>
                                </div>
                            </div>
                            <div class="case-content">
                                <h5 class="font-weight-bold"><a
                                        href="{{ route('home.service', 'মাহিন্দ্রা') }}">মাহিন্দ্রা</a></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="case-item">
                        <div class="">
                            <div class="case-image">
                                <a href="{{ route('home.service', 'সিএনজি') }}" class="btn-case">
                                    <img src="{{ asset('frontend/images/cng.png') }}" alt="">
                                </a>
                                <div class="overlay"><a href="{{ route('home.service', 'সিএনজি') }}" class="btn-case">ভাড়া
                                        করুন</a>
                                </div>
                            </div>
                            <div class="case-content">
                                <h5 class="font-weight-bold"><a href="{{ route('home.service', 'সিএনজি') }}">সিএনজি</a>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6  col-12">
                    <div class="case-item">
                        <div class="">
                            <div class="case-image">
                                <a href="{{ route('home.service', 'ইজিবাইক') }}" class="btn-case">
                                    <img src="{{ asset('frontend/images/easybike.jpeg') }}" alt="">
                                </a>
                                <div class="overlay"><a href="{{ route('home.service', 'ইজিবাইক') }}"
                                        class="btn-case">ভাড়া
                                        করুন</a>
                                </div>
                            </div>
                            <div class="case-content">
                                <h5 class="font-weight-bold"><a href="{{ route('home.service', 'ইজিবাইক') }}">ইজিবাইক</a>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="case-item">
                        <div class="">
                            <div class="case-image">
                                <a href="{{ route('home.service', 'ভ্যান') }}" class="btn-case">
                                    <img src="{{ asset('frontend/images/van.webp') }}" alt="">
                                </a>
                                <div class="overlay"><a href="{{ route('home.service', 'ভ্যান') }}"
                                        class="btn-case">ভাড়া করুন</a>
                                </div>
                            </div>
                            <div class="case-content">
                                <h5 class="font-weight-bold"><a href="{{ route('home.service', 'ভ্যান') }}">ভ্যান</a>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
