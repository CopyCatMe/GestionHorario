<?php

namespace App\Livewire;

use App\Models\Falta_Tramo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FormularioFalta extends Component
{
    public $faltas = [];
    public $dia;
    public $horas = [];
    public $todoElDia = false;
    public $modal = false;
    public $horasDisponibles = [];

    public $horarios = [
        1 => '8:30-9:30',
        2 => '9:30-10:30',
        3 => '10:30-11:30',
        4 => '12:00-13:00',
        5 => '13:00-14:00',
        6 => '14:00-15:00',
        7 => '16:00-17:00',
        8 => '17:00-18:00',
        9 => '18:00-19:00',
        10 => '19:00-20:00',
        11 => '20:00-21:00',
        12 => '21:00-22:00'
    ];

    protected $rules = [
        'dia' => 'required|date|after_or_equal:today',
        'horas' => 'required_if:todoElDia,false|array|min:1',
        'horas.*' => 'integer|min:1|max:12',
    ];

    protected $messages = [
        'dia.required' => 'El día es obligatorio.',
        'dia.after_or_equal' => 'El día no puede ser anterior a hoy.',
        'horas.required_if' => 'Debes seleccionar al menos una franja horaria si no eliges "Todo el día".',
    ];

    // Abre el modal para ingresar la falta
    public function openModal()
    {
        $this->modal = true;
        $this->loadHorasDisponibles();
    }

    // Cierra el modal y restablece los campos
    public function closeModal()
    {
        $this->modal = false;
        $this->reset(['dia', 'horas', 'todoElDia']);
    }

    public function loadHorasDisponibles()
    {
        $faltasRegistradas = Falta_Tramo::where('id_user', Auth::id())
            ->where('dia', $this->dia)
            ->pluck('hora')->toArray(); // Ahora devuelve índices

        $this->horasDisponibles = array_diff(range(1, 12), $faltasRegistradas);
    }

    // Si se marca "Día Completo", asignamos todos los índices correctos
    public function updatedTodoElDia()
    {
        if ($this->todoElDia) {
            $this->horas = array_keys($this->horarios);
        } else {
            $this->horas = [];
        }
    }

    // Método para guardar la falta
    public function saveFalta()
    {
        $this->validate();

        foreach ($this->horas as $hora) {
            $existeFalta = Falta_Tramo::where('id_user', Auth::id())
                ->where('dia', $this->dia)
                ->where('hora', $hora)
                ->exists();

            if ($existeFalta) {
                $horaSeleccionada = $this->horarios[$hora];
                session()->flash('error', "El tramo horario {$horaSeleccionada} ya ha sido registrado para este día.");
                return;
            }
        }

        foreach ($this->horas as $hora) {
            Falta_Tramo::create([
                'id_user' => Auth::id(),
                'dia' => $this->dia,
                'hora' => $hora, 
            ]);
        }

        session()->flash('message', 'Faltas registradas correctamente.');
        $this->closeModal();
    }



    public function render()
    {
        return view('livewire.formulario-falta');
    }
}
