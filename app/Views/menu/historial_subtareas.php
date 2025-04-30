<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Open Source</title>
  <meta name="description" content="The small framework with powerful features">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="<?= base_url('public/img/logo.png') ?>">
  <link rel="shortcut icon" href="<?= base_url('/openSource/public/img/logo.png') ?>" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .encabezado-custom thead th {
      background-color: #262e5b;
      color: white;
      text-align: center;
      padding: 10px;
    }
    .encabezado-custom tbody td {
      padding: 8px;
      border-bottom: 1px solid #ccc;
      vertical-align: middle;
    }
    .encabezado-custom tr {
      background-color: transparent;
    }
    @media (max-width: 768px) {
      .table-responsive {
        font-size: 0.9rem;
      }
    }
  </style>
</head>
<body>
<div id="inicio"></div>
<?= $this->include('plantilla/navbar'); ?><br>

<div class="alert alert-warning" role="alert">
  <strong>Atención:</strong> Este panel es para visualizar el historial de las subtareas.
</div>

<div class="card text-center">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs justify-content-center">
      <li class="nav-item">
        <a class="nav-link active" href="<?= base_url('/menu/historial_tareas'); ?>">Tareas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="<?= base_url('/menu/historial_subtareas'); ?>"><label style="color:red; font-weight: bold;">* Subtareas</label></a>
      </li>
    </ul>
  </div>
</div>

<h3 class="my-4 text-center" id="titulo" style="font-family: 'Times New Roman', serif;">HISTORIAL SUBTAREAS</h3>

<!-- Filtro de orden -->
<div class="container mb-4">
  <form method="GET" action="<?= base_url('menu/historial_subtareas') ?>" class="d-flex flex-wrap justify-content-center align-items-center">
    <label for="ordenar" class="me-2">Ordenar por:</label>
    <select name="ordenar" id="ordenar" class="form-select w-auto me-2">
      <option value="fecha_vencimiento" <?= isset($_GET['ordenar']) && $_GET['ordenar'] == 'fecha_vencimiento' ? 'selected' : ''; ?>>Fecha de Vencimiento</option>
      <option value="prioridad" <?= isset($_GET['ordenar']) && $_GET['ordenar'] == 'prioridad' ? 'selected' : ''; ?>>Prioridad</option>
      <option value="estado" <?= isset($_GET['ordenar']) && $_GET['ordenar'] == 'estado' ? 'selected' : ''; ?>>Estado</option>
    </select>
    <button type="submit" class="btn btn-dark">Ordenar</button>
  </form>
</div>

<!-- Tabla -->
<div class="container mb-4">
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
          <th>Tarea</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($subtareas as $s): ?>
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
            <a href="<?= base_url('/menu/panel_completo/' . $s['tarea'] . '/' . $s['tarea']); ?>" class="btn btn-danger btn-sm">Mostrar</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<a href="#inicio" class="btn btn-secondary" style="position: fixed; bottom: 20px; right: 20px;">
  ⬆ Volver arriba
</a>

<?= $this->include('plantilla/footer'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
