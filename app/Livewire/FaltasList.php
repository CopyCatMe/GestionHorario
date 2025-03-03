<?php

namespace App\Livewire;

use App\Models\Falta_Tramo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FaltasList extends Component
{
    public $faltas = [];
    public $confirmingDelete = false; 
    public $faltaIdToDelete = null; 

    public function mount()
    {
        $this->loadFaltas();  // Cargar las faltas cuando el componente se inicie
    }

    // cargar las faltas del usuario autenticado
    public function loadFaltas()
    {
        $this->faltas = Falta_Tramo::where('id_user', Auth::id())
            ->orderBy('dia', 'desc')
            ->orderBy('hora', 'asc')
            ->get();
    }

    // confirmar la eliminación de una falta
    public function confirmDelete($faltaId)
    {
        $this->faltaIdToDelete = $faltaId;
        $this->confirmingDelete = true; 
    }

    // Eliminar la falta
    public function delete()
    {
        if ($this->faltaIdToDelete) {
            $falta = Falta_Tramo::find($this->faltaIdToDelete);
            if ($falta) {
                $falta->delete();
                session()->flash('message', 'Falta eliminada con éxito');
                $this->loadFaltas();  // Recargar las faltas después de la eliminación
            }
        }
        $this->confirmingDelete = false; 
    }

    public function render()
    {
        return view('livewire.faltas-list')->layout('layouts.app');
    }
}
