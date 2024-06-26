<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Aspirantes') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-full mx-auto space-y-6 sm:px-6 lg:px-8">
      <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
        <div class="w-full">
          <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
              <h1 class="text-base font-semibold leading-6 text-gray-900">{{ __('Aspirantes') }}</h1>
              <x-notification />
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
              <form action="{{ route('aspirantes.index') }}" method="GET">
                <div class="flex items-center">
                  <input type="text" name="ficha" placeholder="Buscar aspirante por ficha"
                    class="block w-full px-3 py-2 text-sm text-gray-700 placeholder-gray-400 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                  <button type="submit"
                    class="px-4 py-2 ml-2 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <x-heroicon-c-magnifying-glass class="w-5 h-5" />
                  </button>
                </div>
              </form>
              <!-- Filter by fecha acceso -->
              <form action="{{ route('aspirantes.index') }}" method="GET">
                <div class="flex mt-2 items -center">
                  <select name="fecha_acceso"
                    class="block w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Filtrar por fecha de acceso</option>
                    @foreach ($fechas_acceso as $fecha_acceso)
                    <option value="{{ $fecha_acceso->format('Y-m-d') }}" {{ $fecha_acceso->format('Y-m-d') ==
                      $fecha_seleccionada ? 'selected' : '' }}>
                      {{ $fecha_acceso->format('d/m/Y') }}
                    </option>
                    @endforeach
                  </select>
                  <button type="submit"
                    class="px-4 py-2 ml-2 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <x-heroicon-c-magnifying-glass class="w-5 h-5" />
                  </button>
                </div>
              </form>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
              <a type="button" href="{{ route('aspirantes.create') }}"
                class="block px-3 py-2 text-sm font-semibold text-center text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                title="Agregar aspirante">Agregar aspirante</a>
              <div class="flex pt-1 space-x-2">
                <a type="button" href="{{ route('aspirantes.upload') }}"
                  class="inline-block w-1/2 px-2 py-2 text-sm font-semibold text-center text-white bg-gray-600 rounded-md shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600"
                  title="Subir aspirantes">
                  <x-heroicon-c-arrow-up-tray class="inline-block w-5 h-5" />
                </a>
                <a type="button" href="{{ route('aspirantes.download') }}"
                  class="inline-block w-1/2 px-2 py-2 text-sm font-semibold text-center text-white bg-gray-600 rounded-md shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600"
                  title="Descargar aspirantes">
                  <x-heroicon-c-arrow-down-tray class="inline-block w-5 h-5" />
                </a>
              </div>
            </div>
          </div>
        </div>
        @if ($filtrado)
        <div class="mt-4">
          <span class="text-sm font-semibold text-gray-600">
            @if ($ficha)
            Filtrado por ficha: {{ $ficha }}
            @elseif ($fecha_acceso)
            Filtrado por fecha de acceso: {{ date('d/m/Y', strtotime($fecha_acceso)) }}
            @endif
          </span>
          <a href="{{ route('aspirantes.index') }}"
            class="ml-2 text-sm font-semibold text-indigo-600 hover:text-indigo-900">Quitar filtro</a>
        </div>
        @endif

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
                      CURP</th>
                    <th scope="col"
                      class="py-3 pl-4 pr-3 text-xs font-semibold tracking-wide text-center text-gray-500 uppercase">
                      Carrera</th>
                    <th scope="col"
                      class="py-3 pl-4 pr-3 text-xs font-semibold tracking-wide text-center text-gray-500 uppercase">
                      Evaluado</th>
                    <th scope="col"
                      class="py-3 pl-4 pr-3 text-xs font-semibold tracking-wide text-center text-gray-500 uppercase">
                      Puntaje</th>
                    {{--<th scope="col"
                      class="py-3 pl-4 pr-3 text-xs font-semibold tracking-wide text-center text-gray-500 uppercase">
                      Fecha Evaluacion</th>--}}
                    <th scope="col"
                      class="py-3 pl-4 pr-3 text-xs font-semibold tracking-wide text-center text-gray-500 uppercase">
                      Fecha Acceso</th>
                    <th scope="col"
                      class="py-3 pl-4 pr-3 text-xs font-semibold tracking-wide text-center text-gray-500 uppercase">
                      Fecha Seleccion</th>
                    <th scope="col"
                      class="py-3 pl-4 pr-3 text-xs font-semibold tracking-wide text-center text-gray-500 uppercase">
                      Grupo</th>
                    <th scope="col" class="px-3 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase">
                      <div class="flex items-center justify-center w-full">
                        <x-heroicon-o-cog-6-tooth class="w-5 h-5 m-2" />
                      </div>
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  @foreach ($aspirantes as $aspirante)
                  <tr class="even:bg-gray-50">
                    <td class="py-4 pl-4 pr-3 text-sm font-semibold text-center text-gray-900 whitespace-nowrap">{{
                      $aspirante->ficha }}</td>
                    <td class="px-3 py-4 text-sm text-gray-600 whitespace-nowrap text-wrap">{{
                      $aspirante->nombre }}</td>
                    <td class="px-3 py-4 text-sm text-gray-600 whitespace-nowrap">{{
                      $aspirante->curp }}</td>
                    <td class="px-3 py-4 text-sm text-center text-gray-600 whitespace-nowrap text-wrap">
                      @include('shared.siglas-carrera', ['carrera' => $aspirante->carrera])</td>
                    <td class="px-3 py-4 text-sm text-center text-gray-600 whitespace-nowrap">
                      <div class="flex justify-center">
                        @if ($aspirante->evaluado)
                        <x-heroicon-o-check-circle class="w-5 h-5 text-green-500" />
                        @else
                        <x-heroicon-o-x-circle class="w-5 h-5 text-red-500" />
                        @endif
                      </div>
                    </td>
                    </td>
                    <td class="px-3 py-4 text-sm text-center text-gray-600 whitespace-nowrap">{{
                      $aspirante->puntaje }}</td>
                    {{--<td class="px-3 py-4 text-sm text-center text-gray-600 whitespace-nowrap">
                      {{ $aspirante->fecha_evaluacion == null ? '-' :
                      $aspirante->fecha_evaluacion->format('d/m/Y') }}
                    </td>--}}
                    <td class="px-3 py-4 text-sm text-center text-gray-600 whitespace-nowrap">{{
                      $aspirante->fecha_acceso == null ? '-' :
                      $aspirante->fecha_acceso->format('d/m/Y') }}</td>
                    <td class="px-3 py-4 text-sm text-center text-gray-600 whitespace-nowrap">{{
                      $aspirante->fecha_seleccion == null ? '-' :
                      $aspirante->fecha_seleccion->format('d/m/Y') }}</td>
                    <td class="px-3 py-4 text-sm text-center text-gray-600 whitespace-nowrap">
                      @if ($aspirante->grupo)
                      <a href="{{ route('grupos.show', $aspirante->grupo->id) }}"
                        class="font-semibold text-indigo-600 hover:text-indigo-900">
                        {{ $aspirante->grupo->nombre }}
                      </a>
                      @else
                      -
                      @endif
                    </td>
                    <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap">
                      <form action="{{ route('aspirantes.destroy', $aspirante->id) }}" method="POST"
                        class="flex items-center justify-center w-full">
                        <a href="{{ route('aspirantes.show', $aspirante->id) }}"
                          class="mr-2 font-bold text-gray-600 hover:text-gray-900">
                          <x-heroicon-o-eye class="w-5 h-5" />
                        </a>
                        <a href="{{ route('aspirantes.edit', $aspirante->id) }}"
                          class="mr-2 font-bold text-indigo-600 hover:text-indigo-900">
                          <x-heroicon-o-pencil class="w-5 h-5" />
                        </a>
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('aspirantes.destroy', $aspirante->id) }}"
                          class="font-bold text-red-600 hover:text-red-900"
                          onclick="event.preventDefault(); confirm('¿Estás seguro de continuar?') ? this.closest('form').submit() : false;">
                          <x-heroicon-o-trash class="w-5 h-5" />
                        </a>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>

              <div class="px-4 mt-4">
                {!! $aspirantes->withQueryString()->links() !!}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>