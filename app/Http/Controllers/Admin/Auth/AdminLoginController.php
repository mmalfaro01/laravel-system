<?php
namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
            $user = Auth::guard('admin')->user();
            
            // Check if the authenticated user is an admin
            if ($user && $user->is_admin == 1) {
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
            }

            // If not an admin, logout and show error
            Auth::guard('admin')->logout();
            return back()->withErrors([
                'email' => 'You are not authorized to access the admin panel.',
            ])->withInput();
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->withInput();
    }

    public function logout(Request $request)
{
    Auth::guard('admin')->logout();

    // Invalidate session and regenerate CSRF token
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('admin.login');
}

}
