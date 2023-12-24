<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- User Profile-->
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route('employee.dashboard') }}" aria-expanded="false"><i
                            class="mdi me-2 mdi-gauge"></i><span class="hide-menu">@changeLang('Dashboard')</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route('employee.profile') }}" aria-expanded="false">
                        <i class="mdi me-2 mdi-account-check"></i><span class="hide-menu">@changeLang('Profile')</span></a>
                </li>


                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        data-bs-toggle="collapse" data-bs-target="#registration" aria-expanded="false"><i
                            class="mdi me-2 fa-regular fa-address-card"></i><span class="hide-menu">@changeLang('Registration')<i
                                class="fa-solid fa-sort-down"></i></span></a></li>
                <div class="collapse" id="registration">
                    <nav class="" id="sidenavAccordionPages">

                        <a class="nav-link" href="{{ route('employee.todaysReg') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-caret-up fa-rotate-90"></i> <i
                                    class="fa-solid fa-users"></i> @changeLang('Todays Registration')</div>
                        </a>
                        <a class="nav-link" href="{{ route('employee.totalReg') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-caret-up fa-rotate-90"></i> <i
                                    class="fa-solid fa-users"></i> @changeLang('Total Registration')</div>
                        </a>
                        <a class="nav-link" href="{{ route('employee-customer.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-caret-up fa-rotate-90"></i> <i
                                    class="fa-solid fa-users"></i> @changeLang('Customer')</div>
                        </a>
                        <a class="nav-link" href="{{ route('vendor.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-caret-up fa-rotate-90"></i> <i
                                    class="fa-solid fa-toolbox"></i> @changeLang('Vendor')</div>
                        </a>
                    </nav>
                </div>
                {{-- @if ($employee_role === 'Zone Manager' || $employee_role === 'Team Leader') --}}
                @if (Auth::user()->employee_role === 'Zone Manager' || Auth::user()->employee_role === 'Team Leader')
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{ route('employee.search_index') }}" aria-expanded="false">
                            <i class="fa-solid fa-search px-1"></i><span class="hide-menu"> @changeLang('Search Employee')</span>
                        </a>
                    </li>
                @endif

                {{-- <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route('employee.vendorcustomerLocation') }}" aria-expanded="true"><i
                            class="mdi me-2 fa-solid fa-location-dot"></i><span class="hide-menu">Vendor &
                            Customer<br>Location</span></a></li> --}}

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                    data-bs-toggle="collapse" data-bs-target="#order" aria-expanded="false"><i class="mdi me-2 fa-regular fa-address-card"></i>
                    <span class="hide-menu">@changeLang('Order')</span>
                    <div class="sb-sidenav-collapse-arrow"><i class="fa-solid fa-sort-down"></i></div></a>
                </li>
                <div class="collapse" id="order">
                    <nav class="" id="sidenavAccordionPages">

                        <a class="nav-link" href="{{route('employee.confirmOrder')}}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-caret-up fa-rotate-90"></i><i class="fa-solid fa-truck"></i> @changeLang('Confirm Order')</div>
                        </a>
                        <a class="nav-link" href="{{route('employee.runningOrder')}}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-caret-up fa-rotate-90"></i><i class="fa-solid fa-truck"></i> @changeLang('Running Order')</div>
                        </a>
                        <a class="nav-link" href="{{route('employee.cancelOrder')}}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-caret-up fa-rotate-90"></i><i class="fa-solid fa-truck"></i> @changeLang('Cancel Order')</div>
                        </a>

                    </nav>
                </div>

                <li class="nav-item {{ activeMenu('employee.worksheet') }}">
                    <a href="{{ route('employee.worksheet') }}" class="nav-link"><i
                            class="mdi me-2 fa-solid fa-briefcase"></i><span>@changeLang('Work Sheet')</span></a>
                </li>
                {{-- <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route('employee.regLink') }}" aria-expanded="false"><i
                            class="mdi me-2 fa-solid fa-link"></i><span class="hide-menu">Regi:Link</span></a>
                </li> --}}
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route('employee.performance') }}" aria-expanded="false"><i
                            class="mdi me-2 fa-solid fa-person-running"></i><span
                            class="hide-menu">@changeLang('Performance')</span></a>
                </li>

            </ul>

        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->

    {{-- Sidenav Footer --}}
    <div class="sidebar-footer">
        <div class="row">
          <div class="col-8 link-wrap">
            <!-- item-->
            <b class="text-info">{{auth()->user()->fullname}}</b>
          </div>
      
          <div class="col-4 link-wrap">
            <!-- item-->
            <a href="{{route('user.logout')}}" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Log Out"
              data-original-title="Logout"><i class="mdi mdi-power"></i></a>
          </div>
        </div>
      </div>
</aside>
