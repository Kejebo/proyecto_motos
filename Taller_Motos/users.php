<?php
require_once('ui/ui_user.php');
$config = array(
	'titulo'	=> 'Modulo Usuarios',
	'url'		=> 'users.php',
);

$ui= new ui_user($config);
$ui->action_controller();
$ui->get_header();
$ui->get_sidebar();
$ui->get_nabvar();
$ui->get_content();
$ui->get_footer();
