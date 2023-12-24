<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    @stack('seo')
    <!-- Title -->
    <title>{{ @$general->sitename . '-' . $pageTitle }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ getFile('logo', @$general->icon) }}">


    @stack('meta')

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/swiper-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/datatable.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/spacing.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/dev.css') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/jquery.datetimepicker.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet"
        href="{{ asset('frontend/css/color.php?color=' . str_replace('#', '', @$general->color) . '&color2=' . str_replace('#', '', @$general->secondary_color) . '') }}">

    @stack('custom-css')

    @if ($general->site_direction == 'rtl')
        <link rel="stylesheet" href="{{ asset('frontend/css/rtl.css') }}">
    @endif

    <link rel="stylesheet" href="https://fonts.maateen.me/kalpurush/font.css">
    <style>
        * {
            font-family: 'kalpurush', sans-serif !important;
        }
    </style>


    <style>
        /* register modal form design */
        .option {
            background: #fff;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-evenly;
            margin: 0 10px;
            border-radius: 5px;
            cursor: pointer;
            padding: 0 10px;
            border: 2px solid lightgrey;
            transition: all 0.3s ease;
        }

        .option .dot {
            height: 20px;
            width: 20px;
            background: #d9d9d9;
            border-radius: 50%;
            position: relative;
        }

        .option .dot::before {
            position: absolute;
            content: "";
            top: 4px;
            left: 4px;
            width: 12px;
            height: 12px;
            background: #5f3afc;
            border-radius: 50%;
            opacity: 0;
            transform: scale(1.5);
            transition: all 0.3s ease;
        }

        .reg-radio {
            display: none;
        }



        #option-1:checked:checked~.option-1,
        #option-2:checked:checked~.option-2 {
            border-color: #5f3afc;
            background: #5f3afc;
        }

        #option-1:checked:checked~.option-1 .dot,
        #option-2:checked:checked~.option-2 .dot {
            background: #fff;
        }

        #option-1:checked:checked~.option-1 .dot::before,
        #option-2:checked:checked~.option-2 .dot::before {
            opacity: 1;
            transform: scale(1);
        }

        .option span {
            font-size: 20px;
            padding: 10px 5px;
            color: #808080;
        }

        #option-1:checked:checked~.option-1 span,
        #option-2:checked:checked~.option-2 span {
            color: #fff;
        }
    </style>

</head>

