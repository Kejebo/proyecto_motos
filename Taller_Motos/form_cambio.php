<!-- INICIALIZACIÓN -->

<?php

require_once('ui/gui.php');

$config = array(
	'titulo'	=> 'Inicio',
	'url'		=> 'form_cambio.php',
);

$ui = new gui($config);

?>

<?php $ui->get_header(); ?>

<div style="width: 500px">

<h5>From de cambio de contrasena</h5>

<form action="security.php?action=cambio_contrasena" method="post">

<input type="hidden" value=<?=$_GET['user_id'];?> name="id">


<input type="password" class="form-control" placeholder="nueva_contrasena" name="contrasena">

<hr>

<input type="password" class="form-control" placeholder="verificar_contrasena" name="confirmarContrasena">

<?php if(isset($_GET['igualdad'])){?>
<div class="alert alert-danger alert-dismissible fade show">
<button type="button" class="close" data-dismiss="alert">&times;</button>
<strong>Error!</strong> Las contrasenas coinciden.
</div>
<?php } ?>

<hr>

<button>Cambiar</button>


</form>

</div>