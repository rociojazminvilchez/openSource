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
<?= $this->include('plantilla/navbar'); ?><br>

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
        <a class="nav-link active" href="<?= base_url('/menu/subtareas'); ?>"><label style="color:red; font-weight: bold;">* Subtareas</label></a>
      </li>
    </ul>
  </div><br>

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
            <th>Acción</th>
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
                  <?= (new DateTime($s['vencimiento']))->format('d-m-Y'); ?>
                <?php endif; ?>
              </td>
              <td><?= $s['comentario']; ?></td>
              <td><?= $s['responsable']; ?></td>
              <td>
                <a href="#" class="btn btn-success btn-sm">✏️ Modificar</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?= $this->include('plantilla/footer'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
