<?php
require_once('gui_login.php');
require_once('db/db_admin.php');

class UI_Contacto extends Gui_login
{
  var $nombre_usuario;
  var $correo_usuario;
  var $admin;


  function __construct()
  {
    $this->admin = new db_admin();
    if (isset($_COOKIE['cliente'])) {
      $data = json_decode($_COOKIE['cliente'], true);
      $this->nombre_usuario = $data['nombre_cliente'];
      $this->correo_usuario = $data['correo'];
    }
  }

  function get_content()
  {
?>
    <main id="main">
      <!-- ======= Contact Section ======= -->
      <section id="contact" class="contact">
        <div class="container">

          <div class="section-title">
            <h2>Contacto</h2>
            <!--<p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>-->
          </div>

          <div class="row" data-aos="fade-in">
            <?php $data = $this->admin->get_admin();?>
            <div class="col-lg-5 d-flex align-items-stretch">
              <div class="info">
                <div class="address">
                  <i class="icofont-google-map"></i>
                  <h4>Direccion:</h4>
                  <p><?=$data['direccion'];?></p>
                </div>

                <div class="email">
                  <i class="icofont-envelope"></i>
                  <h4>Correo:</h4>
                  <p><?=$data['correo'];?></p>
                </div>

                <div class="phone">
                  <i class="icofont-phone"></i>
                  <h4>Telefono:</h4>
                  <p><?=$data['telefono'];?></p>
                </div>

                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3302.99302346789!2d-83.51052993498512!3d10.103767774176301!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8fa733ffb3380d25%3A0x790c0be225c3c266!2sBarrio%20San%20Rafael%2C%20Lim%C3%B3n%2C%20Siquirres%2C%20Costa%20Rica!5e0!3m2!1ses!2sni!4v1594764865034!5m2!1ses!2sni" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
              </div>

            </div>

            <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
              <form id="formulario_enviar_correo_consulta" method="post">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="name"> Tu Nombre</label>
                    <input type="text" value=<?= $this->nombre_usuario ?> name="nombre" class="form-control" id="nombre" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                    <div class="validate"></div>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="name"> Tu Correo</label>
                    <input type="emisor" value=<?= $this->correo_usuario ?> class="form-control" name="emisor" id="emisor" data-rule="email" data-msg="Please enter a valid email" />
                    <div class="validate"></div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="name">Tema</label>
                  <input type="text" class="form-control" name="tema" id="tema" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                  <div class="validate"></div>
                </div>
                <div class="form-group">
                  <label for="name">Mensaje</label>
                  <textarea class="form-control" name="mensaje" id="mensaje" rows="10" data-rule="required" data-msg="Please write something for us"></textarea>
                  <div class="validate"></div>
                </div>
                <div id="div_correo_no_enviado"></div>
                <div id="enviar_correo_boton">
                  <button id="boton_enviar_consulta" type="submit" class="btn btn-primary boton_success"><i id="icono_reenviar" class="fas fa-share"></i> enviar correo</button>
                </div>
              </form>
            </div>

          </div>

        </div>
      </section><!-- End Contact Section -->

    </main><!-- End #main -->



<?php
  }
}
