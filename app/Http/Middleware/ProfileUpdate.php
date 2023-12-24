<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Models\UserDetail;
use Closure;
use Illuminate\Http\Request;

class ProfileUpdate
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
        $user = auth()->user();
        $user_details = UserDetail::where('user_id', $user->id)->first();

        // if(($user->user_type == 1) && (($user_details == '') || ($user_details->country == null || $user_details->city == null || $user_details->state == null || $user_details->zip == null || $user_details->address == null))){
        //     $notify[] = ['error','Please Update profile First'];
        //     return redirect()->route('user.profile')->withNotify($notify);
        // }
       
        // if(($user->user_type == 2) && (($user_details == '') || ($user_details->provider_category == null || $user_details->provider_type == null || $user_details->nid_no == null || $user_details->nid_front == null || $user_details->nid_back == null))){
        //     $notify[] = ['error','Please Update profile First'];
        //     return redirect()->route('user.profile')->withNotify($notify);
        // }
        return $next($request);
    }
}
