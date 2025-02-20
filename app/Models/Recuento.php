<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recuento extends Model
{
    use HasFactory;

    protected $fillable = ['id_guardia', 'id_user', 'guardias_cubiertas', 'ingresos_convivencia'];

    public function guardia()
    {
        return $this->belongsTo(Guardia::class, 'id_guardia');
    }

    // Un recuento pertenece a un profesor
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}

