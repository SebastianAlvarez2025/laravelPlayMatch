<!DOCTYPE html>
<html lang="es">
<head>
    <title>Módulo Árbitros</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
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
                            <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Buscar por id_usuario, licencia o categoría">
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
                    <thead class="table-primary text-center">
                        <tr>
                            <th>ID Árbitro</th>
                            <th>ID Usuario</th>
                            <th>Licencia</th>
                            <th>Años Experiencia</th>
                            <th>Categoría Arbitral</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle text-center">
                    @foreach ($datos as $item)
                        <tr>
                            <td>{{ $item->id_arbitro }}</td>
                            <td>{{ $item->id_usuario }}</td>
                            <td>{{ $item->licencia }}</td>
                            <td>{{ $item->anos_experiencia }}</td>
                            <td>{{ $item->categoria_arbitral }}</td>
                            <td>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editarModal{{ $item->id_arbitro }}">
                                    <i class="fa-solid fa-pen-to-square"></i> Editar
                                </button>

                                <form action="{{ route('arbitros.destroy', $item->id_arbitro) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este árbitro?')">
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
                                                <label class="form-label">ID Usuario</label>
                                                <input type="number" class="form-control" name="id_usuario" value="{{ $item->id_usuario }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Licencia</label>
                                                <input type="text" class="form-control" name="licencia" value="{{ $item->licencia }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Años de Experiencia</label>
                                                <input type="number" class="form-control" name="anos_experiencia" value="{{ $item->anos_experiencia }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Categoría Arbitral</label>
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

                <div class="d-flex justify-content-end">
                    {{ $datos->links() }}
                </div>
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
                            <h5 class="modal-title"><i class="fa-solid fa-user"></i> Registrar Árbitro</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">ID Usuario</label>
                                <input type="number" class="form-control" name="id_usuario" placeholder="Digite el ID del usuario" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Licencia</label>
                                <input type="text" class="form-control" name="licencia" placeholder="Digite la licencia" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Años de Experiencia</label>
                                <input type="number" class="form-control" name="anos_experiencia" placeholder="Digite los años de experiencia" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Categoría Arbitral</label>
                                <input type="text" class="form-control" name="categoria_arbitral" placeholder="Digite la categoría arbitral" required>
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
