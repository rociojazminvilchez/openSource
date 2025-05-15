<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Open Source</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Formulario para crear nuevas tareas">
  <link rel="icon" href="<?= base_url('/openSource/public/img/logo.png') ?>">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('/css/formularios.css') ?>">
</head>
<body>

<?= $this->include('plantilla/navbar') ?>
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

<div class="container mt-4 mb-5">
  <div class="d-flex justify-content-end">
    <a href="<?= base_url('menu/tareas') ?>" class="btn-close" aria-label="Cerrar"></a>
  </div>

<h4 class="text-start mb-4">📝 Datos de la tarea</h4>
<?php $t = $tareas[0]; ?>

<div class="row justify-content-center">
  <div class="col-md-10 col-lg-8">
    <form action="tareas/enviar" method="POST" enctype="multipart/form-data" autocomplete="off" class="p-4 bg-white shadow rounded border border-light">
    <?= csrf_field() ?>  
    <input type="hidden" name="id" value="<?= esc($t['id']) ?>">
    <div class="mb-4">
      <div class="card shadow-sm border-0">
        <div class="card-body">
          <h5 class="card-title text-primary">Tema</h5>
          <p class="card-text"><?= esc($t['tema']) ?></p>
          <input type="hidden" name="tema" value="<?= esc($t['tema']) ?>">
        </div>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label fw-bold">Descripción</label>
      <div class="form-control-plaintext"><?= esc($t['descripcion']) ?></div>
      <input type="hidden" name="descripcion" value="<?= esc($t['descripcion']) ?>">
    </div>

    <div class="mb-3">
      <label class="form-label fw-bold">Prioridad</label>
      <div class="form-control-plaintext"><?= esc($t['prioridad']) ?></div>
      <input type="hidden" name="prioridad" value="<?= esc($t['prioridad']) ?>">
    </div>

    <div class="mb-3">
      <label class="form-label fw-bold">Estado</label>
      <div class="form-control-plaintext"><?= esc($t['estado']) ?></div>
      <input type="hidden" name="estado" value="<?= esc($t['estado']) ?>">
    </div>

    <div class="mb-3">
      <label class="form-label fw-bold">Fecha de vencimiento</label>
      <div class="form-control-plaintext"> <?= esc(new DateTime($t['fecha_vencimiento']))->format('d-m-Y'); ?></div>
      <input type="hidden" name="fecha_vencimiento" value="<?= esc($t['fecha_vencimiento']) ?>">
    </div>

    <div class="mb-3">
      <label class="form-label fw-bold">Fecha de recordatorio</label>
      <div class="form-control-plaintext">
        <?php if (!empty($t['fecha_recordatorio']) && $t['fecha_recordatorio'] !== '0000-00-00'): ?>
          <?= esc((new DateTime($t['fecha_recordatorio']))->format('d-m-Y')); ?>
          <?php else: ?>
             <span class="text-muted">Sin recordatorio</span>
    <?php endif; ?>
    </div>
    <input type="hidden" name="fecha_recordatorio" value="<?= esc($t['fecha_recordatorio']) ?>">
    </div>


    <div class="mb-4">
      <label for="recipients" class="form-label fw-bold">Colaboradores</label>
      <input type="text" class="form-control" id="recipients" name="correos" placeholder="email1@gmail.com, email2@gmail.com">
      <small class="form-text text-muted">Separá los correos por coma.</small>
    </div>

    <div class="d-grid">
      <button type="submit" name="compartir" class="btn text-white" style="background-color: #262e5b;">COMPARTIR</button>
    </div>
  </form>
</div>
</div>

<?= $this->include('plantilla/footer') ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>