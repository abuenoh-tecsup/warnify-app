@extends('layouts.layout')

@section('title', 'Mis reportes')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Reportes</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Listado de Reportes -->
        <div class="col-span-1 flex flex-col">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Listado</h2>
            @if (Auth::user()->isCiudadano())
            <div class="flex space-x-4 mb-4">
                <!-- Botón para ver todos los reportes -->
                <a href="{{ route('reportes.list', ['filter' => 'all']) }}"
                   class="px-4 py-2 bg-blue-500 text-white font-medium rounded hover:bg-blue-600">
                    Todos los Reportes
                </a>

                <!-- Botón para ver los reportes propios -->
                <a href="{{ route('reportes.list', ['filter' => 'own']) }}"
                   class="px-4 py-2 bg-green-500 text-white font-medium rounded hover:bg-green-600">
                    Mis Reportes
                </a>
            </div>
            
            @endif
            <div class="bg-gray-200 p-4 rounded-xl h-[600px] overflow-y-auto flex-grow">
            @foreach ($reportes as $reporte)
            <x-report-card
                fecha="{{ $reporte->fecha_reporte }}"
                titulo="{{ $reporte->titulo }}"
                descripcion="{{ $reporte->descripcion }}"
                estado="{{ $reporte->estado_reporte }}"
                reporteId="{{ $reporte->id_reporte }}"
            />
            @endforeach
        </div>
        </div>

        <!--Detalles del Reporte Seleccionado -->
        <div class="col-span-1 md:col-span-2">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Detalles
            </h2>
            <div class="bg-white p-6 rounded-xl shadow-md">
                @if ($reporteSeleccionado)
                <h3 class="text-2xl font-semibold text-gray-800 mb-6 flex justify-between">
                    Detalles del Reporte
                    @if (Auth::user()->isCiudadano())
                        @if (Auth::user()->id_usuario == $reporteSeleccionado->id_ciudadano && $reporteSeleccionado->estado_reporte == 'PENDIENTE')
                        <a href="{{ route('reportes.edit', ['id' => $reporteSeleccionado->id_reporte]) }}"
                            class="bg-green-500 text-base text-white font-semibold py-3 px-6 rounded-lg shadow-md text-center hover:bg-green-600">
                            Editar reporte
                        </a>
                        @endif
                    @endif
                    @if (Auth::user()->isModerador())
                        @if ($reporteSeleccionado->estado_reporte == 'PENDIENTE')
                        <a href="{{ route('reportes.edit_moderador', ['id' => $reporteSeleccionado->id_reporte]) }}"
                            class="bg-yellow-500 text-base text-white font-semibold py-3 px-6 rounded-lg shadow-md text-center hover:bg-yellow-400 hover:text-white">
                            Moderar reporte
                        </a>
                        @endif
                    @endif
                    @if (Auth::user()->isAutoridad())
                        @if ($reporteSeleccionado->estado_reporte == 'VALIDADO' || $reporteSeleccionado->estado_reporte == 'RESOLVIENDOSE')
                        <a href="{{ route('reportes.edit_autoridad', ['id' => $reporteSeleccionado->id_reporte]) }}"
                            class="bg-cyan-500 text-base text-white font-semibold py-3 px-6 rounded-lg shadow-md text-center hover:bg-cyan-600 hover:text-white">
                            Resolver reporte
                        </a>
                        @endif
                    @endif
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Información del Reporte -->
                <div class="col-span-2">
                    <div class="grid gap-4">
                        <div>
                            <p class="text-gray-600 font-medium">Título:</p>
                            <p class="text-gray-800">{{ $reporteSeleccionado->titulo }}</p>
                        </div>

                        <div>
                            <p class="text-gray-600 font-medium">Descripción:</p>
                            <p class="text-gray-800">{{ $reporteSeleccionado->descripcion }}</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <p class="text-gray-600 font-medium">Fecha del Reporte:</p>
                                <p class="text-gray-800">{{ $reporteSeleccionado->fecha_reporte }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 font-medium">Fecha de Actualización:</p>
                                <p class="text-gray-800">{{ $reporteSeleccionado->fecha_act }}</p>
                            </div>
                            <!-- Estado del Reporte -->
                            <div>
                                <p class="text-gray-600 font-medium">Estado del Reporte:</p>
                                <p class="
                                    @if ($reporteSeleccionado->estado_reporte == 'PENDIENTE') text-yellow-500
                                    @elseif ($reporteSeleccionado->estado_reporte == 'RESUELTO') text-green-500
                                    @elseif ($reporteSeleccionado->estado_reporte == 'EN PROCESO') text-blue-500
                                    @elseif ($reporteSeleccionado->estado_reporte == 'VALIDADO') text-cyan-500
                                    @else text-gray-800 @endif 
                                    font-bold uppercase">
                                    {{ $reporteSeleccionado->estado_reporte }}
                                </p>
                            </div>
                        </div>

                        <div>
                            <p class="text-gray-600 font-medium">Ubicación:</p>
                            <p class="text-gray-800">{{ $reporteSeleccionado->ubicacion }}</p>
                        </div>
                    </div>
                </div>
            </div>



                <!-- Mapa e Imagen del Incidente -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Mapa -->
                    <div class="h-full flex flex-col">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Ubicación en el mapa:</h3>
                        <div class="relative w-full h-0 pb-[56.25%]">
                            <div id="map" class="absolute inset-0 w-full h-full rounded-lg"></div>
                        </div>
                        <script>
                            $(document).ready(function () {
                                var lat = {{ $reporteSeleccionado->latitud }};
                                var lon = {{ $reporteSeleccionado->longitud }};

                                var map = L.map('map').setView([lat, lon], 14);

                                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                                }).addTo(map);

                                L.marker([lat, lon]).addTo(map)
                                    .bindPopup("<b>{{ $reporteSeleccionado->ubicacion }}</b>")
                                    .openPopup(); 
                                map.zoomControl.setPosition('topright');
                            });
                        </script>

                        <style>
                            #map .leaflet-control-zoom {
                                position: absolute !important;
                                top: 15px !important;
                                right: 15px !important;
                                z-index: 1000 !important;
                                background: rgba(255, 255, 255, 1) !important;
                                border-radius: 10px !important;
                                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2) !important;
                                overflow: hidden;
                                display: flex;
                                flex-direction: column;
                                align-items: center;
                                justify-content: center;}
                            /* Botones individuales */
                            #map .leaflet-control-zoom-in,
                            #map .leaflet-control-zoom-out {
                                width: 45px !important; /* Botón cuadrado */
                                height: 45px !important; 
                                background-color: #007bff !important;
                                color: white !important;
                                font-size: 20px !important;
                                text-align: center !important;
                                display: flex; /* Asegura que el texto dentro esté centrado */
                                align-items: center; /* Centrado vertical */
                                justify-content: center; /* Centrado horizontal */
                                border: none !important;
                                cursor: pointer !important;
                                transition: background-color 0.2s ease, transform 0.2s ease !important;
                            }

                            /* Separación entre los botones */
                            #map .leaflet-control-zoom-in {
                                border-bottom: 1px solid white !important;
                            }
                            /* Efecto hover */
                            #map .leaflet-control-zoom-in:hover,
                            #map .leaflet-control-zoom-out:hover {
                                background-color: #0056b3 !important;
                                transform: scale(1.1) !important;
                            }
                            @media screen and (max-width: 600px) {
                                #map .leaflet-control-zoom {
                                    top: 20px;
                                    right: 20px;
                                }

                                #map .leaflet-control-zoom-in,
                                #map .leaflet-control-zoom-out {
                                    width: 40px !important;
                                    height: 40px !important;
                                    font-size: 18px !important;
                                }
                            }
                        </style>
                    </div>

                    <!-- Imagen del Incidente -->
                    <div class="flex justify-center items-center">
                        @if($reporteSeleccionado->img_incidente)
                        <div class="w-full">
                            <h3 class="text-lg font-semibold text-gray-700 mb-4">Imagen del incidente:</h3>
                            <div class="relative w-full h-0 pb-[56.25%]">
                                <img src="{{ asset($reporteSeleccionado->img_incidente) }}" alt="Imagen del incidente"
                                    class="absolute inset-0 w-full h-full object-cover rounded-lg shadow-md">
                            </div>
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
</div>
@endsection
