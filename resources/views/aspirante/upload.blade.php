{{-- Create a form to upload aspirantes CSV --}}
<x-guest-layout>
  <x-auth-session-status class="mb-4" :status="session('status')" />
  <x-notification />
  <div class="overflow-hidden bg-white sm:rounded-lg">
    <div class="p-6 text-gray-900">
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Subir archivo CSV') }}
      </h2>
      <p class="text-sm text-gray-500">El archivo debe contener las siguientes columnas</p>
      <ul class="text-sm text-gray-500 list-disc list-inside">
        <li>Ficha</li>
        <li>Nombre</li>
        <li>CURP</li>
        <li>Carrera</li>
        <li>Evaluado (SI / NO)</li>
        <li>Puntaje (0 - 100)</li>
        <li>Fecha evaluación</li>
      </ul>
      <form action="{{ route('aspirantes.upload.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Date selector -->
        <div class="mt-4">
          <x-input-label for="fecha" :value="__('Fecha de acceso')" />
          <!-- Adds a help text to the input -->
          <p class="text-sm text-gray-500">Se establecerá para los aspirantes incluídos en el archivo</p>
          <x-text-input id="fecha" class="block w-full mt-1" type="date" name="fecha" required />
        </div>
        <div class="mt-4">
          <x-input-label for="file" :value="__('Archivo CSV')" />
          <label>
            <input type="file"
              class="text-sm text-grey-500 file:mr-5 file:py-2 file:px-6 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-700 hover:file:cursor-pointer hover:file:bg-blue-50 hover:file:text-blue-700"
              id="file" name="file" required />
          </label>
        </div>
        <div class="flex justify-end mt-4 items center">
        </div>
        <div class="flex items-center gap-4 mt-4">
          <x-primary-button>Subir</x-primary-button>
          <a href="{{ route('aspirantes.index') }}" class="text-sm text-gray-600 underline">Cancelar</a>
        </div>
      </form>
    </div>
  </div>

</x-guest-layout>