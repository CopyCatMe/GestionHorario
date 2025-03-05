<?php

namespace App\Livewire\Guardias;

use Livewire\Component;

class ProfesoresGuardiasShow extends Component
{
    public $dia;

    public function mount($dia) // Captura el valor del parámetro
    {
        $this->dia = $dia;
    }
    
    public function render()
    {
        return view('livewire.guardias.profesores-guardias-show')->layout('layouts.app');
        ;
    }
}
