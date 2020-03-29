<?php

require_once('gui.php');

    class UI_validacion extends Gui{

        

        function get_content()
        {
            ?>

<div class="row"  id="formulario_login">
<div class="col-sm-4"></div>
    
<div class="col-sm-4">
<div class="card shadow mt-4">
<div class="card-header" id="titulosCards">
<h5 class="card-title" id="nombre_empresa">Verificacion de codigo</h5>
<h6 class="card-title">Te hemos enviado un codigo de verificacion al correo electronico de tu cuenta Mighty Motors.</h6>
</div>
<div class="card-body" id="body_cambio">

<?php if(isset($_GET['mer'])){?>
	<div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Error!</strong>Codigo no valido, Intente nuevamente.
    </div>
<?php } ?>

<form action="security.php?action=validar" method="post" id=formulario>

<input type="hidden" value=<?=$_GET['users_id'];?> name="id">
<input type="hidden" value=<?=$_GET['correo'];?> name="correo_electronico_link">
<input  class = "form-control" type="text" placeholder="codigo" name="codigo">
<hr>
<button class ="btn btn-primary boton_success"><i class="fas fa-check-circle"></i> Validar</button>
</form>

<div class= "container" id=div_reenviar>
<form method="post" id="formulario_reenviar">
<input type="hidden" value=<?=$_GET['users_id'];?> name="id">
<input type="hidden" value=<?=$_GET['correo'];?> name="correo_electronico_link">
<strong> <button  type="submit" class = "pregunta_contrasena"> <i class="fas fa-share"></i> reenviar codigo</button></strong>
</div>
</form>
</div>






           
            <?php
        }

    }
?>