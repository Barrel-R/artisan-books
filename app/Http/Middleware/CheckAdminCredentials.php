<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdminCredentials
{
    public function handle(Request $request, Closure $next)
    {
        // Skip this middleware on login-related routes
        if ($request->is('login') || $request->is('logout')) {
            return $next($request);
        }

        // // Check if logged in and session hasn't expired
        // if (!session()->has('admin_logged_in') || !session('admin_logged_in')) {
        //     return redirect('/login');
        // }

        return $next($request);
    }
}
