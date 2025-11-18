<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Articulo extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'contenido', 'imagen', 'autor_id', 'fecha'];

    public function autor() {
        return $this->belongsTo(Usuario::class, 'autor_id');
    }
}