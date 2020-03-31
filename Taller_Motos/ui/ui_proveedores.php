<?php
require_once('gui.php');
require_once('ln/ln_proveedor.php');
class ui_proveedores extends gui
{
  var $ln;


  function __construct($config)
  {
    parent::__construct($config);
    $this->ln = new ln_proveedor();
  }

  function action_controller()
  {
    $this->ln->action_controller();
  }

  function get_content()
  {
    $proveedor = null;
    $action = 'insert';
    $boton = 'Registrar';
    if (isset($_GET['action'])) {
      if ($_GET['action'] == 'update_proveedor') {
        $proveedor = $this->ln->get_proveedor($_GET['id']);
        $action = 'update';
        $boton = 'Actualizar';
      }
    }
?>
    <section class="container py-3" style="color: #04ADBF;">
      <div class="row">
        <div class="col-12 col-sm-4 py-3">
          <div class="card shadow">
            <div class="card-header">
              <h5 class="card-title">Registro de Proveedores</h5>
            </div>
            <div class="card-body">
              <form action="proveedores.php?action=<?= $action ?>" method="post">
                <input class="form-control" type="hidden" name="id_proveedor" value="<?= $proveedor['id_proveedor'] ?>">

                <div class="form-group">
                  <label class="etiquetas">Nombre Completo</label>
                  <input class="form-control" type="text" name="nombre" value="<?= $proveedor['nombre'] ?>">
                </div>
                <div class="form-group">
                  <label class="etiquetas">Telefono</label>
                  <input class="form-control" type="text" name="telefono" value="<?= $proveedor['telefono'] ?>">
                </div>
                <div class="form-group">
                  <label class="etiquetas">Correo</label>
                  <input class="form-control" type="text" name="correo" value="<?= $proveedor['correo'] ?>">
                </div>
                <div class="form-group">
                  <label class="etiquetas">Cedula Juridica</label>
                  <input class="form-control" type="text" name="cedula" value="<?= $proveedor['cedula_juridica'] ?>">
                </div>
                <hr>
                <button class="btn btn-primary btn-block " type="submit"><?= $boton ?></button>
              </form>
            </div>
          </div>
        </div>
        <br>
        <div class="col-12 col-sm-8 py-3">
          <div class="card shadow ">
            <div class="card-header">
              <h5 class="card-title">Lista de Proveedores</h5>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-bordered" id="example">
                <thead class="thead-dark text-center text-white">
                  <tr>
                    <th>Nombre</th>
                    <th>Cedula Juridica</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>Eliminar</th>
                    <th>Editar</th>

                  </tr>
                </thead>
                <tbody class="text-center">
                  <?php foreach ($this->ln->get_proveedores() as $list) { ?>
                    <tr>
                      <td><?= $list['nombre']; ?></td>
                      <td><?= $list['cedula_juridica']; ?></td>
                      <td><?= $list['telefono']; ?></td>
                      <td><?= $list['correo']; ?></td>
                      <td><a href="proveedores.php?action=delete&id=<?= $list['id_proveedor']; ?>" class="btn btn-danger">x</a></td>
                      <td><a href="proveedores.php?action=update_proveedor&id=<?= $list['id_proveedor']; ?>" class="btn btn-warning">edit</a></td>
                    </tr>
                  <?php } ?>
                </tbody>

              </table>
            </div>
          </div>
        </div>
      </div>

    </section>
    </main>


<?php
  }
}
?>