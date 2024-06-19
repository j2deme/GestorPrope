<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ $grupo->name ?? __('Show') . " " . __('Grupo') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-full mx-auto space-y-6 sm:px-6 lg:px-8">
      <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
        <div class="w-full">
          <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
              <h1 class="text-base font-semibold leading-6 text-gray-900">{{ __('Show') }} Grupo</h1>
              <p class="mt-2 text-sm text-gray-700">Periodo {{ date('Y') }}</p>
              <x-notification />
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
              <a type="button" href="{{ route('grupos.index') }}"
                class="block px-3 py-2 text-sm font-semibold text-center text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Atrás</a>
            </div>
          </div>

          <div class="flow-root">
            <div class="mt-8 overflow-x-auto">
              <div class="inline-block min-w-full py-2 align-middle">
                <table class="w-full divide-y divide-gray-300">
                  <thead>
                    <tr>
                      <th scope="col"
                        class="py-3 pl-4 pr-3 text-xs font-semibold tracking-wide text-center text-gray-500 uppercase">
                        Nombre</th>
                      <th scope="col"
                        class="py-3 pl-4 pr-3 text-xs font-semibold tracking-wide text-center text-gray-500 uppercase">
                        Cupo</th>
                      <th scope="col"
                        class="py-3 pl-4 pr-3 text-xs font-semibold tracking-wide text-center text-gray-500 uppercase">
                        Inscritos</th>
                      <th scope="col"
                        class="py-3 pl-4 pr-3 text-xs font-semibold tracking-wide text-center text-gray-500 uppercase">
                        Aula</th>
                      <th scope="col"
                        class="py-3 pl-4 pr-3 text-xs font-semibold tracking-wide text-center text-gray-500 uppercase">
                        Horario</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-300">
                    <tr>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-center text-gray-900">{{ $grupo->nombre }}</div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-center text-gray-900">{{ $grupo->cupo }}</div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-center text-gray-900">{{ $grupo->inscritos }}</div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-center text-gray-900">{{ $grupo->aula }}</div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-center text-gray-900">{{ $grupo->horario->hora_inicio }} - {{
                          $grupo->horario->hora_fin }}</div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- Tabla de aspirantes -->
              <div class="flow-root">
                <div class="mt-8 overflow-x-auto">
                  <div class="inline-block min-w-full py-2 align-middle">
                    <table class="w-full divide-y divide-gray-300">
                      <thead>
                        <tr>
                          <th scope="col"
                            class="py-3 pl-4 pr-3 text-xs font-semibold tracking-wide text-center text-gray-500 uppercase">
                            Ficha</th>
                          <th scope="col"
                            class="py-3 pl-4 pr-3 text-xs font-semibold tracking-wide text-center text-gray-500 uppercase">
                            Nombre</th>
                          <th scope="col"
                            class="py-3 pl-4 pr-3 text-xs font-semibold tracking-wide text-center text-gray-500 uppercase">
                            Carrera</th>
                          <th scope="col"
                            class="py-3 pl-4 pr-3 text-xs font-semibold tracking-wide text-center text-gray-500 uppercase">
                            Puntaje</th>
                          <th scope="col"
                            class="py-3 pl-4 pr-3 text-xs font-semibold tracking-wide text-center text-gray-500 uppercase">
                            Acciones</th>
                        </tr>
                      </thead>
                      <tbody class="bg-white divide-y divide-gray-300">
                        @foreach ($grupo->aspirantes as $aspirante)
                        <tr>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-center text-gray-900">{{ $aspirante->ficha }}</div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-center text-gray-900">{{ $aspirante->nombre }}</div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-center text-gray-900">{{ $aspirante->carrera }}</div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-center text-gray-900">{{ $aspirante?->puntaje }}</div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex justify-center w-full items -center">
                              <!-- Remove aspirante from grupo -->
                              <form action="{{ route('grupos.remove', [$grupo->id, $aspirante->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="mr-2 font-bold text-red-600 hover:text-red-900"
                                  onclick="event.preventDefault(); confirm('¿Estás seguro de continuar?') ? this.closest('form').submit() : false;">
                                  <x-heroicon-o-user-minus class="w-5 h-5" />
                                </button>
                            </div>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
</x-app-layout>