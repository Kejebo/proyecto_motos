<?php
require_once('ui/ui_inventario.php');
$ui= new ui_inventario();
$ui->get_header();
$ui->get_sidebar();
$ui->get_nabvar();
$ui->get_content();
$ui->get_footer();
?>