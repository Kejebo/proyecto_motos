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
                <div class="col-12 col-sm-12 col-md-3 col-lg-3 py-3">
                    <div class="card shadow">
                        <div class="card-header">
                            <h5 class="card-title">Registro de Motos</h5>
                        </div>
                        <div class="card-body">
                            <form action="motorcycle.php?action=<?= $action ?>" method="post">
                                <input class="form-control" type="hidden" name="id" value="<?=$moto['id_moto']?>">
                                <div class="form-group">
                                    <label class="etiquetas">Cliente</label>
                                    <div class="input-group mb-3">
                                        <select name="cliente" id="cliente" class="form-control">
                                            <?php foreach ($this->ln->get_clientes() as $clientes) {
                                                if ($moto['id_cliente'] == $clientes['id_cliente']) {
                                            ?>
                                                    <option selected value="<?= $clientes['id_cliente'] ?>"><?= $clientes['nombre_cliente'] ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $clientes['id_cliente'] ?>"><?= $clientes['nombre_cliente'] ?></option>

                                            <?php }
                                            } ?>
                                        </select>
                                        <div class="input-group-append">
                                            <span class="btn btn-success">+</span>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="etiquetas">Numero de Placa</label>
                                    <input id="placa" class="form-control" type="number" name="placa" value="<?= $moto['numero_placa'] ?>">
                                </div>
                                <div class="form-group">
                                    <label class="etiquetas">Numero de Chasis</label>
                                    <input id="chasis" class="form-control" type="text" name="chasis" value="<?= $moto['numero_chasis'] ?>">
                                </div>
                                <div class="form-group">
                                    <label class="etiquetas">Kilometraje</label>
                                    <input id="kilometraje" class="form-control" type="number" name="kilometraje" value="<?= $moto['kilometraje'] ?>">
                                </div>

                                <div class="form-group">
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
                                            <span class="btn btn-success">+</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
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
                                            <span class="btn btn-success">+</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
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
                                            <span class="btn btn-success">+</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
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
                                            <span class="btn btn-success">+</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="etiquetas">Combustible</label>
                                    <div class="input-group mb-3">
                                        <select name="combustible" class="form-control">
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
                                            <span class="btn btn-success">+</span>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <button class="btn btn-primary btn-block " type="submit"><?= $boton ?></button>
                                <a href="motorcycle.php" class="btn btn-danger btn-block " style="display: <?= $visibilidad ?>">CANCELAR</a>

                            </form>
                        </div>
                    </div>
                </div>
                <br>
                <div class="col-12 col-sm-12 col-md-9 col-lg-9 py-3">
                    <div class="card shadow ">
                        <div class="card-header">
                            <h5 class="card-title">Lista de Motos</h5>
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
                                            <td><a href="motorcycle.php?action=delete&id=<?= $motos['id']; ?>" class="btn btn-danger">x</a></td>
                                            <td><a href="motorcycle.php?action=update_moto&id=<?= $motos['id']; ?>" class="btn btn-warning">edit</a></td>
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