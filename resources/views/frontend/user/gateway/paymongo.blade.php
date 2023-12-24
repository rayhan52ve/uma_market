@extends('frontend.layout.master')
@section('breadcrumb')
 <section class="section">
          <div class="section-header">

            <h1>@changeLang('Paymongo Payment')</h1>



          </div>
</section>
@endsection
@section('content')

    <div class="row">
      <div class="col-md-6 col-md-offset-3">
            <div class="card credit-card-box">
                <div class="card-header text-center">
                    <h5>@changeLang('Payment Preview')</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">

                        <li class="list-group-item d-flex justify-content-between">
                            <span>@changeLang('Service Name'):</span>
                            <span>{{$booking->service->name}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>@changeLang('Amount'):</span>
                            <span>{{$booking->amount.' '.$general->site_currency}}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <span>@changeLang('Conversion Rate'):</span>
                            <span>{{"1 $general->site_currency = " . number_format($gateway->currency_rate,4).' '.$gateway->currency_code}}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <span>@changeLang('Total Payable Amount'):</span>
                            <span>{{ round(($booking->amount * $gateway->currency_rate)).' '.$gateway->currency_code}}</span>
                        </li>



                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-md-offset-3">
            <div class="card credit-card-box">

                <div class="card-body">

                    <a data-toggle="modal" data-target="#modelId" class="btn btn-primary" href="javascirpt:;">@changeLang('Card Payment')</a>
                    <a class="btn btn-primary" href="{{ route('user.pay-with-grab-pay', $booking->id) }}">@changeLang('GrabPay')</a>
                    <a class="btn btn-primary" href="{{ route('user.pay-with-gcash', $booking->id) }}">@changeLang('GCash')</a>

                </div>
            </div>
        </div>
    </div>

    </div>


    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">@changeLang('Pay with Paymongo')</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form role="form" action="{{ route('user.pay-with-paymongo', $booking->id) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class='form-group col-md-12'>
                                <div class='col-12 form-group card'>
                                    <label class='control-label'>@changeLang('Card Number')</label> <input autocomplete='off'
                                        class='form-control' size='20' type='text' name="card_number" required>
                                </div>

                                <div class='col-12 form-group cvc'>
                                    <label class='control-label'>@changeLang('CVC')</label> <input autocomplete='off'
                                        class='form-control'  size='4' type='text' name="cvc" required>
                                </div>
                                <div class='col-12 form-group expiration'>
                                    <label class='control-label'>@changeLang('Expiration Month')</label> <input
                                        class='form-control'  size='2' type='text' name="month" required>
                                </div>
                                <div class='col-12 form-group expiration'>
                                    <label class='control-label'>@changeLang('Expiration Year')</label> <input
                                        class='form-control' name="year"  size='4' type='text' required>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button class="btn btn-primary btn-lg btn-block" type="submit">@changeLang('Pay Now')</button>
                            </div>
                        </div>

                    </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
