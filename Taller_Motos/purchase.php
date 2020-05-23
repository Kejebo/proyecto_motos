<?php
require_once('ui/ui_purchase.php');
$config = array(
	'titulo'	=> 'Modulo Compras',
	'url'		=> 'purchases.php',
);

$ui= new ui_purchase($config);
$ui->action_controller();
$ui->get_header();
$ui->get_sidebar();
$ui->get_nabvar();
$ui->get_content();
$ui->get_footer();
?>