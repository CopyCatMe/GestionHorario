<?php

namespace App\View\Components;

use Illuminate\View\Component;

class HorarioUsuario extends Component
{
    public $usuario;

    public function __construct($usuario)
    {
        $this->usuario = $usuario;
    }

    public function render()
    {
        return view('components.horario-usuario');
    }
}
