<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Articulo extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'contenido', 'imagen', 'autor_id', 'fecha'];

    public function autor() {
        return $this->belongsTo(User::class, 'autor_id');
    }
}
