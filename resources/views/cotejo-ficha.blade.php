<x-guest-layout>
  <!-- Session Status -->
  <x-auth-session-status class="mb-4" :status="session('status')" />

  <!-- Notification -->
  <x-notification />

  <p class="py-2 text-justify">
    Agradecemos tu preferencia al aplicar para nuevo ingreso al Instituto Tecnológico de Ciudad Valles.
  </p>
  <p class="py-2 text-justify">
    De acuerdo con los registros, ya seleccionaste previamente un turno para curso propedéutico.
  </p>
  <!-- Tabla con datos de la ficha -->
  <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
            Ficha
          </th>
          <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
            Nombre
          </th>
          <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
            Carrera
          </th>
          <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
            Turno
          </th>
          <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
            Fecha
          </th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <tr>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">9999</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">Nombre del alumno</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">Ingeniería en Sistemas Computacionales</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">Matutino</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">2021-09-01</div>
          </td>
        </tr>
      </tbody>
    </table>

    <p class="py-2 text-justify">
      Para cualquier aclaración, por favor comunícate al Departamento de Desarrollo Académico.
    </p>
</x-guest-layout>