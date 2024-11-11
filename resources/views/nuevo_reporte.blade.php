@extends('layouts.layout')

@section('title', 'Nuevo reporte')

@section('content')
    <div class="flex-grow h-full grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="col-span-1 bg-gray-200">
            <h2 class="text-xl font-bold mb-1">Información</h2>
            <div class="bg-gray-300 h-100 p-4 rounded-xl">
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
                        for="fechahora"
                        text="Fecha y hora"
                    />
                    <x-datepicker
                        name="fechahora"
                        placeholder="Seleccionar fecha y hora"
                        value="{{ old('datetime', '') }}"
                    />
                </div>
                <div class="mb-4">
                    <x-label
                        for="imagen"
                        text="Imagen"
                    />
                    <x-image-upload
                        name="profile_image"
                    />
                </div>
            </div>
        </div>
        <div class="col-span-1 md:col-span-2 bg-gray-200 p-4">
            <p>Columna 2 (2/3)</p>
        </div>
    </div>
@endsection
