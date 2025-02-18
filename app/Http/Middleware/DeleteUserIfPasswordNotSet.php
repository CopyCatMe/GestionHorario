<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DeleteUserIfPasswordNotSet
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user instanceof User) {
            // Recargar datos desde la base de datos para evitar valores en caché
            $user->refresh();

            // Si la contraseña sigue sin establecerse, eliminar al usuario
            if (!$user->password_changed) {
                Auth::logout(); // Cerrar sesión antes de eliminar
                $user->forceDelete(); // Eliminar usuario definitivamente

                return redirect()->route('login')->with('error', 'Tu cuenta ha sido eliminada porque no completaste el cambio de contraseña.');
            }
        }

        return $next($request);
    }
}
