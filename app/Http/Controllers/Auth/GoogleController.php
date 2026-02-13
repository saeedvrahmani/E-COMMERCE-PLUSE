<?php

namespace App\Http\Controllers\Auth;


use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Socialite;
use function Modules\User\Http\Controllers\Auth\updateOrCreate;

class GoogleController extends Controller
{
    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback():RedirectResponse
    {
        $googleUer = Socialite::driver('google')->user();
        $user = updateOrCreate([
            'email' => $googleUer->getEmail()
        ],
            [
                'name' => $googleUer->getName(),
                'google_id' => $googleUer->getId(),
                'password' => bcrypt(Str::random(16)),
            ]
        );
        Auth::login($user);
        return redirect('home');
    }
}
