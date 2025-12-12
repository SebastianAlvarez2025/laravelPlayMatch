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
            margin: 0;
            padding: 0;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #2e2e2eff;
            position: fixed;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column;
        }
        .sidebar-content {
            flex: 1;
            overflow-y: auto;
            padding: 20px 0;
        }
        .sidebar a {
            color: white;
            font-size: 16px;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            border: none;
            transition: all 0.2s ease-in-out;
        }
        .sidebar a:hover {
            background-color: #696a75ff;
            transform: scale(1.05);
        }
        .brand-title {
            font-size: 22px;
            font-weight: bold;
            color: white;
            margin-left: 20px;
            margin-bottom: 10px;
            padding: 0 20px;
        }
        .content {
            margin-left: 260px;
            padding: 20px;
            min-height: 100vh;
        }

        .tarjetas-icon { position: relative; width: 20px; height: 20px; }
        .tarjeta-amarilla {
            position: absolute; width: 12px; height: 16px;
            background: #ffd700; border-radius: 2px;
            top: 0; left: 0; transform: rotate(-5deg);
        }
        .tarjeta-roja {
            position: absolute; width: 12px; height: 16px;
            background: #ff4444; border-radius: 2px;
            top: 4px; left: 8px; transform: rotate(5deg);
        }

        .category-title {
            color: #cbd5e1;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 15px 20px 5px 20px;
            margin-top: 10px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid rgba(255,255,255,0.2);
        }

        .sidebar a i {
            color: white;
        }

        /* Barra de búsqueda */
        .search-bar {
            padding: 0 20px 15px 20px;
        }
        .search-bar .form-control {
            background-color: #3a3a3a;
            border: 1px solid #555;
            color: white;
        }
        .search-bar .form-control::placeholder {
            color: #ccc;
        }
        .search-bar .btn {
            border-color: #555;
        }
    </style>
</head>
<body>

    <div class="content">

        <!-- SIDEBAR -->
        <div class="sidebar">
            <div class="sidebar-content">

                @php $rol = session('user.id_rol'); @endphp

                @if($rol == 5 || $rol == 1)
                <!-- Brand -->
                <div class="brand-title">🏆 Playmatch</div>

                <!-- Barra de búsqueda de módulos -->
                <div class="search-bar">
                    <form id="form-busqueda">
                        <div class="input-group input-group-sm">
                            <input type="text" id="buscar-modulo" class="form-control" placeholder="Buscar módulo..." aria-label="Buscar módulo">
                            <button class="btn btn-outline-light" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>

                <div class="category-title">Configuración</div>
                <a href="{{ route('usuarios.index') }}"><i class="fas fa-user-cog"></i> Usuarios</a>
                <a href="{{ route('roles.index') }}"><i class="fas fa-id-badge"></i> Roles</a>
                <a href="{{ route('categorias.index') }}"><i class="fas fa-list"></i> Categorías</a>

                <div class="category-title">Competencia</div>
                <a href="{{ route('torneos.index') }}"><i class="fas fa-trophy"></i> Torneos</a>
                <a href="{{ route('equipos.index') }}"><i class="fas fa-users"></i> Equipos</a>
                <a href="{{ route('jugadores.index') }}"><i class="fas fa-user"></i> Jugadores</a>
                <a href="{{ route('tecnicos.index') }}"><i class="fas fa-chalkboard-teacher"></i> Técnicos</a>

                <div class="category-title">Inscripciones</div>
                <a href="{{ route('inscripciones.index') }}"><i class="fas fa-clipboard-check"></i> Inscripciones</a>

                <div class="category-title">Partidos</div>
                <a href="{{ route('encuentros.index') }}"><i class="fas fa-futbol"></i> Encuentros</a>
                <a href="{{ route('fechas.index') }}"><i class="fas fa-calendar-alt"></i> Fechas</a>
                <a href="{{ route('lugares.index') }}"><i class="fas fa-map-marker-alt"></i> Lugares</a>

                <div class="category-title">Arbitraje</div>
                <a href="{{ route('arbitros.index') }}">
                    <div class="tarjetas-icon">
                        <div class="tarjeta-amarilla"></div>
                        <div class="tarjeta-roja"></div>
                    </div>
                    Árbitros
                </a>
                <a href="{{ route('faltas.index') }}"><i class="fas fa-exclamation-triangle"></i> Faltas</a>
                <a href="{{ route('cronologia.index') }}"><i class="fas fa-clock"></i> Cronología</a>

                <div class="category-title">Resultados</div>
                <a href="{{ route('resultados.index') }}"><i class="fas fa-clipboard-list"></i> Resultados</a>
                <a href="{{ route('posiciones.index') }}"><i class="fas fa-chart-line"></i> Posiciones</a>
                <a href="{{ route('premiacion.index') }}"><i class="fas fa-medal"></i> Premiación</a>
                @endif

            </div>

            <div class="sidebar-footer">
                <a href="/" class="btn btn-outline-light w-100">Cerrar sesión</a>
            </div>
        </div>

        @yield('content')

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    // Redirección por búsqueda de módulos
    document.getElementById('form-busqueda').addEventListener('submit', function(e) {
        e.preventDefault();

        const texto = document.getElementById('buscar-modulo').value.toLowerCase().trim();

        const modulos = {
            "usuarios": "{{ route('usuarios.index') }}",
            "roles": "{{ route('roles.index') }}",
            "categorías": "{{ route('categorias.index') }}",
            "categorias": "{{ route('categorias.index') }}",
            "torneos": "{{ route('torneos.index') }}",
            "equipos": "{{ route('equipos.index') }}",
            "jugadores": "{{ route('jugadores.index') }}",
            "técnicos": "{{ route('tecnicos.index') }}",
            "tecnicos": "{{ route('tecnicos.index') }}",
            "inscripciones": "{{ route('inscripciones.index') }}",
            "encuentros": "{{ route('encuentros.index') }}",
            "fechas": "{{ route('fechas.index') }}",
            "lugares": "{{ route('lugares.index') }}",
            "árbitros": "{{ route('arbitros.index') }}",
            "arbitros": "{{ route('arbitros.index') }}",
            "faltas": "{{ route('faltas.index') }}",
            "cronología": "{{ route('cronologia.index') }}",
            "cronologia": "{{ route('cronologia.index') }}",
            "resultados": "{{ route('resultados.index') }}",
            "posiciones": "{{ route('posiciones.index') }}",
            "premiación": "{{ route('premiacion.index') }}",
            "premiacion": "{{ route('premiacion.index') }}"
        };

        if(modulos[texto]){
            window.location.href = modulos[texto];
        } else {
            alert("Módulo no encontrado: " + texto);
        }
    });
    </script>
</body>
</html>
