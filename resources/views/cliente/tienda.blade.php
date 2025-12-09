<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tienda de suplementos
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if ($errors->has('tienda'))
                <div class="mb-4 text-sm text-red-500">
                    {{ $errors->first('tienda') }}
                </div>
            @endif

            <form method="POST"
                  action="{{ route('cliente.tienda.checkout') }}"
                  onsubmit="return confirm('¿Estás seguro de realizar este pedido?');">
                @csrf

                @if($productos->isEmpty())
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <p class="text-gray-500 dark:text-gray-400">
                            Por el momento no hay productos disponibles.
                        </p>
                    </div>
                @else
                    <div class="grid gap-6 md:grid-cols-3">
                        @foreach($productos as $index => $producto)
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4 flex flex-col justify-between">
                                <div>
                                    <h3 class="text-lg font-semibold mb-1">
                                        {{ $producto->nombre }}
                                    </h3>
                                    <p class="text-xs text-gray-400 mb-1">
                                        {{ $producto->categoria->nombre ?? 'Sin categoría' }}
                                    </p>
                                    <p class="text-sm mb-2">
                                        {{ Str::limit($producto->descripcion, 80) }}
                                    </p>
                                    <p class="font-bold mb-1">
                                        ${{ number_format($producto->precio, 2) }}
                                    </p>
                                    <p class="text-xs text-gray-400">
                                        Stock: {{ $producto->stock }}
                                    </p>
                                </div>

                                <div class="mt-3">
                                    <label class="block text-xs mb-1">
                                        Cantidad
                                    </label>
                                    <input type="hidden"
                                           name="productos[{{ $index }}][id]"
                                           value="{{ $producto->id }}">
                                    <input type="number"
                                           name="productos[{{ $index }}][cantidad]"
                                           value="0"
                                           min="0"
                                           max="{{ $producto->stock }}"
                                           class="w-full text-sm rounded border-gray-300 dark:bg-gray-900 dark:border-gray-700">
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button type="submit"
                                class="px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-sm font-semibold">
                            Realizar pedido
                        </button>
                    </div>

                    <div class="mt-4">
                        {{ $productos->links() }}
                    </div>
                @endif
            </form>
        </div>
    </div>
</x-app-layout>
