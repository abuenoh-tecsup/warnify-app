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
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        nav {
            background-color: #1e3a8a; /* Color de fondo de la barra de navegación */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Ajustes para el menú desplegable */
        #menu-toggle:checked + #menu {
            max-height: 500px;
        }

        #menu {
            display: block;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-in-out;
        }

        ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        a {
            text-decoration: none;
            color: #fff; /* Color de texto blanco para enlaces */
            display: inline-block;
            padding: 10px 15px;
            transition: all 0.3s ease-in-out;
        }

        a:hover {
            color: #facc15; /* Color de texto al hacer hover */
            transform: scale(1.1);
            border-bottom: 2px solid #facc15; /* Subrayado en hover */
        }

        .menu-item {
            transition: opacity 0.3s ease, transform 0.3s ease;
            opacity: 0;
            transform: translateY(-10px);
        }

        #menu-toggle:checked ~ #menu .menu-item {
            opacity: 1;
            transform: translateY(0);
        }

        /* Diseño Responsivo */
        @media (min-width: 1024px) {
            #menu {
                display: flex;
                max-height: none;
                transition: none;
            }

            #menu-toggle {
                display: none;
            }

            .menu-item {
                opacity: 1;
                transform: none;
                transition: none;
            }
        }

        /* Agregar estilos para el icono de menú */
        label[for="menu-toggle"] svg {
            fill: white; /* Color blanco para el icono */
        }

        /* Estilos para el menú de navegación en pantallas más grandes */
        .menu-item a {
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>

<body class="flex flex-col min-h-screen bg-gray-100 font-sans">
    <!-- Barra de navegación -->
    <nav class="lg:px-16 px-6 flex flex-wrap items-center lg:py-0 py-2">
        <div class="flex-1 flex justify-start items-center py-3">
            <a href="/" class="flex items-center text-xl font-semibold">
                <img src="{{ asset('Logo Warnify.jpeg') }}" alt="Logo Warnify" class="w-10 h-auto" />
                <div class="text-white ml-2">Warnify</div>
            </a>
        </div>

        <label for="menu-toggle" class="cursor-pointer lg:hidden block" aria-label="Toggle Menu">
            <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                <title>Menu</title>
                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
            </svg>
        </label>
        <input class="hidden" type="checkbox" id="menu-toggle" />
        <div class="hidden lg:flex lg:items-center lg:w-auto w-full" id="menu">
            <nav>
                <ul class="text-xl text-center items-center gap-x-5 pt-4 md:gap-x-4 lg:text-lg lg:flex lg:pt-0">
                    <li class="py-2 lg:py-0 menu-item">
                        <a class="text-white hover:border-b-4 hover:border-yellow-400" href="/inicio">Inicio</a>
                    </li>
                    @if (Auth::user()->isCiudadano())
                    <li class="py-2 lg:py-0 menu-item">
                        <a class="text-white hover:border-b-4 hover:border-yellow-400" href="/nuevo_reporte">Nuevo reporte</a>
                    </li>
                    @endif
                    <li class="py-2 lg:py-0 menu-item">
                        <a class="text-white hover:border-b-4 hover:border-yellow-400"
                           href="{{ route('reportes.list', ['filter' => 'all', 'state' => 'TODOS', 'order' => 'desc']) }}">
                            Reportes
                        </a>
                    </li>

                    <li class="py-2 lg:py-0 menu-item">
                        <a class="text-white hover:border-b-4 hover:border-yellow-400" href="/cuenta">Cuenta</a>
                    </li>
                    <li class="py-2 lg:py-0 menu-item">
                        <a class="text-white hover:border-b-4 hover:border-yellow-400" href="{{ route('comentarios.index') }}">Acerca de</a>
                    </li>
                </ul>
            </nav>
        </div>
    </nav>

    <header>
        <!-- Header Content (si es necesario) -->
    </header>

    <main class="container flex-grow flex flex-col w-full mx-auto my-4">
        @yield('content')
    </main>

    <footer class="bg-blue-900 p-6 text-center text-white">
        <p class="text-sm mb-2">&copy; {{ date('Y') }} Warnify. Todos los derechos reservados.</p>
        <p class="text-gray-400 text-xs mb-4">
            Si tienes preguntas, inquietudes o sugerencias, contáctanos a través de los siguientes correos:
        </p>
        <div class="flex justify-center space-x-6 mb-4">
            <!-- Correo 1 -->
            <a href="mailto:eduardo.bullon@tecsup.edu.pe"
                class="px-4 py-2 bg-blue-600 text-white font-medium rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
                eduardo.bullon@tecsup.edu.pe
            </a>
            <!-- Correo 2 -->
            <a href="mailto:sonaly.sifuentes@tecsup.edu.pe"
                class="px-4 py-2 bg-blue-600 text-white font-medium rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
                sonaly.sifuentes@tecsup.edu.pe
            </a>
            <!-- Correo 3 -->
            <a href="mailto:alvaro.bueno@tecsup.edu.pe"
                class="px-4 py-2 bg-blue-600 text-white font-medium rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
                alvaro.bueno@tecsup.edu.pe
            </a>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</body>

</html>
