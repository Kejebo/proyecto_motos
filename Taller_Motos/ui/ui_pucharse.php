<?php
require_once('gui.php');
class Ui_pucharse extends Gui
{
    var $ln;

    function __construct()
    {
        //        $this->ln = new ln_user();
    }

    function action_controller()
    {
        //      $this->ln->action_controller();
    }

    function get_content()
    {
        $user = null;
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
                        <form method="POST" action="users.php?action=<?= $action ?>">
                            <input type="hidden" name="id_usuario" value="<?= $user['id_usuario'] ?>">
                            <div class="form-group">
                                <label class="etiquetas">fecha</label>
                                <input class="form-control" type="date" name="fecha">
                            </div>

                            <div class="form-group">
                                <label class="etiquetas">Numero de factura</label>
                                <input class="form-control" type="text" name="factura">
                            </div>
                            <div class="form-group">
                                <label class="etiquetas">Proveedor</label>
                                <select id="my-select" class="form-control" name="">
                                    <option>Text</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="etiquetas">Material</label>
                                <select id="my-select" class="form-control" name="">
                                    <option>Text</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="etiquetas">Cantidad</label>
                                <input type="number" class="form-control" name="cantidad" id="">
                            </div>

                            <div class="form-group">
                                <label class="etiquetas">Precio</label>
                                <input type="number" class="form-control" name="precio" id="">
                            </div>

                            <hr>
                            <button class="btn btn-primary btn-block" type="submit"><i class="fas fa-file"></i> <?= $boton ?></button>
                            <hr>

                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-8 col-lg-9 py-3">

            <div class="card shadow">
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
                <br>
                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="card-title">Lista de Usuarios</h5>
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