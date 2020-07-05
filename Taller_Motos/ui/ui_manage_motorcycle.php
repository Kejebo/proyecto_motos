<?php
require_once('gui.php');
require_once('ln/ln_motorcycle.php');

class ui_manage_motorcycle extends gui
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
      <div class="card shadow">
        <div class="card-header bg-info text-white">
          <div class="clearfix">
            <div class="float-left">
              <h5>Datos de la Moto</h5>
            </div>
            <div class="float-right">
              <a href="motorcycle.php" class="btn btn-dark">Todas las Motos</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form action="manage_motorcycle.php?action=<?= $action ?>" method="post">
            <div class="row">
              <div class="col-sm-12">
                <input class="form-control" type="hidden" name="id" value="<?= $moto['id_moto'] ?>">
                <div class="row">
                  <div class="form-group col-sm-4">
                    <label class="etiquetas">Cliente</label>
                    <div class="input-group mb-3">
                      <select name="cliente" id="cliente" class="form-control">
                        <?php foreach ($this->ln->get_clientes() as $clientes) {
                          if ($moto['id_cliente'] == $clientes['id_cliente']) {
                        ?>
                            <option selected value="<?= $clientes['id_cliente'] ?>"><?= $clientes['nombre_cliente'] ?></option>
                          <?php } else { ?>
                            <option value="<?= $clientes['id_cliente'] ?>"><?= $clientes['cedula_juridica'] . ' / ' . $clientes['nombre_cliente'] ?></option>

                        <?php }
                        } ?>
                      </select>
                      <div class="input-group-append">
                        <span class="btn btn-success" type="submit" data-toggle="modal" data-target="#form_cliente">+</span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-sm-4">
                    <label class="etiquetas">Numero de Placa</label>
                    <input id="placa" class="form-control" type="number" name="placa" value="<?= $moto['numero_placa'] ?>">
                  </div>
                  <div class="form-group col-sm-4">
                    <label class="etiquetas">Numero de Chasis</label>
                    <input id="chasis" class="form-control" type="text" name="chasis" value="<?= $moto != null ? $moto['numero_chasis'] : '' ?>">
                  </div>
                </div>
                <div class="row">

                  <div class="form-group col-sm-4">
                    <label class="etiquetas">Kilometraje</label>
                    <input id="kilometraje" class="form-control" type="number" name="kilometraje" value="<?= $moto['kilometraje'] ?>">
                  </div>

                  <div class="form-group col-sm-4">
                    <label class="etiquetas">Marca</label>
                    <div class="input-group mb-3">
                      <select name="marca" id="marca" class="form-control">
                        <?php foreach ($this->ln->get_marcas() as $marcas) {
                          if ($moto['id_marca_moto'] == $marcas['id_marca_moto']) {
                        ?>
                            <option selected value="<?= $marcas['id_marca_moto'] ?>"><?= $marcas['nombre_marca'] ?></option>
                          <?php } else { ?>
                            <option value="<?= $marcas['id_marca_moto'] ?>"><?= $marcas['nombre_marca'] ?></option>
                        <?php  }
                        } ?>
                      </select>
                      <div class="input-group-append">
                        <span class="btn btn-success" type="submit" data-toggle="modal" data-target="#form_marca">+</span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-sm-4">
                    <label class="etiquetas">Modelo</label>
                    <div class="input-group mb-3">
                      <select name="modelo" id="modelo" class="form-control">
                        <?php foreach ($this->ln->get_modelos() as $modelos) {
                          if ($moto['id_modelo_moto'] == $modelos['id_modelo_moto']) {
                        ?>
                            <option selected value="<?= $modelos['id_modelo_moto'] ?>"><?= $modelos['nombre_modelo'] . ' ' . $modelos['ano'] ?></option>
                          <?php } else { ?>
                            <option value="<?= $modelos['id_modelo_moto'] ?>"><?= $modelos['nombre_modelo'] . ' ' . $modelos['ano'] ?></option>
                        <?php }
                        } ?>
                      </select>
                      <div class="input-group-append">
                        <span class="btn btn-success" type="submit" data-toggle="modal" data-target="#form_modelo">+</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-4">
                    <label class="etiquetas">Transmision</label>
                    <div class="input-group mb-3">
                      <select name="transmision" id="transmision" class="form-control">
                        <?php foreach ($this->ln->get_transmision() as $transmisiones) {
                          if ($moto['id_transmision'] == $transmisiones['id_transmision']) {
                        ?>
                            <option selected value="<?= $transmisiones['id_transmision'] ?>"><?= $transmisiones['nombre_transmision'] ?></option>
                          <?php } else { ?>
                            <option value="<?= $transmisiones['id_transmision'] ?>"><?= $transmisiones['nombre_transmision'] ?></option>
                        <?php }
                        } ?>
                      </select>
                      <div class="input-group-append">
                        <span class="btn btn-success" type="submit" data-toggle="modal" data-target="#form_transmision">+</span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-sm-4">
                    <label class="etiquetas">Cilindraje</label>
                    <div class="input-group mb-3">
                      <select name="cilindraje" id="cilindraje" class="form-control">
                        <?php foreach ($this->ln->get_cilindraje() as $cilindro) {
                          if ($moto['id_cilindraje'] == $cilindro['id_cilindraje']) {
                        ?>
                            <option selected value="<?= $cilindro['id_cilindraje'] ?>"><?= $cilindro['tamano_cilindraje'] ?></option>
                          <?php } else { ?>
                            <option value="<?= $cilindro['id_cilindraje'] ?>"><?= $cilindro['tamano_cilindraje'] ?></option>
                        <?php }
                        } ?>
                      </select>
                      <div class="input-group-append">
                        <span class="btn btn-success" type="submit" data-toggle="modal" data-target="#form_cilindraje">+</span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-sm-4">
                    <label class="etiquetas">Combustible</label>
                    <div class="input-group mb-3">
                      <select name="combustible" id="combustible" class="form-control">
                        <?php foreach ($this->ln->get_combustible() as $combustible) {
                          if ($moto['id_combustible'] == $combustible['id_combustible']) {
                        ?>
                            <option selected value="<?= $combustible['id_combustible'] ?>"><?= $combustible['tipo_combustible'] ?></option>
                          <?php } else { ?>
                            <option value="<?= $combustible['id_combustible'] ?>"><?= $combustible['tipo_combustible'] ?></option>
                        <?php }
                        } ?>
                      </select>
                      <div class="input-group-append">
                        <span class="btn btn-success" type="submit" data-toggle="modal" data-target="#form_combustible">+</span>
                      </div>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="text-center">
                  <button class="btn btn-primary" type="submit"><?= $boton ?></button>
                  <a href="manage_motorcycle.php" class="btn btn-danger">Nuevo</a>
                </div>
              </div>
          </form>
        </div>


    </section>
    </main>


    <div class="modal fade bg-dark" id="form_marca" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header bg-info text-white">
            <h5 class="modal-title">Agregar Marca</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label class="etiquetas">Nombre</label>
              <input class="form-control" type="text" id="nombre_marca" placeholder="ingrese el nombre de la marca">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="insert_marcas_motos()">Guardar</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade bg-dark" id="form_transmision" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header bg-info text-white">
            <h5 class="modal-title">Agregar Transmision</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label class="etiquetas">Tipo de transmision</label>
              <input class="form-control" type="text" id="nombre_transmision" placeholder="ingrese el nombre de la transmision">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="insert_transmision();">Guardar</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="form_combustible" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header bg-info text-white">
            <h5 class="modal-title">Agregar Combustible</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label class="etiquetas">Nombre</label>
              <input class="form-control" type="text" id="nombre_combustible" placeholder="ingrese el nombre del combustible">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="insert_combustible()">Guardar</button>
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="form_cilindraje" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header bg-info text-white">
            <h5 class="modal-title">Agregar Cilindraje</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label class="etiquetas">Tipo de cilindraje</label>
              <input class="form-control" type="text" id="nombre_cilindraje" placeholder="ingrese el tipo de cilindraje">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="insert_cilindraje()">Guardar</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="form_modelo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header bg-info text-white">
            <h5 class="modal-title">Agregar Modelo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label class="etiquetas">Nombre</label>
              <div class="input-group mb-3">
                <input class="form-control" type="text" id="nombre_modelo" placeholder="Ingrese el nombre del modelo">
                <div class="input-group-append">
                  <select name="" id="ano" class="form-control">
                    <?php for ($i = 1985; $i <= 2050; $i++) { ?>
                      <option value="<?= $i ?>"><?= $i ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="insert_modelo_motos()">Guardar</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="form_cliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header bg-info text-white">
            <h5 class="modal-title">Agregar Cliente</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label class="etiquetas">Nombre Completo</label>
              <input class="form-control" type="text" id="nombre_cliente" required>
            </div>
            
            <div class="form-group">
              <label class="etiquetas">Telefono</label>
              <input class="form-control" type="text" id="telefono" required>
            </div>
            <div class="form-group">
              <label class="etiquetas">Correo</label>
              <input class="form-control" type="text" id="correo" required>
            </div>
            <div class="form-group">
              <label class="etiquetas">Cedula</label>
              <input class="form-control" type="text" id="cedula" required>
            </div>
            <div class="form-group">
              <label class="etiquetas">Contraseña</label>
              <input type="password" class="form-control" id="clave">
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="insert_cliente()">Guardar</button>
          </div>
        </div>
      </div>
    </div>






<?php
  }
}


?>