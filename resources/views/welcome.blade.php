<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Playmatch - @yield('title')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #4e6166ff;
            padding-top: 20px;
            position: fixed;
        }
        .sidebar a {
            color: white;
            font-size: 16px;
            padding: 12px 20px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #00408a;
        }
        .content {
            margin-left: 260px;
            padding: 20px;
        }
        .brand-title {
            font-size: 22px;
            font-weight: bold;
            color: white;
            margin-left: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="brand-title">🏆 Playmatch</div>

        <a href="{{route('arbitros.index')}}">Árbitros</a>
        <a href="{{route('categorias.index')}}">Categorías</a>
        <a href="{{route('encuentros.index')}}">Encuentros</a>
        <a href="{{route('equipos.index')}}">Equipos</a>
        <a href="{{route('faltas.index')}}">Faltas</a>
        <a href="{{route('fechas.index')}}">Fechas</a>
        <a href="{{route('jugadores.index')}}">Jugadores</a>
        <a href="{{route('lugares.index')}}">Lugares</a>
        <a href="{{route('posiciones.index')}}">Posiciones</a>
        <a href="{{route('premiacion.index')}}">Premiación</a>
        <a href="{{route('resultados.index')}}">Resultados</a>
        <a href="{{route('roles.index')}}">Roles</a>
        <a href="{{route('tecnicos.index')}}">Tecnicos</a>
        <a href="{{route('tipo_falta.index')}}">Tipo falta</a>
        <a href="{{route('torneos.index')}}">Torneos</a>
        <a href="{{route('usuarios.index')}}">Usuarios</a>

        <hr class="text-white">

        @auth
            <form action="{{ route('logout') }}" method="POST" class="px-3">
                @csrf
                <button type="submit" class="btn btn-light w-100">Cerrar sesión</button>
            </form>
        @else
            <a href="#" class="btn btn-outline-light w-75 mx-3">Iniciar sesión</a>
        @endauth
    </div>

    <!-- 📌 CONTENIDO PRINCIPAL -->
    <div class="content">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
