<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Horarios') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-full mx-auto space-y-6 sm:px-6 lg:px-8">
      <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
        <div class="w-full">
          <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
              <h1 class="text-base font-semibold leading-6 text-gray-900">{{ __('Horarios') }}</h1>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
              <a type="button" href="{{ route('horarios.create') }}"
                class="block px-3 py-2 text-sm font-semibold text-center text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Agregar
                horario</a>
            </div>
          </div>

          <div class="flow-root">
            <div class="mt-8 overflow-x-auto">
              <div class="inline-block min-w-full py-2 align-middle">
                <table class="w-full divide-y divide-gray-300">
                  <thead>
                    <tr>
                      <th scope="col"
                        class="py-3 pl-4 pr-3 text-xs font-semibold tracking-wide text-left text-gray-500 uppercase">
                      </th>
                      <th scope="col"
                        class="py-3 pl-4 pr-3 text-xs font-semibold tracking-wide text-center text-gray-500 uppercase">
                        Hora Inicio</th>
                      <th scope="col"
                        class="py-3 pl-4 pr-3 text-xs font-semibold tracking-wide text-center text-gray-500 uppercase">
                        Hora Fin</th>
                      <th scope="col"
                        class="py-3 pl-4 pr-3 text-xs font-semibold tracking-wide text-center text-gray-500 uppercase">
                        Grupos</th>
                      <th scope="col"
                        class="px-3 py-3 text-xs font-semibold tracking-wide text-center text-gray-500 uppercase">
                        <div class="flex items-center justify-center w-full">
                          <x-heroicon-o-cog-6-tooth class="w-5 h-5 m-2" />
                        </div>
                      </th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($horarios as $horario)
                    <tr class="even:bg-gray-50">
                      <td class="py-4 pl-4 pr-3 text-sm font-semibold text-center text-gray-900 whitespace-nowrap">
                        {{ ++$i }}</td>
                      <td class="px-3 py-4 text-sm text-center text-gray-500 whitespace-nowrap">{{
                        $horario->hora_inicio }}</td>
                      <td class="px-3 py-4 text-sm text-center text-gray-500 whitespace-nowrap">{{
                        $horario->hora_fin }}</td>
                      <td class="px-3 py-4 text-sm text-center text-gray-500 whitespace-nowrap">{{
                        $horario->grupos->count() }}</td>
                      <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap">
                        <form action="{{ route('horarios.destroy', $horario->id) }}" method="POST"
                          class="flex items-center justify-center w-full">
                          <a href="{{ route('horarios.show', $horario->id) }}"
                            class="mr-2 font-bold text-gray-600 hover:text-gray-900">
                            <x-heroicon-o-eye class="w-5 h-5" />
                          </a>
                          <a href="{{ route('horarios.edit', $horario->id) }}"
                            class="mr-2 font-bold text-indigo-600 hover:text-indigo-900">
                            <x-heroicon-o-pencil class="w-5 h-5" />
                          </a>
                          @csrf
                          @method('DELETE')
                          <a href="{{ route('horarios.destroy', $horario->id) }}"
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
                  {!! $horarios->withQueryString()->links() !!}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>