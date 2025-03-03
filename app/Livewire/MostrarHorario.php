<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Falta_Tramo;
use App\Models\Usuario;

class MostrarHorario extends Component
{
    public $usuario;
    public $faltas;

    public function mount($usuario)
    {
        $this->usuario = $usuario;

        // Obtener el inicio y fin de la semana actual sin usar Carbon
        $inicioSemana = date('Y-m-d', strtotime('monday this week')); // Lunes de esta semana
        $finSemana = date('Y-m-d', strtotime('friday this week'));    // Viernes de esta semana

        // Obtener las faltas del usuario en la semana actual
        $this->faltas = Falta_Tramo::where('id_user', $this->usuario->id)
            ->whereBetween('dia', [$inicioSemana, $finSemana])
            ->get();
    }

    public function render()
    {
        return view('livewire.mostrar-horario', [
            'usuario' => $this->usuario,
            'faltas' => $this->faltas,
        ]);
    }
}
