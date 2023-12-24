@extends('frontend.layout.master')
@section('breadcrumb')
 <section class="section">
          <div class="section-header">

            <h1>@changeLang('Payment Gateways')</h1>



          </div>
</section>
@endsection
<style>

    .razorpay-payment-button {
        display: inline-block;
        font-weight: 400;
        color: #212529;
        text-align: center;
        vertical-align: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-color: transparent;
        border: 1px solid transparent;
        padding: .375rem .75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: .25rem;
        transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }

    .razorpay-payment-button {
        box-shadow: 0 2px 6px #acb5f6 !important;
        background-color: #6777ef !important;
        border-color: #6777ef !important;
        font-weight: 600;
        font-size: 12px;
        line-height: 24px;
        padding: .3rem .8rem;
        letter-spacing: .5px;
        color: #fff;
    }
</style>
@section('content')

    <div class="row">

        <div class="col-md-12">


            <div class="card">


                <div class="card-body">

                    <div class="row">

                        @foreach ($gateways as $gateway)

                            <div class="col-md-4 mt-4">
                                <div class="thumbnail">
                                        <div class="image-area">
                                            <img src="{{ getFile('gateways' , $gateway->gateway_image) }}"
                                            alt="Lights" class="w-100 gateway-image">
                                        </div>
                                        <div class="caption text-center mt-3">
                                            <form action="" method="post">
                                                @csrf
                                                <input type="hidden" name="gateway" id="" value="{{$gateway->id}}">
                                                <button type="submit" class="btn btn-primary">
                                                {{changeDynamic('Pay Via '.$gateway->gateway_name)}}</button>
                                            </form>
                                        </div>

                                </div>
                            </div>
                        @endforeach


                        @if ($razorpay->razorpay_status == 1)
                            <div class="col-md-4 mt-4">
                                <div class="thumbnail">
                                    <div class="image-area">
                                        <img src="{{ getFile('gateways' , $razorpay->image) }}"
                                        alt="Lights" class="w-100 gateway-image">
                                    </div>
                                    <div class="caption text-center mt-3">
                                        <form action="{{ route('user.pay.with.razorpay', $booking->id) }}" method="POST" >
                                            @csrf
                                            @php
                                                $booking_amount = $booking->amount;
                                                $payableAmount = round($booking_amount * $razorpay->currency_rate,2);
                                            @endphp
                                            <script src="https://checkout.razorpay.com/v1/checkout.js"
                                                    data-key="{{ $razorpay->razorpay_key }}"
                                                    data-currency="{{ $razorpay->currency_code }}"
                                                    data-amount= "{{ $payableAmount * 100 }}"
                                                    data-buttontext="{{changeDynamic('Pay')}} {{ $payableAmount }} {{ $razorpay->currency_code }}"
                                                    data-name="{{ $razorpay->name }}"
                                                    data-description="{{ $razorpay->description }}"
                                                    data-image="{{ asset($razorpay->image) }}"
                                                    data-prefill.name=""
                                                    data-prefill.email=""
                                                    data-theme.color="{{ $razorpay->theme_color }}">
                                            </script>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        @endif


                        @if ($flutterwave->status == 1)
                            <div class="col-md-4 mt-4">
                                <div class="thumbnail">
                                    <div class="image-area">
                                        <img src="{{ getFile('gateways' , $flutterwave->logo) }}"
                                        alt="Lights" class="w-100 gateway-image">
                                    </div>
                                    <div class="caption text-center mt-3">
                                        <button onclick="paywithFlutterwave()" type="submit" class="btn btn-primary">
                                            {{changeDynamic('Pay Via Flutterwave')}}</button>

                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($paystack->status == 1)
                            <div class="col-md-4 mt-4">
                                <div class="thumbnail">
                                    <div class="image-area">
                                        <img src="{{ getFile('gateways' , $paystack->image) }}"
                                        alt="Lights" class="w-100 gateway-image">
                                    </div>
                                    <div class="caption text-center mt-3">
                                        <button type="button" onclick="payWithPaystack()" class="btn btn-primary">
                                            {{changeDynamic('Pay Via Paystack')}}</button>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($mollie->status == 1)
                            <div class="col-md-4 mt-4">
                                <div class="thumbnail">
                                    <div class="image-area">
                                        <img src="{{ getFile('gateways' , $mollie->image) }}"
                                        alt="Lights" class="w-100 gateway-image">
                                    </div>
                                    <div class="caption text-center mt-3">
                                        <a href="{{ route('user.mollie-payment',$booking->id) }}" class="btn btn-primary">
                                            {{changeDynamic('Pay Via Mollie')}}</a>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($instamojo->status == 1)
                            <div class="col-md-4 mt-4">
                                <div class="thumbnail">
                                    <div class="image-area">
                                        <img src="{{ getFile('gateways' , $instamojo->image) }}"
                                        alt="Lights" class="w-100 gateway-image">
                                    </div>
                                    <div class="caption text-center mt-3">
                                        <a href="{{ route('user.pay-with-instamojo',$booking->id) }}" class="btn btn-primary">
                                            {{changeDynamic('Pay Via Instamojo')}}</a>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($paymongo->status == 1)
                            <div class="col-md-4 mt-4">
                                <div class="thumbnail">
                                    <div class="image-area">
                                        <img src="{{ getFile('gateways' , $paymongo->image) }}"
                                        alt="Lights" class="w-100 gateway-image">
                                    </div>
                                    <div class="caption text-center mt-3">
                                        <a href="{{ route('user.paymongo',$booking->id) }}" class="btn btn-primary">
                                            {{changeDynamic('Pay Via Paymongo')}}</a>
                                    </div>
                                </div>
                            </div>
                        @endif


                    </div>

                </div>
            </div>


        </div>

    </div>