<body class="body">

    @php
        $cookie = App\Models\CookieConsent::first();
        $divisions = App\Models\Division::all();
    @endphp

    @if (@$cookie->allow_modal)
        @include('cookieConsent::index')
    @endif

    @if (@$general->analytics_status)
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ @$general->analytics_key }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag("js", new Date());

            gtag("config", "{{ @$general->analytics_key }}");
        </script>
    @endif

    @if (@$general->blog_comment)
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous"
            src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v11.0&appId={{ @$general->fb_app_key }}&autoLogAppEvents=1"
            nonce="8T9eA4ui"></script>
    @endif


    @if (@$general->preloader_status)
        <!--Preloader Start-->
        <div id="preloader">
            <div id="status"
                style="background-image: url({{ asset('admin/images/preloader/' . @$general->preloader_image) }})">
            </div>
        </div>
        <!--Preloader End-->
    @endif

    <div>
        @include('frontend.partials.header')

        @if (!request()->routeIs('home') && request()->routeIs('pages'))
            @include('frontend.sections.breadcrumb')
        @endif

        @if (!request()->routeIs('pages'))
            @yield('breadcumb')
        @endif

        @yield('content')


        @include('frontend.sections.footer')


    </div>



    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">লগইন ফরম</h5>
                    @auth()
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    @else
                        <a href="{{ route('home') }}" style="text-decoration: none;">
                            < Home</a>
                            @endauth
                </div>
                <div class="modal-body">

                    <div class="p-4 m-3">

                        <form action="{{ route('user.login') }}" method="POST" class="needs-validation">

                            @csrf
                            <div class="row justify-content-center">

                                <div class="form-group col-md-12">

                                    <label for="">@changeLang('Mobile') <span class="text-danger">*</span></label>
                                    <input type="text" name="mobile" class="form-control">

                                </div>

                                <div class="form-group col-md-12">

                                    <label for="">@changeLang('Password') <span class="text-danger">*</span></label>
                                    <div>
                                        <span class="show-hide-password">
                                            <i class="fa fa-eye" style="position: absolute; right: 23; top: 45;"></i>
                                        </span>
                                        <input type="password" name="password" class="form-control password">
                                    </div>

                                </div>
                                <div class="col-md-12">

                                    <button type="submit" class="btn  btn-base ">@changeLang('Login Now')</button>
                                </div>

                                <div class="col-md-12 mt-4">

                                    <p>@changeLang('Forgot Password')? <a href="#" id="go-to-forgot-password"
                                            class="text-primary">@changeLang('Click here to reset')</a></p>


                                    <p>অ্যাকাউন্ট নেই? <a href="#" id="go-to-register"
                                            class="text-primary">@changeLang('Register Now')</a></p>

                                </div>



                            </div>


                        </form>
                    </div>


                </div>

            </div>
        </div>
    </div>



    <!-- Register Modal -->

    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">রেজিস্ট্রেশন ফরম</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="p-4 m-3">

                        <form action="{{ route('user.register') }}" method="POST" class="needs-validation"
                            enctype="multipart/form-data">

                            @csrf
                            <div class="row ">

                                <div class="form-group col-md-12 d-flex">


                                    <input type="radio" class="reg-radio" name="user_type" id="option-1"
                                        value="1" checked>
                                    <input type="radio" class="reg-radio" name="user_type" id="option-2"
                                        value="2">
                                    <label for="option-1" class="option option-1">
                                        <div class="dot"></div>
                                        <span>@changeLang('User')</span>
                                    </label>
                                    <label for="option-2" class="option option-2">
                                        <div class="dot"></div>
                                        <span>@changeLang('Service Provider')</span>
                                    </label>


                                </div>

                                <div class="form-group col-md-6" id="fname">

                                    <label for="">@changeLang('First Name') <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="fname" value="{{old('fname')}}" class="form-control" required>

                                </div>


                                <div class="form-group col-md-6">

                                    <label for="">@changeLang('Email Address')<span class="text-danger"></span></label>
                                    <input type="text" name="email" value="{{old('email')}}" class="form-control">

                                </div>

                                <div class="form-group col-md-6">

                                    <label for="">@changeLang('Phone')<span class="text-danger">*</span></label>
                                    <input type="text" name="mobile" value="{{old('mobile')}}" class="form-control" required>

                                </div>

                                <div class="form-group col-md-8">

                                    <label for="">@changeLang('Location')<span class="text-danger">*</span></label>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <select id="division" name="division_id" class="form-select"
                                                    value="{{ old('division_id') }}" @required(true)>
                                                    <option selected>@changeLang('Select Division')</option>
                                                    @foreach ($divisions as $division)
                                                        <option class="text-dark" value="{{ $division->id }}">
                                                            {{ $division->bn_name }}</option>
                                                    @endforeach
                                                </select><span class="text-danger">*</span>
                                            </div>
                                            <div class="col-md-6">
                                                <select id="district" name="district_id" class="form-select"
                                                    value="{{ old('district_id') }}">
                                                    <option selected>@changeLang('Select District')</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <select id="upazila" name="upazila_id" class="form-select"
                                                    value="{{ old('upazila_id') }}">
                                                    <option selected>@changeLang('Select Upazila')</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <select id="union" name="union_id" class="form-select"
                                                    value="{{ old('union_id') }}">
                                                    <option selected>@changeLang('Select Union')</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group col-md-6" id="nidno">

                                    <label for="">জাতীয় পরিচয়পত্র নং<span class="text-danger">*</span></label>
                                    <input type="text" name="nid_no" value="{{old('nid_no')}}" class="form-control">

                                </div>
                                <div class="form-group col-md-6">

                                    <label for="">@changeLang('Password')<span class="text-danger">*</span></label>
                                    <div>
                                        <span class="show-hide-password">
                                            <i class="fa fa-eye" style="position: absolute; right: 23; top: 45;"></i>
                                        </span>
                                        <input type="password" name="password" class="form-control password" required>
                                    </div>

                                </div>

                                <div class="form-group col-md-6" id="nidimagefront">

                                    <label for="">জাতীয় পরিচয়পত্রের ছবি (সামনের অংশ)<span
                                            class="text-danger">*</span></label>
                                    {{-- <div class="custom-file">
                                        <input type="file" name="nid_front" class="custom-file-input"
                                            id="customFile1" value="">
                                        <label class="custom-file-label" for="customFile1">Choose file</label>
                                    </div> --}}
                                    <div id="image-preview2" class="image-preview w-100">
                                        <label for="image-upload2" id="image-label2">@changeLang('Choose File')</label>
                                        <input type="file" name="nid_front" id="image-upload2" />
                                    </div>

                                </div>
                                <div class="form-group col-md-6" id="nidimageback">

                                    <label for="">জাতীয় পরিচয়পত্রের ছবি (পিছনের অংশ)<span
                                            class="text-danger">*</span></label>
                                    {{-- <div class="custom-file">
                                        <input type="file" name="nid_back" class="custom-file-input"
                                            id="customFile2" value="">
                                        <label class="custom-file-label" for="customFile2">Choose file</label>
                                    </div> --}}
                                    <div id="image-preview3" class="image-preview w-100">
                                        <label for="image-upload3" id="image-label3">@changeLang('Choose File')</label>
                                        <input type="file" name="nid_back" id="image-upload3" />
                                    </div>
                                </div>

                                <div class="form-group col-md-6">

                                    <label for="">@changeLang('Referral Code')</label>
                                    <div>
                                        <input type="text" name="referral" value="{{old('referral')}}" class="form-control">
                                    </div>

                                </div>
                                {{-- <div class="form-group col-md-6">

                                    <label for="">@changeLang('Confirm Password')<span class="text-danger">*</span></label>
                                    <input type="password" name="password_confirmation" class="form-control">

                                </div> --}}

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-base w-100">@changeLang('Register Now')</button>
                                </div>

                                <div class="col-md-12 mt-4">

                                    <p>@changeLang('Registered Already')? <a href="#" id="go-to-login"
                                            class="text-primary">@changeLang('Login here')</a></p>

                                </div>

                            </div>


                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>


    <!-- Forgot-Password Modal -->

    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog"
        aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="forgotPasswordModalLabel">পাসওয়ার্ড ভুলে গেছেন</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="p-4 m-3">

                        <form action="{{ route('user.forgot.password') }}" method="POST">

                            @csrf
                            <div class="row justify-content-center">



                                <div class="form-group col-md-12">

                                    <label for="">@changeLang('Phone') <span
                                            class="text-danger">*</span></label>
                                    <input type="number" name="mobile" class="form-control">

                                </div>



                                <div class="col-md-12">

                                    <button type="submit" class="btn  btn-base ">@changeLang('Send Verification Code')</button>
                                </div>

                                <div class="col-md-12 mt-4">

                                    <p>@changeLang('Login Again')? <a href="#" id="forgot-to-login"
                                            class="text-primary">@changeLang('Login')</a></p>

                                </div>



                            </div>


                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>




    <!--Js-->
    <script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('frontend/fontawesome-free/js/all.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.timepicker.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.collapse.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/swiper-bundle.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.filterizr.min.js') }}"></script>
    <script src="{{ asset('frontend/js/select2.min.js') }}"></script>
    <script src="{{ asset('frontend/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('frontend/js/viewportchecker.js') }}"></script>
    @include('frontend.partials.toaster')
    <script src="{{ asset('frontend/js/custom.js') }}"></script>
    <script src="{{ asset('frontend/dashboard/js/jquery.uploadpreview.min.js') }}"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.full.min.js">
    </script>

    <script>
        $(document).ready(function() {
            $.datetimepicker.setLocale('en');
            $('#datetimepicker').datetimepicker({
                closeOnDateSelect: true,
                formatTime: "h:i a",
                format: 'd/m/Y h:i a',
            });
        });
    </script>


    @if (@$general->twak_allow)
        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
            var Tawk_API = Tawk_API || {},
                Tawk_LoadStart = new Date();
            (function() {
                var s1 = document.createElement("script"),
                    s0 = document.getElementsByTagName("script")[0];
                s1.async = true;
                s1.src = "https://embed.tawk.to/{{ @$general->twak_key }}";
                s1.charset = 'UTF-8';
                s1.setAttribute('crossorigin', '*');
                s0.parentNode.insertBefore(s1, s0);
            })();
        </script>
        <!--End of Tawk.to Script-->
    @endif




    <script>
        'use strict'
        // $(function() {
        //     $(".datepicker").datepicker({
        //         minDate: -1
        //     });
        // });
    </script>
    <script>
        //Search
        function openSearch() {
            document.getElementById("myOverlay").style.display = "block";
        }

        function closeSearch() {
            document.getElementById("myOverlay").style.display = "none";
        }
    </script>


    <script>
        // from register modal to login modal
        $(document).on('click', '#go-to-login', function(e) {
            e.preventDefault();

            $('#registerModal').modal('hide')

            setTimeout(() => {
                $('#loginModal').modal('show')
            }, 200);

        })

        // from login modal to register modal
        $(document).on('click', '#go-to-register', function(e) {
            e.preventDefault();

            $('#loginModal').modal('hide')

            setTimeout(() => {
                $('#registerModal').modal('show')
            }, 200);

        })


        // from login modal to forgot-password modal
        $(document).on('click', '#go-to-forgot-password', function(e) {
            e.preventDefault();

            $('#loginModal').modal('hide')

            setTimeout(() => {
                $('#forgotPasswordModal').modal('show')
            }, 200);

        })

        $(document).on('click', '#forgot-to-login', function(e) {
            e.preventDefault();

            $('#forgotPasswordModal').modal('hide')

            setTimeout(() => {
                $('#loginModal').modal('show')
            }, 200);

        });

        $(document).ready(function() {
            $('#nidno').hide();
            $('#nidimagefront').hide();
            $('#nidimageback').hide();
        });
        $(document).on('click', '#option-1', function() {
            $('#nidno').hide();
            $('#nidimagefront').hide();
            $('#nidimageback').hide();
        });
        $(document).on('click', '#option-2', function() {
            $('#fname').addClass('col-md-12')
            $('#nidno').show();
            $('#nidimagefront').show();
            $('#nidimageback').show();
        });
        $.uploadPreview({
            input_field: "#image-upload2", // Default: .image-upload
            preview_box: "#image-preview2", // Default: .image-preview
            label_field: "#image-label2",
            label_default: "{{ changeDynamic('Choose File') }}", // Default: Choose File
            label_selected: "{{ changeDynamic('Upload File') }}", // Default: Change File
            no_label: false, // Default: false
            success_callback: null // Default: null
        });
        $.uploadPreview({
            input_field: "#image-upload3", // Default: .image-upload
            preview_box: "#image-preview3", // Default: .image-preview
            label_field: "#image-label3",
            label_default: "{{ changeDynamic('Choose File') }}", // Default: Choose File
            label_selected: "{{ changeDynamic('Upload File') }}", // Default: Change File
            no_label: false, // Default: false
            success_callback: null // Default: null
        });

        $('.show-hide-password').click(function(e) {
            e.preventDefault();
            $type = $('.password').attr('type');
            if ($type == 'password') {
                $('.password').attr('type', 'text');
            } else {
                $('.password').attr('type', 'password');
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#division').change(function() {
                var divisionId = $(this).val();
                $('#district').empty();
                $('#upazila').empty();
                $('#union').empty();

                if (divisionId !== '') {
                    $.ajax({
                        url: '/getDistricts/' + divisionId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#district').append(
                                '<option selected disabled >@changeLang('Select District')</option>');
                            data.forEach(function(district) {
                                $('#district').append('<option value="' + district.id +
                                    '">' + district.bn_name + '</option>');
                            });
                        }
                    });
                }
            });

            $('#district').change(function() {
                var districtId = $(this).val();
                $('#upazila').empty();
                $('#union').empty();

                if (districtId !== '') {
                    $.ajax({
                        url: '/getUpazilas/' + districtId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#upazila').append(
                                '<option selected disabled >@changeLang('Select Upazila')</option>');
                            data.forEach(function(upazila) {
                                $('#upazila').append('<option value="' + upazila.id +
                                    '">' + upazila.bn_name + '</option>');
                            });
                        }
                    });
                }
            });

            $('#upazila').change(function() {
                var upazilaId = $(this).val();
                $('#union').empty();

                if (upazilaId !== '') {
                    $.ajax({
                        url: '/getUnions/' + upazilaId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#union').append(
                                '<option selected disabled >@changeLang('Select Union')</option>');
                            data.forEach(function(union) {
                                $('#union').append('<option value="' + union.id + '">' +
                                    union.bn_name + '</option>');
                            });
                        }
                    });
                }
            });
        });
    </script>



    @stack('script')
    @stack('js')
{{--
    @if ($general->site_direction == 'rtl')
        <script src="{{ asset('frontend/js/rtl.js') }}"></script>
    @else
        <script src="{{ asset('frontend/js/ltr.js') }}"></script>
    @endif --}}

</body>

</html>
