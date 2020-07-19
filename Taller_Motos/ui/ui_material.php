<?php
require_once('gui.php');
require_once('ln/ln_inventory.php');
class ui_material extends gui
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
  function unidades()
  {
    return array('unid' => 'unid', 'mts' => 'mts','Lt' => 'Lt', 'ml' => 'ml', );
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
      <div class="alert bg-primary text-white clearfix">
    <div class="float-left">
    <h4> <span><i class="fas fa-bars"></i></span> Registro de Inventario</h4>
    </div>
    <div class="float-right">
      <a href="inventary.php" class="btn btn-dark">Ver Todas</a>
    </div>
      </div>
      <form method="post" action="materials.php?action=<?= $action ?>">
        <div class="row">
          <div class="col-lg-6 col-sm-12 col-12">
            <div class="card shadow">

              <div class="card-body">
                <input type="hidden" name="id" value="<?= $material['id_material'] ?>">
                <div class="row">
                  <div class="form-group  col-sm-6">
                    <label class="etiquetas">Nombre de Material</label>
                    <input class="form-control" type="text" name="nombre" value="<?= (isset($_GET['id']) ? $material['nombre'] : '') ?>">
                  </div>
                  <div class="col-sm-6">
                    <label class="etiquetas">Categoria</label>
                    <div class="input-group mb-3">
                      <select name="categoria" id="categoria" class="form-control">
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
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
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
                  </div>
                  <div class="form-group col-sm-6">
                    <label class="etiquetas">Cantidad Inicial</label>
                    <input class="form-control" type="number" name="cantidad" value="<?= $material['cantidad_inicial'] ?>">
                  </div>
                </div>

              </div>
            </div>
            <div class="modal fade" id="form_marca" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header bg-info text-white">
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
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="insert_marca()">Guardar</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal fade" id="form_categoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header bg-info text-white">
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
                    <button type="button" class="btn btn-info" data-dismiss="modal" onclick="insert_category()">Guardar</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-12 col-sm-12 col-lg-6">
            <div class="card shadow">
              <div class="card-body">
                <div class="row">

                  <div class="form-group col-sm-6">
                    <label class="etiquetas">Presentacion</label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="presentacion" value="0">
                      <div class="input-group-append">
                        <select id="my-select" class="form-control text-center" name="medida">
                          <?php
                          foreach ($this->unidades() as $data) { ?>
                            <option value="<?= $data ?>"><?= $data ?></option>

                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="form-group col-sm-6">
                    <label class="etiquetas">Cantidad Minimal</label>
                    <input class="form-control" type="number" name="cant_minima" value="<?= $material['cantidad_minima'] ?>">
                  </div>
                </div>
                <div class="row">

                  <div class="form-group col-sm-6">
                    <label class="etiquetas">Precio de Compra</label>
                    <input class="form-control" type="number" name="precio_compra" value="<?= $material['precio_compra'] ?>">
                  </div>
                  <div class="form-group col-sm-6">
                    <label class="etiquetas">Precio de Venta</label>
                    <input class="form-control" type="number" name="precio_venta" value="<?= $material['precio_venta'] ?>">
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
        <div class="text-center">
          <button class="btn btn-primary" type="submit"><i class="fas fa-file"></i> <?= $boton ?></button>
          <a href="materials.php" class="btn btn-info">Nuevo</a>
        </div>
      </form>

    </section>

<?php
  }
}
?>