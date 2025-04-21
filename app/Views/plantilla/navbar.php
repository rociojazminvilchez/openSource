<?php
  //session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inguz</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= base_url('img/icon.png')?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('assets/css/plantilla.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/actividades.css') ?>">

  </head>

<nav class="navbar bg-body-tertiary">
  <form class="container-fluid d-flex justify-content-between align-items-center">
    <a href="<?= base_url('/inguz/index'); ?>">
      <img src="/inguz/public/assets/img/logo2.png" alt="Logo" width="70" height="70">
    </a>
    
    <div class="mx-auto">
      <a href="<?= base_url('/inguz/index'); ?>">
      <button type="button" class="btn" style="background-color: #df7718; color: white; border: none; margin-right: 10px; font-size: 18px;"> Inicio</button> 
     </a>

    <a href="<?= base_url('/inguz/actividades'); ?>">
      <button type="button" class="btn" style="background-color: #df7718; color: white; border: none; margin-right: 10px;  font-size: 18px;"> Actividades</button>
    </a>

    <a href="<?= base_url('/inguz/informacion'); ?>">
      <button type="button" class="btn" style="background-color: #df7718; color: white; border: none; margin-right: 10px;font-size: 18px;"> Información</button>
    </a>

    <a href="<?= base_url('/inguz/reserva'); ?>">
      <button type="button" class="btn" style="background-color: #df7718; color: white; border: none;  font-size: 18px;"> Reserva</button>
    </a>
    </div>

    <div class="dropdown" style="margin-left: center;">
      <button type="button" class="btn dropdown-toggle" style="background-color: #df7718; border: none;" data-bs-toggle="dropdown" aria-expanded="false">
        <svg class="icon" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
          <path d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm0 32c-79.5 0-224 39.8-224 120v24c0 13.3 10.7 24 24 24h400c13.3 0 24-10.7 24-24v-24c0-80.2-144.5-120-224-120z"/>
        </svg>
      </button>
      <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" style="max-width: 200px;">
        <?php   
          if (session()->has('usuario')) {
            
            if($_SESSION['tipo']=='Usuario'){
             ?> 
             <li><a class="dropdown-item" href="<?= base_url('/usuario/perfil'); ?>">Perfil</a></li>
             <li><a class="dropdown-item" href="<?= base_url('/usuario/membresias');?>"> Historial</a></li>
             <li><a class="dropdown-item" href="<?= base_url('/salir'); ?>">Cerrar sesión</a></li>
             <?php
            }else{
              ?>
              <li><a class="dropdown-item">Instructor</a></li>
              <hr>
              <li><a class="dropdown-item" href="<?= base_url('/instructor/perfil'); ?>">Perfil</a></li>
              <li><a class="dropdown-item" href="<?= base_url('/creditos/membresia_espera'); ?>"> Membresias </a></li>
             <li><a class="dropdown-item" href="<?= base_url('/reservas/reservas'); ?>"> Reservas </a></li>
             <li><a class="dropdown-item" href="<?= base_url('/actualizar/actualizar_reformer'); ?>"> Actualizar </a></li>
             <li><a class="dropdown-item" href="<?= base_url('/salir'); ?>">Cerrar sesión</a></li>
            
           <?php
          }
           
           }
           else{
            ?>
        <li><a class="dropdown-item" href="<?= base_url('/formularios/registro'); ?>">Registrarse</a></li>
        <li><a class="dropdown-item" href="<?= base_url('/formularios/ingreso'); ?>">Iniciar sesión</a></li>
        <hr>
        <li><a class="dropdown-item" href="<?= base_url('/formularios/opc_instructor'); ?>">Instructor</a></li>
      </ul>
      <?php
      }
      ?>
    </div>
  </form>
</nav>

</html>