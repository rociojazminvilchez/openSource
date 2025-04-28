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



  <table class="encabezado-custom">
    <thead>
      <tr>
        <th class="text-center">Tarea</th>
        <th class="text-center">Subtareas</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <!-- Mostrar una sola tarea -->
        <td rowspan="<?= count($subtareas) > 0 ? count($subtareas) : 1; ?>" class="align-middle">
          <p><strong>TEMA:</strong> <?= $tareas[0]['tema']; ?></p>
          <p><strong>Vencimiento:</strong> <?= (new DateTime($tareas[0]['fecha_vencimiento']))->format('d-m-Y'); ?></p>
          <p><strong>Descripción:</strong> <?= $tareas[0]['descripcion']; ?></p>
          <p><strong>Prioridad:</strong> <?= $tareas[0]['prioridad']; ?></p>
          <p><strong>Estado:</strong> <?= $tareas[0]['estado']; ?></p>
        </td>
        
        <!-- Mostrar la primera subtarea -->
        <td class="align-middle">
          <?php if (isset($subtareas[0])): ?>
            <p><strong>Descripción:</strong> <?= $subtareas[0]['descripcion']; ?></p>
            <p><strong>Vencimiento:</strong> <?= (new DateTime($subtareas[0]['fecha_vencimiento']))->format('d-m-Y'); ?></p>
            <p><strong>Comentario:</strong> <?= $subtareas[0]['comentario']; ?></p>
            <p><strong>Estado:</strong> <?= $subtareas[0]['estado']; ?></p>
            <p><strong>Responsable:</strong> <?= $subtareas[0]['responsable']; ?></p>
          <?php else: ?>
            <p>No hay subtarea disponible.</p>
          <?php endif; ?>
        </td>
      </tr>

      <!-- Mostrar las demás subtareas -->
      <?php for ($i = 1; $i < count($subtareas); $i++): ?>
        <tr>
          <td class="align-middle">
            <?php if (isset($subtareas[$i])): ?>
              <p><strong>Descripción:</strong> <?= $subtareas[$i]['descripcion']; ?></p>
              <p><strong>Vencimiento:</strong> <?= (new DateTime($subtareas[$i]['fecha_vencimiento']))->format('d-m-Y'); ?></p>
              <p><strong>Comentario:</strong> <?= $subtareas[$i]['comentario']; ?></p>
              <p><strong>Estado:</strong> <?= $subtareas[$i]['estado']; ?></p>
              <p><strong>Responsable:</strong> <?= $subtareas[$i]['responsable']; ?></p>
            <?php endif; ?>
          </td>
        </tr>
      <?php endfor; ?>
    </tbody>
  </table>

<br>
<div class="d-flex justify-content-center">
  <a href="<?= base_url('/'); ?>">
    <button type="button" class="btn" style="background-color: #262e5b; color: white; border: none; margin-right: 10px; font-size: 18px;">
      Inicio
    </button> 
  </a>
  <a href="<?= base_url('/menu/panel'); ?>">
    <button type="button" class="btn" style="background-color: #262e5b; color: white; border: none; font-size: 18px;">
      Panel
    </button>
  </a>
</div>

<?php
  echo $this->include('plantilla/footer');
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
