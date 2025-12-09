<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Evaluación de {{ $evaluacion->user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Datos principales de la evaluación --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Datos de la evaluación</h3>

                    <p><span class="font-semibold">Peso:</span> {{ $evaluacion->peso }} kg</p>
                    <p><span class="font-semibold">Estatura:</span> {{ $evaluacion->estatura }} m</p>
                    <p><span class="font-semibold">Objetivo:</span> {{ $evaluacion->objetivo }}</p>
                    <p><span class="font-semibold">Nivel de actividad física:</span> {{ $evaluacion->actividad_fisica }}</p>
                    <p class="mt-2">
                        <span class="font-semibold">Restricciones / alergias / enfermedades:</span>
                        {{ $evaluacion->restricciones ?: 'No especificado' }}
                    </p>
                </div>
            </div>

            {{-- Recomendaciones --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold">Recomendaciones</h3>

                        <a href="{{ route('nutri.recomendaciones.create', $evaluacion) }}"
                           class="px-4 py-2 bg-indigo-600 text-white text-sm rounded hover:bg-indigo-700">
                            Crear recomendación
                        </a>
                    </div>

                    @php
                        $recs = $evaluacion->recomendaciones()
                            ->with(['productos.categoria', 'nutri'])
                            ->get();
                    @endphp

                    @if ($recs->isEmpty())
                        <p class="text-sm text-gray-400">
                            Aún no hay recomendaciones para esta evaluación.
                        </p>
                    @else
                        <div class="space-y-4">
                            @foreach ($recs as $rec)
                                <div class="border border-gray-700 rounded p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <div>
                                            <h4 class="font-semibold">{{ $rec->titulo }}</h4>
                                            <p class="text-xs text-gray-400">
                                                Creada por: {{ $rec->nutri->name }}
                                                · {{ $rec->created_at->format('d/m/Y') }}
                                            </p>
                                        </div>
                                    </div>

                                    <p class="text-sm mb-3">{{ $rec->descripcion }}</p>

                                    @if ($rec->productos->isNotEmpty())
                                        <h5 class="font-semibold text-sm mb-1">Productos recomendados:</h5>
                                        <ul class="text-sm list-disc ml-5 space-y-1">
                                            @foreach ($rec->productos as $prod)
                                                <li>
                                                    {{ $prod->nombre }}
                                                    <span class="text-xs text-gray-400">
                                                        ({{ $prod->categoria->nombre ?? 'Sin categoría' }})
                                                    </span>
                                                    @if ($prod->pivot->dosis)
                                                        — Dosis: {{ $prod->pivot->dosis }}
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="mt-6">
                        <a href="{{ route('nutri.evaluaciones.index') }}"
                           class="text-sm text-indigo-400 hover:underline">
                            ← Volver al listado
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
