<?php

// app/Http/Controllers/Auth/SocialiteController.php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Support\Str; // Untuk generate password acak jika diperlukan

class SocialiteController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Cari atau buat user baru
            $user = User::updateOrCreate(
                [
                    'provider_name' => 'google',
                    'provider_id' => $googleUser->getId(),
                ],
                [
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'avatar' => $googleUser->getAvatar(),
                    'email_verified_at' => now(), // Anggap email terverifikasi
                    // 'password' akan null karena sudah di-set nullable di migration & model
                    // Jika kolom password tidak nullable dan dibutuhkan, bisa generate random:
                    // 'password' => bcrypt(Str::random(24))
                ]
            );

            // Login-kan user
            Auth::login($user, true); // `true` untuk "remember me"

            // Redirect ke halaman setelah login (misalnya dashboard)
            return redirect()->intended('/dashboard'); // atau route('admin.dashboard')

        } catch (Exception $e) {
            // Tangani error, misalnya redirect ke halaman login dengan pesan error
            // Log errornya juga penting: Log::error($e->getMessage());
            return redirect()->route('login')->with('error', 'Gagal login dengan Google. Silakan coba lagi.');
        }
    }
}