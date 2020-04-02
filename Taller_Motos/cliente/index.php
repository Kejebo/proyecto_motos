<!-- INICIALIZACIÓN -->

<?php

require_once('ui/gui_login.php');

$config = array(
	'titulo'	=> 'Inicio',
	'url'		=> 'index.php',
);

$ui = new Gui_login($config);

?>

<!-- HEADER -->
<?php $ui->get_header(); ?>

<h5>Autorizado</h5>


<form action="security.php?action=logout" method="post">

	<button class="btn btn-primary">Salir</button>

</form>

