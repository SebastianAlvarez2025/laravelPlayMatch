<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo Torneos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<div class="container mt-4">

    <h3 class="text-center">Módulo Torneos</h3>
    <hr>

    <!-- BOTÓN NUEVO -->
    <div class="text-end mb-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarModal">
            Nuevo Torneo
        </button>
    </div>

    <!-- FORM BUSCAR -->
    <form class="row mb-3" method="GET" action="{{ route('torneos.index') }}">
        <div class="col-md-6">
            <input type="text" name="search" class="form-control" placeholder="Buscar...">
        </div>
        <div class="col-md-6 text-end">
            <button class="btn btn-info">Buscar</button>
            <a href="{{ route('torneos.index') }}" class="btn btn-warning">Reset</a>
        </div>
    </form>

    <!-- TABLA -->
    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Torneo</th>
                <th>Inicio</th>
                <th>Fin</th>
                <th>Ciudad</th>
                <th>Categoría</th>
                <th>Usuario</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>

        @foreach ($datos as $item)
            <tr>
                <td>{{ $item->id_torneo }}</td>
                <td>{{ $item->nombre_torneo }}</td>
                <td>{{ $item->fecha_inicio }}</td>
                <td>{{ $item->fecha_fin }}</td>
                <td>{{ $item->ciudad }}</td>
                <td>{{ $item->id_categoria }}</td>
                <td>{{ $item->id_usuario }}</td>
                <td>{{ $item->estado }}</td>

                <td>
                    <!-- EDITAR -->
                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#edit{{ $item->id_torneo }}">
                        Editar
                    </button>

                    <!-- ELIMINAR -->
                    <form action="{{ route('torneos.destroy', $item->id_torneo) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('¿Eliminar torneo?')" class="btn btn-danger btn-sm">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>

            <!-- MODAL EDITAR -->
            <div class="modal fade" id="edit{{ $item->id_torneo }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('torneos.update', $item->id_torneo) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="modal-header">
                                <h5>Editar Torneo</h5>
                            </div>

                            <div class="modal-body">
                                <label>Nombre</label>
                                <input name="nombre_torneo" class="form-control mb-2" value="{{ $item->nombre_torneo }}">

                                <label>Fecha Inicio</label>
                                <input name="fecha_inicio" type="date" class="form-control mb-2" value="{{ $item->fecha_inicio }}">

                                <label>Fecha Fin</label>
                                <input name="fecha_fin" type="date" class="form-control mb-2" value="{{ $item->fecha_fin }}">

                                <label>Ciudad</label>
                                <input name="ciudad" class="form-control mb-2" value="{{ $item->ciudad }}">

                                <label>ID Categoría</label>
                                <input name="id_categoria" class="form-control mb-2" value="{{ $item->id_categoria }}">

                                <label>ID Usuario</label>
                                <input name="id_usuario" class="form-control mb-2" value="{{ $item->id_usuario }}">

                                <label>Estado</label>
                                <input name="estado" class="form-control mb-2" value="{{ $item->estado }}">
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button class="btn btn-primary">Guardar</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        @endforeach

        </tbody>
    </table>

    <div class="d-flex justify-content-end">
        {{ $datos->links() }}
    </div>
</div>

<!-- MODAL AGREGAR -->
<div class="modal fade" id="agregarModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="{{ route('torneos.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5>Nuevo Torneo</h5>
                </div>

                <div class="modal-body">

                    <label>ID Torneo</label>
                    <input name="id_torneo" class="form-control mb-2">

                    <label>Nombre</label>
                    <input name="nombre_torneo" class="form-control mb-2">

                    <label>Fecha Inicio</label>
                    <input name="fecha_inicio" type="date" class="form-control mb-2">

                    <label>Fecha Fin</label>
                    <input name="fecha_fin" type="date" class="form-control mb-2">

                    <label>Ciudad</label>
                    <input name="ciudad" class="form-control mb-2">

                    <label>ID Categoría</label>
                    <input name="id_categoria" class="form-control mb-2">

                    <label>ID Usuario</label>
                    <input name="id_usuario" class="form-control mb-2">

                    <label>Estado</label>
                    <input name="estado" class="form-control mb-2">

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button class="btn btn-primary">Guardar</button>
                </div>

            </form>

        </div>
    </div>
</div>

</body>
</html>
