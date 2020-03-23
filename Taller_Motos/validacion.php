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

<form action="security.php?action=enviar_correo" method="post">
<h5>Te hemos enviado un codigo de verificacion al correo electronico de tu cuenta Mighty Motors</h5>
<input type="hidden" value=<?=$_GET['correo'];?> name="correo_electronico_link">
<h6>Si no te ha llego el codigo prueba <button>reenviar codigo</button></h6>
</form>

<?php if(isset($_GET['mer'])){?>
	<div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Error!</strong>Codigo no valido, Intente nuevamente.
    </div>
<?php } ?>

<form action="security.php?action=validar" method="post" id=formulario>

<input type="hidden" value=<?=$_GET['users_id'];?> name="id">
<input type="hidden" value=<?=$_GET['correo'];?> name="correo_electronico_link">

<input type="text" placeholder="codigo" name="codigo">

<button>Verificar</button>

</form>





