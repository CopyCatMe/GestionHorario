<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardia extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'tipo_recuento',
    ];

    public function horarios()
    {
        return $this->belongsToMany(Horario::class, 'horarios_guardias', 'id_guardia', 'id_horario')
            ->withTimestamps();
    }
}
