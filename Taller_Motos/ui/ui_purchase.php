<?php
require_once('gui.php');
require_once('ln/ln_purchase.php');
class ui_purchase extends Gui
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
        $action = 'insert';
        $boton = 'Registrar';
        if (isset($_GET['action'])) {
            if ($_GET['action'] == 'update_user') {
                //            $user=$this->ln->get_user($_GET['id']);
                $action = 'update';
                $boton = 'Actualizar';
            }
        }

?>
        <div class=" container row">
            <div class="col-12 col-sm-12 col-lg-3 py-3">
                <div class="card shadow">
                    <div class="card-header">
                        <h5 <span><i class="fas fa-bars"></i></span> Registrar Compra</h5>
                    </div>
                    <div class="card-body">
                        <form  id="form-purchase" method="POST" action="purchases.php?action=<?= $action ?>">
                            <input type="hidden" name="id" value="">
                            <div class="form-group">
                                <label class="etiquetas">Fecha</label>
                                <input class="form-control" type="date" name="fecha">
                            </div>

                            <div class="form-group">
                                <label class="etiquetas">Numero de factura</label>
                                <input class="form-control" type="text" name="factura" id="factura">
                            </div>
                            <div class="form-group">
                                <label class="etiquetas">Proveedor</label>
                                <select class="form-control" name="proveedor" id="proveedor">
                                    <?php foreach ($this->ln->get_proveedor() as $proveedores) { ?>
                                        <option value="<?= $proveedores['id_proveedor'] ?>"><?= $proveedores['nombre'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="etiquetas">Material</label>
                                <select class="form-control" name="material" id="material">
                                <?php foreach ($this->ln->get_inventory() as $material) { ?>
                                        <option value="<?= $material['id'] ?>"><?= $material['nombre'].' '.$material['marca'].' '.
                                        $material['monto'] .$material['medida']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="etiquetas">Cantidad</label>
                                <input type="number" class="form-control" name="cantidad" id="cantidad">
                            </div>

                            <div class="form-group">
                                <label class="etiquetas">Precio</label>
                                <input type="number" class="form-control" name="precio" id="precio">
                            </div>

                            <hr>
                            <button class="btn btn-primary btn-block" type="submit"><i class="fas fa-file"></i> <?= $boton ?></button>
                            <hr>

                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-8 col-lg-9 py-3">

                <div class="card shadow" id="purchase">
                    <div class="card-header">
                        <h5 class="card-title">Detalle de compra</h5>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark text-center text-white">
                                <th>Material</th>
                                <th>Cantidad</th>
                                <th>SubTotal</th>
                                <th>Total</th>
                                <th>Eliminar</th>
                            </thead>
                        </table>


                    </div>
                </div>
                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="card-title">Lista de Compras</h5>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered" id="example">
                            <thead class="thead-dark text-center text-white">
                                <tr>
                                    <th>Fecha</th>
                                    <th>#Factura</th>
                                    <th>Proveedor</th>
                                    <th>Total</th>
                                    <th>Eliminar</th>
                                    <th>Editar</th>

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