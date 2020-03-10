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
    <form action="">
    <div class="card shadow mt-4">
    <div class="card-header" id="titulosCards">
    <h6 class="card-title" id="nombre_empresa">Taller de Motos Mighty</h6>
    <h5 class="card-title">Bienvenidos</h5>

    <select id="usuarios">
    <option value="" data-content="<i class='fas fa-users' 'aria-hidden='true'></i>"> Tipos de Usuarios</option>
    <option value="Administrador"><i class="fas fa-user-tie"></i> Administrador</option>
    <option value="Cliente"><a><i class="fas fa-user"></i> Cliente</option>
    </select>

    </div>
    
    <div class="card-body">
    
    <input type="text" class="form-control" id="inputuser" placeholder="Usuario">
    <hr>


    <div class="input-group mb-3" id="grup-pass">
    <input type="password" class="form-control pass-input" onblur="quitarborde()" onclick="ponerborde()" placeholder="Contraseña" id=inputpass>
    <div class="input-group-append">
    <div id="ojos">
    <a class="btn" id="ojo" onclick="mostrarPass()"><i onclick="cambiarojo(this)" class="far fa-eye" ></i></a>
    </div>
    </div>
    </div>

    <hr>

    <div class="iniciar_sesion_boton">
    <button class="btn btn-primary" id="boton_inicio_sesion"><i class="fas fa-sign-in-alt"></i> Entrar</button>
    </form>
    </div>
   
    <hr>
    <div id="contenedor_pregunta">
    <a class="pregunta_contrasena" href="">¿Olvidaste tu contraseña?</a>
    </div>
    </div>
    </div>
    </div>

    <div class="col-sm-4"></div>

    </div>


