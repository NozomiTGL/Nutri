<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'email',
        'password',
        'rol'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {

        if (!empty($value) && strlen($value) < 60) {
            $this->attributes['password'] = Hash::make($value);
        } else {
            $this->attributes['password'] = $value;
        }
    }


    public function pedidos() {
        return $this->hasMany(Pedido::class);
    }

    public function cuestionarios() {
        return $this->hasMany(Cuestionario::class);
    }

    public function recomendaciones() {
        return $this->hasMany(Recomendacion::class, 'usuario_id');
    }

    public function articulos() {
        return $this->hasMany(Articulo::class, 'autor_id');
    }
}
