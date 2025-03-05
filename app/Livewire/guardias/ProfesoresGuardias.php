<?php

namespace App\Livewire\Guardias;

use Livewire\Component;
use App\Models\Horario;

class ProfesoresGuardias extends Component
{
    public function render()
    {
        // Obtener todos los horarios y agruparlos por día
        $horarios = Horario::all()->groupBy('dia');

        return view('livewire.guardias.profesores-guardias', compact('horarios'));
    }
}
