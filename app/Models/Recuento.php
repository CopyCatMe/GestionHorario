<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recuento extends Model
{
    use HasFactory;

    protected $fillable = ['id_user', 'guardias_cubiertas', 'guardias_convivencia'];

    // Un recuento pertenece a un user
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

     // Método para actualizar el recuento de guardias cubiertas
     public static function actualizarRecuento(User $user)
     {
         $guardiasCubiertas = Guardia::whereHas('users', function ($query) use ($user) {
             $query->where('id_user', $user->id)
                   ->wherePivot('cubrio_guardia', true);
         })->count();
 
         $guardiasEnConvivencia = Guardia::whereHas('aula', function ($query) {
             $query->where('es_convivencia', true);
         })->count();
 
         // Crear o actualizar el recuento
         $recuento = Recuento::firstOrNew(['id_user' => $user->id]);
         $recuento->guardias_cubiertas = $guardiasCubiertas;
         $recuento->guardias_convivencia = $guardiasEnConvivencia;
         $recuento->save();
     }
}

