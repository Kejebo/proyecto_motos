<!-- INICIALIZACIÓN -->

<?php

require_once('ui/gui.php');

$config = array(
	'titulo'	=> 'Inicio',
	'url'		=> 'index.php',
);

$ui = new GUI($config);

?>

<!-- HEADER -->
<?php $ui->get_header(); ?>

    <div>
    
    <div class="row"  id="formulario">
    <div class="col-sm-4"></div>
   
    <div class="col-sm-4">
    <div class="card shadow mt-4">
    <div class="card-header" id="titulosCards">
    <h6 class="card-title">Taller de Motos Mighty</h6>
    <h5 class="card-title">Bienvenidos</h5>


    <div class="dropdown">
    <button type="button" class="btn btn-secundary dropdown-toggle" data-toggle="dropdown" id="boton_selector_usuarios">
    Tipo de Usuario
    </button>
     <div class="dropdown-menu">
    <a class="dropdown-item">Aministrador</a>
    <a class="dropdown-item">Cliente</a>
    </div>
    </div>
    </div>
    
    <div class="card-body">
    <input type="text" class="form-control" placeholder="Usuario">
    <hr>
    <input type="password" class="form-control" placeholder="Contraseña">

    <hr>

    <div class="container-fluid">
    <button class="btn btn-primary" id="boton_inicio_sesion">Iniciar Sesion</button>
    </div>
    <hr>
    <a href="">Olvidaste tu contraseña?</a>
    </div>
    </div>
    </div>

    <div class="col-sm-4"></div>

    </div>


