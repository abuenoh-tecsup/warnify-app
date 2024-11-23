@extends('layouts.layout')

@section('title', 'Acerca de Warnify')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Acerca de Warnify</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Sección 1: Descripción de Warnify -->
        <div class="col-span-1 bg-gray-100 p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold text-gray-700 mb-4">Por qué Warnify</h3>
            <p class="text-gray-600">
                En muchas localidades, la falta de un sistema eficiente para reportar incidentes como accidentes o problemas
                de infraestructura dificulta la comunicación entre ciudadanos y autoridades. Warnify busca cerrar esa brecha,
                proporcionando herramientas tecnológicas que agilizan la respuesta y resolución de problemas, mejorando la calidad de vida.
            </p>
        </div>

        <!-- Sección 2: Misión de la Empresa -->
        <div class="col-span-1 bg-gray-100 p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold text-gray-700 mb-4">Nuestra Misión</h3>
            <p class="text-gray-600">
                Nuestra misión como empresa es liderar la innovación tecnológica a través del desarrollo de soluciones de software
                que transformen y optimicen los procesos empresariales y la vida cotidiana. Nos dedicamos a crear aplicaciones
                y plataformas personalizadas que resuelvan los desafíos únicos de nuestros clientes, impulsando su éxito con herramientas
                tecnológicas avanzadas, seguras y escalables.
            </p>
        </div>
    </div>

    <!-- Sección adicional: Valores de la Empresa -->
    <div class="mt-6 bg-white p-6 rounded-lg shadow-lg">
        <h3 class="text-2xl font-bold text-gray-800 mb-4 text-center">Nuestros Valores</h3>
        <p class="text-gray-600 text-justify">
            En Warnify, priorizamos la innovación, la colaboración y la confianza. Creemos en el poder de la tecnología para transformar
            vidas, y trabajamos incansablemente para ofrecer soluciones que generen impacto positivo, fortaleciendo la relación entre
            ciudadanos y autoridades para construir comunidades más seguras y conectadas.
        </p>
    </div>

    <!-- Sección de Contacto -->
    <div class="mt-6 bg-gray-100 p-6 rounded-lg shadow-lg">
        <h3 class="text-2xl font-bold text-gray-800 mb-4 text-center">Contáctanos</h3>
        <p class="text-gray-600 text-center mb-6">
            Si tienes preguntas, inquietudes o deseas comunicarte con nosotros, puedes enviarnos un correo directamente a cualquiera de las siguientes direcciones:
        </p>
        <div class="flex justify-center space-x-4">
            <!-- Correo 1 -->
            <a href="mailto:eduardo.bullon@tecsup.edu.pe"
               class="px-4 py-2 bg-blue-500 text-white font-medium rounded-lg shadow-md hover:bg-blue-600">
                eduardo.bullon@tecsup.edu.pe
            </a>
            <!-- Correo 2 -->
            <a href="mailto:sonaly.sifuentes@tecsup.edu.pe"
               class="px-4 py-2 bg-blue-500 text-white font-medium rounded-lg shadow-md hover:bg-blue-600">
                sonaly.sifuentes@tecsup.edu.pe
            </a>
            <!-- Correo 3 -->
            <a href="mailto:alvaro.bueno@tecsup.edu.pe"
               class="px-4 py-2 bg-blue-500 text-white font-medium rounded-lg shadow-md hover:bg-blue-600">
                alvaro.bueno@tecsup.edu.pe
            </a>
        </div>
    </div>
</div>
@endsection
