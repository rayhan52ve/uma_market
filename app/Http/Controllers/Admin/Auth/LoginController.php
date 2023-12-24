<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller{

    public function __construct()
    {
        $this->middleware('admin.guest')->except('logout');
    }

    public function login()
    {
        $pageTitle  = 'Admin Login';

        return view('admin.auth.login',compact('pageTitle'));
    }

    public function loggedIn(Request $request)
    {
      
        $credentials = $request->validate([
            'email' => 'required|email|max:80',
            'password' => 'required'
        ]);



        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }
        elseif (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->user_type == 3) {
                return redirect()->route('employee.dashboard');
            } elseif ($user->user_type == 4) {
                return redirect()->route('agent.dashboard');
            } else {
                
            }
        }
        else {
            return redirect()->back();
        }
    

        $notify[] = ['error','Invalid Credentials'];
        return back()->withNotify($notify);

    }

    public function logout(Request $request)
    {
        auth()->guard('admin')->logout();
        return redirect()->route('admin.login');
    }

}
