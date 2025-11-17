@extends('welcome')

@section('title', 'tipo_falta')
@section('content')
<div class="container-sm d-flex justify-content-center mt-5">
    <div class="card" style="width: 1200px;">
        <div class="card-body">
            <h3>Módulo Tipo de Faltas</h3>
            <hr>

            <form action="{{ url('/tipo_falta') }}" method="GET">
                <div class="text-end mb-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarModal">
                        <i class="fa-solid fa-plus"></i> Nuevo
                    </button>
                </div>

                <div class="row g-2 align-items-center">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Buscar por Id, Nombre o Gravedad ">
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <button type="submit" class="btn btn-info"><i class="fas fa-search-plus"></i> Buscar</button>
                        <a href="{{ url('/tipo_falta') }}" class="btn btn-warning"><i class="fas fa-list"></i> Reset</a>
                    </div>
                </div>
            </form>

            @if($datos->count() > 0)
                <table class="table table-striped table-hover table-bordered">
                    <thead class="table-primary">
                    <tr>
                        <th scope="col">Id de Falta</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Gravedad</th>
                            <th scope="col">Sancion Base</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($datos as $item)
                        <tr>
                            <td>{{$item->id_tipo_falta }}</td>
                                <td>{{$item->nombre}}</td>
                                <td>{{$item->gravedad}}</td>
                                <td>{{$item->sancion_base}}</td>
                            <td>
                                <!-- BOTÓN EDITAR -->
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editarModal{{ $item->id_tipo_falta }}">
                                    <i class="fa-solid fa-pen-to-square"></i> Editar
                                </button>

                                <!-- BOTÓN ELIMINAR -->
                                <form action="{{ route('tipo_falta.destroy', $item->id_tipo_falta) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Seguro que deseas eliminar la falta ?')">
                                        <i class="fa-solid fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- MODAL EDITAR -->
                        <div class="modal fade" id="editarModal{{ $item->id_tipo_falta }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="{{ route('tipo_falta.update', $item->id_tipo_falta) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title"><i class="fa-solid fa-pen-to-square"></i> Editar Falta</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="nombre" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" name="nombre" value="{{ $item->nombre }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="gravedad" class="form-label">Gravedad</label>
                                                <input type="text" class="form-control" name="gravedad" value="{{ $item->gravedad }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="sancion_base" class="form-label">Sancion Base</label>
                                                <input type="number" class="form-control" name="sancion_base" value="{{ $item->sancion_base }}" required>
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
                <p class="text-center mt-3">No se encontro Falta.</p>
            @endif
        </div>

        <!-- MODAL AGREGAR -->
        <div class="modal fade" id="agregarModal" tabindex="-1" aria-labelledby="agregarModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{ route('tipo_falta.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="fa-solid fa-user"></i> Crear Falta</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="id_tipo_falta" class="form-label">Id Tipo de Falta</label>
                                <input type="text" class="form-control" name="id_tipo_falta" placeholder="Ingrese el ID del tipo de Falta" required>
                            </div>
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombre" placeholder="Ingrese el nombre del tipo de falta" required>
                            </div>
                            <div class="mb-3">
                                <label for="gravedad" class="form-label">Gravedado</label>
                                <input type="text" class="form-control" name="gravedad" placeholder="Ingrese gravedad de la falta" required>
                            </div>
                            <div class="mb-3">
                                <label for="sancion_base" class="form-label">Sancion Base</label>
                                <input type="number" class="form-control" name="sancion_base" placeholder="Ingrese sancion base" required>
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