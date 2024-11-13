@extends('layouts.layout')

@section('title', 'Nuevo reporte')

@section('content')
    <h2 class="text-2xl font-bold">Registrar reporte</h2>
    <div class="flex-grow h-full grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="col-span-1 flex flex-col">
            <h2 class="text-xl font-bold mb-1 flex-shrink-0">Información</h2>
            <form action="{{ route('reportes.store') }}" class="bg-gray-200 p-4 rounded-xl flex-grow" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="mb-4">
                    <x-label
                        for="titulo"
                        text="Título del incidente"
                    />
                    <x-input-field
                        name="titulo"
                        placeholder="Ingresar título"
                        value=""
                    />
                </div>
                <div class="mb-4">
                    <x-label
                        for="descripcion"
                        text="Descripción del incidente"
                    />
                    <x-textarea-field
                        name="descripcion"
                        placeholder="Ingresar descripción"
                        rows="2"
                        value=""
                    />
                </div>
                <div class="mb-4">
                    <x-label
                        for="fecha_reporte"
                        text="Fecha y hora"
                    />
                    <x-datepicker
                        name="fecha_reporte"
                        placeholder="Seleccionar fecha y hora"
                        value="{{ old('datetime', '') }}"
                    />
                </div>
                <div class="mb-4">
                    <x-label
                        for="ubicacion"
                        text="Ubicación del incidente"
                    />
                    <x-input-field
                        name="ubicacion"
                        placeholder="Ubicación detectada"
                        value=""
                    />
                    <x-input-field
                        type="hidden"
                        name="latitud"
                        placeholder="Latitud detectacada"
                        value=""
                    />
                    <x-input-field
                        type="hidden"
                        name="longitud"
                        placeholder="Longitud detectacada"
                        value=""
                    />
                </div>
                <div class="mb-4">
                    <x-label
                        for="imagen_incidente"
                        text="Imagen"
                    />
                    <x-image-upload
                        name="img_incidente"
                    />
                </div>
                <x-button
                    class="text-black"
                    type="submit"
                    name="save-btn"
                >
                    Guardar reporte
                </x-button>
            </form>
        </div>
        <div class="col-span-1 md:col-span-2 flex flex-col">
            <h2 class="text-xl font-bold mb-1 flex-shrink-0">Mapa</h2>
            <div class="bg-gray-200 h-full p-4 rounded-xl flex flex-col gap-4 flex-grow">
                <div class="flex-shrink-0">
                    <form id="address-form">
                        @csrf
                        <x-input-field
                            name="address"
                            placeholder="Ingresar una dirección"
                            value=""
                            class="w-4/5"
                        />
                        <x-button
                            class="text-black"
                            type="button"
                            name="search-btn"
                        >
                            Buscar
                        </x-button>
                        <ul id="results"></ul>
                    </form>
                </div>
                <div class="flex-grow min-h-60">
                    <div id="map" class="w-full h-full flex-shrink-0 rounded-2xl"></div>
                </div>
                <script>
                    $(document).ready(function() {
                        var map = L.map('map').setView([0, 0], 2);

                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                        }).addTo(map);

                        var marker = L.marker([0, 0]).addTo(map);

                        $('#search-btn').on('click', function() {
                            var query = $('#address').val();

                            if (query.length > 2) {
                                searchAddress(query);
                            } else {
                                $('#results').empty();
                                alert('Por favor ingresa al menos 3 caracteres para realizar la búsqueda.');
                            }
                        });

                        function searchAddress(query) {
                            var url = `https://nominatim.openstreetmap.org/search?format=json&q=${query}`;

                            $.get(url, function(data) {
                                $('#results').empty();

                                if (data.length > 0) {
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

                        $('#results').on('click', 'li', function() {
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
                    });
                </script>
            </div>
        </div>
    </div>
@endsection
