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
                            <input type="text" class="form-control" name="search"
                                value="{{ request('search') }}" placeholder="Buscar por fecha, torneo o equipo">
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <button type="submit" class="btn btn-info">
                            <i class="fas fa-search"></i> Buscar
                        </button>
                        <a href="{{ url('/encuentros') }}" class="btn btn-warning">
                            <i class="fas fa-sync"></i> Reset
                        </a>
                    </div>
                </div>
            </form>

            @if($datos->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th>Encuentro</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Torneo</th>
                            <th>Lugar</th>
                            <th>Equipo</th>
                            <th>Árbitro</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datos as $item)
                        <tr>
                            <td><strong>{{ $item->id_encuentro }}</strong></td>

                            <!-- FECHA CORREGIDA -->
                            <td>
                                {{ $item->fechaInfo ? \Carbon\Carbon::parse($item->fechaInfo->fecha)->format('d/m/Y') : 'N/A' }}
                            </td>

                            <td>{{ $item->hora }}</td>
                            <td>{{ $item->torneo->nombre_torneo ?? 'N/A' }}</td>
                            <td>{{ $item->lugar->nombre_lugar ?? 'N/A' }}</td>
                            <td>{{ $item->equipo->nombre_equipo ?? 'N/A' }}</td>

                            <td>
                                @if($item->arbitro)
                                    {{ $item->arbitro->nombre ?? 'Árbitro '.$item->arbitro->id_arbitro }}
                                    @if($item->arbitro->licencia)
                                        (Lic: {{ $item->arbitro->licencia }})
                                    @endif
                                @else
                                    N/A
                                @endif
                            </td>

                            <td>
                                <div class="btn-group" role="group">

                                    <!-- EDITAR -->
                                    <button type="button" class="btn btn-success btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#editarModal{{ $item->id_encuentro }}">
                                        <i class="fa-solid fa-pen-to-square"></i> Editar
                                    </button>

                                    <!-- ELIMINAR -->
                                    <form action="{{ route('encuentros.destroy', $item->id_encuentro) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Seguro desea eliminar este encuentro?')">
                                            <i class="fa-solid fa-trash"></i> Eliminar
                                        </button>
                                    </form>

                                </div>
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
                                            <h5 class="modal-title">
                                                <i class="fa-solid fa-pen-to-square"></i> Editar Encuentro
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">

                                            <div class="mb-3">
                                                <label class="form-label">ID Fecha</label>
                                                <input type="number" class="form-control" name="id_fecha"
                                                    value="{{ $item->id_fecha }}" required>
                                            </div>

                                            <!-- FECHA CORREGIDA -->
                                            <div class="mb-3">
                                                <label class="form-label">Fecha</label>
                                                <input type="date" class="form-control" name="fecha"
                                                    value="{{ $item->fechaInfo->fecha ?? '' }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Hora</label>
                                                <input type="time" class="form-control" name="hora"
                                                    value="{{ $item->hora }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Torneo</label>
                                                <select name="id_torneo" class="form-control" required>
                                                    @foreach($torneos as $t)
                                                    <option value="{{ $t->id_torneo }}"
                                                        @if($t->id_torneo == $item->id_torneo) selected @endif>
                                                        {{ $t->nombre_torneo }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Lugar</label>
                                                <select name="id_lugar" class="form-control" required>
                                                    @foreach($lugares as $l)
                                                    <option value="{{ $l->id_lugar }}"
                                                        @if($l->id_lugar == $item->id_lugar) selected @endif>
                                                        {{ $l->nombre_lugar }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Equipo</label>
                                                <select name="id_equipo" class="form-control" required>
                                                    @foreach($equipos as $e)
                                                    <option value="{{ $e->id_equipo }}"
                                                        @if($e->id_equipo == $item->id_equipo) selected @endif>
                                                        {{ $e->nombre_equipo }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Árbitro</label>
                                                <select name="id_arbitro" class="form-control" required>
                                                    @foreach($arbitros as $a)
                                                    <option value="{{ $a->id_arbitro }}"
                                                        @if($a->id_arbitro == $item->id_arbitro) selected @endif>
                                                        {{ $a->nombre ?? 'Árbitro '.$a->id_arbitro }} (Lic: {{ $a->licencia }})
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Cancelar
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa-solid fa-floppy-disk"></i> Guardar Cambios
                                            </button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </tbody>
                </table>
            </div>

            @else
            <div class="text-center mt-5">
                <i class="fas fa-futbol fa-3x text-muted mb-3"></i>
                <p class="text-muted">No se encontraron encuentros.</p>
            </div>
            @endif

        </div>

        <!-- MODAL AGREGAR -->
        <div class="modal fade" id="agregarModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <form action="{{ route('encuentros.store') }}" method="POST">
                        @csrf

                        <div class="modal-header">
                            <h5 class="modal-title">
                                <i class="fa-solid fa-plus"></i> Crear Nuevo Encuentro
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">

                            <div class="mb-3">
                                <label class="form-label">ID Fecha</label>
                                <input type="number" class="form-control" name="id_fecha" required min="1">
                            </div>

                            <!-- FECHA CORREGIDA -->
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
                                <select name="id_torneo" class="form-control" required>
                                    <option value="">Seleccione un torneo</option>
                                    @foreach($torneos as $t)
                                    <option value="{{ $t->id_torneo }}">{{ $t->nombre_torneo }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Lugar</label>
                                <select name="id_lugar" class="form-control" required>
                                    <option value="">Seleccione un lugar</option>
                                    @foreach($lugares as $l)
                                    <option value="{{ $l->id_lugar }}">{{ $l->nombre_lugar }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Equipo</label>
                                <select name="id_equipo" class="form-control" required>
                                    <option value="">Seleccione un equipo</option>
                                    @foreach($equipos as $e)
                                    <option value="{{ $e->id_equipo }}">{{ $e->nombre_equipo }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Árbitro</label>
                                <select name="id_arbitro" class="form-control" required>
                                    <option value="">Seleccione un árbitro</option>
                                    @foreach($arbitros as $a)
                                    <option value="{{ $a->id_arbitro }}">
                                        {{ $a->nombre ?? 'Árbitro '.$a->id_arbitro }} (Lic: {{ $a->licencia }})
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Cancelar
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-floppy-disk"></i> Guardar Encuentro
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>
</div>

@endsection
