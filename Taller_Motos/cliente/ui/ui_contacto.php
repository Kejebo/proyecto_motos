<?php
require_once('gui_login.php');

class UI_Contacto extends Gui_login
{
   var $nombre_usuario;
   var $correo_usuario;

  
    function __construct()
    {
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
            <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
          </div>

          <div class="row" data-aos="fade-in">

            <div class="col-lg-5 d-flex align-items-stretch">
              <div class="info">
                <div class="address">
                  <i class="icofont-google-map"></i>
                  <h4>Direccion:</h4>
                  <p>A108 Adam Street, New York, NY 535022</p>
                </div>

                <div class="email">
                  <i class="icofont-envelope"></i>
                  <h4>Correo:</h4>
                  <p>info@example.com</p>
                </div>

                <div class="phone">
                  <i class="icofont-phone"></i>
                  <h4>Telefono:</h4>
                  <p>+1 5589 55488 55s</p>
                </div>

                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3302.99302346789!2d-83.51052993498512!3d10.103767774176301!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8fa733ffb3380d25%3A0x790c0be225c3c266!2sBarrio%20San%20Rafael%2C%20Lim%C3%B3n%2C%20Siquirres%2C%20Costa%20Rica!5e0!3m2!1ses!2sni!4v1594764865034!5m2!1ses!2sni" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>   
              </div>

            </div>

            <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
              <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="name"> Tu Nombre</label>
                    <input type="text" value=<?=$this->nombre_usuario?> name="name" class="form-control" id="name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                    <div class="validate"></div>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="name"> Tu Correo</label>
                    <input type="email" value=<?=$this->correo_usuario?> class="form-control"  name="email" id="email" data-rule="email" data-msg="Please enter a valid email"  />
                    <div class="validate"></div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="name">Tema</label>
                  <input type="text" class="form-control" name="subject" id="subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                  <div class="validate"></div>
                </div>
                <div class="form-group">
                  <label for="name">Mensaje</label>
                  <textarea class="form-control" name="message" rows="10" data-rule="required" data-msg="Please write something for us"></textarea>
                  <div class="validate"></div>
                </div>
                <div class="mb-3">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>
                </div>
                <div class="text-center"><button type="submit">Enviar Mensaje</button></div>
              </form>
            </div>

          </div>

        </div>
      </section><!-- End Contact Section -->

    </main><!-- End #main -->
                
  

<?php
    }
}