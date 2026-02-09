<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    private function loginOrRegister(string $email)
    {
        $user = User::firstOrCreate( // firstOrCreate = Cari data | kalau data ditemukan maka pakai | jika tidak buat data baru dengan format dibawah 
            ["email" => $email],
            ["email_verified_at" => now()]
        );
        Auth::login($user);
        return redirect()->intended('/');
    }

    public function callbackGoogle()
    {
            $googleUser = Socialite::driver('google')->user();
            return $this->loginOrRegister($googleUser->email);
    }

    public function redirectGoogle()
    {
        // if (auth()->check()) {
        //     return redirect(session('oauth_intended', '/'));
        // }
        return Socialite::driver('google')->redirect();
    }

    public function callbackGithub()
    {
        $githubUser = Socialite::driver('github')->user();
        return $this->loginOrRegister($githubUser->email);
    }
    public function redirectGithub()
    {
        return Socialite::driver('github')->redirect();
    }
}
