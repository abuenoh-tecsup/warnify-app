<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Responsive Navbar Animada</title>
    <style>
        /* General Styles */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        nav {
            background-color: #1e3a8a;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Navigation Styles */
        #menu-toggle:checked+#menu {
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
            color: #fff;
            display: inline-block;
            padding: 10px 15px;
            transition: all 0.3s ease-in-out;
        }

        a:hover {
            color: #facc15;
            transform: scale(1.1);
        }

        .menu-item {
            transition: opacity 0.3s ease, transform 0.3s ease;
            opacity: 0;
            transform: translateY(-10px);
        }

        #menu-toggle:checked~#menu .menu-item {
            opacity: 1;
            transform: translateY(0);
        }

        /* Responsive Design */
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
    </style>
</head>

<body>
    <nav class="lg:px-16 px-6 flex flex-wrap items-center lg:py-0 py-2">
        <div class="flex-1 flex justify-start items-center py-3">
            <a href="/" class="flex items-center text-xl font-semibold">
                <img src="{{ asset('Logo Warnify.jpeg') }}" alt="Logo Warnify" class="w-10 h-auto" />
                <div class="text-white ml-2">Warnify</div>
            </a>
        </div>

        <label for="menu-toggle" class="cursor-pointer lg:hidden block" aria-label="Toggle Menu">
            <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                viewBox="0 0 20 20">
                <title>Menu</title>
                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
            </svg>
        </label>
        <input class="hidden" type="checkbox" id="menu-toggle" />
        <div class="hidden lg:flex lg:items-center lg:w-auto w-full" id="menu">
            <nav>
                <ul class="text-xl text-center items-center gap-x-5 pt-4 md:gap-x-4 lg:text-lg lg:flex lg:pt-0">
                    <li class="py-2 lg:py-0 menu-item">
                        <a class="text-white hover:border-b-4 hover:border-yellow-400" href="/inicio">
                            Inicio
                        </a>
                    </li>
                    @if (Auth::user()->isCiudadano())
                    <li class="py-2 lg:py-0 menu-item">
                        <a class="text-white hover:border-b-4 hover:border-yellow-400" href="/nuevo_reporte">
                            Nuevo reporte
                        </a>
                    </li>
                    @endif
                    <li class="py-2 lg:py-0 menu-item">
                        <a class="text-white hover:border-b-4 hover:border-yellow-400"
                            href="{{ route('reportes.list', ['filter' => 'all']) }}">
                            Reportes
                        </a>
                    </li>
                    <li class="py-2 lg:py-0 menu-item">
                        <a class="text-white hover:border-b-4 hover:border-yellow-400" href="/cuenta">
                            Cuenta
                        </a>
                    </li>
                    @if (Auth::user()->isCiudadano())
                    <li class="py-2 lg:py-0 menu-item">
                        <a class="text-white hover:border-b-4 hover:border-yellow-400" href="{{ route('comentarios.index') }}">
                            Acerca de
                        </a>
                    </li>
                    @endif
                </ul>
            </nav>
        </div>
    </nav>
</body>

</html>
