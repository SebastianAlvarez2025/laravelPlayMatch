@extends('welcome')

@section('title', 'Torneos')
@section('content')
<div class="container-sm d-flex justify-content-center mt-5">
    <div class="card" style="width: 1200px;">
        <div class="card-body">
            <h3>Módulo Torneos</h3>
            <hr>

            <!-- BOTÓN NUEVO -->
            <form action="{{ url('/torneos') }}" method="GET">
                <div class="text-end mb-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarModal">
                        <i class="fa-solid fa-plus"></i> Nuevo Torneo
                    </button>
                </div>

                <!-- BUSCADOR -->
                <div class="row g-2 align-items-center">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Buscar por nombre, categoría, usuario o ciudad">
                        </div>
                    </div>

                    <div class="col-md-6 text-end">
                        <button type="submit" class="btn btn-info"><i class="fas fa-search-plus"></i> Buscar</button>
                        <a href="{{ url('/torneos') }}" class="btn btn-warning"><i class="fas fa-list"></i> Reset</a>
                    </div>
                </div>
            </form>

            <!-- TABLA -->
            @if($datos->count() > 0)
                <table class="table table-striped table-hover table-bordered text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>Nombre de Torneo</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th>Ciudad</th>
                            <th>Categoría</th>
                            <th>Usuario</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach ($datos as $item)
                        <tr>
                            <td>{{ $item->id_torneo }}</td>
                            <td>{{ $item->nombre_torneo }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->fecha_inicio)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->fecha_fin)->format('d/m/Y') }}</td>
                            <td>{{ $item->ciudad }}</td>
                            <td>{{ $item->nombre_categoria ?? 'Sin categoría' }}</td>
                            <td>{{ $item->usuario_nombre_completo ?? 'Usuario no encontrado' }}</td>
                            <td>
                                <span class="badge {{ $item->estado == 'Activo' ? 'bg-success' : ($item->estado == 'Finalizado' ? 'bg-info' : 'bg-secondary') }}">
                                    {{ $item->estado }}
                                </span>
                            </td>

                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <!-- EDITAR -->
                                    <button type="button" 
                                            class="btn btn-success btn-sm me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editarModal{{ $item->id_torneo }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>

                                    <!-- ELIMINAR -->
                                    <form action="{{ route('torneos.destroy', $item->id_torneo) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Seguro que deseas eliminar este torneo?')">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
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
                                                <label class="form-label">Nombre de Torneo</label>
                                                <input type="text" class="form-control" name="nombre_torneo" value="{{ $item->nombre_torneo }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Fecha de Inicio</label>
                                                <input type="date" class="form-control" name="fecha_inicio" value="{{ $item->fecha_inicio }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Fecha de Finalización</label>
                                                <input type="date" class="form-control" name="fecha_fin" value="{{ $item->fecha_fin }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Ciudad</label>
                                                <input type="text" class="form-control" name="ciudad" value="{{ $item->ciudad }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Categoría</label>
                                                <input type="number" class="form-control" name="id_categoria" value="{{ $item->id_categoria }}" required>
                                                <small class="text-muted">ID actual: {{ $item->id_categoria }} - {{ $item->nombre_categoria }}</small>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Usuario</label>
                                                <input type="number" class="form-control" name="id_usuario" value="{{ $item->id_usuario }}" required>
                                                <small class="text-muted">ID actual: {{ $item->id_usuario }} - {{ $item->usuario_nombre_completo }}</small>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Estado</label>
                                                <select class="form-control" name="estado" required>
                                                    <option value="Activo" {{ $item->estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                                                    <option value="Inactivo" {{ $item->estado == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                                                    <option value="Finalizado" {{ $item->estado == 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
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

                <!-- PAGINACIÓN -->
                <div class="d-flex justify-content-center mt-3">
                    {{ $datos->links() }}
                </div>

            @else
                <p class="text-center mt-3">No se encontraron Torneos.</p>
            @endif
        </div>

        <!-- MODAL AGREGAR -->
        <div class="modal fade" id="agregarModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{ route('torneos.store') }}" method="POST">
                        @csrf

                        <div class="modal-header">
                            <h5 class="modal-title"><i class="fa-solid fa-trophy"></i> Crear Torneo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">ID Torneo</label>
                                <input type="text" class="form-control" name="id_torneo" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nombre de Torneo</label>
                                <input type="text" class="form-control" name="nombre_torneo" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Fecha de Inicio</label>
                                <input type="date" class="form-control" name="fecha_inicio" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Fecha de Finalización</label>
                                <input type="date" class="form-control" name="fecha_fin" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Ciudad</label>
                                <input type="text" class="form-control" name="ciudad" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">ID Categoría</label>
                                <input type="number" class="form-control" name="id_categoria" required>
                                <small class="text-muted">Ingresa el ID de la categoría</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">ID Usuario</label>
                                <input type="number" class="form-control" name="id_usuario" required>
                                <small class="text-muted">Ingresa el ID del usuario</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Estado</label>
                                <select class="form-control" name="estado" required>
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                    <option value="Finalizado">Finalizado</option>
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

@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                confirmButtonText: 'Aceptar'
            });
        });
    </script>
@endif

@endsection