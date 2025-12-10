<?php $__env->startSection('title', 'Dashboard Principal'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Panel de Control</h1>
        
        <div class="card shadow mb-4">
            <div class="card-body">
                <p>¡Bienvenido! Has iniciado sesión con éxito.</p>
                
                
                <?php if(session('user')): ?>
                    <p>Nombre: <strong><?php echo e(session('user.nombre')); ?></strong></p>
                    <p>Correo: <strong><?php echo e(session('user.correo')); ?></strong></p>
                    <p>ID Rol: <strong><?php echo e(session('user.id_rol')); ?></strong></p>
                <?php endif; ?>
                
            </div>
        </div>

        
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelPlayMatch\resources\views/dashboard.blade.php ENDPATH**/ ?>