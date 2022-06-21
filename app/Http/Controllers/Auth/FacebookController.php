<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\SuccessfullLoginNotification;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class FacebookController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToFacebook()
    {
        // return Socialite::driver('facebook')->redirect();
        return Socialite::driver('microsoft')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleFacebookCallback()
    {
        // $user = Socialite::driver('facebook')->user();
        $user = Socialite::driver('microsoft')->user();
        dd($user);

        $finduser = User::where('facebook_id', $user->id)->first();

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
                'facebook_id' => $user->id,
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
