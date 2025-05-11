<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Open Source</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= base_url('/openSource/public/img/logo.png')?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('css/plantilla.css') ?>">
  </head>

  <nav class="navbar bg-body-tertiary">
  <form class="container-fluid d-flex justify-content-between align-items-center">
    <a href="<?= base_url('/'); ?>">
      <img src="/openSource/public/img/logo.png" alt="Logo" width="80" height="80">
    </a>
    
    <div class="mx-auto">
      <a href="<?= base_url('/'); ?>">
        <button type="button" class="btn" style="background-color: #262e5b; color: white; border: none; margin-right: 10px; font-size: 18px;">Inicio</button> 
      </a>
      
      <!-- SESION INICIADA -->
      <?php if (session()->has('usuario')): ?>
        <a href="<?= base_url('/menu/panel'); ?>">
          <button type="button" class="btn" style="background-color: #262e5b; color: white; border: none; margin-right: 10px; font-size: 18px;">Panel</button>
        </a>
        <a href="<?= base_url('/menu/historial_tareas'); ?>">
          <button type="button" class="btn" style="background-color: #262e5b; color: white; border: none; margin-right: 10px; font-size: 18px;">Historial</button>
        </a>
       <!-- Notificacion -->
        <button type="button" class="btn dropdown-toggle" style=" border: none;background-color: #262e5b;color: white;" data-bs-toggle="dropdown" aria-expanded="false">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
          <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901"/>
        </svg> </button>
      </div>
      <?php endif; ?>
    

    <div class="dropdown" style="margin-left: center;">
      <button type="button" class="btn dropdown-toggle" style=" border: none;background-color: #262e5b;color: white;" data-bs-toggle="dropdown" aria-expanded="false">
        <svg class="icon" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"  fill="white">
          <path d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm0 32c-79.5 0-224 39.8-224 120v24c0 13.3 10.7 24 24 24h400c13.3 0 24-10.7 24-24v-24c0-80.2-144.5-120-224-120z"/>
        </svg>
      </button>
      <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" style="max-width: 200px;">
        <?php if (session()->has('usuario')): ?>
          <li><a class="dropdown-item" href="<?= base_url('/perfil'); ?>">Perfil</a></li>
          <li><a class="dropdown-item" href="<?= base_url('/formularios-tarea/tarea'); ?>">Crear tarea</a></li>
          <li><a class="dropdown-item" href="<?= base_url('/formularios-tarea/subtarea'); ?>">Crear subtarea</a></li>
          <li><a class="dropdown-item" href="<?= base_url('/salir'); ?>">Cerrar sesión</a></li>
        <?php else: ?>
          <li><a class="dropdown-item" href="<?= base_url('/formularios/registro'); ?>">Registrarse</a></li>
          <li><a class="dropdown-item" href="<?= base_url('/formularios/ingreso'); ?>">Iniciar sesión</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </form>
</nav>
</html>