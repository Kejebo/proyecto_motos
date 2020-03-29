<!-- INICIALIZACIÓN -->

<?php


require_once('ui/ui_validacion.php');

$config = array(
	'titulo'	=> 'Inicio',
	'url'		=> 'validacion.php',
);

$ui = new UI_validacion($config);


 $ui->get_header();

 $ui->get_content(); 

 $ui->get_footer();

 ?>