<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Use the default user guard and check if admin
        if (Auth::attempt($credentials)) {
            if (auth()->user()->is_admin) {
                return redirect()->route('admin.dashboard'); // ✅ redirect here
            } else {
                Auth::logout();
                return redirect()->route('admin.login')->withErrors(['email' => 'Unauthorized.']);
            }
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
