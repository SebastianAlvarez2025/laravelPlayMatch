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
        :root {
            --sidebar-bg: #2e2e2eff;
            --sidebar-hover: #696a75ff;
            --alert-max-width: 90%;
        }

        body {
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: var(--sidebar-bg);
            position: fixed;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease-in-out;
            z-index: 1000;
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
        }

        .sidebar a:hover {
            background-color: var(--sidebar-hover);
        }

        .brand-title {
            font-size: 22px;
            font-weight: bold;
            color: white;
            margin-left: 20px;
            margin-bottom: 20px;
            padding: 0 20px;
        }

        .content {
            margin-left: 260px;
            padding: 20px;
            min-height: 100vh;
            transition: margin-left 0.3s ease-in-out;
        }

        /* Icono de tarjetas */
        .tarjetas-icon {
            position: relative;
            width: 20px;
            height: 20px;
        }
        .tarjeta-amarilla {
            position: absolute;
            width: 12px;
            height: 16px;
            background: #ffd700;
            border-radius: 2px;
            top: 0;
            left: 0;
            transform: rotate(-5deg);
        }
        .tarjeta-roja {
            position: absolute;
            width: 12px;
            height: 16px;
            background: #ff4444;
            border-radius: 2px;
            top: 4px;
            left: 8px;
            transform: rotate(5deg);
        }

        .category-title {
            color: #cbd5e1;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 15px 20px 5px 20px;
            margin-top: 10px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Scrollbar */
        .sidebar-content::-webkit-scrollbar { width: 6px; }
        .sidebar-content::-webkit-scrollbar-track { background: rgba(255, 255, 255, 0.1); border-radius: 10px; }
        .sidebar-content::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.3); border-radius: 10px; }
        .sidebar-content::-webkit-scrollbar-thumb:hover { background: rgba(255, 255, 255, 0.5); }

        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            background: rgba(0, 0, 0, 0.1);
        }

        /* Alertas centradas */
        .alert-container {
            width: 100%;
            display: flex;
            justify-content: center;
            margin-bottom: 15px;
        }
        .alert {
            max-width: var(--alert-max-width);
            text-align: center;
            padding: 10px;
            font-size: 14px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                transform: translateX(-100%);
                width: 250px;
                height: 100%;
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .content {
                margin-left: 0;
            }
            .menu-toggle {
                display: inline-block;
                position: fixed;
                top: 15px;
                left: 15px;
                font-size: 24px;
                cursor: pointer;
                z-index: 1100;
                color: #2e2e2e;
            }
        }
    </style>
</head>
<body>

    <!-- Botón toggle para móviles -->
    <div class="menu-toggle d-md-none">
        <i class="fas fa-bars"></i>
    </div>

    <div class="content">
        <!-- Alertas -->
        <div class="alert-container">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-content">
                @php
                    $rol = session('user.codigoRoles'); // corregido typo
                @endphp
                @if($rol == 1)
                    <div class="brand-title">🏆 Playmatch</div>

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
                        <div class="tarjetas-icon" aria-label="Tarjetas amarilla y roja">
                            <div class="tarjeta-amarilla"></div>
                            <div class="tarjeta-roja"></div>
                        </div>
                        Árbitros
                    </a>
                    <a href="{{ route('faltas.index') }}"><i class="fas fa-exclamation-triangle"></i> Faltas</a>
                    <a href="{{ route('cronologia.index') }}"><i class="fas fa-exclamation-circle"></i> Cronología</a>

                    <div class="category-title">Resultados</div>
                    <a href="{{ route('resultados.index') }}"><i class="fas fa-clipboard-list"></i> Resultados</a>
                    <a href="{{ route('posiciones.index') }}"><i class="fas fa-chart-line"></i> Posiciones</a>
                    <a href="{{ route('premiacion.index') }}"><i class="fas fa-medal"></i> Premiación</a>
                @endif
            </div>

            <div class="sidebar-footer">
                @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-light w-100">Cerrar sesión</button>
                    </form>
                @else
                    <a href="/login" class="btn btn-outline-light w-100">Iniciar sesión</a>
                @endauth
            </div>
        </div>

        <!-- Contenido principal -->
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Toggle Sidebar -->
    <script>
        const toggle = document.querySelector('.menu-toggle');
        const sidebar = document.querySelector('.sidebar');
        toggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
    </script>
</body>
</html>
