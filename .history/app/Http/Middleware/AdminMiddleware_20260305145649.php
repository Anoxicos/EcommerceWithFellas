<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        public function handle($request, Closure $next)
{
    if (!Auth::user()?->isAdmin()) {
        abort(403, 'Accès refusé. Réservé aux administrateurs.');
    }

    return $next($request);
}


        if (Auth::user()->is_suspended) {
            abort(403, 'Votre compte est suspendu.');
        }

        return $next($request);
    }
}
