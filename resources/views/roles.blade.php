<!DOCTYPE html>
<html lang="es">
<head>
    <title>Módulo Roles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <div class="container-sm d-flex justify-content-center mt-5">
        <div class="card" style="width: 1200px;">
            <div class="card-body">
                <h3>Módulo Roles</h3>
                <hr>
                <form name="cliente" action="{{ url('/roles') }}" method="GET">
                    <div class="text-end mb-3">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarModal"><i class="fa-solid fa-plus"></i> Nuevo</button>
                    </div>

                    <div class="row g-2 align-items-center">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Buscar por Roles">
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <button type="submit" class="btn btn-info"><i class="fas fa-search-plus"></i> Buscar</button>
                            <a href="{{ url('/roles') }}" class="btn btn-warning"><i class="fas fa-list"></i> Reset</a>
                        </div>
                    </div>
                </form>

                @if($datos->count() > 0)
                    <table class="table table-striped table-hover table-bordered">
                        <thead class="table-primary">
                            <tr>
                                <th>Identificación del rol</th>
                                <th>Nombre del rol</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datos as $item)
                                <tr>
                                    <td>{{ $item->id_rol }}</td>
                                    <td>{{ $item->nombrerol }}</td>
                                    <td>{{ $item->descripcion }}</td>
                                    <td>
                                        <button type="button" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i> Editar</button>
                                        <button type="button" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Eliminar</button>
                                    </td>
                                </tr>
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

            <!-- Modal -->
            <div class="modal fade" id="agregarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-solid fa-user"></i> Crear Cliente</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <form action="{{ route('roles.store') }}" name="roles" method="POST">
                                @csrf <!--Permite proteger sobre algun virus-->

                                <div class="mb-3">
                                    <label for="id_rol" class="form-label">Identificación del rol</label>
                                    <input type="text" class="form-control" id="id_rol" name="id_rol"placeholder="Digite el número de identificación del nuevo rol." required>
                                </div> 

                                <div class="mb-3">
                                    <label for="nombrerol" class="form-label">Nombre del rol</label>
                                    <input type="text" class="form-control" id="nombrerol" name="nombrerol"placeholder="Digite el nombre del nuevo rol." required>
                                </div> 

                                <div class="mb-3">
                                    <label for="descripcion" class="form-label">Descripción de rol</label>
                                    <input type="text" class="form-control" id="descripcion" name="descripcion"placeholder="Escriba para que sirve el nuevo rol." required>
                                </div> 

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i> Cerrar</button>
                                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
                                </div>

                            </form>
                        </div>



                    </div>
                </div>
            </div>
        </div>

        
    </div>
</body>
</html>
