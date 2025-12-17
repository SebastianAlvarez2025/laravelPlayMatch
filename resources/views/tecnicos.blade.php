@extends('dashboard')

@section('title', 'Tecnicos')

@section('content')
<div class="container-sm d-flex justify-content-center mt-5">
    <div class="card" style="width: 1200px;">
        <div class="card-body">

            <h3>Módulo Técnicos</h3>
            <hr>

            <form action="{{ url('/tecnicos') }}" method="GET">

                <div class="text-end mb-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarModal">
                        <i class="fa-solid fa-plus"></i> Nuevo
                    </button>
                </div>

                <div class="row g-2 align-items-center">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" name="search"
                                   value="{{ request('search') }}"
                                   placeholder="Buscar técnico, usuario o equipo">
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <button type="submit" class="btn btn-info">
                            <i class="fas fa-search-plus"></i> Buscar
                        </button>
                        <a href="{{ url('/tecnicos') }}" class="btn btn-warning">
                            <i class="fas fa-list"></i> Reset
                        </a>
                    </div>
                </div>
            </form>

            @if($datos->count() > 0)
            <table class="table table-striped table-hover table-bordered mt-3">
                <thead class="table-primary">
                    <tr>
                        <th>Técnico</th>
                        <th>Usuario</th>
                        <th>Equipo</th>
                        <th>Licencia</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($datos as $item)
                    <tr>
                        <td>{{ $item->id_tecnico }}</td>
                        <td>{{ $item->id_usuario }}</td>
                        <td>{{ $item->equipo }}</td>
                        <td>{{ $item->licencia }}</td>
                        <td>
                            <button class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#editarModal{{ $item->id_tecnico }}">
                                <i class="fa-solid fa-pen-to-square"></i> Editar
                            </button>

                            <form action="{{ route('tecnicos.destroy', $item->id_tecnico) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger"
                                        onclick="return confirm('¿Seguro que desea eliminar?')">
                                    <i class="fa-solid fa-trash"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- MODAL EDITAR -->
                    <div class="modal fade" id="editarModal{{ $item->id_tecnico }}">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form action="{{ route('tecnicos.update', $item->id_tecnico) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Editar Técnico</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label>ID Usuario</label>
                                            <input type="text" class="form-control"
                                                   name="id_usuario" value="{{ $item->id_usuario }}">
                                        </div>
                                        <div class="mb-3">
                                            <label>ID Equipo</label>
                                            <input type="text" class="form-control"
                                                   name="id_equipo">
                                        </div>
                                        <div class="mb-3">
                                            <label>Licencia</label>
                                            <input type="number" class="form-control"
                                                   name="licencia" value="{{ $item->licencia }}">
                                        </div>
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
            @else
                <p class="text-center mt-3">No hay técnicos registrados.</p>
            @endif

        </div>
    </div>
</div>

<!-- MODAL AGREGAR -->
<div class="modal fade" id="agregarModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('tecnicos.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Crear Técnico</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>ID Técnico</label>
                        <input type="text" class="form-control" name="id_tecnico" required>
                    </div>
                    <div class="mb-3">
                        <label>ID Usuario</label>
                        <input type="text" class="form-control" name="id_usuario" required>
                    </div>
                    <div class="mb-3">
                        <label>ID Equipo</label>
                        <input type="text" class="form-control" name="id_equipo" required>
                    </div>
                    <div class="mb-3">
                        <label>Licencia</label>
                        <input type="number" class="form-control" name="licencia" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
