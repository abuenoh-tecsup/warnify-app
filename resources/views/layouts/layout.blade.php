<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Página Principal')
    </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-100">
    <header>
        @include('layouts.nav')
    </header>

    <main class="flex-grow container mx-auto my-4">
        @yield('content')
    </main>

    <footer class="bg-blue-950 p-4 text-center text-white">
        <p>&copy; {{ date('Y') }} Warnify. Todos los derechos reservados.</p>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</body>
</html>
