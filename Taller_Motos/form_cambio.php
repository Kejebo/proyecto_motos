<!-- INICIALIZACIÓN -->

<?php

require_once('ui/ui_form_cambio.php');

$config = array(
	'titulo'	=> 'Inicio',
	'url'		=> 'form_cambio.php',
);

$ui = new UI_form_cambio($config);

?>

<?php $ui->get_header(); ?>

<?php $ui->get_content(); ?>

<?php $ui->get_footer(); ?>