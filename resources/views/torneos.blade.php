@extends('welcome')

@section('title', 'Torneos')
@section('content')

<div class="container-sm d-flex justify-content-center mt-5">
    <div class="card" style="width: 1200px;">
        <div class="card-body">
            <h3>Módulo torneos</h3>
            <hr>

            <form action="{{ url('/torneos') }}" method="GET">
                <div class="text-end mb-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarModal">
                        <i class="fa-solid fa-plus"></i> Nuevo
                    </button>
                </div>

                <div class="row g-2 align-items-center">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
<<<<<<< Updated upstream
<<<<<<< Updated upstream
                            <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Buscar por torneos">
=======
                            <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Buscar por torneo o ciudad">
>>>>>>> Stashed changes
=======
                            <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Buscar por torneo o ciudad">
>>>>>>> Stashed changes
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <button type="submit" class="btn btn-info"><i class="fas fa-search-plus"></i> Buscar</button>
                        <a href="{{ url('/torneos') }}" class="btn btn-warning"><i class="fas fa-list"></i> Reset</a>
                    </div>
                </div>
            </form>

            @if($datos->count() > 0)
                <table class="table table-striped table-hover table-bordered">
                    <thead class="table-primary">
                    <tr>
                        <th>Identificación del torneo</th>
                        <th>Nombre del torneo</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha de fin</th>
                        <th>Ciudad</th>
                        <th>Nombre categoría</th>
                        <th>Nombre de usuario</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($datos as $item)
                        <tr>
                            <td>{{ $item->id_torneo }}</td> 
                            <td>{{ $item->nombre_torneo }}</td>
                            <td>{{ $item->fecha_inicio }}</td>
                            <td>{{ $item->fecha_fin }}</td>
                            <td>{{ $item->ciudad }}</td>
<<<<<<< Updated upstream
                            <td>{{ $item->categoria_nombre }}</td>
                            <td>{{ $item->nombre_usuario }} {{ $item->apellido_usuario }}</td>
                            <td>{{ $item->estado }}</td>
=======
                            <td>{{ $item->nombre_categoria ?? 'Sin categoría' }}</td>
                            <td>{{ $item->usuario_nombre_completo ?? 'Usuario no encontrado' }}</td>
                            <td>
                                <span class="estado 
                                    {{ $item->estado == 'planificado' ? 'bg-secondary' :
                                    ($item->estado == 'en_curso' ? 'bg-info' :
                                    ($item->estado == 'finalizado' ? 'bg-success' : 'bg-danger')) }}">
                                    
                                    {{ ucfirst(str_replace('_', ' ', $item->estado)) }}
                                </span>
                            </td>
                            <td>{{ $item->max_equipos }}</td>
                            <td>{{ $item->tipo_torneo}}</td>

>>>>>>> Stashed changes
                            <td>
                                <!-- BOTÓN EDITAR -->
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editarModal{{ $item->id_torneo }}">
                                    <i class="fa-solid fa-pen-to-square"></i> Editar
                                </button>

                                <!-- BOTÓN ELIMINAR -->
                                <form action="{{ route('torneos.destroy', $item->id_torneo) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este torneo?')">
                                        <i class="fa-solid fa-trash"></i> Eliminar
                                    </button>
                                </form>
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
                                            <h5 class="modal-title"><i class="fa-solid fa-pen-to-square"></i> Editar torneos</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            
                                            <div class="mb-3">
                                                <label for="nombre_torneo" class="form-label">Nombre del torneo:</label>
                                                <input type="text" class="form-control" name="nombre_torneo" value="{{ $item->nombre_torneo }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="fecha_inicio" class="form-label">Fecha de inicio:</label>
                                                <input type="date" class="form-control" name="fecha_inicio" value="{{ $item->fecha_inicio }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="fecha_fin" class="form-label">Fecha de finalización:</label>
                                                <input type="date" class="form-control" name="fecha_fin" value="{{ $item->fecha_fin }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="ciudad" class="form-label">Ciudad:</label>
                                                <input type="text" class="form-control" name="ciudad" value="{{ $item->ciudad }}" required>
                                            </div>

                                            <div class="mb-3">
<<<<<<< Updated upstream
                                                <label for="id_categoria" class="form-label">Nombre de la categoría:</label>
                                                <select class="form-select" name="id_categoria" required>
                                                    @foreach($categorias as $categoria)
                                                        <option value="{{ $categoria->id_categoria }}"
                                                            {{ $categoria->id_categoria == $item->id_categoria ? 'selected' : '' }}>
                                                            
                                                            {{ $categoria->nombre_categoria }}
                                                        </option>
                                                    @endforeach
