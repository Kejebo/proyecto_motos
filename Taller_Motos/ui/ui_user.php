<?php
require_once('gui.php');
require_once('ln/ln_user.php');
class ui_user extends Gui
{
    var $ln;


    function __construct($config)
    {
        parent::__construct($config);
        $this->ln = new ln_user();
    }

    function action_controller()
    {
        $this->ln->action_controller();
    }

    function get_content()
    {
        $user = null;
        $action = 'insert';
        $boton = 'Registrar';
        if (isset($_GET['action'])) {
            if ($_GET['action'] == 'update_user') {
                $user = $this->ln->get_user($_GET['id']);
                $action = 'update';
                $boton = 'Actualizar';
            }
        }

?>
        <div class=" container row">
            <div class="col-12 col-sm-12 col-lg-4">
                <div class="card shadow">
                    <div class="card-header">
                        <h5> <span><i class="fas fa-bars"></i></span> Registro de usuarios</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="users.php?action=<?= $action ?>">
                            <input type="hidden" name="id_usuario" value="<?= $user['id_usuario'] ?>">
                            <div class="form-group">
                                <label class="etiquetas">Nombre Completo</label>
                                <input class="form-control" type="text" name="nombre" value="<?= $user['nombre_completo'] ?>">
                            </div>
                            <div class="form-group">
                                <label class="etiquetas">Contraseña</label>
                                <input type="text" class="form-control" name="clave" id="clave" value="<?= $user['clave'] ?>">
                            </div>
                            <hr>
                            <button class="btn btn-primary btn-block" type="submit"><i class="fas fa-file"></i> <?= $boton ?></button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="card-title">Lista de Usuarios</h5>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered" id="example">
                            <thead class="thead-dark text-center text-white">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Clave</th>
                                    <th>Eliminar</th>
                                    <th>Editar</th>

                                </tr>
                            </thead>
                            <tbody class="text-center">

                                <?php
                                $lista = $this->ln->get_users();
                                if ($lista) {
                                    foreach ($lista as $list) { ?>
                                        <tr>
                                            <td><?= $list['nombre_completo']; ?></td>
                                            <td><?= $list['clave']; ?></td>
                                            <td><a href="users.php?action=delete&id=<?= $list['id_usuario']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                                            <td><a href="users.php?action=update_user&id=<?= $list['id_usuario']; ?>" class="btn btn-warning text-white"><i class="fas fa-edit"></i></a></td>
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
