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
      vertical-align: middle;
    }
    .encabezado-custom tr {
      background-color: transparent;
    }
    @media (max-width: 768px) {
      .table-responsive {
        font-size: 0.9rem;
      }
      .btn-sm {
        font-size: 0.75rem;
        padding: 0.3rem 0.5rem;
      }
    }
  </style>
</head>
<body>
<div id="inicio"></div>

<?= $this->include('plantilla/navbar'); ?><br>

<div class="alert alert-warning" role="alert">
  <strong>Atención:</strong> Este panel es para visualizar y modificar las tareas.
</div>

<div class="card text-center">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs justify-content-center">
      <li class="nav-item">
        <a class="nav-link active" href="<?= base_url('/menu/panel'); ?>">Panel</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="<?= base_url('/menu/tareas'); ?>">
          <label style="color:red; font-weight: bold;">TAREAS</label>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="<?= base_url('/menu/subtareas'); ?>">Subtareas</a>
      </li>
    </ul>
  </div>
</div>

<h3 class="my-4 text-center" id="titulo" style="font-family: 'Times New Roman', serif;">TAREAS</h3>

<!-- Filtro de orden -->
<div class="container-fluid mb-4 d-flex flex-wrap justify-content-center align-items-center">
  <form method="GET" action="<?= base_url('menu/tareas') ?>" class="d-flex flex-wrap justify-content-center align-items-center">
    <label for="ordenar" class="me-2">Ordenar por:</label>
    <select name="ordenar" id="ordenar" class="form-select w-auto">
      <option value="fecha_vencimiento" <?= isset($_GET['ordenar']) && $_GET['ordenar'] == 'fecha_vencimiento' ? 'selected' : ''; ?>>Fecha de Vencimiento</option>
      <option value="prioridad" <?= isset($_GET['ordenar']) && $_GET['ordenar'] == 'prioridad' ? 'selected' : ''; ?>>Prioridad</option>
      <option value="estado" <?= isset($_GET['ordenar']) && $_GET['ordenar'] == 'estado' ? 'selected' : ''; ?>>Estado</option>
    </select>
    <button type="submit" class="btn btn-dark ms-2" style="background-color: #262e5b; color: #fff; text-decoration-style: solid;">Ordenar</button>
  </form>
</div>

<!-- Tabla -->
<div class="container-fluid mb-4">
  <div class="table-responsive">
    <table class="table table-hover encabezado-custom" aria-describedby="titulo">
      <thead>
        <tr>
          <th>ID</th>
          <th>Tema</th>
          <th>Descripción</th>
          <th>Prioridad</th>
          <th>Estado</th>
          <th>Fecha Vencimiento</th>
          <th>Fecha Recordatorio</th>
          <th colspan="3">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($tareas as $t): if ($t['estado_actualizado'] == ''): ?>
        <tr>
          <td><?= $t['id']; ?></td>
          <td><?= $t['tema']; ?></td>
          <td><?= $t['descripcion']; ?></td>
          <td><?= $t['prioridad']; ?></td>
          <td><?= $t['estado']; ?></td>
          <td><?= (new DateTime($t['fecha_vencimiento']))->format('d-m-Y'); ?></td>
          <td>
            <?= ($t['fecha_recordatorio'] != '0000-00-00') ? (new DateTime($t['fecha_recordatorio']))->format('d-m-Y') : ''; ?>
          </td>
          <td><a href="<?= site_url('menu/tarea/' . $t['id']); ?>" class="btn btn-success btn-sm">✏️ Modificar</a></td>
          <td><button class="btn btn-primary btn-sm">🔗 Compartir</button></td>
          <td><a href="<?= site_url('menu/tareas/' . $t['id']); ?>" class="btn btn-danger btn-sm">🗑️ Eliminar</a></td>
        </tr>
        <?php endif; endforeach; ?>
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
