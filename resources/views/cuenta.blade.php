@extends('layouts.layout')

@section('title', 'Mi cuenta')

@section('content')

<div class="container mx-auto px-6">
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
</div>
<div class="container mx-auto px-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Configuración de Perfil</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!--Información de Perfil -->
        <div>
        <form action="{{ route('cuenta.update') }}" method="POST" class="bg-gradient-to-r from-blue-100 via-blue-150 to-blue-100 p-6 rounded-lg shadow-lg mb-6 border-2 border-cyan-300 hover:shadow-xl transition-shadow duration-300">
                @csrf
                @method('PATCH')
                <div class="mb-4 flex items-center space-x-4">
                    <!-- Ícono de usuario con color teal más oscuro -->
                    <i class="fas fa-user text-teal-700 text-3xl"></i>
                    <h2 class="text-xl font-semibold text-teal-700">Información de Perfil</h2> <!-- Título color teal más oscuro -->
                </div>

                <!-- Campos comunes -->
                <div class="mb-4">
                    <label for="nombre" class="text-gray-600 font-medium">Nombres</label>
                    <input type="text" name="nombre" value="{{ old('nombre', $user->nombre) }}" 
                        class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md px-4 py-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="apellidos" class="text-gray-600 font-medium">Apellidos</label>
                    <input type="text" name="apellidos" value="{{ old('apellidos', $user->apellidos) }}" 
                        class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md px-4 py-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="correo" class="text-gray-600 font-medium">Correo electrónico</label>
                    <input type="email" name="correo" value="{{ old('correo', $user->email) }}" 
                        class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md px-4 py-2 w-full">
                </div>

                    <!-- Campos específicos dependiendo del tipo de usuario -->
                @if ($user->ciudadano)
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="mb-4">
                        <label for="telefono" class="text-gray-600 font-medium">Número de teléfono</label>
                        <input type="text" name="telefono" value="{{ old('telefono', $user->telefono) }}" 
                            class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md px-4 py-2 w-full">
                    </div>
                    <div class="mb-4">
                        <label for="documento_identidad" class="text-gray-600 font-medium">DNI</label>
                        <input type="text" name="documento_identidad" value="{{ old('documento_identidad', $user->ciudadano->documento_identidad ?? '') }}" 
                            class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md px-4 py-2 w-full">
                    </div>
                    <div class="mb-4">
                        <label for="ocupacion" class="text-gray-600 font-medium">Ocupación</label>
                        <input type="text" name="ocupacion" value="{{ old('ocupacion', $user->ciudadano->ocupacion ?? '') }}" 
                            class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md px-4 py-2 w-full">
                    </div>
                @endif
                               

                @if ($user->moderador)
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    <div class="mb-4">
                        <label for="telefono" class="text-gray-600 font-medium">Número de teléfono</label>
                        <input type="text" name="telefono" value="{{ old('telefono', $user->telefono) }}" 
                            class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md px-4 py-2 w-full">
                    </div>
                    <div class="mb-4">
                        <label for="area_supervision" class="text-gray-600 font-medium">Área de Supervisión</label>
                        <input type="text" name="area_supervision" value="{{ old('area_supervision', $user->moderador->area_supervision ?? '') }}" 
                            class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md px-4 py-2 w-full">
                    </div>
                @endif

                @if ($user->autoridad)
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="mb-4">
                        <label for="telefono" class="text-gray-600 font-medium">Número de teléfono</label>
                        <input type="text" name="telefono" value="{{ old('telefono', $user->telefono) }}" 
                            class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md px-4 py-2 w-full">
                    </div>
                    <div class="mb-4">
                        <label for="cargo" class="text-gray-600 font-medium">Cargo</label>
                        <input type="text" name="cargo" value="{{ old('cargo', $user->autoridad->cargo ?? '') }}" 
                            class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md px-4 py-2 w-full">
                    </div>
                    <div class="mb-4">
                        <label for="tipo_autoridad" class="text-gray-600 font-medium">Tipo de Autoridad</label>
                        <input type="text" name="tipo_autoridad" value="{{ old('tipo_autoridad', $user->autoridad->tipo_autoridad ?? '') }}" 
                            class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md px-4 py-2 w-full">
                    </div>
                @endif
                </div>

                <div class="mb-4">
                        <label for="direccion" class="text-gray-600 font-medium">Dirección</label>
                        <input type="text" name="direccion" value="{{ old('direccion', $user->direccion) }}" 
                            class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md px-4 py-2 w-full">
                </div>

                <!-- Fecha de registro (solo visualización) -->
                <div class="mb-4">
                    <label for="fecha_registro" class="text-gray-600 font-medium">Fecha de Registro</label>
                    <input type="text" value="{{ $user->created_at }}" disabled 
                        class="bg-gray-100 border-gray-300 focus:outline-none rounded-md px-4 py-2 w-full">
                </div>

                <!-- Estado de notificaciones -->
                <div class="mb-4">
                    <label for="notificaciones" class="text-gray-600 font-medium">Estado de Notificaciones</label>
                    <div class="flex gap-4">
                        <label class="flex items-center gap-2">
                            <input type="radio" name="notificaciones" value="1" {{ old('notificaciones', $user->notifi_acti) == 1 ? 'checked' : '' }}>Activo
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="radio" name="notificaciones" value="0" {{ old('notificaciones', $user->notifi_acti) == 0 ? 'checked' : '' }}>Inactivo
                        </label>
                    </div>
                </div>

                <button class="bg-sky-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md">
                    Guardar Cambios
                </button>
            </form>
        </div>

        <!-- Cambio de Contraseña -->
        <div>
        <form action="{{ route('cuenta.changePassword') }}" method="POST" class="bg-gradient-to-r from-yellow-50 via-yellow-100 to-yellow-50 p-6 rounded-lg shadow-lg mb-6 border-2 border-yellow-300 hover:shadow-xl transition-shadow duration-300">
                @csrf
                @method('PATCH')
                <div class="mb-4 flex items-center space-x-4">
                    <!-- Ícono de llave con color amarillo más oscuro -->
                    <i class="fas fa-key text-yellow-700 text-3xl"></i>
                    <h2 class="text-xl font-semibold text-yellow-700">Cambio de Contraseña</h2> <!-- Título color amarillo más oscuro -->
                </div>

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
            <div class="bg-gradient-to-r from-green-50 via-green-100 to-green-50 p-6 rounded-lg shadow-lg mb-6 border-2 border-green-300 hover:shadow-xl transition-shadow duration-300">
                    <div class="mb-4 flex items-center space-x-4">
                        <!-- Ícono de reportes con color verde más oscuro -->
                        <i class="fas fa-clipboard-list text-green-700 text-3xl"></i>
                        <h2 class="text-xl font-semibold text-green-700">Estado de Reportes</h2> <!-- Título color verde más oscuro -->
                    </div>
                    <div class="mb-4">
                        <label for="reportes" class="text-gray-600 font-medium">Estado de Reportes</label>
                        @if ($pendientes === 0 && $resueltos === 0)
                            <p class="text-gray-700">Usted no realizó reportes aún.</p>
                        @else
                            <p class="text-gray-700">
                                Tienes {{ $pendientes }} reportes pendientes y {{ $resueltos }} reportes resueltos.
                            </p>
                        @endif                    
                    </div>
                </div>
            @endif

            <!-- Botón de Cerrar Sesión -->
            <div class="container mx-auto p-4 mt-8">
                <form method="POST" action="{{ route('logout') }}" class="flex justify-end space-x-4">
                    @csrf
                    <button class="bg-red-500 text-white font-semibold py-3 px-6 rounded-lg shadow-md hover:bg-red-600">
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
