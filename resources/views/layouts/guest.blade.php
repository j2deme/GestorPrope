<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-900">
    <!-- Login link on the top left corner -->
    <div class="absolute top-0 right-0 p-4">
        @if (Route::has('login'))
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
    </div>
    <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0">
        <div>
            {{-- <a href="/">
                <x-application-logo class="w-20 h-20 text-gray-500 fill-current" />
            </a> --}}
            <!-- Page Heading -->
            <header>
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <h1 class="text-xl font-semibold leading-tight text-center text-gray-800">
                        <a href="{{ route('home') }}">Propedéutico {{ date('Y') }}</a>
                    </h1>
                    <h2 class="text-center">TECNM Campus Ciudad Valles</h2>
                </div>
            </header>
        </div>

        <div class="w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md sm:max-w-lg sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>