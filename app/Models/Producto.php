<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    // Aseguramos el nombre de la tabla:
    protected $table = 'productos';

    // Campos que se pueden guardar/actualizar por asignación masiva
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'marca',
        'categoria_id',
    ];

    /**
     * Relación: un producto pertenece a una categoría.
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    /**
     * Relación muchos a muchos con recomendaciones
     * (si ya la tenías).
     */
    public function recomendaciones()
    {
        return $this->belongsToMany(Recomendacion::class, 'producto_recomendacion')->withPivot('dosis')->withTimestamps();
    }
}
