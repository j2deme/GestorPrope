<div class="space-y-6">

    <div>
        <x-input-label for="nombre" :value="__('Nombre')" />
        <x-text-input id="nombre" name="nombre" type="text" class="block w-full mt-1"
            :value="old('nombre', $grupo?->nombre)" autocomplete="nombre" placeholder="Nombre" />
        <x-input-error class="mt-2" :messages="$errors->get('nombre')" />
    </div>
    <div class="flex">
        <div class="w-1/2 pe-3">
            <x-input-label for="cupo" :value="__('Cupo')" />
            <x-text-input id="cupo" name="cupo" type="text" class="block w-full mt-1"
                :value="old('cupo', $grupo?->cupo)" autocomplete="cupo" placeholder="Cupo" />
            <x-input-error class="mt-2" :messages="$errors->get('cupo')" />
        </div>
        <input type="hidden" id="inscritos" name="inscritos" value="{{ $grupo?->inscritos ?? 0 }}">
        {{--<div class="w-1/3 pe-3">
            <x-input-label for="inscritos" :value="__('Inscritos')" />
            <x-text-input id="inscritos" name="inscritos" type="text" class="block w-full mt-1"
                :value="old('inscritos', $grupo?->inscritos ?? 0)" autocomplete="inscritos" placeholder="Inscritos"
                readonly="readonly" />
            <x-input-error class="mt-2" :messages="$errors->get('inscritos')" />
        </div>--}}
        <div class="w-1/2">
            <x-input-label for="aula" :value="__('Aula')" />
            <x-text-input id="aula" name="aula" type="text" class="block w-full mt-1"
                :value="old('aula', $grupo?->aula)" autocomplete="aula" placeholder="Aula" />
            <x-input-error class="mt-2" :messages="$errors->get('aula')" />
        </div>
    </div>
    <div>
        <!-- Hidden input for activo -->
        <input type="hidden" name="activo" value="1" />
        {{--
        <x-input-label for="activo" :value="__('Activo')" />
        <select name="activo" id="activo"
            class="block w-full mt-1 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <option value="">Seleccione un estado</option>
            <option value="1" @if (old('activo', $grupo?->activo) == 1) selected @endif>Activo</option>
            <option value="0" @if (old('activo', $grupo?->activo) == 0) selected @endif>Inactivo</option>
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('activo')" /> --}}
    </div>
    <div>
        <!-- Hidden input for periodo -->
        <input type="hidden" name="periodo" value="{{ date('Y') }}" />
    </div>
    <div>
        <x-input-label for="horario_id" :value="__('Horario Id')" />
        <select name="horario_id" id="horario_id"
            class="block w-full mt-1 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <option value="">Seleccione un horario</option>
            @foreach ($horarios as $horario)
            <option value="{{ $horario->id }}" @if (old('horario_id', $grupo?->horario_id) == $horario->id) selected
                @endif>
                {{ str_pad($horario->hora_inicio, 2, '0', STR_PAD_LEFT) }} - {{ str_pad($horario->hora_fin, 2, '0',
                STR_PAD_LEFT) }}
            </option>
            @endforeach
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('horario_id')" />
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Guardar</x-primary-button>
    </div>
</div>