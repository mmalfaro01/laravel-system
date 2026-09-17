<?php

namespace App\Http\Controllers\Driver\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('driver.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('driver')->attempt($credentials, $request->filled('remember'))) {
            $user = Auth::guard('driver')->user();

            if ($user && $user->role === 'driver') {
                $request->session()->regenerate();
                return redirect()->route('driver.dashboard');
            }

            Auth::guard('driver')->logout();
            return back()->withErrors([
                'email' => 'You are not authorized to access the driver portal.',
            ])->withInput();
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('driver')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('driver.login');
    }
}
