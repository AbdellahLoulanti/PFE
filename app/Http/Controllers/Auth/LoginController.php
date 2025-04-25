<?php

namespace App\Http\Controllers\Auth;

class LoginController extends Controller
{
    public function authenticated(Request $request, $user)
    {
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('member')) {
            return redirect()->route('member.dashboard');
        }

        return redirect('/');
    }
}
