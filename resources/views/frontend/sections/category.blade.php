<style>
    @media only screen and (max-width: 850px) {
        .desktop {
            display: none;
        }
        .mobile {
            display: block;
        }

    }

    @media only screen and (min-width: 850px) {
        .desktop {
            display: block;
        }
        .mobile {
            display: none;
        }
    }

</style>
@php

    $content = content('category.content');

    $categories = App\Models\Category::whereHas('services', function ($q) {
        $q->where('status', 1);
    })
        ->whereHas('services.user')
        ->where('status', 1)
        ->latest()
        ->take(6)
        ->get();

@endphp
<!--Portfolio Start-->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="home-button banner">
                <img class="desktop" src="{{ asset($desktopbanner) }}" alt="">
                <img class="mobile" width="100%" src="{{ asset($mobilebanner) }}" alt="">
            </div>
        </div>
    </div>
</div>

<div class="case-study-home-page case-study-area pt_70 pb_20">
    <div class="container">
        <div class="row mb_25">
            <div class="col-md-12 wow fadeInDown" data-wow-delay="0.1s">
                <div class="main-headline text-center">
                    <h2 class="font-weight-bold">সকল যানবাহন সেবাসমূহ</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-12">
                <div class="case-item">
                    <div class="">
                        <div class="case-image">
                            <a href="{{ route('home.service', 'ট্রাক') }}">
                                <img src="{{ asset('frontend/images/truck.jpg') }}" alt="">
                            </a>
                            <div class="overlay"><a href="{{ route('home.service', 'ট্রাক') }}"
                                    class="btn-case">@changeLang('See Details')</a>
                            </div>
                        </div>
                        <div class="case-content">
                            <h4 class="font-weight-bold"><a href="{{ route('home.service', 'ট্রাক') }}">ট্রাক ভাড়া</a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="case-item">
                    <div class="">
                        <div class="case-image">
                            <a href="{{ route('home.service', 'প্রাইভেট কার') }}">
                                <img src="{{ asset('frontend/images/car.jpg') }}" alt="">
                            </a>
                            <div class="overlay"><a href="{{ route('home.service', 'প্রাইভেট কার') }}"
                                    class="btn-case">@changeLang('See Details')</a>
                            </div>
                        </div>
                        <div class="case-content">
                            <h4 class="font-weight-bold"><a href="{{ route('home.service', 'প্রাইভেট কার') }}">প্রাইভেট
                                    কার ভাড়া</a></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="case-item">
                    <div class="">
                        <div class="case-image">
                            <a href="{{ route('home.service', 'মাইক্রো') }}">
                                <img src="{{ asset('frontend/images/micro.jpg') }}" alt="">
                            </a>
                            <div class="overlay"><a href="{{ route('home.service', 'মাইক্রো') }}"
                                    class="btn-case">@changeLang('See Details')</a>
                            </div>
                        </div>
                        <div class="case-content">
                            <h4 class="font-weight-bold"><a href="{{ route('home.service', 'মাইক্রো') }}">মাইক্রো
                                    ভাড়া</a></h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-12">
                <div class="case-item">
                    <div class="">
                        <div class="case-image">
                            <a href="{{ route('home.service', 'এম্বুল্যান্স') }}">
                                <img src="{{ asset('frontend/images/ambulance.jpg') }}" alt="">
                            </a>
                            <div class="overlay"><a href="{{ route('home.service', 'এম্বুল্যান্স') }}"
                                    class="btn-case">@changeLang('See Details')</a>
                            </div>
                        </div>
                        <div class="case-content">
                            <h4 class="font-weight-bold"><a
                                    href="{{ route('home.service', 'এম্বুল্যান্স') }}">এম্বুল্যান্স ভাড়া</a></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="case-item">
                    <div class="">
                        <div class="case-image">
                            <a href="{{ route('home.service', 'মোটরসাইকেল') }}">
                                <img src="{{ asset('frontend/images/bike.jpg') }}" alt="">
                            </a>
                            <div class="overlay"><a href="{{ route('home.service', 'মোটরসাইকেল') }}"
                                    class="btn-case">@changeLang('See Details')</a>
                            </div>
                        </div>
                        <div class="case-content">
                            <h4 class="font-weight-bold"><a href="{{ route('home.service', 'মোটরসাইকেল') }}">মোটরসাইকেল
                                    ভাড়া</a></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="case-item">
                    <div class="">
                        <div class="case-image">
                            <a href="{{ route('home.service', 'অন্যান্য যানবাহন ভাড়া') }}">
                                <img src="{{ asset('frontend/images/other_vehicle.jpg') }}" alt="">
                            </a>
                            <div class="overlay"><a href="{{ route('home.service', 'অন্যান্য যানবাহন ভাড়া') }}"
                                    class="btn-case">@changeLang('See Details')</a>
                            </div>
                        </div>
                        <div class="case-content">
                            <h4 class="font-weight-bold"><a
                                    href="{{ route('home.service', 'অন্যান্য যানবাহন ভাড়া') }}">অন্যান্য
                                    যানবাহন ভাড়া</a></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="row mb_60">
            <div class="col-md-12">
                <div class="home-button">
                    <a href="{{route('category.all')}}">{{changeDynamic(@$content->data->button_text)}}</a>
                </div>
            </div>
        </div> --}}
    </div>
