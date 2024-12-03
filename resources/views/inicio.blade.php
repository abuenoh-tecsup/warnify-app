@extends('layouts.layout')

@section('title', 'Página de Inicio')

@section('content')
<!-- Asegúrate de incluir FontAwesome si no lo has hecho ya -->
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Contenedor principal con posición relativa -->
    <div class="container mx-auto p-6 bg-gray-50 shadow-lg rounded-lg relative">
        <!-- Botón de Acción -->
        <button class="absolute top-6 right-6 px-4 py-2 bg-gradient-to-r from-blue-400 via-blue-300 to-sky-400 rounded-lg shadow-md 
                    hover:from-blue-400 hover:to-sky-400 transition-all duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 flex items-center space-x-2"
                    onclick="openCommentModal()">
            <i class="fas fa-star text-yellow-400"></i>
            <span>Envíanos tus comentarios</span>
        </button>

        <!-- Código de manejo de errores o éxito -->
        @if (session('success'))
            <script>
                window.onload = function() {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: "{{ session('success') }}",
                        background: '#d4edda',
                        confirmButtonColor: '#28a745',
                        iconColor: '#155724', 
                    });
                }
            </script>
        @endif
        @if ($errors->any())
            <script>
                window.onload = function() {
                    let errors = @json($errors->all());
                    Swal.fire({
                        icon: 'error',
                        title: '¡Error!',
                        html: "Errores encontrados: <br>" + errors.join("<br>"),
                        background: '#f8d7da',
                        confirmButtonColor: '#dc3545',
                        iconColor: '#721c24',
                    });
                }
            </script>
        @endif
            
        @if (Auth::user()->isCiudadano())
        <!-- Formulario de Comentarios -->
        <div id="commentModalContent" style="display: none;">
            <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition duration-300 ease-in-out relative">
                <form id="commentForm" action="{{ route('comentarios.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <textarea name="contenido" id="contenido" rows="4" placeholder="Escribe tu comentario aquí..."
                            class="w-full p-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300"></textarea>
                    <button type="submit" class="w-full py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition duration-300">
                        Enviar Comentario
                    </button>
                </form>
            </div>
        </div>
        @endif

        <script>
            // Función para abrir el modal de comentarios
            function openCommentModal() {
                Swal.fire({
                    title: 'Envíanos tu Comentario',
                    html: document.getElementById('commentModalContent').innerHTML,
                    showConfirmButton: false,
                    showCancelButton: false,
                    width: '600px',
                    padding: '20px',
                    focusConfirm: false,
                    didOpen: () => {
                        // Botón de cerrar (X) en la esquina superior derecha
                        const closeButton = document.createElement('button');
                        closeButton.innerHTML = '&times;';
                        closeButton.style.position = 'absolute';
                        closeButton.style.top = '10px';
                        closeButton.style.right = '10px';
                        closeButton.style.fontSize = '24px';
                        closeButton.style.background = 'none';
                        closeButton.style.border = 'none';
                        closeButton.style.color = '#333';
                        closeButton.style.cursor = 'pointer';
                        closeButton.style.zIndex = '1000';
                        closeButton.onclick = () => {
                            Swal.close();
                        };

                        document.querySelector('.swal2-popup').appendChild(closeButton);
                    },
                    preConfirm: function() {
                        let contenido = document.getElementById('contenido').value;
                        if (!contenido) {
                            Swal.showValidationMessage('Por favor, escribe un comentario.');
                            return false;
                        }
                        return true;
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('commentForm').submit();
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.close();
                    }
                });
            }
        </script>
        <!-- Título y descripción -->
        <h2 class="text-4xl font-extrabold text-gray-800 mb-6">Bienvenido, {{ Auth::user()->nombre }} {{ Auth::user()->apellidos }}</h2>
        <p class="text-gray-700 mb-8 text-lg">Aquí puedes consultar y gestionar tus reportes de manera fácil y rápida.</p>

        <!-- Tarjetas de reporte -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
            <!-- Tarjeta: Total de Reportes -->
            <div class="bg-blue-100 p-4 rounded-lg shadow-md text-blue-800 border-2 border-blue-800 hover:border-blue-800">
                <div class="flex items-center justify-between mb-4 ">
                    <div class="flex items-center">
                        <img src="https://img.icons8.com/ios/452/graph.png" alt="Total de Reportes" class="w-12 h-12 mr-4">
                        <h4 class="text-base font-semibold">Total de Reportes</h4>
                    </div>
                    <p class="text-3xl font-bold ">{{ $totalReportes }}</p>
                </div>
            </div>

            <!-- Tarjeta: Pendientes -->
            <div class="bg-yellow-100 p-4 rounded-lg shadow-md text-yellow-700 border-2 border-yellow-800 hover:border-yellow-800">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <img src="https://img.icons8.com/ios/452/time.png" alt="Pendientes" class="w-12 h-12 mr-4">
                        <h4 class="text-base font-semibold">Pendientes</h4>
                    </div>
                    <p class="text-3xl font-bold">{{ $pendientes }}</p>
                </div>
            </div>

            <!-- Tarjeta: Resueltos -->
            <div class="bg-green-100 p-4 rounded-lg shadow-md text-green-700 border-2 border-green-800 hover:border-green-800">
                <div class="flex items-center justify-between mb-4 ">
                    <div class="flex items-center">
                        <img src="https://img.icons8.com/ios/452/ok.png" alt="Resueltos" class="w-12 h-12 mr-4">
                        <h4 class="text-base font-semibold">Resueltos</h4>
                    </div>
                    <p class="text-3xl font-bold">{{ $resueltos }}</p>
                </div>
            </div>
        </div>

        <!-- Sección de reportes -->
        <div class="grid grid-cols-1 lg:grid-cols-{{ Auth::user()->isCiudadano() ? '2' : '1' }} gap-8 mb-8">
            <div class="{{ Auth::user()->isCiudadano() ? '' : 'lg:col-span-2' }}">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Reportes Recientes</h3>
                <div class="bg-[#ebf5fb] p-4 rounded-lg shadow-md h-60 overflow-y-auto border border-[#d6eaf8] border-2 border-blue-800 hover:border-blue-800">
                    @if ($reportesRecientes->isEmpty())
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
            </div>

            @if (Auth::user()->isCiudadano())
                <div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Mis Reportes</h3>
                    <div class="bg-[#e9f7ef] p-4 rounded-lg shadow-md h-60 overflow-y-auto border border-[#d1f2eb] border-2 border-green-800 hover:border-green-800">
                        @if ($misReportes->isEmpty())
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
                </div>
            @endif
        </div>

        <!-- Accesos Rápidos -->
        <div>
            <h3 class="text-xl font-bold text-gray-800 mb-4">Accesos Rápidos</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                @if (Auth::user()->isCiudadano())
                    <a href="{{ route('reportes.create') }}"
                        class="bg-yellow-500 text-white font-semibold py-3 px-6 rounded-lg shadow-md text-center hover:bg-yellow-600">
                        Crear Nuevo Reporte
                    </a>
                @endif

                <a href="{{ route('reportes.list', ['filter' => 'all', 'state' => 'TODOS', 'order' => 'desc']) }}"
                    class="bg-blue-500 text-white font-semibold py-3 px-6 rounded-lg shadow-md text-center hover:bg-blue-600">
                    Ver Reportes
                </a>

                @if (Auth::user()->isCiudadano())
                    <a href="{{ route('reportes.list', ['filter' => 'own', 'state' => 'TODOS', 'order' => 'desc']) }}"
                        class="bg-green-500 text-white font-semibold py-3 px-6 rounded-lg shadow-md text-center hover:bg-green-600">
                        Ver Mis Reportes
                    </a>
                @endif
            </div>
        </div>

        <!-- Formulario de logout -->
        <form method="POST" action="{{ route('logout') }}" class="mt-8">
            @csrf
        </form>
    </div>
@endsection
