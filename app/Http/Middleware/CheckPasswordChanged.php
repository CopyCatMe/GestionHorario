<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPasswordChanged
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Si ya cambió la contraseña, lo redirigimos al dashboard
        if ($user && $user->password_changed) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
