@extends('welcome')

@section('title', 'Torneos')
@section('content')
<div class="container-sm d-flex justify-content-center mt-5">
    <div class="card" style="width: 1200px;">
        <div class="card-body">
            <h3>Módulo Torneos</h3>
            <hr>

            <form action="{{ url('/torneos') }}" method="GET">
                <div class="text-end mb-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarModal">
                        <i class="fa-solid fa-plus"></i> Nuevo
                    </button>
                </div>

                <div class="row g-2 align-items-center">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Buscar por nombre o categoría del Torneo">
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <button type="submit" class="btn btn-info"><i class="fas fa-search-plus"></i> Buscar</button>
                        <a href="{{ url('/torneos') }}" class="btn btn-warning"><i class="fas fa-list"></i> Reset</a>
                    </div>
                </div>
            </form>

            @if($datos->count() > 0)
                <table class="table table-striped table-hover table-bordered">
                    <thead class="table-primary">
                    <tr>
                        <th> Torneo</th>
                        <th>Nombre de Torneo</th> 
                        <th>Fecha de Inicio</th> 
                        <th>Fecha de Finalizacion</th> 
                        <th>Ciudad</th> 
                        <th>Categoria</th> 
                        <th>Usuario</th>
                        <th>Estado</th>
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
                                <!-- BOTÓN EDITAR -->
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editarModal{{ $item->id_torneo }}">
                                    <i class="fa-solid fa-pen-to-square"></i> Editar
                                </button>

                                <!-- BOTÓN ELIMINAR -->
                                <form action="{{ route('torneos.destroy', $item->id_torneo) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este torneo ?')">
                                        <i class="fa-solid fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- MODAL EDITAR -->
                        <div class="modal fade" id="editarModal{{ $item->id_torneo }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="{{ route('torneos.update', $item->id_torneo) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title"><i class="fa-solid fa-pen-to-square"></i> Editar Torneo</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="nombre_torneo" class="form-label">Nombre de Torneo</label>
                                                <input type="text" class="form-control" name="nombre_torneo" value="{{ $item->nombre_torneo }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                                                <input type="text" class="form-control" name="fecha_inicio" value="{{ $item->fecha_inicio }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="fecha_fin" class="form-label">Fecha de Finalizacion</label>
                                                <input type="number" class="form-control" name="fecha_fin" value="{{ $item->fecha_fin }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="ciudad" class="form-label">Ciudad</label>
                                                <input type="text" class="form-control" name="ciudad" value="{{ $item->ciudad }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="id_categoria" class="form-label">Id Categoria</label>
                                                <input type="text" class="form-control" name="id_categoria" value="{{ $item->id_categoria }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="id_usuario" class="form-label">Id Usuario</label>
                                                <input type="text" class="form-control" name="id_usuario" value="{{ $item->id_usuario }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="estado" class="form-label">Estado</label>
                                                <input type="text" class="form-control" name="estado" value="{{ $item->estado }}" required>
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
                <p class="text-center mt-3">No se encontraron Torneos.</p>
            @endif
        </div>

        <!-- MODAL AGREGAR -->
        <div class="modal fade" id="agregarModal" tabindex="-1" aria-labelledby="agregarModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{ route('torneos.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="fa-solid fa-user"></i> Crear Torneo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="id_torneo" class="form-label">Torneo</label>
                                <input type="text" class="form-control" name="id_torneo" placeholder="Ingrese el ID del Torneo" required>
                            </div>
                            <div class="mb-3">
                                <label for="nombre_torneo" class="form-label">Nombre de Torneo </label>
                                <input type="text" class="form-control" name="nombre_torneo" placeholder="Ingrese el Nombre del Torneo" required>
                            </div>
                            <div class="mb-3">
                                <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                                <input type="text" class="form-control" name="fecha_inicio" placeholder="Ingrese la Fecha de Inicio" required>
                            </div>
                            <div class="mb-3">
                                <label for="fecha_fin" class="form-label">Fecha de Finalizacion</label>
                                <input type="number" class="form-control" name="fecha_fin" placeholder="Ingrese la Fecha de Finalizacion" required>
                            </div>
                            <div class="mb-3">
                                <label for="ciudad" class="form-label">Ciudad</label>
                                <input type="text" class="form-control" name="ciudad" placeholder="Ingrese la Ciudad" required>
                            </div>
                            <div class="mb-3">
                                <label for="id_categoria" class="form-label">Categoria</label>
                                <input type="text" class="form-control" name="id_categoria" placeholder="Ingrese la Categoria" required>
                            </div>
                            <div class="mb-3">
                                <label for="id_usuario" class="form-label">Usuario</label>
                                <input type="text" class="form-control" name="id_usuario" placeholder="Ingrese el Id del Usuario" required>
                            </div>
                            <div class="mb-3">
                                <label for="estado" class="form-label">Estado</label>
                                <input type="text" class="form-control" name="estado" placeholder="Ingrese el Estado" required>
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

@endsection

