<?php $__env->startSection('title', 'Inscripciones'); ?>
<?php $__env->startSection('content'); ?>
<div class="container-sm d-flex justify-content-center mt-5">
    <div class="card" style="width: 1200px;">
        <div class="card-body">
            <h3>Módulo Inscripciones</h3>
            <hr>

            <!-- BOTÓN NUEVO -->
            <div class="text-end mb-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarModal">
                    <i class="fa-solid fa-plus"></i> Nueva Inscripción
                </button>
            </div>

            <!-- BUSCADOR -->
            <form action="<?php echo e(route('inscripciones.index')); ?>" method="GET">
                <div class="row g-2 align-items-center">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" name="search" value="<?php echo e(request('search')); ?>" placeholder="Buscar por torneo, usuario o estado">
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <button type="submit" class="btn btn-info"><i class="fas fa-search-plus"></i> Buscar</button>
                        <a href="<?php echo e(route('inscripciones.index')); ?>" class="btn btn-warning"><i class="fas fa-list"></i> Reset</a>
                    </div>
                </div>
            </form>

            <!-- TABLA -->
            <?php if($inscripciones->count() > 0): ?>
                <table class="table table-striped table-hover table-bordered text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Torneo</th>
                            <th>Fecha Inscripción</th>
                            <th>Estado</th>
                            <th>Observaciones</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php $__currentLoopData = $inscripciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inscripcion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($inscripcion->id_inscripcion); ?></td>

                            <!-- USUARIO -->
                            <td>
                                <?php if($inscripcion->usuario): ?>
                                    <?php echo e($inscripcion->usuario->nombre); ?> <?php echo e($inscripcion->usuario->apellido); ?>

                                <?php else: ?>
                                    <span class="text-danger">Usuario no encontrado</span>
                                <?php endif; ?>
                            </td>

                            <!-- TORNEO -->
                            <td>
                                <?php if($inscripcion->torneo): ?>
                                    <?php echo e($inscripcion->torneo->nombre_torneo); ?>

                                <?php else: ?>
                                    <span class="text-danger">Torneo no encontrado</span>
                                <?php endif; ?>
                            </td>

                            <!-- FECHA -->
                            <td><?php echo e(\Carbon\Carbon::parse($inscripcion->fecha_inscripcion)->format('d/m/Y')); ?></td>

                            <!-- ESTADO -->
                            <td>
                                <span class="badge 
                                    <?php if($inscripcion->estado == 'Inscrito'): ?> bg-success
                                    <?php elseif($inscripcion->estado == 'Participando'): ?> bg-primary
                                    <?php elseif($inscripcion->estado == 'Finalizado'): ?> bg-info
                                    <?php else: ?> bg-secondary <?php endif; ?>">
                                    <?php echo e($inscripcion->estado); ?>

                                </span>
                            </td>

                            <!-- OBSERVACIONES -->
                            <td><?php echo e($inscripcion->observaciones ? Str::limit($inscripcion->observaciones, 30) : 'Sin observaciones'); ?></td>

                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <!-- EDITAR -->
                                    <button type="button" class="btn btn-success btn-sm me-1" data-bs-toggle="modal" data-bs-target="#editarModal<?php echo e($inscripcion->id_inscripcion); ?>">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>

                                    <!-- ELIMINAR -->
                                    <form action="<?php echo e(route('inscripciones.destroy', $inscripcion->id_inscripcion)); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar esta inscripción?')">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- MODAL EDITAR -->
                        <div class="modal fade" id="editarModal<?php echo e($inscripcion->id_inscripcion); ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="<?php echo e(route('inscripciones.update', $inscripcion->id_inscripcion)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>

                                        <div class="modal-header">
                                            <h5 class="modal-title"><i class="fa-solid fa-pen-to-square"></i> Editar Inscripción</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="form-label">Usuario</label>
                                                    <input type="text" class="form-control" value="<?php echo e($inscripcion->usuario->nombre ?? ''); ?> <?php echo e($inscripcion->usuario->apellido ?? ''); ?>" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Torneo</label>
                                                    <input type="text" class="form-control" value="<?php echo e($inscripcion->torneo->nombre_torneo ?? ''); ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Fecha Inscripción</label>
                                                    <input type="date" name="fecha_inscripcion" class="form-control" value="<?php echo e($inscripcion->fecha_inscripcion); ?>" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Estado</label>
                                                    <select name="estado" class="form-control">
                                                        <option value="Inscrito"      <?php echo e($inscripcion->estado == 'Inscrito' ? 'selected' : ''); ?>>Inscrito</option>
                                                        <option value="Participando" <?php echo e($inscripcion->estado == 'Participando' ? 'selected' : ''); ?>>Participando</option>
                                                        <option value="Finalizado"   <?php echo e($inscripcion->estado == 'Finalizado' ? 'selected' : ''); ?>>Finalizado</option>
                                                        <option value="Retirado"     <?php echo e($inscripcion->estado == 'Retirado' ? 'selected' : ''); ?>>Retirado</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <label class="form-label">Observaciones</label>
                                                <textarea name="observaciones" class="form-control" rows="3"><?php echo e($inscripcion->observaciones); ?></textarea>
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

                <div class="d-flex justify-content-center mt-3">
                    <?php echo e($inscripciones->links()); ?>

                </div>

            <?php else: ?>
                <p class="text-center mt-3">No se encontraron Inscripciones.</p>
            <?php endif; ?>
        </div>


        <!-- MODAL AGREGAR -->
        <div class="modal fade" id="agregarModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <form action="<?php echo e(route('inscripciones.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <div class="modal-header">
                            <h5 class="modal-title"><i class="fa-solid fa-user-plus"></i> Crear Inscripción</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Usuario *</label>
                                    <select name="id_usuario" class="form-control" required>
                                        <option value="">Seleccione un usuario</option>
                                        <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($usuario->id_usuario); ?>">
                                                <?php echo e($usuario->nombre); ?> <?php echo e($usuario->apellido); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Torneo *</label>
                                    <select name="id_torneo" class="form-control" required>
                                        <option value="">Seleccione un torneo</option>
                                        <?php $__currentLoopData = $torneos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $torneo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($torneo->id_torneo); ?>">
                                                <?php echo e($torneo->nombre_torneo); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label class="form-label">Fecha Inscripción *</label>
                                    <input type="date" name="fecha_inscripcion" class="form-control" value="<?php echo e(date('Y-m-d')); ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Estado *</label>
                                    <select name="estado" class="form-control">
                                        <option value="Inscrito">Inscrito</option>
                                        <option value="Participando">Participando</option>
                                        <option value="Finalizado">Finalizado</option>
                                        <option value="Retirado">Retirado</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mt-3">
                                <label class="form-label">Observaciones</label>
                                <textarea name="observaciones" class="form-control" rows="3"></textarea>
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

<?php echo $__env->make('dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelPlayMatch\resources\views/inscripciones.blade.php ENDPATH**/ ?>