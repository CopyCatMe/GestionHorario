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
        'user_id',
    ];

    // Un horario puede tener muchas guardias y una guardia puede tener varios horarios
    public function guardias()
    {
        return $this->belongsToMany(Guardia::class, 'horario_guardias', 'id_horario', 'id_guardia')
            ->withTimestamps();
    }

    // Un horario pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
