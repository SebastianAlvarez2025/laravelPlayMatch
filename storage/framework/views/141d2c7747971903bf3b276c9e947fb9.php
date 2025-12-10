<?php $__env->startSection('title', 'Torneos'); ?>
<?php $__env->startSection('content'); ?>

<div class="container-sm d-flex justify-content-center mt-5">
    <div class="card" style="width: 1200px;">
        <div class="card-body">
            <h3>Módulo Torneos</h3>
            <hr>

            <form action="<?php echo e(url('/torneos')); ?>" method="GET">
                <div class="text-end mb-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarModal">
                        <i class="fa-solid fa-plus"></i> Nuevo Torneo
                    </button>
                </div>

                <div class="row g-2 align-items-center">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" name="search" value="<?php echo e(request('search')); ?>" placeholder="Buscar por torneo o ciudad">
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <button type="submit" class="btn btn-info"><i class="fas fa-search-plus"></i> Buscar</button>
                        <a href="<?php echo e(url('/torneos')); ?>" class="btn btn-warning"><i class="fas fa-list"></i> Reset</a>
                    </div>
                </div>
            </form>

            <?php if($datos->count() > 0): ?>

            <!-- 🔹 Caja fija + scroll interno -->
            <div class="pm-fixed-box">
                <div class="pm-table-container">

                    <table class="table table-striped table-hover table-bordered">
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
                            <th>Max Equipos</th>
                            <th>Tipo Torneo</th>
                            <th>Imagen</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $datos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($item->id_torneo); ?></td>
                                <td><?php echo e($item->nombre_torneo); ?></td>
                                <td><?php echo e(\Carbon\Carbon::parse($item->fecha_inicio)->format('d/m/Y')); ?></td>
                                <td><?php echo e(\Carbon\Carbon::parse($item->fecha_fin)->format('d/m/Y')); ?></td>
                                <td><?php echo e($item->ciudad); ?></td>
                                <td><?php echo e($item->nombre_categoria ?? 'Sin categoría'); ?></td>
                                <td><?php echo e($item->usuario_nombre_completo ?? 'Usuario no encontrado'); ?></td>
                                <td>
                                    <span class="badge
                                        <?php echo e($item->estado == 'planificado' ? 'bg-secondary' :
                                            ($item->estado == 'en_curso' ? 'bg-info' :
                                            ($item->estado == 'finalizado' ? 'bg-success' :
                                            ($item->estado == 'cancelado' ? 'bg-danger' : 'bg-dark')))); ?>">
                                        <?php echo e(ucfirst(str_replace('_', ' ', $item->estado))); ?>

                                    </span>
                                </td>
                                <td><?php echo e($item->max_equipos); ?></td>
                                <td><?php echo e($item->tipo_torneo); ?></td>
                                <td><?php echo e($item->imagen); ?></td>

                                <td>
                                    <!-- BOTÓN EDITAR -->
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editarModal<?php echo e($item->id_torneo); ?>">
                                        <i class="fa-solid fa-pen-to-square"></i> Editar
                                    </button>

                                    <!-- BOTÓN ELIMINAR -->
                                    <form action="<?php echo e(route('torneos.destroy', $item->id_torneo)); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este torneo?')">
                                            <i class="fa-solid fa-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- MODAL EDITAR -->
                            <div class="modal fade" id="editarModal<?php echo e($item->id_torneo); ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form action="<?php echo e(route('torneos.update', $item->id_torneo)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>
                                            <div class="modal-header">
                                                <h5 class="modal-title"><i class="fa-solid fa-pen-to-square"></i> Editar torneo</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Nombre de Torneo</label>
                                                    <input type="text" class="form-control" name="nombre_torneo" value="<?php echo e($item->nombre_torneo); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Fecha de Inicio</label>
                                                    <input type="date" class="form-control" name="fecha_inicio" value="<?php echo e($item->fecha_inicio); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Fecha de Finalización</label>
                                                    <input type="date" class="form-control" name="fecha_fin" value="<?php echo e($item->fecha_fin); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Ciudad</label>
                                                    <input type="text" class="form-control" name="ciudad" value="<?php echo e($item->ciudad); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Categoría</label>
                                                    <select name="id_categoria" class="form-select" required>
                                                        <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($user->id_categoria); ?>" <?php echo e($user->id_categoria == $item->id_categoria ? 'selected' : ''); ?>>
                                                                <?php echo e($user->nombre_categoria); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Usuarios</label>
                                                    <select name="id_usuario" class="form-select" required>
                                                        <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($user->id_usuario); ?>" <?php echo e($user->id_usuario == $item->id_usuario ? 'selected' : ''); ?>>
                                                                <?php echo e($user->nombre); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Estado</label>
                                                    <select class="form-control" name="estado" required>
                                                        <option value="planificado" <?php echo e($item->estado == 'planificado' ? 'selected' : ''); ?>>Planificado</option>
                                                        <option value="en_curso" <?php echo e($item->estado == 'en_curso' ? 'selected' : ''); ?>>En curso</option>
                                                        <option value="finalizado" <?php echo e($item->estado == 'Finalizado' ? 'selected' : ''); ?>>Finalizado</option>
                                                        <option value="cancelado" <?php echo e($item->estado == 'cancelado' ? 'selected' : ''); ?>>Cancelado</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Max Equipos</label>
                                                    <input type="text" class="form-control" name="max_equipos" value="<?php echo e($item->max_equipos); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Tipo de torneo</label>
                                                    <input type="text" class="form-control" name="tipo_torneo" value="<?php echo e($item->tipo_torneo); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Imagen</label>
                                                    <input type="text" class="form-control" name="imagen" value="<?php echo e($item->imagen); ?>" >
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

                </div> <!-- pm-table-container -->
            </div> <!-- pm-fixed-box -->

            <div class="d-flex justify-content-end">
                <?php echo e($datos->links()); ?>

            </div>

            <?php else: ?>
                <p class="text-center mt-3">No se encontraron Torneos.</p>
            <?php endif; ?>
        </div>

        <!-- MODAL AGREGAR -->
        <div class="modal fade" id="agregarModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="<?php echo e(route('torneos.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <div class="modal-header">
                            <h5 class="modal-title"><i class="fa-solid fa-plus"></i> Crear torneo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
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
                                <label>Categoría</label>
                                <select name="id_categoria" class="form-select" required>
                                    <option disabled selected>Seleccione una categoría</option>
                                    <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($user->id_categoria); ?>"><?php echo e($user->nombre_categoria); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Usuarios</label>
                                <select name="id_usuario" class="form-select" required>
                                    <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($user->id_usuario); ?>"><?php echo e($user->nombre); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Estado</label>
                                <select class="form-control" name="estado" required>
                                    <option value="planificado">Planificado</option>
                                    <option value="en_curso">En curso</option>
                                    <option value="finalizado">Finalizado</option>
                                    <option value="cancelado">Cancelado</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Max equipos</label>
                                <input type="text" class="form-control" name="max_equipos" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tipo torneo</label>
                                <input type="text" class="form-control" name="tipo_torneo" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Imagen</label>
                                <input type="text" class="form-control" name="imagen">
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelPlayMatch\resources\views/torneos.blade.php ENDPATH**/ ?>