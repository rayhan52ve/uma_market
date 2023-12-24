<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}">{{ __(@$general->sitename) }}</a>
    </div>
    <ul class="sidebar-menu">
        <li class="nav-item dropdown {{ activeMenu('admin.dashboard') }}">
            <a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="fas fa-home"></i><span> @changeLang('Dashboard')
                </span></a>
        </li>

        {{-- <li class="nav-item dropdown {{activeMenu('admin.log')}}">
                <a href="{{route('admin.log')}}" class="nav-link"><i class="fas fa-credit-card"></i><span> @changeLang('Revenue Log') </span></a>
              </li> --}}

        {{-- <li class="nav-item {{activeMenu('admin.category.index')}}">
                <a href="{{route('admin.category.index')}}" class="nav-link"><i class="fas fa-list"></i><span>@changeLang('Category')</span></a>
              </li> --}}

        @if (auth()->guard('admin')->user()->role == 1)
            <li class="nav-item dropdown {{ activeMenu('admin.subadmin*') }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user"></i>
                    <span>@changeLang('Manage Sub-Admin')</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.sub-admin.create') }}">@changeLang('Create Sub-Admin')</a></li>
                    <li><a class="nav-link" href="{{ route('admin.sub-admin.index') }}">@changeLang('All Sub-Admin')</a></li>

                    {{-- <li><a class="nav-link" href="{{route('admin.user.disabled')}}">@changeLang('Disabled users')</a></li> --}}

                </ul>
            </li>
        @endif
        <li class="nav-item dropdown {{ activeMenu('admin.provider*') }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user"></i>
                <span>@changeLang('Manage Provider')</span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('admin.provider') }}">@changeLang('All Providers')</a></li>
                <li><a class="nav-link" href="{{ route('admin.provider.featured') }}">@changeLang('Featured Providers')</a></li>
                <li><a class="nav-link" href="{{ route('admin.PendingProvider') }}">@changeLang('Pending Providers')</a></li>

            </ul>
        </li>


        <li class="nav-item dropdown {{ activeMenu('admin.user*') }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user"></i>
                <span>@changeLang('Manage Customer')</span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('admin.user') }}">@changeLang('All Customers')</a></li>
                <li><a class="nav-link" href="{{ route('admin.newUser') }}">@changeLang('New Customers')</a></li>
                {{-- <li><a class="nav-link" href="{{route('admin.user.disabled')}}">@changeLang('Disabled users')</a></li> --}}

            </ul>
        </li>

        @if (auth()->guard('admin')->user()->role == 1)
            <li class="nav-item dropdown {{ activeMenu('admin.agent*') }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user"></i>
                    <span>@changeLang('Manage Agent')</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.agent.create') }}">@changeLang('Add Agent')</a></li>
                    <li><a class="nav-link" href="{{ route('admin.agent') }}">@changeLang('All Agent')</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown {{ activeMenu('admin.employee*') }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user"></i>
                    <span>@changeLang('Manage Employee')</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.employee.create') }}">@changeLang('Add Employee')</a></li>
                    <li><a class="nav-link" href="{{ route('admin.employee') }}">@changeLang('All Employee')</a></li>
                    <li><a class="nav-link" href="{{ route('admin.set') }}">@changeLang('Set Employee Target')</a></li>
                    <li><a class="nav-link" href="{{ route('admin.employee.crm') }}">@changeLang('Employee CRM')</a></li>

                </ul>
            </li>
        @endif
            <li class="nav-item {{ activeMenu('admin.service*') }}">
                <a href="{{ route('admin.service') }}" class="nav-link"><i
                        class="fas fa-toilet-paper"></i><span>@changeLang('Manage Services')</span></a>
            </li>

            <li class="nav-item dropdown {{ activeMenu('admin.reports*') }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-paste"></i>
                    <span>@changeLang('Reports')</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{route('admin.topService')}}">@changeLang('Top Service')</a></li>
                    <li><a class="nav-link" href="{{route('admin.tripReport')}}">@changeLang('Sale Report')</a></li>
                    <li><a class="nav-link" href="{{route('admin.agentTripReport')}}">@changeLang('Agent Sale Report')</a></li>

                    @if (auth()->guard('admin')->user()->role == 1)
                    <li><a class="nav-link" href="{{route('admin.employeeTripReport')}}">@changeLang('Employee Sale Report')</a></li>
                    <li><a class="nav-link" href="{{route('admin.selfSalesReport')}}">@changeLang('Self Sale Report')</a></li>
                    <li><a class="nav-link" href="{{route('admin.transactionReport')}}">@changeLang('Transaction Report')</a></li>
                    <li><a class="nav-link" href="{{route('admin.totalEarningReport')}}">@changeLang('Total Earning Report')</a></li>
                    <li><a class="nav-link" href="{{route('admin.dueReport')}}">@changeLang('Total Due Payment Report')</a></li>
                    <li><a class="nav-link" href="{{route('admin.dailydueReport')}}">@changeLang('Daily Due Payment Report')</a></li>
                    <li><a class="nav-link" href="{{route('admin.vendorWiseReport')}}">@changeLang('Vendor Wise Due Report')</a></li>
                    @endif
                </ul>
            </li>
        @if (auth()->guard('admin')->user()->role == 1)

            <li class="nav-item {{ activeMenu('admin.blog.comment') }}">
                <a href="{{ route('admin.blog.comment') }}" class="nav-link"><i
                        class="fas fa-comments"></i><span>@changeLang('Manage Blog Comment')</span></a>
            </li>

            <li class="nav-item {{ activeMenu('admin.trips.bidding') }}">
                <a href="{{ route('admin.trips.bidding') }}" class="nav-link"><i
                        class="fas fa-truck-pickup"></i><span>@changeLang('See Bidding')</span></a>
            </li>

            <li class="nav-item {{ activeMenu('admin.trips.index') }}">
                <a href="{{ route('admin.trips.index') }}" class="nav-link"><i
                        class="fas fa-truck-pickup"></i><span>সকল
                        ট্রিপ</span></a>
            </li>
            <li class="nav-item {{ activeMenu('admin.worksheet.index') }}">
                <a href="{{ route('admin.worksheet.index') }}" class="nav-link"><i
                        class="fas fa-truck-pickup"></i><span>@changeLang('Work Sheet')</span></a>
            </li>


            <li class="nav-item dropdown {{ activeMenu('admin.frontend*') }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>@changeLang('Frontend')</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.frontend.pages') }}">@changeLang('Pages')</a></li>
                    <li><a class="nav-link" href="{{ route('admin.frontend.blog') }}">@changeLang('Blog Category')</a></li>
                    <li><a class="nav-link" href="{{ route('admin.frontend.faq') }}">@changeLang('Faq Category')</a></li>
                    <li><a class="nav-link" href="{{ route('admin.frontend.section') }}">@changeLang('Manage Section')</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown ">
                <a href="#" class="nav-link has-dropdown {{ activeMenu('admin.coupon*') }}"
                    data-toggle="dropdown"><i class="fas fa-user"></i>
                    <span>@changeLang('Coupon')</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.coupon.create') }}">@changeLang('Create Coupon')</a></li>
                    <li><a class="nav-link" href="{{ route('admin.coupon.index') }}">@changeLang('Coupon Redeem History')</a></li>

                </ul>
            </li>

            <li class="nav-item {{ activeMenu('admin.banner.chenge') }}">
                <a href="{{ route('admin.banner.chenge') }}" class="nav-link"><i class="fas fa-regular fa-image"></i><span>@changeLang('Banner Chenge')</span></a>
            </li>

            <li class="nav-item dropdown {{ activeMenu('admin.general*') }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-cog"></i>
                    <span>@changeLang('Settings')</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.general.setting') }}">@changeLang('General Setting')</a></li>
                    {{-- <li><a class="nav-link" href="{{route('admin.general.preloader')}}">@changeLang('Preloader Setting')</a></li>
                  <li><a class="nav-link" href="{{route('admin.general.analytics')}}">@changeLang('Google Analytics')</a></li>
                  <li><a class="nav-link" href="{{route('admin.general.cookie')}}">@changeLang('Cookie Consent')</a></li>
                  <li><a class="nav-link" href="{{route('admin.general.rechaptcha')}}">@changeLang('Google Rechaptcha')</a></li>
                  <li><a class="nav-link" href="{{route('admin.general.live.chat')}}">@changeLang('Live Chat Setting')</a></li>
                  <li><a class="nav-link" href="{{route('admin.general.seo')}}">@changeLang('Global SEO Manager')</a></li> --}}

                </ul>
            </li>

            {{-- <li class="nav-item dropdown {{activeMenu('admin.payment*')}}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="far fa-credit-card"></i> <span>@changeLang('Payment Gateway')</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="{{route('admin.payment.paypal')}}">@changeLang('Paypal')</a></li>
                  <li><a class="nav-link" href="{{route('admin.payment.stripe')}}">@changeLang('Stripe')</a></li>
                  <li><a class="nav-link" href="{{route('admin.payment.razorpay')}}">@changeLang('Razorpay')</a></li>
                  <li><a class="nav-link" href="{{route('admin.payment.flutterwave')}}">@changeLang('Flutterwave')</a></li>
                  <li><a class="nav-link" href="{{route('admin.payment.paystack')}}">@changeLang('Paystack')</a></li>
                  <li><a class="nav-link" href="{{route('admin.payment.mollie')}}">@changeLang('Mollie')</a></li>
                  <li><a class="nav-link" href="{{route('admin.payment.instamojo')}}">@changeLang('Instamojo')</a></li>
                  <li><a class="nav-link" href="{{route('admin.payment.coin')}}">@changeLang('Coinpayments')</a></li>

                  <li><a class="nav-link" href="{{route('admin.payment.paymongo')}}">@changeLang('Paymongo')</a></li>

                  <li><a class="nav-link" href="{{route('admin.payment.bank')}}">@changeLang('Bank Payment')</a></li>
                </ul>
              </li> --}}

            {{-- <li class="nav-item dropdown {{ activeMenu('admin.manual*') }}">
             <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="far fa-credit-card"></i>
                 <span>@changeLang('Manual Payments')</span></a>
             <ul class="dropdown-menu">
                 <li><a class="nav-link" href="{{ route('admin.manual') }}">@changeLang('Manual Payments')</a></li>

             </ul>
         </li> --}}

            {{-- <li class="nav-item dropdown {{ activeMenu('admin.withdraw*') }}">
             <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="far fa-credit-card"></i>
                 <span>@changeLang('Manage Withdraw')</span></a>
             <ul class="dropdown-menu">
                 <li><a class="nav-link" href="{{ route('admin.withdraw') }}">@changeLang('Withdraw Method')</a></li>
                 <li><a class="nav-link" href="{{ route('admin.withdraw.pending') }}">@changeLang('Pending Withdraws')</a></li>
                 <li><a class="nav-link" href="{{ route('admin.withdraw.accepted') }}">@changeLang('Accepted Withdraws')</a></li>
                 <li><a class="nav-link" href="{{ route('admin.withdraw.rejected') }}">@changeLang('Rejected Withdraws')</a></li>

             </ul>
         </li> --}}


            {{-- <li class="nav-item dropdown {{ activeMenu('admin.email*') }}">
             <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="far fa-envelope"></i>
                 <span>@changeLang('Email Manager')</span></a>
             <ul class="dropdown-menu">
                 <li><a class="nav-link" href="{{ route('admin.email.config') }}">@changeLang('Email Configure')</a></li>
                 <li><a class="nav-link" href="{{ route('admin.email.templates') }}">@changeLang('Email Templates')</a></li>
             </ul>
         </li> --}}


            <li class="nav-item dropdown {{ activeMenu('admin.language*') }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="far fa-envelope"></i>
                    <span>@changeLang('Manage Language')</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.language.navbar') }}">@changeLang('Navbar')</a></li>
                    <li><a class="nav-link" href="{{ route('admin.language.website') }}">@changeLang('Website Text')</a></li>
                    <li><a class="nav-link" href="{{ route('admin.language.validation') }}">@changeLang('Notification Text')</a>
                    </li>

                </ul>
            </li>
        @endif

        <li class="nav-item dropdown {{ activeMenu('admin.transaction') }}">
            <a href="{{ route('admin.transaction') }}" class="nav-link"><i
                    class="fas fa-credit-card"></i><span>@changeLang('Transactions')</span></a>
        </li>

        {{-- <li class="nav-item dropdown {{ activeMenu('admin.subscription') }}">
             <a href="{{ route('admin.subscription') }}" class="nav-link"><i
                     class="fas fa-rss"></i><span>@changeLang('Subscribers')</span></a>
         </li>

         <li class="nav-item dropdown">
             <a data-href="{{ route('admin.db.clear') }}" class="nav-link clear"><i
                     class="fas fa-eraser"></i><span>@changeLang('Clear Database')</span></a>
         </li> --}}

    </ul>
</aside>

{{-- @endif --}}
