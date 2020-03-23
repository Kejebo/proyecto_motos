<!-- INICIALIZACIÓN -->

<?php

require_once('ui/gui.php');

$config = array(
	'titulo'	=> 'Inicio',
	'url'		=> 'form_cambio.php',
);

$ui = new gui($config);

?>

<?php $ui->get_header(); ?>


<h5>From de cambio de contrasena</h5>

<form action="security.php?action=cambio_contrasena" method="post">

<input type="hidden" value=<?=$_GET['user_id'];?> name="id">


<input type="password" placeholder="nueva_contrasena" name="contrasena">

<hr>

<input type="password" placeholder="verificar_contrasena" name="confirmarContrasena">

<button>Cambiar</button>


</form>