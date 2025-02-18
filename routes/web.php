<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\UserController;

// Ruta pública para la página de inicio
Route::get('/', function () {
    return view('welcome');
});

// Rutas de Google Auth
Route::get('login/google', [GoogleController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Rutas protegidas (requieren autenticación)
Route::middleware(['web', 'auth'])->group(function () {

    // Ruta para mostrar el formulario de cambio de contraseña
    Route::get('/password/set', [UserController::class, 'showSetPasswordForm'])->name('password.set');
    
    // Ruta para procesar el cambio de contraseña
    Route::post('/password/set', [UserController::class, 'setPassword'])->name('password.update');
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


