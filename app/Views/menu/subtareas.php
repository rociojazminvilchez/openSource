<?php date_default_timezone_set('America/Argentina/Buenos_Aires'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Open Source</title>
  <meta name="description" content="The small framework with powerful features">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="<?= base_url('/openSource/public/img/logo.png') ?>" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('/css/menu.css') ?>">
</head>
<body>
<?= $this->include('plantilla/navbar'); ?><br>

<!--ALERTA DE MENSAJES -->
<?php if (session()->getFlashdata('mensajeError')): ?>
  <div class="alert alert-danger"><?= session()->getFlashdata('mensajeError') ?></div>
<?php endif; ?>

<?php if (session()->getFlashdata('mensaje')): ?>
  <div class="alert alert-success"><?= session()->getFlashdata('mensaje') ?></div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
  <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<div class="alert alert-warning" role="alert">
  <strong>Atención:</strong> Este panel es para visualizar y modificar las subtareas.
</div>

<!-- ALERTA VENCIMIENTO (Si faltan 3 dias o menos) -->
<?php
  $fechaHoy = strtotime(date('Y-m-d')); // Fecha actual 
  $subtareasVencenPronto = [];
  
  foreach ($subtareas as $s) :
    $fechaVencimiento = strtotime($s['fecha_vencimiento']);
    $diasRestantes = ($fechaVencimiento - $fechaHoy) / (60 * 60 * 24); 

    if ($diasRestantes <= 3 && $diasRestantes >= 0) {
      $subtareasVencenPronto[] = $s['id'];
    }
  endforeach;

  if (!empty($subtareasVencenPronto)): 
     foreach ($subtareasVencenPronto as $id_subtarea): ?>
        <div class="alert alert-danger mt-3">
          ⚠️ ¡Atención! La <strong>SUBTAREA <?= $id_subtarea ?></strong> vence en menos de 3 días. ¡Revisala!
        </div>
    <?php endforeach; 
  endif; ?>

<div class="card text-center">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs justify-content-center">
      <li>
        <a class="nav-link active" href="<?= base_url('/menu/panel'); ?>"> Panel </a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="<?= base_url('/menu/tareas'); ?>"> Tareas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="<?= base_url('/menu/subtareas'); ?>"><label style="color:red; font-weight: bold;">SUBTAREAS</label></a>
      </li>
    </ul>
  </div><br>
  <?php if (empty($subtareas)): ?>
    <div class="alert-info" role="alert">
      En este momento no posee subtareas registradas.
    </div>
    <?php
    else:?>
  <h3 class="my-3" id="titulo" style="margin: 20px;font-family: 'Times New Roman', serif;"> SUBTAREAS </h3> 

  <div class="container-fluid mb-4">
    <div class="table-responsive">
      <table class="table table-hover encabezado-custom" aria-describedby="titulo">
        <thead>
          <tr>
            <th>ID</th>
            <th>Descripción</th>
            <th>Estado</th>
            <th>Prioridad</th>
            <th>Fecha Vencimiento</th>
            <th>Comentario</th>
            <th>Responsable</th>
            <th scope="col">Colaborador</th>
            <th colspan="4">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($subtareas as $s) : ?>
            <tr>
              <td><?= $s['id']; ?></td>
              <td><?= $s['descripcion']; ?></td>
              <td><?= $s['estado']; ?></td>
              <td><?= $s['prioridad']; ?></td>
              <td>
                <?php if ($s['fecha_vencimiento'] != '0000-00-00') : ?>
                  <?= (new DateTime($s['fecha_vencimiento']))->format('d-m-Y'); ?>
                <?php endif; ?>
              </td>
              <td><?= $s['comentario']; ?></td>
              <td><?= $s['responsable']; ?></td>
              <td><?= $s['colaborador']; ?></td>
              <?php if($s['estado']!='Completada'){
                ?> <td> <a href="<?= site_url('menu/subtareas/' . $s['id'] . '/' . $s['tarea']) ?>" class="btn btn-secondary btn-sm">✅ Completada</a></td>
                <?php
              }else{
                ?> <td> </td> <?php
              }
              ?> 
              <?php
              $esResponsable = ($s['responsable'] == session()->get('usuario'));
              $estadoNoCompletado = ($s['estado'] !== 'Completada');
              if ($esResponsable || $estadoNoCompletado) {
                ?>
              <td><a href="<?= site_url('menu/subtarea/' . $s['id']); ?>" class="btn btn-success btn-sm">✏️ Modificar</a>
              </td><?php } ?>
              <td><a href="<?= site_url('formularios-tarea/enviarsubtarea/' . $s['id']); ?>" class="btn btn-primary btn-sm">🔗 Compartir</button></td>
              <?php if ($s['responsable'] == session()->get('usuario')): ?>
             <td><a href="<?= site_url('menu/subtareas/' . $s['id']); ?>" class="btn btn-danger btn-sm">🗑️ Eliminar</a></td>
             <?php  endif; ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<a href="#inicio" class="btn btn-secondary" style="position: fixed; bottom: 20px; right: 20px;">
  ⬆ Volver arriba
</a>
<?php endif; ?>

<?= $this->include('plantilla/footer'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
