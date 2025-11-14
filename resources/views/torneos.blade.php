<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modulo torneos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/fontawesome.min.css" integrity="sha512-M5Kq4YVQrjg5c2wsZSn27Dkfm/2ALfxmun0vUE3mPiJyK53hQBHYCVAtvMYEC7ZXmYLg8DVG4tF8gD27WmDbsg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <container class="container-sm d-flex justify-content-center mt-5">
        <div class="card">
            <div class="card-body" style="width: 1200px;">
                <h3>Modulo torneos</h3>
                <hr>
                <form name="cliente" action="" method="post">
                    <div class="text-end mb-3">
                        <button type="button" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Nuevo</button>
                    </div>
                    <div class="row g-2 align-items-center">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Buscar</span>
                                <input type="text" class="form-control" placeholder="Buscar por nombre o documento" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                        </div>

                        <div class="col-md-6 text-end">
                            <button type="button" class="btn btn-info"><i class="fas fa-search-plus"></i> Buscar</button>
                            <button type="button" class="btn btn-warning"><i class="fas fa-list"></i> Reset</button>
                        </div>
                    </div>

                </form>

                <table class="table table-striped table-hover table-bordered ">
                        <thead class="table-primary">
                            <tr>
                            <th scope="col">id_torneo</th>
                            <th scope="col">nombre_torneo</th>
                            <th scope="col">fecha_inicio</th>
                            <th scope="col">fecha_fin</th>
                            <th scope="col">ciudad</th>
                            <th scope="col">id_categoria</th>
                            <th scope="col">id_usuario</th>
                            <th scope="col">estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datos as $item)
                        <tr>
                            <td>{{ $item->id_rol }}</td>
                            <td>{{ $item->nombrerol }}</td>
                            <td>{{ $item->descripcion }}</td>
                            <td>
                                <!-- BOTÓN EDITAR -->
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editarModal{{ $item->id_rol }}">
                                    <i class="fa-solid fa-pen-to-square"></i> Editar
                                </button>

                                
                                <!-- BOTÓN ELIMINAR -->
                                <form action="{{ route('roles.destroy', $item->id_rol) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este rol?')">
                                        <i class="fa-solid fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- MODAL EDITAR -->
                        <div class="modal fade" id="editarModal{{ $item->id_rol }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="{{ route('roles.update', $item->id_rol) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title"><i class="fa-solid fa-pen-to-square"></i> Editar Rol</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="nombrerol" class="form-label">Nombre del rol</label>
                                                <input type="text" class="form-control" name="nombrerol" value="{{ $item->nombrerol }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="descripcion" class="form-label">Descripción</label>
                                                <input type="text" class="form-control" name="descripcion" value="{{ $item->descripcion }}" required>
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
                <p class="text-center mt-3">No se encontraron roles.</p>
            @endif
        </div>

        <!-- MODAL AGREGAR -->
        <div class="modal fade" id="agregarModal" tabindex="-1" aria-labelledby="agregarModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="fa-solid fa-user"></i> Crear Rol</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="id_rol" class="form-label">Identificación del rol</label>
                                <input type="text" class="form-control" id="id_rol" name="id_rol" placeholder="Digite el ID del nuevo rol" required>
                            </div>
                            <div class="mb-3">
                                <label for="nombrerol" class="form-label">Nombre del rol</label>
                                <input type="text" class="form-control" id="nombrerol" name="nombrerol" placeholder="Digite el nombre del rol" required>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción del rol" required>
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