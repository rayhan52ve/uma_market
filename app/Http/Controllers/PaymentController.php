<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Booking;
use App\Models\Gateway;
use App\Models\GeneralSetting;
use App\Models\Transaction;
use App\Models\RazorpayPayment;
use App\Models\FlutterwavePayment;
use App\Models\InstamojoPayment;
use App\Models\MolliePayment;
use App\Models\PaystackPayment;
use App\Models\PaymongoPayment;
use App\Models\CurrencyCountry;
use App\Models\Currency;
use Illuminate\Http\Request;
use Stripe;
use Str;
use Razorpay\Api\Api;
use Exception;
use Redirect;
use Session;
use Mollie\Laravel\Facades\Mollie;

use App\Http\Controllers\Admin\Gateways\CoinPaymentsAPI;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use WpOrg\Requests\Auth;
use App\Models\TripInfo;
use Illuminate\Support\Facades\DB;


class PaymentController extends Controller
{
    public function gateways(Booking $booking)
    {

        if ($booking->payment_confirmed) {
            $notify[] = ['error', 'Already Made Payment for this service'];

            return redirect()->route('user.bookings')->withNotify($notify);
        }
        $gateways = Gateway::where('status', 1)->get();

        $pageTitle = "Payment Gateways";

        $razorpay = RazorpayPayment::first();
        $flutterwave = FlutterwavePayment::first();
        $paystack = PaystackPayment::first();
        $mollie = MolliePayment::first();
        $instamojo = InstamojoPayment::first();
        $paymongo = PaymongoPayment::first();
        $user = Auth::guard('web')->user();
        return view('frontend.user.gateway.payment', compact('gateways', 'pageTitle', 'booking', 'razorpay', 'flutterwave', 'paystack', 'mollie', 'instamojo', 'user', 'paymongo'));
    }

    public function payment(Request $request, Booking $booking)
    {
        $request->validate([
            'gateway' => 'required|exists:gateways,id',
        ]);

        $gateway = Gateway::findOrFail($request->gateway);

        $pageTitle = ucwords($gateway->gateway_name) . " Payment";


        return view("frontend.user.gateway.{$gateway->gateway_name}", compact('gateway', 'pageTitle', 'booking', 'gateway'));
    }

    public function paymongoPage($booking_id)
    {
        $booking = Booking::find($booking_id);

        $pageTitle = "Paymongo Payment";

        $gateway = PaymongoPayment::first();


        return view("frontend.user.gateway.paymongo", compact('gateway', 'pageTitle', 'booking'));
    }

    public function payWithRazorpay(Request $request, $booking_id)
    {

        $razorpay = RazorpayPayment::first();
        $input = $request->all();
        $api = new Api($razorpay->razorpay_key, $razorpay->secret_key);
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        if (count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));
                $payId = $response->id;
                $user = Auth::guard('web')->user();
                $booking = Booking::find($booking_id);

                $booking_amount = $booking->amount;
                $fee_amount = $booking_amount;
                $transaction = $request->razorpay_payment_id;
                self::updateUserData($booking, $fee_amount, $transaction);

