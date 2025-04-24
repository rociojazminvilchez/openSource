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
   <!-- <link rel="stylesheet" href="<?= base_url('/css/index.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/css/formularios.css') ?>">
-->
  </head>
<body>
<?php
  echo $this->include('plantilla/navbar');
?><br>
<div class="alert alert-warning" role="alert">
  <strong>Atención:</strong> Este panel es para visualizar el historial.
</div>
<div class="card text-center">
<div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
    <li>
        <a class="nav-link active" aria-current="true" href=<?= base_url('/menu/tareas'); ?> > Panel </label></a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" aria-current="true" href=<?= base_url('/menu/tareas'); ?>> Tareas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" aria-current="true" href=<?= base_url('/menu/subtareas'); ?>>Subtareas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" aria-current="true" href=<?= base_url('/menu/historial'); ?>><label style="color:red; font-weight: bold;">*  Historial</a>
      </li>
    </ul>
  </div><br>
  <h3 class="my-3" id="titulo" style="margin: 20px;font-family: 'Times New Roman', serif;"> RESERVAS </h3> 

<table class="table table-hover table-bordered my-3" aria-describedby="titulo">
    <thead class="table-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Fecha</th>
            <th scope="col">Horario</th>
            <th scope="col">Actividad</th>
            <th scope="col">Instructor a cargo</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($tareas as $t) : ?>
            <tr>
              <td><?= $t['id']; ?></td>
            </tr>
        <?php 
            endforeach;  
      ?>
    </tbody>
</table><br>


<?php
  echo $this->include('plantilla/footer');
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
