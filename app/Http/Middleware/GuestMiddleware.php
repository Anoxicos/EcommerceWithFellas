<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class GuestMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Redirect already-logged-in users away from login/register
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}