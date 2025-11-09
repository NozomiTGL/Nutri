<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion', 'precio', 'stock', 'marca', 'imagen', 'categoria_id'];

    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }

    public function pedidos() {
        return $this->belongsToMany(Pedido::class, 'detalle_pedidos')->withPivot('cantidad', 'precio_unitario');
    }

    public function recomendaciones() {
        return $this->belongsToMany(Recomendacion::class, 'producto_recomendacion');
    }
}
