<?php
  require_once('ui/ui_works.php');
  $config = array(
  	'titulo'	=> 'Modulo Servicios',
  	'url'		=> 'works.php',
  );
  $ui=new ui_works($config);
  $ui->action_controller();
  $ui->get_header();
  $ui->get_sidebar();
  $ui->get_nabvar();
  $ui->get_content();
  $ui->get_footer();

 ?>
