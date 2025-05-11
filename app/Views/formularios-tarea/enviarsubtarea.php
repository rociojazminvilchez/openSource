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

<div class="container mt-4 mb-5">
  <?php if (session()->get('errors')): ?>
    <div class="alert alert-danger">
      <ul class="mb-0">
        <?php foreach (session()->get('errors') as $error): ?>
          <li><?= esc($error) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

  <div class="d-flex justify-content-end">
    <a href="<?= base_url('menu/subtareas') ?>" class="btn-close" aria-label="Cerrar"></a>
  </div>

<h4 class="text-start mb-4">📝 Datos de la subtarea</h4>
<?php $s = $subtareas[0]; ?>

<div class="row justify-content-center">
  <div class="col-md-10 col-lg-8">
    <form action="subtareas/enviar" method="POST" enctype="multipart/form-data" autocomplete="off" class="p-4 bg-white shadow rounded border border-light">
 <?= csrf_field() ?>  <!-- ESTO ES OBLIGATORIO -->
 <input type="hidden" name="id" value="<?= esc($s['id']) ?>">
      <div class="mb-4">
        <div class="card shadow-sm border-0">
          <div class="card-body">
            <h5 class="card-title text-primary">ID Tarea:</h5>
            <p class="card-text"><?= esc($s['tarea']) ?></p>
            <input type="hidden" name="tarea" value="<?= esc($s['tarea']) ?>">
          </div>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold">Descripción</label>
        <div class="form-control-plaintext"><?= esc($s['descripcion']) ?></div>
        <input type="hidden" name="descripcion" value="<?= esc($s['descripcion']) ?>">
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold">Prioridad</label>
        <div class="form-control-plaintext"><?= esc($s['prioridad']) ?></div>
        <input type="hidden" name="prioridad" value="<?= esc($s['prioridad']) ?>">
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold">Estado</label>
        <div class="form-control-plaintext"><?= esc($s['estado']) ?></div>
        <input type="hidden" name="estado" value="<?= esc($s['estado']) ?>">
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold">Comentario</label>
        <div class="form-control-plaintext"><?= esc($s['comentario']) ?></div>
        <input type="hidden" name="comentario" value="<?= esc($s['comentario']) ?>">
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold">Responsable</label>
        <div class="form-control-plaintext"><?= esc($s['responsable']) ?></div>
        <input type="hidden" name="responsable" value="<?= esc($s['responsable']) ?>">
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold">Fecha de vencimiento</label>
        <div class="form-control-plaintext"><?= esc($s['fecha_vencimiento']) ?></div>
        <input type="hidden" name="fecha_vencimiento" value="<?= esc($s['fecha_vencimiento']) ?>">
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