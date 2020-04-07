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
                                <input class="form-control" id="fecha" type="date" name="fecha" value="<?=$fecha ?>">
                                <input type="hidden" name="id" id="id" value="<?= $purchase[0]['id'] ?>">
                            </div>
                            <div class="form-group notificar">
                                <label class="etiquetas">Fecha de salida</label>
                                <input class="form-control" id="fecha" type="date" name="fecha" value="<?=$fecha ?>">
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
                            <label class="etiquetas">Material</label>
                            <div class="input-group mb-3">
                                <select class="form-control" name="material" id="material">
                                    <?php foreach ($this->ln->get_inventory() as $material) { ?>
                                        <option value="<?= $material['id'] ?>"><?= $material['nombre'] . ' ' . $material['marca'] . ' ' .
                                                                                    $material['monto'] . $material['medida'] ?></option>
                                    <?php } ?>
                                </select>
                                <div class="input-group-append">
                                    <a href="inventary.php" class="btn btn-success"><i class="fas fa-file"></i></a>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="etiquetas">Cantidad</label>
                                <input type="number" class="form-control" name="cantidad" id="cantidad" required value="0" min="0">
                            </div>

                            <div class="form-group">
                                <label class="etiquetas">Ajustes</label>
                                <textarea name="ajustes" class="form-control" rows="2" cols="80" placeholder="Agregue el arrego"></textarea>
                                <button type="button" class="btn btn-secondary">Agregar</button>
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

                <div class="card shadow" id="purchase">
                    <div class="card-header">
                        <h5 class="card-title">Detalle de compra</h5>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark text-center text-white">
                                <th>Material</th>
                                <th>Cantidad</th>
                                <th>Eliminar</th>
                            </thead>
                            <tbody id="detalle" class="text-center">


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
