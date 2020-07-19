<?php
require_once('gui.php');
require_once('ln/ln_usuarios.php');
require_once('ln/ln_user.php');
class ui_user extends Gui
{
    var $ln;
    var $ln_user;


    function __construct($config)
    {
        parent::__construct($config);
        $this->ln = new ln_usuarios();
        $this->ln_user = new ln_user();
    }

    function action_controller()
    {
        $this->ln_user->action_controller();
    }
    function getTypes()
    {
        $data = array(
            'Administrador' => 'administrador',
            'Tecnico' => 'Tecnico',
            'Cliente' => 'cliente'
        );
        return $data;
    }

    function get_content()
    {
        $user = null;
        $action = 'insert';
        $boton = 'Registrar';
        if (isset($_GET['action'])) {
            if ($_GET['action'] == 'update_user') {
                $user = $this->ln_user->get_user($_GET['id']);
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
                            <input type="hidden" name="id_usuario" value="<?= ($user != null) ?  $user['id_usuario'] : '' ?>">
                            <div class="form-group">
                                <label class="etiquetas">Nombre Completo</label>
                                <input class="form-control" type="text" name="nombre" value="<?= ($user != null) ?  $user['nombre_completo'] : '' ?>">
                            </div>
                            <div class="form-group">
                                <label class="etiquetas">Contraseña</label>
                                <input type="text" class="form-control" name="clave" id="clave" value="<?= ($user != null) ?  $user['clave'] : '' ?>">
                            </div>
                            <div class="form-group">
                                <label class="etiquetas">Correo</label>
                                <input type="email" class="form-control" name="correo" value="<?= ($user != null) ?  $user['correo'] : '' ?>">
                            </div>
                            <div class="form-group">
                                <label class="etiquetas">Tipo</label>
                                <select class="form-control" name="tipo">
                                    <?php foreach ($this->getTypes() as $data) { ?>
                                        <option value="<?= $data ?>"><?= $data ?></option>
                                    <?php } ?>
                                </select>
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
                                    <th>Rol</th>
                                    <th>Eliminar</th>
                                    <th>Editar</th>

                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php $usuarios = $this->ln_user->get_users(); ?>
                                <?php foreach ($usuarios as $item) { ?>
                                    <tr>
                                        <td><?= $item['nombre_completo'] ?></td>
                                        <td><?= $item['tipo'] ?></td>
                                        <td><a href="users.php?action=delete&id=<?= $item['id_usuario']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                                        <td><a href="users.php?action=update_user&id=<?= $item['id_usuario']; ?>" class="btn btn-warning text-white"><i class="fas fa-edit"></i></a></td>
                                    </tr>
                                <?php } ?>
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