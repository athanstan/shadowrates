<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle the callback from Google.
     */
    public function handleGoogleCallback()
    {
        try {
            // Get user data from Google
            $googleUser = Socialite::driver('google')->user();

            // Generate avatar URL if needed
            $avatarStyle = config('services.dicebear.style');
            $apiUrl = config('services.dicebear.api_url');
            $seed = Str::random(10);
            $avatarUrl = "{$apiUrl}/{$avatarStyle}/svg?seed={$seed}";

            // Update or create user
            $user = User::updateOrCreate(
                [
                    'email' => $googleUser->getEmail()
                ],
                [
                    'name' => $googleUser->getName(),
                    'provider_name' => 'google',
                    'provider_id' => $googleUser->getId(),
                    'provider_token' => $googleUser->token,
                    'avatar' => fn($attributes) => $attributes['avatar'] ?? $avatarUrl,
                    'email_verified_at' => now(),
                ]
            );

            // Log the user in
            Auth::login($user, true);

            // Redirect to the intended page or home
            return redirect()->intended('/');
        } catch (Exception $e) {
            // Handle errors during authentication
            return redirect()->route('login')->with('error', 'Google authentication failed. Please try again.');
        }
    }
}
