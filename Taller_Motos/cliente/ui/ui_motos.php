<?php

require_once('gui_login.php');

class UI_Motos extends Gui_login
{

    function get_content(){
?>

<main id="main">
<!-- ======= Motos Section ======= -->
<section id="services" class="services">
      <div class="container">

        <div class="section-title">
          <h2>Motos</h2>
          
        </div>

        <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-4" id="columna_lista_motos">
  
        <div class="card shadow mt-4">
      
          <div class="card-body" id="cuerpo_card">
          
          <table id="tables" rol class="display">
          <thead>
          <tr role="row" class="odd parent">
            <th>Motos</th>
          </tr>
        </thead>

          <tbody>
            <tr>
          <td>Moto #1</td>
          </tr>
          <tr>
          <td>Moto #1</td>
          </tr>
          <tr>
          <td>Moto #1</td>
          </tr>
          <tr>
          <td>Moto #1</td>
          </tr>
          <tr>
          <td>Moto #1</td>
          </tr>
          <tr>
          <td>Moto #1</td>
          </tr>
          <tr>
          <td>Moto #1</td>
          </tr>
          <tr>
          <td>Moto #1</td>
          </tr>
          <tr>
          <td>Moto #1</td>
          </tr>
          <tr>
          <td>Moto #1</td>
          </tr>
          <tr>
          <td>Moto #1</td>
          </tr>
          

          
          
        </tbody>
        </table> 
         
          </div>
          </div>
          

          </div>

        </div>
        <div class="col-md-8">
        </div>
        </div>

      </div>
    </section><!-- End Motos Section -->
    </main>

     
     <?php
    }
}