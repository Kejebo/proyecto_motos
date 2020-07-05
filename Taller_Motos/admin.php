<?php
require_once('ui/ui_admin.php');
$config = array(
	'titulo'	=> 'Modulo Administrativo',
	'url'		=> 'Admin.php',
);

$ui= new ui_admin($config);
$ui->action_controller();
$ui->get_header();
$ui->get_sidebar();
$ui->get_nabvar();
$ui->get_content();
$ui->get_footer();
?>