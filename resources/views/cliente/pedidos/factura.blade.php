{{-- resources/views/cliente/pedidos/factura.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Factura del pedido #{{ $pedido->id }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto space-y-6 sm:px-6 lg:px-8">

            <div class="p-6 bg-white shadow dark:bg-gray-800 sm:rounded-lg">
                <div class="flex justify-between mb-4 text-sm">
                    <div>
                        <p class="font-semibold">Cliente:</p>
                        <p>{{ $pedido->user->name ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="font-semibold">Fecha:</p>
                        <p>{{ \Carbon\Carbon::parse($pedido->fecha)->format('d/m/Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="font-semibold">Estado:</p>
                        <p>{{ ucfirst($pedido->estado) }}</p>
                    </div>
                </div>

                <table class="min-w-full mt-4 text-sm text-left">
                    <thead>
                        <tr class="border-b border-gray-700">
                            <th class="px-3 py-2">Producto</th>
                            <th class="px-3 py-2">Cantidad</th>
                            <th class="px-3 py-2">Precio</th>
                            <th class="px-3 py-2">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pedido->detalles as $detalle)
                            <tr class="border-b border-gray-800">
                                <td class="px-3 py-2">
                                    {{ $detalle->producto->nombre ?? 'Producto eliminado' }}
                                </td>
                                <td class="px-3 py-2">
                                    {{ $detalle->cantidad }}
                                </td>
                                <td class="px-3 py-2">
                                    ${{ number_format($detalle->precio_unitario, 2) }}
                                </td>
                                <td class="px-3 py-2">
                                    ${{ number_format($detalle->cantidad * $detalle->precio_unitario, 2) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4 text-right">
                    <p class="text-lg font-semibold">
                        Total: ${{ number_format($pedido->total, 2) }}
                    </p>
                </div>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('cliente.pedidos.historial') }}"
                   class="text-sm text-gray-400 hover:text-gray-200">
                    ← Volver al historial
                </a>
                <button onclick="window.print()"
                        class="px-4 py-2 text-sm text-white bg-indigo-600 rounded hover:bg-indigo-700">
                    Imprimir / Guardar PDF
                </button>
            </div>

        </div>
    </div>
</x-app-layout>
