<!DOCTYPE html>
<html lang="es">
<head>
    <title>Módulo Árbitros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
<div class="container-sm d-flex justify-content-center mt-5">
    <div class="card" style="width: 1200px;">
        <div class="card-body">
            <h3>Módulo Árbitros</h3>
            <hr>

            <form action="{{ url('/arbitros') }}" method="GET">
                <div class="text-end mb-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarModal">
                        <i class="fa-solid fa-plus"></i> Nuevo
                    </button>
                </div>

                <div class="row g-2 align-items-center">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Buscar por nombre o categoría arbitral">
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <button type="submit" class="btn btn-info"><i class="fas fa-search-plus"></i> Buscar</button>
                        <a href="{{ url('/arbitros') }}" class="btn btn-warning"><i class="fas fa-list"></i> Reset</a>
                    </div>
                </div>
            </form>

            @if($datos->count() > 0)
                <table class="table table-striped table-hover table-bordered">
                    <thead class="table-primary">
                    <tr>
                        <th>id_Árbitro</th>
                        <th>id_Usuario</th>
                        <th>Licencia</th>
                        <th>Anos_Experiencia</th>
                        <th>Categoría_arbitral</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($datos as $item)
                        <tr>
                            <td>{{ $item->id_arbitro }}</td>
                            <td>{{ $item->id_usuario }}</td>
                            <td>{{ $item->licencia }}</td>
                            <td>{{ $item->anos_experiencia }}</td>
                            <td>{{ $item->categoria_arbitral }}</td>
                            <td>
                                <!-- BOTÓN EDITAR -->
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editarModal{{ $item->id_arbitro }}">
                                    <i class="fa-solid fa-pen-to-square"></i> Editar
                                </button>

                                <!-- BOTÓN ELIMINAR -->
                                <form action="{{ route('arbitros.destroy', $item->id_arbitro) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este árbitro?')">
                                        <i class="fa-solid fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- MODAL EDITAR -->
                        <div class="modal fade" id="editarModal{{ $item->id_arbitro }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="{{ route('arbitros.update', $item->id_arbitro) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title"><i class="fa-solid fa-pen-to-square"></i> Editar Árbitro</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="id_usuario" class="form-label">ID Usuario</label>
                                                <input type="text" class="form-control" name="id_usuario" value="{{ $item->id_usuario }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="licencia" class="form-label">Licencia</label>
                                                <input type="text" class="form-control" name="licencia" value="{{ $item->licencia }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="anos_experiencia" class="form-label">Años de Experiencia</label>
                                                <input type="number" class="form-control" name="anos_experiencia" value="{{ $item->anos_experiencia }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="categoria_arbitral" class="form-label">Categoría Arbitral</label>
                                                <input type="text" class="form-control" name="categoria_arbitral" value="{{ $item->categoria_arbitral }}" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Guardar cambios</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center mt-3">No se encontraron árbitros.</p>
            @endif
        </div>

        <!-- MODAL AGREGAR -->
        <div class="modal fade" id="agregarModal" tabindex="-1" aria-labelledby="agregarModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{ route('arbitros.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="fa-solid fa-user"></i> Crear Árbitro</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="id_arbitro" class="form-label">ID Árbitro</label>
                                <input type="text" class="form-control" name="id_arbitro" placeholder="Ingrese el ID del árbitro" required>
                            </div>
                            <div class="mb-3">
                                <label for="id_usuario" class="form-label">ID Usuario</label>
                                <input type="text" class="form-control" name="id_usuario" placeholder="Ingrese el ID del usuario" required>
                            </div>
                            <div class="mb-3">
                                <label for="licencia" class="form-label">Licencia</label>
                                <input type="text" class="form-control" name="licencia" placeholder="Ingrese la licencia del árbitro" required>
                            </div>
                            <div class="mb-3">
                                <label for="anos_experiencia" class="form-label">Años de Experiencia</label>
                                <input type="number" class="form-control" name="anos_experiencia" placeholder="Ingrese los años de experiencia" required>
                            </div>
                            <div class="mb-3">
                                <label for="categoria_arbitral" class="form-label">Categoría Arbitral</label>
                                <input type="text" class="form-control" name="categoria_arbitral" placeholder="Ingrese la categoría arbitral" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
</body>
</html>
