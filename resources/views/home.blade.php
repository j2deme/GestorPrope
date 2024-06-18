<x-guest-layout>
  <!-- Session Status -->
  <x-auth-session-status class="mb-4" :status="session('status')" />

  <!-- Notification -->
  <x-notification />

  <p class="py-2 text-justify">
    Agradecemos tu preferencia al aplicar para nuevo ingreso al Instituto Tecnológico de Ciudad Valles.
  </p>
  <p class="py-2 text-justify">
    Para continuar con el proceso de registro al curso propedéutico, por favor ingresa tu número de ficha y CURP.
  </p>

  <form class="max-w-sm mx-auto" method="post" action="{{ route('cotejo-ficha-post') }}">
    @csrf
    <div class="mb-5">
      <label for="ficha" class="block text-sm font-medium text-gray-700">
        Número de ficha
      </label>
      <input type="text" name="ficha" id="ficha"
        class="block w-full px-3 py-2 mt-1 text-gray-700 border rounded-md shadow-sm focus:ring-sky-800 focus:border-sky-800 sm:text-sm"
        placeholder="9999" required>
    </div>

    <div class="mb-5">
      <label for="curp" class="block text-sm font-medium text-gray-700">
        CURP
      </label>
      <input type="text" name="curp" id="curp"
        class="block w-full px-3 py-2 mt-1 text-gray-700 border rounded-md shadow-sm focus:ring-sky-800 focus:border-sky-800 sm:text-sm"
        placeholder="AAAA999999AAAAAA99" required>
    </div>

    <button type="submit"
      class="inline-flex items-center justify-center w-full px-4 py-2 text-base font-medium text-white border border-transparent rounded-md shadow-sm bg-sky-800 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-800 sm:text-sm">
      Continuar
    </button>
  </form>

  {{-- @if (Route::has('login'))
  <nav class="flex justify-end flex-1 -mx-3">
    @auth
    <a href="{{ url('/dashboard') }}"
      class="px-3 py-2 text-black transition rounded-md ring-1 ring-transparent hover:text-black/70 focus:outline-none focus-visible:ring-sky-800 dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
      {{ __('Dashboard') }}
    </a>
    @else
    <a href="{{ route('login') }}"
      class="px-3 py-2 text-black transition rounded-md ring-1 ring-transparent hover:text-black/70 focus:outline-none focus-visible:ring-sky-800 dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
      {{ __('Log in') }}
    </a>
    @endauth
  </nav>
  @endif
  --}}

</x-guest-layout>