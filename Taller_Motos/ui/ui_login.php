<?php

require_once('gui_login.php');
require_once('db/db_admin.php');
class UI_login extends Gui_login
{
    var $admin;
    var $data;
    function __construct($config){
    parent::__construct($config);
    $this->admin = new db_admin();
    $this->data = $this->admin->get_admin();
    
        
    }

    function get_content()
    {
?>

        <div class="row formulario_login">

            <div class="col-12 col-sm-12 col-md-12 col-lg-4 py-3"></div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-4 py-3">
                <form action="security.php?action=login" method="post">
                    <div class="card shadow mt-4">
                   
                        <div class="card-header" id="titulosCards" style="background-image: url('<?=$this->data['logo']?>')">
                            <h6 class="card-title" id="nombre_empresa">Taller <?=$this->data['nombre']?></h6>
                            <h5 class="card-title">Bienvenidos</h5>

                        </div>

                        <div class="card-body">

                            <?php if (isset($_GET['mer'])) { ?>

                                <div class="alert alert-danger alert-dismissible fade show">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Error!</strong> Usuario o Contraseña incorrectos, Intente nuevamente.
                                </div>
                            <?php } ?>

                            <input type="text" patteern="[A-Za-z0-9_-]{1,15}" required class="form-control" id="inputuser" placeholder="Usuario" name="correo_electronico">
                            <hr>

                            <div class="input-group mb-3" id="grup-pass">
                                <input type="password" required pattern="[A-Za-z0-9_-]{1,15}" class="form-control pass-input" onblur="quitarborde('grup-pass')" onclick="ponerborde('grup-pass','inputpass')" placeholder="Contraseña" id=inputpass name="contrasena">
                                <div class="input-group-append">
                                    <div id="ojos">
                                        <a class="btn" id="ojo" onclick="mostrarPass('inputpass','font_ojo')"><i onclick="cambiarojo('font_ojo')" class="far fa-eye" id="font_ojo"></i></a>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="iniciar_sesion_boton">
                                <button class="btn btn-primary boton_success" id="boton_inicio_sesion"><i class="fas fa-sign-in-alt"></i> Entrar</button>
                            </div>

                            <hr>


                            <div id="contenedor_pregunta">
                                <a href="recuperacion.php" class="pregunta_contrasena">¿Olvidaste tu contraseña?</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 py-3"></div>

        </div>

<?php
    }
}
?>