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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('/css/menu.css') ?>">
</head>
<body>
<div id="inicio"></div>
<?= $this->include('plantilla/navbar'); ?><br>

<div class="container-fluid contenido-limitado">
  <div class="alert alert-warning" role="alert">
    <strong>Atención:</strong> Este panel es para visualizar el historial de las subtareas.
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
      <ul class="nav nav-tabs card-header-tabs justify-content-center flex-wrap">
        <li class="nav-item">
          <a class="nav-link active" href="<?= base_url('/menu/historial_tareas'); ?>">Tareas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="<?= base_url('/menu/historial_subtareas'); ?>">
            <label style="color:red; font-weight: bold;">SUBTAREAS</label>
          </a>
        </li>
      </ul>
    </div>
  </div><br>
  <?php if (empty($subtareas)): ?>
    <div class="alert-info" role="alert">
      En este momento no posee subtareas registradas.
    </div>
    <?php
    else:?>
  <h3 class="text-center my-3" id="titulo" style="font-family: 'Times New Roman', serif;">HISTORIAL SUBTAREAS</h3>

<!-- Formulario de ordenamiento -->
  <form method="GET" action="<?= base_url('menu/historial_subtareas') ?>" class="d-flex flex-wrap align-items-center gap-2 justify-content-center mb-4">
    <label for="ordenar" class="form-label m-0">Ordenar por:</label>
    <select name="ordenar" id="ordenar" class="form-select w-auto">
      <option value="fecha_vencimiento" <?= isset($_GET['ordenar']) && $_GET['ordenar'] == 'fecha_vencimiento' ? 'selected' : ''; ?>>Fecha de Vencimiento</option>
      <option value="prioridad" <?= isset($_GET['ordenar']) && $_GET['ordenar'] == 'prioridad' ? 'selected' : ''; ?>>Prioridad</option>
      <option value="estado" <?= isset($_GET['ordenar']) && $_GET['ordenar'] == 'estado' ? 'selected' : ''; ?>>Estado</option>
    </select>
    <button type="submit" class="btn btn-dark" style="background-color: #262e5b; color: #fff; text-decoration-style: solid;">Ordenar</button>
  </form>

  <div class="table-responsive">
    <table class="table encabezado-custom" aria-describedby="titulo">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Descripcion</th>
          <th scope="col">Estado</th>
          <th scope="col">Prioridad</th>
          <th scope="col">Fecha Vencimiento</th>
          <th scope="col">Comentario</th>
          <th scope="col">Responsable</th>
          <th scope="col">Colaborador</th>
          <th scope="col">Tarea</th>
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
              <?= ($s['fecha_vencimiento'] != '0000-00-00') ? (new DateTime($s['fecha_vencimiento']))->format('d-m-Y') : ''; ?>
            </td>
            <td><?= $s['comentario']; ?></td>
            <td><?= $s['responsable']; ?></td>
            <td><?= $s['colaborador']; ?></td>
            <td>
              <a href="<?= base_url('/menu/panel_completo/' . $s['tarea'] . '/' . $s['tarea']); ?>" class="btn btn-danger">Mostrar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<!-- Botón para volver arriba -->
<a href="#inicio" class="btn btn-secondary" style="position: fixed; bottom: 20px; right: 20px;">
  ⬆ Volver arriba
</a>
<?php endif; ?>
<?= $this->include('plantilla/footer'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>