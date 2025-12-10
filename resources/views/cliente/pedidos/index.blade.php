<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Historial de pedidos
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if(session('success'))
                        <div class="mb-4 text-sm text-green-500">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($pedidos->isEmpty())
                        <p class="text-sm text-gray-400">
                            Aún no tienes pedidos registrados.
                        </p>
                    @else
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="border-b border-gray-700">
                                    <th class="px-3 py-2 text-left">Folio</th>
                                    <th class="px-3 py-2 text-left">Fecha</th>
                                    <th class="px-3 py-2 text-right">Total</th>
                                    <th class="px-3 py-2 text-left">Estado</th>
                                    <th class="px-3 py-2 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pedidos as $pedido)
                                    <tr class="border-b border-gray-800">
                                        <td class="px-3 py-2">#{{ $pedido->id }}</td>
                                        <td class="px-3 py-2">
                                            {{ $pedido->created_at->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="px-3 py-2 text-right">
                                            ${{ number_format($pedido->total, 2) }}
                                        </td>
                                        <td class="px-3 py-2 capitalize">
                                            {{ $pedido->estado }}
                                        </td>
                                        <td class="px-3 py-2 text-center">
                                            <a href="{{ route('cliente.pedidos.show', $pedido) }}"
                                               class="text-indigo-400 hover:underline">
                                                Ver detalle
                                            </a>
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
