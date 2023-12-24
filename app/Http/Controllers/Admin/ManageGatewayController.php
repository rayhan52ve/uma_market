<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Gateway;
use App\Models\GeneralSetting;
use App\Models\Transaction;
use App\Models\RazorpayPayment;
use App\Models\FlutterwavePayment;
use App\Models\InstamojoPayment;
use App\Models\MolliePayment;
use App\Models\PaystackPayment;
use App\Models\CurrencyCountry;
use App\Models\PaymongoPayment;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ManageGatewayController extends Controller
{
    public function bank()
    {
        $pageTitle = 'Bank Payment';

        $gateway = Gateway::where('gateway_name', 'bank')->first();

        return view('admin.gateways.bank',compact('pageTitle','gateway'));
    }

    public function bankUpdate(Request $request)
    {

        $gateway = Gateway::where('gateway_name', 'bank')->first();

        $request->validate([
            "name" => 'required',
            "account_number" => 'required',
            "routing_number" => 'required',
            "branch_name" => 'required',
            "user_proof_param" => 'sometimes|array',
            'bank_image' => [Rule::requiredIf(function()use ($gateway){return $gateway == null;}),'image','mimes:jpg,png,jpeg'],
            'status' => 'required',
            'rate'=> 'required',
            'charge' => 'required',
            'gateway_currency' => 'required'
        ]);



        $gatewayParameters= [
            'name' => $request->name,
            'account_number' => $request->account_number,
            'routing_number' => $request->routing_number,
            'branch_name' => $request->branch_name,
            'gateway_currency' => $request->gateway_currency
        ];


       if($gateway){
        if($request->hasFile('bank_image')){
            $filename = uploadImage($request->bank_image,filePath('gateways'), $gateway->gateway_image );
        }


        $gateway->update([
            'gateway_image' => $filename ?? $gateway->gateway_image,
            'gateway_parameters' => $gatewayParameters,
            'user_proof_param' => $request->user_proof_param,
            'status' => $request->status,
            'rate' => $request->rate,
            'charge' => $request->charge
        ]);



        $notify[] = ['success', "Bank Setting Updated Successfully"];

        return redirect()->back()->withNotify($notify);

       }


       if($request->hasFile('bank_image')){
            $filename = uploadImage($request->bank_image,filePath('gateways'));
        }


        Gateway::create([
            'gateway_name' => 'bank',
            'gateway_image' => $filename,
            'gateway_parameters' => $gatewayParameters,
            'user_proof_param' => $request->user_proof_param,
            'gateway_type' => 0,
            'status' => $request->status,
            'rate' => $request->rate,
            'charge' => $request->charge
        ]);


        $notify[] = ['success', "Bank Setting Updated Successfully"];

        return redirect()->back()->withNotify($notify);






    }

    public function paypal()
    {
        $pageTitle = 'Paypal Payment';

        $gateway = Gateway::where('gateway_name', 'paypal')->first();

        return view('admin.gateways.paypal',compact('pageTitle','gateway'));
    }


    public function paypalUpdate(Request $request)
    {
       $gateway = Gateway::where('gateway_name', 'paypal')->first();

       $request->validate([
           'gateway_currency' => 'required',
           'paypal_client_id' => 'required',
           'paypal_client_secret' => 'required',
           'paypal_image' => [Rule::requiredIf(function() use($gateway){ return $gateway == null ;})],
           'status' => 'required',
           'mode' => 'required',
           'rate'=> 'required'
       ]);

       $data = [
        'gateway_currency' => $request->gateway_currency,
        'paypal_client_id' => $request->paypal_client_id,
        'paypal_client_secret' => $request->paypal_client_secret,
        'mode' => $request->mode
       ];


       if($gateway){
           if($request->hasFile('paypal_image')){
               $filename = uploadImage($request->paypal_image,filePath('gateways'), $gateway->gateway_image );
           }


           $gateway->update([
               'gateway_image' => $filename ?? $gateway->gateway_image,
               'gateway_parameters' => $data,
               'gateway_type' => 1,
               'status' => $request->status,
               'rate' => $request->rate
           ]);


           $notify[] = ['success', "Paypal Setting Updated Successfully"];

           return redirect()->back()->withNotify($notify);

       }


       if($request->hasFile('paypal_image')){
            $filename = uploadImage($request->paypal_image,filePath('gateways'));
        }



       Gateway::create([
            'gateway_name' => 'paypal',
            'gateway_image' => $filename  ,
            'gateway_parameters' => $data,
            'gateway_type' => 1,
            'status' => $request->status,
            'rate' => $request->rate,

       ]);


       $notify[] = ['success', "Paypal Setting Updated Successfully"];

       return redirect()->back()->withNotify($notify);
    }

    public function coin()
    {
        $pageTitle = 'Coin Payment';

        $gateway = Gateway::where('gateway_name', 'coin')->first();

        return view('admin.gateways.coin',compact('pageTitle','gateway'));
    }


    public function coinUpdate(Request $request)
    {
        $gateway = Gateway::where('gateway_name', 'coin')->first();

        $request->validate([
            'gateway_currency' => 'required',
            'public_key' => 'required',
            'private_key' => 'required',
            'merchant_id' => 'required',
            'coin_image' => [Rule::requiredIf(function() use($gateway){ return $gateway == null ;}),'image','mimes:jpg,png,jpeg'],
            'status' => 'required',
            'rate'=> 'required',

        ]);

        $data = [
            'gateway_currency' => $request->gateway_currency,
            'public_key' => $request->public_key,
            'private_key' => $request->private_key,
            'merchant_id' => $request->merchant_id
           ];


           if($gateway){
               if($request->hasFile('coin_image')){
                   $filename = uploadImage($request->coin_image,filePath('gateways'), $gateway->gateway_image );
               }


               $gateway->update([
                   'gateway_image' => $filename ?? $gateway->gateway_image,
                   'gateway_parameters' => $data,
                   'gateway_type' => 1,
                   'status' => $request->status,
                   'rate' => $request->rate,

               ]);


               $notify[] = ['success', "CoinPayment Setting Updated Successfully"];

               return redirect()->back()->withNotify($notify);

           }


           if($request->hasFile('coin_image')){
                $filename = uploadImage($request->coin_image,filePath('gateways'));
            }



           Gateway::create([
                'gateway_name' => 'coin',
                'gateway_image' => $filename,
                'gateway_parameters' => $data,
                'gateway_type' => 1,
                'status' => $request->status,
                'rate' => $request->rate,

           ]);


           $notify[] = ['success', "CoinPayment Setting Updated Successfully"];

           return redirect()->back()->withNotify($notify);
    }


    public function stripe()
    {
        $pageTitle = 'Stripe Payment';

        $gateway = Gateway::where('gateway_name', 'stripe')->first();

        return view('admin.gateways.stripe',compact('pageTitle','gateway'));
    }


    public function stripeUpdate(Request $request)
    {
        $gateway = Gateway::where('gateway_name', 'stripe')->first();

        $request->validate([
            'gateway_currency' => 'required',
            'stripe_client_id' => 'required',
            'stripe_client_secret' => 'required',
            'stripe_image' => [Rule::requiredIf(function() use($gateway){ return $gateway == null ;}),'image','mimes:jpg,png,jpeg'],
            'status' => 'required',
            'rate'=> 'required',

        ]);

        $data = [
            'gateway_currency' => $request->gateway_currency,
            'stripe_client_id' => $request->stripe_client_id,
            'stripe_client_secret' => $request->stripe_client_secret,
           ];


           if($gateway){
               if($request->hasFile('stripe_image')){
                   $filename = uploadImage($request->stripe_image,filePath('gateways'), $gateway->gateway_image );
               }


               $gateway->update([
                   'gateway_image' => $filename ?? $gateway->gateway_image,
                   'gateway_parameters' => $data,
                   'gateway_type' => 1,
                   'status' => $request->status,
                   'rate' => $request->rate,

               ]);


               $notify[] = ['success', "Stripe Setting Updated Successfully"];

               return redirect()->back()->withNotify($notify);

           }


           if($request->hasFile('stripe_image')){
                $filename = uploadImage($request->stripe_image,filePath('gateways'));
            }



           Gateway::create([
                'gateway_name' => 'stripe',
                'gateway_image' => $filename  ,
                'gateway_parameters' => $data,
                'gateway_type' => 1,
                'status' => $request->status,
                'rate' => $request->rate,

           ]);


           $notify[] = ['success', "Stripe Setting Updated Successfully"];

           return redirect()->back()->withNotify($notify);
    }


    public function vouguepay()
    {
        $pageTitle = 'Vouguepay Payment';

        $gateway = Gateway::where('gateway_name', 'vouguepay')->first();

        return view('admin.gateways.vouguepay',compact('pageTitle','gateway'));
    }

    public function vouguepayUpdate(Request $request)
    {
        $gateway = Gateway::where('gateway_name', 'vouguepay')->first();

        $request->validate([
            'gateway_currency' => 'required',
            'vouguepay_merchant_id' => 'required',
            'vouguepay_image' => [Rule::requiredIf(function() use($gateway){ return $gateway == null ;}),'image','mimes:jpg,png,jpeg'],
            'status' => 'required'
        ]);

        $data = [
            'gateway_currency' => $request->gateway_currency,
            'vouguepay_merchant_id' => $request->vouguepay_merchant_id
           ];


           if($gateway){
               if($request->hasFile('vouguepay_image')){
                   $filename = uploadImage($request->vouguepay_image,'admin/images/gateways','200x200', $gateway->gateway_image );
               }


               $gateway->update([
                   'gateway_image' => $filename ?? $gateway->gateway_image,
                   'gateway_parameters' => $data,
                   'gateway_type' => 1,
                   'status' => $request->status
               ]);


               $notify[] = ['success', "VouguePay Setting Updated Successfully"];

               return redirect()->back()->withNotify($notify);

           }


           if($request->hasFile('vouguepay_image')){
                $filename = uploadImage($request->vouguepay_image,'admin/images/gateways','200x200');
            }



           Gateway::create([
                'gateway_name' => 'vouguepay',
                'gateway_image' => $filename  ,
                'gateway_parameters' => $data,
                'gateway_type' => 1,
                'status' => $request->status
           ]);


           $notify[] = ['success', "VouguePay Setting Updated Successfully"];

           return redirect()->back()->withNotify($notify);
    }

    public function manualPayment()
    {
        $pageTitle = "Manual Payments";

        $manuals = Booking::where('payment_type',0)->latest()->with('service','user')->paginate();

        return view('admin.manual_payments.index',compact('pageTitle','manuals'));
    }

    public function manualPaymentDetails (Request $request)
    {
        $pageTitle = "Payment Details";

        $manual = Booking::where('trx',$request->trx)->firstOrFail();

        return view('admin.manual_payments.details',compact('pageTitle','manual'));
    }

    public function manualPaymentAccept(Request $request)
    {
        $booking = Booking::where('trx', $request->trx)->firstOrFail();
        $general = GeneralSetting::first();
        $gateway = Gateway::where('gateway_name','bank')->first();

        $booking->payment_confirmed = 1;
        $booking->save();

        $adminCommision = ($booking->amount * $general->commission) / 100;

        $admin = auth()->guard('admin')->user();

        $admin->wallet = $admin->wallet + $adminCommision;

        $admin->save();

        $userAmount = $booking->amount - $adminCommision;

        $booking->service->user->balance = $booking->service->user->balance + $userAmount;
        $booking->service->user->save();


        Transaction::create([
            'trx' => $booking->trx,
            'user_id' => $booking->user_id,
            'service_id' => $booking->service_id,
            'amount' => $booking->amount,
            'currency' => $general->site_currency,
            'details' => 'Payment Accepted for '.$booking->service->name,
            'charge' => $gateway->charge,
            'type' => '-'
        ]);

        Transaction::create([
            'trx' => $booking->trx,
            'user_id' => $booking->service->user->id,
            'service_id' => $booking->service_id,
            'amount' => $booking->amount,
            'currency' => $general->site_currency,
            'details' => 'Paid for '.$booking->service->name,
            'charge' => $gateway->charge,
            'type' => '+'
        ]);

        sendMail('PAYMENT_CONFIRMED',['trx'=>$booking->trx,'amount'=>$booking->amount,'charge' => number_format($booking->charge,4),'service'=>$booking->name,'currency' => $general->site_currency ], $booking->user);

        sendMail('PAYMENT_RECEIVED',['trx'=>$booking->trx,'amount'=>$userAmount,'charge' => number_format($booking->charge,4),'service'=>$booking->name,'currency' => $general->site_currency], $booking->service->user);


        $notify[] = ['success', "Payment Confirmed Successfully"];

        return redirect()->back()->withNotify($notify);

    }

    public function manualPaymentReject(Request $request)
    {
        $manual = Booking::where('trx', $request->trx)->firstOrFail();
        $general = GeneralSetting::first();

        $manual->payment_confirmed = 3;

        $manual->save();


        sendMail('PAYMENT_REJECTED',['trx'=>$manual->trx,'amount'=>$manual->amount,'charge' => $manual->charge,'service'=>$manual->name,'currency' => $general->site_currency ], $manual->user);

        $notify[] = ['success', "Payment Rejected Successfully"];

        return redirect()->back()->withNotify($notify);

    }


    public function razorpay()
    {
        $pageTitle = 'Razorpay Payment';

        $razorpay = RazorpayPayment::first();
        $countires = CurrencyCountry::orderBy('name','asc')->get();
        $currencies = Currency::orderBy('name','asc')->get();
        $setting = GeneralSetting::first();

        return view('admin.gateways.razorpay',compact('pageTitle','razorpay','countires','currencies','setting'));
    }


    public function razorpayUpdate(Request $request)
    {
        $razorpay = RazorpayPayment::first();

        $rules = [
            'razorpay_key'=>'required',
            'razorpay_secret'=>'required',
            'name'=>'required',
            'description'=>'required',
            'razorpay_status'=>'required',
            'country_code'=>'required',
            'currency_code'=>'required',
            'currency_rate'=>'required|numeric',
        ];

        $this->validate($request, $rules);



       if($razorpay){
           if($request->hasFile('razorpay_image')){
               $filename = uploadImage($request->razorpay_image,filePath('gateways'), $razorpay->image );
               $razorpay->image=$filename;
           }

            $razorpay->razorpay_key=$request->razorpay_key;
            $razorpay->secret_key=$request->razorpay_secret;
            $razorpay->name=$request->name;
            $razorpay->description=$request->description;
            $razorpay->theme_color=$request->theme_color;
            $razorpay->currency_rate=$request->currency_rate;
            $razorpay->country_code=$request->country_code;
            $razorpay->currency_code=$request->currency_code;
            $razorpay->razorpay_status=$request->razorpay_status;
            $razorpay->save();

           $notify[] = ['success', "Razorpay Setting Updated Successfully"];

           return redirect()->back()->withNotify($notify);
       }

    }


    public function flutterwave()
    {
        $pageTitle = 'Flutterwave Payment';

        $flutterwave = FlutterwavePayment::first();
        $countires = CurrencyCountry::orderBy('name','asc')->get();
        $currencies = Currency::orderBy('name','asc')->get();
        $setting = GeneralSetting::first();

        return view('admin.gateways.flutterwave',compact('pageTitle','flutterwave','countires','currencies','setting'));
    }

    public function flutterwaveUpdate(Request $request)
    {
        $flutterwave = FlutterwavePayment::first();

        $rules = [
            'public_key'=>'required',
            'secret_key'=>'required',
            'title'=>'required',
            'status'=>'required',
            'country_code'=>'required',
            'currency_code'=>'required',
            'currency_rate'=>'required|numeric',
        ];

        $this->validate($request, $rules);



       if($flutterwave){
           if($request->hasFile('flutterwave_image')){
               $filename = uploadImage($request->flutterwave_image,filePath('gateways'), $flutterwave->logo );
               $flutterwave->logo=$filename;
           }

           $flutterwave->public_key = $request->public_key;
           $flutterwave->secret_key = $request->secret_key;
           $flutterwave->title = $request->title;
           $flutterwave->status = $request->status;
           $flutterwave->country_code=$request->country_code;
           $flutterwave->currency_code=$request->currency_code;
           $flutterwave->currency_rate=$request->currency_rate;
           $flutterwave->save();

           $notify[] = ['success', "Flutterwave Setting Updated Successfully"];

           return redirect()->back()->withNotify($notify);
       }

    }

    public function paystack()
    {
        $pageTitle = 'Paystack Payment';

        $paystack = PaystackPayment::first();
        $countires = CurrencyCountry::orderBy('name','asc')->get();
        $currencies = Currency::orderBy('name','asc')->get();
        $setting = GeneralSetting::first();

        return view('admin.gateways.paystack',compact('pageTitle','paystack','countires','currencies','setting'));
    }

    public function paystackUpdate(Request $request)
    {
        $paystack = PaystackPayment::first();

        $rules = [
            'public_key' => 'required',
            'secret_key' => 'required',
            'currency_rate' => 'required|numeric',
            'currency_code' => 'required',
            'country_code' =>'required'
        ];

        $this->validate($request, $rules);


       if($paystack){
           if($request->hasFile('paystack_image')){
               $filename = uploadImage($request->paystack_image,filePath('gateways'), $paystack->image );
               $paystack->image=$filename;
           }

           $paystack->public_key = $request->public_key;
           $paystack->secret_key = $request->secret_key;
           $paystack->status = $request->status;
           $paystack->country_code=$request->country_code;
           $paystack->currency_code=$request->currency_code;
           $paystack->currency_rate=$request->currency_rate;
           $paystack->save();

           $notify[] = ['success', "Paystack Setting Updated Successfully"];

           return redirect()->back()->withNotify($notify);
       }

    }

    public function mollie()
    {
        $pageTitle = 'Mollie Payment';

        $mollie = MolliePayment::first();
        $countires = CurrencyCountry::orderBy('name','asc')->get();
        $currencies = Currency::orderBy('name','asc')->get();
        $setting = GeneralSetting::first();

        return view('admin.gateways.mollie',compact('pageTitle','mollie','countires','currencies','setting'));
    }

    public function mollieUpdate(Request $request)
    {
        $mollie = MolliePayment::first();

        $rules = [
            'mollie_key' => 'required',
            'currency_rate' => 'required|numeric',
            'currency_code' => 'required',
            'country_code' =>'required'
        ];

        $this->validate($request, $rules);


       if($mollie){
           if($request->hasFile('mollie_image')){
               $filename = uploadImage($request->mollie_image,filePath('gateways'), $mollie->image );
               $mollie->image=$filename;
           }

           $mollie->mollie_key = $request->mollie_key;
           $mollie->status = $request->status;
           $mollie->country_code=$request->country_code;
           $mollie->currency_code=$request->currency_code;
           $mollie->currency_rate=$request->currency_rate;

           $mollie->save();

           $notify[] = ['success', "Mollie Setting Updated Successfully"];

           return redirect()->back()->withNotify($notify);
       }

    }

    public function instamojo()
    {
        $pageTitle = 'Instamojo Payment';

        $instamojo = InstamojoPayment::first();
        $countires = CurrencyCountry::orderBy('name','asc')->get();
        $currencies = Currency::orderBy('name','asc')->get();
        $setting = GeneralSetting::first();

        return view('admin.gateways.instamojo',compact('pageTitle','instamojo','countires','currencies','setting'));
    }

    public function instamojoUpdate(Request $request)
    {
        $instamojo = InstamojoPayment::first();

        $rules = [
            'account_mode' => 'required',
            'api_key' => 'required',
            'auth_token' =>'required',
            'currency_rate' =>'required|numeric',
        ];

        $this->validate($request, $rules);


       if($instamojo){
           if($request->hasFile('instamojo_image')){
               $filename = uploadImage($request->instamojo_image,filePath('gateways'), $instamojo->image );
               $instamojo->image=$filename;
           }

           $instamojo->account_mode = $request->account_mode;
            $instamojo->api_key = $request->api_key;
            $instamojo->auth_token = $request->auth_token;
            $instamojo->currency_rate = $request->currency_rate;
            $instamojo->status = $request->status;
            $instamojo->save();

           $notify[] = ['success', "Instamojo Setting Updated Successfully"];

           return redirect()->back()->withNotify($notify);
       }

    }


    public function paymongo(){
        $paymongo = PaymongoPayment::first();
        $pageTitle = 'Paymongo Payment';
        $countires = CurrencyCountry::orderBy('name','asc')->get();
        $currencies = Currency::orderBy('name','asc')->get();
        $setting = GeneralSetting::first();

        return view('admin.gateways.paymongo',compact('pageTitle','paymongo','countires','currencies','setting'));

    }

    public function paymongoUpdate(Request $request){
        $paymongo = PaymongoPayment::first();

        $rules = [
            'public_key'=>'required',
            'secret_key'=>'required',
            'status'=>'required',
            'country_code'=>'required',
            'currency_code'=>'required',
            'currency_rate'=>'required|numeric',
        ];

        $this->validate($request, $rules);



       if($paymongo){
           if($request->hasFile('paymongo_image')){
               $filename = uploadImage($request->paymongo_image,filePath('gateways'), $paymongo->image );
               $paymongo->image=$filename;
           }

           $paymongo->public_key = $request->public_key;
           $paymongo->secret_key = $request->secret_key;
           $paymongo->status = $request->status;
           $paymongo->country_code=$request->country_code;
           $paymongo->currency_code=$request->currency_code;
           $paymongo->currency_rate=$request->currency_rate;
           $paymongo->save();

           $notify[] = ['success', "Paymongo Setting Updated Successfully"];

           return redirect()->back()->withNotify($notify);

        }
    }




}