                $notify[] = ['success', 'Payment Successfully Done'];
                return redirect()->route('user.bookings')->withNotify($notify);
            } catch (Exception $e) {
                $notify[] = ['error', 'Something Goes Wrong'];
                return redirect()->route('user.bookings')->withNotify($notify);
            }
        }
    }


    public function payWithFlutterwave(Request $request)
    {
        $flutterwave = FlutterwavePayment::first();
        $curl = curl_init();
        $tnx_id = $request->tnx_id;
        $url = "https://api.flutterwave.com/v3/transactions/$tnx_id/verify";
        $token = $flutterwave->secret_key;
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer $token"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);
        if ($response->status == 'success') {
            $user = Auth::guard('web')->user();
            $booking = Booking::find($request->booking_id);

            $booking_amount = $booking->amount;
            $fee_amount = $booking_amount;
            $transaction = $request->tnx_id;
            self::updateUserData($booking, $fee_amount, $transaction);

            $notify[] = ['success', 'Payment Successfully Done'];
            return response()->json(['status' => 'success', 'message' => $notify]);
        } else {
            $notify[] = ['error', 'Something Goes Wrong'];
            return response()->json(['status' => 'error', 'message' => $notify]);
        }
    }


    public function payWithPaystack(Request $request)
    {
        $paystack = PaystackPayment::first();
        $reference = $request->reference;
        $transaction = $request->tnx_id;
        $secret_key = $paystack->secret_key;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/$reference",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $secret_key",
                "Cache-Control: no-cache",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $final_data = json_decode($response);
        if ($final_data->status == true) {
            $user = Auth::guard('web')->user();
            $booking = Booking::find($request->booking_id);
            $booking_amount = $booking->amount;
            $fee_amount = $booking_amount;
            $transaction = $transaction;
            self::updateUserData($booking, $fee_amount, $transaction);
            $notify[] = ['success', 'Payment Successfully Done'];
            return response()->json(['status' => 'success', 'message' => $notify]);
        }
    }


    public function molliePayment($booking_id)
    {
        $mollie = MolliePayment::first();
        $user = Auth::guard('web')->user();

        $booking = Booking::find($booking_id);
        $booking_amount = $booking->amount;

        $payableAmount = round($booking_amount * $mollie->currency_rate);

        $payableAmount = number_format($payableAmount, 2);
        $mollie_api_key = $mollie->mollie_key;
        $currency = strtoupper($mollie->currency_code);
        Mollie::api()->setApiKey($mollie_api_key);
        $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => $currency,
                'value' => '' . $payableAmount . '',
            ],
            'description' => env('APP_NAME'),
            'redirectUrl' => route('user.mollie-payment-success'),
        ]);

        $payment = Mollie::api()->payments()->get($payment->id);
        session()->put('payment_id', $payment->id);
        session()->put('booking_id', $booking_id);
        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function molliePaymentSuccess(Request $request)
    {

        $mollie = MolliePayment::first();
        $mollie_api_key = $mollie->mollie_key;
        Mollie::api()->setApiKey($mollie_api_key);
        $payment = Mollie::api()->payments->get(session()->get('payment_id'));
        if ($payment->isPaid()) {
            $booking_id = Session::get('booking_id');
            $payment_id = Session::get('payment_id');

            $user = Auth::guard('web')->user();
            $booking = Booking::find($booking_id);

            $booking_amount = $booking->amount;
            $fee_amount = $booking_amount;
            $transaction = $payment_id;
            self::updateUserData($booking, $fee_amount, $transaction);

            $notify[] = ['success', 'Payment Successfully Done'];
            return redirect()->route('user.bookings')->withNotify($notify);
        } else {
            $notify[] = ['error', 'Something Goes Wrong'];
            return redirect()->route('user.bookings')->withNotify($notify);
        }
    }

    public function payWithInstamojo($booking_id)
    {

        $instamojoPayment = InstamojoPayment::first();
        $booking = Booking::find($booking_id);
        $user = Auth::guard('web')->user();
        $booking_amount = $booking->amount;
        $payableAmount = round($booking_amount * $instamojoPayment->currency_rate);
        $price = $payableAmount;
        $environment = $instamojoPayment->account_mode;
        $api_key = $instamojoPayment->api_key;
        $auth_token = $instamojoPayment->auth_token;

        if ($environment == 'Sandbox') {
            $url = 'https://test.instamojo.com/api/1.1/';
        } else {
            $url = 'https://www.instamojo.com/api/1.1/';
        }

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url . 'payment-requests/');
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                "X-Api-Key:$api_key",
                "X-Auth-Token:$auth_token"
            )
        );
        $payload = array(
            'purpose' => env("APP_NAME"),
            'amount' => $price,
            'phone' => '918160651749',
            'buyer_name' => Auth::user()->name,
            'redirect_url' => route('user.instamojo-response'),
            'send_email' => true,
            'webhook' => 'http://www.example.com/webhook/',
            'send_sms' => true,
            'email' => Auth::user()->email,
            'allow_repeated_payments' => false
        );
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);
        session()->put('booking_id', $booking_id);
        return redirect($response->payment_request->longurl);
    }

    public function instamojoResponse(Request $request)
    {

        $input = $request->all();

        $instamojoPayment = InstamojoPayment::first();
        $environment = $instamojoPayment->account_mode;
        $api_key = $instamojoPayment->api_key;
        $auth_token = $instamojoPayment->auth_token;

        if ($environment == 'Sandbox') {
            $url = 'https://test.instamojo.com/api/1.1/';
        } else {
            $url = 'https://www.instamojo.com/api/1.1/';
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . 'payments/' . $request->get('payment_id'));
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                "X-Api-Key:$api_key",
                "X-Auth-Token:$auth_token"
            )
        );
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if ($err) {
            $notify[] = ['error', 'Something Goes Wrong'];
            return redirect()->route('user.bookings')->withNotify($notify);
        } else {
            $data = json_decode($response);
        }

        if ($data->success == true) {
            if ($data->payment->status == 'Credit') {
                $booking_id = Session::get('booking_id');
                $payment_id = $request->get('payment_id');
                $booking = Booking::find($booking_id);

                $user = Auth::guard('web')->user();

                $booking_amount = $booking->amount;
                $fee_amount = $booking_amount;
                $transaction = $payment_id;
                self::updateUserData($booking, $fee_amount, $transaction);

                $notify[] = ['success', 'Payment Successfully Done'];
                return redirect()->route('user.bookings')->withNotify($notify);
            }
        }
    }

    public function stripePost(Request $request, Booking $booking, Gateway $stripe)
    {

        $general = GeneralSetting::first();

        $payingAmount = (int)($booking->amount * $stripe->rate);



        Stripe\Stripe::setApiKey($stripe->gateway_parameters->stripe_client_secret);



        $payment = Stripe\Charge::create([
            "amount" => $payingAmount * 100,
            "currency" => $stripe->gateway_parameters->gateway_currency,
            "source" => $request->stripeToken,
            "description" => "Payment For Booking {$booking->trx}"
        ]);

        $responseData = $payment->jsonSerialize();

        $transaction = $responseData['id'];

        $bal = \Stripe\BalanceTransaction::retrieve($responseData['balance_transaction']);

        $balJson = $bal->jsonSerialize();
        $fee_amount = number_format(($balJson['fee'] / 100), 4) /  $stripe->rate;

        if ($payment->status == 'succeeded') {
            self::updateUserData($booking, $fee_amount, $transaction);

            $notify[] = ['success', 'Payment Successfully Done'];
            return redirect()->route('user.bookings')->withNotify($notify);
        }

        $notify[] = ['error', 'Something Goes Wrong'];
        return redirect()->route('user.bookings')->withNotify($notify);
    }


    public static function updateUserData($booking, $fee_amount, $transaction)
    {
        $general = GeneralSetting::first();

        $booking->payment_confirmed = 1;

        $booking->save();

        $adminCommision = ($booking->amount * $general->commission) / 100;

        $admin = Admin::first();

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
            'details' => 'Payment Successfull for ' . $booking->service->name,
            'charge' => $fee_amount,
            'type' => '-',
            'commission' => $adminCommision,
            'gateway_transaction' => $transaction
        ]);

        Transaction::create([
            'trx' => $booking->trx,
            'user_id' => $booking->service->user->id,
            'service_id' => $booking->service_id,
            'amount' => $booking->amount,
            'currency' => $general->site_currency,
            'details' => 'Paid for ' . $booking->service->name,
            'charge' => $fee_amount,
            'type' => '+',
            'commission' => $adminCommision,
            'gateway_transaction' => $transaction
        ]);

        sendMail('PAYMENT_SUCCESSFULL', [
            'service' => $booking->service->name,
            'trx' => $transaction,
            'amount' => $booking->amount,
            'currency' =>    $general->site_currency
        ], $booking->user);

        sendMail('PAYMENT_RECEIVED', [
            'service' => $booking->service->name,
            'trx' => $transaction,
            'amount' => $userAmount,
            'currency' =>    $general->site_currency
        ], $booking->service->user);
    }


    public function paypalPost(Booking $booking, Gateway $paypal)
    {
        $controller = PaypalPaymentController::class;

        $totalAmount = $booking->amount * $paypal->rate;

        session()->put('trx', $booking->trx);

        $data = $controller::process($totalAmount, $paypal, $booking->trx);
        $data = json_decode($data);

        return redirect()->to($data->links[1]->href);
    }

    public function bankPayment(Request $request, Booking $booking, $gateway)
    {
        $gateway = Gateway::where('gateway_name', $gateway)->firstOrFail();

        $validation = [];
        if ($gateway->user_proof_param != null) {
            foreach ($gateway->user_proof_param as $params) {
                if ($params['type'] == 'text' || $params['type'] == 'textarea') {

                    $key = strtolower(str_replace(' ', '_', $params['field_name']));

                    $validationRules = $params['validation'] == 'required' ? 'required' : 'sometimes';

                    $validation[$key] = $validationRules;
                } else {

                    $key = strtolower(str_replace(' ', '_', $params['field_name']));

                    $validationRules = ($params['validation'] == 'required' ? 'required' : 'sometimes') . "|image|mimes:jpg,png,jpeg|max:2048";

                    $validation[$key] = $validationRules;
                }
            }
        }

        $data = $request->validate($validation);

        foreach ($data as $key => $upload) {

            if ($request->hasFile($key)) {

                $filename = uploadImage($upload, filePath('manual_payment'));

                $data[$key] = ['file' => $filename, 'type' => 'file'];
            }
        }

        $booking->payment_proof = $data;

        $booking->payment_type = 0;

        $booking->payment_confirmed = 2;

        $booking->charge = $gateway->charge;

        $booking->save();
        $notify[] = ['success', 'Your payment request has been taken.'];
        return redirect()->route('user.bookings')->withNotify($notify);
    }

    public function coinPost(Request $request, Booking $booking, Gateway $coinpayments)
    {

        $request->validate([
            'email' => 'required|email'
        ]);

        $totalAmount = $booking->amount * $coinpayments->rate;
        $cps = new CoinPaymentsAPI();

        $cps->Setup($coinpayments->gateway_parameters->private_key, $coinpayments->gateway_parameters->public_key);

        $req = array(
            'amount' => $totalAmount,
            'currency1' => $coinpayments->gateway_parameters->gateway_currency,
            'currency2' => 'BTC',
            'buyer_email' => $request->email,
            'custom' => $booking->trx,
            'item_name' => 'Pay For ' . $booking->service->name,
            'address' => '', // leave blank send to follow your settings on the Coin Settings page
            'ipn_url' => route('user.coin.pay'),
        );
        // See https://www.coinpayments.net/apidoc-create-transaction for all of the available fields

        $result = $cps->CreateTransaction($req);

        if ($result['error'] == 'ok') {
            $booking->btc_wallet = $result['result']['address'];
            $booking->btc_amount = $result['result']['amount'];
            $booking->btc_trx = $result['result']['txn_id'];
            $booking->save();

            return redirect()->to($result['result']['checkout_url']);
        } else {
            print 'Error: ' . $result['error'] . "\n";
        }
    }

    public function coinPay(Request $request)
    {
        $status = $request->status;
        $txn_id = $request->txn_id;
        $custom = $request->custom;
        $amount1 = floatval($request->amount1);
        $currency1 = $request->currency1;
        $coin = Gateway::where('gateway_name', 'coin')->first();
        $booking = Booking::where('trx', $custom)->first();

        if ($request->merchant != $coin->gateway_parameters->merchant_id) {
            $notify[] = ['error', 'Invalid Merchant Id'];
            return redirect()->route('user.bookings')->withNotify($notify);
        }

        if ($currency1 != $coin->gateway_parameters->gateway_currency) {
            $notify[] = ['error', 'Invalid Currency'];
            return redirect()->route('user.bookings')->withNotify($notify);
        }

        // Check amount against order total
        if ($amount1 < $booking->amount) {
            $notify[] = ['error', 'Invalid Amount'];
            return redirect()->route('user.bookings')->withNotify($notify);
        }

        if ($status >= 100 || $status == 2) {
            self::updateUserData($booking, 0, $txn_id);
            $notify[] = ['success', 'Payment Successfully Done'];
            return redirect()->route('user.bookings')->withNotify($notify);
        } else if ($status < 0) {
            //payment error, this is usually final but payments will sometimes be reopened if there was no exchange rate conversion or with seller consent
        } else {
            //payment is pending, you can optionally add a note to the order page
        }
    }

    public function payWithPaymongo(Request $request, $booking_id)
    {

        $user = Auth::guard('web')->user();

        $booking = Booking::find($booking_id);
        $booking_amount = $booking->amount;
        $paymongoPayment = PaymongoPayment::first();
        $payableAmount = round($booking_amount * $paymongoPayment->currency_rate);
        $total_price = $booking_amount;
        $price = $total_price * $paymongoPayment->currency_rate;
        $price = round($price);
        $currency_code = $paymongoPayment->currency_code;

        // create payment method
        require_once('vendor/autoload.php');
        $client = new \GuzzleHttp\Client();
        $card_number = $request->card_number;
        $cvc = $request->cvc;
        $month = $request->month;
        $year = $request->year;
        $code = base64_encode($paymongoPayment->public_key . ':' . $paymongoPayment->secret_key);

        try {
            $response = $client->request('POST', 'https://api.paymongo.com/v1/payment_methods', [
                'body' => '{"data":{"attributes":{"details":{"card_number":"' . $card_number . '","exp_month":' . $month . ',"exp_year":' . $year . ',"cvc":"' . $cvc . '"},"type":"card"}}}',
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Basic ' . $code . '',
                    'Content-Type' => 'application/json',
                ],
            ]);
        } catch (Exception $e) {
            $notify[] = ['error', 'Please provide valid card information'];
            return redirect()->back()->withNotify($notify);
        }


        $response = json_decode($response->getBody(), true);
        $payment_method_id = $response['data']['id'];

        if ($price < 100) {
            $notify[] = ['error', 'Amount cannot be less than 100₱'];
            return redirect()->back()->withNotify($notify);
        }

        $price = $price * 100;


        // create payment instant
        $client = new \GuzzleHttp\Client();
        $secret_code = base64_encode($paymongoPayment->secret_key);
        $response = $client->request('POST', 'https://api.paymongo.com/v1/payment_intents', [
            'body' => '{"data":{"attributes":{"amount":' . $price . ',"payment_method_allowed":["card"],"payment_method_options":{"card":{"request_three_d_secure":"any"}},"currency":"' . $currency_code . '","capture_type":"automatic"}}}',
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Basic ' . $secret_code . '',
                'Content-Type' => 'application/json',
            ],
        ]);

        $intent_response = json_decode($response->getBody(), true);
        $intent_client_key = $intent_response['data']['attributes']['client_key'];
        $intent_id = $intent_response['data']['id'];

        $client = new \GuzzleHttp\Client();

        // create payment
        $payment_response = $client->request('POST', 'https://api.paymongo.com/v1/payment_intents/' . $intent_id . '/attach', [
            'body' => '{"data":{"attributes":{"payment_method":"' . $payment_method_id . '","client_key":"' . $intent_client_key . '"}}}',
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Basic ' . $secret_code . '',
                'Content-Type' => 'application/json',
            ],
        ]);

        $payment_response = json_decode($response->getBody(), true);

        if ($payment_response['data']['attributes']['status'] != 'faild') {
            $booking_amount = $booking->amount;
            $fee_amount = $booking_amount;
            $transaction = $payment_response['data']['id'];
            self::updateUserData($booking, $fee_amount, $transaction);

            $notify[] = ['success', 'Payment Successfully Done'];
            return redirect()->route('user.bookings')->withNotify($notify);
        } else {
            $notify[] = ['error', 'Payment faild'];
            return redirect()->back()->withNotify($notify);
        }
    }


    public function payWithPaymongoGrabPay($booking_id)
    {
        $user = Auth::guard('web')->user();

        $booking = Booking::find($booking_id);
        $booking_amount = $booking->amount;
        $paymongoPayment = PaymongoPayment::first();
        $payableAmount = round($booking_amount * $paymongoPayment->currency_rate);
        $total_price = $booking_amount;
        $price = $total_price * $paymongoPayment->currency_rate;
        $price = round($price);
        $success_url = route('user.paymongo-payment-success');
        $faild_url = route('user.paymongo-payment-cancled');
        $currency_code = $paymongoPayment->currency_code;

        if ($price < 100) {
            $notify[] = ['error', 'Amount cannot be less than 100₱'];
            return redirect()->back()->withNotify($notify);
        }

        $price = $price * 100;

        require_once('vendor/autoload.php');
        $code = base64_encode($paymongoPayment->public_key . ':' . $paymongoPayment->secret_key);
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://api.paymongo.com/v1/sources', [
            'body' => '{"data":{"attributes":{"amount":' . $price . ',"redirect":{"success":"' . $success_url . '","failed":"' . $faild_url . '"},"type":"gcash","currency":"' . $currency_code . '"}}}',
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Basic ' . $code . '',
                'Content-Type' => 'application/json',
            ],
        ]);
        $response = json_decode($response->getBody(), true);


        session()->put('payment_id', $response['data']['id']);
        session()->put('booking_id', $booking_id);
        return redirect()->to($response['data']['attributes']['redirect']['checkout_url']);
    }

    public function payWithPaymongoGcash($booking_id)
    {
        $user = Auth::guard('web')->user();

        $booking = Booking::find($booking_id);
        $booking_amount = $booking->amount;
        $paymongoPayment = PaymongoPayment::first();
        $payableAmount = round($booking_amount * $paymongoPayment->currency_rate);
        $total_price = $booking_amount;
        $price = $total_price * $paymongoPayment->currency_rate;
        $price = round($price);
        $success_url = route('user.paymongo-payment-success');
        $faild_url = route('user.paymongo-payment-cancled');
        $currency_code = $paymongoPayment->currency_code;

        if ($price < 100) {
            $notify[] = ['error', 'Amount cannot be less than 100₱'];
            return redirect()->back()->withNotify($notify);
        }

        $price = $price * 100;

        require_once('vendor/autoload.php');
        $code = base64_encode($paymongoPayment->public_key . ':' . $paymongoPayment->secret_key);
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://api.paymongo.com/v1/sources', [
            'body' => '{"data":{"attributes":{"amount":' . $price . ',"redirect":{"success":"' . $success_url . '","failed":"' . $faild_url . '"},"type":"grab_pay","currency":"' . $currency_code . '"}}}',
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Basic ' . $code . '',
                'Content-Type' => 'application/json',
            ],
        ]);
        $response = json_decode($response->getBody(), true);


        session()->put('payment_id', $response['data']['id']);
        session()->put('booking_id', $booking_id);
        return redirect()->to($response['data']['attributes']['redirect']['checkout_url']);
    }

    public function paymongoPaymentSuccess(Request $request)
    {
        $booking_id = Session::get('booking_id');
        $payment_id = Session::get('payment_id');

        $user = Auth::guard('web')->user();
        $booking = Booking::find($booking_id);

        $booking_amount = $booking->amount;
        $fee_amount = $booking_amount;
        $transaction = $payment_id;
        self::updateUserData($booking, $fee_amount, $transaction);

        $notify[] = ['success', 'Payment Successfully Done'];
        return redirect()->route('user.bookings')->withNotify($notify);
    }

    public function paymongoPaymentCancled(Request $request)
    {
        $booking_id = Session::get('booking_id');
        $notify[] = ['error', 'Payment Faild'];
        return redirect()->route('user.paymongo', $booking_id)->withNotify($notify);
    }
    public function verifyPayment()
    {
        $verify = session('verify');
        $trip_id = $verify['trip_id'];
        $bidding_id = $verify['bidding_id'];
        $user_data = DB::connection('mysql_upay')
            ->table('payments')
            ->where('metadata', 'like', '%"user_id":' . auth()->id() . '%')
            ->where('metadata', 'like', '%"bidding_id":' . $bidding_id . '%')
            ->where('metadata', 'like', '%"order_id":"' . $trip_id . '"%')
            ->first();
            
        $details = [
            'payment_id' => $user_data->id,
            'trip_id' => $trip_id,
            'bidding_id' => $bidding_id,
        ];
        $data = [
            'trx' => $user_data->transaction_id,
            'gateway_transaction' => $user_data->payment_method,
            'commission' => $user_data->fee,
            'user_id' => auth()->id(),
            'service_id' =>  $bidding_id,
            'amount' => $user_data->amount,
            'currency' => 'BDT',
            'charge' => $user_data->charged_amount,
            'details' => json_encode($details),
            'type' => $user_data->method_type,

        ];

        // Create a new transaction record in the 'transactions' table
        Transaction::create($data);
        TripInfo::where('id', $trip_id)->update([
            'status' => 'completed'
        ]);
        return redirect()->route('user.transaction');
    }
}
