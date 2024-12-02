@extends('layouts.layout')

@section('title', 'Acerca de Warnify')

@section('content')
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<div class="container mx-auto px-6 md:px-12 py-8">
    <h2 class="text-4xl font-extrabold text-gray-800 mb-12 text-center">Acerca de Warnify</h2>

    <!-- Sección de Información -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-12 px-4">
        <!-- Tarjeta 1: Por qué Warnify -->
        <div class="bg-gradient-to-r from-blue-100 via-blue-200 to-blue-100 p-6 rounded-xl shadow-lg hover:shadow-2xl transition duration-300 ease-in-out transform hover:scale-105 border-4 border-blue-300 hover:border-blue-500">
            <div class="flex items-center space-x-4 mb-6">
                <i class="fas fa-bullhorn text-3xl text-blue-600"></i>
                <h3 class="text-3xl font-semibold text-gray-800">Por qué Warnify</h3>
            </div>
            <p class="text-gray-700 leading-relaxed">
                En muchas localidades, la falta de un sistema eficiente para reportar incidentes como accidentes o problemas
                de infraestructura dificulta la comunicación entre ciudadanos y autoridades. Warnify busca cerrar esa brecha,
                proporcionando herramientas tecnológicas que agilizan la respuesta y resolución de problemas, mejorando la calidad de vida.
            </p>
        </div>
        
        <!-- Tarjeta 2: Nuestra Misión -->
        <div class="bg-gradient-to-r from-green-100 via-green-200 to-green-100 p-6 rounded-xl shadow-lg hover:shadow-2xl transition duration-300 ease-in-out transform hover:scale-105 border-4 border-green-300 hover:border-green-500">
            <div class="flex items-center space-x-4 mb-6">
                <i class="fas fa-bullseye text-3xl text-green-600"></i>
                <h3 class="text-3xl font-semibold text-gray-800">Nuestra Misión</h3>
            </div>
            <p class="text-gray-700 leading-relaxed">
                Nuestra misión como empresa, llamada <strong>EVADEVS</strong>, es transformar la manera en que las personas y empresas
                interactúan con la tecnología. A través del desarrollo de soluciones de software innovadoras, optimizamos procesos empresariales
                y mejoramos la vida cotidiana. En EVADEVS, nos dedicamos a crear aplicaciones y plataformas personalizadas que resuelvan los
                desafíos únicos de nuestros clientes, impulsando su éxito con herramientas tecnológicas avanzadas, seguras y escalables.
            </p>
        </div>
    </div>

    <!-- Sección de Valores -->
    <div class="bg-gradient-to-r from-yellow-100 via-orange-200 to-orange-100 p-6 rounded-xl shadow-xl mb-12 hover:shadow-2xl transition duration-300 ease-in-out transform hover:scale-105">
        <div class="flex items-center space-x-4 mb-8">
            <i class="fas fa-handshake text-3xl text-orange-600"></i>
            <h3 class="text-3xl font-extrabold text-gray-800">Nuestros Valores</h3>
        </div>
        <p class="text-gray-700 text-justify leading-relaxed">
            En Warnify, priorizamos la innovación, la colaboración y la confianza. Creemos en el poder de la tecnología para transformar
            vidas, y trabajamos incansablemente para ofrecer soluciones que generen impacto positivo, fortaleciendo la relación entre
            ciudadanos y autoridades para construir comunidades más seguras y conectadas.
        </p>
    </div>

    <!-- Sección de Comentarios Recientes -->
    <div class="bg-gradient-to-r from-sky-100 via-sky-200 to-sky-100 p-6 rounded-xl shadow-lg hover:shadow-2xl transition duration-300 ease-in-out border-4 border-sky-300 hover:border-sky-500 mb-8">
        <div class="flex items-center space-x-4 mb-6">
            <i class="fas fa-comments text-3xl text-gray-600"></i>
            <h3 class="text-2xl font-extrabold text-gray-800">Comentarios Recientes</h3>
        </div>
        <div class="space-y-6 max-h-[250px] overflow-y-auto">
            @forelse($comentarios as $comentario)
                <div class="p-4 bg-white rounded-lg shadow-md hover:shadow-lg transition duration-200 flex justify-between">
                    <div>
                        <p class="text-gray-700 font-semibold">
                            {{ $comentario->ciudadano->usuario->nombre ?? 'Usuario Anónimo' }} {{ $comentario->ciudadano->usuario->apellidos ?? '' }}
                        </p>
                        <p class="text-gray-800">{{ $comentario->contenido }}</p>
                        <small class="text-gray-500">
                            Publicado: {{ $comentario->created_at->diffForHumans() }}
                            @if($comentario->created_at != $comentario->updated_at)
                                | Editado: {{ $comentario->updated_at->diffForHumans() }}
                            @endif
                        </small>
                    </div>
                    @if(auth()->id() === $comentario->ciudadano->id_usuario)
                    <div class="relative">
                        <button class="text-blue-500 hover:text-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                onclick="toggleEditForm({{ $comentario->id_comentario }})">
                            Editar
                        </button>
                        <form action="{{ route('comentarios.update', $comentario->id_comentario) }}" method="POST" id="edit-form-{{ $comentario->id_comentario }}" class="hidden">
                            @csrf
                            @method('PUT')
                            <textarea name="contenido" rows="2" class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $comentario->contenido }}</textarea>
                            <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white font-medium rounded-lg hover:bg-blue-600">Actualizar</button>
                        </form>
                    </div>
                    @endif
                </div>
            @empty
                <p class="text-gray-500">No hay comentarios aún.</p>
            @endforelse
        </div>
    </div>

</div>

<script>
    function toggleEditForm(id) {
        const form = document.getElementById(`edit-form-${id}`);
        form.classList.toggle('hidden');
    }
</script>
@endsection
