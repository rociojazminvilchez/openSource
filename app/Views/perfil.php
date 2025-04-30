<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Open Source</title>
  <meta name="description" content="The small framework with powerful features">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="<?= base_url('/openSource/public/img/logo.png') ?>">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('/css/formularios.css') ?>">
</head>
<body>

<?= $this->include('plantilla/navbar'); ?>

<div class="alert alert-warning text-center" role="alert">
  <strong>Atención:</strong> Este panel es para actualizar información.
</div>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
      <form action="<?= base_url('/perfil'); ?>" method="POST" enctype="multipart/form-data" autocomplete="off" class="bg-light p-4 rounded shadow">

        <div class="d-flex justify-content-end">
          <a href="<?= base_url('/') ?>" class="btn-close" aria-label="Cerrar"></a>
        </div>

        <?php if (session()->get('errors')): ?>
          <div class="alert alert-danger">
            <ul class="mb-0">
              <?php foreach (session()->get('errors') as $error): ?>
                <li><?= esc($error) ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>

        <?php foreach ($usuario as $us): ?>
          <h5 class="text-center text-danger">Actualizar información</h5>
          <p class="text-start text-muted"><span class="text-danger">*</span> Campos obligatorios</p>

          <h4>Datos personales</h4>

          <div class="mb-3">
            <label class="form-label"><span class="text-danger">*</span> Nombre</label>
            <input type="text" name="nombre" class="form-control" value="<?= esc($us['nombre']) ?>" required>
          </div>

          <div class="mb-3">
            <label class="form-label"><span class="text-danger">*</span> Apellido</label>
            <input type="text" name="apellido" class="form-control" value="<?= esc($us['apellido']) ?>" required>
          </div>

          <h4>Datos de registro</h4>

          <div class="mb-3">
            <label class="form-label">E-mail</label>
            <strong class="form-control-plaintext"><?= esc($us['correo']) ?></strong>
            <input type="hidden" name="email" value="<?= esc($us['correo']) ?>">
          </div>

          <div class="mb-3">
            <label class="form-label"><span class="text-danger">*</span> Contraseña</label>
            <input type="text" name="contra" class="form-control" value="<?= esc($us['contra']) ?>" required>
          </div>

          <div class="mb-3">
            <label class="form-label"><span class="text-danger">*</span> Confirmar contraseña</label>
            <input type="text" name="contra2" class="form-control" value="<?= esc($us['contra2']) ?>" required>
          </div>

        <?php endforeach; ?>

        <div class="d-grid">
          <button type="submit" name="actualizar" class="btn text-white" style="background-color: #262e5b;">ACTUALIZAR</button>
        </div>

      </form>
    </div>
  </div>
</div>

<?= $this->include('plantilla/footer'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
