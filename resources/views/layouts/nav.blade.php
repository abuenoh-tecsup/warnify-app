<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Responsive Navbar by @rzcodes</title>
    <style>
        #menu-toggle:checked+#menu {
            display: block;
        }
    </style>
</head>

<body>
    <nav class="lg:px-16 px-6 bg-blue-950 shadow-md flex flex-wrap items-center lg:py-0 py-2">
        <div class="flex-1 flex justify-between items-center py-3">
            <a href="/" class="flex text-xl font-semibold">
                <div class="text-white">Warnify</div>
            </a>
        </div>
        <label for="menu-toggle" class="cursor-pointer lg:hidden block">
            <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                viewBox="0 0 20 20">
                <title>menu</title>
                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
            </svg>
        </label>
        <input class="hidden" type="checkbox" id="menu-toggle" />
        <div class="hidden lg:flex lg:items-center lg:w-auto w-full" id="menu">
            <nav>
                <ul class="text-xl text-center items-center gap-x-5 pt-4 md:gap-x-4 lg:text-lg lg:flex  lg:pt-0">
                    <li class="py-2 lg:py-0 ">
                        <a class="text-white hover:pb-4 hover:border-b-4 hover:border-yellow-400" href="/inicio">
                            Inicio
                        </a>
                    </li>
                    <li class="py-2 lg:py-0 ">
                        <a class="text-white hover:pb-4 hover:border-b-4 hover:border-yellow-400" href="/nuevo_reporte">
                            Nuevo reporte
                        </a>
                    </li>
                    <li class="py-2 lg:py-0 ">
                        <a class="text-white hover:pb-4 hover:border-b-4 hover:border-yellow-400" href="/mis_reportes">
                            Mis reportes
                        </a>
                    </li>
                    <li class="py-2 lg:py-0 ">
                        <a class="text-white hover:pb-4 hover:border-b-4 hover:border-yellow-400" href="/mapa">
                            Mapa
                        </a>
                    </li>
                    <li class="py-2 lg:py-0 ">
                        <a class="text-white hover:pb-4 hover:border-b-4 hover:border-yellow-400" href="/cuenta">
                            Cuenta
                        </a>
                    </li>
                    <li class="py-2 lg:py-0 ">
                        <a class="text-white hover:pb-4 hover:border-b-4 hover:border-yellow-400" href="#">
                            About
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </nav>
</body>

</html>
