<x-guest-layout>
  <!-- Session Status -->
  <x-auth-session-status class="mb-4" :status="session('status')" />

  <!-- Notification -->
  <x-notification />

  @if ($aspirante->grupo)
  <p class="py-2 text-justify">
    Ya seleccionaste previamente un turno para curso propedéutico.
  </p>
  <a @else <p class="py-2 text-justify">
    De los turnos disponibles, selecciona el que más te convenga para asistir al curso propedéutico.
    </p>
    <p class="py-2 text-justify">
      <strong>Nota:</strong> Una vez seleccionado el turno, <strong>no</strong> podrás cambiarlo.
    </p>
    @forelse ($turnos as $turno)
    <div class="flex justify-center space-x-4">
      <a href="{{ route('confirmar-turno', ['ficha' => $aspirante->ficha, 'horario' => $turno->horario]) }}"
        class="inline-flex items-center justify-center w-1/2 px-4 py-2 mb-2 text-base font-medium text-white border border-transparent rounded-md shadow-sm bg-sky-800 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-800 sm:text-sm">{{
        $turno->horario->dias ?? '' }} ({{ str_pad($turno->horario->hora_inicio, 2, '0', STR_PAD_LEFT) }} - {{
        str_pad($turno->horario->hora_fin, 2,
        '0',
        STR_PAD_LEFT) }}
      </a>
    </div>
    @empty
    <p class="py-2 text-justify">
      No hay turnos disponibles para seleccionar, por favor, ponte en contacto con el departamento de Desarrollo
      Académico.
    </p>
    @endforelse
    @endif
</x-guest-layout>