@php
    if (request()->routeIs('pages')) {
        $experts = App\Models\User::with('userDetails')
            ->whereHas('services', function ($q) {
                $q->where('status', 1);
            })
            ->latest()
            ->paginate();
    } else {
        $content = content('team.content');

        $featureds = App\Models\User::with('userDetails')
            ->whereHas('services', function ($q) {
                $q->where('status', 1);
            })
            ->where('featured', 1)
            ->get();
    }

@endphp

@if (request()->routeIs('pages'))

    <!--Service Start-->
    <div class="team-page pb_60">
        <div class="container">
            <div class="row justify-content-center">
                @forelse ($experts as $expert)
                    <div class="col-lg-4 col-md-4 col-12 mt_30">
                        <div class="team-item">
                            <div class="team-photo">
                                <img src="@if ($expert->image) {{ getFile('user', $expert->image) }} @else {{ getFile('logo', $general->default_image) }} @endif"
                                    alt="Team Photo">
                            </div>
                            <div class="px-3 py-3">
                                <a href="{{ route('service.provider.details', $expert) }}">
                                    <small>
                                        <table>
                                            <tr>
                                                <td class="font-weight-bold" style="color: black">
                                                    <h5>নাম</h5>
                                                </td>
                                                <td class="px-2" style="color: black">
                                                    <h5>:</h5>
                                                </td>
                                                <td><h5>{{ $expert->fname }}</h5></td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold" style="color: black">
                                                    <h5>প্রতিষ্ঠান</h5>
                                                </td>
                                                <td class="px-2" style="color: black">
                                                    <h5>:</h5>
                                                </td>
                                                <td><h5>{{ @$expert->userDetails->company_name }}</h5></td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold" style="color: black">
                                                    <h5>ঠিকানা</h5>
                                                </td>
                                                <td class="px-2" style="color: black">
                                                    <h5>:</h5>
                                                </td>
                                                <td><h5>{{ @$expert->userDetails->company_address }}</h5></td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold" style="color: black">
                                                    <h5>অভিজ্ঞতা</h5>
                                                </td>
                                                <td class="px-2" style="color: black">
                                                    <h5>:</h5>
                                                </td>
                                                <td><h5>{{ @$expert->userDetails->driving_experience }}</h5></td>
                                            </tr>
                                        </table>
                                    </small>
                                </a>
                            </div>
                            @if ($expert->social)
                                <div class="team-social">
                                    <ul>
                                        @if ($expert->social->facebook)
                                            <li><a href="{{ $expert->social->facebook }}"><i
                                                        class="fab fa-facebook-f"></i></a></li>
                                        @endif
                                        @if ($expert->social->twitter)
                                            <li><a href="{{ $expert->social->twitter }}"><i
                                                        class="fab fa-twitter"></i></a></li>
                                        @endif
                                        @if ($expert->social->youtube)
                                            <li><a href="{{ $expert->social->youtube }}"><i
                                                        class="fab fa-youtube"></i></a></li>
                                        @endif
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty

                    <div class="col-12 col-md-6 col-sm-12">
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
@else
    @if (count($featureds) > 0)
        <!--Team Area Start-->
        <div class="team-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-headline text-center">
                            <h2 class="font-weight-bold" style="color: black">{{ __(@$content->data->title) }}</h2>
                            {{-- <p>{{ __(@$content->data->sub_title)  style="color: black"}}</p> --}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-3">
                        <div class="team-carousel owl-carousel d-flex justify-content-center">
                            @forelse ($featureds as $feature)
                                <div class="team-item">
                                    <div class="team-photo">
                                        <img
                                            src="@if ($feature->image) {{ getFile('user', $feature->image) }} @else {{ getFile('logo', $general->default_image) }} @endif">
                                    </div>
                                    <div class="px-3 py-3">
                                        <a href="{{ route('service.provider.details', $feature) }}">
                                            <small>
                                                <table>
                                                    <tr>
                                                        <td class="font-weight-bold" style="color: black">
                                                            <h5>নাম</h5>
                                                        </td>
                                                        <td class="px-2" style="color: black">
                                                            <h5>:</h5>
                                                        </td>
                                                        <td>
                                                            <h5>{{ $feature->fname }}</h5>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold" style="color: black">
                                                            <h5>প্রতিষ্ঠান</h5>
                                                        </td>
                                                        <td class="px-2" style="color: black">
                                                            <h5>:</h5>
                                                        </td>
                                                        <td>
                                                            <h5>{{ @$feature->userDetails->company_name }}</h5>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold" style="color: black">
                                                            <h5>ঠিকানা</h5>
                                                        </td>
                                                        <td class="px-2" style="color: black">
                                                            <h5>:</h5>
                                                        </td>
                                                        <td><h5>{{ @$feature->userDetails->company_address }}</h5></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold" style="color: black">
                                                            <h5>অভিজ্ঞতা</h5>
                                                        </td>
                                                        <td class="px-2" style="color: black">
                                                            <h5>:</h5>
                                                        </td>
                                                        <td><h5>{{ @$feature->userDetails->driving_experience }}</h5></td>
                                                    </tr>
                                                </table>
                                            </small>
                                        </a>
                                    </div>
                                    @if ($feature->social)
                                        <div class="team-social">
                                            <ul>
                                                @if ($feature->social->facebook)
                                                    <li><a href="{{ $feature->social->facebook }}"><i
                                                                class="fab fa-facebook-f"></i></a></li>
                                                @endif
                                                @if ($feature->social->twitter)
                                                    <li><a href="{{ $feature->social->twitter }}"><i
                                                                class="fab fa-twitter"></i></a></li>
                                                @endif
                                                @if ($feature->social->youtube)
                                                    <li><a href="{{ $feature->social->youtube }}"><i
                                                                class="fab fa-youtube"></i></a></li>
                                                @endif
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            @empty
                            @endforelse

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Team Area End-->
    @endif
@endif


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
    </style>
@endpush
