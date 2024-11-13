@extends('layouts.layout')

@section('title', 'Mis reportes')

@section('content')
    <h2 class="text-2xl font-bold">Reportes</h2>
    <div class="flex-grow h-full grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="col-span-1 flex flex-col">
            <h2 class="text-xl font-bold mb-1 flex-shrink-0">Listado</h2>
            <div class="flex-grow bg-gray-200 p-4 rounded-xl h-[0rem] overflow-y-scroll">
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

        <div class="col-span-1 md:col-span-2 flex flex-col">
            <h2 class="text-xl font-bold mb-1 flex-shrink-0">Detalles</h2>
            <div class="bg-gray-200 p-6 rounded-xl flex-grow shadow-lg">
                @if ($reporteSeleccionado)
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Detalles del Reporte</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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

                        <div>
                            <p class="text-gray-600 font-medium">Fecha del Reporte:</p>
                            <p class="text-gray-800">{{ $reporteSeleccionado->fecha_reporte }}</p>
                        </div>

                        <div>
                            <p class="text-gray-600 font-medium">Ubicación:</p>
                            <p class="text-gray-800">{{ $reporteSeleccionado->ubicacion }}</p>
                        </div>
                    </div>

                    @if($reporteSeleccionado->img_incidente)
                        <div class="mt-6 flex justify-center">
                            <img src="{{ asset($reporteSeleccionado->img_incidente) }}" alt="Imagen del incidente" class="rounded-lg shadow-md w-3/4 h-96 object-cover">
                        </div>
                    @endif
                @else
                    <p class="text-gray-500">Selecciona un reporte para ver los detalles</p>
                @endif
            </div>
        </div>
    </div>
@endsection
