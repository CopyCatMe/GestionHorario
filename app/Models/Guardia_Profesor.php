<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardia_Profesor extends Model
{
    use HasFactory;

    protected $fillable = ['id_guardia', 'id_profesor', 'cubrio_guardia'];

}
