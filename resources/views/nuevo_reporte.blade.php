@extends('layouts.layout')

@section('title', 'Nuevo reporte')

@section('content')
        <div class="container mx-auto px-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Registrar Reporte</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Columna de Información -->
                <div class="col-span-1">
                    <h2 class="text-xl font-semibold text-gray-700 mb-4">Información</h2>
                    <form action="{{ route('reportes.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
                        @csrf
                        <!-- Título del incidente -->
                        <div class="mb-4">
                            <x-label
                                for="titulo"
                                text="Título del incidente"
                                class="text-gray-600 font-medium"
                            />
                            <x-input-field
                                name="titulo"
                                placeholder="Ingresar título"
                                value=""
                                class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md px-4 py-2"
                            />
                        </div>

                        <!-- Descripción del incidente -->
                        <div class="mb-4">
                            <x-label
                                for="descripcion"
                                text="Descripción del incidente"
                                class="text-gray-600 font-medium"
                            />
                            <x-textarea-field
                                name="descripcion"
                                placeholder="Ingresar descripción"
                                rows="3"
                                value=""
                                class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md px-4 py-2"
                            />
                        </div>

                        <!-- Fecha y hora -->
                        <div class="mb-4">
                            <x-label
                                for="fecha_reporte"
                                text="Fecha y hora"
                                class="text-gray-600 font-medium"
                            />
                            <x-datepicker
                                name="fecha_reporte"
                                placeholder="Seleccionar fecha y hora"
                                value="{{ old('datetime', '') }}"
                                class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md px-4 py-2"
                            />
                        </div>

                        <!-- Ubicación del incidente -->
                        <div class="mb-4">
                            <x-label
                                for="ubicacion"
                                text="Ubicación del incidente"
                                class="text-gray-600 font-medium"
                            />
                            <x-input-field
                                name="ubicacion"
                                placeholder="Ubicación detectada"
                                value=""
                                class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md px-4 py-2"
                            />
                            <x-input-field
                                type="hidden"
                                name="latitud"
                                value=""
                            />
                            <x-input-field
                                type="hidden"
                                name="longitud"
                                value=""
                            />
                        </div>

                        <!-- Imagen del incidente -->
                        <div class="mb-4">
                            <x-label
                                for="imagen_incidente"
                                text="Imagen"
                                class="text-gray-600 font-medium"
                            />
                            <x-image-upload
                                name="img_incidente"
                                class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md px-4 py-2"
                            />
                        </div>

                        <!-- Botón Guardar -->
                        <x-button
                            class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md"
                            type="submit"
                            name="save-btn"
                        >
                            Guardar reporte
                        </x-button>
                    </form>
                </div>

                <!-- Columna de Mapa -->
                <div class="col-span-1 md:col-span-2 flex flex-col">
                    <h2 class="text-xl font-semibold text-gray-700 mb-4 flex-shrink-0">Mapa</h2>
                    <div class="bg-white p-6 rounded-lg shadow-md flex-grow flex flex-col">
                        <!-- Formulario para ingresar dirección -->
                        <form id="address-form" class="flex items-center gap-4 mb-4">
                            @csrf
                            <x-input-field
                                name="address"
                                placeholder="Ingresar una dirección"
                                value=""
                                class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md flex-grow px-4 py-2"
                            />
                            <x-button
                                class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md"
                                type="button"
                                name="search-btn"
                            >
                                Buscar
                            </x-button>
                        </form>
                        <ul id="results" class="text-gray-700 mb-4 px-4"></ul>
                        <!-- Contenedor del mapa -->
                        <div id="map" class="w-full h-[400px] rounded-lg flex-grow"></div>
                    </div>
                </div>
            </div>
        </div>
                <script>
                        $(document).ready(function () {
                        // Inicializar mapa centrado en Perú
                        var map = L.map('map').setView([-9.189967, -75.015152], 6); // Coordenadas de Perú, zoom inicial 6

                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                        }).addTo(map);

                        var marker = L.marker([-9.189967, -75.015152]).addTo(map); // Colocar marcador inicial

                        // Limitar el desplazamiento del mapa a los límites de Perú
                        var bounds = L.latLngBounds(
                            [-18.34873, -81.41094], // Coordenadas suroeste (aproximación)
                            [-0.03928, -68.65233]  // Coordenadas noreste (aproximación)
                        );
                        map.setMaxBounds(bounds);
                        map.on('drag', function () {
                            map.panInsideBounds(bounds, { animate: true });
                        });

                        // Dirección predeterminada exacta
                        var defaultAddress = "Santa Anita, Lima, Lima Metropolitana, Lima, 15009, Perú";

                        // Función para buscar dirección predeterminada
                        function loadDefaultAddress(address) {
                            var url = `https://nominatim.openstreetmap.org/search?format=json&q=${address}&countrycodes=PE`;

                            $.get(url, function (data) {
                                if (data.length > 0) {
                                    var firstResult = data[0];
                                    var lat = firstResult.lat;
                                    var lon = firstResult.lon;
                                    var displayName = firstResult.display_name;

                                    // Establecer vista inicial en el mapa
                                    map.setView([lat, lon], 14);
                                    marker.setLatLng([lat, lon]);

                                    // Actualizar los campos del formulario
                                    $('#latitud').val(lat);
                                    $('#longitud').val(lon);
                                    $('#ubicacion').val(displayName);
                                } else {
                                    console.error("No se encontró la dirección predeterminada");
                                }
                            }).fail(function () {
                                console.error("Error al buscar la dirección predeterminada");
                            });
                        }

                        $('#results').on('mouseenter', 'li', function () {
                                var lat = $(this).data('lat');
                                var lon = $(this).data('lon');

                                // Crear un marcador temporal o cambiar el estilo del marcador existente
                                marker.setLatLng([lat, lon]);
                                map.setView([lat, lon], 14); // Acercar el mapa al marcador
                            });

                            $('#results').on('mouseleave', 'li', function () {
                                // Opcional: puedes resetear el marcador o la vista si es necesario
                            });


                        // Cargar dirección predeterminada al inicializar
                        loadDefaultAddress(defaultAddress);

                        // Manejar la búsqueda al hacer clic en el botón
                        $('#search-btn').on('click', function () {
                            var query = $('#address').val();

                            if (query.length > 2) {
                                searchAddress(query);
                            } else {
                                $('#results').empty();
                                alert('Por favor ingresa al menos 3 caracteres para realizar la búsqueda.');
                            }
                        });

                        // Buscar dirección ingresada centrada en Perú
                        function searchAddress(query) {
                            var url = `https://nominatim.openstreetmap.org/search?format=json&q=${query}&countrycodes=PE&viewbox=-81.41094,-0.03928,-68.65233,-18.34873&bounded=1`;

                            $.get(url, function (data) {
                                $('#results').empty();

                                if (data.length > 0) {
                                    data.forEach(function (item) {
                                        $('#results').append(`
                                            <li data-lat="${item.lat}" data-lon="${item.lon}">${item.display_name}</li>
                                        `);
                                    });
                                } else {
                                    $('#results').append('<li>No se encontraron resultados</li>');
                                }
                            });
                        }

                        // Manejar selección de un resultado
                        $('#results').on('click', 'li', function () {
                            var lat = $(this).data('lat');
                            var lon = $(this).data('lon');
                            var address = $(this).text();

                            $('#latitud').val(lat);
                            $('#longitud').val(lon);
                            $('#ubicacion').val(address);

                            $('#results').empty();

                            map.setView([lat, lon], 14);
                            marker.setLatLng([lat, lon]);
                        });

                        // Evento click en el mapa
                        map.on('click', function (e) {
                            var lat = e.latlng.lat;
                            var lon = e.latlng.lng;

                            // Actualizar el marcador
                            marker.setLatLng([lat, lon]);

                            // Consultar Nominatim para obtener la dirección
                            var url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}&countrycodes=PE`;

                            $.get(url, function (data) {
                                if (data && data.display_name) {
                                    var displayName = data.display_name;

                                    // Actualizar los campos del formulario-
                                    $('#latitud').val(lat);
                                    $('#longitud').val(lon);
                                    $('#ubicacion').val(displayName);
                                } else {
                                    $('#ubicacion').val('Coordenadas seleccionadas: ' + lat + ', ' + lon);
                                }
                            }).fail(function () {
                                $('#ubicacion').val('Coordenadas seleccionadas: ' + lat + ', ' + lon);
                            });
                        });
                    });
                </script>
                <style>
                    #results li {
                        padding: 8px;
                        cursor: pointer;
                        transition: background-color 0.2s ease-in-out;
                    }

                    #results li:hover {
                        background-color: #f0f4ff; /* Cambia el color según tu preferencia */
                        border-radius: 4px;
                    }
                    /* Estilo de los controles del mapa */
                    .leaflet-control-zoom {
                        background-color: #ffffff; /* Fondo blanco */
                        border-radius: 8px; /* Esquinas redondeadas */
                        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Sombra */
                        display: flex;
                        flex-direction: column; /* Botones en columna */
                        justify-content: center;
                        align-items: center;
                        overflow: hidden;
                        padding: 4px;
                        width: 40px;
                    }

                    .leaflet-control-zoom a {
                        background-color: #007bff; /* Fondo azul */
                        color: #ffffff; /* Texto blanco */
                        border: none;
                        border-radius: 4px;
                        width: 32px;
                        height: 32px;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        text-align: center;
                        font-size: 18px;
                        font-weight: bold;
                        cursor: pointer;
                        margin: 4px 0;
                        transition: background-color 0.3s;
                    }

                    .leaflet-control-zoom a:hover {
                        background-color: #0056b3; /* Color azul más oscuro al pasar el ratón */
                    }

                    .leaflet-control-zoom-in {
                        margin-bottom: 4px; /* Espaciado entre botones */
                    }

                    .leaflet-control-zoom-out {
                        margin-top: 4px; /* Espaciado entre botones */
                    }

                </style>

            </div>
        </div>
    </div>
@endsection
