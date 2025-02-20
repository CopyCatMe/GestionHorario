<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardia extends Model
{
    use HasFactory;

    protected $fillable = ['id_horario', 'id_aula', 'fecha'];

    // Una guardia pertenece a un horario
    public function horario()
    {
        return $this->belongsTo(Horario::class, 'id_horario');
    }

    // Una guardia pertenece a un aula
    public function aula()
    {
        return $this->belongsTo(Aula::class, 'id_aula');
    }

    // Una guardia puede ser cubierta por muchos user
    public function user()
    {
        return $this->belongsToMany(User::class, 'guardias_user', 'id_guardia', 'id_profesor')
                    ->withPivot('cubrio_guardia')
                    ->withTimestamps();
    }
}
