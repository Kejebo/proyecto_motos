<?php
require_once('gui.php');
require_once('ln/ln_workshop.php');
class ui_works extends Gui
{
    var $ln;


    function __construct($config)
    {
        parent::__construct($config);
        $this->ln = new ln_workshop();
    }

    function action_controller()
    {
        $this->ln->action_controller();
    }

    function get_content()
    {
        $user=null;
        $action = 'insert_trabajo';
        $boton = 'Registrar';
        if (isset($_GET['action'])) {
            if ($_GET['action'] == 'update_user') {
                $action = 'update';
                $boton = 'Actualizar';
            }
        }

?>
        <div class="container">
            <div class="row">
            <div class="col-12 col-sm-12 col-lg-4">
                <div class="card shadow">
                    <div class="card-header">
                        <h5> <span><i class="fas fa-bars"></i></span> Registro de Trabajos</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="works.php?action=<?= $action ?>">
                            <input type="hidden" name="id_usuario" value="<?=( $user!= null) ?  $user['id_usuario']:'' ?>">
                            <div class="form-group">
                                <label class="etiquetas">Nombre</label>
                                <input class="form-control" type="text" name="nombre" value="<?=( $user!= null) ?  $user['nombre_completo']:'' ?>">
                            </div>
                            <hr>
                            <button class="btn btn-primary btn-block"  type="submit"><i class="fas fa-file"></i> <?= $boton ?></button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="card-title">Lista de Trabajos</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="example">
                            <thead class="thead-dark text-center text-white">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Eliminar</th>

                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php 
                                    foreach($this->ln->get_works() as $data){?>
                                        <tr>
                                            <td><?=$data['nombre_trabajo']?></td>
                                            <td><a href="works.php?action=delete_work&id=<?= $data['id_trabajo'] ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                                        </tr>
                                   <?php }?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>                        
        </div>

<?php
    }
}
?>

