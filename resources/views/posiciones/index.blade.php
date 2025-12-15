@extends('dashboard')

@section('title', 'Posiciones')
@section('content')

<div class="container-sm d-flex justify-content-center mt-5">
    <div class="card" style="width: 1200px;">
        <div class="card-body">
            <h3>Módulo posiciones</h3>
            <hr>

            <!-- Búsqueda -->
            <form action="{{ url('/posiciones') }}" method="GET">
                <div class="row g-2 align-items-center mb-3">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" name="search" class="form-control" placeholder="Buscar por equipo o torneo" value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <button type="submit" class="btn btn-info"><i class="fas fa-search-plus"></i> Buscar</button>
                        <a href="{{ url('/posiciones') }}" class="btn btn-warning"><i class="fas fa-list"></i> Reset</a>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarModal"><i class="fa-solid fa-plus"></i> Nuevo</button>
                    </div>
                </div>
            </form>

            @if($datos->count() > 0)
                <table class="table table-striped table-hover table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>Torneo</th>
                            <th>Equipo</th>
                            <th>PJ</th>
                            <th>PG</th>
                            <th>PE</th>
                            <th>PP</th>
                            <th>GF</th>
                            <th>GC</th>
                            <th>GD</th>
                            <th>Puntos</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datos as $item)
                        <tr>
                            <td>{{ $item->id_posicion }}</td>
                            <td>{{ $item->nombre_torneo }}</td>
                            <td>{{ $item->nombre_equipo }}</td>
                            <td>{{ $item->pj }}</td>
                            <td>{{ $item->pg }}</td>
                            <td>{{ $item->pe }}</td>
                            <td>{{ $item->pp }}</td>
                            <td>{{ $item->gf }}</td>
                            <td>{{ $item->gc }}</td>
                            <td>{{ $item->gd }}</td>
                            <td>{{ $item->puntos }}</td>
                            <td>
                                <!-- Editar -->
                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editarModal{{ $item->id_posicion }}"><i class="fa-solid fa-pen-to-square"></i></button>
                                <!-- Eliminar -->
                                <form action="{{ route('posiciones.destroy', $item->id_posicion) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar?')"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Editar -->
                        <div class="modal fade" id="editarModal{{ $item->id_posicion }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('posiciones.update', $item->id_posicion) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Editar Posición</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="text" name="nombre_torneo" class="form-control mb-2" value="{{ $item->nombre_torneo }}" placeholder="Torneo">
                                            <input type="text" name="nombre_equipo" class="form-control mb-2" value="{{ $item->nombre_equipo }}" placeholder="Equipo">
                                            <input type="number" name="pj" class="form-control mb-2" value="{{ $item->pj }}" placeholder="PJ">
                                            <input type="number" name="pg" class="form-control mb-2" value="{{ $item->pg }}" placeholder="PG">
                                            <input type="number" name="pe" class="form-control mb-2" value="{{ $item->pe }}" placeholder="PE">
                                            <input type="number" name="pp" class="form-control mb-2" value="{{ $item->pp }}" placeholder="PP">
                                            <input type="number" name="gf" class="form-control mb-2" value="{{ $item->gf }}" placeholder="GF">
                                            <input type="number" name="gc" class="form-control mb-2" value="{{ $item->gc }}" placeholder="GC">
                                            <input type="number" name="gd" class="form-control mb-2" value="{{ $item->gd }}" placeholder="GD">
                                            <input type="number" name="puntos" class="form-control mb-2" value="{{ $item->puntos }}" placeholder="Puntos">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </tbody>
                </table>

                {{ $datos->links() }}

            @else
                <p class="text-center mt-3">No se encontró ninguna posición.</p>
            @endif

        </div>
    </div>
</div>

<!-- Modal Agregar -->
<div class="modal fade" id="agregarModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('posiciones.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Nueva Posición</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="nombre_torneo" class="form-control mb-2" placeholder="Torneo" required>
                    <input type="text" name="nombre_equipo" class="form-control mb-2" placeholder="Equipo" required>
                    <input type="number" name="pj" class="form-control mb-2" placeholder="PJ">
                    <input type="number" name="pg" class="form-control mb-2" placeholder="PG">
                    <input type="number" name="pe" class="form-control mb-2" placeholder="PE">
                    <input type="number" name="pp" class="form-control mb-2" placeholder="PP">
                    <input type="number" name="gf" class="form-control mb-2" placeholder="GF">
                    <input type="number" name="gc" class="form-control mb-2" placeholder="GC">
                    <input type="number" name="gd" class="form-control mb-2" placeholder="GD">
                    <input type="number" name="puntos" class="form-control mb-2" placeholder="Puntos">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
