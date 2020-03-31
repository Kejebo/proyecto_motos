var compra = [];
var venta=[];
var reparacion=[];
var clicks = 0;
var saldo = 0;
var valor=false;
window.addEventListener('load', () => {
  let i = 0;
  recargar_compra();
  recargar_venta();
  insert_purchase(i);
  insert_sale(i);
});
function insert_marca(){
  let nombre_marca=document.querySelector('#nombre_marca').value
  let action='insert_marca';
  $.ajax({
      type: "post",
      url: "controller.php",
      data: {action,nombre_marca},
      success: function (response) {
        let datos=JSON.parse(response);
        document.querySelector('#marca').innerHTML='';
        datos.forEach(element => {
          document.querySelector('#marca').innerHTML+=`
          <option value=${element.id_marca_material}>${element.nombre_marca}<opcion>`
        });
      }
    });    
}
function insert_category(){
  let nombre_categoria=document.querySelector('#nombre_categoria').value;
  let id_medida=document.querySelector('#id_medida').value;
  let action='insert_categoria';
  $.ajax({
      type: "post",
      url: "controller.php",
      data: {action,id_medida,nombre_categoria},
      success: function (response) {
        let datos=JSON.parse(response);
        document.querySelector('#categoria').innerHTML='';
        datos.forEach(element => {
          document.querySelector('#categoria').innerHTML+=`
          <option value=${element.id_categoria}>${element.nombre_categoria}<opcion>`
        });
      }
    });    
}
function insert_purchase(i){

  $('#form-purchase').submit(function (e){
    e.preventDefault();

    let nombre = document.querySelector('#material');

    detalles = {
      precio: document.querySelector('#precio').value,
      cantidad: document.querySelector('#cantidad').value,
      material: document.querySelector('#material').value,
      nombre_material: nombre.options[nombre.selectedIndex].textContent
    };
    if (detalles.cantidad > 0) {
      compra.push(detalles);
      saldo += detalles.precio * detalles.cantidad;
      resetear();
      document.querySelector('#detalle').appendChild(crear_fila(detalles, i++,'#purchase','purchase'));
    } else {
      showMessage('Ingrese una cantidad mayor', 'danger','#form-purchase');
    }
  });
}
 
function insert_sale(i){

  $('#form-sale').submit(function (e){
    e.preventDefault();

    let nombre = document.querySelector('#material');

    detalles = {
      precio: document.querySelector('#precio').value,
      cantidad: document.querySelector('#cantidad').value,
      material: document.querySelector('#material').value,
      nombre_material: nombre.options[nombre.selectedIndex].textContent
    };
    if (detalles.cantidad > 0) {
      venta.push(detalles);
      saldo += detalles.precio * detalles.cantidad;
      resetear();
      document.querySelector('#detalle').appendChild(crear_fila(detalles, i++,'#venta','sale'));
    } else {
      showMessage('Ingrese una cantidad mayor', 'danger','#form-sale');
    }

  });
}
function crear_fila(detalles, i ,table,action) {
  json = JSON.stringify(detalles);
  let tr=document.createElement('tr');
  tr.setAttribute('ids',i);
  tr.innerHTML = `
  <input type=hidden class=lista name=detalles[] value=${json}
  <td>${detalles.nombre_material}</td>
  <td>${detalles.cantidad}</td>
  <td>${detalles.precio}</td>
   <td>${detalles.precio * detalles.cantidad}</td>
   <td><span class="delete_detail btn btn-danger" onclick=deletes(this,${action})><i class="fas fa-trash"></i></span></td>
    `
    document.querySelector(table).style.display = 'block';

  total();
  return tr;
}
function validate_sale(id,cantidad){
  let action='get_saldo';
  var result='';
  $.ajax({
    type: "post",
    url: "controller.php",
    data: {action,id},
    success: function (response) {
      let dato=JSON.parse(response);
      document.querySelector('#saldo').value=dato.saldo>=cantidad ? true:false;     
    }
  });
  return ;
}
function total() {
  document.querySelector('#pie').innerHTML = ` <tr>
  <td>Saldo</td>
  <td></td>
  <td></td>
  <td>${saldo}</td>
  <td></td>
</tr>`

}
function sendsale(action){
  let id = document.querySelector('#id').value;
  alert(id);
  let cliente = document.querySelector('#cliente').value;
  let fecha = document.querySelector('#fecha').value;
  let datos = { id, cliente, fecha }
  alert(action);
  $.ajax({
    type: "post",
    url: "controller.php",
    data: { action, datos, venta },
    success: function (response) {
      setTimeout(() => {
        showMessage('Se realizo la venta correctamente', 'success','#form-sale');
       window.location.href = 'sales.php';
      }, 1000);
    }
  });
  document.querySelector('#venta').style.display = 'none';
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
      setTimeout(() => {
        showMessage('Se realizo la compra correctamente', 'success','#form-purchase');
        window.location.href = 'purchases.php';
      }, 1000);
    }
  });
  document.querySelector('#purchase').style.display = 'none';
}

function deletes(elemento,form) {
  let boton = elemento.parentElement.parentElement;
  switch(form){
    case 'purchase':
      compra.splice(boton.getAttribute('ids'), 1);
      boton.remove();
      if (compra.length == 0) {
        document.querySelector('#purchase').style.display = 'none';
      }
      break;
    case 'sale':
      venta.splice(boton.getAttribute('ids'), 1);
      boton.remove();
      if (venta.length == 0) {
        document.querySelector('#sale').style.display = 'none';
      }
      break;
  }

}
function resetear() {
  document.querySelector('#precio').value = 0;
  document.querySelector('#cantidad').value = 0;
  document.querySelector('#guardar').style.display = 'block';
  document.querySelector('#cancelar').style.display = 'block';
}
function recargar_compra() {
  compra = [];
  document.querySelectorAll('.lista').forEach(element => {
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
function recargar_venta() {
  venta = [];
  document.querySelectorAll('.lista').forEach(element => {
    let aux = JSON.parse(element.value);
    let data = {
      precio: aux.precio,
      cantidad: aux.cantidad,
      material: aux.material,
      nombre_material: aux.nombre_material
    }
    saldo += data.precio * data.cantidad;
    venta.push(data);

  });
}
function add() {
  if (clicks == 0) {
    document.querySelector('#monto').style.display = 'block';
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
  if (opciones.toLowerCase() == "aceite" || opciones.toLowerCase() == "cables" ||opciones.toLowerCase()=="combustible") {
    add();
  } else {
    delete_span(document.querySelector('.medida'));
  }
}
function get_prices(combo) {
  let id = combo.options[combo.selectedIndex].value;
  let action = 'get_prices';
  $.ajax({
    type: "Post",
    url: "controller.php",
    data: { action, id },
    success: function (response) {
      let saldo = JSON.parse(response);
      document.querySelector('#precio').value = saldo.precio;
    }
  });
}
function showMessage(message, cssClass,form) {
  const mensaje = document.createElement('div');
  mensaje.className = `alert alert-${cssClass} mt-4`;
  mensaje.appendChild(document.createTextNode(message));
  const container = document.querySelector(form);
  const notificacion = document.querySelector('.notificar');
  container.insertBefore(mensaje, notificacion);
  setTimeout(() => {
    document.querySelector('.alert').remove();
  }, 3000);
}


