<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Evaluaciones de clientes
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <table class="min-w-full text-sm">
                        <thead>
                        <tr class="border-b border-gray-700">
                            <th class="text-left py-2">Cliente</th>
                            <th class="text-left py-2">Objetivo</th>
                            <th class="text-left py-2">Actividad</th>
                            <th class="text-left py-2">Fecha</th>
                            <th class="text-left py-2">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($evaluaciones as $ev)
                            <tr class="border-b border-gray-700">
                                <td class="py-2">{{ $ev->user->name }}</td>
                                <td class="py-2">{{ $ev->objetivo }}</td>
                                <td class="py-2">{{ $ev->actividad_fisica }}</td>
                                <td class="py-2">{{ $ev->created_at->format('d/m/Y') }}</td>
                                <td class="py-2">
                                    <a href="{{ route('nutri.evaluaciones.show', $ev) }}"
                                       class="text-indigo-400 hover:underline">
                                        Ver detalle
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-4 text-center text-gray-400">
                                    No hay evaluaciones registradas todavía.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
