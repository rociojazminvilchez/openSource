<?php date_default_timezone_set('America/Argentina/Buenos_Aires'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Open Source</title>
  <meta name="description" content="Open Source ofrece herramientas para que organices tus tareas.">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('public/img/logo.png') ?>">
  <link rel="shortcut icon" href="<?= base_url('/openSource/public/img/logo.png') ?>" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<?php
  echo $this->include('plantilla/navbar');
?><br>
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

<!-- ALERTA TAREA | SUBTAREA -->
<?php if (session()->has('usuario')): ?>

<?php
  $fechaHoy = strtotime(date('Y-m-d')); // Fecha actual 
  $tareasVencenPronto = [];
  $tareasRecordatorio = [];
  
  foreach ($tareas as $t) :
    $fechaVencimiento = strtotime($t['fecha_vencimiento']);
    $diasRestantes = ($fechaVencimiento - $fechaHoy) / (60 * 60 * 24); 

    $fechaRecordatorio = strtotime($t['fecha_recordatorio']);
    $esHoy = ($fechaRecordatorio - $fechaHoy) / (60 * 60 * 24); 

    if ($diasRestantes <= 3 && $diasRestantes >= 0) {
      $tareasVencenPronto[] = $t['id'];  
    }

    if ($esHoy>= 0) {
      $tareasRecordatorio[] = $t['id'];  
    }
  endforeach;
/* ALERTA TAREA VENCIMIENTO (Si faltan 3 dias o menos) */
  if (!empty($tareasVencenPronto)): 
     foreach ($tareasVencenPronto as $id_tarea): ?>
        <div class="alert alert-danger mt-3">
          ⚠️ ¡Atención! La <strong>TAREA <?= $id_tarea ?></strong> vence en menos de 3 días. ¡Revisala!
        </div>
    <?php endforeach; 
  endif; 
/* ALERTA TAREA RECORDATORIO */
  if (!empty($tareasRecordatorio)): 
     foreach ($tareasRecordatorio as $id_tarea): ?>
        <div class="alert alert-primary mt-3">
          ⚠️ ¡Recordatorio! Tenes una <strong>TAREA <?= $id_tarea ?></strong> que realizar hoy.
        </div>
    <?php endforeach; 
  endif; 
?>

<!-- ALERTA SUBTAREA VENCIMIENTO (Si faltan 3 dias o menos) -->
<?php
  $fechaHoy = strtotime(date('Y-m-d'));
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

<?php endif; ?>


<section style="text-align: center;">
  <h3>Organiz&aacute tus tareas como un profesional </h3>
  Bienvenida a tu nueva herramienta para la organización personal y en equipo.<br>
  Nuestro sistema te permite crear, gestionar y compartir tareas de forma simple, ordenada y eficiente.<br>
</section>

<div class="container px-4 py-5" id="featured-3">
  <div class="row g-4 py-5 row-cols-1 row-cols-md-2 row-cols-lg-3">
    <!-- Gestión de cuentas de usuario-->
    <div class="feature col text-center">
      <div class="fs-1 mb-3">👤</div>
      <h3 class="fs-4">Gesti&oacuten de cuentas</h3>
      <p>Cre&aacute tu cuenta personal y accedé a tus tareas desde cualquier lugar. Todo tu trabajo, siempre a mano.</p>
    </div>

    <!-- Creacion y gestion de tareas -->
    <div class="feature col text-center">
      <div class="fs-1 mb-3">📝</div>
      <h3 class="fs-4">Gesti&oacuten de tareas</h3>
      <p>Generá tareas f&aacutecilmente, asignales prioridad, fechas de vencimiento y colores para una mejor visualizaci&oacuten.</p>
    </div>

    <!-- Creacion y gestion de subtareas -->
    <div class="feature col text-center">
      <div class="fs-1 mb-3">🧩</div>
      <h3 class="fs-4">Subtareas inteligentes</h3>
      <p>Divid&iacute tus tareas en pasos m&aacutes pequeños, asign&aacute responsables y hac&eacute seguimiento del estado de cada una.</p>
    </div>

    <!-- Cambio de estado de las tareas -->
    <div class="feature col text-center">
      <div class="fs-1 mb-3">🔄</div>
      <h3 class="fs-4">Cambio de estado</h3>
      <p>Marc&aacute tareas como "en proceso" o "completadas" con un solo clic. Visualiz&aacute tu progreso en tiempo real.</p>
    </div>

    <!-- Interaccion con colaboradores -->
    <div class="feature col text-center">
      <div class="fs-1 mb-3">🤝</div>
      <h3 class="fs-4">Colaboración en equipo</h3>
      <p>Compart&iacute tareas con otros usuarios por correo electr&oacutenico. Trabaj&aacute de manera clara y organizada.</p>
    </div>

    <!-- Archivadar tareas completadas -->
    <div class="feature col text-center">
      <div class="fs-1 mb-3">📁</div>
      <h3 class="fs-4">Archivado</h3>
      <p>Archiv&aacute tareas finalizadas para mantener tu panel limpio. Pod&eacutes consultarlas cuando las necesites.</p>
    </div>
  </div>
</div>
<?php
  echo $this->include('plantilla/footer');
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
