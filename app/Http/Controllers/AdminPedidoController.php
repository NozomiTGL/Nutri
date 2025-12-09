<?php

namespace App\Http\Controllers;

use App\Models\Pedido;


class AdminPedidoController extends Controller
{
    // Listado de pedidos / ventas
    public function index()
    {
        $pedidos = Pedido::with(['user', 'detalles.producto'])
            ->orderByDesc('created_at')
            ->get();

        return view('admin.pedidos.index', compact('pedidos'));
    }
}
