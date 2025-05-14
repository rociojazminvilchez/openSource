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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('/css/menu.css') ?>">
</head>
<body>
<div id="inicio"></div>
<?= $this->include('plantilla/navbar'); ?><br>

<div class="container-fluid contenido-limitado">
  <div class="alert alert-warning" role="alert">
    <strong>Atención:</strong> Este panel es para visualizar el historial de las tareas.
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
        <ul class="nav nav-tabs card-header-tabs justify-content-center flex-wrap">
        <li>
            <a class="nav-link active" href="<?= base_url('/menu/historial_tareas'); ?>"><label style="color:red; font-weight: bold;">TAREAS </label></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="<?= base_url('/menu/historial_subtareas'); ?>"> Subtareas </a>
          </li>
        </ul>
    </div><br>
    <?php if (empty($tareas)): ?>
    <div class="alert-info" role="alert">
      En este momento no posee tareas registradas.
    </div>
    <?php
    else:?>
    <h3 class="text-center my-3" id="titulo" style="font-family: 'Times New Roman', serif;"> HISTORIAL TAREAS </h3> 

<!-- Formulario de orden -->
  <form method="GET" action="<?= base_url('menu/historial_tareas') ?>" class="d-flex flex-wrap align-items-center gap-2 justify-content-center mb-4"> 
    <label for="ordenar" class="me-2">Ordenar por:</label>
      <select name="ordenar" id="ordenar" class="form-select w-auto">
          <option value="fecha_vencimiento" <?= isset($_GET['ordenar']) && $_GET['ordenar'] == 'fecha_vencimiento' ? 'selected' : ''; ?>>Fecha de Vencimiento</option>
          <option value="estado" <?= isset($_GET['ordenar']) && $_GET['ordenar'] == 'estado' ? 'selected' : ''; ?>>Estado</option>
      </select>
    <button type="submit" class="btn btn-dark ms-2" style="background-color: #262e5b; color: #fff; text-decoration-style: solid;">Ordenar</button>
  </form><br>

<div class="table-responsive">
  <table class="table encabezado-custom" aria-describedby="titulo">
    <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Tema</th>
      <th scope="col">Descripción</th>
      <th scope="col">Prioridad</th>
      <th scope="col">Estado</th>
      <th scope="col">Estado Actual</th>
      <th scope="col">Fecha Vencimiento</th>
      <th scope="col">Fecha Recordatorio</th>
      <th scope="col">Responsable</th>
      <th scope="col">Colaborador</th>
      <th scope="col">SUBTAREA</th>
    </tr>
    </thead>
    <tbody>
      <?php foreach ($tareas as $t) : ?>
      <tr>
        <td><?= $t['id']; ?></td>
        <td><?= $t['tema']; ?></td>
        <td><?= $t['descripcion']; ?></td>
        <td><?= $t['prioridad']; ?></td>
        <td><?= $t['estado']; ?></td>
       <?php if ($t['estado_actualizado'] == 'Archivada' || $t['estado_actualizado'] == 'Vencida'): ?>
    <td>
        <?= $t['estado_actualizado']; ?><br>
        <?php if ($t['correo'] == session()->get('usuario')): ?>
            <a href="<?= site_url('menu/tarea/' . $t['id']); ?>" class="btn btn-success btn-sm">✏️ Modificar</a>
        <?php endif; ?>
    </td>
<?php else: ?>
    <td><?= $t['estado_actualizado']; ?></td>
<?php endif; ?>

        <td><?= (new DateTime($t['fecha_vencimiento']))->format('d-m-Y'); ?></td>
        <?php if($t['fecha_recordatorio']!='0000-00-00'){ ?>
        <td><?= (new DateTime($t['fecha_recordatorio']))->format('d-m-Y'); ?></td>
        <?php } else{ ?>
        <td> </td>
        <?php } ?>
        <td><?= $t['correo']; ?></td>
        <td><?= $t['colaborador']; ?></td>
        <td>
        <?php
        $subtareasCount = [];  // Nro de subtareas
        foreach ($subtareas as $s):
          if ($t['id'] == $s['tarea']) {
            if (!isset($subtareasCount[$t['id']])) {
              $subtareasCount[$t['id']] = 1;
            } else {
              $subtareasCount[$t['id']]++;
            }
          }
          endforeach;
          // Boton
          if (isset($subtareasCount[$t['id']])) {
          $count = $subtareasCount[$t['id']]; ?>
          <a href="<?= base_url('/menu/panel_completo/' . $t['id'] . '/' . $t['id']); ?>" class="btn btn-danger">
            Mostrar (<?= $count ?>)
          </a><br><br>
         <?php } ?>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table><br>
</div>
</div>
<!-- Botón para volver arriba -->
<a href="#inicio" class="btn btn-secondary" style="position: fixed; bottom: 20px; right: 20px;">
  ⬆ Volver arriba
</a>
<?php endif; ?>
<?php
  echo $this->include('plantilla/footer');
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
