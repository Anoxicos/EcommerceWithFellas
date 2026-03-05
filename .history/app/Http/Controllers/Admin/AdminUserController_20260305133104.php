<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,customer',
        ]);

        // Prevent demoting yourself
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Vous ne pouvez pas modifier votre propre rôle.');
        }

        $user->update(['role' => $request->role]);
        return back()->with('success', 'Rôle mis à jour.');
    }

    public function toggleSuspend(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Vous ne pouvez pas suspendre votre propre compte.');
        }

        $user->update(['is_suspended' => !$user->is_suspended]);

        $msg = $user->is_suspended ? 'Compte suspendu.' : 'Compte réactivé.';
        return back()->with('success', $msg);
    }
}
