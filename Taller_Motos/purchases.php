<?php
require_once('ui/ui_purchases.php');
$config = array(
	'titulo'	=> 'Modulo Compras',
	'url'		=> 'purchases.php',
);

$ui= new ui_purchases($config);
$ui->action_controller();
$ui->get_header();
$ui->get_sidebar();
$ui->get_nabvar();
$ui->get_content();
$ui->get_footer();
?>s
