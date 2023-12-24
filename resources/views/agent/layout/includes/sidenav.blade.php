<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- User Profile-->
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route('agent.dashboard') }}" aria-expanded="false"><i class="mdi me-2 mdi-gauge"></i><span
                            class="hide-menu">@changeLang('Dashboard')</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route('agent.profile') }}" aria-expanded="false">
                        <i class="mdi me-2 mdi-account-check"></i><span class="hide-menu"> @changeLang('Profile')</span></a>
                </li>

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route('agent.index1') }}" aria-expanded="false"><i class="fa-solid fa-search px-1"> </i>
                        @changeLang('Search Agent')</a></li>


                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        data-bs-toggle="collapse" data-bs-target="#registration" aria-expanded="false"><i
                            class="mdi me-2 fa-regular fa-address-card"></i><span class="hide-menu">
                            @changeLang('Registration')</span>
                        <div class="sb-sidenav-collapse-arrow"><i class="fa-solid fa-sort-down"></i></div>
                    </a>
                </li>
                <div class="collapse" id="registration">
                    <nav class="" id="sidenavAccordionPages">

                        <a class="nav-link" href="{{ route('agent-customer.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-caret-up fa-rotate-90"></i> <i
                                    class="fa-solid fa-users"></i> @changeLang('Customer')</div>
                        </a>
                        <a class="nav-link" href="{{ route('agent-vendor.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-caret-up fa-rotate-90"></i> <i
                                    class="fa-solid fa-toolbox"></i> @changeLang('Vendor')</div>
                        </a>
                    </nav>
                </div>



                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        data-bs-toggle="collapse" data-bs-target="#order" aria-expanded="false"><i
                            class="mdi me-2 fa-regular fa-address-card"></i>
                        <span class="hide-menu">@changeLang('Order')</span>
                        <div class="sb-sidenav-collapse-arrow"><i class="fa-solid fa-sort-down"></i></div>
                    </a>
                </li>
                <div class="collapse" id="order">
                    <nav class="" id="sidenavAccordionPages">

                        <a class="nav-link" href="{{ route('agent.confirmOrder') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-caret-up fa-rotate-90"></i><i
                                    class="fa-solid fa-truck"></i> @changeLang('Confirm Order')</div>
                        </a>
                        <a class="nav-link" href="{{ route('agent.runningOrder') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-caret-up fa-rotate-90"></i><i
                                    class="fa-solid fa-truck"></i> @changeLang('Running Order')</div>
                        </a>
                        <a class="nav-link" href="{{ route('agent.cancelOrder') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-caret-up fa-rotate-90"></i><i
                                    class="fa-solid fa-truck"></i> @changeLang('Cancel Order')</div>
                        </a>

                    </nav>
                </div>

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
                <b class="text-info">{{ auth()->user()->fullname }}</b>
            </div>

            <div class="col-4 link-wrap">
                <!-- item-->
                <a href="{{ route('user.logout') }}" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Log Out"
                    data-original-title="Logout"><i class="mdi mdi-power"></i></a>
            </div>
        </div>
    </div>
</aside>
