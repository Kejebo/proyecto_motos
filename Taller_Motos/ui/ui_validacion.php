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

<div id="invalido">
    
</div>
<form  method="post" id=formulario_validar_codigo>
<input type="hidden" value=<?=$_GET['users_id'];?> name="id">
<input type="hidden" value=<?=$_GET['correo'];?> name="correo_electronico_link">
<input  class = "form-control" type="text" placeholder="codigo" name="codigo" id="codigo">
<div class= "container" id=div_reenviar>
<div id="total"><strong> <a id="boton_reenviar"  onclick="reenviar_codigo()" class = " pregunta_contrasena link"><div id="div_icono_reenviar"><i id="icono_reenviar"class="fas fa-share"></i></div> reenviar codigo</a></strong></div>
</div>

<hr>
<button   id= "boton_validar" type ="submit" class ="btn btn-primary boton_success"><i class="fas fa-check-circle"></i> Validar</button>
</form>


<form method="post" id="formulario_reenviar">
<input type="hidden" value=<?=$_GET['users_id'];?> name="id">
<input type="hidden" value=<?=$_GET['correo'];?> name="correo_electronico_link">
</div>
</form>
            <?php
        }

    }
?>