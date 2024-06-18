<x-guest-layout>
  <!-- Session Status -->
  <x-auth-session-status class="mb-4" :status="session('status')" />

  <!-- Notification -->
  <x-notification />

  <p class="py-2 text-justify">
    De los turnos disponibles, selecciona el que más te convenga para asistir al curso propedéutico.
  </p>

  @foreach ($turnos as $turno)
  <div class="flex justify-center space-x-4">
    <a href="{{ route('confirmar-turno', $turno->id) }}"
      class="inline-flex items-center justify-center w-1/2 px-4 py-2 text-base font-medium text-white border border-transparent rounded-md shadow-sm bg-sky-800 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-800 sm:text-sm">
      {{ $turno->nombre }}
    </a>
  </div>
  @endforeach
</x-guest-layout>