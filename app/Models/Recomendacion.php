<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recomendacion extends Model
{
    use HasFactory;

<<<<<<< HEAD
    protected $fillable = [
        'user_id',
        'nutricionista_id',
        'cuestionario_id',
        'comentarios',
        'fecha',
    ];

    public function cliente()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function nutricionista()
    {
        return $this->belongsTo(User::class, 'nutricionista_id');
    }

    public function cuestionario()
    {
        return $this->belongsTo(Cuestionario::class);
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'producto_recomendacion')->withTimestamps();
=======
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
>>>>>>> b7c53d888328c4b0243c7d9c1b4336ba3e91a84b
    }
}
