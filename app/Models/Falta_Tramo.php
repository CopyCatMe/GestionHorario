<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Falta_Tramo extends Model
{
    use HasFactory;

    protected $fillable = [
        'aula',
        'dia',
        'hora',
        'id_user',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
