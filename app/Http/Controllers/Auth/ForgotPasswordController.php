<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        $pageTitle = 'Forgot Password';

        return view('frontend.auth.forgot_password', compact('pageTitle'));
    }

    public function sendVerification(Request $request)
    {
        $general = GeneralSetting::first();
        $request->validate([
            'mobile' => 'required',
            'g-recaptcha-response'=>Rule::requiredIf($general->allow_recaptcha== 1)
        ],[
            'g-recaptcha-response.required' => 'You Have To fill recaptcha'
        ]);

        $user = User::where('mobile', $request->mobile)->first();


        if (!$user) {
            $notify[] = ['error', 'Please Provide a Valid Phone Number'];
            return back()->withNotify($notify);
        }

        $code = random_int(100000, 999999);

        $user->verification_code = $code;

        $user->save();

        $this->sendVerificationcode($user, $code);

        // sendMail('PASSWORD_RESET', ['code' => $code],  $user);

        session()->put('mobile',$user->mobile);


        $notify[] = ['success', 'Sent verification code to your Phone'];
        return redirect()->route('user.auth.verify')->withNotify($notify);
    }

    public function verify()
    {
        $mobile = session('mobile');

        $pageTitle = 'Verify Code';

        $user = User::where('mobile', $mobile)->first();

        if (!$user) {
            return redirect()->route('user.forgot.password');
        }

        // dd($mobile);
        return view('frontend.auth.verify', compact('pageTitle', 'mobile'));
    }

    public function verifyCode(Request $request)
    {
        $general = GeneralSetting::first();
        $request->validate([
            'code' => 'required',
            'mobile' => 'required|exists:users,mobile',
            'g-recaptcha-response'=>Rule::requiredIf($general->allow_recaptcha== 1)
        ],[
            'g-recaptcha-response.required' => 'You Have To fill recaptcha'
        ]);

        $user = User::where('mobile', $request->mobile)->first();


        $token = $user->verification_code;

        if ($user->verification_code != $request->code) {

            $user->verification_code = null;

            $user->save();

            $notify[] = ['error','Invalid Code'];

            return back()->withNotify($notify);
        }

        $user->verification_code = null;

        $user->save();

        session()->put('identification', [
            "token" => $token,
            "mobile" => $user->mobile
        ]);

        return redirect()->route('user.reset.password');
    }

    public function reset()
    {
        $session = session('identification');

        if (!$session) {

            return redirect()->route('user.login');
        }

        $pageTitle = 'Reset Password';

        return view('frontend.auth.reset', compact('pageTitle', 'session'));
    }

    public function resetPassword(Request $request)
    {
        $general = GeneralSetting::first();
        $request->validate([
            'mobile' => 'required|exists:users,mobile', 
            'password' => 'required|confirmed',
            'g-recaptcha-response'=>Rule::requiredIf($general->allow_recaptcha == 1)
        ],[
            'g-recaptcha-response.required' => 'You Have To fill recaptcha'
        ]
        );

        $user = User::where('mobile', $request->mobile)->first();

        $user->password = bcrypt($request->password);

        $user->save();

        $notify[] = ['success', 'Successfully Reset Your Password'];

        return redirect()->route('user.login')->withNotify($notify);
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

    
    public function mobileVerification(Request $request, $token)
    {
        $user = User::where('link_token', $token)->first();
        $pageTitle = 'Mobile Verification';

        return view('frontend.user.varification.mobileverification', compact('pageTitle', 'user'));
    }

    public function mobileVerifed(Request $request)
    {
        $user = User::where('link_token', $request->link_token)->where('mobile_otp_expire_at', '<=', date('Y-m-s H:i:s'))->first();

        if (!$user) {
            return redirect()->back();
        } else {
            if ($request->verification_code ==  $user->verification_code) {
                $user->update([
                    'mobile_verified_at' => Carbon::now(),
                    'mobile_otp_expire_at' => null,
                    'verification_code' => null,
                ]);

                $notify[] = ['success', 'Verified successfully!'];
                Auth::login($user);
                return redirect()->intended('user/dashboard')->withNotify($notify);
            } else {
                $notify[] = ['error', 'Verification code invalid or wrong. plese insert valid otp code.'];
                return redirect('user/mobile-otp-verification/' . $user->link_token)->withNotify($notify);
            }
        }
    }

    public function mobileotpresend(Request $request)
    {
        $user = User::where('link_token', $request->link_token)->where('mobile_verified_at', null)->first();

        if ($user) {
            $code = random_int(100000, 999999);
            $user->verification_code = $code;
            $user->save();

            //sms congigurtion start
            $this->sendVerificationcode($user, $code);
            //sms configuration end

            $user->mobile_otp_expire_at = Carbon::now()->addMinute(5);
            $user->save();
            $notify[] = ['success', 'Resent verification code successfully'];
            return redirect('user/mobile-otp-verification/' . $user->link_token)->withNotify($notify);
        } else {
            return redirect('login');
        }
    }

}
