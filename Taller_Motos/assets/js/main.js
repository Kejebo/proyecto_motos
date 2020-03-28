var compra = [];
const formulario = document.querySelector('form');
var clicks = 0;
var monto = document.querySelector('#monto');
var lista=document.querySelectorAll('.lista');
var detalle = document.querySelector('#purchase');

$(document).ready(function(e){
  let i=0;
  recargar_compra();
  $('#form-purchase').submit(function(e){
      e.preventDefault();

      let nombre = document.querySelector('#material');
      
     detalles= {
      precio : document.querySelector('#precio').value,
      cantidad : document.querySelector('#cantidad').value,
      material : document.querySelector('#material').value,
      nombre_material : nombre.options[nombre.selectedIndex].textContent
      };  
      compra.push(detalles);
      $('#detalle').append(crear_fila(detalles,i++));
  });
});
function crear_fila(detalles,i){
  json= JSON.stringify(detalles);
  input="<input type='hidden' class='lista' name='detalles[]' value='"+json+"'>"
  tr=''+
      '<tr ids='+i+'>'+
          input+
          '<td>'+
          detalles.nombre_material+'</td>'+
          '<td>'+detalles.cantidad+'</td>'+
          '<td>'+detalles.precio+'</td>'+
          '<td>'+detalles.precio * detalles.cantidad+'</td>'+  
          '<td><span class="delete_detail btn btn-danger" onclick="deletes(this)">x</span></td>'
      '</tr>'
      detalle.style.display='block';
      return tr;
}

/*window.addEventListener('load', () => {
  const pagina = document.getElementById('modulo').textContent;
    if(formulario.getAttribute('action')=='update'){
      lista.forEach(element =>{
        let aux=JSON.parse(element.value);
        let data = {
          precio:aux.precio,
          cantidad:aux.cantidad,
          material:aux.material,
          nombre_material:aux.nombre_material
        }
        compra.push(data);
      });
    }
    formulario.addEventListener('submit', (e) => {
   
    if (pagina == 'Modulo Compras') {

      let precio = document.querySelector('#precio').value;
      let cantidad = document.querySelector('#cantidad').value;
      let material = document.querySelector('#material').value;
      let nombre = document.querySelector('#material');
      let nombre_material = nombre.options[nombre.selectedIndex].textContent;
      if (compra == null) {
        compra = {
          precio,
          cantidad,
          material,
          nombre_material
        }
      } else {
        let aux = {
          precio,
          cantidad,
          material,
          nombre_material
        }
      
        detalle.style.display = 'block';
        compra.push(aux)
      }
  
      e.preventDefault();
      add_detail_purchase(compra);
    }
  });
});*/
function sendpurchase(action) {
  let id = document.querySelector('#id').value;
  let factura = document.querySelector('#factura').value;
  let proveedor = document.querySelector('#proveedor').value;
  let fecha = document.querySelector('#fecha').value;
  let datos = {id,factura,proveedor,fecha}
  $.ajax({
    type: "post",
    url: "controller.php",
    data: { action, datos, compra },
    success: function (response) {
      //showMessage('Se realizo la compra correctamente', 'success');
     // window.location.href='purchases.php';
     // console.log(response);
    }
  });
  formulario.reset();
  compra = [];
  add_detail_purchase(compra);
  detalle.style.display = 'none';
}

function deletes(elemento) {
  let boton = elemento.parentElement.parentElement;
  compra.splice(boton.getAttribute('ids'), 1);
  boton.remove();
  if(compra.length==0){
    detalle.style.display='none';
  }
}
function recargar_compra(){
  compra=[];
  lista.forEach(element =>{
    let aux=JSON.parse(element.value);
    let data = {
      precio:aux.precio,
      cantidad:aux.cantidad,
      material:aux.material,
      nombre_material:aux.nombre_material
    }
    compra.push(data);

  });
  console.log(compra);     
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
