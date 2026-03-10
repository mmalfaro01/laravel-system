<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SocialLoginController extends Controller
{
    public function redirectToGoogle()
    {
        if (! config('services.google.client_id') || ! config('services.google.client_secret')) {
            return redirect()->route('login')
                ->with('error', 'Google login is not configured. Set GOOGLE_CLIENT_ID and GOOGLE_CLIENT_SECRET in .env.');
        }

        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        if (! config('services.google.client_id') || ! config('services.google.client_secret')) {
            return redirect()->route('login')->with('error', 'Google login is not configured.');
        }

        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'password' => bcrypt(uniqid()),
            ]
        );

        Auth::login($user);

        return redirect()->route('home');
    }

    public function redirectToFacebook()
    {
        if (! config('services.facebook.client_id') || ! config('services.facebook.client_secret')) {
            return redirect()->route('login')
                ->with('error', 'Facebook login is not configured. Set FACEBOOK_CLIENT_ID and FACEBOOK_CLIENT_SECRET in .env.');
        }

        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        if (! config('services.facebook.client_id') || ! config('services.facebook.client_secret')) {
            return redirect()->route('login')->with('error', 'Facebook login is not configured.');
        }

        try {
            $facebookUser = Socialite::driver('facebook')->stateless()->user();

            $user = User::firstOrCreate(
                ['email' => $facebookUser->getEmail()],
                [
                    'name' => $facebookUser->getName(),
                    'password' => bcrypt(uniqid()),
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
