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

    protected $rules = [
        'dia' => 'required|date|after_or_equal:today',
        'horas' => 'required_if:todoElDia,false|array|min:1',
        'horas.*' => 'in:8:30-9:30,9:30-10:30,10:30-11:30,12:00-13:00,13:00-14:00,14:00-15:00,16:00-17:00,17:00-18:00,18:00-19:00,19:00-20:00,20:00-21:00,21:00-22:00',
    ];

    protected $messages = [
        'dia.required' => 'El día es obligatorio.',
        'dia.after_or_equal' => 'El día no puede ser anterior a hoy.',
        'horas.required_if' => 'Debes seleccionar al menos una franja horaria si no eliges "Todo el día".',
    ];

    public function updatedTodoElDia()
    {
        if ($this->todoElDia) {
            // Si se selecciona "Todo el día", se agregan todas las horas
            $this->horas = [
                '8:30-9:30',
                '9:30-10:30',
                '10:30-11:30',
                '12:00-13:00',
                '13:00-14:00',
                '14:00-15:00',
                '16:00-17:00',
                '17:00-18:00',
                '18:00-19:00',
                '19:00-20:00',
                '20:00-21:00',
                '21:00-22:00'
            ];
        } else {
            // Si no se selecciona "Todo el día", se limpian las horas
            $this->horas = [];
        }
    }

    // Abre el modal para ingresar la falta
    public function openModal()
    {
        $this->modal = true;
    }

    // Cierra el modal y restablece los campos
    public function closeModal()
    {
        $this->modal = false;
        $this->reset(['dia', 'horas', 'todoElDia']);
    }

    public function saveFalta()
    {
        $this->validate();

        // Validar que no haya otra falta en el mismo día y tramo horario del usuario autenticado
        foreach ($this->horas as $hora) {
            $existeFalta = Falta_Tramo::where('id_user', Auth::id())
                ->where('dia', $this->dia)
                ->where('hora', $hora)
                ->exists();

            if ($existeFalta) {
                session()->flash('error', 'Ya existe una falta en el tramo horario ' . $hora . ' del día ' . $this->dia . '.');
                return;
            }
        }

        // Registrar las faltas
        foreach ($this->horas as $hora) {
            Falta_Tramo::create([
                'id_user' => Auth::id(),
                'dia' => $this->dia,
                'hora' => $hora,
            ]);
        }

        session()->flash('message', 'Falta registrada correctamente.');
        $this->closeModal(); // Cierra el modal y restablece los campos
    }

    public function render()
    {
        return view('livewire.formulario-falta');
    }
}
