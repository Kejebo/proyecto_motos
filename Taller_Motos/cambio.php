<!-- INICIALIZACIÓN -->

<?php

require_once('ui/gui.php');

$config = array(
	'titulo'	=> 'Inicio',
	'url'		=> 'cambio.php',
);

$ui = new gui($config);

?>

<!-- HEADER -->
<?php $ui->get_header(); ?>

<h5>Enviar correo para solicitud de cambio</h5>

<form action="security.php?action=enviar_correo" method="post">

<input type="text" placeholder="correo_electronico" name="correo_electronico_link">

<button>enviar correo</button>

</form>