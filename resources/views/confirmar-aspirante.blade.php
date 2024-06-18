<x-guest-layout>
  <!-- Session Status -->
  <x-auth-session-status class="mb-4" :status="session('status')" />

  <!-- Notification -->
  <x-notification />

  <p class="py-2 text-justify">
    Antes de continuar con el proceso de registro al curso propedéutico, por favor verifica los datos de tu ficha.
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
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <tr>
          <td class="px-6 py-4 whitespace-nowrap text-wrap">
            <div class="text-sm text-gray-900">{{ $aspirante->ficha }}</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-wrap">
            <div class="text-sm text-gray-900">{{ $aspirante->nombre }}</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-wrap">
            <div class="text-sm text-gray-900">{{ $aspirante->carrera }}</div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <p class="py-2 text-justify">
    Si alguno de los datos no coincide con tu información, por favor comunícate al Departamento de Desarrollo Académico
    a la brevedad.
  </p>
  <p class="py-2 text-justify">
    ¿Estas seguro de continuar la selección de turno para el curso propedéutico? Si continuas, se da por entendido que
    los datos son correctos.
  </p>
  <div class="flex justify-center space-x-4">
    <a href="{{ route('home') }}"
      class="inline-flex items-center justify-center w-1/2 px-4 py-2 text-base font-medium text-white bg-red-800 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-800 sm:text-sm">
      Cancelar
    </a>
    <a href="{{ route('seleccion-grupo') }}"
      class="inline-flex items-center justify-center w-1/2 px-4 py-2 text-base font-medium text-white border border-transparent rounded-md shadow-sm bg-sky-800 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-800 sm:text-sm">
      Continuar
    </a>
  </div>
</x-guest-layout>