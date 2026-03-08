<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class LoginController extends Controller
{
    public function showForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');
        $remember    = $request->boolean('remember');

        if (!Auth::attempt($credentials, $remember)) {
            return back()
                ->withInput($request->only('email'))
                ->with('error', 'Email ou mot de passe incorrect.');
        }

        // Block suspended accounts right after login
        if (Auth::user()->is_suspended) {
            Auth::logout();
            return back()->with('error', 'Votre compte a été suspendu.');
        }

        $request->session()->regenerate();

        // Redirect admin to dashboard, others to home
        /** @var User $user */
            $user = Auth::user();

        if ($user->isAdmin()) {
            return redirect()->route('admin.products.index');
        }

        return redirect()->intended(route('home'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
