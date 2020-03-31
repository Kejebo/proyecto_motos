<!-- INICIALIZACIÓN -->

<?php


require_once('ui/ui_completa.php');
require_once('ui/ui_validacion.php');
require_once('ui/ui_form_cambio.php');

$config = array(
	'titulo'	=> 'Inicio',
	'url'		=> 'completa.php',
);

$ui = new UI_completa($config);
$ui_validacion = new UI_validacion($config);
$ui_form_cambio = new UI_form_cambio($config);

 $ui->get_header();

 $ui->get_content(); 

 $ui_validacion->get_content();

 $ui_form_cambio->get_content();

 $ui->get_footer();

 ?>