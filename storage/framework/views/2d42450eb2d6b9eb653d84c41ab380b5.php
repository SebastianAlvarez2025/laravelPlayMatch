<?php $__env->startSection('title', 'Encuentros'); ?>
<?php $__env->startSection('content'); ?>

<div class="container-sm d-flex justify-content-center mt-5">
    <div class="card" style="width: 1300px;">
        <div class="card-body">
            <h3>Módulo Encuentros</h3>
            <hr>

            <!-- BOTÓN NUEVO -->
            <div class="text-end mb-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarModal">
                    <i class="fa-solid fa-plus"></i> Nuevo
                </button>
            </div>

            <!-- BUSCAR -->
            <form action="<?php echo e(route('encuentros.index')); ?>" method="GET">
                <div class="row g-2 align-items-center mb-3">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" name="search" value="<?php echo e(request('search')); ?>" placeholder="Buscar por torneo, fecha o equipos">
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <button type="submit" class="btn btn-info"><i class="fas fa-search-plus"></i> Buscar</button>
                        <a href="<?php echo e(route('encuentros.index')); ?>" class="btn btn-warning"><i class="fas fa-list"></i> Reset</a>
                    </div>
                </div>
            </form>

            <!-- TABLA -->
            <?php if($datos->count() > 0): ?>
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-primary">
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
                    <?php $__currentLoopData = $datos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($d->id_encuentro); ?></td>
                        <td><?php echo e(optional($d->fecha)->fecha ?? 'N/A'); ?></td>
                        <td><?php echo e($d->hora); ?></td>
                        <td><?php echo e(optional($d->torneo)->nombre_torneo ?? 'N/A'); ?></td>
                        <td><?php echo e(optional($d->lugar)->nombre_lugar ?? 'N/A'); ?></td>
                        <td><?php echo e($d->arbitro ? $d->arbitro->id_usuario : 'Sin árbitro'); ?></td>
                        <td><?php echo e(optional($d->equipoLocal)->nombre_equipo ?? 'N/A'); ?></td>
                        <td><?php echo e(optional($d->equipoVisitante)->nombre_equipo ?? 'N/A'); ?></td>
                        <td><?php echo e($d->estado); ?></td>
                        <td>
                            <!-- EDITAR -->
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editarModal<?php echo e($d->id_encuentro); ?>">
                                <i class="fa-solid fa-pen-to-square"></i> Editar
                            </button>

                            <!-- ELIMINAR -->
                            <form action="<?php echo e(route('encuentros.destroy', $d->id_encuentro)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro desea eliminar este encuentro?')">
                                    <i class="fa-solid fa-trash"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- MODAL EDITAR -->
                    <div class="modal fade" id="editarModal<?php echo e($d->id_encuentro); ?>" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form action="<?php echo e(route('encuentros.update', $d->id_encuentro)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <div class="modal-header">
                                        <h5 class="modal-title"><i class="fa-solid fa-pen-to-square"></i> Editar Encuentro</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label>Fecha:</label>
                                                <select name="id_fecha" class="form-select" required>
                                                    <?php $__currentLoopData = $fechas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($f->id_fecha); ?>" <?php echo e($f->id_fecha == $d->id_fecha ? 'selected' : ''); ?>><?php echo e($f->fecha); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label>Hora:</label>
                                                <input type="time" name="hora" class="form-control" value="<?php echo e($d->hora); ?>" required>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label>Torneo:</label>
                                                <select name="id_torneo" class="form-select" required>
                                                    <?php $__currentLoopData = $torneos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($t->id_torneo); ?>" <?php echo e($t->id_torneo == $d->id_torneo ? 'selected' : ''); ?>><?php echo e($t->nombre_torneo); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label>Lugar:</label>
                                                <select name="id_lugar" class="form-select" required>
                                                    <?php $__currentLoopData = $lugares; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($l->id_lugar); ?>" <?php echo e($l->id_lugar == $d->id_lugar ? 'selected' : ''); ?>><?php echo e($l->nombre_lugar); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label>Árbitro:</label>
                                                <select name="id_arbitro" class="form-select" required>
                                                    <option value="">Seleccione un árbitro</option>
                                                    <?php $__currentLoopData = $arbitros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($a->id_arbitro); ?>" <?php echo e($a->id_arbitro == $d->id_arbitro ? 'selected' : ''); ?>>
                                                            <?php echo e($a->id_usuario); ?> (<?php echo e($a->categoria_arbitral); ?>)
                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label>Equipo Local:</label>
                                                <select name="id_equipo_local" class="form-select" required>
                                                    <?php $__currentLoopData = $equipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($e->id_equipo); ?>" <?php echo e($e->id_equipo == $d->id_equipo_local ? 'selected' : ''); ?>><?php echo e($e->nombre_equipo); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label>Equipo Visitante:</label>
                                                <select name="id_equipo_visitante" class="form-select" required>
                                                    <?php $__currentLoopData = $equipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($e->id_equipo); ?>" <?php echo e($e->id_equipo == $d->id_equipo_visitante ? 'selected' : ''); ?>><?php echo e($e->nombre_equipo); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label>Estado:</label>
                                                <select name="estado" class="form-select" required>
                                                    <option value="Activo" <?php echo e($d->estado == 'Activo' ? 'selected' : ''); ?>>Activo</option>
                                                    <option value="Inactivo" <?php echo e($d->estado == 'Inactivo' ? 'selected' : ''); ?>>Inactivo</option>
                                                </select>
                                            </div>
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

            <?php echo e($datos->links()); ?>


            <?php else: ?>
                <p class="text-center mt-3">No se encontraron encuentros.</p>
            <?php endif; ?>
        </div>

        <!-- MODAL CREAR -->
        <div class="modal fade" id="agregarModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="<?php echo e(route('encuentros.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="fa-solid fa-plus"></i> Crear Encuentro</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label>Fecha:</label>
                                    <select name="id_fecha" class="form-select" required>
                                        <option value="">Seleccione...</option>
                                        <?php $__currentLoopData = $fechas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($f->id_fecha); ?>"><?php echo e($f->fecha); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Hora:</label>
                                    <input type="time" name="hora" class="form-control" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Torneo:</label>
                                    <select name="id_torneo" class="form-select" required>
                                        <option value="">Seleccione...</option>
                                        <?php $__currentLoopData = $torneos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($t->id_torneo); ?>"><?php echo e($t->nombre_torneo); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label>Lugar:</label>
                                    <select name="id_lugar" class="form-select" required>
                                        <option value="">Seleccione...</option>
                                        <?php $__currentLoopData = $lugares; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($l->id_lugar); ?>"><?php echo e($l->nombre_lugar); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Árbitro:</label>
                                    <select name="id_arbitro" class="form-select" required>
                                        <option value="">Seleccione un árbitro</option>
                                        <?php $__currentLoopData = $arbitros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($a->id_arbitro); ?>"><?php echo e($a->id_usuario); ?> (<?php echo e($a->categoria_arbitral); ?>)</option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Equipo Local:</label>
                                    <select name="id_equipo_local" class="form-select" required>
                                        <option value="">Seleccione...</option>
                                        <?php $__currentLoopData = $equipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($e->id_equipo); ?>"><?php echo e($e->nombre_equipo); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Equipo Visitante:</label>
                                    <select name="id_equipo_visitante" class="form-select" required>
                                        <option value="">Seleccione...</option>
                                        <?php $__currentLoopData = $equipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($e->id_equipo); ?>"><?php echo e($e->nombre_equipo); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Estado:</label>
                                    <select name="estado" class="form-select" required>
                                        <option value="Activo">Activo</option>
                                        <option value="Inactivo">Inactivo</option>
                                    </select>
                                </div>
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

<?php echo $__env->make('welcome', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelPlayMatch\resources\views/encuentros.blade.php ENDPATH**/ ?>