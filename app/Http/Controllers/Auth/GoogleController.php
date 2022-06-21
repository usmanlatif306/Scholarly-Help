<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\SuccessfullLoginNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        $finduser = User::where('google_id', $user->id)->first();

        if ($finduser) {

            Auth::login($finduser);

            return redirect()->url('/dashboard');
        } else {
            $password = Str::random(10);
            $newUser = User::create([
                'first_name' => $user->name,
                'last_name' => $user->name,
                'email' => $user->email,
                'email_verified_at' => now(),
                'google_id' => $user->id,
                'password' => Hash::make($password),
                'role_id'       => 3,
                'photo' => 'uploads/avatars/user.jpg',
            ]);

            // if user is created then send verification email
            if ($newUser) {
                $newUser->notify(new SuccessfullLoginNotification($newUser));
            }

            Auth::login($newUser);

            return redirect()->url('/dashboard');
        }
    }
}
