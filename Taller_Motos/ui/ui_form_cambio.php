<?php

require_once('gui_login.php');

    class UI_form_cambio extends Gui_login{


        function get_content()
        {
            ?>

<div>

<div class="row formulario_login"  id="div_form_cambio" style="display : none">
<div class="col-sm-4"></div>
    
<div class="col-sm-4">
<div class="card shadow mt-4">
<div class="card-header" id="titulosCards">
<h5 class="card-title" id="nombre_empresa">Recuperacion de contraseña</h5>
<h6 class="card-title">Por favor ingrese su nueva contraseña</h6>
<div id="cambio_correcto">
</div>
</div>
<div class="card-body body_cambio">

<form method="post" id="formulario">

<div class="input-group mb-3" id="grup_pass_uno">
<input type="password" pattern="[A-Za-z0-9_-]{1,15}" class="form-control pass-input" placeholder="Nueva Contraseña" onblur="quitarborde('grup_pass_uno')" onclick="ponerborde('grup_pass_uno','contrasenaUno')" name="contrasena" id="contrasenaUno" required>
<div class="input-group-append">
    <div id="ojos">
    <a class="btn" id="ojo" onclick="mostrarPass('contrasenaUno','font_ojo_uno')"><i onclick="cambiarojo('font_ojo_uno')" class="far fa-eye" id="font_ojo_uno"></i></a>
    </div>
    </div>
    </div>

<hr>

<div class="input-group mb-3" id="grup_pass_dos">
<input type="password" pattern="[A-Za-z0-9_-]{1,15}" class="form-control pass-input" placeholder="Repetir Contraseña" onblur="quitarborde('grup_pass_dos')" onclick="ponerborde('grup_pass_dos','contrasenaDos')"  name="confirmarContrasena" id="contrasenaDos" required>
<div class="input-group-append">
    <div id="ojos">
    <a class="btn" id="ojo" onclick="mostrarPass('contrasenaDos','font_ojo_dos')"><i onclick="cambiarojo('font_ojo_dos')" class="far fa-eye" id="font_ojo_dos"></i></a>
    </div>
    </div>
    </div>

<div class="container">
<div id="no_iguales">

</div>
</div>
<hr>
<button class = "btn btn-primary boton_success"  type ="submit"  id="bcambio" ><i class="fas fa-save"></i> Cambiar</button>

</form>
</div>
</div>   

</div>
<div class="col-sm-4"></div>
</div>


    <?php
        }

    }
?>