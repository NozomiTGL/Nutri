<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'email', 'password', 'rol'];

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
