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

    <!-- Barra de Navegación -->
    <nav class="bg-blue-500 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="text-white text-lg font-bold">Warnify</a>
            <div>
                <a href="/direccion1" class="text-white px-4">Dirección 1</a>
                <a href="/direccion2" class="text-white px-4">Dirección 2</a>
                <a href="/direccion3" class="text-white px-4">Dirección 3</a>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <main class="flex-grow container mx-auto my-4">
        @yield('content')
    </main>

    <!-- Pie de Página -->
    <footer class="bg-gray-800 p-4 text-center text-white">
        <p>&copy; {{ date('Y') }} Warnify. Todos los derechos reservados.</p>
    </footer>

</body>
</html>
