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
  .card {
    border-radius: 1rem;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }

  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
  }

  .card-body h5 {
    font-weight: bold;
    font-size: 1.25rem;
  }

  .card-body p {
    margin-top: 0.5rem;
    margin-bottom: 1rem;
  }

  .text-muted {
    font-size: 0.9rem;
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


  <div class="table-responsive">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th class="text-center">Tarea</th>
        <th class="text-center">Subtarea</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Aseguramos que las tareas y subtareas estén sincronizadas, de lo contrario, usamos un bucle separado para mostrarlas
      $max = max(count($tareas), count($subtareas)); 
      for ($i = 0; $i < $max; $i++) :
      ?>
        <tr>
          <td class="align-middle">
            <?php if (isset($tareas[$i])): ?>
              <p><strong>TEMA:</strong> <?= $tareas[$i]['tema']; ?></p>
              <p><strong>Vencimiento:</strong> <?= (new DateTime($tareas[$i]['fecha_vencimiento']))->format('d-m-Y'); ?></p>
              <p><strong>Descripción:</strong> <?= $tareas[$i]['descripcion']; ?></p>
              <p><strong>Prioridad:</strong> <?= $tareas[$i]['prioridad']; ?></p>
              <p><strong>Estado:</strong> <?= $tareas[$i]['estado']; ?></p>
            <?php endif; ?>
          </td>
          <td class="align-middle">
            <?php if (isset($subtareas[$i])): ?>
              <p><strong>Descripción:</strong> <?= $subtareas[$i]['descripcion']; ?></p>
              <p><strong>Vencimiento:</strong> <?= (new DateTime($subtareas[$i]['fecha_vencimiento']))->format('d-m-Y'); ?></p>
              <p><strong>Comentario:</strong> <?= $subtareas[$i]['comentario']; ?></p>
              <p><strong>Estado:</strong> <?= $subtareas[$i]['estado']; ?></p>
              <p><strong>Responsable:</strong> <?= $subtareas[$i]['responsable']; ?></p>
            <?php else: ?>
              <p>No hay subtarea disponible.</p>
            <?php endif; ?>
          </td>
        </tr>
      <?php endfor; ?>
    </tbody>
  </table>
</div>

<?php
  echo $this->include('plantilla/footer');
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
