@extends('welcome')

@section('title', 'Equipos')
@section('content')

<div class="container-sm d-flex justify-content-center mt-5">
    <div class="card" style="width: 1200px;">
        <div class="card-body">
            <h3>Módulo Equipos</h3>
            <hr>

            {{-- BOTÓN NUEVO --}}
            <div class="text-end mb-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarModal">
                    <i class="fa-solid fa-plus"></i> Nuevo
                </button>
            </div>

            {{-- FORMULARIO DE BÚSQUEDA --}}
            <form action="{{ url('/equipos') }}" method="GET">
                <div class="row g-2 align-items-center">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                                   placeholder="Buscar por nombre o ciudad">
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <button type="submit" class="btn btn-info">
                            <i class="fas fa-search-plus"></i> Buscar
                        </button>
                        <a href="{{ url('/equipos') }}" class="btn btn-warning">
                            <i class="fas fa-list"></i> Reset
                        </a>
                    </div>
                </div>
            </form>

            {{-- TABLA --}}
            @if($datos->count() > 0)
                <table class="table table-striped table-hover table-bordered mt-3">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>ID</th>
                            <th>Equipo</th>
                            <th>Ciudad</th>
                            <th>Categoría</th>
                            <th>Escudo</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle text-center">
                        @foreach ($datos as $item)
                            <tr>
                                <td>{{ $item->id_equipo }}</td>
                                <td>{{ $item->nombre_equipo }}</td>
                                <td>{{ $item->ciudad }}</td>
                                <td>{{ $item->id_categoria }}</td>

                                <td>
                                    @if($item->escudo_url)
                                        <img src="{{ $item->escudo_url }}" width="50" height="50"
                                             class="rounded border" style="object-fit:cover;">
                                    @else
                                        <span class="text-muted">Sin imagen</span>
                                    @endif
                                </td>

                                <td>{{ $item->estado }}</td>

                                <td>

                                    {{-- EDITAR --}}
                                    <button type="button" class="btn btn-success btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editarModal{{ $item->id_equipo }}">
                                        <i class="fa-solid fa-pen-to-square"></i> Editar
                                    </button>

                                    {{-- ELIMINAR --}}
                                    <form action="{{ route('equipos.destroy', $item->id_equipo) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Deseas eliminar este equipo?')">
                                            <i class="fa-solid fa-trash"></i> Eliminar
                                        </button>
                                    </form>

                                </td>
                            </tr>

                            {{-- MODAL EDITAR --}}
                            <div class="modal fade" id="editarModal{{ $item->id_equipo }}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form action="{{ route('equipos.update', $item->id_equipo) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="modal-header">
                                                <h5 class="modal-title">
                                                    <i class="fa-solid fa-pen-to-square"></i> Editar Equipo
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Nombre del equipo</label>
                                                    <input type="text" class="form-control" name="nombre_equipo"
                                                           value="{{ $item->nombre_equipo }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Ciudad</label>
                                                    <input type="text" class="form-control" name="ciudad"
                                                           value="{{ $item->ciudad }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Categoría (ID)</label>
                                                    <input type="number" class="form-control" name="id_categoria"
                                                           value="{{ $item->id_categoria }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">URL del escudo</label>
                                                    <input type="text" class="form-control" name="escudo_url"
                                                           value="{{ $item->escudo_url }}">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Estado</label>
                                                    <input type="text" class="form-control" name="estado"
                                                           value="{{ $item->estado }}">
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa-solid fa-floppy-disk"></i> Guardar cambios
                                                </button>
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
                <p class="text-center mt-3">No se encontraron equipos.</p>
            @endif
        </div>

        {{-- MODAL AGREGAR --}}
        <div class="modal fade" id="agregarModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <form action="{{ route('equipos.store') }}" method="POST">
                        @csrf

                        <div class="modal-header">
                            <h5 class="modal-title">
                                <i class="fa-solid fa-futbol"></i> Crear Equipo
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">

                            <div class="mb-3">
                                <label class="form-label">Nombre del equipo</label>
                                <input type="text" class="form-control" name="nombre_equipo"
                                       placeholder="Digite el nombre del equipo" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Ciudad</label>
                                <input type="text" class="form-control" name="ciudad"
                                       placeholder="Digite la ciudad" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Categoría (ID)</label>
                                <input type="number" class="form-control" name="id_categoria"
                                       placeholder="ID categoría" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">URL del escudo</label>
                                <input type="text" class="form-control" name="escudo_url"
                                       placeholder="Pegue la URL del escudo">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Estado</label>
                                <input type="text" class="form-control" name="estado"
                                       placeholder="Activo / Inactivo">
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-floppy-disk"></i> Guardar
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
