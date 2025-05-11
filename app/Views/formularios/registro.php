<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Open Source</title>
  <meta name="description" content="Formulario de registro de usuario en Open Source. Creá tu cuenta para acceder a todas las funcionalidades.">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <a href="<?= base_url('/') ?>" class="btn-close" aria-label="Cerrar"></a>
  </div>

  <p class="text-start text-muted"><span class="text-danger">*</span> Campos obligatorios</p>
  <h4 class="text-start" style="text-align:center;">Datos de registro</h4>

  <div class="row justify-content-center mt-3">
    <div class="col-md-6">
      <form action="<?= base_url('home/create'); ?>" method="POST" enctype="multipart/form-data" autocomplete="off" class="p-4 bg-white shadow rounded">
        <div class="mb-3">
          <label class="form-label"><span class="text-danger">*</span> Nombre</label>
          <input type="text" name="nombre" class="form-control" value="<?= old('nombre') ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label"><span class="text-danger">*</span> Apellido</label>
          <input type="text" name="apellido" class="form-control" value="<?= old('apellido') ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label"><span class="text-danger">*</span> E-mail</label>
          <input type="email" name="email" class="form-control" value="<?= old('email') ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label"><span class="text-danger">*</span> Contraseña</label>
          <input type="password" name="contra" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label"><span class="text-danger">*</span> Confirmar contraseña</label>
          <input type="password" name="contra2" class="form-control" required>
        </div>

        <div class="d-grid">
          <input type="submit" name="registro" value="REGISTRARSE" class="btn text-white" style="background-color: #262e5b;">
        </div>
      </form>
    </div>
  </div>
</div>

<?= $this->include('plantilla/footer') ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
