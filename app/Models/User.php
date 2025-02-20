<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    // Constante con dias de la semana
    const DIAS_SEMANA = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'password_changed',
        'external_id',
        'external_auth',
    ];
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    public function horario()
    {
        return $this->belongsTo(Horario::class, 'id_horario');
    }

    // Un profesor tiene muchas asistencias
    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, 'id_profesor');
    }

    // Un profesor puede cubrir muchas guardias
    public function guardias()
    {
        return $this->belongsToMany(Guardia::class, 'guardias_profesores', 'id_profesor', 'id_guardia')
                    ->withPivot('cubrio_guardia')
                    ->withTimestamps();
    }

    // Un profesor puede aparecer en el recuento de guardias
    public function recuentos()
    {
        return $this->hasMany(Recuento::class, 'id_profesor');
    }
    
}
