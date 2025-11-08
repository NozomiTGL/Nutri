<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cuestionario extends Model
{
    use HasFactory;

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
