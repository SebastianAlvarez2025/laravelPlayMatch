<?php $__env->startSection('title', 'Equipos'); ?>
<?php $__env->startSection('content'); ?>

<div class="container-sm d-flex justify-content-center mt-5">
    <div class="card" style="width: 1200px;">
        <div class="card-body">
            <h3>Módulo Equipos</h3>
            <hr>

            <form action="<?php echo e(url('/equipos')); ?>" method="GET">
                <div class="text-end mb-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarModal">
                        <i class="fa-solid fa-plus"></i> Nuevo  
                    </button>
                </div>

                <div class="row g-2 align-items-center">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" name="search" value="<?php echo e(request('search')); ?>" placeholder="Buscar por equipo o ciudad">
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <button type="submit" class="btn btn-info"><i class="fas fa-search-plus"></i> Buscar</button>
                        <a href="<?php echo e(url('/equipos')); ?>" class="btn btn-warning"><i class="fas fa-list"></i> Reset</a>
                    </div>
                </div>
            </form>

            <?php if($datos->count() > 0): ?>
                <table class="table table-striped table-hover table-bordered">
                    <thead class="table-primary">
                    <tr>
                        <th>Equipo</th>
                        <th>Nombre del equipo</th>
                        <th>Ciudad</th>
                        <th>Categoría</th>
                        <th>Escudo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $datos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($item->id_equipo); ?></td>
                            <td><?php echo e($item->nombre_equipo); ?></td>
                            <td><?php echo e($item->ciudad); ?></td>
                            <td><?php echo e($item->nombre_categoria); ?></td>
                            <td class="text-center">
                                <?php if($item->escudo_final): ?>
                                    <img src="<?php echo e($item->escudo_final); ?>" 
                                         alt="Escudo <?php echo e($item->nombre_equipo); ?>" 
                                         style="width: 60px; height: 60px; object-fit: contain; border-radius: 5px;">
                                <?php else: ?>
                                    <span class="text-muted">Sin escudo</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php echo e($item->estado); ?>

                            </td>
                            <td>
                                <!-- BOTÓN EDITAR -->
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editarModal<?php echo e($item->id_equipo); ?>">
                                    <i class="fa-solid fa-pen-to-square"></i> Editar
                                </button>

                                <!-- BOTÓN ELIMINAR -->
                                <form action="<?php echo e(route('equipos.destroy', $item->id_equipo)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este equipo?')">
                                        <i class="fa-solid fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- MODAL EDITAR -->
                        <div class="modal fade" id="editarModal<?php echo e($item->id_equipo); ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="<?php echo e(route('equipos.update', $item->id_equipo)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <div class="modal-header">
                                            <h5 class="modal-title"><i class="fa-solid fa-pen-to-square"></i> Editar equipo</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label>Nombre del equipo</label>
                                                <input type="text" class="form-control" name="nombre_equipo" value="<?php echo e($item->nombre_equipo); ?>" required>
                                            </div>

                                            <div class="mb-3">
                                                <label>Ciudad</label>
                                                <input type="text" class="form-control" name="ciudad" value="<?php echo e($item->ciudad); ?>" required>
                                            </div>

                                            <div class="mb-3">
                                                <label>Categoría</label>
                                                <select name="id_categoria" class="form-select" required>
                                                    <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($cat->id_categoria); ?>" <?php echo e($cat->id_categoria == $item->id_categoria ? 'selected' : ''); ?>>
                                                            <?php echo e($cat->nombre_categoria); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label>Escudo URL</label>
                                                <input type="text" class="form-control" name="escudo_url" value="<?php echo e($item->escudo_final); ?>" placeholder="https://ejemplo.com/escudo.jpg">
                                                <?php if($item->escudo_final): ?>
                                                    <div class="mt-2">
                                                        <small>Vista previa actual:</small><br>
                                                        <img src="<?php echo e($item->escudo_final); ?>" alt="Vista previa" style="width: 50px; height: 50px; object-fit: contain; border: 1px solid #ddd;">
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <div class="mb-3">
                                                <label>Estado</label>
                                                <select name="estado" class="form-select" required>
                                                    <option value="Activo" <?php echo e($item->estado == 'Activo' ? 'selected' : ''); ?>>Activo</option>
                                                    <option value="Inactivo" <?php echo e($item->estado == 'Inactivo' ? 'selected' : ''); ?>>Inactivo</option>
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
                <p class="text-center mt-3">No se encontraron equipos.</p>
            <?php endif; ?>
        </div>

        <!-- MODAL AGREGAR -->
        <div class="modal fade" id="agregarModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="<?php echo e(route('equipos.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <div class="modal-header">
                            <h5 class="modal-title"><i class="fa-solid fa-plus"></i> Crear equipo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">

                            <div class="mb-3">
                                <label>Nombre del equipo</label>
                                <input type="text" class="form-control" name="nombre_equipo" required>
                            </div>

                            <div class="mb-3">
                                <label>Ciudad</label>
                                <input type="text" class="form-control" name="ciudad" required>
                            </div>

                            <div class="mb-3">
                                <label>Categoría</label>
                                <select name="id_categoria" class="form-select" required>
                                    <option disabled selected>Seleccione una categoría</option>
                                    <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($cat->id_categoria); ?>"><?php echo e($cat->nombre_categoria); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Escudo URL</label>
                                <input type="text" class="form-control" name="escudo_url" placeholder="https://ejemplo.com/escudo.jpg">
                                <small class="text-muted">Ejemplo: https://dimayor.com.co/wp-content/uploads/2024/06/TIGRES-FC.png</small>
                            </div>

                            <div class="mb-3">
                                <label>Estado</label>
                                <select name="estado" class="form-select" required>
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
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
<?php echo $__env->make('welcome', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelPlayMatch\resources\views/equipos.blade.php ENDPATH**/ ?>