<?php
  require_once('ui/ui_workshop.php');
  $config = array(
  	'titulo'	=> 'Modulo Mantenimiento',
  	'url'		=> 'workshop.php',
  );
  $ui=new ui_workshop($config);
  $ui->action_controller();
  $ui->get_header();
  $ui->get_sidebar();
  $ui->get_nabvar();
  $ui->get_content();
  $ui->get_footer();

 ?>
