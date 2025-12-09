<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    use HasFactory;

    protected $table = 'evaluaciones';

    protected $fillable = [
        'user_id',
        'peso',
        'estatura',
        'objetivo',
        'actividad_fisica',
        'restricciones',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recomendaciones()
    {
        return $this->hasMany(Recomendacion::class);
    }

}
