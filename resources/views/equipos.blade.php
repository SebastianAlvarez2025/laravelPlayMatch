<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo Equipos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a2d9a56a4b.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h3>Módulo Equipos</h3>
            <hr>

            {{-- Botón Nuevo --}}
            <div class="text-end mb-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregar">
                    <i class="fa-solid fa-plus"></i> Nuevo
                </button>
            </div>

            {{-- Tabla --}}
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Ciudad</th>
                        <th>Categoría</th>
                        <th>Escudo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datos as $item)
                    <tr>
                        <td>{{ $item->id_equipo }}</td>
                        <td>{{ $item->nombre_equipo }}</td>
                        <td>{{ $item->ciudad }}</td>
                        <td>{{ $item->id_categoria }}</td>
                        <td><img src="{{ $item->escudo_url }}" width="50"></td>
                        <td>{{ $item->estado }}</td>
                        <td>
                            {{-- Botón Editar --}}
                            <button type="button" class="btn btn-success btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditar{{ $item->id_equipo }}">
                                <i class="fa-solid fa-pen-to-square"></i> Editar
                            </button>

                            {{-- Botón Eliminar --}}
                            <form action="{{ route('equipos.destroy', $item->id_equipo) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este equipo?')">
                                    <i class="fa-solid fa-trash"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>

                    {{-- Modal Editar --}}
                    <div class="modal fade" id="modalEditar{{ $item->id_equipo }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('equipos.update', $item->id_equipo) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Editar Equipo</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-2">
                                            <label>Nombre</label>
                                            <input type="text" name="nombre_equipo" class="form-control" value="{{ $item->nombre_equipo }}" required>
                                        </div>
                                        <div class="mb-2">
                                            <label>Ciudad</label>
                                            <input type="text" name="ciudad" class="form-control" value="{{ $item->ciudad }}" required>
                                        </div>
                                        <div class="mb-2">
                                            <label>ID Categoría</label>
                                            <input type="number" name="id_categoria" class="form-control" value="{{ $item->id_categoria }}" required>
                                        </div>
                                        <div class="mb-2">
                                            <label>Escudo URL</label>
                                            <input type="text" name="escudo_url" class="form-control" value="{{ $item->escudo_url }}">
                                        </div>
                                        <div class="mb-2">
                                            <label>Estado</label>
                                            <input type="text" name="estado" class="form-control" value="{{ $item->estado }}">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Guardar Cambios</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal Agregar --}}
<div class="modal fade" id="modalAgregar" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('equipos.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Equipo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Nombre</label>
                        <input type="text" name="nombre_equipo" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Ciudad</label>
                        <input type="text" name="ciudad" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>ID Categoría</label>
                        <input type="number" name="id_categoria" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Escudo URL</label>
                        <input type="text" name="escudo_url" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>Estado</label>
                        <input type="text" name="estado" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
