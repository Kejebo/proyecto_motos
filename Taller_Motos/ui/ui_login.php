<?php

require_once('gui.php');

    class UI_login extends Gui{

        

        function get_content()
        {
            ?>
            
            <div>
    <div class="row formulario_login">
    <div class="col-sm-4"></div>
    
    <div class="col-sm-4">
    <form action="security.php?action=login" method="post">
    <div class="card shadow mt-4">
    <div class="card-header" id="titulosCards">
    <h6 class="card-title" id="nombre_empresa">Taller de Motos Mighty</h6>
    <h5 class="card-title">Bienvenidos</h5>

    <select id="usuarios" name="tipo_usuario" required>
    <option value="" data-content="<i class='fas fa-users' 'aria-hidden='true'></i>"> Tipos de Usuarios</option>
    <option value="Administrador"><i class="fas fa-user-tie"></i> Administrador</option>
    <option value="Cliente"><a><i class="fas fa-user"></i> Cliente</option>
    </select>

    </div>
    
    <div class="card-body">

   <?php if(isset($_GET['mer'])){?>

    <div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Error!</strong> Usuario o Contraseña incorrectos, Intente nuevamente.
    </div>
   <?php } ?>
    
    <input type="text"  patteern="[A-Za-z0-9_-]{1,15}" required class="form-control" id="inputuser" placeholder="Usuario" name="correo_electronico">
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
    </form>
    </div>
   
    <hr>

    
    <div id="contenedor_pregunta">
    <a   href="completa.php" class="pregunta_contrasena" >¿Olvidaste tu contraseña?</a>

  
    
   
  

    </div>
    </div>
  



    <div class="col-sm-4"></div>

    </div>
            <?php
        }

    }
?>