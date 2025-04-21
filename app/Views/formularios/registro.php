<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inguz</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= base_url('img/icon.png')?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('assets/css/index.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/formularios.css') ?>">

  </head>
<body>
<?php
    echo $this->include('plantilla/navbar');
?>


<form class="form" action="<?= base_url('usuario/create'); ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
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
    <a href="<?php echo base_url('/inguz/index')?>">
      <button type="button" class="btn-close" aria-label="Close"></button>
    </a>
  </p>
    
  <p style="text-align:left;"><span class="error"> (*) Campos obligatorios</span></p>
    <h4 style="text-align:left;"> Datos personales:</h4><br>

  <span class="error">*</span> Nombre: <br>   
    <input type="text" name="nombre"  value="<?= old('nombre') ?>"required ><br><br>
        
  <span class="error">*</span> Apellido:<br>
    <input type="text" name="apellido"  value="<?= old('apellido') ?>"required></input><br><br>
       
  <span class="error">*</span> Edad:<br>
    <input type="number" name="edad"  value="<?= old('edad') ?>" required></input><br><br>
  
  <span class="error">*</span> Tel&eacutefono:<br>
    <input type="number" name="telefono"  value="<?= old('telefono') ?>"required></input><br><br>
  
  <span class="error">*</span> Direcci&oacuten:<br>
    <input type="text" name="dire"  value="<?= old('dire') ?>"required></input><br><br>

  <label for="image">Certificado M&eacutedico:</label><br>
      <input type="file" name="image" id="image" accept="image/jpeg, image/png, application/pdf"><br>
  
  <h4 style="text-align:left;"> Datos registro:</h4><br>
  
  <span class="error">*</span> E-mail: <br>   
  <input type="text" name="email"  value="<?= old('email') ?>"required ><br><br>  
  
  <span class="error">*</span> Contraseña: <br>   
  <input type="password" name="contra"  value="<?= old('contra') ?>" required ><br><br>  
  
  <span class="error">*</span> Confirmar contraseña: <br>   
  <input type="password" name="contra2"  value="<?= old('contra2') ?>"required ><br><br> 
  <!-- Campo oculto -->
  <input type="hidden" name="tipo_usuario" value="usuario">
  
    <input type="submit" name="registro" value="REGISTRARSE" style="background-color: #df7718;">
  </form><br><br><br>
  <?php
    echo $this->include('plantilla/footer');
  ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>