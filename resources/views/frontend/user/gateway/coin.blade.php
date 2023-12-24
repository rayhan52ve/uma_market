@extends('frontend.layout.master')
@section('breadcrumb')
 <section class="section">
          <div class="section-header">
        
            <h1>@changeLang('Coin Payment')</h1>
      
          
        
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
                            <span>{{"1 $general->site_currency = " . number_format($gateway->rate,4).' '.$gateway->gateway_parameters->gateway_currency}}</span>
                        </li>
                        
                       
                        
                        <li class="list-group-item d-flex justify-content-between">
                            <span>@changeLang('Total Payable Amount'):</span>
                            <span>{{ ($booking->amount * $gateway->rate).' '.$gateway->gateway_parameters->gateway_currency}}</span>
                        </li> 
                        
                        

                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-md-offset-3">
            <div class="card credit-card-box">

                <div class="card-body">


                    <form role="form" action="{{ route('user.coin.post',[$booking,$gateway]) }}" method="post">
                        @csrf
                        <div class="row">

                        <div class='form-group col-md-12'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>@changeLang('Email')</label> 
                                <input class='form-control' type='text' name="email">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
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
