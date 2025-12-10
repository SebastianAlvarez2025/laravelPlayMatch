<?php $__env->startSection('title', 'Equipos'); ?>
<?php $__env->startSection('content'); ?>

<div class="container-sm d-flex justify-content-center mt-5">
    <div class="card" style="width: 1000px;">
        <div class="card-body">
            <h3>Módulo Categorías</h3>
            <hr>
            <form action="<?php echo e(url('/categorias')); ?>" method="GET">
                <div class="text-end mb-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarModal">
                        <i class="fa-solid fa-plus"></i> Nuevo
                </div>

                <div class="row g-2 align-items-center">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" name="search" value="<?php echo e(request('search')); ?>" placeholder="Buscar por nombre o descripción">
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <button type="submit" class="btn btn-info"><i class="fas fa-search-plus"></i> Buscar</button>
                        <a href="<?php echo e(url('/categorias')); ?>" class="btn btn-warning"><i class="fas fa-list"></i> Reset</a>
                    </div>
                </div>
            </form>

            <?php if($datos->count() > 0): ?>
                <table class="table table-striped table-hover table-bordered text-center align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>ID Categoría</th>
                            <th>nombre_categoria</th>
                            <th>Descripción</th>
                            <th>Edad_Mínima</th>
                            <th>Edad_Máxima</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $datos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($item->id_categoria); ?></td>
                            <td><?php echo e($item->nombre_categoria); ?></td>
                            <td><?php echo e($item->descripcion); ?></td>
                            <td><?php echo e($item->edad_minima); ?></td>
                            <td><?php echo e($item->edad_maxima); ?></td>
                            <td>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editarModal<?php echo e($item->id_categoria); ?>">
                                    <i class="fa-solid fa-pen-to-square"></i> Editar
                                </button>

                                <form action="<?php echo e(route('categorias.destroy', $item->id_categoria)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar esta categoría?')">
                                        <i class="fa-solid fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- MODAL EDITAR -->
                        <div class="modal fade" id="editarModal<?php echo e($item->id_categoria); ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="<?php echo e(route('categorias.update', $item->id_categoria)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <div class="modal-header">
                                            <h5 class="modal-title"><i class="fa-solid fa-pen-to-square"></i> Editar Categoría</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Nombre de la Categoría</label>
                                                <input type="text" class="form-control" name="nombre_categoria" value="<?php echo e($item->nombre_categoria); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Descripción</label>
                                                <textarea class="form-control" name="descripcion" required><?php echo e($item->descripcion); ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Edad Mínima</label>
                                                <input type="number" class="form-control" name="edad_minima" value="<?php echo e($item->edad_minima); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Edad Máxima</label>
                                                <input type="number" class="form-control" name="edad_maxima" value="<?php echo e($item->edad_maxima); ?>" required>
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
                <p class="text-center mt-3">No se encontraron categorías.</p>
            <?php endif; ?>
        </div>

        <!-- MODAL AGREGAR -->
        <div class="modal fade" id="agregarModal" tabindex="-1" aria-labelledby="agregarModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="<?php echo e(route('categorias.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="fa-solid fa-folder-plus"></i> Registrar Categoría</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Nombre de la Categoría</label>
                                <input type="text" class="form-control" name="nombre_categoria" placeholder="Digite el nombre" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Descripción</label>
                                <textarea class="form-control" name="descripcion" placeholder="Digite una descripción" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Edad Mínima</label>
                                <input type="number" class="form-control" name="edad_minima" placeholder="Digite la edad mínima" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Edad Máxima</label>
                                <input type="number" class="form-control" name="edad_maxima" placeholder="Digite la edad máxima" required>
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
<?php echo $__env->make('dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelPlayMatch\resources\views/categorias.blade.php ENDPATH**/ ?>