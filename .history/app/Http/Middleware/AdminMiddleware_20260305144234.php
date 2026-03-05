<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Mod\Request;


class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!Auth::User::isAdmin()) {
            abort(403, 'Accès refusé. Réservé aux administrateurs.');
        }

        if (Auth::user()->is_suspended) {
            abort(403, 'Votre compte est suspendu.');
        }

        return $next($request);
    }
}
