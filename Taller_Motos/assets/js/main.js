var compra = [];
var venta = [];
var reparacion = [];
var clicks = 0;
var i = 0;
var trabajo=[];
var trabajo_material=[];
window.addEventListener('load', () => {
  const titulo=document.querySelector('#modulo').textContent;
  if(titulo==='Modulo Compras'||titulo==='Modulo Ventas'){
  recargar_compra();
  recargar_venta();
  insert_purchase(i);
  insert_sale();
}else
  if(titulo==='Modulo Mantenimiento'){
    insert_work();
    recargar_trabajo();
    recargar_materiales();
  }
});

function insert_work_detail(){
  trabajo.push(
    {id_trabajo:document.querySelector("#trabajo").value,
    nombre_trabajo:document.querySelector('#trabajo').textContent,
    precio:0}
  );
  let tabla=document.querySelector('#detail_work');
  tabla.innerHTML='';
  let aux=0;
  trabajo.forEach(element => {
    tabla.innerHTML+=`  <tr ids=${aux++}>
          <td>${element.nombre_trabajo}</td>
          <td><span class="btn btn-danger" onclick="deletes(this,'work')">X</span></td>
        </tr>`
  });

  console.log(trabajo);
}

function insert_materialwork_detail(){
  trabajo_material.push(
    {id_material:document.querySelector("#material").value,
    nombre_material:document.querySelector('#material').textContent,
    cantidad:document.querySelector('#cant').value
  }
  );
  let tabla=document.querySelector('#detail_material');
  tabla.innerHTML='';
  trabajo_material.forEach(element => {
    tabla.innerHTML+=`  <tr>
          <td>${element.nombre_material}</td>
          <td>${element.cantidad}</td>
          <td><span class="btn btn-danger" onclick="deletes(this,'material')">X</span></td>
        </tr>`
  });

  console.log(trabajo);
}

function insert_marca() {
  let nombre_marca = document.querySelector('#nombre_marca').value
  let action = 'insert_marca';
  $.ajax({
    type: "post",
    url: "controller.php",
    data: { action, nombre_marca },
    success: function (response) {
      let datos = JSON.parse(response);
      document.querySelector('#marca').innerHTML = '';
      datos.forEach(element => {
        document.querySelector('#marca').innerHTML += `
          <option value=${element.id_marca_material}>${element.nombre_marca}<opcion>`
      });
    }
  });
}
function insert_category() {
  let nombre_categoria = document.querySelector('#nombre_categoria').value;
  let id_medida = document.querySelector('#id_medida').value;
  let action = 'insert_categoria';
  $.ajax({
    type: "post",
    url: "controller.php",
    data: { action, id_medida, nombre_categoria },
    success: function (response) {
      let datos = JSON.parse(response);
      document.querySelector('#categoria').innerHTML = '';
      datos.forEach(element => {
        document.querySelector('#categoria').innerHTML += `
          <option value=${element.id_categoria}>${element.nombre_categoria}<opcion>`
      });
    }
  });
}

function insert_transmision() {
  let nombre_transmision = document.querySelector('#nombre_transmision').value
  let action = 'insert_transmision';

  $.ajax({
    type: "post",
    url: "controller.php",
    data: {action,nombre_transmision },
    datatype:"json",
    success: function (response) {
    let datos = JSON.parse(response);
      document.querySelector('#transmision').innerHTML = '';
      datos.forEach(element => {
        document.querySelector('#transmision').innerHTML += `
          <option value=${element.id_transmision}>${element.nombre_transmision}<opcion>`
      });
    }
  });
}

function insert_marcas_motos() {
  let nombre_marca = document.querySelector('#nombre_marca').value
  let action = 'insert_marcas_motos';

  $.ajax({
    type: "post",
    url: "controller.php",
    data: {action,nombre_marca },
    datatype:"json",
    success: function (response) {
    let datos = JSON.parse(response);
      document.querySelector('#marca').innerHTML = '';
      datos.forEach(element => {
        document.querySelector('#marca').innerHTML += `
          <option value=${element.id_marca_moto}>${element.nombre_marca}<opcion>`
      });
    }
  });
}
function insert_combustible() {
  let nombre_combustible = document.querySelector('#nombre_combustible').value
  let action = 'insert_combustible';

  $.ajax({
    type: "post",
    url: "controller.php",
    data: {action,nombre_combustible },
    datatype:"json",
    success: function (response) {
    let datos = JSON.parse(response);
      document.querySelector('#combustible').innerHTML = '';
      datos.forEach(element => {
        document.querySelector('#combustible').innerHTML += `
          <option value=${element.id_combustible}>${element.tipo_combustible}<opcion>`
      });
    }
  });
}

