@extends('welcome')

@section('title', 'Encuentros')
@section('content')

<div class="container-sm d-flex justify-content-center mt-5">
    <div class="card" style="width: 1200px;">
        <div class="card-body">
            <h3>Módulo Encuentros</h3>
            <hr>

            <form action="{{ url('/encuentros') }}" method="GET">
                <div class="text-end mb-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarModal">
                        <i class="fa-solid fa-plus"></i> Nuevo  
                    </button>
                </div>

                <div class="row g-2 align-items-center">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Buscar por fecha, torneo o equipo">
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <button type="submit" class="btn btn-info"><i class="fas fa-search-plus"></i> Buscar</button>
                        <a href="{{ url('/encuentros') }}" class="btn btn-warning"><i class="fas fa-list"></i> Reset</a>
                    </div>
                </div>
            </form>

            @if($datos->count() > 0)
                <table class="table table-striped table-hover table-bordered">
                    <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>ID Fecha</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>ID Torneo</th>
                        <th>ID Lugar</th>
                        <th>ID Equipo</th>
                        <th>ID Arbitro</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($datos as $item)
                        <tr>
                            <td>{{ $item->id_encuentro }}</td>
                            <td>{{ $item->id_fecha }}</td>
                            <td>{{ $item->fecha }}</td>
                            <td>{{ $item->hora }}</td>
                            <td>{{ $item->id_torneo }}</td>
                            <td>{{ $item->id_lugar }}</td>
                            <td>{{ $item->id_equipo }}</td>
                            <td>{{ $item->id_arbitro }}</td>
                            <td>
                                <!-- BOTÓN EDITAR -->
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editarModal{{ $item->id_encuentro }}">
                                    <i class="fa-solid fa-pen-to-square"></i> Editar
                                </button>

                                <!-- BOTÓN ELIMINAR -->
                                <form action="{{ route('encuentros.destroy', $item->id_encuentro) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar este encuentro?')">
                                        <i class="fa-solid fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- MODAL EDITAR -->
                        <div class="modal fade" id="editarModal{{ $item->id_encuentro }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="{{ route('encuentros.update', $item->id_encuentro) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title"><i class="fa-solid fa-pen-to-square"></i> Editar encuentro</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">

                                            <div class="mb-3">
                                                <label>ID Fecha</label>
                                                <input type="number" class="form-control" name="id_fecha" value="{{ $item->id_fecha }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label>Fecha</label>
                                                <input type="date" class="form-control" name="fecha" value="{{ $item->fecha }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label>Hora</label>
                                                <input type="time" class="form-control" name="hora" value="{{ $item->hora }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label>ID Torneo</label>
                                                <input type="number" class="form-control" name="id_torneo" value="{{ $item->id_torneo }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label>ID Lugar</label>
                                                <input type="number" class="form-control" name="id_lugar" value="{{ $item->id_lugar }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label>ID Equipo</label>
                                                <input type="number" class="form-control" name="id_equipo" value="{{ $item->id_equipo }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label>ID Arbitro</label>
                                                <input type="number" class="form-control" name="id_arbitro" value="{{ $item->id_arbitro }}" required>
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
                <p class="text-center mt-3">No se encontraron encuentros.</p>
            @endif
        </div>

        <!-- MODAL AGREGAR -->
        <div class="modal fade" id="agregarModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{ route('encuentros.store') }}" method="POST">
                        @csrf

                        <div class="modal-header">
                            <h5 class="modal-title"><i class="fa-solid fa-plus"></i> Crear encuentro</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">

                            <div class="mb-3">
                                <label>ID Fecha</label>
                                <input type="number" class="form-control" name="id_fecha" required>
                            </div>

                            <div class="mb-3">
                                <label>Fecha</label>
                                <input type="date" class="form-control" name="fecha" required>
                            </div>

                            <div class="mb-3">
                                <label>Hora</label>
                                <input type="time" class="form-control" name="hora" required>
                            </div>

                            <div class="mb-3">
                                <label>ID Torneo</label>
                                <input type="number" class="form-control" name="id_torneo" required>
                            </div>

                            <div class="mb-3">
                                <label>ID Lugar</label>
                                <input type="number" class="form-control" name="id_lugar" required>
                            </div>

                            <div class="mb-3">
                                <label>ID Equipo</label>
                                <input type="number" class="form-control" name="id_equipo" required>
                            </div>

                            <div class="mb-3">
                                <label>ID Arbitro</label>
                                <input type="number" class="form-control" name="id_arbitro" required>
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