</div>

<div class="case-study-home-page case-study-area pt_70 pb_20">
    <div class="container">
        <div class="row mb_25">
            <div class="col-md-12 wow fadeInDown" data-wow-delay="0.1s">
                <div class="main-headline text-center">
                    <h2 class="font-weight-bold">নিত্যপ্রয়োজনীয় জিনিসপত্রসমূহ</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-12">
                <div class="case-item">
                    <div class="">
                        <div class="case-image">
                            <a href="{{route('upcoming')}}">
                            <img src="{{ asset('frontend/images/daily_needs.jpg') }}" alt="">
                            </a>
                            <div class="overlay"><a href="{{route('upcoming')}}" class="btn-case">@changeLang('See Details')</a>
                            </div>
                        </div>
                        <div class="case-content">
                            <h4 class="font-weight-bold"><a href="{{route('upcoming')}}">দৈনন্দিন বাজারসমূহ</a></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="case-item">
                    <div class="">
                        <div class="case-image">
                            <a href="{{route('upcoming')}}">
                            <img src="{{ asset('frontend/images/life_style.jpg') }}" alt="">
                            </a>
                            <div class="overlay"><a href="{{route('upcoming')}}" class="btn-case">@changeLang('See Details')</a>
                            </div>
                        </div>
                        <div class="case-content">
                            <h4 class="font-weight-bold"><a href="{{route('upcoming')}}">লাইফ স্টাইল</a></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="case-item">
                    <div class="">
                        <div class="case-image">
                            <a href="{{route('upcoming')}}">
                            <img src="{{ asset('frontend/images/paikari.jpg') }}" alt="">
                            </a>
                            <div class="overlay"><a href="{{route('upcoming')}}" class="btn-case">@changeLang('See Details')</a>
                            </div>
                        </div>
                        <div class="case-content">
                            <h4 class="font-weight-bold"><a href="{{route('upcoming')}}">পাইকারী বাজার</a></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="home-button">
                <img src="{{ asset('frontend/images/banner-1.webp') }}" alt="">
            </div>
        </div>
    </div>
</div> --}}
<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 ">
            <div class="home-button banner">
                <img class="desktop" src="{{ asset($desktopbanner2) }}" alt="">
                <img class="mobile" width="100%" src="{{ asset($mobilebanner2) }}" alt="">
            </div>
        </div>
    </div>
</div>

