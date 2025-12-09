<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Mis recomendaciones nutricionales
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if ($evaluaciones->isEmpty())
                        <p class="text-sm text-gray-400">
                            Aún no tienes recomendaciones registradas. Consulta a tu nutrióloga para que registre una evaluación.
                        </p>
                    @else
                        <div class="space-y-6">
                            @foreach ($evaluaciones as $evaluacion)
                                <div class="border border-gray-700 rounded p-4">
                                    <h3 class="font-semibold mb-1">
                                        Evaluación del {{ $evaluacion->created_at->format('d/m/Y') }}
                                    </h3>
                                    <p class="text-xs text-gray-400 mb-2">
                                        Objetivo: {{ $evaluacion->objetivo }}
                                        · Actividad física: {{ $evaluacion->actividad_fisica }}
                                    </p>

                                    @php
                                        $recs = $evaluacion->recomendaciones;
                                    @endphp

                                    @if ($recs->isEmpty())
                                        <p class="text-sm text-gray-400">
                                            Aún no hay recomendaciones para esta evaluación.
                                        </p>
                                    @else
                                        @foreach ($recs as $rec)
                                            <div class="mt-3 border border-gray-600 rounded px-3 py-2">
                                                <div class="flex justify-between items-center mb-1">
                                                    <div>
                                                        <h4 class="font-semibold text-sm">{{ $rec->titulo }}</h4>
                                                        <p class="text-xs text-gray-400">
                                                            Nutrióloga: {{ $rec->nutri->name ?? 'No especificado' }}
                                                            · {{ $rec->created_at->format('d/m/Y') }}
                                                        </p>
                                                    </div>
                                                </div>

                                                <p class="text-sm mb-2">
                                                    {{ $rec->descripcion }}
                                                </p>

                                                @if ($rec->productos->isNotEmpty())
                                                    <h5 class="font-semibold text-xs mb-1">Productos recomendados:</h5>
                                                    <ul class="text-xs list-disc ml-4 space-y-1">
                                                        @foreach ($rec->productos as $prod)
                                                            <li>
                                                                {{ $prod->nombre }}
                                                                <span class="text-[11px] text-gray-400">
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
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
