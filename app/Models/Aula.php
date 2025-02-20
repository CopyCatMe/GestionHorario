<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'es_convivencia'];

    public function guardias()
    {
        return $this->hasMany(Guardia::class, 'id_aula');
    }
}
