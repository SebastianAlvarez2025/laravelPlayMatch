<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PLAY MATCH</title>

  <link rel="icon" type="image/jpg" href="{{ asset('Images/Logo.png') }}">
  <link rel="stylesheet" href="{{ asset('CSS/Global/global.css') }}">
  <link rel="stylesheet" href="{{ asset('CSS/Visitante/styleBuscarTorneoVis.css') }}">
</head>

<body>
    <header>
      <div class="top-bar">
        <div class="left-size">

          <img src="{{ asset('Images/Logo.png') }}" alt="Logo" class="logo">
          <h1 class="titulo">Play Match</h1>

          <nav class="menu">
            <a href="{{ url('/') }}">Principal/Torneos</a>
            <a href="{{ url('/partidos') }}">Partidos</a>
            <a href="{{ url('/equipos') }}">Equipos</a>
          </nav>

        </div>

        <div class="buttons-container">      
          <section class="sigin">
              <button type="button" onclick="location.href='{{ url('/registrarse') }}'">
                  Registrarse
              </button>
          </section>

          <section class="login">
              <button type="button" onclick="location.href='{{ url('/login') }}'">
                  Inicio de sesion
              </button>
          </section>
        </div>

        <div class="rectangulo">
          <div class="torneoInfo">
            <h1><strong>BUSCADOR DE TORNEOS - PLAYMATCH.</strong></h1>
            <center>
              <p>
                Ingresa el codigo asignado de cada torneo, en caso tal de <br>
                no tener el codigo, ingresa una palabra clave del nombre <br>
                del torneo.
              </p>
            </center>
          </div>

          <form action="{{ route('buscar.visitante') }}" method="GET" class="buscador-torneo">
                <input type="text" name="search" placeholder="Fifas, 2154897..." value="{{ $search ?? '' }}">
                <button type="submit">Buscar</button>
            </form>

        </div>
        
    </header>

  <main>

  </main>
</body>
</html>
