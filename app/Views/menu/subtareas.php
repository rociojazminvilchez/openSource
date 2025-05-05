<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Open Source</title>
  <meta name="description" content="The small framework with powerful features">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="<?= base_url('/openSource/public/img/logo.png') ?>" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('/css/formularios.css') ?>">
  <style>
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
<?= $this->include('plantilla/navbar'); ?><br>
<?php if (session()->getFlashdata('mensaje')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('mensaje') ?>
    </div>
<?php endif; ?>
<div class="alert alert-warning" role="alert">
  <strong>Atención:</strong> Este panel es para visualizar y modificar las subtareas.
</div>

<div class="card text-center">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs justify-content-center">
      <li>
        <a class="nav-link active" href="<?= base_url('/menu/panel'); ?>"> Panel </a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="<?= base_url('/menu/tareas'); ?>"> Tareas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="<?= base_url('/menu/subtareas'); ?>"><label style="color:red; font-weight: bold;">SUBTAREAS</label></a>
      </li>
    </ul>
  </div><br>
  <?php if (empty($subtareas)): ?>
    <div class="alert-info" role="alert">
      En este momento no posee subtareas registradas.
    </div>
    <?php
    else:?>
  <h3 class="my-3" id="titulo" style="margin: 20px;font-family: 'Times New Roman', serif;"> SUBTAREAS </h3> 

  <div class="container-fluid mb-4">
    <div class="table-responsive">
      <table class="table table-hover encabezado-custom" aria-describedby="titulo">
        <thead>
          <tr>
            <th>ID</th>
            <th>Descripción</th>
            <th>Estado</th>
            <th>Prioridad</th>
            <th>Fecha Vencimiento</th>
            <th>Comentario</th>
            <th>Responsable</th>
            <th colspan="4">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($subtareas as $s) : ?>
            <tr>
              <td><?= $s['id']; ?></td>
              <td><?= $s['descripcion']; ?></td>
              <td><?= $s['estado']; ?></td>
              <td><?= $s['prioridad']; ?></td>
              <td>
                <?php if ($s['fecha_vencimiento'] != '0000-00-00') : ?>
                  <?= (new DateTime($s['fecha_vencimiento']))->format('d-m-Y'); ?>
                <?php endif; ?>
              </td>
              <td><?= $s['comentario']; ?></td>
              <td><?= $s['responsable']; ?></td>
              
              <?php if($s['estado']!='Completada'){
                ?> <td> <a href="<?= site_url('menu/subtareas/' . $s['id'] . '/' . $s['tarea']) ?>" class="btn btn-secondary btn-sm">✅ Completada</a></td>
                <?php
              }else{
                ?> <td> </td> <?php
              }
              ?> 
              <td> <a href="<?= site_url('menu/subtarea/' . $s['id']); ?>" class="btn btn-success btn-sm">✏️ Modificar</a> </td>
             <td><button class="btn btn-primary btn-sm">🔗 Compartir</button></td>
             <td><a href="<?= site_url('menu/subtareas/' . $s['id']); ?>" class="btn btn-danger btn-sm">🗑️ Eliminar</a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<a href="#inicio" class="btn btn-secondary" style="position: fixed; bottom: 20px; right: 20px;">
  ⬆ Volver arriba
</a>
<?php endif; ?>

<?= $this->include('plantilla/footer'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
