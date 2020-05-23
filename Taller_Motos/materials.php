<?php
require_once('ui/ui_material.php');
$config = array(
	'titulo'	=> 'Modulo Inventario',
	'url'		=> 'materials.php',
);

$ui= new ui_material($config);
$ui->action_controller();
$ui->get_header();
$ui->get_sidebar();
$ui->get_nabvar();
$ui->get_content();
$ui->get_footer();
?>
