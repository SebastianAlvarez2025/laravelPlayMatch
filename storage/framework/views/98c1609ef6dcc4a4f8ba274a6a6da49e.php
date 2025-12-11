<?php $__env->startSection('title', 'Equipos'); ?>
<?php $__env->startSection('content'); ?>

<div class="container-sm d-flex justify-content-center mt-5">
    <div class="card" style="width: 1200px;">
        <div class="card-body">
            <h3>Módulo Premiacion</h3>
            <hr>

            <form action="<?php echo e(url('/premiacion')); ?>" method="GET">
                <div class="text-end mb-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarModal">
                        <i class="fa-solid fa-plus"></i> Nuevo
                    </button>
                </div>

                <div class="row g-2 align-items-center">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" name="search" value="<?php echo e(request('search')); ?>" placeholder="Buscar por Resultados">
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <button type="submit" class="btn btn-info"><i class="fas fa-search-plus"></i> Buscar</button>
                        <a href="<?php echo e(url('/premiacion')); ?>" class="btn btn-warning"><i class="fas fa-list"></i> Reset</a>
                    </div>
                </div>
            </form>

            <?php if($datos->count() > 0): ?>
                <table class="table table-striped table-hover table-bordered">
                    <thead class="table-primary">
                    <tr>
                        <th>Identificación de la premiacion</th>
                        <th>Identificación del torneo</th>
                        <th>Identificación del equipo gandor</th>
                        <th>posicion</th>
                        <th>premio</th>
                        <th>descripcion</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $datos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($item->id_premiacion); ?></td>
                            <td><?php echo e($item->id_torneo); ?></td>
                            <td><?php echo e($item->id_equipo); ?></td>
                            <td><?php echo e($item->posicion); ?></td>
                            <td><?php echo e($item->premio); ?></td>
                            <td><?php echo e($item->descripcion); ?></td>
                            <td>
                                <!-- BOTÓN EDITAR -->
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editarModal<?php echo e($item->id_premiacion); ?>">
                                    <i class="fa-solid fa-pen-to-square"></i> Editar
                                </button>

                                <!-- BOTÓN ELIMINAR -->
                                <form action="<?php echo e(route('premiacion.destroy', $item->id_premiacion)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este resultado?')">
                                        <i class="fa-solid fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- MODAL EDITAR -->
                        <div class="modal fade" id="editarModal<?php echo e($item->id_premiacion); ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="<?php echo e(route('premiacion.update', $item->id_premiacion)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <div class="modal-header">
                                            <h5 class="modal-title"><i class="fa-solid fa-pen-to-square"></i> Editar Resultado</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="id_torneo" class="form-label">identificador del torneo</label>
                                                <input type="text" class="form-control" name="id_torneo" value="<?php echo e($item->id_torneo); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="id_equipo" class="form-label">Identificador del equipo ganador</label>
                                                <input type="text" class="form-control" name="id_equipo" value="<?php echo e($item->id_equipo); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="posicion" class="form-label">Posicion</label>
                                                <input type="text" class="form-control" name="posicion" value="<?php echo e($item->posicion); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="premio" class="form-label">premio</label>
                                                <input type="text" class="form-control" name="premio" value="<?php echo e($item->premio); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="descripcion" class="form-label">descripcion</label>
                                                <input type="text" class="form-control" name="descripcion" value="<?php echo e($item->descripcion); ?>" required>
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
                <p class="text-center mt-3">No se encontraron resultados.</p>
            <?php endif; ?>
        </div>

        <!-- MODAL AGREGAR -->
        <div class="modal fade" id="agregarModal" tabindex="-1" aria-labelledby="agregarModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="<?php echo e(route('premiacion.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="fa-solid fa-user"></i> Crear premiacion</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="id_premiacion" class="form-label">Identificación de la premiacion</label>
                                <input type="text" class="form-control" id="id_premiacion" name="id_premiacion" placeholder="Digite el ID de la nueva premiacion" required>
                            </div>
                            <div class="mb-3">
                                <label for="id_torneo" class="form-label">Encuentro</label>
                                <input type="text" class="form-control" id="id_torneo" name="id_torneo" placeholder="Digite el ID del torneo" required>
                            </div>
                            <div class="mb-3">
                                <label for="id_equipo_ganador" class="form-label">Identificacion del equipo ganador</label>
                                <input type="text" class="form-control" id="id_equipo_ganador" name="id_equipo_ganador" placeholder="identifiacion del equipo gandor" required>
                            </div>
                            <div class="mb-3">
                                <label for="posicion" class="form-label">Posicion</label>
                                <input type="text" class="form-control" id="posicion" name="posicion" placeholder="posicion" required>
                            </div>
                            <div class="mb-3">
                                <label for="premio" class="form-label">Premio</label>
                                <input type="text" class="form-control" id="premio" name="premio" placeholder="premio" required>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">descripcion</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="descripcion" required>
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

<?php echo $__env->make('welcome', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelPlayMatch\resources\views/premiacion.blade.php ENDPATH**/ ?>