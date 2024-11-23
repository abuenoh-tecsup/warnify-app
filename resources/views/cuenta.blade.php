@extends('layouts.layout')

@section('title', 'Mi cuenta')

@section('content')
<div class="container mx-auto px-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Configuración de Perfil</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!--Información de Perfil -->
        <div>
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Información de Perfil</h2>
            <form action="{{ route('cuenta.update') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
                @csrf
                @method('PATCH')

                <div class="mb-4">
                    <label for="nombre" class="text-gray-600 font-medium">Nombres</label>
                    <input 
                        type="text" 
                        name="nombre" 
                        value="{{ old('nombre', $user->nombre) }}" 
                        class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md px-4 py-2 w-full"
                    >
                </div>
                <div class="mb-4">
                    <label for="apellidos" class="text-gray-600 font-medium">Apellidos</label>
                    <input 
                        type="text" 
                        name="apellidos" 
                        value="{{ old('apellidos', $user->apellidos) }}" 
                        class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md px-4 py-2 w-full"
                    >
                </div>
                <div class="mb-4">
                    <label for="correo" class="text-gray-600 font-medium">Correo electrónico</label>
                    <input 
                        type="email" 
                        name="correo" 
                        value="{{ old('correo', $user->email) }}" 
                        class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md px-4 py-2 w-full"
                    >
                </div>
                <div class="mb-4">
                    <label for="telefono" class="text-gray-600 font-medium">Número de teléfono</label>
                    <input 
                        type="text" 
                        name="telefono" 
                        value="{{ old('telefono', $user->telefono) }}" 
                        class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md px-4 py-2 w-full"
                    >
                </div>
                <div class="mb-4">
                    <label for="direccion" class="text-gray-600 font-medium">Dirección</label>
                    <input 
                        type="text" 
                        name="direccion" 
                        value="{{ old('direccion', $user->direccion) }}" 
                        class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md px-4 py-2 w-full"
                    >
                </div>
                <div class="mb-4">
                    <label for="fecha_registro" class="text-gray-600 font-medium">Fecha de Registro</label>
                    <input 
                        type="text" 
                        value="{{ $user->created_at }}" 
                        disabled 
                        class="bg-gray-100 border-gray-300 focus:outline-none rounded-md px-4 py-2 w-full"
                    >
                </div>
                <div class="mb-4">
                    <label for="notificaciones" class="text-gray-600 font-medium">Estado de Notificaciones</label>
                    <div class="flex gap-4">
                        <label class="flex items-center gap-2">
                            <input 
                                type="radio" 
                                name="notificaciones" 
                                value="1" {{ old('notificaciones', $user->notifi_acti) == 1 ? 'checked' : '' }}>Activo
                        </label>
                        <label class="flex items-center gap-2">
                            <input 
                                type="radio" 
                                name="notificaciones" 
                                value="0" {{ old('notificaciones', $user->notifi_acti) == 0 ? 'checked' : '' }}>Inactivo
                        </label>
                    </div>
                </div>
                <button class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md">
                    Guardar Cambios
                </button>
            </form>
        </div>

        <!-- Cambio de Contraseña -->
        <div>
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Cambio de Contraseña</h2>
            <form action="{{ route('cuenta.changePassword') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md mb-6">
                @csrf
                @method('PATCH')

                <div class="mb-4">
                    <label for="actual" class="text-gray-600 font-medium">Contraseña Actual</label>
                    <input 
                        type="password" 
                        name="actual" 
                        placeholder="Ingresar contraseña actual" 
                        class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md px-4 py-2 w-full" 
                        required
                    >
                </div>

                <div class="mb-4">
                    <label for="nueva" class="text-gray-600 font-medium">Nueva Contraseña</label>
                    <input 
                        type="password" 
                        name="nueva" 
                        placeholder="Ingresar nueva contraseña" 
                        class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md px-4 py-2 w-full" 
                        required
                    >
                </div>

                <div class="mb-4">
                    <label for="nueva_confirmation" class="text-gray-600 font-medium">Confirmar Nueva Contraseña</label>
                    <input 
                        type="password" 
                        name="nueva_confirmation" 
                        placeholder="Confirmar nueva contraseña" 
                        class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md px-4 py-2 w-full" 
                        required
                    >
                </div>

                <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md">
                    Actualizar Contraseña
                </button>
            </form>

            <!-- Reportes -->
            @if (Auth::user()->isCiudadano())
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Reportes</h2>
        
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="mb-4">
                    <label for="reportes" class="text-gray-600 font-medium">Estado de Reportes</label>
                    <p class="text-gray-700">
                        Tienes {{ $pendientes }} reportes pendientes y {{ $resueltos }} reportes resueltos.
                    </p>
            </div>
            @endif
                <!-- Fecha y hora 
                <div class="flex gap-4"
                    <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md">
                        Ver Historial
                    </button>
                    <button class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md">
                        Eliminar Cuenta
                    </button>
                </div>
                -->
            </div>
        </div>
    </div>
</div>
@endsection
