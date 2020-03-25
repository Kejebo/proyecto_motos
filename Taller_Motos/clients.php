<?php
require_once('ui/ui_client.php');
$config = array(
	'titulo'	=> 'Modulo Clientes',
	'url'		=> 'clients.php',
);

$ui= new ui_client($config);
$ui->action_controller();
$ui->get_header();
$ui->get_sidebar();
$ui->get_nabvar();
$ui->get_content();
$ui->get_footer();
?>