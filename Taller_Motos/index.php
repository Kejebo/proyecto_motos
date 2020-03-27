<!-- INICIALIZACIÓN -->

<?php


require_once('ui/ui_login.php');

$config = array(
	'titulo'	=> 'Inicio',
	'url'		=> 'index.php',
);

$ui = new UI_login($config);


 $ui->get_header();

 $ui->get_content(); 

 $ui->get_footer();

 ?>