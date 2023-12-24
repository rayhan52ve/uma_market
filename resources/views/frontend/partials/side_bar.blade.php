<aside id="sidebar-wrapper">

    <style>
        .user-item img {
            height: 125px;

        }

        .user-item {
            text-align: left
        }

        .main-sidebar .sidebar-menu li a {
            color: #000000;
            font-size: 18px
        }
    </style>

    <div class="bg-light mb-4 py-4 mx-auto" id="sidebar_profile_info">
        <div class="d-flex justify-content-center">
            <div class="user-item w-75">
                <img alt="image"
                    src="@if (auth()->user()->image) {{ getFile('user', auth()->user()->image) }} @else {{ asset('backend/images/default-user.png') }} @endif"
                    class="img-fluid" style="width: 90%">
                <div class="user-details">
                    <div class="text-dark mb-2 mt-4" style="font-size: 1.1em"><i
                            class="text-dark fas fa-user-shield"></i> <b>নামঃ</b> {{ auth()->user()->fname }}</div>
                    <div class="text-dark mb-2" style="font-size: 1.1em"><i class="text-dark fas fa-map-marker"></i>
                        <b>ঠিকানাঃ</b>
                        @php
                            $vendordetails = App\Models\User::where('id', auth()->user()->id)->first();
                            // dd($vendordetails->union, $vendordetails->upazila);
                        @endphp
                        @if ($vendordetails->union && $vendordetails->upazila && $vendordetails->district && $vendordetails->division)
                            {{ $vendordetails->union->name }},
                            {{ $vendordetails->upazila->name }},{{ $vendordetails->district->name }},{{ $vendordetails->division->name }}
                        @endif
                    </div>
                    <div class="text-dark mb-2" style="font-size: 1.1em"><i class="text-dark fas fa-mobile"></i>
                        <b>মোবাইলঃ</b>
                        {{ auth()->user()->mobile }}
                    </div>
                    <div class="text-dark mb-2" style="font-size: 1.1em"><i class="text-dark fas fa-briefcase"></i>
                        <b>কাজের অভিজ্ঞতাঃ</b>
                        {{ auth()->user()->userDetails->driving_experience }}
                    </div>

                    <div class="user-cta"><i class="text-dark fas fa-edit"></i>
                        <a class="font-weight-bold" href="{{ route('user.profile') }}">প্রোফাইল আপডেট করুন</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <ul class="sidebar-menu">
        <li class="nav-item dropdown {{ activeMenu('user.dashboard') }}">
            <a href="{{ route('user.dashboard') }}" class="nav-link"><i
                    class="fas fa-home"></i><span>{{ $navbar['Dashboard'] }}</span></a>
        </li>



        @if (auth()->user()->user_type == 2)
            {{-- <li class="nav-item dropdown {{ activeMenu('user.service*') }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-toilet-paper"></i> <span>{{ $navbar['Service'] }}</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('user.service') }}">{{ $navbar['All Services'] }}</a></li>
                    @php
                        $user = Auth::user();
                        $userDetails = App\Models\UserDetail::where('user_id', $user->id)->first();
                    @endphp
                    @if ($userDetails)
                        @if ($userDetails->provider_type == 'ড্রাইভার')
                        @else
                            <li><a class="nav-link"
                                    href="{{ route('user.service.create') }}">{{ $navbar['Create Service'] }}</a></li>
                        @endif
                    @else
                        <li><a class="nav-link"
                                href="{{ route('user.service.create') }}">{{ $navbar['Create Service'] }}</a></li>
                    @endif
                    <li><a class="nav-link"
                            href="{{ route('user.service.schedule') }}">{{ $navbar['Service Schedule'] }}</a></li>
                </ul>
            </li> --}}

            {{-- <li class="nav-item dropdown {{ activeMenu('user.provider.booking*') }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-luggage-cart"></i> <span>{{ $navbar['Bookings'] }}</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link"
                            href="{{ route('user.provider.booking') }}">{{ $navbar['All Bookings'] }}</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown {{ activeMenu('user.withdraw*') }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="far fa-credit-card"></i> <span>{{ $navbar['Withdraw'] }}</span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('user.withdraw') }}" class="nav-link">{{ $navbar['Withdraw Money'] }}</a>
                    </li>
                    <li><a href="{{ route('user.withdraw.all') }}"
                            class="nav-link">{{ $navbar['All Withdraw Log'] }}</a></li>
                    <li><a href="{{ route('user.withdraw.pending') }}"
                            class="nav-link">{{ $navbar['Pending Withdraw'] }}</a></li>
                </ul>
            </li> --}}

            <li class="nav-item dropdown {{ activeMenu('user.service*') }}">
                <a class="nav-link" href="{{ route('user.service') }}"><i
                        class="fas fa-truck"></i><span>{{ $navbar['All Services'] }}</span></a>
            </li>

            {{-- <li class="nav-item dropdown">
                <a class="nav-link" href=""><i class="fas fa-tag"></i><span>{{ $navbar['Offer'] }}</span></a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link" href=""><i class="fas fa-comment"></i><span>{{ $navbar['Chat'] }}</span></a>
            </li> --}}

            {{-- <li class="nav-item dropdown">
                <a class="nav-link" href=""><i
                        class="fas fa-language"></i><span>{{ $navbar['Change Language'] }}</span></a>
            </li> --}}

            <li class="nav-item dropdown">
                <a class="nav-link" href="{{route('upcoming')}}"><i
                        class="fas fa-mobile"></i><span>{{ $navbar['My App'] }}</span></a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link" href="{{route('upcoming')}}"><i
                        class="fas fa-mobile"></i><span>{{ $navbar['Provider App'] }}</span></a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link" href="{{route('upcoming')}}"><i
                        class="fas fa-align-left"></i><span>{{ $navbar['Privacy Policy'] }}</span></a>
            </li>
        @else
            <li class="nav-item dropdown {{ activeMenu('user.trip.*') }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-truck-pickup"></i> <span>{{ $navbar['Trips'] }}</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('user.trip-info.index') }}">{{ $navbar['All Trips'] }}</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown {{ activeMenu('user.transaction') }}">
                <a href="{{ route('user.transaction') }}" class="nav-link"><i
                        class="fas fa-credit-card"></i><span>{{ $navbar['Transaction'] }}</span></a>
            </li>
        @endif


    </ul>
</aside>
