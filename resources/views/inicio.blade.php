@extends('layouts.layout')

@section('title', 'Página de Inicio')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Bienvenido, {{ 'Alvaro' }}</h2>
    <p class="text-gray-600 mb-8">Aquí puedes consultar y gestionar tus reportes.</p>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Sección 1: Reportes Recientes -->
        <div class="col-span-1">
            <h3 class="text-xl font-semibold mb-4">Reportes Recientes</h3>
            <div class="bg-gray-200 p-4 rounded-xl h-40 overflow-y-scroll">
                @foreach ($reportesRecientes as $reporte)
                    <div class="mb-2">
                        <p class="font-semibold">{{ $reporte->titulo }}</p>
                        <p class="text-gray-600">{{ $reporte->fecha_reporte }}</p>
                        <p class="text-gray-500">{{ $reporte->estado_reporte }}</p>
                    </div>
                @endforeach
            </div>
            <a href="{{ route('reportes.inicio') }}" class="text-blue-600">Ver más</a>
        </div>

        <!-- Sección 2: Mis Reportes -->
        <div class="col-span-1">
            <h3 class="text-xl font-semibold mb-4">Mis Reportes</h3>
            <div class="bg-gray-200 p-4 rounded-xl h-40 overflow-y-scroll">
                @foreach ($misReportes as $reporte)
                    <div class="mb-2">
                        <p class="font-semibold">{{ $reporte->titulo }}</p>
                        <p class="text-gray-600">{{ $reporte->estado_reporte }}</p>
                        <p class="text-gray-500">{{ $reporte->fecha_reporte }}</p>
                    </div>
                @endforeach
            </div>
            <a href="{{ route('reportes.list') }}" class="text-blue-600">Ver más</a>
        </div>
    </div>

    <!-- Sección 3: Estadísticas Rápidas -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-8">
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h4 class="text-lg font-semibold mb-4">Total de Reportes</h4>
            <p class="text-3xl font-bold">{{ $totalReportes }}</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h4 class="text-lg font-semibold mb-4">Pendientes</h4>
            <p class="text-3xl font-bold">{{ $pendientes }}</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h4 class="text-lg font-semibold mb-4">Resueltos</h4>
            <p class="text-3xl font-bold">{{ $resueltos }}</p>
        </div>
        <!-- Agregar más estadísticas aquí según sea necesario -->
    </div>

    <!-- Sección 4: Accesos Rápidos -->
    <div class="mt-8">
        <h3 class="text-xl font-semibold mb-4">Accesos Rápidos</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <a href="{{ route('reportes.create') }}" class="bg-yellow-400 text-white p-4 rounded-xl shadow-md text-center">Crear Nuevo Reporte</a>
            <a href="{{ route('reportes.list') }}" class="bg-blue-400 text-white p-4 rounded-xl shadow-md text-center">Ver Mis Reportes</a>
        </div>
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <x-button
            class="text-black"
            type="submit"
            name="logout-btn"
        >
            Cerrar sesión
        </x-button>
    </form>

@endsection
