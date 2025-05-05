<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Open Source</title>
  <meta name="description" content="The small framework with powerful features">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('public/img/logo.png') ?>">
  <link rel="shortcut icon" href="<?= base_url('/openSource/public/img/logo.png') ?>" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
    .contenido-limitado {
  max-width: 100%; /* Antes era 95% o menos */
  margin: 0; /* Sin márgenes laterales */
  padding: 0 10px; /* Un poco de espacio interno para que no quede pegado al borde total */
}

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
<div id="inicio"></div>

<?= $this->include('plantilla/navbar'); ?><br>

<div class="container-fluid contenido-limitado">
  <div class="alert alert-warning" role="alert">
    <strong>Atención:</strong> Este panel es para visualizar el historial de las subtareas.
  </div>

  <div class="card text-center">
    <div class="card-header">
      <ul class="nav nav-tabs card-header-tabs justify-content-center flex-wrap">
        <li class="nav-item">
          <a class="nav-link active" href="<?= base_url('/menu/historial_tareas'); ?>">Tareas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="<?= base_url('/menu/historial_subtareas'); ?>">
            <label style="color:red; font-weight: bold;">SUBTAREAS</label>
          </a>
        </li>
      </ul>
    </div>
  </div><br>
  <?php if (empty($subtareas)): ?>
    <div class="alert-info" role="alert">
      En este momento no posee subtareas registradas.
    </div>
    <?php
    else:?>
  <h3 class="text-center my-3" id="titulo" style="font-family: 'Times New Roman', serif;">HISTORIAL SUBTAREAS</h3>

  <!-- Formulario de ordenamiento -->
  <form method="GET" action="<?= base_url('menu/historial_subtareas') ?>" class="d-flex flex-wrap align-items-center gap-2 justify-content-center mb-4">
    <label for="ordenar" class="form-label m-0">Ordenar por:</label>
    <select name="ordenar" id="ordenar" class="form-select w-auto">
      <option value="fecha_vencimiento" <?= isset($_GET['ordenar']) && $_GET['ordenar'] == 'fecha_vencimiento' ? 'selected' : ''; ?>>Fecha de Vencimiento</option>
      <option value="prioridad" <?= isset($_GET['ordenar']) && $_GET['ordenar'] == 'prioridad' ? 'selected' : ''; ?>>Prioridad</option>
      <option value="estado" <?= isset($_GET['ordenar']) && $_GET['ordenar'] == 'estado' ? 'selected' : ''; ?>>Estado</option>
    </select>
    <button type="submit" class="btn btn-dark" style="background-color: #262e5b; color: #fff; text-decoration-style: solid;">Ordenar</button>
  </form>

  <!-- Tabla responsiva -->
  <div class="table-responsive">
    <table class="table encabezado-custom" aria-describedby="titulo">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Descripcion</th>
          <th scope="col">Estado</th>
          <th scope="col">Prioridad</th>
          <th scope="col">Fecha Vencimiento</th>
          <th scope="col">Comentario</th>
          <th scope="col">Responsable</th>
          <th scope="col">Tarea</th>
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
              <?= ($s['fecha_vencimiento'] != '0000-00-00') ? (new DateTime($s['fecha_vencimiento']))->format('d-m-Y') : ''; ?>
            </td>
            <td><?= $s['comentario']; ?></td>
            <td><?= $s['responsable']; ?></td>
            <td>
              <a href="<?= base_url('/menu/panel_completo/' . $s['tarea'] . '/' . $s['tarea']); ?>" class="btn btn-danger">Mostrar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Botón para volver arriba -->
<a href="#inicio" class="btn btn-secondary" style="position: fixed; bottom: 20px; right: 20px;">
  ⬆ Volver arriba
</a>
<?php endif; ?>
<?= $this->include('plantilla/footer'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
