<?php date_default_timezone_set('America/Argentina/Buenos_Aires');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Open Source</title>
  <meta name="description" content="The small framework with powerful features">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="<?= csrf_hash() ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('public/img/logo.png') ?>">
  <link rel="shortcut icon" href="<?= base_url('/openSource/public/img/logo.png') ?>" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('/css/menu.css') ?>">
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<!--ALERTA DE MENSAJES -->
<?php if (session()->getFlashdata('mensajeError')): ?>
  <div class="alert alert-danger"><?= session()->getFlashdata('mensajeError') ?></div>
<?php endif; 
 if (session()->getFlashdata('mensaje')): ?>
  <div class="alert alert-success"><?= session()->getFlashdata('mensaje') ?></div>
<?php endif; 
if (session()->getFlashdata('error')): ?>
  <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<div id="inicio"></div>
<?= $this->include('plantilla/navbar'); ?><br>
<div class="alert alert-warning" role="alert">
  <strong>Atención:</strong> Este panel es para visualizar y modificar las tareas.
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
<?php endif; ?>


<div class="card text-center">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs justify-content-center">
      <li class="nav-item">
        <a class="nav-link active" href="<?= base_url('/menu/panel'); ?>">Panel</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="<?= base_url('/menu/tareas'); ?>">
          <label style="color:red; font-weight: bold;">TAREAS</label>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="<?= base_url('/menu/subtareas'); ?>">Subtareas</a>
      </li>
    </ul>
  </div>
</div><br>
<?php if (empty($tareas)): ?>
    <div class="alert-info" role="alert">
      En este momento no posee tareas registradas.
    </div>
    <?php
    else:?>
<h3 class="my-4 text-center" id="titulo" style="font-family: 'Times New Roman', serif;">TAREAS</h3>

<!-- Filtro de orden -->
<div class="container-fluid mb-4 d-flex flex-wrap justify-content-center align-items-center">
  <form method="GET" action="<?= base_url('menu/tareas') ?>" class="d-flex flex-wrap justify-content-center align-items-center">
    <label for="ordenar" class="me-2">Ordenar por:</label>
    <select name="ordenar" id="ordenar" class="form-select w-auto">
      <option value="fecha_vencimiento" <?= isset($_GET['ordenar']) && $_GET['ordenar'] == 'fecha_vencimiento' ? 'selected' : ''; ?>>Fecha de Vencimiento</option>
      <option value="prioridad" <?= isset($_GET['ordenar']) && $_GET['ordenar'] == 'prioridad' ? 'selected' : ''; ?>>Prioridad</option>
      <option value="estado" <?= isset($_GET['ordenar']) && $_GET['ordenar'] == 'estado' ? 'selected' : ''; ?>>Estado</option>
    </select>
    <button type="submit" class="btn btn-dark ms-2" style="background-color: #262e5b; color: #fff; text-decoration-style: solid;">Ordenar</button>
  </form>
</div>
<?php 
$correos="";

?>
<div class="container-fluid mb-4">
  <div class="table-responsive">
    <table class="table table-hover encabezado-custom" aria-describedby="titulo">
      <thead>
        <tr>
          <th>ID</th>
          <th>Tema</th>
          <th>Descripción</th>
          <th>Prioridad</th>
          <th>Estado</th>
          <th>Fecha Vencimiento</th>
          <th>Fecha Recordatorio</th>
          <th >Responsable</th>
          <th >Colaborador</th>
          <th colspan="4">Acciones</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($tareas as $t): if (empty($t['estado_actualizado'])): ?>
  <?php
  //ARCHIVAR TAREA:
    // Filtrar subtareas de esta tarea
    $subtareasDeEstaTarea = array_filter($subtareas, fn($s) => $s['tarea'] == $t['id']);

    // Verificar cuántas están completadas
    $completadas = array_filter($subtareasDeEstaTarea, fn($s) => $s['estado'] === 'Completada');
    
    // Condición: o todas las subtareas están completadas, o no hay subtareas y la tarea está completada
$puedeArchivar = (
    (count($subtareasDeEstaTarea) > 0 && count($completadas) === count($subtareasDeEstaTarea)) ||
    (count($subtareasDeEstaTarea) === 0 && $t['estado'] === 'Completada')
) && trim($t['estado_actualizado']) !== 'Archivada';
  ?>
        
        <tr>
          <td><?= $t['id']; ?></td>
          <td><?= $t['tema']; ?></td>
          <td><?= $t['descripcion']; ?></td>
          <td><?= $t['prioridad']; ?></td>
          <td><?= $t['estado']; ?></td>
          <td><?= (new DateTime($t['fecha_vencimiento']))->format('d-m-Y'); ?></td>
          <td>
            <?= ($t['fecha_recordatorio'] != '0000-00-00') ? (new DateTime($t['fecha_recordatorio']))->format('d-m-Y') : ''; ?>
          </td>
          <td><?= $t['correo']; ?></td>
        <td><?= $t['colaborador']; ?></td>
                <?php
        if ($puedeArchivar):?> 
        <td>
        <a href="<?= site_url('menu/panel_completo/' . $t['id']); ?>"class="btn btn-secondary btn-sm">🗃️ Archivar</a>
        </td>
       <?php else:?>
        <td> </td>
        <?php endif; ?>
          <td><a href="<?= site_url('menu/tarea/' . $t['id']); ?>" class="btn btn-success btn-sm">✏️ Modificar</a></td>
          <td> <a href="<?= site_url('formularios-tarea/enviartarea/' . $t['id']); ?>" class="btn btn-primary btn-sm">🔗 Compartir</a></td>
           <?php if ($t['correo'] == session()->get('usuario')): ?>
          <td><a href="<?= site_url('menu/tareas/' . $t['id']); ?>" class="btn btn-danger btn-sm">🗑️ Eliminar</a></td>
        <?php  endif; ?>
        </tr>
        <?php endif; endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<a href="#inicio" class="btn btn-secondary" style="position: fixed; bottom: 20px; right: 20px;">
  ⬆ Volver arriba
</a>
<?php endif; ?>
<?= $this->include('plantilla/footer'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
