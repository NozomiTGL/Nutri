<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Tienda de suplementos
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

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
                    <div class="p-6 overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                        <p class="text-gray-500 dark:text-gray-400">
                            Por el momento no hay productos disponibles.
                        </p>
                    </div>
                @else
                    <div class="grid gap-6 md:grid-cols-3">
                        @foreach($productos as $index => $producto)
                            <div class="flex flex-col justify-between p-4 overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                                <div>
                                    <h3 class="mb-1 text-lg font-semibold">
                                        {{ $producto->nombre }}
                                    </h3>
                                    <p class="mb-1 text-xs text-gray-400">
                                        {{ $producto->categoria->nombre ?? 'Sin categoría' }}
                                    </p>
                                    <p class="mb-2 text-sm">
                                        {{ Str::limit($producto->descripcion, 80) }}
                                    </p>
                                    <p class="mb-1 font-bold">
                                        ${{ number_format($producto->precio, 2) }}
                                    </p>
                                    <p class="text-xs text-gray-400">
                                        Stock: {{ $producto->stock }}
                                    </p>
                                </div>

                                <div class="mt-3">
                                    <label class="block mb-1 text-xs">
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
                                           class="w-full text-sm border-gray-300 rounded dark:bg-gray-900 dark:border-gray-700">
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex justify-end mt-6">
                        <button type="submit"
                                class="px-6 py-2 text-sm font-semibold text-white bg-indigo-600 rounded hover:bg-indigo-700">
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
