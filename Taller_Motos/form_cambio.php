<!-- INICIALIZACIÓN -->

<?php

require_once('ui/gui.php');

$config = array(
	'titulo'	=> 'Inicio',
	'url'		=> 'form_cambio.php',
);

$ui = new gui($config);

?>

<!-- HEADER -->
<?php $ui->get_header(); ?>

<h5>From de cambio de contrasena</h5>

<form action="security.php?action=enviar_correo" method="post">

<input type="password" placeholder="nueva_contrasena" name="nuevaContrasena">

<hr>

<input type="password" placeholder="verificar_contrasena" name="confirmarContrasena">

<button>Cambiar</button>


</form>