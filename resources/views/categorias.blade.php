<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo Categorías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a2d9a56a4b.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h3>Módulo Categorías</h3>
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
                        <th>id_categoria</th>
                        <th>Nombre Categoría</th>
                        <th>Descripción</th>
                        <th>Edad Mínima</th>
                        <th>Edad Máxima</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datos as $item)
                    <tr>
                        <td>{{ $item->id_categoria }}</td>
                        <td>{{ $item->nombre_categoria }}</td>
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->edad_minima }}</td>
                        <td>{{ $item->edad_maxima }}</td>
                        <td>
                            {{-- Botón Editar --}}
                            <button type="button" class="btn btn-success btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditar{{ $item->id_categoria }}">
                                <i class="fa-solid fa-pen-to-square"></i> Editar
                            </button>

                            {{-- Botón Eliminar --}}
                            <form action="{{ route('categorias.destroy', $item->id_categoria) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta categoría?')">
                                    <i class="fa-solid fa-trash"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>

                    {{-- Modal Editar --}}
                    <div class="modal fade" id="modalEditar{{ $item->id_categoria }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('categorias.update', $item->id_categoria) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Editar Categoría</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-2">
                                            <label>Nombre Categoría</label>
                                            <input type="text" name="nombre_categoria" class="form-control" value="{{ $item->nombre_categoria }}" required>
                                        </div>
                                        <div class="mb-2">
                                            <label>Descripción</label>
                                            <input type="text" name="descripcion" class="form-control" value="{{ $item->descripcion }}" required>
                                        </div>
                                        <div class="mb-2">
                                            <label>Edad Mínima</label>
                                            <input type="number" name="edad_minima" class="form-control" value="{{ $item->edad_minima }}" required>
                                        </div>
                                        <div class="mb-2">
                                            <label>Edad Máxima</label>
                                            <input type="number" name="edad_maxima" class="form-control" value="{{ $item->edad_maxima }}" required>
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
            <form action="{{ route('categorias.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Categoría</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Nombre Categoría</label>
                        <input type="text" name="nombre_categoria" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Descripción</label>
                        <input type="text" name="descripcion" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Edad Mínima</label>
                        <input type="number" name="edad_minima" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Edad Máxima</label>
                        <input type="number" name="edad_maxima" class="form-control" required>
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
