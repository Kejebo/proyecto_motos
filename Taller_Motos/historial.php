<?php
  require_once('ui/ui_historial.php');
  $config = array(
  	'titulo'	=> 'Historial de Motos',
  	'url'		=> 'workshop.php',
  );
  $ui= new ui_historial($config);
  $ui->action_controller();
  $ui->get_header();
  $ui->get_sidebar();
  $ui->get_nabvar();
  $ui->get_content();
  $ui->get_footer();

?>
