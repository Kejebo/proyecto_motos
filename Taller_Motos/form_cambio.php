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

<div style="width: 500px">

<h5>From de cambio de contrasena</h5>

<div id="cambio_correcto">

</div>

<form method="post" id="formulario">

<input type="hidden" value=<?=$_GET['user_id'];?> name="id" id="id">

<input type="password" class="form-control" placeholder="nueva_contrasena" name="contrasena" id="contrasenaUno" required>

<hr>

<input type="password" class="form-control" placeholder="verificar_contrasena" name="confirmarContrasena" id="contrasenaDos" required>

<div id="no_iguales">

</div>
<hr>

<button  id="bcambio" onclick="validacionContrasenas()">Cambiar</button>

</form>

</div>