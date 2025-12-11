<?php $__env->startSection('title', 'Jugadores'); ?>
<?php $__env->startSection('content'); ?>

<div class="container-sm d-flex justify-content-center mt-5">
    <div class="card" style="width: 1200px;">
        <div class="card-body">
            <h3>Módulo jugadores</h3>
            <hr>

            <form action="<?php echo e(url('/jugadores')); ?>" method="GET">
                <div class="text-end mb-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarModal">
                        <i class="fa-solid fa-plus"></i> Nuevo
                    </button>
                </div>

                <div class="row g-2 align-items-center">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" name="search" value="<?php echo e(request('search')); ?>" placeholder="Buscar por jugadores">
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <button type="submit" class="btn btn-info"><i class="fas fa-search-plus"></i> Buscar</button>
                        <a href="<?php echo e(url('/jugadores')); ?>" class="btn btn-warning"><i class="fas fa-list"></i> Reset</a>
                    </div>
                </div>
            </form>

            <?php if($datos->count() > 0): ?>
                <table class="table table-striped table-hover table-bordered">
                    <thead class="table-primary">
                    <tr>
                        <th>Identificación del jugador</th>
                        <th>Nombre del jugador</th>
                        <th>Equipo</th>
                        <th>Posicion</th>
                        <th>Número de camiseta</th>
                        <th>Estado</th>
                         <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $datos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($item->id_jugador); ?></td> 
                            <td><?php echo e($item->nombre_jugador); ?></td>
                            <td><?php echo e($item->equipo_nombre); ?></td>
                            <td><?php echo e($item->posicion); ?></td>
                            <td><?php echo e($item->numero_camiseta); ?></td>
                            <td><?php echo e($item->estado); ?></td>
                            <td>
                                <!-- BOTÓN EDITAR -->
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editarModal<?php echo e($item->id_jugador); ?>">
                                    <i class="fa-solid fa-pen-to-square"></i> Editar
                                </button>

                                <!-- BOTÓN ELIMINAR -->
                                <form action="<?php echo e(route('jugadores.destroy', $item->id_jugador)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este jugador?')">
                                        <i class="fa-solid fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- MODAL EDITAR -->
                        <div class="modal fade" id="editarModal<?php echo e($item->id_jugador); ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="<?php echo e(route('jugadores.update', $item->id_jugador)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <div class="modal-header">
                                            <h5 class="modal-title"><i class="fa-solid fa-pen-to-square"></i> Editar jugador</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            
                                            
                                            <div class="mb-3">
                                                <label for="nombre_jugador" class="form-label">Nombre del jugador:</label>
                                                <input type="text" class="form-control" name="nombre_jugador" value="<?php echo e($item->nombre_jugador); ?>" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="id_equipo" class="form-label">Equipo:</label>
                                                <select class="form-select" name="id_equipo" required>
                                                    <?php $__currentLoopData = $equipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($equipo->id_equipo); ?>"
                                                            <?php echo e($equipo->id_equipo == $item->id_equipo ? 'selected' : ''); ?>>
                                                            
                                                            <?php echo e($equipo->nombre_equipo); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="posicion" class="form-label">Posición</label>
                                                <input type="text" class="form-control" name="posicion" value="<?php echo e($item->posicion); ?>" required>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="numero_camiseta" class="form-label">Número de camiseta</label>
                                                <input type="number" class="form-control" name="numero_camiseta" value="<?php echo e($item->numero_camiseta); ?>" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="estado" class="form-label">Estado</label>
                                                <select class="form-select" name="estado" required>
                                                <option value="activo" <?php echo e($item->estado == 'activo' ? 'selected' : ''); ?>>Activo</option>
                                                <option value="lesionado" <?php echo e($item->estado == 'lesionado' ? 'selected' : ''); ?>>Lesionado</option>
                                                <option value="suspendido" <?php echo e($item->estado == 'suspendido' ? 'selected' : ''); ?>>Suspendido</option>
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
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    <?php echo e($datos->links()); ?>

                </div>
            <?php else: ?>
                <p class="text-center mt-3">No se encontraron jugadores.</p>
            <?php endif; ?>
        </div>

        <!-- MODAL AGREGAR -->
        <div class="modal fade" id="agregarModal" tabindex="-1" aria-labelledby="agregarModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="<?php echo e(route('jugadores.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="fa-solid fa-user"></i> Crear jugador</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="id_jugador" class="form-label">Identificación del jugador</label>
                                <input type="number" class="form-control" id="id_jugador "name="id_jugador" placeholder="Digite el número de identificación del jugador." required>
                            </div>

                            <div class="mb-3">
                                <label for="nombre_jugador" class="form-label">Nombre del jugador</label>
                                <input type="text" class="form-control" id="nombre_jugador "name="nombre_jugador" placeholder="Escriba el nombre del jugador." required>
                            </div>


                            <div class="mb-3">
                                <label for="id_equipo" class="form-label">Equipo:</label>
                                <select class="form-select" name="id_equipo" required>
                                    <option value="" hidden disable selected>Seleccione un equipo</option>
                                    <?php $__currentLoopData = $equipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($equipo->id_equipo); ?>"><?php echo e($equipo->nombre_equipo); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>


                            <div class="mb-3">
                                <label for="posicion" class="form-label">Posicion</label>
                                <input type="text" class="form-control" id="posicion" name="posicion" placeholder="Digite el nombre de la posicion." required>
                            </div>

                            <div class="mb-3">
                                <label for="numero_camiseta" class="form-label">Número de camiseta</label>
                                <input type="number" class="form-control" id="numero_camiseta" name="numero_camiseta" placeholder="Digite el número de camiseta del jugador." required>
                            </div>

                            <div class="mb-3">
                                <label for="estado" class="form-label">Estado</label>
                                <select class="form-select" name="estado" aria-label="Default select example">
                                <option value="activo">Activo</option>
                                <option value="lesionado">Lesionado</option>
                                <option value="suspendido">Suspendido</option> 
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('welcome', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelPlayMatch\resources\views/jugadores.blade.php ENDPATH**/ ?>