function insert_cilindraje() {
  let tamano_cilindraje = document.querySelector('#nombre_cilindraje').value
  let action = 'insert_cilindraje';

  $.ajax({
    type: "post",
    url: "controller.php",
    data: {action,tamano_cilindraje },
    datatype:"json",
    success: function (response) {
    let datos = JSON.parse(response);
      document.querySelector('#cilindraje').innerHTML = '';
      datos.forEach(element => {
        document.querySelector('#cilindraje').innerHTML += `
          <option value=${element.id_cilindraje}>${element.tamano_cilindraje}<opcion>`
      });
    }
  });
}
function insert_modelo_motos() {
  let nombre_modelo = document.querySelector('#nombre_modelo').value;
  let ano = document.querySelector('#ano').value;
  let action = 'insert_modelo_motos';
  $.ajax({
    type: "post",
    url: "controller.php",
    data: {action,nombre_modelo,ano },
    datatype:"json",
    success: function (response) {
    let datos = JSON.parse(response);
      document.querySelector('#modelo').innerHTML = '';
      datos.forEach(element => {
        document.querySelector('#modelo').innerHTML += `
          <option value=${element.id_modelo_moto}>${element.nombre_modelo} ${element.ano}<opcion>`
      });
    }
  });
}
function insert_purchase(i) {

  $('#form-purchase').submit(function (e) {
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
      resetear();
      document.querySelector('#detalle').appendChild(crear_fila(detalles, i++, '#purchase', 'purchase'));
      total_compra();
    } else {
      showMessage('Ingrese una cantidad mayor', 'danger', '#form-purchase');
    }
  });
}

function insert_sale() {

  $('#form-sale').submit(function (e) {
    e.preventDefault();
    validate_sale(document.querySelector('#material').value, document.querySelector('#cantidad').value);

  });
}

function insert_work() {

  $('#form_work').submit(function (e) {
    e.preventDefault();
    $.ajax({
      type:'post',
      url:'controller.php',
      data:{
        action:document.querySelector('#form_work').getAttribute('action'),
        fecha:document.querySelector('#entrada').value,
        cliente:document.querySelector('#cliente').value,
        moto:document.querySelector('#motos').value,
        trabajo:trabajo,
        material:trabajo_material
      },
      datatype:'json',
      success: function (response) {
        alert('Se ha ingresado correctamente los datos');
          window.location.href='repairs.php';
      }
    });
  });
}
function insert_sale_data(monto) {
  if (monto >= 0) {
    let nombre = document.querySelector('#material');

    detalles = {
      precio: document.querySelector('#precio').value,
      cantidad: document.querySelector('#cantidad').value,
      material: document.querySelector('#material').value,
      nombre_material: nombre.options[nombre.selectedIndex].textContent
    };
    if (detalles.cantidad > 0) {
      venta.push(detalles);

      resetear();
      document.querySelector('#detalle').appendChild(crear_fila(detalles, i++, '#venta', 'sale'));
      total_venta();

    } else {
      showMessage('Ingrese una cantidad mayor', 'danger', '#form-sale');
    }
  }
}
function crear_fila(detalles, i, table, action) {
  json = JSON.stringify(detalles);
  let tr = document.createElement('tr');
  tr.setAttribute('ids', i);
  tr.innerHTML = `
  <input type=hidden class=lista name=detalles[] value=${json}
  <td>${detalles.nombre_material}</td>
  <td>${detalles.cantidad}</td>
  <td>${detalles.precio}</td>
   <td>${detalles.precio * detalles.cantidad}</td>
   <td><span class="delete_detail btn btn-danger" onclick=deletes(this,"${action}")><i class="fas fa-trash"></i></span></td>
    `
  document.querySelector(table).style.display = 'block';

  return tr;
}
function validate_sale(id, cantidad) {
  let action = 'get_saldo';
  var result = '';
  $.ajax({
    type: "post",
    url: "controller.php",
    data: { action, id },
    success: function (response) {
      let dato = JSON.parse(response);
      insert_sale_data(dato.saldo - cantidad);
      total_venta();
    }
  });
  return;
}
function total_compra() {
  let saldo = 0;
  compra.forEach(element => {
    saldo += element.cantidad * element.precio;
  });
  document.querySelector('#pie').innerHTML = ` <tr>
  <td>Saldo</td>
  <td></td>
  <td></td>
  <td>${saldo}</td>
  <td></td>
</tr>`

}

