<?php
require_once('gui.php');
require_once('ln/ln_admin.php');
class Ui_admin extends Gui
{
    var $ln;


    function __construct($config)
    {
        parent::__construct($config);
        $this->ln = new ln_admin();
    }

    function action_controller()
    {
        $this->ln->action_controller();
    }

    function get_content()
    {
        $client = null;
        $action = 'insert';
        $boton = 'Registrar';
        if (isset($_GET['action'])) {
            if ($_GET['action'] == 'update_admin') {
                $action = 'update';
                $boton = 'Actualizar';
            }
        }

?>
        <form method="POST" action="admin.php?action=<?= $action ?>" enctype="multipart/form-data">
            <div class=" container row">
                <div class="col-12 col-sm-12 col-lg-6">
                    <div class="card shadow">

                        <div class="card-body">
                            <input type="hidden" name="id_empresa" value="<?= ($client != null) ? $client['id_cliente'] : '' ?>">
                            <div class="form-group">
                                <label class="etiquetas">Logo</label>
                                <input class="form-control" type="file" name="logo" value="<?= ($client != null) ? $client['nombre_cliente'] : '' ?>">
                            </div>

                            <div class="form-group">
                                <label class="etiquetas">Nombre</label>
                                <input class="form-control" type="text" name="nombre" value="<?= ($client != null) ? $client['nombre_cliente'] : '' ?>">
                            </div>
                            <div class="form-group">
                                <label class="etiquetas">Cedula Juridica</label>
                                <input class="form-control" type="text" name="cedula" value="<?= ($client != null) ? $client['cedula_juridica'] : '' ?>">
                            </div>


                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="card shadow">

                        <div class="card-body">
                            <div class="form-group">
                                <label class="etiquetas">Telefono</label>
                                <input class="form-control" type="text" name="telefono" value="<?= ($client != null) ? $client['telefono'] : '' ?>">
                            </div>
                            <div class="form-group">
                                <label class="etiquetas">Correo</label>
                                <input class="form-control" type="text" name="correo" value="<?= ($client != null) ? $client['correo'] : '' ?>">
                            </div>
                            <div class="form-group">
                                <label class="etiquetas">Direccion</label>
                                <textarea name="direccion" class="form-control" rows="1"></textarea>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center p-4">
            <hr>
                <button class="btn btn-success " type="submit"><i class="fas fa-file"></i> Guardar</button>
                </div>
            </form>
        </div>
        </div>
<?php
    }
}
?>