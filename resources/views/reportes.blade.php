@extends('layouts.layout')

@section('title', 'Mis reportes')

@section('content')
<h2 class="text-2xl font-bold">Reportes</h2>
<div class="flex-grow h-full grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Sección de Listado de Reportes -->
    <div class="col-span-1 flex flex-col">
        <h2 class="text-xl font-bold mb-1">Listado</h2>
        <div class="flex justify-start space-x-4 mb-4">
            <!-- Botón para ver todos los reportes -->
            <a href="{{ route('reportes.list', ['filter' => 'all']) }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Todos los Reportes
            </a>

            <!-- Botón para ver los reportes propios -->
            <a href="{{ route('reportes.list', ['filter' => 'own']) }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                Mis Reportes
            </a>
        </div>
        <div class="flex-grow bg-gray-200 p-4 rounded-xl h-40 overflow-y-scroll">
            @foreach ($reportes as $reporte)
            <x-report-card
                fecha="{{$reporte->fecha_reporte}}"
                titulo="{{$reporte->titulo}}"
                descripcion="{{$reporte->descripcion}}"
                estado="{{$reporte->estado_reporte}}"
                reporteId="{{$reporte->id_reporte}}"
            />
            @endforeach
        </div>
    </div>

    <!-- Sección de Detalles del Reporte Seleccionado -->
    <div class="col-span-1 md:col-span-2 flex flex-col">
        <h2 class="text-xl font-bold mb-1">Detalles</h2>
        <div class="bg-gray-200 p-6 rounded-xl flex-grow shadow-lg">
            @if ($reporteSeleccionado)
            <h3 class="text-2xl font-semibold text-gray-700 mb-6">Detalles del Reporte</h3>

            <!-- Contenedor grid 2x2 cuando hay reporte -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Información del Reporte (Fila 1, columna 1 y 2) -->
                <div class="col-span-2">
                    <div class="grid grid-cols-1 gap-4">
                        <!-- Título -->
                        <div>
                            <p class="text-gray-600 font-medium">Título:</p>
                            <p class="text-gray-800">{{ $reporteSeleccionado->titulo }}</p>
                        </div>

                        <!-- Descripción -->
                        <div>
                            <p class="text-gray-600 font-medium">Descripción:</p>
                            <p class="text-gray-800">{{ $reporteSeleccionado->descripcion }}</p>
                        </div>

                        <!-- Información de la Fecha, Fecha de Actualización y Estado en un grid 1x3 -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Fecha del Reporte -->
                            <div>
                                <p class="text-gray-600 font-medium">Fecha del Reporte:</p>
                                <p class="text-gray-800">{{ $reporteSeleccionado->fecha_reporte }}</p>
                            </div>

                            <!-- Fecha de Actualización -->
                            <div>
                                <p class="text-gray-600 font-medium">Fecha de Actualización:</p>
                                <p class="text-gray-800">{{ $reporteSeleccionado->fecha_act }}</p>
                            </div>

                            <!-- Estado del Reporte -->
                            <div>
                                <p class="text-gray-600 font-medium">Estado del Reporte:</p>
                                <p class="text-gray-800">{{ $reporteSeleccionado->estado_reporte }}</p>
                            </div>
                        </div>

                        <!-- Ubicación -->
                        <div>
                            <p class="text-gray-600 font-medium">Ubicación:</p>
                            <p class="text-gray-800">{{ $reporteSeleccionado->ubicacion }}</p>
                        </div>
                    </div>
                </div>

                <!-- Mapa (Fila 2, columna 1) -->
                <div class="h-full flex flex-col col-span-2 lg:col-span-1">
                    <h3 class="text-lg font-semibold mb-4 flex-shrink-0">Ubicación en el mapa:</h3>

                    <!-- Contenedor con aspecto 16:9 para el mapa -->
                    <div class="relative w-full h-0 pb-[56.25%] ">
                        <div id="map" class="absolute inset-0 w-full h-full rounded-2xl"></div>
                    </div>

                    <script>
                        $(document).ready(function () {
                            var lat = {{ $reporteSeleccionado-> latitud }};
                            var lon = {{ $reporteSeleccionado-> longitud }};

                            // Inicializar el mapa
                            var map = L.map('map').setView([lat, lon], 14);

                            // Cargar capa de OpenStreetMap
                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                            }).addTo(map);

                            // Añadir marcador en la ubicación
                            L.marker([lat, lon]).addTo(map)
                                .bindPopup("<b>{{ $reporteSeleccionado->ubicacion }}</b>")
                                .openPopup();
                        });
                    </script>
                </div>

                <!-- Imagen del Incidente (Fila 2, columna 2) -->
                <div class="flex justify-center items-center flex flex-col w-full h-full col-span-2 lg:col-span-1">
                    @if($reporteSeleccionado->img_incidente)
                    <h3 class="text-lg font-semibold mb-4 flex-shrink-0 w-full">Imagen del incidente:</h3>

                    <!-- Contenedor con aspecto 16:9 -->
                    <div class="relative w-full h-0 pb-[56.25%]">
                        <img src="{{ asset($reporteSeleccionado->img_incidente) }}" alt="Imagen del incidente"
                            class="absolute inset-0 w-full h-full object-cover rounded-lg shadow-md">
                    </div>
                    @else
                    <p class="text-gray-500">No hay imagen disponible</p>
                    @endif
                </div>
            </div>
            @else
            <p class="text-gray-500">Selecciona un reporte para ver los detalles</p>
            @endif
        </div>
    </div>
</div>
@endsection
