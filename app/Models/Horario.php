<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $fillable = [
        'dia',
        'hora',
        'aula_numero',
        'id_user',
    ];

    // Un horario puede tener muchas guardias y una guardia puede tener varios horarios
    public function guardias()
    {
        return $this->belongsToMany(Guardia::class, 'horario_guardias', 'id_horario', 'id_guardia')
            ->withTimestamps();
    }

    // Un horario pertenece a un usuario
    public function horario()
    {
        return $this->belongsTo(Horario::class, 'id_horario');
    }
    
}
