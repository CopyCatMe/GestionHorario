<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();
    
        // Buscar usuario por external_id y Google
        $user = User::where('external_id', $googleUser->id)
                    ->where('external_auth', 'google')
                    ->first();
    
        if (!$user) {
            // Crear un nuevo usuario
            $user = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'avatar' => $googleUser->avatar,
                'external_id' => $googleUser->id,
                'external_auth' => 'google',
                'password_changed' => false, // Se fuerza a cambiar la contraseña
            ]);
    
            Auth::login($user);
            return redirect()->route('password.set'); // Si es nuevo, lo mandamos a cambiar la contraseña
        }
    
        // Si el usuario ya existe, iniciamos sesión
        Auth::login($user);
    
        // Si no ha cambiado su contraseña, redirigir a /password/set
        if (!$user->password_changed) {
            return redirect()->route('password.set');
        }
    
        // Si ya la cambió, redirigir al dashboard
        return redirect()->route('dashboard');
    }
    

    
}
