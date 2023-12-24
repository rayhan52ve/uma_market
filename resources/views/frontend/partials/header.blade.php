<!--Header-Area Start-->
<div class="header-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-12 d-none d-sm-block">
                <div class="header-social">
                    <ul>
                        <li>
                            <div class="social-bar">
                                <ul>
                                    @if ($socials)
                                        @foreach ($socials as $social)
                                            <li><a href="{{ @$social->data->social_link }}"><i
                                                        class="{{ @$social->data->social_icon }}"></i></a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-12">
                <div class="header-info">
                    <ul>
                        <li>
                            <i class="far fa-envelope"></i>
                            <span>{{ @$general->email_from }}</span>
                            @if ($contact)
                                <span class="px-3 horizontal-separator"> </span>
                                <i class="fas fa-phone"></i> <span>{{ $contact->data->phone }}</span>
                            @endif
                        </li>
                        @auth
                            <li>
                                <i class="fas fa-lock"></i>
                                <a href="{{ route('user.dashboard') }}">@changeLang('Dashboard')</a>
                            </li>
                        @else
                            <li id="notLoggedIn">
                                <i class="fas fa-lock"></i>
                                <a href="#" type="button" data-toggle="modal"
                                    data-target="#loginModal">@changeLang('Login')</a> / <a href="#" type="button"
                                    data-toggle="modal" data-target="#registerModal">@changeLang('Register')</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Header-Area End-->

<!--Menu Start-->
<div id="strickymenu" class="menu-area d-flex">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-6">
                <div class="logo flex">
                    <a href="{{ route('home') }}"><img src="{{asset('agentss/assets/images/umalogo.png')}}" alt="Logo"></a>
                </div>
            </div>
            <div class="col-md-9 col-6 ">
                <div class="main-menu">
                    <ul class="nav-menu">

                        {{-- @foreach ($pages as $page)
                                @if ($page->name == 'home')
                                    <li><a href="{{ route('home') }}">{{ ucwords($page->name)}}</a>
                                    </li>
                                    @continue
                                @endif
                                <li><a href="{{ route('pages', $page->slug) }}">{{ ucwords($page->name) }}</a></li>
                            @endforeach --}}

                        <li><a href="{{ route('pages', 'experts') }}">@changeLang('Experts')</a></li>
                        <li><a href="{{ route('pages', 'about-us') }}">@changeLang('About Us')</a></li>
                        <li><a href="{{ route('pages', 'blog') }}">@changeLang('Blog')</a></li>
                        <li><a href="{{ route('pages', 'faq') }}">@changeLang('FAQ')</a></li>
                        <li><a href="{{ route('pages', 'contact-us') }}">@changeLang('Contact Us')</a></li>

                        @if ($dropdown->isNotEmpty())
                            <li class="menu-item-has-children"><a href="javascript:void(0)">@changeLang('Pages')</a>
                                <ul class="sub-menu">
                                    @foreach ($dropdown as $drop)
                                        <li><a href="{{ route('pages', $drop->slug) }}">{{ ucwords($drop->name) }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @auth
        @if (auth()->user()->user_type == 1)
            <div class="sidebar-panel">
                @include('frontend.partials.customer_sidebar')
            </div>
        @endif
    @endauth
</div>

<!--Mobile Menu Start-->
<div class="mobile-menu">
    <div id="mySidenav" class="sidenav">
        <a href="{{ route('home') }}"><img src="{{ getFile('logo', @$general->logo) }}" alt=""></a>
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

        <ul>
            @foreach ($pages as $page)
                @if ($page->name == 'home')
                    <li><a href="{{ route('home') }}">{{ ucwords($page->name) }}</a>
                    </li>
                    @continue
                @endif
                <li><a href="{{ route('pages', $page->slug) }}">{{ ucwords($page->name) }}</a>
                </li>
            @endforeach


            @if ($dropdown->isNotEmpty())
                <li class="menu-item-has-children"><a href="javascript:void(0)">@changeLang('Pages')</a>
                    <ul class="sub-menu">
                        @foreach ($dropdown as $drop)
                            <li><a href="{{ route('pages', $drop->slug) }}">{{ ucwords($drop->name) }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif
            @auth
                <li><a href="{{ route('user.dashboard') }}">@changeLang('Dashboard')</a></li>
                {{-- @else
                <li><a href="{{ route('user.login') }}">@changeLang('Login')</a></li>
                <li><a href="{{ route('user.register') }}">@changeLang('Register')</a></li> --}}
            @endauth
        </ul>
    </div>
</div>
<!--Mobile Menu End-->

<!--Menu End-->
