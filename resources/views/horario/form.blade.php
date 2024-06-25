<div class="space-y-6">

    <div>
        <x-input-label for="hora_inicio" :value="__('Hora Inicio')" />
        <!-- Styled select -->
        <select id="hora_inicio" name="hora_inicio"
            class="block w-full mt-1 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <option value="">Seleccione una hora</option>
            @for ($i = 7; $i <= 18; $i++) <option value="{{ $i }}" {{ old('hora_inicio', $horario?->hora_inicio) == $i ?
                'selected' :
                '' }}>
                {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00
                </option>
                @endfor
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('hora_inicio')" />
    </div>
    <div>
        <x-input-label for="hora_fin" :value="__('Hora Fin')" />
        <select id="hora_fin" name="hora_fin"
            class="block w-full mt-1 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <option value="">Seleccione una hora</option>
            @for ($i = 7; $i <= 18; $i++) <option value="{{ $i }}" {{ old('hora_fin', $horario?->hora_fin) == $i ?
                'selected' :
                '' }}>
                {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00
                </option>
                @endfor
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('hora_fin')" />
    </div>
    <div>
        <x-input-label for="descripcion" :value="__('Días')" />
        <x-text-input id="descripcion" name="descripcion"
            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            :value="old('descripcion', $horario?->descripcion)" autocomplete="descripcion"
            placeholder="Especifique las siglas para los días del horario" />
        <x-input-error class="mt-2" :messages="$errors->get('descripcion')" />
    </div>
    <div>
        <!-- Hidden input to set periodo -->
        <input type="hidden" name="periodo" value="{{ $periodo ?? date('Y') }}" />
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Guardar</x-primary-button>
    </div>
</div>