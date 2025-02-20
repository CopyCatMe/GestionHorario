<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;
    
    protected $fillable = ['id_profesor', 'fecha', 'hora', 'presente'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
