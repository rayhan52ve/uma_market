@extends('frontend.layout.customer')

@section('customer-breadcumb', 'ওটিপি ভেরিফিকেশন')
@push('custom-css')
    <style>
        .countdown {
            font-size: 20px !important;
        }
    </style>
@endpush
@section('content')
    <div class="team-page">
        <div class="container">
            <div class="row py-5 justify-content-center">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card p-5">
                        <form method="post" action="{{ url('user/mobile-otp-verified') }}">
                            @csrf
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <h2>ওটিপি কোড লিখুন</h2>
                                    <span class="countdown-position"></span></span>
                                    <div>
                                        <h4 class="countdown badge text-danger"></h4>
                                    </div>

                                    <input type="hidden" class="form-control" name="link_token"
                                        value="{{ $user->link_token }}">
                                    <input type="number" class="form-control mb-2" name="verification_code">
                                    <br>
                                    <button type="submit" class="btn btn-info">সাবমিট</button>
                                    <span id="resend" class="btn btn-success ml-1 resend disabled">আবার পাঠান
                                </div>
                            </div>
                        </form>
                        @php 
                            $currentDate = strtotime(date('Y-m-d H:i:s'));
                            $date = $user->mobile_otp_expire_at;
                            $userLastActivity = strtotime($date);
                            $time = round(abs($currentDate - $userLastActivity) / 60);
                        @endphp 
                        <input type="hidden" class="form-control" id="timeid" value="{{ $time }}">
                    </div>
                    <form action="{{ url('user/mobile-otp-resend') }}" method="POST" id="resendform">
                        @csrf
                        <input type="hidden" class="form-control" name="link_token" value="{{ $user->link_token }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $('#resend').click(function() {
            $('#resendform').submit();
        });


        $(".resend").css("pointer-events", "none");

        var timer2 = $('#timeid').val() + ':' + '00';
        var interval = setInterval(function() {
            var timer = timer2.split(':');
            //by parsing integer, I avoid all extra string processing
            var minutes = parseInt(timer[0], 10);
            var seconds = parseInt(timer[1], 10);
            --seconds;
            minutes = (seconds < 0) ? --minutes : minutes;

            if (minutes < 0) clearInterval(interval);
            seconds = (seconds < 0) ? 59 : seconds;
            seconds = (seconds < 10) ? '0' + seconds : seconds;
            //minutes = (minutes < 10) ?  minutes : minutes;
            $('.countdown').html(minutes + ':' + seconds + ' min');
            timer2 = minutes + ':' + seconds;
            if (timer2 == '0:00') {
                $('.countdown-position').text('');
                $(".resend").css("pointer-events", "auto");
                $('.countdown').addClass('d-none');
                $(".resend").removeClass("disabled");
            }
        }, 1000);
    </script>
@endpush
