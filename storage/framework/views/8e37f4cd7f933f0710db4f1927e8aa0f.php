<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PLAY MATCH</title>

    <link rel="icon" type="image/png" href="<?php echo e(asset('Images/Logo.png')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('CSS/Global/global.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('CSS/Visitante/styles.css')); ?>">
  </head>

  <body>
      <header>
        <div class="top-bar">
          <div class="left-size">
            <img src="<?php echo e(asset('Images/Logo.png')); ?>" alt="Logo" class="logo">
            <h1 class="titulo">Play Match</h1>

            <nav class="menu"> 
              <a href="<?php echo e(url('buscar-torneo')); ?>">Buscar Torneos</a>
              <a href="<?php echo e(url('partidos')); ?>">Partidos</a>
              <a href="<?php echo e(url('equipos')); ?>">Equipos</a>
            </nav>
          </div>

          <div class="buttons-container">      
            <section class="sigin">
                <button type="button" onclick="location.href='<?php echo e(url('registrarse')); ?>'">
                    Registrarse
                </button>
            </section>

            <section class="login">
                <button type="button" onclick="location.href='<?php echo e(route('login')); ?>'">
                    Inicio de sesión
                </button>
            </section>
          </div>
        </div>
      </header>

      <main>
        <section class="cuerpo">
          <h2 class="subtitulo">TORNEOS DESTACADOS - FÚTBOL 11</h2>

          <div class="torneos">

            <?php $__currentLoopData = $torneos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $torneo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <article class="tarjeta-torneo">

                    
                    <div class="imagen">
                        <img src="<?php echo e($torneo->imagen ?: asset('Images/Logo.png')); ?>" alt="Imagen torneo">
                    </div>

                    
                    <div class="texto">
                        <h3><?php echo e($torneo->nombre_torneo); ?></h3>
                        <p>Código: <?php echo e($torneo->id_torneo); ?></p>
                    </div>

                    <a href="<?php echo e(route('torneo.show', $torneo->id_torneo)); ?>" class="boton">Ver información</a>
                </article>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

          </div>
        </section>
      </main>

  </body>
</html>


<?php /**PATH C:\xampp\htdocs\laravelPlayMatch\resources\views/index.blade.php ENDPATH**/ ?>