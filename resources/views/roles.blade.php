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
                        <button type="button" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Nuevo</button>
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
        </div>
    </div>
</body>
</html>
