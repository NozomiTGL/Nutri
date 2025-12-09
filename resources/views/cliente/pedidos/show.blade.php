<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detalle del pedido #{{ $pedido->id }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="mb-6">
                        <p><span class="font-semibold">Cliente:</span> {{ auth()->user()->name }}</p>
                        <p><span class="font-semibold">Fecha:</span> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>
                        <p><span class="font-semibold">Estado:</span> {{ ucfirst($pedido->estado) }}</p>
                    </div>

                    <h3 class="mb-2 text-lg font-semibold">Productos</h3>

                    <table class="min-w-full text-sm mb-4">
                        <thead>
                            <tr class="border-b border-gray-700">
                                <th class="px-3 py-2 text-left">Producto</th>
                                <th class="px-3 py-2 text-right">Cantidad</th>
                                <th class="px-3 py-2 text-right">Precio</th>
                                <th class="px-3 py-2 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pedido->detalles as $detalle)
                                <tr class="border-b border-gray-800">
                                    <td class="px-3 py-2">
                                        {{ $detalle->producto->nombre ?? 'Producto eliminado' }}
                                    </td>
                                    <td class="px-3 py-2 text-right">
                                        {{ $detalle->cantidad }}
                                    </td>
                                    <td class="px-3 py-2 text-right">
                                        ${{ number_format($detalle->precio_unitario, 2) }}
                                    </td>
                                    <td class="px-3 py-2 text-right">
                                        ${{ number_format($detalle->precio_unitario * $detalle->cantidad, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="flex justify-end">
                        <p class="text-lg font-semibold">
                            Total: ${{ number_format($pedido->total, 2) }}
                        </p>
                    </div>

                    <div class="mt-6 flex justify-between">
                        <a href="{{ route('cliente.pedidos.index') }}"
                           class="text-sm text-indigo-400 hover:underline">
                            ‹ Volver al historial
                        </a>
                        <a href="{{ route('cliente.tienda.index') }}"
                           class="text-sm text-indigo-400 hover:underline">
                            Seguir comprando
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
