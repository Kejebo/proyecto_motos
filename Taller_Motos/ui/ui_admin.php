<?php
require_once('gui.php');
require_once('ln/ln_admin.php');
class Ui_admin extends Gui
{
    var $ln;
    var $data;
    var $action = 'insert';
    var $boton = 'Registrar';


    function __construct($config)
    {
        parent::__construct($config);
        $this->ln = new ln_admin();
        $datos = $this->ln->get_admin();
        if ($datos['id_empresa'] != null) {
            $this->action = 'update';
            $this->boton = 'Actualizar';
        }
    }

    function action_controller()
    {
        $this->ln->action_controller();
    }

    function get_content()
    {

?>
        <form method="POST" action="admin.php?action=<?= $this->action ?>" enctype="multipart/form-data">
            <div class=" container row">
                <div class="col-12 col-sm-12 col-lg-6 pt-3">
                    <div class="card shadow">
                        <?php $this->data = $this->ln->get_admin(); ?>
                        <div class="card-body">
                            <input type="hidden" name="id_empresa" value="<?= $this->data['id_empresa']; ?>">
                            <div class="form-group">
                                <div class="input-group mb-3">

                                    <div class="input-group-prepend">

                                        <label class="btn btn-success" for="logo"><i class="fas fa-upload"></i> Elegir</label>

                                    </div>

                                    <input type="text" name="file-name" id="file-name" name="file-name" class="form-control file-name" value="<?= $this->data['logo']; ?>" readonly>

                                </div>

                                <input type="file" name="logo" id="logo" hidden>

                            </div>

                            <div class="form-group">
                                <label class="etiquetas">Nombre</label>
                                <input class="form-control" type="text" name="nombre" value="<?= $this->data['nombre']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="etiquetas">Cedula Juridica</label>
                                <input class="form-control" type="text" name="cedula" value="<?= $this->data['cedula_juridica']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="etiquetas">Telefono</label>
                                <input class="form-control" type="text" name="telefono" value="<?= $this->data['telefono']; ?>">
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-6 col-lg-6 pt-3">
                    <div class="card shadow">

                        <div class="card-body">

                            <div class="form-group">
                                <label class="etiquetas">Correo</label>
                                <input class="form-control" type="text" name="correo" value="<?= $this->data['correo']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="etiquetas">Contraseña de correo</label>
                                <input class="form-control" type="password" name="contrasena" value="<?= $this->data['contrasena']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="etiquetas">Direccion</label>
                                <textarea name="direccion" class="form-control" rows="1"><?= $this->data['direccion']; ?></textarea>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center p-4">
                <hr>
                <button class="btn btn-success " type="submit"><i class="fas fa-file"></i><?= $this->boton; ?></button>
            </div>
        </form>
        </div>
        </div>
<?php
    }
}
?>