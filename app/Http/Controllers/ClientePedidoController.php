<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;

class ClientePedidoController extends Controller
{
    
    public function historial()
    {
        $user = Auth::user();

        $pedidos = Pedido::with(['detalles.producto'])
            ->where('user_id', $user->id)
            ->orderByDesc('fecha')
            ->get();

        return view('cliente.pedidos.historial', compact('pedidos'));
    }

    public function showFactura(Pedido $pedido)
    {
        $user = Auth::user();

        
        if ($pedido->user_id !== $user->id) {
            abort(403, 'No puedes ver este pedido.');
        }

        $pedido->load('detalles.producto');

        return view('cliente.pedidos.factura', compact('pedido'));
    }
}
