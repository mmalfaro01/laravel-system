<?php
namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SocialLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'password' => bcrypt(uniqid()), // temp password
            ]
        );

        Auth::login($user);

        return redirect()->route('home');
    }

    public function redirectToFacebook()
{
    return Socialite::driver('facebook')->redirect();
}

public function handleFacebookCallback()
{
    try {
        $facebookUser = Socialite::driver('facebook')->stateless()->user();

        $user = User::firstOrCreate(
            ['email' => $facebookUser->getEmail()],
            [
                'name' => $facebookUser->getName(),
                'password' => bcrypt(uniqid()), // optional, just a dummy value
                'provider' => 'facebook',
                'provider_id' => $facebookUser->getId(),
            ]
        );

        Auth::login($user);

        return redirect()->route('home');

    } catch (\Exception $e) {
        return redirect()->route('login')->with('error', 'Failed to login with Facebook.');
    }
}
}
