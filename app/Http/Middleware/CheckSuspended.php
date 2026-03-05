<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckSuspended
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->is_suspended) {
            auth()->logout();
            return redirect()->route('login')
                             ->withErrors(['email' => 'Votre compte a été suspendu.']);
        }

        return $next($request);
    }
}
