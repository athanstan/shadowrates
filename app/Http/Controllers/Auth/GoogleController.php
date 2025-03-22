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

            // Find existing user or create a new one
            $user = User::where('provider_id', $googleUser->getId())
                ->orWhere('email', $googleUser->getEmail())
                ->first();

            if (!$user) {
                // Generate a random avatar using DiceBear
                $avatarStyle = config('services.dicebear.style');
                $apiUrl = config('services.dicebear.api_url');
                $seed = Str::random(10); // Random seed for the avatar
                $avatarUrl = "{$apiUrl}/{$avatarStyle}/svg?seed={$seed}";

                // Create new user
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'provider_name' => 'google',
                    'provider_id' => $googleUser->getId(),
                    'avatar' => $avatarUrl,
                    'email_verified_at' => now(), // Auto-verify email since it's from Google
                ]);
            } else {
                // Update user data if they already exist but are logging in with Google for the first time
                if (!$user->provider_id) {
                    $user->update([
                        'provider_name' => 'google',
                        'provider_id' => $googleUser->getId(),
                    ]);
                }

                // If user doesn't have an avatar yet, generate one
                if (!$user->avatar) {
                    $avatarStyle = config('services.dicebear.style');
                    $apiUrl = config('services.dicebear.api_url');
                    $seed = Str::random(10);
                    $avatarUrl = "{$apiUrl}/{$avatarStyle}/svg?seed={$seed}";

                    $user->update(['avatar' => $avatarUrl]);
                }
            }

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
