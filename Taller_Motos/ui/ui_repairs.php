<?php
require_once('gui.php');
class ui_repairs extends Gui
{
    var $ln;

    function __construct($config)
    {
        parent::__construct($config);
    }

    function get_content()
    {
      ?>
<div class="container row">
  <div class="col-12 col-sm-12 col-md-12 col-lg-12 py-3">
    <div class="card shadow">
      <div class="card-header">
        <div class="clearfix">
          <div class="float-left">
            <h5 class="card-title">Lista de Reparaciones</h5>

          </div>
          <div class="float-right">
            <a class="btn btn-dark" href="workshop.php"> + Nuevo</a>
          </div>
        </div>

      </div>
      <div class="card-body table-responsive">
        <table class="table table-bordered" id="example">
          <thead class="thead-dark text-center text-white">
            <tr>
              <th>Fecha</th>
              <th>Cliente</th>
              <th>Moto</th>
              <th>Placa</th>
              <th>Precio</th>
              <th>Editar</th>
              <th>Eliminar</th>

            </tr>
          </thead>
          <tbody class="text-center">

          </tbody>

        </table>
      </div>
    </div>
  </div>
</div>

<?php
    }
}
?>
