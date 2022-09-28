<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="h-full">
        <div class="min-h-full">
            @include('layouts.nav')

            <div class="py-10">
                <main>
                    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>

        @livewireScripts
    </body>
</html>

