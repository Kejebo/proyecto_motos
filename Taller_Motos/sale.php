<?php
require_once('ui/ui_sale.php');
$config = array(
	'titulo'	=> 'Modulo Ventas',
	'url'		=> 'sales.php',
);

$ui= new ui_sale($config);
$ui->action_controller();
$ui->get_header();
$ui->get_sidebar();
$ui->get_nabvar();
$ui->get_content();
$ui->get_footer();
?>
