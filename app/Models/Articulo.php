<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;

    protected $table = 'articulos';

    protected $fillable = [
        'titulo',
        'contenido',
        'imagen',
        'autor_id',
        'fecha',
    ];

    public function autor()
    {
        return $this->belongsTo(User::class, 'autor_id');
    }
}
