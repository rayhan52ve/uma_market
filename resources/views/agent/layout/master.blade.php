<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="">
    <meta name="description"
        content="">
    <meta name="robots" content="noindex,nofollow">
    <title>{{ config('app.name', 'umamarket') }}</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/materialpro-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" hrefr="{{asset('employee/assets/images/favicon.png')}}">
     @include('agent.layout.includes.css')

     {{-- <link rel="stylesheet" href="{{asset('backend/css/style.css')}}"> --}}
     {{-- <link rel="stylesheet" href="{{asset('backend/css/components.css')}}"> --}}
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
        @include('agent.layout.includes.topnav')
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        @include('agent.layout.includes.sidenav')
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0">এজেন্ট ড্যাশবোর্ড</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">হোম</li>
                                    <li class="breadcrumb-item active" aria-current="page">@yield('page_title')</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
               @yield('agent_content')
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
     @include('agent.layout.includes.script')
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
    @stack('custom-script')
    @yield('footer_js')
</body>

</html>
