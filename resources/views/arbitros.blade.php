<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo Árbitros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a2d9a56a4b.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-body">
            <h3 class="mb-3">Módulo Árbitros</h3>
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
                    <tr class="text-center">
                        <th>id_arbitroÁrbitro</th>
                        <th>id_usuario</th>
                        <th>Licencia</th>
                        <th>Anos_experiencia</th>
                        <th>Categoría_Arbitral</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datos as $item)
                    <tr class="text-center">
                        <td>{{ $item->id_arbitro }}</td>
                        <td>{{ $item->id_usuario }}</td>
                        <td>{{ $item->licencia }}</td>
                        <td>{{ $item->anos_experiencia }}</td>
                        <td>{{ $item->categoria_arbitral }}</td>
                        <td>
                            {{-- Botón Editar --}}
                            <button type="button" class="btn btn-success btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditar{{ $item->id_arbitro }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>

                            {{-- Botón Eliminar --}}
                            <form action="{{ route('arbitros.destroy', $item->id_arbitro) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este árbitro?')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    {{-- Modal Editar --}}
                    <div class="modal fade" id="modalEditar{{ $item->id_arbitro }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('arbitros.update', $item->id_arbitro) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Editar Árbitro</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-2">
                                            <label>id_usuario</label>
                                            <input type="number" name="id_usuario" class="form-control" value="{{ $item->id_usuario }}" required>
                                        </div>
                                        <div class="mb-2">
                                            <label>Licencia</label>
                                            <input type="text" name="licencia" class="form-control" value="{{ $item->licencia }}" required>
                                        </div>
                                        <div class="mb-2">
                                            <label>Anos_experiencia</label>
                                            <input type="number" name="anos_experiencia" class="form-control" value="{{ $item->anos_experiencia }}" required>
                                        </div>
                                        <div class="mb-2">
                                            <label>Categoría_arbitral</label>
                                            <input type="text" name="categoria_arbitral" class="form-control" value="{{ $item->categoria_arbitral }}" required>
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
            <form action="{{ route('arbitros.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Árbitro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>ID Usuario</label>
                        <input type="number" name="id_usuario" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Licencia</label>
                        <input type="text" name="licencia" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Años de Experiencia</label>
                        <input type="number" name="anos_experiencia" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Categoría Arbitral</label>
                        <input type="text" name="categoria_arbitral" class="form-control" required>
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
