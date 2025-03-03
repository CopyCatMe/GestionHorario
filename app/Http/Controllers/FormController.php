<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    // Método para mostrar el formulario
    public function showForm()
    {
        return view('dashboard'); // La vista del dashboard donde se incluye el formulario modal
    }

    // Método para manejar el envío del formulario
    public function submitForm(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        // // Formulario::create([
        // //     'name' => $request->name,
        // //     'email' => $request->email,
        // //     'message' => $request->message,
        // // ]);

        // Si solo deseas mostrar un mensaje de éxito
        return redirect()->back()->with('success', 'Formulario enviado con éxito!');
    }
}
