<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Usuario;

class MostrarHorario extends Component
{
    public $usuario;

    public function mount($usuario)
    {
        $this->usuario = $usuario;
    }

    public function render()
    {
        return view('livewire.mostrar-horario', [
            'usuario' => $this->usuario,
        ]);
    }
}

