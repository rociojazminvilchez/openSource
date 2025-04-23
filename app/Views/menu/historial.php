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
   <!-- <link rel="stylesheet" href="<?= base_url('/css/index.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/css/formularios.css') ?>">
-->
  </head>
<body>
<?php
  echo $this->include('plantilla/navbar');
?><br>
<h2 class="text-center mb-4">📝 Mis Tareas</h2>
<div class="row">
  <?php foreach ($tareas as $tarea): ?>
  <div class="col-md-4 mb-4">
    <div class="card border-<?= $tarea['estado'] == 'completa' ? 'success' : 'warning' ?> shadow rounded-3">
      <div class="card-body">
        <h5 class="card-title text-primary">
          📌 <?= esc($tarea['titulo']) ?>
        </h5>
        <p class="card-text"><?= esc($tarea['descripcion']) ?></p>
        <p><strong>📅 Fecha:</strong> <?= esc($tarea['fecha']) ?></p>
        
        <div class="d-flex justify-content-between align-items-center">
          <span class="badge bg-<?= $tarea['estado'] == 'completa' ? 'success' : 'warning' ?>">
            <?= ucfirst($tarea['estado']) ?>
          </span>

          <!-- Botón ficticio para marcar como completada -->
          <?php if ($tarea['estado'] != 'completa'): ?>
            <button class="btn btn-sm btn-success">✅ Completar</button>
          <?php else: ?>
            <button class="btn btn-sm btn-secondary" disabled>✔️ Hecho</button>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>


<?php
  echo $this->include('plantilla/footer');
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
