<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, materialpro admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, materialpro admin lite design, materialpro admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="Material Pro Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/materialpro-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" hrefr="{{asset('employee/assets/images/favicon.png')}}">
     @include('employee.layout.includes.css')
     <link rel="stylesheet" href="{{asset('backend/css/custom.css')}}">

     @stack('custom-style')
     @stack('css')
     @if ($general->site_direction == 'rtl')
         <link rel="stylesheet" href="{{asset('backend/css/rtl.css')}}">
     @endif
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        @include('employee.layout.includes.topnav')
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        @include('employee.layout.includes.sidenav')
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row justify-content-between">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0">ইমপ্লয়ী ড্যাশবোর্ড</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">হোম</li>
                                    <li class="breadcrumb-item active" aria-current="page">@yield('page_title')</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-md-6 align-self-end">
                        @if(Auth::user()->employee_role == 'Brand Promoter')
                        <h4 class="page-title mb-0 p-0">@changeLang('Brand Promoter')</h4>
                        @elseif (Auth::user()->employee_role == 'Zone Manager')
                        <h4 class="page-title mb-0 p-0">@changeLang('Zone Manager')</h4>
                        @elseif (Auth::user()->employee_role == 'Team Leader')
                        <h4 class="page-title mb-0 p-0">@changeLang('Team Leader')</h4>
                        @endif

                        
                    </div>
                </div>
            </div>
            <div class="container-fluid">
               @yield('employee_content')
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
     @include('employee.layout.includes.script')

     <script src="{{asset('backend/js/jquery.min.js')}}"></script>
     <script src="{{asset('backend/js/popper.min.js')}}"></script>
     <script src="{{asset('backend/js/bootstrap.min.js')}}"></script>
     <script src="{{asset('backend/js/jquery-ui.min.js')}}"></script>
     <script src="{{asset('backend/js/nicescroll.min.js')}}"></script>
     <script src="{{asset('backend/js/summernote.js')}}"></script>
     <script src="{{asset('backend/js/select2.min.js')}}"></script>
     <script src="{{asset('backend/js/sortable.js')}}"></script>
     <script src="{{asset('backend/js/moment-a.js')}}"></script>
     <script src="{{asset('backend/js/stisla.js')}}"></script>
     <script src="{{asset('backend/js/bootstrap-iconpicker.bundle.min.js')}}"></script>
     <script src="{{asset('backend/js/colorpicker.js')}}"></script>
     <script src="{{asset('backend/js/jquery.uploadpreview.min.js')}}"></script>
     <script src="{{asset('backend/js/chart.min.js')}}"></script>
     <script src="{{asset('backend/js/scripts.js')}}"></script>
     @include('admin.partials.toaster')

     <script>
       $(function(){
         'use strict'
         $('.clear').on('click',function(e){
           e.preventDefault();
             const modal = $('#cleardb');
             modal.find('form').attr('action',$(this).data('href'))
             modal.modal('show');
         })

       })


     </script>
</body>

</html>
