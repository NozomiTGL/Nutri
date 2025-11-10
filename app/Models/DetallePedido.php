<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetallePedido extends Model
{
    use HasFactory;

    protected $fillable = ['pedido_id', 'producto_id', 'cantidad', 'precio_unitario'];
}
