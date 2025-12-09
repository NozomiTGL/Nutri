<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Panel de administración
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Mensajes de éxito --}}
            @if (session('success'))
                <div class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-100 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Tarjetas de resumen --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-semibold mb-2">Productos</h3>
                        <p class="text-3xl font-bold">{{ $totalProductos }}</p>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            Suplementos registrados en el sistema.
                        </p>
                        <a href="{{ route('admin.productos.index') }}"
                           class="inline-block mt-4 px-4 py-2 bg-indigo-600 text-white text-sm rounded hover:bg-indigo-700">
                            Ver productos
                        </a>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-semibold mb-2">Categorías</h3>
                        <p class="text-3xl font-bold">{{ $totalCategorias }}</p>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            Tipos de suplementos para clasificar productos.
                        </p>
                        <a href="{{ route('admin.categorias.index') }}"
                           class="inline-block mt-4 px-4 py-2 bg-indigo-600 text-white text-sm rounded hover:bg-indigo-700">
                            Ver categorías
                        </a>
                    </div>
                </div>
            </div>

            {{-- Aquí más adelante podrías agregar tarjetas para usuarios, nutriólogas, etc. --}}
        </div>
    </div>
</x-app-layout>
