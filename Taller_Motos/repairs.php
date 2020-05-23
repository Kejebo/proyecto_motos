<?php
require_once('ui/ui_repairs.php');
$config = array(
	'titulo'	=> 'Modulo Reparaciones',
	'url'		=> 'repair.php',
);

$ui= new ui_repairs($config);
$ui->ln->action_controller();
$ui->get_header();
$ui->get_sidebar();
$ui->get_nabvar();
$ui->get_content();
$ui->get_footer();
?>
