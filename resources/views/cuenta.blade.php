@extends('layouts.layout')

@section('title', 'Mi cuenta')

@section('content')
<div class="container">
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Configuración de Perfil</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
    }

    h2 {
      margin-bottom: 10px;
    }

    .section {
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 20px;
    }

    .form-group {
      display: flex;
      align-items: center;
      margin-bottom: 15px;
    }

    .form-group label {
      flex: 1;
      font-weight: bold;
    }

    .form-group input {
      flex: 2;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 5px;
    }

    .buttons {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
    }

    .btn {
      padding: 10px 15px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .btn-yellow {
      background-color: #ffc107;
      color: #fff;
    }

    .btn-red {
      background-color: #dc3545;
      color: #fff;
    }

    .btn-blue {
      background-color: #007bff;
      color: #fff;
    }

    .tabs {
      display: flex;
      gap: 10px;
      margin-top: 10px;
    }

    .tabs input {
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 5px;
      flex: 1;
    }
  </style>
</head>
<body>
<div class="container">
    <!-- Alerta de éxito -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Errores de validación -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Información de perfil -->
    <div class="section">
        <h2>Información de perfil</h2>
        <!-- Formulario para actualizar los datos del perfil -->
        <form action="{{ route('cuenta.update') }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="nombre">Nombres</label>
                <input type="text" id="nombres" name="nombres" value="{{ old('nombre', $user->nombre) }}">
            </div>

            <div class="form-group">
                <label for="apellidos">Apellidos</label>
                <input type="text" id="apellidos" name="apellidos" value="{{ old('apellidos', $user->apellidos) }}">
            </div>

            <div class="form-group">
                <label for="correo">Correo electrónico</label>
                <input type="email" id="correo" name="correo" value="{{ old('correo', $user->email) }}">
            </div>

            <div class="form-group">
                <label for="telefono">Número de teléfono</label>
                <input type="text" id="telefono" name="telefono" value="{{ old('telefono', $user->telefono) }}">
            </div>

            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" id="direccion" name="direccion" value="{{ old('direccion', $user->direccion) }}">
            </div>

            <div class="form-group">
                <label for="fecha_registro">Fecha de Registro</label>
                <input type="text" id="fecha_registro" value="{{ $user->created_at }}" disabled style="background-color: #d3d3d3;">
            </div>

            <div class="form-group">
                <label for="notificaciones">Estado de Notificaciones</label>
                <div>
                    <label>
                        <input type="radio" name="notificaciones" value="1" {{ old('notificaciones', $user->notifi_acti) == 1 ? 'checked' : '' }}> Activo
                    </label>
                    <label>
                        <input type="radio" name="notificaciones" value="0" {{ old('notificaciones', $user->notifi_acti) == 0 ? 'checked' : '' }}> Inactivo
                    </label>
                </div>
            </div>

            <div class="buttons">
                <button type="submit" class="btn btn-yellow">Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>
    <style>
    .alert {
        padding: 7px;
        margin: 4px 0;
        border-radius: 3px;
        font-size: 10px;
        position: relative;
        opacity: 1;
        transition: opacity 0.5s ease-in-out;
    }

    .alert-success {
        background-color: #28a745;
        color: white;
    }

    .alert-danger {
        background-color: #dc3545;
        color: white;
    }

    /* Desvanecimiento de alertas */
    .alert-success, .alert-danger {
        animation: fadeOut 3s forwards;
    }

    @keyframes fadeOut {
        0% {
            opacity: 1;
        }
        90% {
            opacity: 1;
        }
        100% {
            opacity: 0;
            visibility: hidden;
        }
    }

</style>
    <!-- Cambio de contraseña -->
    <div class="section">
    <h2>Cambio de contraseña</h2>
    <form action="{{ route('cuenta.changePassword') }}" method="POST">
        @csrf
        @method('PATCH') <!-- Aquí se simula el método PATCH -->

        <div class="form-group">
            <label for="actual">Contraseña actual</label>
            <input type="password" id="actual" name="actual" placeholder="Ingresar contraseña actual" required>
        </div>

        <div class="form-group">
            <label for="nueva">Nueva contraseña</label>
            <input type="password" id="nueva" name="nueva" placeholder="Ingresar nueva contraseña" required>
        </div>

        <div class="form-group">
            <label for="nueva_confirmacion">Verificar nueva contraseña</label>
            <input type="password" id="nueva_confirmation" name="nueva_confirmation" placeholder="Confirmar nueva contraseña" required>
        </div>

        <div class="buttons">
            <button class="btn btn-yellow">Actualizar contraseña</button>
        </div>
    </form>
    </div>

    <!-- Configuración -->
    <div class="section">
    <h2>Configuración</h2>
    <div class="form-group">
        <label for="notificaciones">Estado de Reportes</label>
        <div class="form-group">
            <input type="text" value="Tienes {{ $pendientes }} reportes como pendientes y {{ $resueltos }} reportes resueltos" size="75" disabled style="background-color: #d3d3d3;">
        </div>
    </div>
    <div class="buttons">
        <button class="btn btn-blue">Ver historial de actividades</button>
        <button class="btn btn-red">Eliminar cuenta</button>
    </div>
</div>
  </div>
</body>
</html>
@endsection