=======
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
                                                    <option value="planificado" {{ $item->estado == 'planificado' ? 'selected' : '' }}>Planificado</option>
                                                    <option value="en_curso" {{ $item->estado == 'en_curso' ? 'selected' : '' }}>En curso</option>
                                                    <option value="finalizado" {{ $item->estado == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
                                                    <option value="cancelado" {{ $item->estado == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="id_usuario" class="form-label">Nombre del usuario:</label>
                                                <select class="form-select" name="id_usuario" required>
                                                    @foreach($usuarios as $usuario)
                                                        <option value="{{ $usuario->id_usuario }}"
                                                            {{ $usuario->id_usuario == $item->id_usuario ? 'selected' : '' }}>
                                                            
                                                            {{ $usuario->nombre }} {{ $usuario->apellido }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="estado" class="form-label">Estado</label>
                                                <select class="form-select" name="estado" required>
                                                <option value="planificado" {{ $item->estado == 'planificado' ? 'selected' : '' }}>Planificado</option>
                                                <option value="en_curso" {{ $item->estado == 'en_curso' ? 'selected' : '' }}>En curso</option>
                                                <option value="finalizado" {{ $item->estado == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
                                                <option value="cancelado" {{ $item->estado == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
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
                <div class="d-flex justify-content-end">
                    {{ $datos->links() }}
                </div>
            @else
                <p class="text-center mt-3">No se encontraron torneos.</p>
            @endif
        </div>

        <!-- MODAL AGREGAR -->
        <div class="modal fade" id="agregarModal" tabindex="-1" aria-labelledby="agregarModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{ route('torneos.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="fa-solid fa-user"></i> Crear torneo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="id_torneo" class="form-label">Identificación del torneo</label>
                                <input type="number" class="form-control" id="id_torneo "name="id_torneo" placeholder="Digite el número de identificación del torneo." required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="nombre_torneo" class="form-label">Nombre del torneo:</label>
                                <input type="text" class="form-control" id="nombre_torneo" name="nombre_torneo" placeholder="Digite el nombre del torneo." required>
                            </div>

                            <div class="mb-3">
                                <label for="fecha_inicio" class="form-label">Fecha de inicio:</label>
                                <input 
                                    type="date" 
                                    class="form-control" 
                                    name="fecha_inicio" 
                                    value=""
                                    required
                                >
                            </div>

                            <div class="mb-3">
                                <label for="fecha_fin" class="form-label">Fecha de finalización:</label>
                                <input 
                                    type="date" 
                                    class="form-control" 
                                    name="fecha_fin" 
                                    value=""
                                    required
                                >
                            </div>

                            <div class="mb-3">
                                <label for="ciudad" class="form-label">Nombre de la ciudad:</label>
                                <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Digite el nombre de la ciudad." required>
                            </div>

                            <div class="mb-3">
<<<<<<< Updated upstream
                                <label for="id_categoria" class="form-label">Categoría:</label>
                                <select class="form-select" name="id_categoria" required>
                                    <option value="" hidden disable selected>Seleccione una categoria:</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id_categoria }}">{{ $categoria->nombre_categoria }}</option>
                                    @endforeach
=======
                                <label class="form-label">Ciudad</label>
                                <input type="text" class="form-control" name="ciudad" required>
                            </div>
                            <div class="mb-3">
                                <label>Categoría</label>
                                <select name="id_categoria" class="form-select" required>
                                    <option disabled selected>Seleccione una categoría</option>
                                    @foreach($categorias as $cat)
                                        <option value="{{ $cat->id_categoria }}">{{ $cat->nombre_categoria }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Usuario</label>
                                <select name="id_usuario" class="form-select" required>
                                    <option disabled selected>Seleccione un Usuario</option>
                                    @foreach($usuarios as $user)
                                        <option value="{{ $user->id_usuario }}">{{ $user->nombre }} {{ $user->apellido }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Estado</label>
                                <select class="form-control" name="estado" required>
                                    <option value="planificado">Planificado</option>
                                    <option value="en_curso">En curso</option>
                                    <option value="finalizado">Finalizado</option>
                                    <option value="cancelado">Cancelado</option>
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
                                </select>
                            </div>


                            <div class="mb-3">
                                <label for="id_usuario" class="form-label">Usuario:</label>
                                <select class="form-select" name="id_usuario" required>
                                    <option value="" hidden disable selected>Seleccione un usuario:</option>
                                    @foreach($usuarios as $usuario)
                                        <option value="{{ $usuario->id_usuario }}">{{ $usuario->nombre }} {{ $usuario->apellido }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="estado" class="form-label">Estado:</label>
                                <select class="form-select" name="estado" aria-label="Default select example">
                                <option value="" hidden disable selected>Seleccione un estado:</option>
                                <option value="planificado">Planificado</option>
                                <option value="en_curso">En curso</option>
                                <option value="finalizado">Finalizado</option> 
                                <option value="cancelado">Cancelado</option> 
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
    </container>

@endsection

