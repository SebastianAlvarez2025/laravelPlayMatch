<?php $__env->startSection('title', 'Faltas'); ?>
<?php $__env->startSection('content'); ?>

<div class="container-sm d-flex justify-content-center mt-5">
    <div class="card" style="width: 1200px;">
        <div class="card-body">
            <h3>Módulo faltas</h3>
            <hr>

            <form action="<?php echo e(url('/faltas')); ?>" method="GET">
                <div class="text-end mb-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarModal">
                        <i class="fa-solid fa-plus"></i> Nuevo
                    </button>
                </div>

                <div class="row g-2 align-items-center">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" name="search" value="<?php echo e(request('search')); ?>" placeholder="Buscar por faltas">
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <button type="submit" class="btn btn-info"><i class="fas fa-search-plus"></i> Buscar</button>
                        <a href="<?php echo e(url('/faltas')); ?>" class="btn btn-warning"><i class="fas fa-list"></i> Reset</a>
                    </div>
                </div>
            </form>

            <?php if($datos->count() > 0): ?>
                <table class="table table-striped table-hover table-bordered">
                    <thead class="table-primary">
                    <tr>
                        <th>ID Falta</th>
                        <th>ID Encuentro</th>
                        <th>Jugador</th>
                        <th>Cronología (Tipo – Minuto)</th>
                        <th>Minuto</th>
                        <th>Tarjeta</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php $__currentLoopData = $datos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($item->id_falta); ?></td>
                            <td><?php echo e($item->id_encuentro); ?></td>
                            <td><?php echo e($item->nombre_jugador); ?></td>

                            
                            <td><?php echo e($item->tipo_evento); ?> – minuto <?php echo e($item->cronologia_minuto); ?></td>

                            <td><?php echo e($item->minuto); ?></td>
                            <td><?php echo e($item->tarjeta); ?></td>
                            <td><?php echo e($item->descripcion); ?></td>

                            <td>
                                <!-- BOTÓN EDITAR -->
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editarModal<?php echo e($item->id_falta); ?>">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>

                                <!-- BOTÓN ELIMINAR -->
                                <form action="<?php echo e(route('faltas.destroy', $item->id_falta)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar esta falta?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- MODAL EDITAR -->
                        <div class="modal fade" id="editarModal<?php echo e($item->id_falta); ?>" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="<?php echo e(route('faltas.update', $item->id_falta)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>

                                        <div class="modal-header">
                                            <h5 class="modal-title">Editar Falta</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">

                                            <div class="mb-3">
                                                <label class="form-label">Encuentro:</label>
                                                <select class="form-select" name="id_encuentro" required>
                                                    <?php $__currentLoopData = $encuentros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $encuentro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($encuentro->id_encuentro); ?>"
                                                            <?php echo e($encuentro->id_encuentro == $item->id_encuentro ? 'selected' : ''); ?>>
                                                            <?php echo e($encuentro->id_encuentro); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Jugador:</label>
                                                <select class="form-select" name="id_jugador" required>
                                                    <?php $__currentLoopData = $jugadores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jugador): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($jugador->id_jugador); ?>"
                                                            <?php echo e($jugador->id_jugador == $item->id_jugador ? 'selected' : ''); ?>>
                                                            <?php echo e($jugador->nombre_jugador); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>

                                            <!-- CRONOLOGIA -->
                                            <div class="mb-3">
                                                <label class="form-label">Cronología (Tipo – Minuto):</label>
                                                <select class="form-select" name="id_cronologia" required>
                                                    <?php $__currentLoopData = $cronologia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php
                                                            $texto = $c->tipo_evento . " - minuto " . $c->minuto;
                                                        ?>

                                                        <option value="<?php echo e($c->id_cronologia); ?>"
                                                            <?php echo e($c->id_cronologia == $item->id_cronologia ? 'selected' : ''); ?>>
                                                            <?php echo e($texto); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Minuto:</label>
                                                <input type="number" class="form-control" name="minuto" value="<?php echo e($item->minuto); ?>" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Tarjeta:</label>
                                                <select class="form-select" name="tarjeta" required>
                                                    <option value="ninguna" <?php echo e($item->tarjeta == 'ninguna' ? 'selected' : ''); ?>>Ninguna</option>
                                                    <option value="amarilla" <?php echo e($item->tarjeta == 'amarilla' ? 'selected' : ''); ?>>Amarilla</option>
                                                    <option value="roja" <?php echo e($item->tarjeta == 'roja' ? 'selected' : ''); ?>>Roja</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Descripción:</label>
                                                <input type="text" class="form-control" name="descripcion" value="<?php echo e($item->descripcion); ?>" required>
                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
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
                <p class="text-center mt-3">No se encontraron faltas.</p>
            <?php endif; ?>
        </div>

        <!-- MODAL AGREGAR -->
        <div class="modal fade" id="agregarModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="<?php echo e(route('faltas.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <div class="modal-header">
                            <h5 class="modal-title">Crear Falta</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">

                            <div class="mb-3">
                                <label class="form-label">ID Falta:</label>
                                <input type="number" class="form-control" name="id_falta" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Encuentro:</label>
                                <select class="form-select" name="id_encuentro" required>
                                    <option value="" hidden selected>Seleccione...</option>
                                    <?php $__currentLoopData = $encuentros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $encuentro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($encuentro->id_encuentro); ?>"><?php echo e($encuentro->id_encuentro); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jugador:</label>
                                <select class="form-select" name="id_jugador" required>
                                    <option value="" hidden selected>Seleccione...</option>
                                    <?php $__currentLoopData = $jugadores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jugador): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($jugador->id_jugador); ?>"><?php echo e($jugador->nombre_jugador); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Cronología:</label>
                                <select class="form-select" name="id_cronologia" required>
                                    <option value="" hidden selected>Seleccione...</option>
                                    <?php $__currentLoopData = $cronologia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $texto = $c->tipo_evento . " - minuto " . $c->minuto;
                                        ?>
                                        <option value="<?php echo e($c->id_cronologia); ?>"><?php echo e($texto); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Minuto:</label>
                                <input type="number" class="form-control" name="minuto" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tarjeta:</label>
                                <select class="form-select" name="tarjeta" required>
                                    <option value="" hidden selected>Seleccione...</option>
                                    <option value="ninguna">Ninguna</option>
                                    <option value="amarilla">Amarilla</option>
                                    <option value="roja">Roja</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Descripción:</label>
                                <input type="text" class="form-control" name="descripcion" required>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('welcome', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelPlayMatch\resources\views/faltas.blade.php ENDPATH**/ ?>