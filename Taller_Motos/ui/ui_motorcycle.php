<?php
require_once('gui.php');
require_once('ln/ln_motorcycle.php');
class ui_motorcycle extends gui
{
    var $ln;


    function __construct($config)
    {
        parent::__construct($config);
        $this->ln = new ln_motorcycle();
    }

    function action_controller()
    {
        $this->ln->action_controller();
    }

    function get_content()
    {
        $moto = null;
        $action = 'insert';
        $visibilidad = 'none';
        $boton = 'Registrar';
        if (isset($_GET['action'])) {
            if ($_GET['action'] == 'update_moto') {
                $moto = $this->ln->db->get_moto($_GET['id']);
                $action = 'update';
                $boton = 'Actualizar';
                $visibilidad = 'block';
            }
        }
?>
        <section class="container py-3" style="color: #04ADBF;">
            <div class="row">

                <div class="col-12 col-sm-12 col-md-12 col-lg-12 py-3">
                    <div class="card shadow ">
                        <div class="card-header">
                          <div class="clearfix">
                            <div class="float-left">
                              <h5 class="card-title">Lista de Motos</h5>
                            </div>
                            <div class="float-right">
                              <div class="btn-group" role="group" aria-label="First group">

                                <a class="btn btn-dark" href="manage_motorcycle.php"><i class="fas fa-plus-circle"></i> Nuevo</a>
                            
                            </div>

                            </div>
                          </div>

                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-bordered" id="example">
                                <thead class="thead-dark text-center text-white">
                                    <tr>
                                        <th>Cliente</th>
                                        <th>Moto</th>
                                        <th>Placa</th>
                                        <th>Transmision</th>
                                        <th>Kilometraje</th>
                                        <th>Ver</th>
                                        <th>Eliminar</th>
                                        <th>Editar</th>

                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php foreach ($this->ln->get_motos() as $motos) { ?>
                                        <tr>
                                            <td><?= $motos['cliente'] ?></td>
                                            <td><?= $motos['moto'] ?></td>
                                            <td><?= $motos['placa'] ?></td>
                                            <td><?= $motos['transmision'] ?></td>
                                            <td><?= $motos['kilometraje'] ?></td>
                                            <td><a href="<?= $motos['id']; ?>" class="btn btn-info"><i class="far fa-eye"></i></a></td>
                                            <td><a href="motorcycle.php?action=delete&id=<?= $motos['id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                                            <td><a href="manage_motorcycle.php?action=update_moto&id=<?= $motos['id']; ?>" class="btn btn-warning text-white"><i class="fas fa-edit"></i></a></td>
                                        </tr>
                                    <?php  } ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        </main>

<?php
    }
}
?>
