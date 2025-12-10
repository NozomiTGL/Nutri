{{-- resources/views/cliente/pedidos/historial.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Historial de pedidos
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 text-sm text-green-500">
                    {{ session('success') }}
                </div>
            @endif

            @if ($pedidos->isEmpty())
                <div class="p-6 overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                    <p class="text-gray-500 dark:text-gray-400">
                        Aún no tienes pedidos registrados.
                    </p>
                </div>
            @else
                <div class="p-6 overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                    <table class="min-w-full text-sm text-left">
                        <thead>
                            <tr class="border-b border-gray-700">
                                <th class="px-3 py-2">Folio</th>
                                <th class="px-3 py-2">Fecha</th>
                                <th class="px-3 py-2">Total</th>
                                <th class="px-3 py-2">Estado</th>
                                <th class="px-3 py-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pedidos as $pedido)
                                <tr class="border-b border-gray-800">
                                    <td class="px-3 py-2">
                                        #{{ $pedido->id }}
                                    </td>
                                    <td class="px-3 py-2">
                                        {{ \Carbon\Carbon::parse($pedido->fecha)->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-3 py-2">
                                        ${{ number_format($pedido->total, 2) }}
                                    </td>
                                    <td class="px-3 py-2">
                                        {{ ucfirst($pedido->estado) }}
                                    </td>
                                    <td class="px-3 py-2">
                                        <a href="{{ route('cliente.pedidos.show', $pedido) }}"
                                           class="text-xs text-indigo-400 hover:underline">
                                            Ver factura
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
