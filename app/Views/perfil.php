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
<div class="alert alert-warning" role="alert">
  <strong>Atención:</strong> Este panel es para actualizar informaci&oacuten.
</div>
<form class="form" action="<?= base_url('/perfil'); ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
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
  <?php foreach ($usuario as $us):  ?>
  <h5 style="text-align:center; color:red;"> Actualizar informaci&oacuten:</h5><br>
  <p style="text-align:left;"><span class="error"> (*) Campos obligatorios</span></p>
    <h4 style="text-align:left;"> Datos personales:</h4><br>

  <span class="error">*</span> Nombre: <br>   
    <input type="text" name="nombre"  value="<?= esc($us['nombre']) ?>"required ><br><br>
        
  <span class="error">*</span> Apellido:<br>
    <input type="text" name="apellido"  value="<?= esc($us['apellido']) ?>"required></input><br><br>
       
  <h4 style="text-align:left;"> Datos registro:</h4><br>
  
  E-mail: <br>   
  <strong>
    <?= esc($us['correo']); ?>
  </strong><br><br>
  <input type="hidden" name="email" value="<?= esc($us['correo'])?>">
  
  <span class="error">*</span> Contraseña: <br>   
  <input type="text" name="contra"  value="<?= esc($us['contra']) ?>" required ><br><br>  
  
  <span class="error">*</span> Confirmar contraseña: <br>   
  <input type="text" name="contra2"  value="<?= esc($us['contra2']) ?>"required ><br><br> 
  <?php
   endforeach;
  ?>
    <input type="submit" name="actualizar" value="ACTUALIZAR" style="background-color: #262e5b;">
  </form><br>
  <?php
    echo $this->include('plantilla/footer');
  ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>