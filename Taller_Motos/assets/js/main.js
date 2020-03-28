var compra = [];
var clicks = 0;
var monto = document.querySelector('#monto');
var lista = document.querySelectorAll('.lista');
var detalle = document.querySelector('#purchase');
var saldo = 0;
window.addEventListener('load', () => {
  let i = 0;
  recargar_compra();
  $('#form-purchase').submit(function (e) {
    e.preventDefault();

    let nombre = document.querySelector('#material');

    detalles = {
      precio: document.querySelector('#precio').value,
      cantidad: document.querySelector('#cantidad').value,
      material: document.querySelector('#material').value,
      nombre_material: nombre.options[nombre.selectedIndex].textContent
    };
    if(detalles.cantidad>0){
    compra.push(detalles);
    saldo += detalles.precio * detalles.cantidad;
    resetear_compra();
    $('#detalle').append(crear_fila_compra(detalles, i++));
    }else{
      showMessage('Ingrese una cantidad mayor', 'danger');
    }
  });
});
function crear_fila_compra(detalles, i) {
  json = JSON.stringify(detalles);
  input = "<input type='hidden' class='lista' name='detalles[]' value='" + json + "'>"
  tr = '' +
    '<tr ids=' + i + '>' +
    input +
    '<td>' +
    detalles.nombre_material + '</td>' +
    '<td>' + detalles.cantidad + '</td>' +
    '<td>' + detalles.precio + '</td>' +
    '<td>' + detalles.precio * detalles.cantidad + '</td>' +
    '<td><span class="delete_detail btn btn-danger" onclick="deletes(this)"><i class="fas fa-trash"></i></span></td>'
  '</tr>'
  detalle.style.display = 'block';
  total_compra();
  return tr;
}
function total_compra() {
  document.querySelector('#pie_compras').innerHTML = ` <tr>
  <td>Saldo</td>
  <td></td>
  <td></td>
  <td>${saldo}</td>
  <td></td>
</tr>`

}
function sendpurchase(action) {
  let id = document.querySelector('#id').value;
  let factura = document.querySelector('#factura').value;
  let proveedor = document.querySelector('#proveedor').value;
  let fecha = document.querySelector('#fecha').value;
  let datos = { id, factura, proveedor, fecha }
  $.ajax({
    type: "post",
    url: "controller.php",
    data: { action, datos, compra },
    success: function (response) {
      setTimeout(()=>{
      showMessage('Se realizo la compra correctamente', 'success');
      window.location.href = 'purchases.php';
    },1000);
    }
  });
  detalle.style.display = 'none';
}

function deletes(elemento) {
  let boton = elemento.parentElement.parentElement;
  compra.splice(boton.getAttribute('ids'), 1);
  boton.remove();
  if (compra.length == 0) {
    detalle.style.display = 'none';
  }
}
function resetear_compra() {
  document.querySelector('#precio').value = 0;
  document.querySelector('#cantidad').value = 0;
  document.querySelector('#guardar').style.display='block';
  document.querySelector('#cancelar').style.display='block';
}
function recargar_compra() {
  compra = [];
  lista.forEach(element => {
    let aux = JSON.parse(element.value);
    let data = {
      precio: aux.precio,
      cantidad: aux.cantidad,
      material: aux.material,
      nombre_material: aux.nombre_material
    }
    saldo += data.precio * data.cantidad;
    compra.push(data);

  });
}
function add() {
  if (clicks == 0) {
    monto.style.display = 'block';
    get_medida()
  }

}
function get_medida() {
  let action = 'get_medida';
  let id = document.querySelector('#categoria').value;
  $.ajax({
    type: "post",
    url: "controller.php",
    data: { action, id },
    success: function (response) {
      let medida = JSON.parse(response);
      document.querySelector('.medida').textContent = medida.nombre_medida;

    }
  });
}
function delete_span(e) {
  clicks = 0;
  monto.style.display = 'none';
}
function selec(sel) {
  var opciones = sel.options[sel.selectedIndex].textContent;
  if (opciones != "Tornillos" && opciones != "Cables") {
    add();
  } else {
    delete_span(document.querySelector('.medida'));
  }
}
function showMessage(message, cssClass) {
  const mensaje = document.createElement('div');
  mensaje.className = `alert alert-${cssClass} mt-4`;
  mensaje.appendChild(document.createTextNode(message));
  const container = document.querySelector('#form-purchase');
  const notificacion = document.querySelector('.notificar');
  container.insertBefore(mensaje, notificacion);
  setTimeout(() => {
    document.querySelector('.alert').remove();
  }, 3000);
}
