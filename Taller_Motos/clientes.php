<?php
require_once('ui/ui_clientes.php');
$ui= new ui_cliente();
$ui->get_header();
$ui->get_sidebar();
$ui->get_nabvar();
$ui->get_content();
$ui->get_footer();
?>