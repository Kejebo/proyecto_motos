<?php
require_once('ln/ln_inventory.php');
require_once('ln/ln_client.php');
require_once('gui.php');
class ui_report extends Gui
{
    var $ln;
    var $db;
    function __construct($config)
    {
        parent::__construct($config);
    }

    function get_options()
    {
        $data = array(
            'Seleccione una opcion' => 'Seleccione una opcion',
            'Inventario' => 'Inventario',
            'Clientes' => 'Clientes',
            'Motos de Cliente' => 'Motos de Cliente',
            'Proveedore' => 'Proveedores',
            'Ventas General' => 'Ventas General',
            'Ventas Diaria' => 'Ventas Diaria',
            'Ventas Mensuales' => 'Ventas Mensuales',
            'Ventas Periodica' => 'Ventas Periodica',
            'Ventas Anuales' => 'Ventas Anuales',
            'Compras General' => 'Compras General',
            'Compras Diaria' => 'Compras Diaria',
            'Compras Mensuales' => 'Compras Mensuales',
            'Compras Periodica' => 'Compras Periodica',
            'Compras Anuales' => 'Compras Anuales',
            'Reparaciones General' => 'Reparaciones General',
            'Reparaciones Diaria' => 'Reparaciones Diaria',
            'Reparaciones Mensuales' => 'Reparaciones Mensuales',
            'Reparaciones Periodica' => 'Reparaciones Periodica',
            'Reparaciones Anuales' => 'Reparaciones Anuales'
        );

        return $data;
    }
    function action_controller()
    {
    }

    function get_content()
    {

?>
        <form method="POST" id="report" action="sale.php?action=">
            <div class=" container row">
                <div class="col-sm-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h5> <span> <i class="fas fa-bars"></i></span> Registrar Venta</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label>Tipo de Consulta</label>
                                    <select class="form-control" name="consultas" id="tipo" onchange="selec_report(this)">
                                        <?php
                                        foreach ($this->get_options() as $list) { ?>
                                            <option value="<?= $list ?>"><?= $list ?></option>

                                        <?php }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4" id="cliente" style="display: none;">
                                    <label>Clientes</label>
                                    <select class="form-control" name="cliente" onchange="get_client_motorcycle(this)">
                                        <?php
                                        $this->db = new ln_client();
                                        foreach ($this->db->get_clients() as $clients) { ?>
                                            <option value="<?= $clients['id_cliente'] ?>"><?= $clients['nombre_cliente'] ?></option>

                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4" id="fecha" style="display: none;">
                                    <label for="my-select">Fecha</label>
                                    <input type="date" name="fecha" id="dia" class="form-control" required onchange="get_Fecha(this)">
                                </div>
                                <div class="col-sm-4 form-group" id="inicio" style="display: none;">
                                    <label for="my-select">Fecha Inicio</label>
                                    <input type="date" name="inicio" class="form-control" required> </div>
                                <div class="form-group col-sm-4" id="final" style="display: none;">
                                    <label for="my-select">Fecha Final</label>
                                    <input type="date" class="form-control" required> </div>
                            </div>
                            <div class="form-group ml-3">
                                <button class="btn btn-primary" type="submit" id="consultar"><i class="fas fa-file"></i> Consultar</button>
                                <a id="pdf" href="pdf.php?data=Inventario" target="blank" class="btn btn-info"><i class="fas fa-file"></i> Generar PDF</a>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </form>
        <br>
        <div class="card">
            <div class="card-body">
                <table class="table table-light">
                    <thead>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Eliminar</th>
                        <th>Editar</th>
                        <th>Exportar</th>
                    </thead>
                    <tbody>
                        <?php

                        ?>
                        <tr>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
<?php
    }
}
?>