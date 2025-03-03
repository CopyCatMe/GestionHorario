<?php

namespace App\Livewire;

use App\Models\Falta_Tramo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FaltasList extends Component
{
    public $faltas = [];
    public $title;


    public function mount()
    {
        // Obtener las faltas del usuario autenticado
        $this->faltas = Falta_Tramo::where('id_user', Auth::id())
            ->orderBy('dia', 'desc')
            ->orderBy('hora', 'asc')
            ->get();
    }

    public function render()
    {
        return view('livewire.faltas-list')->layout('layouts.app');
    }
}
