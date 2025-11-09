<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cuestionario extends Model
{
    use HasFactory;

    protected $fillable = ['usuario_id', 'objetivo', 'alergias', 'restricciones', 'estilo_vida', 'fecha'];

    public function usuario() {
        return $this->belongsTo(Usuario::class);
    }

    public function recomendaciones() {
        return $this->hasMany(Recomendacion::class);
    }
}

