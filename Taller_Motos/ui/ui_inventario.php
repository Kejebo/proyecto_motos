<?php
require_once('gui.php');

class ui_inventario extends gui
{

  function __construct()
  {
  }
  function get_content()
  {
?>

    <section class="container" style="color: #04ADBF;">
      <div class="row">
        <div class="col-lg-3">
          <div class="card shadow">
            <div class="card-header">
              <h6 style="margin-left: 20px"> <span><i class="fas fa-bars"></i></span> Registro de Inventario</h6>
            </div>
            <div class="card-body">
              <form method="get" action="">
                <div class="form-group">
                  <label class="etiquetas">Nombre</label>
                  <input class="form-control" type="text" name="nombre">
                </div>

                <label class="etiquetas">Categoria</label>
                <div class="input-group mb-3">
                  <select name="categoria" class="form-control" onchange="selec(this)">
                    <option value="Cables">Cables</option>
                    <option value="Llantas">Llantas</option>
                    <option value="Aceite">Aceite</option>
                    <option value="Tornillos">Tornillas</option>
                    <option value="Arandelas">Arandelas</option>
                    <option value="Equipo de Trabajo">Equipo de trabajo</option>
                  </select>
                  <div class="input-group-append">
                    <span class="btn btn-success" type="submit" data-toggle="modal" data-target="#form_categoria">+</span>
                  </div>
                </div>
                <label class="etiquetas" id="monto" style="display: none">Monto</label>


                <label class="etiquetas" id="x">Marca</label>

                <div class="input-group mb-3">
                  <select name="marca" class="form-control">
                    <option value="Fox">Fox</option>
                    <option value="Suzuki">Suzuki</option>
                    <option value="Generica">Generica</option>
                  </select>
                  <div class="input-group-append">
                    <span class="btn btn-success" type="submit" data-toggle="modal" data-target="#form_marca">+</span>
                  </div>
                </div>

                <label class="etiquetas">Cantidad</label>
                <div class="input-group mb-3">
                  <input class="form-control" type="number" name="cedula">
                  <div class="input-group-append">
                    <select name="medida" class="form-control">
                      <option value="">Unid</option>
                      <option value="">mt</option>
                      <option value="">ml</option>
                    </select>
                  </div>

                </div>
                <div class="form-group">
                  <label class="etiquetas">Cantidad minima</label>
                  <input class="form-control" type="number" name="precio_compra">
                </div>

                <div class="form-group">
                  <label class="etiquetas">Precio de Compra</label>
                  <input class="form-control" type="number" name="precio_compra">
                </div>
                <div class="form-group">
                  <label class="etiquetas">Precio de Venta</label>
                  <input class="form-control" type="number" name="precio_venta">
                </div>

                <hr>
                <button class="btn btn-primary btn-block" type="submit"><i class="fas fa-file"></i> Registrar</button>
              </form>
            </div>
          </div>
          <div class="modal fade bg-dark" id="form_marca" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Agregar Marca</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label class="etiquetas">Nombre</label>
                    <input class="form-control" type="text" name="nombre_marca">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Guardar</button>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="form_categoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Agregar Categoria</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <input class="form-control" type="text" name="nombre_categoria" placeholder="Ingrese el nombre de la categoria">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Guardar</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-9 table-responsive">

          <table class="table table-bordered bg-white" id="example">
            <thead class="thead-dark text-center">
              <tr>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Venta</th>
                <th>Compra</th>
                <th>Editar</th>
                <th>Eliminar</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>WFE </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>

              </tr>
            </tbody>

          </table>
        </div>
      </div>

    </section>

<?php
  }
}
?>