
@extends('welcome')

@section('title', 'Encuentros')
@section('content')

<div class="container-sm d-flex justify-content-center mt-5">
    <div class="card" style="width: 1300px;">
        <div class="card-body">
            <h3 class="mb-3">Módulo Encuentros</h3>
            <hr>

            <!-- FORMULARIO DE CREACIÓN -->
            <form action="{{ url('/encuentros/crear') }}" method="POST">
                @csrf

                <div class="row">

                    <!-- Fecha -->
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Fecha:</label>
                        <select name="id_fecha" class="form-select" required>
                            <option value="">Seleccione...</option>
                            @foreach($fechas as $f)
                                <option value="{{ $f->id_fecha }}">{{ $f->fecha }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Hora -->
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Hora:</label>
                        <input type="time" name="hora" class="form-control" required>
                    </div>

                    <!-- Torneo -->
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Torneo:</label>
                        <select name="id_torneo" class="form-select" required>
                            <option value="">Seleccione...</option>
                            @foreach($torneos as $t)
                                <option value="{{ $t->id_torneo }}">{{ $t->nombre_torneo }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Lugar -->
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Lugar:</label>
                        <select name="id_lugar" class="form-select" required>
                            <option value="">Seleccione...</option>
                            @foreach($lugares as $l)
                                <option value="{{ $l->id_lugar }}">{{ $l->nombre_lugar }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="row">

                    <!-- Árbitro -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Árbitro:</label>
                        <select name="id_arbitro" class="form-select" required>
                            <option value="">Seleccione...</option>
                            @foreach($arbitros as $a)
                                <option value="{{ $a->id_arbitro }}">{{ $a->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Local -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Equipo Local:</label>
                        <select name="id_equipo_local" class="form-select" required>
                            <option value="">Seleccione...</option>
                            @foreach($equipos as $e)
                                <option value="{{ $e->id_equipo }}">{{ $e->nombre_equipo }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Visitante -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Equipo Visitante:</label>
                        <select name="id_equipo_visitante" class="form-select" required>
                            <option value="">Seleccione...</option>
                            @foreach($equipos as $e)
                                <option value="{{ $e->id_equipo }}">{{ $e->nombre_equipo }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="text-end mb-3">
                    <button class="btn btn-primary">Crear Encuentro</button>
                </div>
            </form>

            <hr>

            <!-- LISTADO DE ENCUENTROS -->
            <h4 class="mt-4">Listado de Encuentros</h4>

            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Torneo</th>
                        <th>Lugar</th>
                        <th>Árbitro</th>
                        <th>Local</th>
                        <th>Visitante</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($datos as $d)
                    <tr>
                        <td>{{ $d->id_encuentro }}</td>

                        <td>{{ optional($d->fecha)->fecha ?? 'N/A' }}</td>
                        <td>{{ $d->hora }}</td>
                        <td>{{ optional($d->torneo)->nombre_torneo ?? 'N/A' }}</td>
                        <td>{{ optional($d->lugar)->nombre_lugar ?? 'N/A' }}</td>
                        <td>{{ optional($d->arbitro)->nombre ?? 'N/A' }}</td>
                        <td>{{ optional($d->equipoLocal)->nombre_equipo ?? 'N/A' }}</td>
                        <td>{{ optional($d->equipoVisitante)->nombre_equipo ?? 'N/A' }}</td>

                        <td>{{ $d->estado ?? 'N/A' }}</td>

                        <td>
                            <a href="{{ url('/encuentros/editar/' . $d->id_encuentro) }}" 
                               class="btn btn-warning btn-sm">Editar</a>

                            <form action="{{ url('/encuentros/eliminar/' . $d->id_encuentro) }}" 
                                  method="POST" 
                                  style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Seguro desea eliminar este encuentro?')">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>
</div>

@endsection