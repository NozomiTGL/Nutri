<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = ['usuario_id', 'estado', 'total', 'fecha'];

    public function usuario() {
        return $this->belongsTo(Usuario::class);
    }

    public function productos() {
        return $this->belongsToMany(Producto::class, 'detalle_pedidos')->withPivot('cantidad', 'precio_unitario');
    }
}
