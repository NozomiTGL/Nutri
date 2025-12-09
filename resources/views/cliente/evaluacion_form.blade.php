<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Evaluación nutricional
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if (session('success'))
                        <div class="mb-4 text-sm text-green-600 dark:text-green-400">
                            {{ session('success') }}
                        </div>
                    @endif

                    <p class="mb-4 text-sm text-gray-400">
                        Llena tu información para que la nutrióloga pueda darte una recomendación
                        personalizada de suplementos.
                    </p>

                    @php
                        $action = $evaluacion ? route('cliente.evaluacion.update') : route('cliente.evaluacion.store');
                        $method = $evaluacion ? 'PUT' : 'POST';
                    @endphp

                    <form method="POST" action="{{ $action }}">
                        @csrf
                        @if($evaluacion)
                            @method('PUT')
                        @endif

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">Peso (kg)</label>
                            <input type="number" step="0.01" name="peso"
                                   value="{{ old('peso', $evaluacion->peso ?? '') }}"
                                   class="w-full rounded border-gray-300 dark:bg-gray-900 dark:border-gray-700" required>
                            @error('peso') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">Estatura (m)</label>
                            <input type="number" step="0.01" name="estatura"
                                   value="{{ old('estatura', $evaluacion->estatura ?? '') }}"
                                   class="w-full rounded border-gray-300 dark:bg-gray-900 dark:border-gray-700" required>
                            @error('estatura') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">Objetivo principal</label>
                            <input type="text" name="objetivo"
                                   value="{{ old('objetivo', $evaluacion->objetivo ?? '') }}"
                                   class="w-full rounded border-gray-300 dark:bg-gray-900 dark:border-gray-700" required>
                            @error('objetivo') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">Nivel de actividad física</label>
                            <select name="actividad_fisica"
                                    class="w-full rounded border-gray-300 dark:bg-gray-900 dark:border-gray-700" required>
                                @php
                                    $niveles = ['Baja', 'Media', 'Alta'];
                                    $valorActual = old('actividad_fisica', $evaluacion->actividad_fisica ?? '');
                                @endphp
                                <option value="">-- Selecciona --</option>
                                @foreach($niveles as $nivel)
                                    <option value="{{ $nivel }}" {{ $valorActual === $nivel ? 'selected' : '' }}>
                                        {{ $nivel }}
                                    </option>
                                @endforeach
                            </select>
                            @error('actividad_fisica') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">
                                Restricciones / alergias / enfermedades (opcional)
                            </label>
                            <textarea name="restricciones"
                                      class="w-full rounded border-gray-300 dark:bg-gray-900 dark:border-gray-700"
                                      rows="3">{{ old('restricciones', $evaluacion->restricciones ?? '') }}</textarea>
                            @error('restricciones') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                    class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                                {{ $evaluacion ? 'Actualizar evaluación' : 'Guardar evaluación' }}
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
