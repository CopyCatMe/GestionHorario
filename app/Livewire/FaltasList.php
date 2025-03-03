<?php

namespace App\Livewire;

use App\Models\Falta_Tramo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FaltasList extends Component
{
    public $faltas = [];
    public $confirmingDelete = false; // Para controlar el estado del modal
    public $faltaIdToDelete = null;  // Guardamos el ID de la falta que se va a eliminar

    public function mount()
    {
        $this->loadFaltas();  // Cargar las faltas cuando el componente se monta
    }

    // Método para cargar las faltas del usuario autenticado
    public function loadFaltas()
    {
        $this->faltas = Falta_Tramo::where('id_user', Auth::id())
            ->orderBy('dia', 'desc')
            ->orderBy('hora', 'asc')
            ->get();
    }

    // Método para confirmar la eliminación de una falta
    public function confirmDelete($faltaId)
    {
        $this->faltaIdToDelete = $faltaId; // Guardamos el ID de la falta a eliminar
        $this->confirmingDelete = true;    // Mostramos el modal
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
        $this->confirmingDelete = false; // Cerramos el modal
    }

    public function render()
    {
        return view('livewire.faltas-list')->layout('layouts.app');
    }
}
