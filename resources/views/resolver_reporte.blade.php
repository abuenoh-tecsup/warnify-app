@extends('layouts.layout')

@section('title', 'Nuevo reporte')

@section('content')

<div class="container mx-auto px-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Moderar reporte</h2>
    <div class="mb-6">
        <!-- Información -->
        <div class="">
            <form action="{{ route('reportes.update_autoridad', $reporte->id_reporte) }}" method="POST" enctype="multipart/form-data"
                class="bg-white p-6 rounded-lg shadow-md w-full flex justify-center">
                @csrf
                @method('PUT')
                <!-- Título del incidente -->
                <div class="mb-4 hidden">
                    <x-label for="titulo" text="Título del incidente" class="text-gray-600 font-medium" />
                    <x-input-field name="titulo" placeholder="Ingresar título" value="{{ old('titulo', $reporte->titulo) }}"
                        class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md px-4 py-2" />
                </div>

                <!-- Descripción del incidente -->
                <div class="mb-4 hidden">
                    <x-label for="descripcion" text="Descripción del incidente" class="text-gray-600 font-medium" />
                    <x-textarea-field name="descripcion" placeholder="Ingresar descripción" rows="3"
                        value="{{ old('descripcion', $reporte->descripcion) }}"
                        class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md px-4 py-2" />
                </div>

                <!-- Fecha y hora -->
                <div class="mb-4 hidden">
                    <x-label for="fecha_reporte" text="Fecha y hora" class="text-gray-600 font-medium" />
                    <x-datepicker name="fecha_reporte" placeholder="Seleccionar fecha y hora"
                        value="{{ old('fecha_reporte', \Carbon\Carbon::parse($reporte->fecha_reporte)->format('M j, Y h:i A')) }}"
                        class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md px-4 py-2" />
                </div>

                <!-- Ubicación del incidente -->
                <div class="mb-4 hidden">
                    <x-label for="ubicacion" text="Ubicación del incidente" class="text-gray-600 font-medium" />
                    <x-input-field name="ubicacion" placeholder="Ubicación detectada"
                        value="{{ old('ubicacion', $reporte->ubicacion) }}"
                        class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md px-4 py-2" />
                    <x-input-field type="" name="latitud" value="{{ old('latitud', $reporte->latitud) }}" />
                    <x-input-field type="" name="longitud" value="{{ old('longitud', $reporte->longitud) }}" />
                </div>

                <!-- Imagen del incidente -->
                <div class="mb-4 hidden">
                    <x-label for="imagen_incidente" text="Imagen" class="text-gray-600 font-medium" />
                    <x-image-upload name="img_incidente"
                        class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md px-4 py-2"
                        value="{{ old('img_incidente', $reporte->img_incidente ? asset($reporte->img_incidente) : '') }}" />
                </div>

                <!-- Botón "En proceso de resolución" -->
                <x-button 
                    class="bg-gradient-to-r from-blue-400 to-blue-600 hover:from-blue-500 hover:to-blue-700 text-white text-lg font-semibold py-2 px-4 mx-4 rounded-lg shadow-md transform transition-transform duration-200 hover:scale-105"
                    type="submit" name="estado_reporte" value="RESOLVIENDOSE">
                    En proceso de resolución
                </x-button>

                <!-- Botón "Resuelto" -->
                <x-button 
                    class="bg-gradient-to-r from-green-400 to-green-600 hover:from-green-500 hover:to-green-700 text-white text-lg font-semibold py-2 px-4 mx-4 rounded-lg shadow-md transform transition-transform duration-200 hover:scale-105"
                    type="submit" name="estado_reporte" value="RESUELTO">
                    Resuelto
                </x-button>

            </form>
        </div>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-md">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Información del Reporte -->
            <div class="col-span-2">
                <div class="grid gap-4">
                    <div>
                        <p class="text-gray-600 font-medium">Título:</p>
                        <p class="text-gray-800">{{ $reporte->titulo }}</p>
                    </div>

                    <div>
                        <p class="text-gray-600 font-medium">Descripción:</p>
                        <p class="text-gray-800">{{ $reporte->descripcion }}</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <p class="text-gray-600 font-medium">Fecha del Reporte:</p>
                            <p class="text-gray-800">{{ $reporte->fecha_reporte }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 font-medium">Fecha de Actualización:</p>
                            <p class="text-gray-800">{{ $reporte->fecha_act }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 font-medium">Estado del Reporte:</p>
                            <p class="text-gray-800">{{ $reporte->estado_reporte }}</p>
                        </div>
                    </div>

                    <div>
                        <p class="text-gray-600 font-medium">Ubicación:</p>
                        <p class="text-gray-800">{{ $reporte->ubicacion }}</p>
                    </div>
                </div>
            </div>

            <!-- Mapa -->
            <div class="h-full flex flex-col col-span-2 lg:col-span-1">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Ubicación en el mapa:</h3>
                <div class="relative w-full h-0 pb-[56.25%]">
                    <div id="map" class="absolute inset-0 w-full h-full rounded-lg"></div>
                </div>

                <script>
                    $(document).ready(function () {
                        var lat = {{ $reporte-> latitud
                    }};
                    var lon = {{ $reporte-> longitud }};

                    var map = L.map('map').setView([lat, lon], 14);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(map);

                    L.marker([lat, lon]).addTo(map)
                        .bindPopup("<b>{{ $reporte->ubicacion }}</b>")
                        .openPopup();
                    });
                </script>
            </div>

            <!-- Imagen del Incidente -->
            <div class="flex justify-center items-center col-span-2 lg:col-span-1">
                @if($reporte->img_incidente)
                <div class="w-full">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Imagen del incidente:</h3>
                    <div class="relative w-full h-0 pb-[56.25%]">
                        <img src="{{ asset($reporte->img_incidente) }}" alt="Imagen del incidente"
                            class="absolute inset-0 w-full h-full object-cover rounded-lg shadow-md">
                    </div>
                </div>
                @else
                <p class="text-gray-500">No hay imagen disponible</p>
                @endif
            </div>
        </div>
    </div>
</div>

</div>
</div>
</div>
</div>
@endsection
