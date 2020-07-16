<?php
require_once('ui/ui_reports.php');
$config = array(
	'titulo'	=> 'Modulo Reportes',
	'url'		=> 'reports.php',
);

$ui= new ui_report($config);
$ui->get_header();
$ui->get_sidebar();
$ui->get_nabvar();
$ui->get_content();
$ui->get_footer();
?>
