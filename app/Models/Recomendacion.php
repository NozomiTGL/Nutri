<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recomendacion extends Model
{
    use HasFactory;

    protected $fillable = ['usuario_id', 'nutricionista_id', 'cuestionario_id', 'comentarios', 'fecha'];

    public function usuario() {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function nutricionista() {
        return $this->belongsTo(Usuario::class, 'nutricionista_id');
    }

    public function cuestionario() {
        return $this->belongsTo(Cuestionario::class);
    }

    public function productos() {
        return $this->belongsToMany(Producto::class, 'producto_recomendacion');
    }
}
