<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detalle del pedido #{{ $pedido->id }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <p class="mb-2">
                        <span class="font-semibold">Cliente:</span>
                        {{ $pedido->user->name ?? 'N/A' }} ({{ $pedido->user->email ?? '' }})
                    </p>
                    <p class="mb-2">
                        <span class="font-semibold">Fecha:</span>
                        {{ $pedido->created_at->format('d/m/Y H:i') }}
                    </p>
                    <p class="mb-4">
                        <span class="font-semibold">Estado:</span>
                        {{ $pedido->estado }}
                    </p>

                    <h3 class="font-semibold mb-2">Productos</h3>

                    <table class="min-w-full text-sm mb-4">
                        <thead>
                            <tr class="border-b border-gray-700">
                                <th class="py-2 text-left">Producto</th>
                                <th class="py-2 text-left">Cantidad</th>
                                <th class="py-2 text-left">Precio unitario</th>
                                <th class="py-2 text-left">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pedido->detalles as $detalle)
                                <tr class="border-b border-gray-800">
                                    <td class="py-2">
                                        {{ $detalle->producto->nombre ?? 'Producto eliminado' }}
                                    </td>
                                    <td class="py-2">{{ $detalle->cantidad }}</td>
                                    <td class="py-2">
                                        ${{ number_format($detalle->precio_unitario, 2) }}
                                    </td>
                                    <td class="py-2">
                                        ${{ number_format($detalle->cantidad * $detalle->precio_unitario, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <p class="text-right font-bold text-lg">
                        Total: ${{ number_format($pedido->total, 2) }}
                    </p>

                    <div class="mt-4">
                        <a href="{{ route('admin.pedidos.index') }}"
                           class="text-indigo-400 hover:underline">
                            ← Volver al listado
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
