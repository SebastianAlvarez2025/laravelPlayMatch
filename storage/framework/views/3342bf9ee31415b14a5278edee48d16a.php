<?php $__env->startSection('title', 'Árbitros'); ?>
<?php $__env->startSection('content'); ?>

<div class="container-sm d-flex justify-content-center mt-5">
    <div class="card" style="width: 1200px;">
        <div class="card-body">
            <h3>Módulo Árbitros</h3>
            <hr>
            <form action="<?php echo e(url('/arbitros')); ?>" method="GET">
                <div class="text-end mb-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarModal">
                        <i class="fa-solid fa-plus"></i> Nuevo
                    </button>
                </div>

                <div class="row g-2 align-items-center">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" name="search" value="<?php echo e(request('search')); ?>" placeholder="Buscar árbitros...">
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <button type="submit" class="btn btn-info"><i class="fas fa-search-plus"></i> Buscar</button>
                        <a href="<?php echo e(url('/arbitros')); ?>" class="btn btn-warning"><i class="fas fa-list"></i> Reset</a>
                    </div>
                </div>
            </form>

            <?php if($datos->count() > 0): ?>
                <table class="table table-striped table-hover table-bordered">
                    <thead class="table-primary">
                    <tr>
                        <th>ID Árbitro</th>
                        <th>Usuario</th>
                        <th>Licencia</th>
                        <th>Años Experiencia</th>
                        <th>Categoría Arbitral</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $datos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($item->id_arbitro); ?></td>
                            <td><?php echo e($item->id_usuario); ?></td>
                            <td><?php echo e($item->licencia); ?></td>
                            <td><?php echo e($item->anos_experiencia); ?></td>
                            <td><?php echo e($item->categoria_arbitral); ?></td>
                            <td><?php echo e($item->estado); ?></td>
                            <td>
                                <!-- BOTÓN EDITAR -->
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editarModal<?php echo e($item->id_arbitro); ?>">
                                    <i class="fa-solid fa-pen-to-square"></i> Editar
                                </button>

                                <!-- BOTÓN ELIMINAR -->
                                <form action="<?php echo e(route('arbitros.destroy', $item->id_arbitro)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este árbitro?')">
                                        <i class="fa-solid fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- MODAL EDITAR -->
                        <div class="modal fade" id="editarModal<?php echo e($item->id_arbitro); ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="<?php echo e(route('arbitros.update', $item->id_arbitro)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <div class="modal-header">
                                            <h5 class="modal-title"><i class="fa-solid fa-pen-to-square"></i> Editar Árbitro</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="id_usuario" class="form-label">ID Usuario</label>
                                                <input type="text" class="form-control" name="id_usuario" value="<?php echo e($item->id_usuario); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="licencia" class="form-label">Licencia</label>
                                                <input type="text" class="form-control" name="licencia" value="<?php echo e($item->licencia); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="anos_experiencia" class="form-label">Años de Experiencia</label>
                                                <input type="number" class="form-control" name="anos_experiencia" value="<?php echo e($item->anos_experiencia); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="categoria_arbitral" class="form-label">Categoría Arbitral</label>
                                                <select class="form-select" name="categoria_arbitral" required>
                                                    <option value="">Seleccione una categoría</option>
                                                    <option value="FIFA" <?php echo e($item->categoria_arbitral == 'FIFA' ? 'selected' : ''); ?>>FIFA</option>
                                                    <option value="Nacional" <?php echo e($item->categoria_arbitral == 'Nacional' ? 'selected' : ''); ?>>Nacional</option>
                                                    <option value="Regional" <?php echo e($item->categoria_arbitral == 'Regional' ? 'selected' : ''); ?>>Regional</option>
                                                    <option value="Local" <?php echo e($item->categoria_arbitral == 'Local' ? 'selected' : ''); ?>>Local</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="estado" class="form-label">Estado</label>
                                                <select class="form-select" name="estado" required>
                                                    <option value="">Seleccione un estado</option>
                                                    <option value="Activo" <?php echo e($item->estado == 'Activo' ? 'selected' : ''); ?>>Activo</option>
                                                    <option value="Inactivo" <?php echo e($item->estado == 'Inactivo' ? 'selected' : ''); ?>>Inactivo</option>
                                                    <option value="Suspendido" <?php echo e($item->estado == 'Suspendido' ? 'selected' : ''); ?>>Suspendido</option>
                                                    <option value="Lesionado" <?php echo e($item->estado == 'Lesionado' ? 'selected' : ''); ?>>Lesionado</option>
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
                <p class="text-center mt-3">No se encontraron árbitros.</p>
            <?php endif; ?>
        </div>

        <!-- MODAL AGREGAR -->
        <div class="modal fade" id="agregarModal" tabindex="-1" aria-labelledby="agregarModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="<?php echo e(route('arbitros.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="fa-solid fa-whistle"></i> Crear Árbitro</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="id_arbitro" class="form-label">ID Árbitro</label>
                                <input type="number" class="form-control" id="id_arbitro" name="id_arbitro" placeholder="Digite el ID del árbitro" required>
                            </div>

                            <div class="mb-3">
                                <label for="id_usuario" class="form-label">ID Usuario</label>
                                <input type="text" class="form-control" id="id_usuario" name="id_usuario" placeholder="Digite el ID del usuario" required>
                            </div>

                            <div class="mb-3">
                                <label for="licencia" class="form-label">Licencia</label>
                                <input type="text" class="form-control" id="licencia" name="licencia" placeholder="Digite la licencia del árbitro" required>
                            </div>

                            <div class="mb-3">
                                <label for="anos_experiencia" class="form-label">Años de Experiencia</label>
                                <input type="number" class="form-control" id="anos_experiencia" name="anos_experiencia" placeholder="Digite los años de experiencia" required>
                            </div>

                            <div class="mb-3">
                                <label for="categoria_arbitral" class="form-label">Categoría Arbitral</label>
                                <select class="form-select" name="categoria_arbitral" required>
                                    <option value="">Seleccione una categoría</option>
                                    <option value="FIFA">FIFA</option>
                                    <option value="Nacional">Nacional</option>
                                    <option value="Regional">Regional</option>
                                    <option value="Local">Local</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="estado" class="form-label">Estado</label>
                                <select class="form-select" name="estado" required>
                                    <option value="">Seleccione un estado</option>
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                    <option value="Suspendido">Suspendido</option>
                                    <option value="Lesionado">Lesionado</option>
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('welcome', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelPlayMatch\resources\views/arbitros.blade.php ENDPATH**/ ?>