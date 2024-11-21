<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-blue-950">
        <div class="min-h-screen flex flex-col justify-center items-center">
            <div class="text-center">
                <h1 class="font-bold text-white mb-6" style="font-family: 'Poppins', sans-serif; font-size: 96px;">
                    Warnify
                </h1>

                <div class="flex justify-center mb-6">
                    <img src="{{ asset('Logo Warnify.jpeg') }}" alt="Logo Warnify" class="w-48 h-auto">
                </div>
            </div>

            <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>