@php
    $booking_amount = $booking->amount;

    // start paystack
    $public_key = $paystack->public_key;
    $currency = $paystack->currency_code;
    $currency = strtoupper($currency);

    $ngn_amount = $booking_amount * $paystack->currency_rate;
    $ngn_amount = $ngn_amount * 100;
    $ngn_amount = round($ngn_amount);
    // end paystack

    // start fluttewave
    $payable_amount = $booking_amount * $flutterwave->currency_rate;
    $payable_amount = round($payable_amount, 2);
@endphp


@php

@endphp

@endsection

@push('custom-style')

<style>
    .image-area{
       height:300px;
    }
    .gateway-image{
        width:100%;
        height:100%;
        object-fit:cover;
    }


</style>

@endpush

@push('custom-script')
<script src="https://js.paystack.co/v1/inline.js"></script>
<script src="https://checkout.flutterwave.com/v3.js"></script>
<script>
    function paywithFlutterwave() {
      FlutterwaveCheckout({
        public_key: "{{ $flutterwave->public_key }}",
        tx_ref: "RX1",
        amount: {{ $payable_amount }},
        currency: "{{ $flutterwave->currency_code }}",
        country: "{{ $flutterwave->country_code }}",
        payment_options: " ",
        customer: {
          email: "{{ $user->email }}",
          phone_number: "{{ $user->phone }}",
          name: "{{ $user->name }}",
        },
        callback: function (data) {
            var tnx_id = data.transaction_id;
            var _token = "{{ csrf_token() }}";
            var booking_id = '{{ $booking->id }}';
            $.ajax({
                type: 'post',
                data : {tnx_id,_token,booking_id},
                url: "{{ route('user.pay.with.flutterwave') }}",
                success: function (response) {
                    if(response.status == 'success'){
                        window.location.href = "{{ route('user.bookings') }}";
                    }else{
                        window.location.reload();
                    }
                },
                error: function(err) {}
            });

        },
        customizations: {
          title: "{{ $flutterwave->title }}",
          logo: "{{ getFile('gateways' , $flutterwave->logo) }}",
        },
      });
    }



function payWithPaystack(){
    var booking_id = '{{ $booking->id }}';
    var handler = PaystackPop.setup({
        key: '{{ $public_key }}',
        email: '{{ $user->email }}',
        amount: '{{ $ngn_amount }}',
        currency: "{{ $currency }}",
        callback: function(response){
        let reference = response.reference;
        let tnx_id = response.transaction;
        let _token = "{{ csrf_token() }}";
        $.ajax({
            type: "post",
            data: {reference, tnx_id, _token, booking_id},
            url: "{{ route('user.pay.with.paystack') }}",
            success: function(response) {
                if(response.status == 'success'){
                    window.location.href = "{{ route('user.bookings') }}";
                }else{
                    window.location.reload();
                }
            }
        });
        },
        onClose: function(){
            alert('window closed');
        }
    });
    handler.openIframe();
}

</script>
@endpush
