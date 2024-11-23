@extends('layouts.layout')

@section('title', 'Acerca de Warnify')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Acerca de Warnify</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="col-span-1 bg-gray-100 p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold text-gray-700 mb-4">Por qué Warnify</h3>
            <p class="text-gray-600">
                En muchas localidades, la falta de un sistema eficiente para reportar incidentes como accidentes o problemas
                de infraestructura dificulta la comunicación entre ciudadanos y autoridades. Warnify busca cerrar esa brecha,
                proporcionando herramientas tecnológicas que agilizan la respuesta y resolución de problemas, mejorando la calidad de vida.
            </p>
        </div>
        <div class="col-span-1 bg-gray-100 p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold text-gray-700 mb-4">Nuestra Misión</h3>
            <p class="text-gray-600">
                Nuestra misión como empresa, llamada <strong>EVADEVS</strong>, es transformar la manera en que las personas y empresas
                interactúan con la tecnología. A través del desarrollo de soluciones de software innovadoras, optimizamos procesos empresariales
                y mejoramos la vida cotidiana. En EVADEVS, nos dedicamos a crear aplicaciones y plataformas personalizadas que resuelvan los
                desafíos únicos de nuestros clientes, impulsando su éxito con herramientas tecnológicas avanzadas, seguras y escalables.
            </p>
        </div>
    </div>

    <div class="mb-6 bg-white p-6 rounded-lg shadow-lg">
        <h3 class="text-2xl font-bold text-gray-800 mb-4 text-center">Nuestros Valores</h3>
        <p class="text-gray-600 text-justify">
            En Warnify, priorizamos la innovación, la colaboración y la confianza. Creemos en el poder de la tecnología para transformar
            vidas, y trabajamos incansablemente para ofrecer soluciones que generen impacto positivo, fortaleciendo la relación entre
            ciudadanos y autoridades para construir comunidades más seguras y conectadas.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Comentario -->
        <div class="bg-gray-100 p-6 rounded-lg shadow-lg">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Envíanos tu Comentario</h3>
            <form action="{{ route('comentarios.store') }}" method="POST" class="space-y-4">
                @csrf
                <textarea name="contenido" id="contenido" rows="4" placeholder="Escribe tu comentario aquí..."
                          class="w-full p-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                <button type="submit" class="px-6 py-2 bg-green-500 text-white font-medium rounded-lg hover:bg-green-600">
                    Enviar Comentario
                </button>
            </form>
        </div>

        <div class="bg-gray-100 p-6 rounded-lg shadow-lg">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Comentarios Recientes</h3>
            <div class="space-y-4 max-h-[600px] overflow-y-scroll">
                @forelse($comentarios as $comentario)
                    <div class="p-4 bg-white rounded-lg shadow-md flex justify-between">
                        <div>
                            <p class="text-gray-600">
                                <strong>{{ $comentario->ciudadano->usuario->nombre ?? 'Usuario Anónimo' }} {{ $comentario->ciudadano->usuario->apellidos ?? '' }}</strong>
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
                                <!-- Botón para editar -->
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

    <!-- Contacto -->
    <div class="mt-6 bg-white p-6 rounded-lg shadow-lg">
        <h3 class="text-2xl font-bold text-gray-800 mb-4 text-center">Contacto</h3>
        <p class="text-gray-600 text-center mb-4">
            Si tienes preguntas, inquietudes o sugerencias, no dudes en contactarnos a través de los siguientes correos:
        </p>
        <div class="flex justify-center space-x-4">
            <a href="mailto:eduardo.bullon@tecsup.edu.pe"
               class="px-4 py-2 bg-blue-500 text-white font-medium rounded-lg shadow-md hover:bg-blue-600">
                eduardo.bullon@tecsup.edu.pe
            </a>
            <a href="mailto:sonaly.sifuentes@tecsup.edu.pe"
               class="px-4 py-2 bg-blue-500 text-white font-medium rounded-lg shadow-md hover:bg-blue-600">
                sonaly.sifuentes@tecsup.edu.pe
            </a>
            <a href="mailto:alvaro.bueno@tecsup.edu.pe"
               class="px-4 py-2 bg-blue-500 text-white font-medium rounded-lg shadow-md hover:bg-blue-600">
                alvaro.bueno@tecsup.edu.pe
            </a>
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
