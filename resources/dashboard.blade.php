# Crea dashboard.blade.php
@"
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - PlayMatch</title>
    <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css\" rel=\"stylesheet\">
    <style>
        body { background: #f8f9fa; }
        .sidebar { background: #4e73df; color: white; min-height: 100vh; }
        .sidebar a { color: white; text-decoration: none; padding: 10px 15px; display: block; }
        .sidebar a:hover { background: rgba(255,255,255,0.1); }
        .navbar { background: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class=\"navbar navbar-expand-lg navbar-light\">
        <div class=\"container-fluid\">
            <a class=\"navbar-brand\" href=\"#\">
                <i class=\"bi bi-trophy\"></i> PlayMatch Dashboard
            </a>
            <div class=\"navbar-nav ms-auto\">
                <span class=\"navbar-text me-3\">
                    <i class=\"bi bi-person-circle\"></i> {{ session('user')['nombre'] ?? 'Usuario' }}
                </span>
                <form action=\"{{ route('logout') }}\" method=\"POST\" class=\"d-inline\">
                    @csrf
                    <button type=\"submit\" class=\"btn btn-outline-danger btn-sm\">
                        <i class=\"bi bi-box-arrow-right\"></i> Salir
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class=\"container-fluid\">
        <div class=\"row\">
            <!-- Sidebar -->
            <div class=\"col-md-3 col-lg-2 sidebar\">
                <div class=\"p-3\">
                    <h5><i class=\"bi bi-menu-button-wide\"></i> Menú</h5>
                    <hr style=\"background: white;\">
                    <a href=\"#\"><i class=\"bi bi-trophy\"></i> Torneos</a>
                    <a href=\"#\"><i class=\"bi bi-people\"></i> Equipos</a>
                    <a href=\"#\"><i class=\"bi bi-person\"></i> Jugadores</a>
                    <a href=\"#\"><i class=\"bi bi-calendar-event\"></i> Encuentros</a>
                    <a href=\"#\"><i class=\"bi bi-bar-chart\"></i> Resultados</a>
                    <a href=\"#\"><i class=\"bi bi-award\"></i> Premiación</a>
                </div>
            </div>

            <!-- Contenido principal -->
            <div class=\"col-md-9 col-lg-10 p-4\">
                <div class=\"card\">
                    <div class=\"card-header bg-primary text-white\">
                        <h4><i class=\"bi bi-house-door\"></i> Panel de Control</h4>
                    </div>
                    <div class=\"card-body\">
                        <h5>¡Bienvenido, {{ session('user')['nombre'] }}!</h5>
                        <p>Has iniciado sesión correctamente en el sistema PlayMatch.</p>
                        
                        <div class=\"row mt-4\">
                            <div class=\"col-md-3\">
                                <div class=\"card text-white bg-success mb-3\">
                                    <div class=\"card-body\">
                                        <h5 class=\"card-title\">ID Usuario</h5>
                                        <p class=\"card-text display-6\">{{ session('user')['id'] }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class=\"col-md-3\">
                                <div class=\"card text-white bg-info mb-3\">
                                    <div class=\"card-body\">
                                        <h5 class=\"card-title\">Rol ID</h5>
                                        <p class=\"card-text display-6\">{{ session('user')['id_rol'] }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class=\"col-md-3\">
                                <div class=\"card text-white bg-warning mb-3\">
                                    <div class=\"card-body\">
                                        <h5 class=\"card-title\">Email</h5>
                                        <p class=\"card-text\">{{ session('user')['correo'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        <p class=\"text-muted\">
                            <small>Usa el menú lateral para navegar por las diferentes secciones del sistema.</small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Icons -->
    <link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css\">
    <!-- Bootstrap JS -->
    <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js\"></script>
</body>
</html>
"@ | Out-File -FilePath "resources/views/dashboard.blade.php" -Encoding UTF8