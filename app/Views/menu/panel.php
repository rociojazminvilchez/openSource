<?php date_default_timezone_set('America/Argentina/Buenos_Aires');
?>
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
<div class="alert alert-warning" role="alert">
  <strong>Atención:</strong> Este panel es para visualizar las tareas destacadas.
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
        <a class="nav-link active" href="<?= base_url('/menu/panel'); ?>">
          <label style="color:red; font-weight: bold;">PANEL </label>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="<?= base_url('/menu/tareas'); ?>"> Tareas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="<?= base_url('/menu/subtareas'); ?>"> Subtareas</a>
      </li>
    </ul>
  </div><br>

  <?php if (empty($tareas) && empty($subtareas)): ?>
    <div class="alert-info" role="alert">
      En este momento no posee tareas registradas.
    </div>
    <?php
    else:?>
  <h3 class="my-3" id="titulo" style="margin: 20px;font-family: 'Times New Roman', serif;"> PANEL </h3>

  <?php
  function getTextColor($bgColor) {
    $hex = str_replace('#', '', $bgColor);
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
    $brightness = ($r * 299 + $g * 587 + $b * 114) / 1000;
    return $brightness > 125 ? 'black' : 'white';
  }
  ?>

<div class="container-fluid py-3">
  <div class="row justify-content-center g-3">
   
   <?php  
foreach ($tareas as $t) :
  if ($t['estado_actualizado'] == '' || $t['estado_actualizado']=='Vencida') {
    $fechaHoy = new DateTime();
    $fechaVenc = new DateTime($t['fecha_vencimiento']);
    $diasVenc = $fechaHoy->diff($fechaVenc)->format('%r%a');

    // Si no hay recordatorio, se asigna un valor alto para evitar errores
    $diasRecordatorio = 99;
    if (!empty($t['fecha_recordatorio'])) {
      $fechaRec = new DateTime($t['fecha_recordatorio']);
      $diasRecordatorio = $fechaHoy->diff($fechaRec)->format('%r%a');
    }

    if ($t['estado_actualizado'] === 'Vencida') {
      $color = '#FFA500'; // Naranja - Tareas vencidas 
      $textColor = getTextColor($color);
    } elseif (
      $t['prioridad'] === 'Alta' || ($diasVenc >= 0 && $diasVenc < 3) || ($diasRecordatorio >= 0)
    ) {
      $color = '#ED4545'; // Rojo - Alta prioridad | recordatorio | faltan 3 dias del vencimiento
      $textColor = getTextColor($color);
    } else {
      $color = match($t['prioridad']) {
        'Baja' => '#14DE68', //Verde - Prioridad baja
        'Normal' => '#EBD723', //Amarillo - Prioridad normal
        default => $t['color'] };
      $textColor = getTextColor($color);
    }
?>

  <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex">
    <div class="card flex-fill" style="background:<?= $color ?>; color: <?= $textColor ?>;">
      <div class="card-body d-flex flex-column">
        <p class="card-text text-start">
          Vencimiento: <?= (new DateTime($t['fecha_vencimiento']))->format('d-m-Y'); ?>
        </p>
        <h5 class="card-title"><?= $t['tema']; ?></h5>
        <p class="card-text"><?= $t['descripcion']; ?></p>
        <h6><u>Prioridad: <?= $t['prioridad']; ?></u></h6>
        <h6><u>Estado: <?= $t['estado']; ?></u></h6>
        <?php $subtareasCount = [];
        foreach ($subtareas as $s) {
          if ($t['id'] == $s['tarea']) {
           if (!isset($subtareasCount[$t['id']])) {
              $subtareasCount[$t['id']] = 1;
            } else {
             $subtareasCount[$t['id']]++;
            }
          }
        }
        if (isset($subtareasCount[$t['id']])) {
          $count = $subtareasCount[$t['id']];
        ?>
        <a href="<?= base_url('/menu/panel_completo/' . $t['id'] . '/' . $t['id']); ?>" class="btn btn-light btn-sm fw-bold mt-auto">
          SUBTAREAS (<?= $count ?>)
        </a>
        <?php } ?>
            </div>
          </div>
        </div>
      <?php } endforeach; ?>
    </div>
  </div>
</div>
<!-- BOTÓN FLOTANTE -->
<a href="#inicio" class="btn btn-secondary" style="position: fixed; bottom: 20px; right: 20px;">
  ⬆ Volver arriba
</a>
<?php endif; ?>
<?= $this->include('plantilla/footer'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
