<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pedidos / Ventas') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($pedidos->isEmpty())
                        <p class="text-sm text-gray-400">
                            Aún no hay pedidos registrados.
                        </p>
                    @else
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="border-b border-gray-700">
                                    <th class="px-3 py-2 text-left">ID</th>
                                    <th class="px-3 py-2 text-left">Cliente</th>
                                    <th class="px-3 py-2 text-left">Total</th>
                                    <th class="px-3 py-2 text-left">Estado</th>
                                    <th class="px-3 py-2 text-left">Fecha</th>
                                    <th class="px-3 py-2 text-left">Detalle</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pedidos as $pedido)
                                    <tr class="border-b border-gray-700">
                                        <td class="px-3 py-2">#{{ $pedido->id }}</td>
                                        <td class="px-3 py-2">
                                            {{ $pedido->user->name ?? 'N/D' }}<br>
                                            <span class="text-xs text-gray-400">
                                                {{ $pedido->user->email ?? '' }}
                                            </span>
                                        </td>
                                        <td class="px-3 py-2">${{ number_format($pedido->total, 2) }}</td>
                                        <td class="px-3 py-2 capitalize">{{ $pedido->estado }}</td>
                                        <td class="px-3 py-2">{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="px-3 py-2">
                                            <ul class="list-disc ml-4 text-xs">
                                                @foreach($pedido->detalles as $detalle)
                                                    <li>
                                                        {{ $detalle->producto->nombre ?? 'Producto eliminado' }}
                                                        — Cant: {{ $detalle->cantidad }}
                                                        — ${{ number_format($detalle->precio_unitario, 2) }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
