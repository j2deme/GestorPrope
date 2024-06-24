<x-guest-layout>
  <!-- Session Status -->
  <x-auth-session-status class="mb-4" :status="session('status')" />

  <!-- Notification -->
  <x-notification />

  <p class="py-2 text-justify">
    A continuación se muestra la información de tu ficha de aspirante, así como el turno seleccionado para el curso.
    Toma nota de estos datos.
  </p>
  @if (isset($confirmar) && $confirmar)
  <p class="py-2 text-justify">
    Mantente al pendiente del correo electrónico que proporcionaste en tu ficha, ya que por ese medio se te notificará
    cualquier cambio o información relevante.
  </p>
  @endif
  <!-- Tabla con datos de la ficha -->
  <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
            Ficha
          </th>
          <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
            Nombre
          </th>
          <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
            Aula
          </th>
          <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
            Horario
          </th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <tr>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-center text-gray-900">{{ $aspirante->ficha }}</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-wrap">
            <div class="text-sm text-center text-gray-900">{{ $aspirante->nombre }}</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-center text-gray-900">{{ $grupo?->aula }}</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-center text-gray-900">{{ str_pad($grupo?->horario->hora_inicio, 2, '0',
              STR_PAD_LEFT) }} - {{
              str_pad($grupo?->horario->hora_fin, 2, '0', STR_PAD_LEFT) }}</div>
          </td>
        </tr>
      </tbody>
    </table>

    <p class="py-2 text-justify">
      Para cualquier aclaración, por favor comunícate al Departamento de Desarrollo Académico.
    </p>

    <a href="{{ route('home') }}"
      class="inline-flex items-center justify-center w-full px-4 py-2 mb-2 text-base font-medium text-white border border-transparent rounded-md shadow-sm bg-sky-800 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-800 sm:text-sm">
      Aceptar
    </a>
</x-guest-layout>