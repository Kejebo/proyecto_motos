<?php
require_once('ln/ln_workshop.php');
require_once('gui.php');
class ui_detail_repair extends Gui
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


?>
        <nav aria-label="Page breadcrumb">
            <ol class="breadcrumb opciones">
                <li class="breadcrumb-item active" aria-current="page"><a href="repairs.php">Inicio</a></li>
                <li class="active"><a href="workshop.php?action=update&id=<?= $_GET['id'] ?>">Informacion</a></li>
                <?php if (isset($_GET['id'])) { ?>
                    <li><a href="detail_repair.php?id=<?= $_GET['id'] ?>">Detalle de Reparacion</a></li>
                <?php } ?>
            </ol>
        </nav>
        
        <form action="detail_repair.php?action=insert_detail" method="post">
            <input type="hidden" name="id" value="<?=$_GET['id']?>">
            <div class="container row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 py-3">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white">
                            <div class="clearfix">

                                <div class="float-left">
                                    <h5 class="ml-2">Ajustes Realizados</h5>

                                </div>
                                <div class="float-right">
                                    <button type="button" data-toggle="modal" data-target="#modal" class="btn btn-info mr-5">Agregar</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body   table-responsive">
                            <table class="table table-inverse|reflow|striped|bordered|hover|sm text-center">
                                <thead class="thead-dark text-center text-white">
                                    <th>Trabajo</th>
                                    <th>Eliminar</th>
                                </thead>
                                <tbody id="detail_work" style="background-color:white">
                                    <?php
                                    $j = 0;
                                    if (isset($_GET['id'])) {
                                        foreach ($this->ln->db->get_work_details($_GET['id']) as $works) {

                                    ?>
                                            <tr ids="<?= $j++ ?>">
                                                <input type="hidden" class="trabajos" name="trabajos[]" value='<?= json_encode($works); ?>'>
                                                <td><?= $works['nombre_trabajo'] ?></td>
                                                <td><span class="btn btn-danger" onclick="deletes(this,'work')">X</span></td>
                                            </tr>
                                    <?php  }
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 py-3">
                    <div class="card shadow">
                        <div class="card-header">
                            <div class="clearfix">

                                <div class="float-left">
                                    <h5 class="ml-2">Materiales Utilizados</h5>

                                </div>
                                <div class="float-right">
                                    <button type="button" data-toggle="modal" data-target="#modal_material" class="btn btn-info mr-5">Agregar</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body   table-responsive">
                            <table class="table table-bordered" width="100%">
                                <thead class="thead-dark text-center text-white">
                                    <th>Material</th>
                                    <th>Cant</th>
                                    <th>Eliminar</th>
                                </thead>
                                <tbody id="detail_material" class="text-center bg-white">
                                    <?php
                                    $i = 0;
                                    if (isset($_GET['id'])) {
                                        foreach ($this->ln->db->get_repair_details($_GET['id']) as $material) {
                                    ?>
                                            <tr ids="<?= $i++ ?>">
                                                <input type="hidden" name="materiales[]" class="materiales" value='<?= json_encode($material) ?>'>
                                                <td><?= $material['nombre'] . ' ' . $material['marca'] . ' ' . $material['monto'] . $material['medida'] ?></td>
                                                <td><?= $material['cant'] ?></td>
                                                <td><span class="btn btn-danger" onclick="deletes(this,'material')">X</span></td>
                                            </tr>
                                    <?php  }
                                    }
                                    ?>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>



            </div>
            <div class="form-group text-center">
                <button class="btn btn-primary text-center" type="submit"><i class="fas fa-file"></i> Registrar</button>
                <a href="workshop.php" class="btn btn-danger"><i class="fas fa-file"></i> Cancelar</a>

            </div>

        </form>
        <div class="modal" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog  modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">Agregar Trabajo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <select id="trabajo" class="form-control">
                                <?php foreach ($this->ln->db->get_works() as $trabajo) { ?>
                                    <option value="<?= $trabajo['id_trabajo'] ?>"><?= $trabajo['nombre_trabajo'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" onclick="insert_work_detail();">Agregar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="modal_material" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header  bg-success text-white">
                        <h5 class="modal-title">Agregar Material</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <select class="form-control" id="material">
                                <?php foreach ($this->ln->db->get_inventory() as $material) { ?>
                                    <option value="<?= $material['id'] ?>"><?= $material['nombre'] . ' ' . $material['marca'] . ' ' .
                                                                                $material['monto'] . $material['medida'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Cantidad</label>
                            <input id="cant" class="form-control" type="number" name="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" onclick="insert_materialwork_detail()">Agregar</button>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
?>