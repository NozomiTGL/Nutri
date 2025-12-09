<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Panel de nutrióloga
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-2">Bienvenida, {{ auth()->user()->name }}</h3>
                    <p class="mb-4">
                        Aquí podrás revisar a tus clientes, sus evaluaciones y generar recomendaciones
                        de suplementos.
                    </p>

                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                        Clientes registrados en el sistema: <strong>{{ $totalClientes }}</strong>
                    </p>
                    <a href="{{ route('nutri.evaluaciones.index') }}"
                       class="inline-block mt-4 px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                        Ver evaluaciones de clientes
                    </a>

                    {{-- Más adelante aquí pondremos enlaces a evaluaciones y recomendaciones --}}
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Próximo paso: ver listado de evaluaciones y crear recomendaciones.
                    </p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
