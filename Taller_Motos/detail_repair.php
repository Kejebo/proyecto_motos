<?php
  require_once('ui/ui_detail_repair.php');
  $config = array(
  	'titulo'	=> 'Modulo Mantenimiento',
  	'url'		=> 'workshop.php',
  );
  $ui= new ui_detail_repair($config);
  $ui->action_controller();
  $ui->get_header();
  $ui->get_sidebar();
  $ui->get_nabvar();
  $ui->get_content();
  $ui->get_footer();

?>
<!--<div class="card shadow" id="materials">
  <div class="card-header">
    <div class="clearfix">
      <div class="float-left">
        <h5 class="card-title">Lista de Reparaciones</h5>
      </div>
      <div class="float-right">

        <span style='display:<?= $boton ?>' class="btn btn-dark" type="submit" data-toggle="modal" data-target="#finalizar">Finalizar Trabajo</span>
      </div>
    </div>
  </div>


  <div class="card-body">
    <div class="bg-primary text-white card-title p-4  table-responsive" style="border-radius:20px;">
      <div class="clearfix p-2">

        <div class="float-left">
          <h5 class="ml-2">Ajustes Realizados</h5>

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
          $j = 0;
          if (isset($_GET['id'])) {
            foreach ($this->ln->db->get_work_details($_GET['id']) as $works) {

          ?>
              <tr ids="<?= $j++ ?>">
                <input type="hidden" class="trabajos" name="trabajos[]" value='<?= json_encode($works); ?>'>
                <td><?= $works['trabajo'] ?></td>
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


<div class="modal" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
      <div class="modal-header">
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
          <input type="number" id="cant" value="">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="insert_materialwork_detail()">Agregar</button>
      </div>
    </div>
  </div>
</div>