<div class="case-study-home-page case-study-area pt_70 pb_20">
    <div class="container">
        <div class="row mb_25">
            <div class="col-md-12 wow fadeInDown" data-wow-delay="0.1s">
                <div class="main-headline text-center">
                    <h2 class="font-weight-bold">স্বাস্থ্য সেবাসমূহ</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-12">
                <div class="case-item">
                    <div class="">
                        <div class="case-image">
                            <a href="{{route('upcoming')}}">
                            <img src="{{ asset('frontend/images/pharmacy.jpg') }}" alt="">
                            </a>
                            <div class="overlay"><a href="{{route('upcoming')}}" class="btn-case">@changeLang('See Details')</a>
                            </div>
                        </div>
                        <div class="case-content">
                            <h4 class="font-weight-bold"><a href="{{route('upcoming')}}">ফার্মেসী</a></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="case-item">
                    <div class="">
                        <div class="case-image">
                            <a href="{{route('upcoming')}}">
                            <img src="{{ asset('frontend/images/doctor.jpg') }}" alt="">
                            </a>
                            <div class="overlay"><a href="{{route('upcoming')}}" class="btn-case">@changeLang('See Details')</a>
                            </div>
                        </div>
                        <div class="case-content">
                            <h4 class="font-weight-bold"><a href="{{route('upcoming')}}">ডক্টর</a></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="case-item">
                    <div class="">
                        <div class="case-image">
                            <a href="{{route('upcoming')}}">
                            <img src="{{ asset('frontend/images/diagnostic.jpg') }}" alt="">
                            </a>
                            <div class="overlay"><a href="{{route('upcoming')}}" class="btn-case">@changeLang('See Details')</a>
                            </div>
                        </div>
                        <div class="case-content">
                            <h4 class="font-weight-bold"><a href="{{route('upcoming')}}">ডায়াগনস্টিক সেন্টার</a></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="case-study-home-page case-study-area pt_70 pb_20">
    <div class="container">
        <div class="row mb_25">
            <div class="col-md-12 wow fadeInDown" data-wow-delay="0.1s">
                <div class="main-headline text-center">
                    <h2 class="font-weight-bold">রেন্ট সেবাসমূহ</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-12">
                <div class="case-item">
                    <div class="">
                        <div class="case-image">
                            <a href="{{route('upcoming')}}">
                            <img src="{{ asset('frontend/images/home_rent.jpg') }}" alt="">
                            </a>
                            <div class="overlay"><a href="{{route('upcoming')}}" class="btn-case">@changeLang('See Details')</a>
                            </div>
                        </div>
                        <div class="case-content">
                            <h4 class="font-weight-bold"><a href="{{route('upcoming')}}">হোম রেন্ট</a></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="case-item">
                    <div class="">
                        <div class="case-image">
                            <a href="{{route('upcoming')}}">
                            <img src="{{ asset('frontend/images/hotel_rent.jpg') }}" alt="">
                            </a>
                            <div class="overlay"><a href="{{route('upcoming')}}" class="btn-case">@changeLang('See Details')</a>
                            </div>
                        </div>
                        <div class="case-content">
                            <h4 class="font-weight-bold"><a href="{{route('upcoming')}}">হোটেল রেন্ট</a></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="case-item">
                    <div class="">
                        <div class="case-image">
                            <a href="{{route('upcoming')}}">
                            <img src="{{ asset('frontend/images/human_rent.jpg') }}" alt="">
                            </a>
                            <div class="overlay"><a href="{{route('upcoming')}}" class="btn-case">@changeLang('See Details')</a>
                            </div>
                        </div>
                        <div class="case-content">
                            <h4 class="font-weight-bold"><a href="{{route('upcoming')}}">হিউম্যান রেন্ট</a></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="case-study-home-page case-study-area pt_70 pb_20">
    <div class="container">
        <div class="row mb_25">
            <div class="col-md-12 wow fadeInDown" data-wow-delay="0.1s">
                <div class="main-headline text-center">
                    <h2 class="font-weight-bold">প্রয়োজনীয় সেবাসমূহ</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-12">
                <div class="case-item">
                    <div class="">
                        <div class="case-image">
                            <a href="{{route('upcoming')}}">
                            <img src="{{ asset('frontend/images/electrician.jpg') }}" alt="">
                            </a>
                            <div class="overlay"><a href="{{route('upcoming')}}" class="btn-case">@changeLang('See Details')</a>
                            </div>
                        </div>
                        <div class="case-content">
                            <h4 class="font-weight-bold"><a href="{{route('upcoming')}}">ইলেকট্রিশিয়ান</a></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="case-item">
                    <div class="">
                        <div class="case-image">
                            <a href="{{route('upcoming')}}">
                            <img src="{{ asset('frontend/images/ac.jpg') }}" alt="">
                            </a>
                            <div class="overlay"><a href="{{route('upcoming')}}" class="btn-case">@changeLang('See Details')</a>
                            </div>
                        </div>
                        <div class="case-content">
                            <h4 class="font-weight-bold"><a href="{{route('upcoming')}}">এসি সার্ভিসিং</a></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="case-item">
                    <div class="">
                        <div class="case-image">
                            <a href="{{route('upcoming')}}">
                            <img src="{{ asset('frontend/images/other_services.jpeg') }}" alt="">
                            </a>
                            <div class="overlay"><a href="{{route('upcoming')}}" class="btn-case">@changeLang('See Details')</a>
                            </div>
                        </div>
                        <div class="case-content">
                            <h4 class="font-weight-bold"><a href="{{route('upcoming')}}">অন্যান্য সেবা সমূহ</a></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
