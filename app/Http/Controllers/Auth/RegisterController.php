<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\GeneralSetting;
use App\Models\User;
use App\Models\UserDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function index()
    {

        // $divisions = Division::all();
        return redirect()->route('home');
        $pageTitle = 'Register User';

        return view('frontend.auth.register', compact('pageTitle'));
    }

    public function register(Request $request)
    {
        if ($request->user_type == 1) {
            $general = GeneralSetting::first();

            $request->validate([
                'user_type' => 'required|in:1,2',
                'fname' => 'required',
                'email' => 'nullable|email|unique:users',
                'mobile' => 'required|unique:users',
                'password' => 'required',
                'referral' => 'nullable',
                'division_id' => 'required',
                'district_id' => 'nullable',
                'upazila_id' => 'nullable',
                'union_id' => 'nullable',
                'g-recaptcha-response' => Rule::requiredIf($general->allow_recaptcha == 1)
            ], [
                'fname.required' => 'First name is required',
                'g-recaptcha-response.required' => 'You Have To fill recaptcha'
            ]);

            $slug = Str::slug($request->username);

            if ($request->referral) {
                $userReferral = User::where('referral', $request->referral)->first();
                if ($userReferral) {
                    $user = $this->create($request, $slug);
                    $user->referral = $request->referral;
                    $user->save();
                    $code = random_int(100000, 999999);
                    // sendMail('VERIFY_EMAIL',['code' => $code],$user);
                    session()->put('user', $user->id);
                    // $user->status = 1;
                    $user->link_token = Str::random(24);
                    $user->verification_code = $code;
                    $user->save();
                    //sms congigurtion start
                    $this->sendVerificationcode($user, $code);
                    //sms configuration end
                    $user->mobile_otp_expire_at = Carbon::now()->addMinute(5);
                    $user->save();
                    $notify[] = ['success', 'Registration Successful. Mobile verification code sent'];
                    return redirect('user/mobile-otp-verification/' . $user->link_token)->withNotify($notify);
                } else {
                    $notify[] = ['error', 'Referral code does not mach'];
                    return redirect()->back()->withNotify($notify);
                }
            } else {
                $user = $this->create($request, $slug);
                $code = random_int(100000, 999999);
                // sendMail('VERIFY_EMAIL',['code' => $code],$user);
                session()->put('user', $user->id);
                // $user->status = 1;
                $user->link_token = Str::random(24);
                $user->verification_code = $code;
                $user->save();
                //sms congigurtion start
                $this->sendVerificationcode($user, $code);
                //sms configuration end
                $user->mobile_otp_expire_at = Carbon::now()->addMinute(5);
                $user->save();
                // $notify[] = ['success','A code Send to your email'];
                $notify[] = ['success', 'Registration Successful. Mobile verification code sent'];
                // return redirect()->route('home')->withNotify($notify);
                return redirect('user/mobile-otp-verification/' . $user->link_token)->withNotify($notify);
            }
        } else {
            $user_details = new UserDetail();
            $general = GeneralSetting::first();

            $request->validate([
                'user_type' => 'required|in:1,2',
                'fname' => 'required',
                // 'lname' => 'required',
                // 'username' => 'required|unique:users',
                'email' => 'nullable|email|unique:users',
                'mobile' => 'required|unique:users',
                'division_id' => 'required',
                'district_id' => 'nullable',
                'upazila_id' => 'nullable',
                'union_id' => 'nullable',
                'nid_no' => 'required',
                'nid_front' => 'required|image|mimes:jpg,png,jpeg',
                'nid_back' => 'required|image|mimes:jpg,png,jpeg',
                'password' => 'required',
                'referral' => 'nullable',
                'g-recaptcha-response' => Rule::requiredIf($general->allow_recaptcha == 1)
            ], [
                'fname.required' => 'First name is required',
                // 'lname.required' => 'Last name is required',
                'g-recaptcha-response.required' => 'You Have To fill recaptcha'
            ]);

            $slug = Str::slug($request->username);


            if ($request->referral) {
                $userreferrel = User::where('referral', $request->referral)->first();
                if ($userreferrel) {
                    $user = $this->create($request, $slug);
                    $user_details->user_id = $user->id;
                    $user_details->nid_no = $request->nid_no;
                    if ($request->hasFile('nid_front')) {
                        $filename = uploadImage($request->nid_front, filePath('user_details'), $user->nid_front);
                        $user_details->nid_front = $filename;
                    }

                    if ($request->hasFile('nid_back')) {
                        $filename = uploadImage($request->nid_back, filePath('user_details'), $user->nid_back);
                        $user_details->nid_back = $filename;
                    }

                    $user_details->save();
                    $user->referral = $request->referral;
                    $user->save();
                    $code = random_int(100000, 999999);
                    // sendMail('VERIFY_EMAIL',['code' => $code],$user);
                    session()->put('user', $user->id);
                    $user->link_token = Str::random(24);
                    $user->verification_code = $code;
                    $user->save();
                    //sms congigurtion start
                    $this->sendVerificationcode($user, $code);
                    //sms configuration end
                    $user->mobile_otp_expire_at = Carbon::now()->addMinute(5);
                    $user->save();
                    // $notify[] = ['success','A code Send to your email'];
                    $notify[] = ['success', 'Registration Successful. Mobile verification code sent'];
                    // return redirect()->route('home')->withNotify($notify);
                    return redirect('user/mobile-otp-verification/' . $user->link_token)->withNotify($notify);
                } else {
                    $notify[] = ['error', 'Referral code does not mach'];

                    return redirect()->back()->withNotify($notify);
                }
            } else {
                $user = $this->create($request, $slug);
                $user_details->user_id = $user->id;
                $user_details->nid_no = $request->nid_no;
                if ($request->hasFile('nid_front')) {
                    $filename = uploadImage($request->nid_front, filePath('user_details'), $user->nid_front);
                    $user_details->nid_front = $filename;
                }

                if ($request->hasFile('nid_back')) {
                    $filename = uploadImage($request->nid_back, filePath('user_details'), $user->nid_back);
                    $user_details->nid_back = $filename;
                }

                $user_details->save();
                $code = random_int(100000, 999999);
                // sendMail('VERIFY_EMAIL',['code' => $code],$user);
                session()->put('user', $user->id);
                $user->link_token = Str::random(24);
                $user->verification_code = $code;
                $user->save();
                //sms congigurtion start
                $this->sendVerificationcode($user, $code);
                //sms configuration end
                $user->mobile_otp_expire_at = Carbon::now()->addMinute(5);
                $user->save();
                // $notify[] = ['success','A code Send to your email'];
                $notify[] = ['success', 'Registration Successful. Mobile verification code sent'];
                // return redirect()->route('home')->withNotify($notify);
                return redirect('user/mobile-otp-verification/' . $user->link_token)->withNotify($notify);
            }
        }
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
        // $data = json_decode($response, true);
        // $responseCode = $data['response_code'];
        // dd($data );
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

            $user->mobile_otp_expire_at = Carbon::now()->addMinute(1);
            $user->save();
            $notify[] = ['success', 'Resent verification code successfully'];
            return redirect('user/mobile-otp-verification/' . $user->link_token)->withNotify($notify);
        } else {
            return redirect('login');
        }
    }

    public function dashboard()
    {
        if (auth()->check()) {
            return view('frontend.user.dashboard');
        }

        return redirect()->route('user.login')->withSuccess('You are not allowed to access');
    }

    public function create($request, $slug)
    {

        return User::create([
            'user_type' => $request->user_type,
            'fname' => $request->fname,
            // 'lname' => $request->lname,
            // 'username' => $request->username,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'upazila_id' => $request->upazila_id,
            'union_id' => $request->union_id,
            'created_by' => $request->referral,
            'password' => bcrypt($request->password),
            'slug' => $slug,
            'status' => 1,

        ]);
    }

    public function signOut()
    {
        Auth::logout();

        return Redirect()->route('home');
    }
}
