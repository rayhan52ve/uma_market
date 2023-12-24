<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckEmployeeRole
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        // Check if the user has the allowed roles
        if ($user && ($user->employee_role === 'Zone Manager' || $user->employee_role === 'Team Leader')) {
            return $next($request);
        }

        // Redirect or show an error message if the user doesn't have the allowed roles
        return redirect()->route('employee.dashboard'); // You can modify this based on your requirement
    }
}
