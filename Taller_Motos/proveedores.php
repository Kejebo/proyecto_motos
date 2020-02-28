<?php
require_once('ui/ui_proveedores.php');
$ui= new ui_proveedores();
$ui->action_controller();

$ui->get_header();
$ui->get_sidebar();
$ui->get_nabvar();
$ui->get_content();
$ui->get_footer();
