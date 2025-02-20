<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $fillable = ['dia', 'hora'];

    public function users()
    {
        return $this->hasMany(User::class, 'id_horario');
    }

    // Un horario puede tener muchas guardias
    public function guardias()
    {
        return $this->hasMany(Guardia::class, 'id_horario');
    }

}
