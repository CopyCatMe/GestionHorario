<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Mostrar el formulario para establecer la contraseña
    public function showSetPasswordForm()
    {
        return view('auth.set-password');
    }

    // Establecer la contraseña
    public function setPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión.');
        }

        $user = Auth::user();

        // Verificar si la contraseña es default
        if (!Hash::check('default', $user->password)) {
            // Si no es "default", redirige directamente al dashboard, señalando que el usuario ya esta registrado
            return redirect()->route('dashboard');
        }

        // Cambiar la contraseña a la nueva
        $user->password = Hash::make($request->password);
        $user->save(); // No deberia de salir error y sale.

        // Iniciar sesión nuevamente después de guardar la nueva contraseña
        Auth::loginUsingId($user->id, true);

        // Redirigir al dashboard después de la actualización
        return redirect()->route('dashboard')->with('success', 'Contraseña actualizada correctamente.');
    }
}
