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
        <a class="nav-link active" aria-current="true" href=<?= base_url('/menu/panel'); ?> > Panel </label></a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" aria-current="true" href=<?= base_url('/menu/tareas'); ?>> Tareas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" aria-current="true" href=<?= base_url('/menu/subtareas'); ?>><label style="color:red; font-weight: bold;">* Subtareas</a>
      </li>
    </ul>
  </div><br>
  <h3 class="my-3" id="titulo" style="margin: 20px;font-family: 'Times New Roman', serif;"> SUBTAREAS </h3> 

<table class="encabezado-custom" aria-describedby="titulo">
<thead>
  <tr>
    <th scope="col">ID</th>
    <th scope="col">Descripcion</th>
    <th scope="col">Estado</th>
    <th scope="col">Prioridad</th>
    <th scope="col">Fecha Vencimiento</th>
    <th scope="col">Comentario</th>
    <th scope="col" >Responsable</th>
   </tr>
    </thead>
    <tbody>
<?php foreach ($subtareas as $s) : ?>
  <tr>
    <td><?= $s['id']; ?></td>
    <td><?= $s['descripcion']; ?></td>
    <td><?= $s['estado']; ?></td>
    <td><?= $s['prioridad']; ?></td> 
    <td><?= (new DateTime($t['fecha_vencimiento']))->format('d-m-Y'); ?></td>
    <td><?= $s['comentario']; ?></td>
    <td><?= $s['responsable']; ?></td>
</tr>
<?php endforeach;  ?>
</tbody>
</table><br>

<?php
  echo $this->include('plantilla/footer');
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
