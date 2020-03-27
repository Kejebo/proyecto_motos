<?php

require_once('gui.php');

    class UI_form_cambio extends Gui{


        function get_content()
        {
            ?>
            <div style="width: 500px">

<h5>From de cambio de contrasena</h5>

<div id="cambio_correcto">

</div>

<form method="post" id="formulario">

<input type="hidden" value=<?=$_GET['user_id'];?> name="id" id="id">

<div class="input-group mb-3" id="grup_pass_uno">
<input type="password" pattern="[A-Za-z0-9_-]{1,15}" class="form-control pass-input" placeholder="nueva_contrasena" onblur="quitarborde('grup_pass_uno')" onclick="ponerborde('grup_pass_uno','contrasenaUno')" name="contrasena" id="contrasenaUno" required>
<div class="input-group-append">
    <div id="ojos">
    <a class="btn" id="ojo" onclick="mostrarPass('contrasenaUno','font_ojo_uno')"><i onclick="cambiarojo('font_ojo_uno')" class="far fa-eye" id="font_ojo_uno"></i></a>
    </div>
    </div>
    </div>

<hr>

<div class="input-group mb-3" id="grup_pass_dos">
<input type="password" pattern="[A-Za-z0-9_-]{1,15}" class="form-control pass-input" placeholder="verificar_contrasena" onblur="quitarborde('grup_pass_dos')" onclick="ponerborde('grup_pass_dos','contrasenaDos')"  name="confirmarContrasena" id="contrasenaDos" required>
<div class="input-group-append">
    <div id="ojos">
    <a class="btn" id="ojo" onclick="mostrarPass('contrasenaDos','font_ojo_dos')"><i onclick="cambiarojo('font_ojo_dos')" class="far fa-eye" id="font_ojo_dos"></i></a>
    </div>
    </div>
    </div>


<div id="no_iguales">

</div>
<hr>

<button  type ="submit"  id="bcambio" >Cambiar</button>

</form>

</div>
         
            <?php
        }

    }
?>