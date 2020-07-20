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

  function estado()
  {
    return array('Espera' => 'Espera', 'Finalizado' => 'Finalizado');
  }
  function get_content()
  {
    $work = null;

    $action = 'insert_work';
    $fecha =  date("Y-m-d");
    $titulo = "Registrar";
    $boton = 'none';
    if (isset($_GET['action'])) {
      if ($_GET['action'] == 'update') {
        $work = $this->ln->get_repair($_GET['id']);
        $action = 'update_repair';
        $fecha = $work['fecha_entrada'];
        $titulo = 'Actualizar';
      }
    }

?>
    <nav aria-label="Page breadcrumb">
      <ol class="breadcrumb opciones">
        <li class="breadcrumb-item " aria-current="page"><a href="repairs.php">Inicio</a></li>
        <li class="breadcrumb-item active"><a href="workshop.php?id=<?= $_GET['id'] ?>">Informacion</a></li>
        <?php if (isset($_GET['id'])) { ?>
          <li><a href="detail_repair.php?id=<?= $_GET['id'] ?>">Detalle de Reparacion</a></li>
        <?php } ?>
      </ol>
    </nav>
    <form action="workshop.php?action=<?= $action ?>" method="post">
      <div class=" container">
        <div class="row">
          <div class="col-12 col-sm-12 col-md-6 col-lg-6 py-3">
            <div class="card shadow">
              <div class="card-header">
                <h5> <span> <i class="fas fa-bars"></i></span> Registro de Mantenimiento</h5>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label>Estado</label>
                  <select id="my-select" class="form-control" name="estado">
                    <?php if ($work['estado'] == 'Finalizado') { ?>
                      <option>Espera</option>
                      <option selected>Finalizado</option>

                    <?php } else { ?>
                      <option selected>Espera</option>
                      <option>Finalizado</option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label class="etiquetas">Fecha de entrada</label>
                  <input class="form-control" id="entrada" type="date" name="entrada" value="<?= $fecha ?>">
                  <input type="hidden" id="id" name="id" value="<?= $work['id'] ?>">
                </div>

                <div class="form-group">
                  <label class="etiquetas">Cliente</label>
                  <select class="form-control" name="cliente" id="cliente" onchange="get_motos(this)">
                    <option value="0">Seleccione un cliente</option>
                    <?php foreach ($this->ln->db->get_clients() as $clientes) {
                      print_r($work);
                      if ($work['id_cliente'] == $clientes['id_cliente']) { ?>
                        <option selected value="<?= $clientes['id_cliente'] ?>"><?= $clientes['nombre_cliente'] ?></option>
                      <?php
                      } else { ?>
                        <option value="<?= $clientes['id_cliente'] ?>"><?= $clientes['nombre_cliente'] ?></option>
                    <?php }
                    } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label class="etiquetas">Moto</label>
                  <select class="form-control" name="motos" id="motos">
                    <?php
                    if ($work != null) { ?>
                      <option selected value="<?= $work['id_moto'] ?>"><?= $work['moto'] ?></option>
                    <?php } else { ?>
                      <option>Seleccione un cliente</option>
                    <?php }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Kilometraje de Entrada</label>
                  <input class="form-control" type="number" id="kilometraje" name="kilometraje" value="<?= $work['kilometraje_entrada'] ?>" required>
                </div>

              </div>
            </div>
          </div>

          <div class="col-12 col-sm-12 col-md-6 col-lg-6 py-3">

            <div class="card">
              <div class="card-header bg-primary">
                <div class="clearfix">
                  <div class="float-left">
                    <h5 class="card-title">Finalizar Trabajo</h5>
                  </div>
                  <div class="float-right">
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label>Fecha de Entrega</label>
                  <input type="date" class="form-control" name="entrega" value="<?= ($work != null) ? $work['fecha_salida'] : '' ?>">
                </div>
                <div class="form-group">
                  <label>Kilometraje de Salida</label>
                  <input type="number" class="form-control" name="k_actual" value="<?= ($work != null) ? $work['kilometraje_salida'] : 0 ?>">
                </div>
                <div class="form-group">
                  <label>Proximo Kilometraje</label>
                  <input type="number" class="form-control" name="k_proximo" value="<?= ($work != null) ? $work['cita'] : 0 ?>">
                </div>
                <div class="form-group">
                  <label>Precio</label>
                  <input type="number" class="form-control" name="precio" value="<?= ($work != null) ? $work['precio'] : 0 ?>">
                </div>
                <div class="form-group">
                  <label>Observacion</label>
                  <textarea name="descripcion" rows="2" cols="80" class="form-control"><?= ($work != null) ? $work['descripcion'] : ' ' ?></textarea>
                </div>

              </div>
            </div>
          </div>

        </div>
        <div class="form-group text-center">
          <button class="btn btn-primary text-center" type="submit"><i class="fas fa-file"></i> <?= $titulo ?></button>
          <a href="workshop.php" class="btn btn-danger"><i class="fas fa-file"></i> Nuevo</a>

        </div>
      </div>


    </form>
<?php
  }
}
?>