<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cuestionario extends Model
{
    use HasFactory;

<<<<<<< HEAD
    protected $fillable = [
        'user_id',
        'objetivo',
        'alergias',
        'restricciones',
        'estilo_vida',
        'fecha',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function recomendaciones()
    {
        return $this->hasMany(Recomendacion::class);
    }
}
=======
    protected $fillable = ['usuario_id', 'objetivo', 'alergias', 'restricciones', 'estilo_vida', 'fecha'];

    public function usuario() {
        return $this->belongsTo(Usuario::class);
    }

    public function recomendaciones() {
        return $this->hasMany(Recomendacion::class);
    }
}

>>>>>>> b7c53d888328c4b0243c7d9c1b4336ba3e91a84b
