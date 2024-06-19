<div class="space-y-6">

    <div class="grid grid-cols-2 gap-6">
        <div>
            <x-input-label for="ficha" :value="__('Ficha')" />
            <x-text-input id="ficha" name="ficha" type="text" class="block w-full mt-1"
                :value="old('ficha', $aspirante?->ficha)" autocomplete="ficha" placeholder="Ficha" />
            <x-input-error class="mt-2" :messages="$errors->get('ficha')" />
        </div>
        <div>
            <x-input-label for="nombre" :value="__('Nombre')" />
            <x-text-input id="nombre" name="nombre" type="text" class="block w-full mt-1"
                :value="old('nombre', $aspirante?->nombre)" autocomplete="nombre" placeholder="Nombre" />
            <x-input-error class="mt-2" :messages="$errors->get('nombre')" />
        </div>
    </div>
    <div>
        <x-input-label for="curp" :value="__('CURP')" />
        <x-text-input id="curp" name="curp" type="text" class="block w-full mt-1"
            :value="old('curp', $aspirante?->curp)" autocomplete="curp" placeholder="Curp" />
        <x-input-error class="mt-2" :messages="$errors->get('curp')" />
    </div>
    <div>
        <x-input-label for="carrera" :value="__('Carrera')" />
        <x-text-input id="carrera" name="carrera" type="text" class="block w-full mt-1"
            :value="old('carrera', $aspirante?->carrera)" autocomplete="carrera" placeholder="Carrera" />
        <x-input-error class="mt-2" :messages="$errors->get('carrera')" />
    </div>
    <div class="grid grid-cols-2 gap-6">
        <div>
            <x-input-label for="evaluado" :value="__('Evaluado')" />

            <select id="evaluado" name="evaluado"
                class="block w-full mt-1 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="1" {{ old('evaluado', $aspirante?->evaluado) == 1 ? 'selected' : '' }}>Si</option>
                <option value="0" {{ old('evaluado', $aspirante?->evaluado) == 0 ? 'selected' : '' }}>No</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('evaluado')" />
        </div>
        <div>
            <x-input-label for="puntaje" :value="__('Puntaje')" />
            <x-text-input id="puntaje" name="puntaje" type="number" min="0" max="100" class="block w-full mt-1"
                :value="old('puntaje', $aspirante?->puntaje)" autocomplete="puntaje" placeholder="Puntaje" />
            <x-input-error class="mt-2" :messages="$errors->get('puntaje')" />
        </div>
    </div>
    <div class="grid grid-cols-3 gap-6">
        <div>
            <x-input-label for="fecha_evaluacion" :value="__('Fecha Evaluacion')" />
            <x-text-input id="fecha_evaluacion" name="fecha_evaluacion" type="date" class="block w-full mt-1"
                :value="old('fecha_evaluacion', $aspirante?->fecha_evaluacion?->format('Y-m-d'))"
                autocomplete="fecha_evaluacion" />
            <x-input-error class="mt-2" :messages="$errors->get('fecha_evaluacion')" />
        </div>
        <div>
            <x-input-label for="fecha_seleccion" :value="__('Fecha Seleccion')" />
            <x-text-input id="fecha_seleccion" name="fecha_seleccion" type="date" class="block w-full mt-1"
                :value="old('fecha_seleccion', $aspirante?->fecha_seleccion?->format('Y-m-d'))"
                autocomplete="fecha_seleccion" />
            <x-input-error class="mt-2" :messages="$errors->get('fecha_seleccion')" />
        </div>
        <div>
            <x-input-label for="fecha_acceso" :value="__('Fecha Acceso')" />
            <x-text-input id="fecha_acceso" name="fecha_acceso" type="date" pattern="\d{4}-\d{2}-\d{2}"
                class="block w-full mt-1" :value="old('fecha_acceso', $aspirante?->fecha_acceso?->format('Y-m-d'))"
                autocomplete="fecha_acceso" />
            <x-input-error class="mt-2" :messages="$errors->get('fecha_acceso')" />
        </div>
    </div>
    <div>
        <!-- Hidden input for periodo -->
        <input type="hidden" name="periodo" value="{{ date('Y') }}" />
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Guardar</x-primary-button>
    </div>
</div>