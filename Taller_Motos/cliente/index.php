<!-- INICIALIZACIÓN -->

<?php

require_once('ui/gui_login.php');
require_once('ui/ui_cliente.php');

$config = array(
	'titulo'	=> 'Inicio',
	'url'		=> 'index.php',
);

$ui = new Gui_login($config);
$uic = new UI_Cliente($config);

?>

<!-- HEADER -->
<?php $ui->get_header(); ?>

<h5>Autorizado</h5>

<?php $uic->get_content(); ?>


<?php $ui->get_footer(); ?>