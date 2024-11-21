@extends('layouts.layout')

@section('title', 'Página de Inicio')

@section('content')
    <div class="container mx-auto p-6 bg-gray-50 shadow-lg rounded-lg">
        <h2 class="text-4xl font-extrabold text-gray-800 mb-6">Bienvenido, {{ Auth::user()->nombre_apellido }}</h2>
        <p class="text-gray-700 mb-8 text-lg">Aquí puedes consultar y gestionar tus reportes de manera fácil y rápida.</p>

        <!-- Estadísticas Rápidas -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
            <div class="bg-white p-4 rounded-lg shadow-lg border border-gray-200">
                <h4 class="text-base font-semibold text-gray-700 mb-1">Total de Reportes</h4>
                <p class="text-2xl font-bold text-gray-900">{{ $totalReportes }}</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-lg border border-gray-200">
                <h4 class="text-base font-semibold text-gray-700 mb-1">Pendientes</h4>
                <p class="text-2xl font-bold text-yellow-500">{{ $pendientes }}</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-lg border border-gray-200">
                <h4 class="text-base font-semibold text-gray-700 mb-1">Resueltos</h4>
                <p class="text-2xl font-bold text-green-500">{{ $resueltos }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Reportes Recientes -->
            <div>
                <h3 class="text-xl font-bold text-gray-800 mb-4">Reportes Recientes</h3>
                <div class="bg-white p-4 rounded-lg shadow-md h-60 overflow-y-auto border border-gray-200">
                    @if($reportesRecientes->isEmpty())
                        <p class="text-gray-500">No hay reportes recientes.</p>
                    @else
                        @foreach ($reportesRecientes as $reporte)
                            <div class="mb-3">
                                <p class="font-bold text-gray-700">{{ $reporte->titulo }}</p>
                                <p class="text-sm text-gray-500">{{ $reporte->fecha_reporte }}</p>
                                <p class="text-xs text-gray-400">{{ $reporte->estado_reporte }}</p>
                            </div>
                        @endforeach
                    @endif
                </div>
                <a href="{{ route('reportes.list', ['filter' => 'all']) }}"" class="text-blue-600 hover:underline mt-2 inline-block">Ver detalles</a>
            </div>

            <!-- Mis Reportes -->
            <div>
                <h3 class="text-xl font-bold text-gray-800 mb-4">Mis Reportes</h3>
                <div class="bg-white p-4 rounded-lg shadow-md h-60 overflow-y-auto border border-gray-200">
                    @if($misReportes->isEmpty())
                        <p class="text-gray-500">No tienes reportes asignados.</p>
                    @else
                        @foreach ($misReportes as $reporte)
                            <div class="mb-3">
                                <p class="font-bold text-gray-700">{{ $reporte->titulo }}</p>
                                <p class="text-sm text-gray-500">{{ $reporte->estado_reporte }}</p>
                                <p class="text-xs text-gray-400">{{ $reporte->fecha_reporte }}</p>
                            </div>
                        @endforeach
                    @endif
                </div>
                <a href="{{ route('reportes.list', ['filter' => 'all']) }}"" class="text-blue-600 hover:underline mt-2 inline-block">Ver detalles</a>
            </div>
        </div>

        <!-- Accesos Rápidos -->
        <div>
            <h3 class="text-xl font-bold text-gray-800 mb-4">Accesos Rápidos</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <a href="{{ route('reportes.create') }}" 
                    class="bg-yellow-500 text-white font-semibold py-3 px-6 rounded-lg shadow-md text-center hover:bg-yellow-600">
                    Crear Nuevo Reporte
                </a>
                <a href="{{ route('reportes.list', ['filter' => 'all']) }}"
                    class="bg-blue-500 text-white font-semibold py-3 px-6 rounded-lg shadow-md text-center hover:bg-blue-600">
                    Ver Mis Reportes
                </a>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}" class="mt-8">
            @csrf
            <button class="bg-red-500 text-white font-semibold py-3 px-6 rounded-lg shadow-md text-center hover:bg-red-600">
                Cerrar sesión
            </button>
        </form>
    </div>
@endsection
