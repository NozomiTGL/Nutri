<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $fillable = [
        'user_id',
        'usuario_id',   // ← añadimos esta
        'total',
        'estado',
        'fecha',
    ];

    protected $casts = [
        'fecha' => 'datetime',
    ];

    public function user()
    {
        // usamos user_id para la relación que ya usan los controladores
        return $this->belongsTo(User::class, 'user_id');
    }

    public function detalles()
    {
        return $this->hasMany(DetallePedido::class);
    }
}