function total_venta() {
  let saldo = 0;
  venta.forEach(element => {
    saldo += element.cantidad * element.precio;
  });
  document.querySelector('#pie').innerHTML = ` <tr>
  <td>Saldo</td>
  <td></td>
  <td></td>
  <td>${saldo}</td>
  <td></td>
</tr>`

}
function sendsale(action) {
  let id = document.querySelector('#id').value;
  let cliente = document.querySelector('#cliente').value;
  let fecha = document.querySelector('#fecha').value;
  let datos = { id, cliente, fecha }
  $.ajax({
    type: "post",
    url: "controller.php",
    data: { action, datos, venta },
    success: function (response) {
      setTimeout(() => {
        showMessage('Se realizo la venta correctamente', 'success', '#form-sale');
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
        showMessage('Se realizo la compra correctamente', 'success', '#form-purchase');
        window.location.href = 'purchases.php';
      }, 1000);
    }
  });
  document.querySelector('#purchase').style.display = 'none';
}

function deletes(elemento, form) {
  let boton = elemento.parentElement.parentElement;
  switch (form) {
    case 'purchase':
      saldo -= compra[boton.getAttribute('ids')].cantidad * compra[boton.getAttribute('ids')].precio;
      compra.splice(boton.getAttribute('ids'), 1);
      boton.remove();
      if (compra.length == 0) {
        document.querySelector('#purchase').style.display = 'none';
      }
      total_compra();
      break;
    case 'sale':
      venta.splice(boton.getAttribute('ids'), 1);
      boton.remove();
      if (venta.length == 0) {
        document.querySelector('#sale').style.display = 'none';
      }
      total_venta();
      break;

      case 'material':
        trabajo_material.splice(boton.getAttribute('ids'), 1);
        boton.remove();
        break;
        case 'work':
          trabajo.splice(boton.getAttribute('ids'), 1);
          boton.remove();
          break;
  }

}
function resetear() {
  document.querySelector('#material').selectedIndex = 0;
  document.querySelector('#precio').value = 0;
  document.querySelector('#cantidad').value = 0;
  document.querySelector('#guardar').style.display = 'block';
  document.querySelector('#cancelar').style.display = 'block';
}
function recargar_trabajo() {
  saldo = 0;
  trabajo = [];
  document.querySelectorAll('.trabajos').forEach(element => {
    let aux = JSON.parse(element.value);
    let data = {
      id_trabajo: aux.id,
      nombre_trabajo: aux.trabajo
    }
    trabajo.push(data);
  });
  console.log(trabajo);
}
function recargar_materiales() {
  trabajo_material = [];
  document.querySelectorAll('.materiales').forEach(element => {
    let aux = JSON.parse(element.value);
    let data = {
      id_material: aux.material,
      nombre_material: aux.nombre+' '+aux.marca+' ' +aux.monto+' '+aux.medida,
      cantidad:aux.cant
    }
    trabajo_material.push(data);
  });
}
function recargar_compra() {
  saldo = 0;
  compra = [];
  document.querySelectorAll('.lista').forEach(element => {
    let aux = JSON.parse(element.value);
    let data = {
      precio: aux.precio,
      cantidad: aux.cantidad,
      material: aux.material,
      nombre_material: aux.nombre_material
    }
    compra.push(data);
  });
  total_compra();
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
    venta.push(data);

  });
  total_venta();
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
  if (opciones.toLowerCase() == "aceite" || opciones.toLowerCase() == "cables" || opciones.toLowerCase() == "combustible") {
    add();
  } else {
    delete_span(document.querySelector('.medida'));
  }
}

function get_motos(combo) {
  let id_cliente = combo.options[combo.selectedIndex].value;
  let action = 'get_motos';

  if (id_cliente>0) {
  $.ajax({
    type: "Post",
    url: "controller.php",
    data: { action, id_cliente },
    datatype:'json',
    success: function (response) {
      let datos=JSON.parse(response);
      let motos=  document.querySelector('#motos');
      motos.innerHTML='';
      datos.forEach(element => {
      motos.innerHTML+=`<option value="${element.id}">${element.moto}</opcion>`
      });
      console.log(response);
    }
  });
} else {
  document.querySelector('#motos').innerHTML='<option value="0">Seleccione un cliente</option>';
}

}
function get_prices(combo) {
  let id = combo.options[combo.selectedIndex].value;
  let action = 'get_prices';
  if (id>0) {
  $.ajax({
    type: "Post",
    url: "controller.php",
    data: { action, id },
    success: function (response) {
      let saldo = JSON.parse(response);

        document.querySelector('#precio').value = saldo.precio;
    }
  });
} else {
  document.querySelector('#precio').value = 0;
}

}
function showMessage(message, cssClass, form) {
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
