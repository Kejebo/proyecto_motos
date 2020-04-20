<?php
require_once('ln/ln_purchase.php');
require_once('gui.php');
class ui_workshop extends Gui
{
    var $ln;

    function __construct($config)
    {
        parent::__construct($config);
        $this->ln = new ln_purchase();
    }

    function action_controller()
    {
        $this->ln->action_controller();
    }

    function get_content()
    {
        $purchase = null;

        $visibilidad = 'none';
        $action = 'insert';
        $script = 'insert_purchase';
        $fecha =  date("Y-m-d");
        $boton='none';
        if (isset($_GET['action'])) {
            if ($_GET['action'] == 'update_purchase') {
                $purchase = $this->ln->get_purchase($_GET['id']);
                $action = 'update';
                $boton = 'block';
                $visibilidad = 'block';
                $script = 'update_purchase';
                $fecha=$purchase[0]['fecha'];

            }
        }

?>
        <div class=" container row">
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 py-3">
                <div class="card shadow">
                    <div class="card-header">
                        <h5> <span> <i class="fas fa-bars"></i></span> Registro de Mantenimiento</h5>
                    </div>
                    <div class="card-body">
                        <form id="form-purchase" method="POST" action="<?= $action ?>">
                            <div class="form-group notificar">
                                <label class="etiquetas">Fecha de entrada</label>
                                <input class="form-control" id="entrada" type="date" name="entrada" value="<?=$fecha ?>">
                                <input type="hidden" name="id" id="id" value="<?= $purchase[0]['id'] ?>">
                            </div>

                            <div class="form-group">
                                <label class="etiquetas">Cliente</label>
                                <select class="form-control" name="proveedor" id="proveedor">
                                    <?php foreach ($this->ln->get_proveedor() as $proveedores) { ?>
                                        <option value="<?= $proveedores['id_proveedor'] ?>"><?= $proveedores['nombre'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group notificar">
                                <label class="etiquetas">Moto</label>
                                <select class="form-control" name="motos">
                                  <option>Seleccione un cliente</option>
                                </select>
                            </div>

                            <hr>
                            <div class="form-group">

                                <button class="btn btn-primary btn-block" type="submit"><i class="fas fa-file"></i> Registrar</button>
                                <button id="guardar" class="btn btn-success btn-block" type="button" style="display: <?= $boton ?>" onclick="sendpurchase('<?= $script ?>')"><i class="fas fa-file"></i> Guardar</button>
                                <a id="cancelar" href="purchases.php" class="btn btn-danger btn-block" style="display: <?= $boton ?>"><i class="fas fa-file"></i> Cancelar</a>

                            </div>
                            <hr>

                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-8 col-lg-8 py-3">

                <div class="card shadow" id="materials">
                    <div class="card-header">
                        <h5 class="card-title">Detalle de Reparacion</h5>
                    </div>
                    <div class="card-body">
                      <div class="bg-primary text-white card-title p-4  table-responsive" style="border-radius:20px;">
                      <div class="clearfix p-2">

                        <div class="float-left">
                          <h5 class="ml-2">Ajustes Realizados</h5>

                        </div>
                        <div class="float-right">
                          <button type="button" data-toggle="modal" data-target="#modal" class="btn btn-info mr-5">Agregar</button>
                        </div>
                      </div>

                        <table class="table table-inverse|reflow|striped|bordered|hover|sm text-center">
                          <tbody>
                            <tr>
                              <td>the Bird</td>
                              <td>@twitter</td>
                            </tr>
                          </tbody>
                        </table>
                      <br>
                      <div class="">

                      </div>
                      <div class="clearfix">

                        <div class="float-left">
                          <h5 class="ml-2">Materiales Utilizados</h5>

                        </div>
                        <div class="float-right">
                          <button type="button" data-toggle="modal" data-target="#modal_material" class="btn btn-info mr-5">Agregar</button>
                        </div>
                      </div>
                      <br>
                        <table class="table table-bordered" width="100%">
                            <thead class="thead-dark text-center text-white">
                                <th>Material</th>
                                <th>Cant</th>
                                <th>Eliminar</th>
                            </thead>
                            <tbody id="detalle" class="text-center">


                            </tbody>
                          </table>


                    </div>
                </div>
              </div>
            </div>

        </div>
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog  modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Seleccione un trabajo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label class="etiquetas">Trabajo</label>
                  <select class="form-control" name="trabajo">
                    <option value="1">Cambio de Aceite</option>
                    <option value="2">Cambio de motor</option>
                  </select>

                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Agregar</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="modal_material" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog  modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Seleccione un Material</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label class="etiquetas">Material</label>
                  <div class="input-group mb-3">
                      <select class="form-control" name="material" id="material">
                          <?php foreach ($this->ln->get_inventory() as $material) { ?>
                              <option value="<?= $material['id'] ?>"><?= $material['nombre'] . ' ' . $material['marca'] . ' ' .
                                                                          $material['monto'] . $material['medida'] ?></option>
                          <?php } ?>
                      </select>
                      <div class="input-group-append">
                          <span class="btn btn-success"><i class="fas fa-file"></i></span>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="etiquetas">Cantidad</label>
                      <input type="number" class="form-control" name="cantidad" id="cantidad" required value="0" min="0">
                  </div>


                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Agregar</button>
              </div>
            </div>
          </div>
        </div>



<?php
    }
}
?>
