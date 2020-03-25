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

<div class="toast">
  <div class="toast-header">
    Toast Header
  </div>
  <div class="toast-body">
    Some text inside the toast body
  </div>
</div>

<h5>From de cambio de contrasena</h5>

<form method="post" id="formulario">

<input type="hidden" value=<?=$_GET['user_id'];?> name="id" id="id">

<input type="password" class="form-control" placeholder="nueva_contrasena" name="contrasena" id="contrasenaUno">

<hr>

<input type="password" class="form-control" placeholder="verificar_contrasena" name="confirmarContrasena" id="contrasenaDos">


<hr>

<button onclick="validacionContrasenas($('#contrasenaUno').val(),$('#contrasenaDos').val(),$('#id').val())">Cambiar</button>

</form>

</div>