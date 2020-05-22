<?php
require_once('gui.php');
require_once('ln/ln_client.php');
class Ui_client extends Gui
{
    var $ln;


    function __construct($config)
    {
        parent::__construct($config);
        $this->ln = new ln_client();
    }

    function action_controller()
    {
        $this->ln->action_controller();
    }

    function get_content()
    {
        $client=null;
        $action='insert';
        $boton='Registrar';
        if(isset($_GET['action'])){
            if($_GET['action']=='update_client'){
                $client=$this->ln->get_client($_GET['id']);
                $action='update';
                $boton='Actualizar';
            }
        }

?>
        <div class=" container row">
            <div class="col-12 col-sm-12 col-lg-3">
                <div class="card shadow">
                    <div class="card-header">
                        <h5> <span> <i class="fas fa-bars"></i></span> Registro de clientes</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="clients.php?action=<?=$action?>">
                        <input type="hidden" name="id_cliente" value="<?=$client['id_cliente']?>">
                            <div class="form-group">
                                <label class="etiquetas">Nombre Completo</label>
                                <input class="form-control" type="text" name="nombre" value="<?=$client['nombre_cliente']?>">
                            </div>
                            <div class="form-group">
                                <label class="etiquetas">Telefono</label>
                                <input class="form-control" type="text" name="telefono" value="<?=$client['telefono']?>">
                            </div>
                            <div class="form-group">
                                <label class="etiquetas">Correo</label>
                                <input class="form-control" type="text" name="correo" value="<?=$client['correo']?>">
                            </div>
                            <div class="form-group">
                                <label class="etiquetas">Cedula Juridica</label>
                                <input class="form-control" type="text" name="cedula" value="<?=$client['cedula_juridica']?>">
                            </div>
                            <div class="form-group">
                                <label class="etiquetas">Contraseña</label>
                                <input type="password" class="form-control" name="clave" id="clave">
                            </div>
                            <hr>
                            <button class="btn btn-primary btn-block" type="submit"><i class="fas fa-file"></i> <?=$boton?></button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-8 col-lg-9">
                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="card-title">Lista de Clientes</h5>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered" id="example">
                            <thead class="thead-dark text-center text-white">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Cedula Juridica</th>
                                    <th>Telefono</th>
                                    <th>Correo</th>
                                    <th>Eliminar</th>
                                    <th>Editar</th>

                                </tr>
                            </thead>
                            <tbody class="text-center">

                                <?php
                                $lista = $this->ln->get_clients();
                                if ($lista) {
                                    foreach ($lista as $list) { ?>
                                        <tr>
                                            <td><?= $list['nombre_cliente']; ?></td>
                                            <td><?= $list['cedula_juridica']; ?></td>
                                            <td><?= $list['telefono']; ?></td>
                                            <td><?= $list['correo']; ?></td>
                                            <td><a href="clients.php?action=delete&id=<?= $list['id_cliente']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                                            <td><a href="clients.php?action=update_client&id=<?= $list['id_cliente']; ?>" class="btn btn-warning text-white"><i class="fas fa-edit"></i></a></td>
                                        </tr>
                                <?php }
                                } ?>
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
