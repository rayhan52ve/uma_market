<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Inactive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->status == 0){
            Auth::logout();
            $notify[] = ['error','You Account Is Inactive or waitiong for approval'];
            return redirect()->route('user.login')->withNotify($notify);
        }
        return $next($request);
    }
}
