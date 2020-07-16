<!-- INICIALIZACIÓN -->

<?php

require_once('ui/gui_login.php');
require_once('ui/ui_cliente.php');
require_once('ui/ui_motos.php');
require_once('ui/ui_reparaciones.php');
require_once('ui/ui_detalles_reparacion.php');
require_once('ui/ui_contacto.php');

$config = array(
	'titulo'	=> 'Inicio',
	'url'		=> 'index.php',
);

$ui = new Gui_login($config);
$ui_cliente = new UI_Cliente($config);
$ui_motos = new UI_Motos($config);
$ui_reparaciones = new UI_Reparaciones($config);
$ui_detalles_reparacion = new UI_Detalles_Reparacion($config);
$ui_contacto = new UI_Contacto($config);

?>

<!-- HEADER -->
<?php $ui->get_header(); ?>
<?php $ui->get_menu(); ?>



<?php

if (isset($_GET['pagina'])) {
	switch ($_GET['pagina']) {

		case 'motos':

			$ui_motos->get_content();

			break;

		case 'reparaciones':

			$ui_reparaciones->get_content();

			break;

		case 'detalle_reparacion':

			$ui_detalles_reparacion->get_content();

			break;

		case 'contacto':

			$ui_contacto->get_content();
	
			break;
	}
} else {

	$ui_cliente->get_content();
}
?>

<?php $ui->get_footer(); ?>