<?php
require_once('gui.php');
require_once('ln/ln_inventory.php');
class ui_inventary extends gui
{
  var $ln;

  function __construct($config)
  {
    parent::__construct($config);
    $this->ln = new ln_inventory();
  }
  function action_controller()
  {
    $this->ln->action_controller();
  }
  function get_content()
  {
    $material = null;
    $action = 'insert';
    $boton = 'Registrar';
    if (isset($_GET['action'])) {
      if ($_GET['action'] == 'update_material') {

        $material = $this->ln->get_material($_GET['id']);

        $action = 'update';
        $boton = 'Actualizar';
      }
    }
?>

    <section class="container" style="color: #04ADBF;">
      <div class="row">
        <div class="col-lg-3">
          <div class="card shadow">
            <div class="card-header">
              <h6 style="margin-left: 20px"> <span><i class="fas fa-bars"></i></span> Registro de Inventario</h6>
            </div>
            <div class="card-body">
              <form method="post" action="inventary.php?action=<?= $action ?>">
                <input type="hidden" name="id" value="<?= $material['id_material'] ?>">
                <div class="form-group">
                  <label class="etiquetas">Nombre</label>
                  <input class="form-control" type="text" name="nombre" value="<?= $material['nombre'] ?>">
                </div>

                <label class="etiquetas">Categoria</label>
                <div class="input-group mb-3">
                  <select name="categoria" id="categoria" class="form-control" onchange="selec(this)">
                    <?php foreach ($this->ln->get_category() as $lista) {
                      if ($material['id_categoria'] == $lista['id_categoria']) {
                    ?>
                        <option selected value="<?= $lista['id_categoria'] ?>"><?= $lista['nombre_categoria'] ?></option>
                      <?php } else { ?>
                        <option value="<?= $lista['id_categoria'] ?>"><?= $lista['nombre_categoria'] ?></option>
                    <?php }
                    } ?>
                  </select>
                  <div class="input-group-append">
                    <span class="btn btn-success" type="submit" data-toggle="modal" data-target="#form_categoria">+</span>
                  </div>
                </div>


                <label class="etiquetas">Marca</label>

                <div class="input-group mb-3">
                  <select name="marca" class="form-control" id="marca">
                    <?php foreach ($this->ln->get_marcas() as $list) {
                      if ($material['id_marca_material'] == $list['id_marca_material']) { ?>
                        <option selected value="<?= $list['id_marca_material'] ?>"><?= $list['nombre_marca'] ?></option>
                      <?php } else { ?>
                        <option value="<?= $list['id_marca_material'] ?>"><?= $list['nombre_marca'] ?></option>
                    <?php  }
                    } ?>
                  </select>
                  <div class="input-group-append">
                    <span class="btn btn-success" type="submit" data-toggle="modal" data-target="#form_marca">+</span>
                  </div>
                </div>

                <div class="form-group">
                  <label class="etiquetas">Cantidad inicial</label>
                  <input class="form-control" type="number" name="cantidad" value="<?= $material['cantidad_inicial'] ?>">
                </div>

                <div class="form-group" id="monto" style="display: none">
                  <label class="etiquetas">Presentacion</label>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" name="presentacion" value="0">
                    <div class="input-group-append">
                      <span class="input-group-text medida">Unid</span>
                    </div>
                  </div>

                </div>
                <div class="form-group presentacion">
                  <label class="etiquetas">Cantidad minima</label>
                  <input class="form-control" type="number" name="cant_minima" value="<?= $material['cantidad_minima'] ?>">
                </div>

                <div class="form-group">
                  <label class="etiquetas">Precio de Compra</label>
                  <input class="form-control" type="number" name="precio_compra" value="<?= $material['precio_compra'] ?>">
                </div>
                <div class="form-group">
                  <label class="etiquetas">Precio de Venta</label>
                  <input class="form-control" type="number" name="precio_venta" value="<?= $material['precio_venta'] ?>">
                </div>

                <hr>
                <button class="btn btn-primary btn-block" type="submit"><i class="fas fa-file"></i> <?= $boton ?></button>
              </form>
            </div>
          </div>
          <div class="modal fade bg-dark" id="form_marca" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Agregar Marca</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label class="etiquetas">Nombre</label>
                    <input class="form-control" type="text" id="nombre_marca" placeholder="ingrese el nombre de la marca">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="insert_marca()">Guardar</button>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="form_categoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Agregar Categoria</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label class="etiquetas">Nombre</label>
                    <div class="input-group mb-3">
                      <input class="form-control" type="text" id="nombre_categoria" placeholder="Ingrese el nombre de la categoria">
                      <div class="input-group-append">
                        <select name="" id="id_medida" class="form-control">
                          <?php foreach ($this->ln->get_medidas() as $medidas) { ?>
                            <option value="<?= $medidas['id_medida'] ?>"><?= $medidas['nombre_medida'] ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>

                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="insert_category()">Guardar</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-sm-12 col-md-8 col-lg-9">
          <div class="card shadow">
            <div class="card-header">
              <h5 class="card-title">Lista de Materiales</h5>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-bordered" id="example">
                <thead class="thead-dark text-center">
                  <tr>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Venta</th>
                    <th>Compra</th>
                    <th>Eiminar</th>
                    <th>Editar</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                  <?php foreach ($this->ln->get_inventory() as $list) { ?>
                    <tr>
                      <td><?= $list['nombre']; ?></td>
                      <td><?= $list['saldo']; ?></td>
                      <td><?= $list['venta']; ?></td>
                      <td><?= $list['compra']; ?></td>
                      <td><a href="inventary.php?action=delete&id=<?= $list['id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                      <td><a href="inventary.php?action=update_material&id=<?= $list['id']; ?>" class="btn btn-warning text-white"><i class="fas fa-edit"></i></a></td>

                    </tr>
                  <?php } ?>
                </tbody>

              </table>
            </div>
          </div>
        </div>
        </div>

    </section>

<?php
  }
}
?>