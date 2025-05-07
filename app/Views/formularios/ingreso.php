<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Open Source</title>
  <meta name="description" content="Accedé a tu cuenta en Open Source. Ingreso seguro para usuarios registrados.">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="<?= base_url('/openSource/public/img/logo.png') ?>">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('/css/formularios.css') ?>">
</head>
<body class="bg-light">
<?= $this->include('plantilla/navbar') ?>
<div class="container mt-5">
<?php if (session()->getFlashdata('mensajeError')): ?>
  <div class="alert alert-danger"><?= session()->getFlashdata('mensajeError') ?></div>
<?php endif; ?>

<?php if (session()->getFlashdata('mensaje')): ?>
  <div class="alert alert-success"><?= session()->getFlashdata('mensaje') ?></div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
  <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<div class="d-flex justify-content-end">
  <a href="<?= base_url('/') ?>" class="btn-close" aria-label="Cerrar"></a>
</div>
<div class="row justify-content-center">
  <div class="col-md-6 col-sm-10">
    <form action="<?= base_url('/home/login') ?>" method="POST" class="p-4 bg-white shadow rounded">
      <h2 class="mb-4 text-center">Iniciar sesión</h2>
        <div class="mb-3">
          <label for="usuario" class="form-label">E-mail:</label>
          <input type="email" name="usuario" id="usuario" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="contra" class="form-label">Contraseña:</label>
          <input type="password" name="contra" id="contra" class="form-control" required>
        </div>

        <div class="d-grid">
          <input type="submit" name="ingresar" value="INGRESAR" class="btn text-white" style="background-color: #262e5b;">
        </div>
      </form>
    </div>
  </div>
</div>

<?= $this->include('plantilla/footer') ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
