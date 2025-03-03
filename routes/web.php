<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckPasswordChanged;
use App\Http\Middleware\DeleteUserIfPasswordNotSet;
use App\Livewire\FaltasList;
use App\Livewire\FormularioFalta;

// Ruta pública para la página de inicio
Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas de Google Auth
Route::get('login/google', [GoogleController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Ruta para establecer la contraseña (solo accesible si aún no la ha cambiado)
Route::middleware(['auth', CheckPasswordChanged::class])->group(function () {
    Route::get('/password/set', [UserController::class, 'showSetPasswordForm'])->name('password.set');
    Route::post('/password/set', [UserController::class, 'setPassword'])->name('password.set.submit');
});

// Middleware que borra al usuario si abandonó el proceso sin establecer la contraseña
Route::middleware(['auth', DeleteUserIfPasswordNotSet::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/formulario-falta', FormularioFalta::class)->name('formulario-falta.index');
Route::get('/faltas', FaltasList::class)->name('faltas');

// Middleware para prevenir el acceso a la ruta de registro
Route::middleware(['auth'])->group(function () {
    Route::get('/register', function () {
        return redirect()->route('login');
    })->name('register');
});
