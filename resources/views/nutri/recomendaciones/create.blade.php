<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Crear recomendación para {{ $evaluacion->user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h3 class="text-lg font-semibold mb-2">Datos de la evaluación</h3>
                    <p class="text-sm text-gray-400 mb-4">
                        Peso: {{ $evaluacion->peso }} kg · Estatura: {{ $evaluacion->estatura }} m ·
                        Objetivo: {{ $evaluacion->objetivo }} · Actividad: {{ $evaluacion->actividad_fisica }}
                    </p>

                    @if ($errors->any())
                        <div class="mb-4 text-sm text-red-500">
                            <ul class="list-disc ml-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST"
                          action="{{ route('nutri.recomendaciones.store', $evaluacion) }}">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">Título de la recomendación</label>
                            <input type="text" name="titulo"
                                   value="{{ old('titulo') }}"
                                   class="w-full rounded border-gray-300 dark:bg-gray-900 dark:border-gray-700"
                                   required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">Descripción / indicaciones</label>
                            <textarea name="descripcion" rows="4"
                                      class="w-full rounded border-gray-300 dark:bg-gray-900 dark:border-gray-700"
                                      required>{{ old('descripcion') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">
                                Productos recomendados (selecciona uno o varios)
                            </label>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @foreach($productos as $producto)
                                    <div class="border border-gray-700 rounded p-3">
                                        <label class="flex items-start space-x-2">
                                            <input type="checkbox" name="productos[]"
                                                   value="{{ $producto->id }}"
                                                   class="mt-1"
                                                   {{ in_array($producto->id, old('productos', [])) ? 'checked' : '' }}>
                                            <div>
                                                <div class="font-semibold">
                                                    {{ $producto->nombre }}
                                                    <span class="text-xs text-gray-400">
                                                        ({{ $producto->categoria->nombre ?? 'Sin categoría' }})
                                                    </span>
                                                </div>
                                                <div class="text-xs text-gray-400">
                                                    ${{ number_format($producto->precio, 2) }} · Stock: {{ $producto->stock }}
                                                </div>
                                                <div class="mt-1">
                                                    <input type="text"
                                                           name="dosis[{{ $producto->id }}]"
                                                           placeholder="Dosis / indicaciones (opcional)"
                                                           class="w-full text-xs rounded border-gray-600 dark:bg-gray-900">
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('nutri.evaluaciones.show', $evaluacion) }}"
                               class="px-4 py-2 border border-gray-600 rounded text-sm">
                                Cancelar
                            </a>
                            <button type="submit"
                                    class="px-4 py-2 bg-indigo-600 text-white rounded text-sm hover:bg-indigo-700">
                                Guardar recomendación
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
