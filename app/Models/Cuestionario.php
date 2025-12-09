<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Cuestionario extends Model
{
    use HasFactory;

    protected $fillable = ['usuario_id', 'objetivo', 'alergias', 'restricciones', 'estilo_vida', 'fecha'];

    public function usuario() {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function recomendaciones() {
        return $this->hasMany(Recomendacion::class);
    }
}

