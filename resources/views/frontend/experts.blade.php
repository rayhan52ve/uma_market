@extends('frontend.layout.frontend')
@section('breadcumb')
    @php

        $content = content('breadcrumb.content');

    @endphp
    <!--Banner Start-->
    <div class="container banner-area flex"
        style="background-image:url({{ getFile('breadcrumb', @$content->data->image) }});">
        <div class="text-center">
            <div class="row">
                <div class="col-md-12">
                    <div class="banner-text">
                        <h2>@changeLang('Experts')</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Banner End-->
@endsection
@section('content')


    @push('seo')
        <meta name='description' content="{{ @$general->seo_description }}">
    @endpush

    <!--Service Start-->
    <div class="team-page pt_30 pb_60">
        <div class="container">

            @if (auth()->user())
                @if (auth()->user()->user_type == 1)
                    @if ($vehicle_id)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center">
                                    <a href="{{ route('user.trip-info.create-step-one') }}?vehicle_id={{ $vehicle_id }}"
                                        class="btn btn-theme custom-btn" style="margin-bottom:0 !important;">
                                        <h5 class="text-white">{{ $vehicle }} ভাড়া নিতে এখানে ক্লিক করুন <i
                                                class="far fa-hand-point-left"></i></h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            @else
                @if ($vehicle_id)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center">
                                <a href="{{ route('user.trip-info.create-step-one') }}?vehicle_id={{ $vehicle_id }}"
                                    class="btn btn-theme custom-btn">
                                    <h5 class="text-white" style="margin-bottom:0 !important;">{{ $vehicle }} ভাড়া নিতে
                                        এখানে ক্লিক করুন <i class="far fa-hand-point-left"></i></h5>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            @endif



            <div class="row justify-content-center">
                @forelse ($experts as $expert)
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="team-item">
                            <div class="team-photo">
                                <img src="@if ($expert->image) {{ getFile('user', $expert->image) }} @else {{ getFile('logo', $general->default_image) }} @endif"
                                    alt="Team Photo">
                            </div>
                            <div class="px-3 py-3">
                                <a href="{{ route('service.provider.details', $expert->slug) }}">
                                    <small>
                                        <table style="font-size: 10px">
                                            <tr>
                                                <td class="font-weight-bold">নাম</td>
                                                <td class="px-2">: </td>
                                                <td>{{ $expert->fname }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">প্রতিষ্ঠান</td>
                                                <td class="px-2">: </td>
                                                <td>{{ @$expert->userDetails->company_name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">ঠিকানা</td>
                                                <td class="px-2">: </td>
                                                <td>{{ @$expert->userDetails->company_address }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">অভিজ্ঞতা</td>
                                                <td class="px-2">: </td>
                                                <td>{{ @$expert->userDetails->driving_experience }}</td>
                                            </tr>
                                        </table>
                                    </small>
                                </a>
                                {{-- <a
                                    href="{{ route('service.provider.details', $expert->slug) }}">{{ __(ucwords($expert->fullname)) }}</a>
                                <p>{{ $expert->designation }}</p>
                                @php
                                    $rating = \App\Models\Review::whereIn('service_id',$expert->services()->pluck('id')->toArray())->avg('review');
                                @endphp

                                <p>

                                    @switch($rating)
                                        @case(1)
                                              <i class="fas fa-star text-warning"></i>
                                              <i class="far fa-star"></i>
                                              <i class="far fa-star"></i>
                                              <i class="far fa-star"></i>
                                              <i class="far fa-star"></i>

                                        @break
                                        @case(2)
                                              <i class="fas fa-star text-warning"></i>
                                              <i class="fas fa-star text-warning"></i>
                                              <i class="far fa-star"></i>
                                              <i class="far fa-star"></i>
                                              <i class="far fa-star"></i>

                                        @break

                                        @case(3)
                                              <i class="fas fa-star text-warning"></i>
                                              <i class="fas fa-star text-warning"></i>
                                              <i class="fas fa-star text-warning"></i>
                                              <i class="far fa-star"></i>
                                              <i class="far fa-star"></i>

                                        @break
                                        @case(4)
                                              <i class="fas fa-star text-warning"></i>
                                              <i class="fas fa-star text-warning"></i>
                                              <i class="fas fa-star text-warning"></i>
                                              <i class="fas fa-star text-warning"></i>
                                              <i class="far fa-star"></i>

                                        @break

                                        @case(5)
                                              <i class="fas fa-star text-warning"></i>
                                              <i class="fas fa-star text-warning"></i>
                                              <i class="fas fa-star text-warning"></i>
                                              <i class="fas fa-star text-warning"></i>
                                              <i class="fas fa-star text-warning"></i>

                                        @break


                                        @default
                                         <i class="far fa-star"></i>
                                         <i class="far fa-star"></i>
                                         <i class="far fa-star"></i>
                                         <i class="far fa-star"></i>
                                         <i class="far fa-star"></i>

                                    @endswitch




                                </p> --}}
                            </div>
                            @if ($expert->social)
                                <div class="team-social">
                                    <ul>
                                        @if ($expert->social->facebook)
                                            <li><a href="{{ $expert->social->facebook }}"><i
                                                        class="fab fa-facebook-f"></i></a></li>
                                        @endif
                                        @if ($expert->social->twitter)
                                            <li><a href="{{ $expert->social->twitter }}"><i class="fab fa-twitter"></i></a>
                                            </li>
                                        @endif
                                        @if ($expert->social->youtube)
                                            <li><a href="{{ $expert->social->youtube }}"><i class="fab fa-youtube"></i></a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty

                    <div class="col-12 col-md-6 col-sm-12 pt_30">
                        <div class="card">
                            <div class="card-body">
                                <div class="empty-state" data-height="400">
                                    <div class="empty-state-icon">
                                        <i class="far fa-sad-tear"></i>
                                    </div>
                                    <h2>@changeLang('Sorry We could not find any data')</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <!--Service End-->

@endsection


@push('custom-css')
    <style>
        .empty-state {
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 40px;
        }

        .empty-state .empty-state-icon {
            position: relative;
            background-color: #ca9520;
            width: 80px;
            height: 80px;
            line-height: 100px;
            border-radius: 5px;
        }

        .empty-state .empty-state-icon i {
            font-size: 40px;
            color: #fff;
            position: relative;
            z-index: 1;
        }

        .empty-state h2 {
            font-size: 20px;
            margin-top: 30px;
        }

        .empty-state p {
            font-size: 16px;
        }

        .custom-btn {
            box-shadow: rgba(0, 0, 0, 0.4) 0px 3px 8px;
        }

        .custom-btn:hover {
            box-shadow: rgba(0, 0, 0, 0.4) 0px 7px 20px 0px;
        }
    </style>
@endpush
