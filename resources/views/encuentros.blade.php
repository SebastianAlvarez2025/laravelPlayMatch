@extends('welcome')

@section('title', 'Encuentros')
@section('content')

<div class="container-sm d-flex justify-content-center mt-5">
    <div class="card" style="width: 1200px;">
        <div class="card-body">
            <h3>Módulo Encuentros</h3>
            <hr>

            <!-- BUSCADOR -->
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
                            <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Buscar por torneo o lugar">
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
                            <th>ID Encuentro</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Torneo</th>
                            <th>Lugar</th>
                            <th>Equipo</th>
                            <th>Árbitro Principal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datos as $item)
                        <tr>
                            <td>{{ $item->id_encuentro }}</td>
                            <td>{{ $item->fecha }}</td>
                            <td>{{ $item->hora }}</td>
                            <td>{{ $item->torneo->nombre ?? '-' }}</td>
                            <td>{{ $item->lugar->nombre ?? '-' }}</td>
                            <td>{{ $item->equipo->nombre ?? '-' }}</td>
                            <td>{{ $item->arbitro->nombre ?? '-' }}</td>
                            <td>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editarModal{{ $item->id_encuentro }}">
                                    <i class="fa-solid fa-pen-to-square"></i> Editar
                                </button>
                                <form action="{{ route('encuentros.destroy', $item->id_encuentro) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este encuentro?')">
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
                                            <h5 class="modal-title"><i class="fa-solid fa-pen-to-square"></i> Editar Encuentro</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Fecha</label>
                                                <input type="date" class="form-control" name="fecha" value="{{ $item->fecha }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Hora</label>
                                                <input type="time" class="form-control" name="hora" value="{{ $item->hora }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Torneo</label>
                                                <select class="form-select" name="id_torneo" required>
                                                    <option value="">Seleccione torneo</option>
                                                    @foreach($torneos as $torneo)
                                                        <option value="{{ $torneo->id_torneo }}" {{ $item->id_torneo == $torneo->id_torneo ? 'selected' : '' }}>
                                                            {{ $torneo->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Lugar</label>
                                                <select class="form-select" name="id_lugar" required>
                                                    <option value="">Seleccione lugar</option>
                                                    @foreach($lugares as $lugar)
                                                        <option value="{{ $lugar->id_lugar }}" {{ $item->id_lugar == $lugar->id_lugar ? 'selected' : '' }}>
                                                            {{ $lugar->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Equipo</label>
                                                <select class="form-select" name="id_equipo" required>
                                                    <option value="">Seleccione equipo</option>
                                                    @foreach($equipos as $equipo)
                                                        <option value="{{ $equipo->id_equipo }}" {{ $item->id_equipo == $equipo->id_equipo ? 'selected' : '' }}>
                                                            {{ $equipo->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Árbitro Principal</label>
                                                <select class="form-select" name="id_arbitro_principal" required>
                                                    <option value="">Seleccione árbitro</option>
                                                    @foreach($arbitros as $arb)
                                                        <option value="{{ $arb->id_arbitro }}" {{ $item->id_arbitro_principal == $arb->id_arbitro ? 'selected' : '' }}>
                                                            {{ $arb->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
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
                <p class="text-center mt-3">No se encontraron encuentros.</p>
            @endif
        </div>

        <!-- MODAL AGREGAR -->
        <div class="modal fade" id="agregarModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{ route('encuentros.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="fa-solid fa-calendar"></i> Crear Encuentro</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Fecha</label>
                                <input type="date" class="form-control" name="fecha" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Hora</label>
                                <input type="time" class="form-control" name="hora" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Torneo</label>
                                <select class="form-select" name="id_torneo" required>
                                    <option value="">Seleccione torneo</option>
                                    @foreach($torneos as $torneo)
                                        <option value="{{ $torneo->id_torneo }}">{{ $torneo->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Lugar</label>
                                <select class="form-select" name="id_lugar" required>
                                    <option value="">Seleccione lugar</option>
                                    @foreach($lugares as $lugar)
                                        <option value="{{ $lugar->id_lugar }}">{{ $lugar->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Equipo</label>
                                <select class="form-select" name="id_equipo" required>
                                    <option value="">Seleccione equipo</option>
                                    @foreach($equipos as $equipo)
                                        <option value="{{ $equipo->id_equipo }}">{{ $equipo->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Árbitro Principal</label>
                                <select class="form-select" name="id_arbitro_principal" required>
                                    <option value="">Seleccione árbitro</option>
                                    @foreach($arbitros as $arb)
                                        <option value="{{ $arb->id_arbitro }}">{{ $arb->nombre }}</option>
                                    @endforeach
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
