<?php

namespace App\Http\Controllers;

use App\Models\User;
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
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&.]/'
            ],
        ]);

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión.');
        }

        $user = Auth::user();

        if (!$user instanceof User) {
            return redirect()->route('login')->with('error', 'Usuario no válido.');
        }

        // Si ya cambió la contraseña previamente, redirigir al dashboard
        if ($user->password_changed) {
            return redirect()->route('dashboard')->with('error', 'Ya has cambiado tu contraseña.');
        }

        // Actualizar la contraseña y marcarla como cambiada
        $user->update([
            'password' => Hash::make($request->password),
            'password_changed' => true,
        ]);

        // Recargar la instancia del usuario para asegurar que los cambios se reflejan
        $user->refresh();

        // Redirigir al dashboard después de la actualización de la contraseña
        return redirect()->route('dashboard')->with('success', 'Contraseña establecida correctamente.');
    }
}
