<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Panel del cliente
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-2">Hola, {{ auth()->user()->name }}</h3>
                    <p class="mb-4">
                        Bienvenido a tu panel. Aquí podrás llenar tu evaluación nutricional
                        y ver las recomendaciones de tu nutrióloga.
                    </p>
                    <a href="{{ route('cliente.evaluacion.form') }}"
                       class="inline-block mt-4 px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                        Llenar / editar evaluación
                    </a>
                    <a href="{{ route('cliente.recomendaciones.index') }}"
                       class="inline-block mt-2 px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                        Ver mis recomendaciones
                    </a>


                </div>
            </div>

        </div>
    </div>
</x-app-layout>
