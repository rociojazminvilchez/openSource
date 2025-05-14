<?php date_default_timezone_set('America/Argentina/Buenos_Aires'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Open Source</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('public/img/logo.png') ?>">
    <link rel="shortcut icon" href="<?= base_url('/openSource/public/img/logo.png') ?>" type="image/png">
    <link rel="stylesheet" href="<?= base_url('/css/menu.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </style>
  </head>
<body>
<div id="inicio"></div>
<?php
  echo $this->include('plantilla/navbar');
?><br>
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
  <strong>Atención:</strong> Este panel es para visualizar las tareas y subtareas.
</div>
  <?php
$VencenEn3Dias = false;
$recordatorioHoy = false;
$fechaHoy = strtotime(date('Y-m-d')); // Fecha actual como timestamp

foreach ($tareas as $t) :

    // Verificar vencimiento (3 días o menos)
    $fechaVencimiento = strtotime($t['fecha_vencimiento']);
    $diasRestantes = ($fechaVencimiento - $fechaHoy) / (60 * 60 * 24); 

    if ($diasRestantes <= 3 && $diasRestantes >= 0) {
        $VencenEn3Dias = true;
    }

    // Verificar recordatorio (si es hoy)
    if (!empty($t['fecha_recordatorio']) && strtotime($t['fecha_recordatorio']) === $fechaHoy) {
        $recordatorioHoy = true;
    }
endforeach;
?>

<?php if ($VencenEn3Dias): ?>
    <div class="alert alert-danger mt-3">
        ⚠️ ¡Atención! Tenés una tarea que vence en menos de 3 días. ¡Revisala!
    </div>
<?php endif; ?>

<?php if ($recordatorioHoy): ?>
    <div class="alert alert-primary mt-3">
        ⚠️ ¡Recordatorio! Tenés una tarea que realizar hoy.
    </div>
<?php endif;

//SUBTAREA
$VencenEn3DiasSubtarea = false;


foreach ($subtareas as $s) :
    // Verificar vencimiento (3 días o menos)
    $fechaVencimiento = strtotime($s['fecha_vencimiento']);
    $diasRestantes = ($fechaVencimiento - $fechaHoy) / (60 * 60 * 24); 

    if ($diasRestantes <= 3 && $diasRestantes >= 0) {
        $VencenEn3DiasSubtarea = true;
    }
endforeach;
?>

<?php if ($VencenEn3DiasSubtarea): ?>
    <div class="alert alert-danger mt-3">
        ⚠️ ¡Atención! Tenés una subtarea que vence en menos de 3 días. ¡Revisala!
    </div>
<?php endif; ?>

<div class="card text-center">
<div class="card-header">
    <ul class="nav nav-tabs card-header-tabs justify-content-center">
      <li>
        <a class="nav-link active" aria-current="true" href=<?= base_url('/menu/panel'); ?> ><label style="color:red; font-weight: bold;">PANEL </label></a>
      </li>
    </ul>
</div><br>
<h3 class="my-3" id="titulo" style="margin: 20px;font-family: 'Times New Roman', serif;"> PANEL TAREA - SUBTAREA</h3> 
<table class="encabezado-custom table table-bordered">
  <thead>
  <tr><td colspan="2" class="table-primary text-center"><strong>TAREA </strong></td></tr>
  </thead>
  <tbody>
<!-- TAREA  -->
 <tr><td><strong>ID</strong></td><td><?= $tareas[0]['id']; ?></td></tr>
    <tr><td><strong>Tema</strong></td><td><?= $tareas[0]['tema']; ?></td></tr>
    <tr><td><strong>Descripción</strong></td><td><?= $tareas[0]['descripcion']; ?></td></tr>
    <tr><td><strong>Prioridad</strong></td><td><?= $tareas[0]['prioridad']; ?></td></tr>
    <tr><td><strong>Estado</strong></td><td><?= $tareas[0]['estado']; ?></td></tr>
    <tr><td><strong>Estado actual</strong></td><td><?= $tareas[0]['estado_actualizado']; ?></td></tr>
    <tr><td><strong>Fecha Vencimiento</strong></td>
        <td><?= (new DateTime($tareas[0]['fecha_vencimiento']))->format('d-m-Y'); ?></td></tr>
    <tr><td><strong>Fecha Recordatorio</strong></td>
      <td><?= $tareas[0]['fecha_recordatorio'] != '0000-00-00' ? (new DateTime($tareas[0]['fecha_recordatorio']))->format('d-m-Y') : ''; ?></td></tr>
    <tr><td><strong>Responsable</strong></td><td><?= $tareas[0]['correo']; ?></td></tr>
    <tr><td><strong>Colaborador</strong></td><td><?= $tareas[0]['colaborador']; ?></td></tr>

<!-- SUBTAREAS -->
  <?php foreach ($subtareas as $i => $s): ?>
    <tr><td colspan="2" class="table-secondary text-center"><strong>SUBTAREA <?= $i + 1 ?></strong></td></tr>
    <tr><td><strong>ID</strong></td><td><?= $s['id']; ?></td></tr>
    <tr><td><strong>Descripción</strong></td><td><?= $s['descripcion']; ?></td></tr>
    <tr><td><strong>Prioridad</strong></td><td><?= $s['prioridad']; ?></td></tr>
    <tr><td><strong>Estado</strong></td><td><?= $s['estado']; ?></td></tr>
    <tr><td><strong>Comentario</strong></td><td><?= $s['comentario']; ?></td></tr>
    <tr><td><strong>Fecha Vencimiento</strong></td>
      <td><?= $s['fecha_vencimiento'] != '0000-00-00' ? (new DateTime($s['fecha_vencimiento']))->format('d-m-Y') : ''; ?></td></tr>
    <tr><td><strong>Responsable</strong></td><td><?= $s['responsable']; ?></td></tr>
    <tr><td><strong>Colaborador</strong></td><td><?= $s['colaborador']; ?></td></tr>
  <?php endforeach; ?>
</tbody>
</table> <br>


<a href="#inicio" class="btn btn-secondary" style="position: fixed; bottom: 20px; right: 20px;">
  ⬆ Volver arriba
</a>

<?php
  echo $this->include('plantilla/footer');
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
