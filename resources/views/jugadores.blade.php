@extends('welcome')

@section('title', 'Jugadores')
@section('content')

<div class="container-sm d-flex justify-content-center mt-5">
    <div class="card" style="width: 1200px;">
        <div class="card-body">
            <h3>Módulo Jugadores</h3>
            <hr>

            <!-- FORMULARIO BUSCAR -->
            <form action="{{ url('/jugadores') }}" method="GET">
                <div class="text-end mb-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarModal">
                        <i class="fa-solid fa-plus"></i> Nuevo
                    </button>
                </div>

                <div class="row g-2 align-items-center">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Buscar jugador o equipo">
                        </div>
                    </div>

                    <div class="col-md-6 text-end">
                        <button type="submit" class="btn btn-info">
                            <i class="fas fa-search-plus"></i> Buscar
                        </button>
                        <a href="{{ url('/jugadores') }}" class="btn btn-warning">
                            <i class="fas fa-list"></i> Reset
                        </a>
                    </div>
                </div>
            </form>

            @if ($datos->count() > 0)
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Nombre del jugador</th>
                        <th>Equipo</th>
                        <th>Posición</th>
                        <th>Número camiseta</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($datos as $item)
                    <tr>
                        <td>{{ $item->id_jugador }}</td>
                        <td>{{ $item->nombre_jugador }}</td>
                        <td>{{ $item->equipo_nombre }}</td>
                        <td>{{ $item->posicion }}</td>
                        <td>{{ $item->numero_camiseta }}</td>
                        <td>{{ $item->estado }}</td>

                        <td>
                            <!-- BOTÓN EDITAR -->
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#editarModal{{ $item->id_jugador }}">
                                <i class="fa-solid fa-pen-to-square"></i> Editar
                            </button>

                            <!-- BOTÓN ELIMINAR -->
                            <form action="{{ route('jugadores.destroy', $item->id_jugador) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('¿Eliminar este jugador?')">
                                    <i class="fa-solid fa-trash"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- MODAL EDITAR -->
                    <div class="modal fade" id="editarModal{{ $item->id_jugador }}" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <form action="{{ route('jugadores.update', $item->id_jugador) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="modal-header">
                                        <h5 class="modal-title"><i class="fa-solid fa-pen-to-square"></i> Editar Jugador</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">

                                        <div class="mb-3">
                                            <label class="form-label">Nombre del jugador</label>
                                            <input type="text" name="nombre_jugador" value="{{ $item->nombre_jugador }}"
                                                class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Equipo</label>
                                            <select class="form-select" name="id_equipo" required>
                                                @foreach ($equipos as $equipo)
                                                <option value="{{ $equipo->id_equipo }}"
                                                    {{ $equipo->id_equipo == $item->id_equipo ? 'selected' : '' }}>
                                                    {{ $equipo->nombre_equipo }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Posición</label>
                                            <input type="text" class="form-control" name="posicion"
                                                value="{{ $item->posicion }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Número de camiseta</label>
                                            <input type="number" class="form-control" name="numero_camiseta"
                                                value="{{ $item->numero_camiseta }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Estado</label>
                                            <select class="form-select" name="estado" required>
                                                <option value="activo" {{ $item->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                                                <option value="lesionado" {{ $item->estado == 'lesionado' ? 'selected' : '' }}>Lesionado</option>
                                                <option value="suspendido" {{ $item->estado == 'suspendido' ? 'selected' : '' }}>Suspendido</option>
                                                <option value="inactivo" {{ $item->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                            </select>
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

                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-end">
                {{ $datos->links() }}
            </div>
            @else
            <p class="text-center mt-3">No se encontraron jugadores.</p>
            @endif
        </div>

        <!-- MODAL AGREGAR -->
        <div class="modal fade" id="agregarModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <form action="{{ route('jugadores.store') }}" method="POST">
                        @csrf

                        <div class="modal-header">
                            <h5 class="modal-title"><i class="fa-solid fa-user"></i> Crear jugador</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">

                            <div class="mb-3">
                                <label class="form-label">Identificación del jugador</label>
                                <input type="number" class="form-control" name="id_jugador" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nombre del jugador</label>
                                <input type="text" class="form-control" name="nombre_jugador" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Equipo</label>
                                <select class="form-select" name="id_equipo" required>
                                    <option value="" hidden selected>Seleccione un equipo</option>
                                    @foreach ($equipos as $equipo)
                                    <option value="{{ $equipo->id_equipo }}">{{ $equipo->nombre_equipo }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Posición</label>
                                <input type="text" class="form-control" name="posicion" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Número de camiseta</label>
                                <input type="number" class="form-control" name="numero_camiseta" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Estado</label>
                                <select class="form-select" name="estado" required>
                                    <option value="activo">Activo</option>
                                    <option value="inactivo">Inactivo</option>
                                </select>
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
