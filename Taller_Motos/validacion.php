<!-- INICIALIZACIÓN -->

<?php

require_once('ui/gui.php');

$config = array(
	'titulo'	=> 'Inicio',
	'url'		=> 'validacion.php',
);

$ui = new gui($config);

?>

<!-- HEADER -->
<?php $ui->get_header(); ?>

<h1>Insertar Codigo</h1>

<form action="security.php?action=validar" method="post">

<input type="hidden" value=<?=$_GET['users_id'];?> name="id">

<input type="text" placeholder="codigo" name="codigo">

<button>Verificar</button>

</form>





