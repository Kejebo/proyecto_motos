var compra = [];
const formulario = document.querySelector('form');
var clicks = 0;
var monto = document.querySelector('#monto');
var lista=document.querySelectorAll('.lista');
var detalle = document.querySelector('#purchase');

window.addEventListener('load', () => {
  const pagina = document.getElementById('modulo').textContent;
    if(formulario.getAttribute('action')=='update'){
      let i=0;
      lista.forEach(element =>{
        let aux=JSON.parse(element.value);
        compra.push(aux);
        
        i++;
        console.log(aux.material);
      });
    }
    formulario.addEventListener('submit', (e) => {
   
    if (pagina == 'Modulo Compras') {

      let precio = document.querySelector('#precio').value;
      let cantidad = document.querySelector('#cantidad').value;
      let material = document.querySelector('#material').value;
      let nombre = document.querySelector('#material');
      let nombre_material = nombre.options[nombre.selectedIndex].textContent;
      if(precio>0 && cantidad>0){
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
    }else{
      showMessage('Datos Incorrectos','danger');
    }
      e.preventDefault();
      add_detail_purchase(compra);
    }
  });
});
function sendpurchase() {
  let id = document.querySelector('#id').value;
  let factura = document.querySelector('#factura').value;
  let proveedor = document.querySelector('#proveedor').value;
  let fecha = document.querySelector('#fecha').value;
  let datos = {
    id,
    factura,
    proveedor,
    fecha
  }
  let action = "insert_purchase";
  $.ajax({
    type: "post",
    url: "controller.php",
    data: { action, datos, compra },
    success: function (response) {
      showMessage('Se realizo la compra correctamente', 'success');
    }
  });
  formulario.reset();
  compra = [];
  add_detail_purchase(compra);
  detalle.style.display = 'none';
}

function add_detail_purchase(lista) {
  let lista_compra = document.querySelector('#detalle');
  lista_compra.innerHTML = "";
  for (let i = 0; i < lista.length; i++) {
    lista_compra.innerHTML += `<tr ids=${i}>
    <input type=hidden name=detalle[] class=lista value=${JSON.stringify(lista[i])}>
    <td>${lista[i].nombre_material}</td>
    <td>${lista[i].cantidad}</td>
    <td>${lista[i].precio}</td>
    <td>${lista[i].precio * lista[i].cantidad}</td>
    <td><span class='delete_detail btn btn-danger' onclick=deletes(this)>x</span></td>
    </tr>`;
  }
}
function deletes(elemento) {
  let detalledos = document.querySelector('#purchase');

  let boton = elemento.parentElement.parentElement;
  compra.splice(boton.getAttribute('ids'), 1);
  if (compra.length > 0) {
    add_detail_purchase(compra);
  } else {
    detalledos.style.display = 'none';
  }
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
  }, 5000);
}
