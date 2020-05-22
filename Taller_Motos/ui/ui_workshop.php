<?php
require_once('ln/ln_workshop.php');
require_once('gui.php');
class ui_workshop extends Gui
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
        $work = null;

        $visibilidad = 'none';
        $action = 'insert_work';
        $fecha =  date("Y-m-d");
        $titulo="Registrar";
        $boton='none';
        if (isset($_GET['action'])) {
            if ($_GET['action'] == 'update') {
                $work = $this->ln->get_repair($_GET['id']);
                $action = 'update_work';
                $boton = 'block';
                $visibilidad = 'block';
                $fecha=$work['fecha'];
                $titulo='Actualizar';
            }
        }

?>
<form id="form_work" action="workshop.php?action=<?=$action?>">
        <div class=" container row">
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 py-3">
                <div class="card shadow">
                    <div class="card-header">
                        <h5> <span> <i class="fas fa-bars"></i></span> Registro de Mantenimiento</h5>
                    </div>
                    <div class="card-body">
                            <div class="form-group notificar">
                                <label class="etiquetas">Fecha de entrada</label>
                                <input class="form-control" id="entrada" type="date" name="entrada" value="<?=$fecha ?>">
                                <input type="hidden" id="id" value="<?= $work['id'] ?>">
                            </div>

                            <div class="form-group">
                                <label class="etiquetas">Cliente</label>
                                <select class="form-control" name="cliente" id="cliente" onchange="get_motos(this)">
                                    <option value="0">Seleccione un cliente</option>
                                    <?php foreach ($this->ln->db->get_clients() as $clientes) { print_r($work);
                                        if ($work['id_cliente']==$clientes['id_cliente']) {?>
                                          <option selected value="<?= $clientes['id_cliente'] ?>"><?= $clientes['nombre_cliente'] ?></option>
                                          <?php
                                        }else { ?>
                                      <option value="<?= $clientes['id_cliente'] ?>"><?= $clientes['nombre_cliente'] ?></option>
                                    <?php }
                                  }?>
                                </select>
                            </div>
                            <div class="form-group notificar">
                                <label class="etiquetas">Moto</label>
                                <select class="form-control" name="motos" id="motos">
                                  <?php
                                    if ($work!=null) { ?>
                                        <option selected value="<?= $work['id_moto'] ?>"><?= $work['moto'] ?></option>
                                    <?php }else{ ?>
                                      <option>Seleccione un cliente</option>
                                    <?php }
                                   ?>
                                </select>
                            </div>
                            <div class="form-group">
                              <label>Kilometraje</label>
                              <input class="form-control" type="number" id="kilometraje" name="kilometraje" value="<?=$work['kilometraje']?>" required>
                            </div>
                            <hr>
                            <div class="form-group">

                                <button class="btn btn-primary btn-block" type="submit"><i class="fas fa-file"></i> <?=$titulo?></button>
                                <a id="cancelar" href="workshop.php" class="btn btn-primary btn-block" style="display: <?= $boton ?>"><i class="fas fa-file"></i> Nuevo</a>

                            </div>
                            <hr>

                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-8 col-lg-8 py-3">

                <div class="card shadow" id="materials">
                    <div class="card-header">
                      <div class="clearfix">
                        <div class="float-left">
                          <h5 class="card-title">Lista de Reparaciones</h5>
                        </div>
                        <div class="float-right">

                          <span style='display:<?=$boton?>' class="btn btn-dark" type="submit" data-toggle="modal" data-target="#finalizar">Finalizar Trabajo</span>
                    </div>
                  </div>
                </div>


                    <div class="card-body">
                      <div class="bg-primary text-white card-title p-4  table-responsive" style="border-radius:20px;">
                      <div class="clearfix p-2">

                        <div class="float-left">
                          <h5 class="ml-2">Ajustes  Realizados</h5>

                        </div>
                        <div class="float-right">
                          <button type="button" data-toggle="modal" data-target="#modal" class="btn btn-info mr-5">Agregar</button>
                        </div>
                      </div>

                        <table class="table table-inverse|reflow|striped|bordered|hover|sm text-center">
                          <thead class="thead-dark text-center text-white">
                              <th>Trabajo</th>
                              <th>Eliminar</th>
                          </thead>
                          <tbody id="detail_work" style="background-color:white">
                            <?php
                            $j=0;
                            if(isset($_GET['id'])){
                              forEach($this->ln->db->get_work_details($_GET['id']) as $works){

                                ?>
                                <tr ids="<?=$j++?>">
                                  <input type="hidden" class="trabajos" name="trabajos[]" value='<?=json_encode($works);?>'>
                                  <td><?=$works['trabajo']?></td>
                                  <td><span class="btn btn-danger" onclick="deletes(this,'work')">X</span></td>
                                </tr>
                            <?php  }
                            }
                         ?>

                          </tbody>
                        </table>
                      <br>
                      <div class="">

                      </div>
                      <div class="clearfix">

                        <div class="float-left">
                          <h5 class="ml-2">Materiales Utilizados</h5>

                        </div>
                        <div class="float-right">
                          <button type="button" data-toggle="modal" data-target="#modal_material" class="btn btn-info mr-5">Agregar</button>
                        </div>
                      </div>
                      <br>
                        <table class="table table-bordered" width="100%">
                            <thead class="thead-dark text-center text-white">
                                <th>Material</th>
                                <th>Cant</th>
                                <th>Eliminar</th>
                            </thead>
                            <tbody id="detail_material" class="text-center bg-white">
                              <?php
                                  $i=0;
                                  if(isset($_GET['id'])){
                                    forEach($this->ln->db->get_repair_details($_GET['id']) as $material){
                                      ?>
                                      <tr ids="<?=$i++?>">
                                        <input type="hidden" name="materiales[]" class="materiales" value='<?=json_encode($material)?>'>
                                        <td><?= $material['nombre'] . ' ' . $material['marca'] . ' ' .$material['monto'] . $material['medida']?></td>
                                        <td><?=$material['cant']?></td>
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

        </div>
      </form>

        <div class="modal fade bg-dark" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
          <div class="modal-dialog  modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Agregar Trabajo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <select id="trabajo" class="form-control">
                    <?php foreach ($this->ln->db->get_works() as $trabajo){ ?>
                      <option value="<?=$trabajo['id_trabajo']?>"><?=$trabajo['nombre_trabajo']?></option>
                    <?php }?>
                  </select>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="insert_work_detail();">Agregar</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade bg-dark" id="modal_material" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Agregar Material</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <select class="form-control" id="material">
                    <?php foreach ($this->ln->db->get_inventory() as $material){ ?>
                      <option value="<?= $material['id'] ?>"><?= $material['nombre'] . ' ' . $material['marca'] . ' ' .
                                                                  $material['monto'] . $material['medida'] ?></option>
                    <?php } ?>
                  </select>
                  <input type="number" id="cant" value="">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="insert_materialwork_detail()">Agregar</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade bg-dark" id="finalizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Finalizar Trabajo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="repairs.php?action=insert" method="post">
                  <input type="hidden" name="id" value="<?=$_GET['id']?>">
                  <input type="hidden" name="id_moto" value="<?=$work['id_moto']?>">
                <div class="form-group">
                  <label>Fecha de Entrega</label>
                  <input type="date" class="form-control" name="entrega">
                </div>
                <div class="form-group">
                  <label>Kilometraje de Salida</label>
                  <input type="number" class="form-control" name="k_actual">
                </div>
                <div class="form-group">
                  <label>Proximo Kilometraje</label>
                  <input type="number" class="form-control" name="k_proximo">
                </div>
                <div class="form-group">
                  <label>Precio</label>
                  <input type="number" class="form-control" name="precio">
                </div>
                <div class="form-group">
                  <label>Observacion</label>
                  <textarea name="descripcion" rows="2" cols="80" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-success btn-block">Guardar</button>
              </form>
              </div>
            </div>
          </div>
        </div>
<?php
    }
}
?>
