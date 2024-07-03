<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Grupos') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-full mx-auto space-y-6 sm:px-6 lg:px-8">
      <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
        <div class="w-full">
          <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
              <h1 class="text-base font-semibold leading-6 text-gray-900">{{ __('Grupos') }}</h1>
              <p class="mt-2 text-sm text-gray-700">Período {{ date('Y') }}.</p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
              <a type="button" href="{{ route('grupos.create') }}"
                class="block px-3 py-2 text-sm font-semibold text-center text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Agregar
                grupo</a>
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
                      </th>

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
                      <th scope="col"
                        class="px-3 py-3 text-xs font-semibold tracking-wide text-center text-gray-500 uppercase">
                        Estatus
                      </th>
                      <th scope="col" class="px-3 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase">
                        <div class="flex items-center justify-center w-full">
                          <x-heroicon-o-cog-6-tooth class="w-5 h-5 m-2" />
                        </div>
                      </th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($grupos as $grupo)
                    <tr class="even:bg-gray-50">
                      <td class="py-4 pl-4 pr-3 text-sm font-semibold text-center text-gray-900 whitespace-nowrap">{{
                        ++$i }}</td>
                      <td class="px-3 py-4 text-sm text-center text-gray-500 whitespace-nowrap">{{ $grupo->nombre }}
                      </td>
                      <td class="px-3 py-4 text-sm text-center text-gray-500 whitespace-nowrap">{{ $grupo->cupo }}</td>
                      <td class="px-3 py-4 text-sm text-center text-gray-500 whitespace-nowrap">{{ $grupo->inscritos }}
                      </td>
                      <td class="px-3 py-4 text-sm text-center text-gray-500 whitespace-nowrap">{{ $grupo->aula }}</td>
                      <td class="px-3 py-4 text-sm text-center text-gray-500 whitespace-nowrap">{{
                        $grupo->horario->display }}</td>
                      <td class="px-3 py-4 text-sm text-center text-gray-500 whitespace-nowrap">
                        <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                          <div
                            class="{{ ($grupo->inscritos == $grupo->cupo) ? 'bg-green-500' : 'bg-blue-600' }} text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                            style="width: {{ ($grupo->inscritos == 0) ? '0' : ($grupo->inscritos / $grupo->cupo) * 100 }}%">
                            {{ ($grupo->inscritos == 0) ? '0' : round(($grupo->inscritos / $grupo->cupo) * 100) }}%
                          </div>
                        </div>
                      </td>
                      <td class="flex items-center py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap">
                        <form action="{{ route('grupos.destroy', $grupo->id) }}" method="POST"
                          class="flex items-center justify-center w-full">
                          <a href="{{ route('grupos.show', $grupo->id) }}"
                            class="mr-2 font-bold text-gray-600 hover:text-gray-900">
                            <x-heroicon-o-eye class="w-5 h-5" />
                          </a>
                          <a href="{{ route('grupos.edit', $grupo->id) }}"
                            class="mr-2 font-bold text-indigo-600 hover:text-indigo-900">
                            <x-heroicon-o-pencil class="w-5 h-5" />
                          </a>
                          @csrf
                          @method('DELETE')
                          <a href="{{ route('grupos.destroy', $grupo->id) }}"
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
                  {!! $grupos->withQueryString()->links() !!}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>