<?php

require_once('gui_login.php');

class UI_validacion extends Gui_login
{

    function get_content()
    {
?>

        <div class="row formulario_login" id="div_form_validacion" style="display : none">
            <div class="col-sm-4"></div>

            <div class="col-sm-4">
                <div class="card shadow mt-4">
                    <div class="card-header" id="titulosCards">
                        <h5 class="card-title" id="nombre_empresa">Verificacion de codigo</h5>
                        <h6 class="card-title">Te hemos enviado un codigo de verificacion al correo electronico de tu cuenta Mighty Motors.</h6>
                        <div class="container">
                            <div id="invalido">
                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="body_cambio">
                        <form method="post" id=formulario_validar_codigo>
                            <input pattern="[A-Za-z0-9_-]{1,15}" class="form-control" type="text" placeholder="codigo" name="codigo" id="codigo">
                            <div class="container" id=div_reenviar>
                                <div id="total"><strong> <a id="boton_reenviar" onclick="reenviar_codigo()" class=" pregunta_contrasena link">
                                            <div id="div_icono_reenviar"><i id="icono_reenviar" class="fas fa-share"></i></div> reenviar codigo
                                        </a></strong></div>
                            </div>

                            <hr>
                            <button id="boton_validar" type="submit" class="btn btn-primary boton_success"><i class="fas fa-check-circle"></i> Validar</button>
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