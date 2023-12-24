<div id="sidebarMain">
    <h6 class="openbtn bg-primary" onclick="openSideNav()">☰</h6>
</div>

<div id="mySidebar" class="right-sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeSideNav()">×</a>

    <a class="">
        @if (auth()->user()->image != '')
            <img src="{{ getFile('user', auth()->user()->image) }}" alt="" class="rounded-circle" width="40%">
        @else
            <img src="{{ asset('backend/images/default-user.png') }}" alt="" class="rounded-circle"
                width="40%">
        @endif
    </a>
    <a> <i class="text-dark fas fa-user-shield"></i> <b>নামঃ</b> {{ auth()->user()->fname }} </a>
    <a> <i class="text-dark fas fa-phone-alt"></i> <b>মোবাইলঃ</b> {{ auth()->user()->mobile }} </a>
    <a> <i class="text-dark fas fa-envelope"></i> <b>ইমেইলঃ</b> {{ auth()->user()->email }} </a>
    <a class="{{ activeMenu('user.profile.*') }}" href="{{ route('user.profile') }}">
        <i class="text-dark fas fa-edit"></i> প্রোফাইল আপডেট করুন
    </a>

    <span class="sidebar-category">কাষ্টমার একাউন্ট</span>

    <a class="{{ activeMenu('user.dashboard') }}" href="{{ route('user.dashboard') }}">
        <i class="text-dark fas fa-fire"></i> @changeLang('Dashboard')
    </a>
    <a class="{{ activeMenu('user.trip-info.*') }}" href="{{ route('user.trip-info.index') }}">
        <i class="text-dark fas fa-truck-pickup"></i> ট্রীপসমূহ
    </a>
    <a class="{{ activeMenu('user.trip-info.*') }}" href="{{ route('user.allBid') }}">
        <i class="text-dark fas fa-truck-pickup"></i> বিডিং দেখুন
    </a>

    <span class="sidebar-category">ক্যাটাগরিসমূহ</span>

    <a class="" href="{{ route('home.service', 'ট্রাক') }}">
        <i class="text-dark fas fa-truck"></i> ট্রাক
    </a>
    <a class="" href="" data-toggle="collapse" data-target="#demo">
        <i class="text-dark fas fa-car"></i> অন্যান্য যানবাহন <i class="fas fa-caret-down"></i>
        <div id="demo" class="collapse ml-4 mb-2 mt-n3">
            <a class="" href="{{ route('home.service', 'বাস') }}">
                <i class="text-dark fas fa-bus"></i> বাস
            </a>
            <a class="" href="{{ route('home.service', 'প্রাইভেট কার') }}">
                <i class="text-dark fas fa-car"></i> প্রাইভেট কার
            </a>
            <a class="&#xf5b6;" href="{{ route('home.service', 'মাইক্রো') }}">
                <i style='font-size:14px' class='fas'>&#xf5b6;</i> মাইক্রো
            </a>
            <a class="" href="{{ route('home.service', 'এম্বুল্যান্স') }}">
                <i class="text-dark fas fa-ambulance"></i> এম্বুল্যান্স
            </a>
            <a class="" href="{{ route('home.service', 'সিএনজি') }}">
                <iconify-icon icon="fluent-emoji-high-contrast:auto-rickshaw" width="18px" style="color: black"></iconify-icon> সিএনজি
            </a>

            <a class="" href="{{ route('home.service', 'মাহিন্দ্রা') }}">
                <iconify-icon icon="noto:auto-rickshaw" width="18px" style="color: black"></iconify-icon> মাহিন্দ্রা
            </a>
            <a class="" href="{{ route('home.service', 'ইজিবাইক') }}">
                <iconify-icon icon="mdi:rickshaw" width="18px" style="color: black"></iconify-icon> ইজিবাইক
            </a>
            <a class="" href="{{ route('home.service', 'মোটরসাইকেল') }}">
                <i class="text-dark fas fa-motorcycle"></i> মোটরসাইকেল
            </a>
            <a class="" href="{{ route('home.service', 'ভ্যান') }}">
                <i class="text-dark fas fa-car"></i> ভ্যান
            </a>
        </div>
    </a>
    <a class="" href="{{route('upcoming')}}">
        <i class="text-dark fas fa-shopping-cart"></i> নিত্যপ্রয়োজনীয় জিনিসপত্র
    </a>
    <a class="" href="{{route('upcoming')}}">
        <i class="text-dark fas fa-shopping-bag"></i> পাইকারী বাজার
    </a>
    <a class="" href="{{route('upcoming')}}">
        <i class="text-dark fas fa-medkit"></i> ফার্মেসী
    </a>
    <a class="" href="{{route('upcoming')}}">
        <i class="text-dark fas fa-user-md"></i> ডক্টর
    </a>
    <a class="" href="{{route('upcoming')}}">
        <i class="text-dark fas fa-hospital"></i> ডায়াগনস্টিক সেন্টার
    </a>
    <a class="" href="{{route('upcoming')}}">
        <i class="text-dark fas fa-home"></i> বাসা ভাড়া
    </a>
    <a class="" href="{{route('upcoming')}}">
        <i class="text-dark fas fa-hotel"></i> হোটেল ভাড়া
    </a>
    <a class="" href="{{route('upcoming')}}">
        <i class="text-dark fas fa-user"></i> হিউম্যান রেন্ট
    </a>
    <a class="" href="{{route('upcoming')}}">
        <i class="text-dark fas fa-briefcase"></i> অন্যান্য সেবাসমূহ
    </a>

    <a href="{{ route('user.logout') }}" class="text-danger">
        <i class="fas fa-sign-out-alt"></i> লগআউট
    </a>
</div>

@push('script')
    <script>
        function openSideNav() {
            document.getElementById("mySidebar").style.width = "250px";
        }

        function closeSideNav() {
            document.getElementById("mySidebar").style.width = "0";
        }

        window.addEventListener('click', function(e) {
            if (document.querySelector(".openbtn").contains(e.target)) {
                document.getElementById("mySidebar").style.width = "250px";
            } else {
                if (document.getElementById("mySidebar").contains(e.target)) {} else {
                    document.getElementById("mySidebar").style.width = "0";
                }
            }
        });
    </script>
@endpush
