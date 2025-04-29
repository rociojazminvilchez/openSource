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
    <style>
  .card {
    border-radius: 1rem;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }

  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
  }

  .card-body h5 {
    font-weight: bold;
    font-size: 1.25rem;
  }

  .card-body p {
    margin-top: 0.5rem;
    margin-bottom: 1rem;
  }

  .text-muted {
    font-size: 0.9rem;
  }
</style>
  </head>
<body>
<?php
  echo $this->include('plantilla/navbar');
?><br>
<div class="alert alert-warning" role="alert">
  <strong>Atención:</strong> Este panel es para visualizar las tareas y subtareas.
</div>
<div class="card text-center">
<div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li>
        <a class="nav-link active" aria-current="true" href=<?= base_url('/menu/panel'); ?> ><label style="color:red; font-weight: bold;">* Panel </label></a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" aria-current="true" href=<?= base_url('/menu/tareas'); ?>> Tareas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" aria-current="true" href=<?= base_url('/menu/subtareas'); ?>> Subtareas</a>
      </li>
    </ul>
  </div><br>
  <h3 class="my-3" id="titulo" style="margin: 20px;font-family: 'Times New Roman', serif;"> PANEL </h3> 

  <?php
function getTextColor($bgColor) {
    // Simple algoritmo de contraste (solo para fondo claro u oscuro)
    $hex = str_replace('#', '', $bgColor);
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
    $brightness = ($r * 299 + $g * 587 + $b * 114) / 1000;
    return $brightness > 125 ? 'black' : 'white';
}
?>

<div class="d-flex flex-wrap gap-3 px-3 py-3 justify-content-center">
  <?php foreach ($tareas as $t) : 
     if($t['estado_actualizado']==''){ ?>   
    <?php
    $color = match($t['color']) {
        'red' => '#ED4545',
        'green' => '#14DE68',
        'yellow' => '#EBD723',
        default => $t['color']
    };
    $textColor = getTextColor($color);
    ?>
    <div class="card" style="width: 18rem; background:<?= $color ?>; color: <?= $textColor ?>;">
      <div class="card-body">
        <p class="card-text" style="text-align:left;">
          <?= (new DateTime($t['fecha_vencimiento']))->format('d-m-Y'); ?>
        </p>
        <h5 class="card-title"><?= $t['tema']; ?></h5>
        <p class="card-text"><?= $t['descripcion']; ?></p>
        <h6><u>Prioridad: <?= $t['prioridad']; ?></u></h6>
        <h6><u>Estado: <?= $t['estado']; ?></u></h6>
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
    <a href="<?= base_url('/menu/panel_completo/' . $t['id'] . '/' . $t['id']); ?>" class="btn btn-light btn-sm fw-bold">
      SUBTAREAS (<?= $count ?>)
    </a><br><br>
   <?php } ?>
   </div>
  </div>
  <?php } endforeach; ?>
</div>



<?php
  echo $this->include('plantilla/footer');
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
