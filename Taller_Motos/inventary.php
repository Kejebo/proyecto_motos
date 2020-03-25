<?php
require_once('ui/ui_inventary.php');
$config = array(
	'titulo'	=> 'Modulo Inventario',
	'url'		=> 'inventary.php',
);

$ui= new ui_inventary($config);
$ui->action_controller();
$ui->get_header();
$ui->get_sidebar();
$ui->get_nabvar();
$ui->get_content();
$ui->get_footer();
?>