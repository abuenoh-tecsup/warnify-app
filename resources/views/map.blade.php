<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador de Dirección con Mapa</title>
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
        /* Estilo para el mapa */
        #map {
            width: 100%;
            height: 400px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Buscador de Dirección con Mapa</h1>

    <form id="address-form">
        @csrf
        <input type="text" id="address" name="address" placeholder="Ingresa una dirección..." required>
        <button type="button" id="search-btn">Buscar</button> <!-- Botón para buscar -->
        <ul id="results"></ul>
        <input type="hidden" id="latitude" name="latitude">
        <input type="hidden" id="longitude" name="longitude">
    </form>

    <div>
        <p><strong>Latitud:</strong> <span id="lat-display"></span></p>
        <p><strong>Longitud:</strong> <span id="lon-display"></span></p>
    </div>

    <!-- Contenedor para el mapa -->
    <div id="map"></div>

    <script>
        $(document).ready(function() {
            // Inicializar el mapa de Leaflet
            var map = L.map('map').setView([0, 0], 2);  // Posición inicial (0,0) y zoom a nivel mundial

            // Cargar los tiles de OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Crear un marcador que se actualizará con las coordenadas
            var marker = L.marker([0, 0]).addTo(map);

            // Función para ejecutar la búsqueda cuando se presiona el botón
            $('#search-btn').on('click', function() {
                var query = $('#address').val(); // Obtener el texto ingresado en el input

                if (query.length > 2) { // Solo realizar la búsqueda si el texto tiene más de 2 caracteres
                    searchAddress(query);
                } else {
                    $('#results').empty(); // Vaciar resultados si el texto tiene menos de 3 caracteres
                    alert('Por favor ingresa al menos 3 caracteres para realizar la búsqueda.');
                }
            });

            // Función para realizar la búsqueda de dirección usando la API de OpenStreetMap (Nominatim)
            function searchAddress(query) {
                var url = `https://nominatim.openstreetmap.org/search?format=json&q=${query}`;

                $.get(url, function(data) {
                    $('#results').empty(); // Limpiar la lista de resultados antes de mostrar nuevos

                    if (data.length > 0) {
                        // Mostrar los resultados en la lista
                        data.forEach(function(item) {
                            $('#results').append(`
                                <li data-lat="${item.lat}" data-lon="${item.lon}">${item.display_name}</li>
                            `);
                        });
                    } else {
                        $('#results').append('<li>No se encontraron resultados</li>');
                    }
                });
            }

            // Función para manejar el clic en un lugar de la lista
            $('#results').on('click', 'li', function() {
                var lat = $(this).data('lat');
                var lon = $(this).data('lon');
                var address = $(this).text();

                // Actualizar los campos de latitud y longitud
                $('#latitude').val(lat);
                $('#longitude').val(lon);

                // Mostrar las coordenadas en pantalla
                $('#lat-display').text(lat);
                $('#lon-display').text(lon);

                // Limpiar la lista de resultados
                $('#results').empty();

                // Actualizar la ubicación del mapa con las nuevas coordenadas
                map.setView([lat, lon], 14); // Centrar el mapa en la nueva ubicación
                marker.setLatLng([lat, lon]); // Mover el marcador a la nueva ubicación
            });
        });
    </script>
</body>
</html>
