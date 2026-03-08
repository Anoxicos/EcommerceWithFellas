<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                             ->with('error', 'Vous devez être connecté.');
        }

        if (Auth::user()->is_suspended) {
            Auth::logout();
            return redirect()->route('login')
                             ->with('error', 'Votre compte a été suspendu.');
        }

        return $next($request);
    }
}
