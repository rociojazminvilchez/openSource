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
    .encabezado-custom thead th {
    background-color: #262e5b; 
    padding: 10px;
    text-align: center;
   color: white;
   }

  .encabezado-custom tbody td {
    padding: 8px;
    border-bottom: 1px solid #ccc;
   }

  .encabezado-custom tr {
    background-color: transparent; 
  }
  </style>
  </head>
<body>
<?php
  echo $this->include('plantilla/navbar');
?><br>
<div id="inicio"></div>
<div class="alert alert-warning" role="alert">
  <strong>Atención:</strong> Este panel es para visualizar las tareas y subtareas.
</div>
<div class="card text-center">
<div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li>
        <a class="nav-link active" aria-current="true" href=<?= base_url('/menu/panel'); ?> ><label style="color:red; font-weight: bold;">* Panel </label></a>
      </li>
    </ul>
  </div><br>
  <h3 class="my-3" id="titulo" style="margin: 20px;font-family: 'Times New Roman', serif;"> PANEL TAREA - SUBTAREA</h3> 


<!-- TABLA TAREA -->
<table class="encabezado-custom table table-bordered">
  <thead>
  <tr><td colspan="2" class="table-primary text-center"><strong>TAREA </strong></td></tr>
  </thead>
  <tbody>
    <!-- TAREA  -->
    <tr><td><strong>Tema</strong></td><td><?= $tareas[0]['tema']; ?></td></tr>
    <tr><td><strong>Descripción</strong></td><td><?= $tareas[0]['descripcion']; ?></td></tr>
    <tr><td><strong>Prioridad</strong></td><td><?= $tareas[0]['prioridad']; ?></td></tr>
    <tr><td><strong>Estado</strong></td><td><?= $tareas[0]['estado']; ?></td></tr>
    <tr><td><strong>Fecha Vencimiento</strong></td>
        <td><?= (new DateTime($tareas[0]['fecha_vencimiento']))->format('d-m-Y'); ?></td></tr>
    <tr><td><strong>Fecha Recordatorio</strong></td>
        <td><?= $tareas[0]['fecha_recordatorio'] != '0000-00-00' 
            ? (new DateTime($tareas[0]['fecha_recordatorio']))->format('d-m-Y') : ''; ?></td></tr>
    <tr><td><strong>Responsable</strong></td><td><?= $tareas[0]['correo']; ?></td></tr>

    <!-- SUBTAREAS -->
    <?php foreach ($subtareas as $i => $s): ?>
      <tr><td colspan="2" class="table-secondary text-center"><strong>SUBTAREA <?= $i + 1 ?></strong></td></tr>
      <tr><td><strong>Descripción</strong></td><td><?= $s['descripcion']; ?></td></tr>
      <tr><td><strong>Prioridad</strong></td><td><?= $s['prioridad']; ?></td></tr>
      <tr><td><strong>Estado</strong></td><td><?= $s['estado']; ?></td></tr>
      <tr><td><strong>Comentario</strong></td><td><?= $s['comentario']; ?></td></tr>
      <tr><td><strong>Fecha Vencimiento</strong></td>
          <td><?= $s['fecha_vencimiento'] != '0000-00-00' 
              ? (new DateTime($s['fecha_vencimiento']))->format('d-m-Y') : ''; ?></td></tr>
      <tr><td><strong>Responsable</strong></td><td><?= $s['responsable']; ?></td></tr>
    <?php endforeach; ?>
  </tbody>
</table>

<br>
<div class="d-flex justify-content-center">

</div>
<a href="#inicio" class="btn btn-secondary" style="position: fixed; bottom: 20px; right: 20px;">
  ⬆ Volver arriba
</a>


<?php
  echo $this->include('plantilla/footer');
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
