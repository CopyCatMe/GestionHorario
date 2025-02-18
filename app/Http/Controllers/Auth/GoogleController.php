<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;


class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $findUser = User::where('email', $googleUser->email)->first();

            if (!$findUser) {
                $findUser = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => Hash::make('default') // Contraseña temporal
                ]);
            }

            // Iniciar sesión
            Auth::login($findUser, true);

            if (Hash::check('default', $findUser->password)) {
                return redirect()->route('password.set')->with('warning', 'Debes establecer una nueva contraseña.');
            }

            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Error con Google: ' . $e->getMessage());
        }
    }
}
