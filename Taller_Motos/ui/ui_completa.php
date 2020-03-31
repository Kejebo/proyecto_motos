<?php

require_once('gui.php');

    class UI_completa extends Gui{


        function get_content()
        {
            ?>

<div class="row formulario_login"  id="div_form_completa">
<div class="col-sm-4"></div>
    
<div class="col-sm-4">
<div class="card shadow mt-4">
  <div class="card shadow mt-4" id=modal_card>
    <div class="card-header" id="titulosCards">
    <h6 class="modal-title" id="nombre_empresa">Ingrese su correo para cambio de contraseña</h6>
    </div>
    <div class="card-body">
    
    <form method="post" id="formulario_enviar_correo">

    <input type="text" class="form-control" placeholder="Correo Electronico" name="correo_electronico_link" required>

    <hr>
    <div id="enviar_correo_boton">
    <button type="submit" class="btn btn-primary boton_success"><i id="icono_reenviar"class="fas fa-share"></i> enviar correo</button>
    </div>
    </div>

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