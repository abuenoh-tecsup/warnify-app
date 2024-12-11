<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Warnify</title> <!-- Título de la página -->

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            width: 100vw;
            display: flex;
        }
        .container {
            display: flex;
            width: 100%;
            height: 100%; /* Asegura que ocupe toda la altura de la ventana */
            margin: 0;
        }
        /* Parte izquierda con título e imagen (fondo azul) */
        .left {
            flex: 1; /* Aumentamos el flex para que ocupe más espacio */
            background-color: #001F54; /* Azul */
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
            padding: 20px;
            box-sizing: border-box;
        }
        .left h1 {
            font-size: 96px;
            font-weight: bold;
            color: white;
            margin-bottom: 24px;
            font-family: 'Poppins', sans-serif;
        }
        .left img {
            width: 100%;  /* Aumentar el tamaño de la imagen */
            max-width: 500px; /* Limitar el tamaño máximo de la imagen */
            height: auto;
        }
        /* Parte derecha con el formulario de inicio de sesión */
        .right {
            flex: 1; /* Reducimos el flex para que ocupe menos espacio */
            background-color: #fff; /* Fondo blanco para la parte derecha */
            display: flex;
            flex-direction: column;
            justify-content: center; /* Centra verticalmente */
            align-items: center; /* Centra horizontalmente */
            padding: 20px;
            box-sizing: border-box;
            text-align: center; /* Alinea el texto al centro */
        }
        .right h1 {
            font-size: 48px;
            font-weight: 700;
            color: #001F54;
            text-align: center;
            margin-bottom: 20px; /* Espacio debajo del título */
        }
        /* Formulario interno */
        .form-container {
            width: 100%;
            max-width: 550px; /* Limita el ancho de los campos de texto */
            padding: 20px;
            background-color: #F1F1F1; /* Fondo gris claro para el formulario interno */
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombra suave */
        }
        .form-group {
            width: 100%;
            margin-bottom: 20px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #888;  /* Color de borde */
            border-radius: 10px;
            margin-bottom: 15px; /* Espacio entre los campos de entrada */
            background-color: #fff; /* Fondo blanco para los campos de texto */
            color: #333;  /* Color de texto oscuro */
        }
        .btn {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .text-link {
            color: #001F54;
            font-size: 14px;
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>
<body>
        <div class="left">
            <h1>Warnify</h1>
            <img src="Logo Warnify.jpeg" alt="Warnify Eye Logo">
        </div>

        <div class="right">
            <div class="form-container bg-white">
                {{ $slot }}
            </div>
        </div>
</body>
</html>
