<div class="space-y-6">
    
    <div>
        <x-input-label for="ficha" :value="__('Ficha')"/>
        <x-text-input id="ficha" name="ficha" type="text" class="mt-1 block w-full" :value="old('ficha', $aspirante?->ficha)" autocomplete="ficha" placeholder="Ficha"/>
        <x-input-error class="mt-2" :messages="$errors->get('ficha')"/>
    </div>
    <div>
        <x-input-label for="nombre" :value="__('Nombre')"/>
        <x-text-input id="nombre" name="nombre" type="text" class="mt-1 block w-full" :value="old('nombre', $aspirante?->nombre)" autocomplete="nombre" placeholder="Nombre"/>
        <x-input-error class="mt-2" :messages="$errors->get('nombre')"/>
    </div>
    <div>
        <x-input-label for="curp" :value="__('Curp')"/>
        <x-text-input id="curp" name="curp" type="text" class="mt-1 block w-full" :value="old('curp', $aspirante?->curp)" autocomplete="curp" placeholder="Curp"/>
        <x-input-error class="mt-2" :messages="$errors->get('curp')"/>
    </div>
    <div>
        <x-input-label for="carrera" :value="__('Carrera')"/>
        <x-text-input id="carrera" name="carrera" type="text" class="mt-1 block w-full" :value="old('carrera', $aspirante?->carrera)" autocomplete="carrera" placeholder="Carrera"/>
        <x-input-error class="mt-2" :messages="$errors->get('carrera')"/>
    </div>
    <div>
        <x-input-label for="evaluado" :value="__('Evaluado')"/>
        <x-text-input id="evaluado" name="evaluado" type="text" class="mt-1 block w-full" :value="old('evaluado', $aspirante?->evaluado)" autocomplete="evaluado" placeholder="Evaluado"/>
        <x-input-error class="mt-2" :messages="$errors->get('evaluado')"/>
    </div>
    <div>
        <x-input-label for="puntaje" :value="__('Puntaje')"/>
        <x-text-input id="puntaje" name="puntaje" type="text" class="mt-1 block w-full" :value="old('puntaje', $aspirante?->puntaje)" autocomplete="puntaje" placeholder="Puntaje"/>
        <x-input-error class="mt-2" :messages="$errors->get('puntaje')"/>
    </div>
    <div>
        <x-input-label for="fecha_evaluacion" :value="__('Fecha Evaluacion')"/>
        <x-text-input id="fecha_evaluacion" name="fecha_evaluacion" type="text" class="mt-1 block w-full" :value="old('fecha_evaluacion', $aspirante?->fecha_evaluacion)" autocomplete="fecha_evaluacion" placeholder="Fecha Evaluacion"/>
        <x-input-error class="mt-2" :messages="$errors->get('fecha_evaluacion')"/>
    </div>
    <div>
        <x-input-label for="fecha_seleccion" :value="__('Fecha Seleccion')"/>
        <x-text-input id="fecha_seleccion" name="fecha_seleccion" type="text" class="mt-1 block w-full" :value="old('fecha_seleccion', $aspirante?->fecha_seleccion)" autocomplete="fecha_seleccion" placeholder="Fecha Seleccion"/>
        <x-input-error class="mt-2" :messages="$errors->get('fecha_seleccion')"/>
    </div>
    <div>
        <x-input-label for="periodo" :value="__('Periodo')"/>
        <x-text-input id="periodo" name="periodo" type="text" class="mt-1 block w-full" :value="old('periodo', $aspirante?->periodo)" autocomplete="periodo" placeholder="Periodo"/>
        <x-input-error class="mt-2" :messages="$errors->get('periodo')"/>
    </div>
    <div>
        <x-input-label for="fecha_acceso" :value="__('Fecha Acceso')"/>
        <x-text-input id="fecha_acceso" name="fecha_acceso" type="text" class="mt-1 block w-full" :value="old('fecha_acceso', $aspirante?->fecha_acceso)" autocomplete="fecha_acceso" placeholder="Fecha Acceso"/>
        <x-input-error class="mt-2" :messages="$errors->get('fecha_acceso')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>