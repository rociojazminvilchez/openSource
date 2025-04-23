<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Open Source</title>
  <meta name="description" content="The small framework with powerful features">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="<?= base_url('/openSource/public/img/logo.png')?>">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="<?= base_url('/css/formularios.css') ?>">
</head>
<body>
<?php
    echo $this->include('plantilla/navbar');
?>

<form class="form" action="<?= base_url('subtarea/create'); ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
<?php if (session()->get('errors')): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->get('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>  
<p style="text-align:right;">
    <a href="<?php echo base_url('/')?>">
      <button type="button" class="btn-close" aria-label="Close"></button>
    </a>
  </p>
    
  <p style="text-align:left;"><span class="error"> (*) Campos obligatorios</span></p>
    <h4 style="text-align:left;"> Datos subtarea:</h4><br>

  <span class="error">*</span> Descripci&oacuten:<br>
    <input type="text" name="descripcion"  value="<?= old('descripcion') ?>"required></input><br><br>
       
  <span class="error">*</span> Estado:<br>
  <select class="form-select" aria-label="Default select example">
    <option selected>Seleccione:</option>
    <option value="1">Definido</option>
    <option value="2">En proceso</option>
    <option value="3">Completada</option>
  </select></input><br><br>  

  <span class="error">*</span> Prioridad:<br>
  <select class="form-select" aria-label="Default select example">
    <option selected>Seleccione:</option>
    <option value="baja">Baja</option>
    <option value="normal">Normal</option>
    <option value="alta">Alta</option>
  </select></input><br><br>
  

  <span class="error">*</span> Fecha de vencimiento:<br>
    <input type="date" name="vencimiento"  value="<?= old('vencimiento') ?>"required></input><br><br>
  
  <span class="error">*</span> Fecha de recordatorio:<br>
    <input type="date" name="recordatorio"  value="<?= old('recordatorio') ?>"required></input><br><br>
 

  <span class="error">*</span> Responsable:<br>
  <input type="text" name="usuario" value="<?= $_SESSION['usuario'] ?>"required></input>
  
    <input type="submit" name="tarea" value="CREAR" style="background-color: #262e5b;">
  </form><br><br><br>
  <?php
    echo $this->include('plantilla/footer');
  ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>