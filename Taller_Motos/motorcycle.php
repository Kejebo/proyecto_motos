<?php
require_once('ui/ui_motorcycle.php');
$config = array(
	'titulo'	=> 'Modulo Motos',
	'url'		=> 'motorcycle.php',
);

$ui= new ui_motorcycle($config);
$ui->action_controller();

$ui->get_header();
$ui->get_sidebar();
$ui->get_nabvar();
$ui->get_content();
$ui->get_footer();
