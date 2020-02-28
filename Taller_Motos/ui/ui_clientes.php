<?php
require_once('gui.php');

    class Ui_cliente extends Gui{

        function get_content()
        {
            ?>
            <div class="row">
    <div class="col-12 col-sm-12 col-lg-4">
        <div class="card shadow">
            <div class="card-title">
                <h5 style="margin-left: 20px"> <span><i class="fas fa-bars"></i></span> Registro de clientes</h5>
            </div>
            <div class="card-body">
                <form method="get" action="">
                    <div class="form-group">
                        <label class="etiquetas">Nombre Completo</label>
                        <input class="form-control" type="text" name="nombre">
                    </div>
                    <div class="form-group">
                        <label class="etiquetas">Telefono</label>
                        <input class="form-control" type="text" name="telefono">
                    </div>
                    <div class="form-group">
                        <label class="etiquetas">Correo</label>
                        <input class="form-control" type="text" name="correo">
                    </div>
                    <div class="form-group">
                        <label class="etiquetas">Cedula Juridica</label>
                        <input class="form-control" type="text" name="cedula">
                    </div>
                    <div class="form-group">
                        <label class="etiquetas">Tipo de clientes</label>
                        <select id="clientes" class="form-control" name="tipo">
                            <option value="privado">Privado</option>
                            <option value="gobierno">Gobierno</option>
                        </select>
                    </div>
                    <hr>
                    <button class="btn btn-primary " type="submit"><i class="fas fa-file"></i> Registrar</button>
                    <button class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-sm-8 table-responsive shadow">

        <table class="table table-bordered bg-white" id="example">
            <thead class="thead-dark text-center">
                <tr>
                    <th>Nombre</th>
                    <th>Cedula Juridica</th>
                    <th>Telefono</th>
                    <th>Correo</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>WFE </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                </tr>
            </tbody>

        </table>
    </div>
</div>
            <?php
        }

    }
?>