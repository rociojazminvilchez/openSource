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

    @media (max-width: 576px) {
      .card-body h5 {
        font-size: 1.1rem;
      }

      .card-body p, .card-body h6 {
        font-size: 0.9rem;
      }
    }

  .alert-info {
    background-color: rgb(224, 35, 35); /* Rojo intenso */
    color: white; /* Blanco para mejor contraste */
    padding: 15px 20px;
    border: none; /* Eliminamos el borde celeste */
    border-radius: 6px;
    text-align: center;
    font-weight: bold; /* Letra en negrita */
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Fuente moderna */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra sutil */
}
  </style>
</head>
<body>
<div id="inicio"></div>

<?= $this->include('plantilla/navbar'); ?><br>

<div class="alert alert-warning" role="alert">
  <strong>Atención:</strong> Este panel es para visualizar las tareas destacadas.
</div>

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

  <!-- CONTENEDOR RESPONSIVE DE TARJETAS -->
  <div class="container-fluid py-3">
    <div class="row justify-content-center g-3">
      <?php foreach ($tareas as $t) :
        if ($t['estado_actualizado'] == '') {
          $color = match($t['prioridad']) {
            'Alta' => '#ED4545',
            'Baja' => '#14DE68',
            'Normal' => '#EBD723',
            default => $t['color']
          };
          $textColor = getTextColor($color);
      ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex">
          <div class="card flex-fill" style="background:<?= $color ?>; color: <?= $textColor ?>;">
            <div class="card-body d-flex flex-column">
              <p class="card-text text-start">
                <?= (new DateTime($t['fecha_vencimiento']))->format('d-m-Y'); ?>
              </p>
              <h5 class="card-title"><?= $t['tema']; ?></h5>
              <p class="card-text"><?= $t['descripcion']; ?></p>
              <h6><u>Prioridad: <?= $t['prioridad']; ?></u></h6>
              <h6><u>Estado: <?= $t['estado']; ?></u></h6>

              <?php
              $subtareasCount = [];
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
