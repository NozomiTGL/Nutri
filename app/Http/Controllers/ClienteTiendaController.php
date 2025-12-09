<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Pedido;
use App\Models\DetallePedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClienteTiendaController extends Controller
{
    // Listado de productos para el cliente
    public function index()
    {
        $productos = Producto::with('categoria')
            ->where('stock', '>', 0)
            ->orderBy('nombre')
            ->paginate(9);

        return view('cliente.tienda', compact('productos'));
    }

    // Crear pedido sencillo con productos seleccionados
    public function checkout(Request $request)
    {
        $request->validate([
            'productos'            => 'required|array',
            'productos.*.id'       => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:0',
        ]);

        $user = Auth::user();

        DB::beginTransaction();

        try {
            $total    = 0;
            $detalles = [];

            foreach ($request->productos as $item) {
                $cantidad = (int) ($item['cantidad'] ?? 0);

                // Si la cantidad es 0, lo saltamos
                if ($cantidad <= 0) {
                    continue;
                }

                $producto = Producto::lockForUpdate()->find($item['id']);

                if (! $producto) {
                    continue;
                }

                if ($producto->stock < $cantidad) {
                    throw new \Exception("No hay stock suficiente para {$producto->nombre}");
                }

                $subtotal = $producto->precio * $cantidad;
                $total   += $subtotal;

                $detalles[] = [
                    'producto_id'     => $producto->id,
                    'cantidad'        => $cantidad,
                    'precio_unitario' => $producto->precio,
                ];

                // Descontar stock y guardar
                $producto->stock -= $cantidad;
                $producto->save();
            }

            if ($total <= 0 || empty($detalles)) {
                throw new \Exception('No seleccionaste productos válidos.');
            }

            $pedido = Pedido::create([
                'user_id' => $user->id,
                'usuario_id' => $user->id,
                'total'   => $total,
                'estado'  => 'pendiente',
                'fecha'   => now(),
            ]);

            foreach ($detalles as $detalle) {
                $detalle['pedido_id'] = $pedido->id;
                DetallePedido::create($detalle);
            }

            DB::commit();

            // Ir directo a la factura del pedido creado
            return redirect()
                ->route('cliente.pedidos.show', $pedido)
                ->with('success', 'Pedido realizado correctamente.');
        } catch (\Throwable $e) {
            DB::rollBack();

            return back()
                ->withErrors(['tienda' => $e->getMessage()])
                ->withInput();
        }
    }
}
