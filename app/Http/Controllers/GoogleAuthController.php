<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $google_user = Socialite::driver('google')->user();

            info(json_encode($google_user));

            $user = User::where('google_id', $google_user->id)->first();

            if ($user) {
                info('User found, logging in');
                Auth::login($user);

                return redirect('/');
            } else {
                info('User not found, creating new user');
                $new_user = new User();
                $new_user->name = $google_user->name;
                $new_user->email = $google_user->email;
                $new_user->google_id = $google_user->id;
                $new_user->save();

                Auth::login($new_user);

                return redirect('/');
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function authCheck()
    {
        dd(Auth::user());
    }
}
