<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class LoginController extends Controller
{
    public function index()
    {


        return redirect()->route('home');
        $pageTitle = 'Login Page';

        return view('frontend.auth.login', compact('pageTitle'));
    }

    public function login(Request $request)
    {
        $general  = GeneralSetting::first();
        $request->validate([
            'mobile' => 'required|min:11',
            'password' => 'required',
            'g-recaptcha-response' => Rule::requiredIf($general->allow_recaptcha == 1)
        ], [
            'g-recaptcha-response.required' => 'You Have To fill recaptcha'
        ]);


        $user = User::where('mobile', $request->mobile)->first();

        if (!$user) {
            $notify[] = ['error', 'No user found associated with this mobile'];
            return redirect()->back()->withNotify($notify);
        }

        // if ($user->ev == 0) {

        //     $code = random_int(100000, 999999);

        //     session()->put('user', $user->id);

        //     sendMail('VERIFY_EMAIL',['code' => $code],$user);

        //     $user->verification_code = $code;

        //     $user->save();

        //     $notify[] = ['error','Please active your account, Verification code send to your email'];

        //     return redirect()->route('user.email.verify')->withNotify($notify);
        // }

        if (Auth::attempt($request->except('g-recaptcha-response', '_token'))) {
            if ($user->mobile_verified_at == null) {
                Auth::logout();
                $code = random_int(100000, 999999);
                $user->verification_code = $code;
                $user->save();

                //sms congigurtion start
                $this->sendVerificationcode($user, $code);
                //sms configuration end

                $user->mobile_otp_expire_at = Carbon::now()->addMinute(5);
                $user->save();
                $notify[] = ['success', 'Mobile verificatio send successfully'];

                // return redirect()->route('home')->withNotify($notify); 
                return redirect('user/mobile-otp-verification/' . $user->link_token)->withNotify($notify);
            } else {
                if ($user->status == 0) {
                    Auth::logout();
                    $notify[] = ['error', 'Your account disabled or waiting for approval. For more information, Please contact administrator.'];
                    return redirect()->route('home')->withNotify($notify);
                } else {
                    $notify[] = ['success', 'Successfully logged in'];

                    return redirect()->back()
                        ->withNotify($notify);
                }
            }
        }

        $notify[] = ['error', 'Invalid Credentials'];
        return redirect()->route('home')->withNotify($notify);
    }

    private function sendVerificationcode($user, $code)
    {
        $url = env('url');
        $api_key = env('api_key');
        $senderid = env('senderid');
        $number = $user->mobile;
        $message = "Your Umamarket verification code is:" . ' ' . $code;

        $data = [
            "api_key" => $api_key,
            "senderid" => $senderid,
            "number" => $number,
            "message" => $message
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
    }


    public function emailVerify()
    {
        $pageTitle = "Email Verify";

        return view('frontend.auth.email', compact('pageTitle'));
    }

    public function emailVerifyConfirm(Request $request)
    {
        $request->validate(['code' => 'required']);

        $user = User::findOrFail(session('user'));

        if ($request->code == $user->verification_code) {
            $user->verification_code = null;
            $user->ev = 1;
            $user->save();

            Auth::login($user);

            $notify[] = ['success', 'Successfully verify your account'];

            return redirect()->route('user.dashboard')->withNotify($notify);
        }

        $notify[] = ['error', 'Invalid Code'];

        return back()->withNotify($notify);
    }
}
