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
        <div class=" container row">
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 py-3">
                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="card-title">Lista de Ventas</h5>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered" id="example">
                            <thead class="thead-dark text-center text-white">
                                <tr>
                                    <th>Fecha</th>
                                    <th>Cliente</th>
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
