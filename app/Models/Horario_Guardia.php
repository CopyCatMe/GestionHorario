<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario_Guardia extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_horario',
        'id_guardia',
    ];

    public function guardias()
    {
        return $this->belongsToMany(Guardia::class, 'horario_guardias', 'id_horario', 'id_guardia')
            ->withTimestamps();
    }
}
