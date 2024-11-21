<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Página Principal')</title>
    
    <!-- Agregar el favicon -->
    <link rel="icon" href="{{ asset('Logo-Warnify.ico') }}" type="image/x-icon">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Incluir CSS y JS de Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <style>
        #results {
            list-style-type: none;
            padding: 0;
            max-height: 200px;
            overflow-y: scroll;
            border: 1px solid #ccc;
            margin-top: 10px;
        }
        #results li {
            padding: 8px;
            cursor: pointer;
        }
        #results li:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body class="flex flex-col min-h-screen bg-gray-100 font-sans">
    <header>
        @include('layouts.nav')
    </header>

    <main class="container flex-grow flex flex-col w-full mx-auto my-4">
        @yield('content')
    </main>

    <footer class="bg-blue-950 p-4 text-center text-white">
        <p>&copy; {{ date('Y') }} Warnify. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</body>
</html>
