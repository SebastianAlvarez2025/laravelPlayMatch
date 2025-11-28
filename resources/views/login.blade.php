<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow">

                <div class="card-body">
                    <h3 class="text-center mb-3">Iniciar Sesión</h3>

                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form method="POST" action="/login">
                        @csrf

                        <div class="mb-3">
                            <label>Correo</label>
                            <input type="email" name="correo" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Contraseña</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button class="btn btn-primary w-100">Ingresar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
