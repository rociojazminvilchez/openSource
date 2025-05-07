<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Open Source</title>
  <meta name="description" content="Formulario de creación de subtarea">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="<?= base_url('/openSource/public/img/logo.png') ?>">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('/css/formularios.css') ?>">
</head>
<body>

<?= $this->include('plantilla/navbar') ?>
<?php if (session()->getFlashdata('mensaje')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('mensaje') ?>
    </div>
<?php endif; ?>
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

  <p class="text-start text-muted"><span class="text-danger">*</span> Campos obligatorios</p>
  <h4 class="text-start mb-4">Modificar Subtarea</h4>
  <?php $s = $subtareas[0]; ?>

  <div class="row justify-content-center">
    <div class="col-md-8">
      <form action="<?= base_url('menu/subtareas/update/' . $s['id']); ?>" method="POST" enctype="multipart/form-data" autocomplete="off" class="p-4 bg-white shadow rounded">
        <div class="mb-3">
          <label class="form-label"><span class="text-danger">*</span> Descripción</label>
          <input type="text" name="descripcion" class="form-control" value="<?= esc($s['descripcion']); ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label"><span class="text-danger">*</span> Estado</label>
          <select name="estado" class="form-select" required>
            <option value="1" <?= ($s['estado'] === 'Definido') ? 'selected' : '' ?>>Definido</option>
            <option value="2" <?= ($s['estado'] === 'En proceso') ? 'selected' : '' ?>>En proceso</option>
            <option value="3" <?= ($s['estado'] === 'Completada') ? 'selected' : '' ?>>Completada</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Prioridad</label>
          <select name="prioridad" class="form-select">
            <option value="">-</option>
            <option value="baja" <?= ($s['prioridad'] === 'Baja') ? 'selected' : '' ?>>Baja</option>
            <option value="normal" <?= ($s['prioridad'] === 'Normal') ? 'selected' : '' ?>>Normal</option>
            <option value="alta" <?= ($s['prioridad'] === 'Alta') ? 'selected' : '' ?>>Alta</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Fecha de vencimiento</label>
          <input type="date" name="vencimiento" class="form-control" value="<?= esc($s['fecha_vencimiento']); ?>">
        </div>

        <div class="mb-3">
          <label class="form-label"><span class="text-danger">*</span> Comentario</label>
          <input type="text" name="comentario" class="form-control" value="<?= esc($s['comentario']); ?>" required>
        </div>

        <div class="d-grid">
          <button type="submit" name="modificar" class="btn text-white" style="background-color: #262e5b;">MODIFICAR</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?= $this->include('plantilla/footer') ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
