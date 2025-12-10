<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PLAY MATCH</title>

  <link rel="icon" type="image/jpg" href="{{ asset('Images/Logo.png') }}">
  <link rel="stylesheet" href="{{ asset('CSS/Global/global.css') }}">
  <link rel="stylesheet" href="{{ asset('CSS/Visitante/stylesDatosTorneo.css') }}">
</head>

<body>

<header>
    <div class="top-bar">
        <div class="left-size">
            <img src="{{ asset('Images/Logo.png') }}" alt="Logo" class="logo">
            <h1 class="titulo">Play Match</h1>

            <nav class="menu">
                <a href="{{ url('/') }}">Principal</a>
                <a href="#">Partidos</a>
                <a href="#">Equipos</a>
            </nav>
        </div>

        <div class="buttons-container">      
            <section class="sigin">
                <button type="button" onclick="location.href='{{ url('registrarse') }}'">
                    Registrarse
                </button>
            </section>

            <section class="login">
                <button type="button" onclick="location.href='{{ route('login') }}'">
                    Inicio de sesión
                </button>
            </section>
          </div>
    </div>

    <div class="rectangulo">

        <div class="contenido-equipo">

            <div class="columna-izquierda">
                <img src="{{ $torneo->imagen ?: asset('Images/Logo.png') }}" 
                     alt="Imagen Torneo" 
                     class="img-uno">
            </div>

            <div class="columna-derecha">
                <div class="informacion">
                    <h2>Torneo: {{ $torneo->nombre_torneo }}</h2>
                    <p><strong>Código:</strong> {{ $torneo->id_torneo }}</p>
                    <p><strong>Categoria:</strong> {{ $torneo->id_categoria }}</p>
                    <p><strong>Tipo de Torneo:</strong> {{ $torneo->tipo_torneo }}</p>
                    <p><strong>Estado actual:</strong> {{ $torneo->estado }}</p>
                    <p><strong>Fecha inicio:</strong> {{ $torneo->fecha_inicio }}</p>
                    <p><strong>Fecha fin:</strong> {{ $torneo->fecha_fin }}</p>
                    <p><strong>Cupo de equipos:</strong> {{ $torneo->max_equipos }}</p>
                    <p><strong>Ubicación:</strong> {{ $torneo->ciudad }}</p>
                    <p><strong>Organizador ID:</strong> {{ $torneo->id_usuario }}</p>
                </div>
            </div>

        </div>

        <div class="botones-container">
            <button onclick="location.href='#'">Calendario Partidos</button>
            <button>Visualizar Equipos</button>
        </div>

    </div>
</header>

<script src="{{ asset('JavaScript/TorneoDatos.js') }}"></script>
</body>
</html>
