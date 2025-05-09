<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Open Source</title>
  <meta name="description" content="The small framework with powerful features">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="<?= csrf_hash() ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('public/img/logo.png') ?>">
  <link rel="shortcut icon" href="<?= base_url('/openSource/public/img/logo.png') ?>" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('/css/menu.css') ?>">
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
</div><br>
<?php if (empty($tareas)): ?>
    <div class="alert-info" role="alert">
      En este momento no posee tareas registradas.
    </div>
    <?php
    else:?>
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
        <?php  foreach ($tareas as $t): if (empty($t['estado_actualizado'])): ?>
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
          <td>
  <button class="btn btn-primary btn-sm share-btn"
    data-bs-toggle="modal"
    data-bs-target="#shareModal"
    data-id="<?= $t['id']; ?>"
    data-tema="<?= $t['tema']; ?>"
    data-descripcion="<?= $t['descripcion']; ?>"
    data-prioridad="<?= $t['prioridad']; ?>"
    data-estado="<?= $t['estado']; ?>"
    data-fecha-vencimiento="<?= $t['fecha_vencimiento']; ?>"
    data-fecha-recordatorio="<?= $t['fecha_recordatorio']; ?>"
    onclick="setCurrentTask(this)"
  >🔗 Compartir</button>
</td>

          <td><a href="<?= site_url('menu/tareas/' . $t['id']); ?>" class="btn btn-danger btn-sm">🗑️ Eliminar</a></td>
        </tr>
        <?php endif; endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- modal compartir tarea -->
<div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="shareModalLabel">Compartir tarea</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="recipients" class="form-label">Colaboradores (emails separados por coma)</label>
          <input type="text" class="form-control" id="recipients" placeholder="email1@gmail.com, email2@gmail.com">
        </div>
        <div id="message"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="sendShare">Enviar</button>
      </div>
    </div>
  </div>
</div>
<a href="#inicio" class="btn btn-secondary" style="position: fixed; bottom: 20px; right: 20px;">
  ⬆ Volver arriba
</a>
<?php endif; ?>

        <!-- COMPARTIR -->
        <script>
  let currentTask = {}; // Definido globalmente

  function setCurrentTask(btn) {
    const $btn = $(btn);
    currentTask = {
      task_id: $btn.data('id'),
      tema: $btn.data('tema'),
      descripcion: $btn.data('descripcion'),
      prioridad: $btn.data('prioridad'),
      estado: $btn.data('estado'),
      fecha_vencimiento: $btn.data('fecha-vencimiento'),
      fecha_recordatorio: $btn.data('fecha-recordatorio')
    };
    console.log('Tarea seleccionada desde onclick:', currentTask);
  }

  $(document).ready(function() {

    // Establecer los datos de la tarea cuando se hace clic en el botón "Compartir"
    $('.share-btn').click(function() {
      // Limpiar el estado actual antes de asignar una nueva tarea
      currentTask = {
        task_id: $(this).data('id'),
        tema: $(this).data('tema'),
        descripcion: $(this).data('descripcion'),
        prioridad: $(this).data('prioridad'),
        estado: $(this).data('estado'),
        fecha_vencimiento: $(this).data('fecha-vencimiento'),
        fecha_recordatorio: $(this).data('fecha-recordatorio')
      };
      console.log('Tarea seleccionada para compartir:', currentTask); // Depuración
    });

    // Limpiar datos cuando se abre el modal
    $('#shareModal').on('show.bs.modal', function() {
      // Limpia los datos del modal cada vez que se abre
      $('#recipients').val(''); // Limpiar campo de correos
      $('#message').html(''); // Limpiar mensaje de error o éxito
    });

    // Cerrar modal y limpiar datos
    $('#shareModal').on('hidden.bs.modal', function() {
      currentTask = {}; // Limpiar datos de la tarea
      console.log('Datos de la tarea limpiados:', currentTask); // Verificación
    });

    // Manejar el clic en el botón "Enviar"
    $('#sendShare').click(function() {
      if (!currentTask.task_id) {
        $('#message').removeClass('text-success').addClass('text-danger')
                     .html('Error: no se ha seleccionado una tarea para compartir.');
        return;
      }

      const recipients = $('#recipients').val();
      if (!recipients) {
        $('#message').html('Por favor, ingrese al menos un correo electrónico.');
        return;
      }

      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      const emailList = recipients.split(',').map(email => email.trim());
      if (!emailList.every(email => emailRegex.test(email))) {
        $('#message').html('Uno o más correos electrónicos no son válidos.');
        return;
      }

      $('#sendShare').prop('disabled', true).text('Enviando...');
      const csrfTokenName = '<?= csrf_token() ?>';
      const csrfToken = $('meta[name="csrf-token"]').attr('content');

      $.ajax({
    url: '<?= base_url('sharecontroller/share_task') ?>',
    type: 'POST',
    data: {
        task_id: currentTask.task_id,
        tema: currentTask.tema,
        descripcion: currentTask.descripcion,
        prioridad: currentTask.prioridad,
        estado: currentTask.estado,
        fecha_vencimiento: currentTask.fecha_vencimiento,
        fecha_recordatorio: currentTask.fecha_recordatorio,
        recipients: recipients,
        [csrfTokenName]: csrfToken
    },
    dataType: 'json',
    success: function(response) {
        $('#message').removeClass('text-danger text-success')
                     .addClass(response.status === 'success' ? 'text-success' : 'text-danger')
                     .html(response.message);

        if (response.status === 'success') {
            $('#recipients').val('');
            setTimeout(() => $('#shareModal').modal('hide'), 2000);
        }
    },
    error: function(xhr, status, error) {
        console.error('AJAX Error: ', xhr.responseText); // Detalles de la respuesta del servidor
        console.error('Status: ', status); // Estado del error
        console.error('Error: ', error); // Detalles del error

        $('#message').removeClass('text-success').addClass('text-danger');
        $('#message').html('Error en la conexión. Inténtelo de nuevo.');
    },
    complete: function() {
        $('#sendShare').prop('disabled', false).text('Enviar');
    }
});

    });
  });
</script>


<?= $this->include('plantilla/footer'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
