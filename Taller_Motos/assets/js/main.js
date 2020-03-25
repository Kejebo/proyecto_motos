
window.addEventListener('load', () => {
  const pagina = document.getElementById('modulo').textContent;
  const formulario = document.querySelector('form');
  const detalle= document.querySelector('#purchase');
  const compra=[];
  formulario.addEventListener('submit', (e) => {

    if (pagina == 'Modulo Compras') {
      let factura= document.querySelector('#factura').value;
      let proveedor=document.querySelector('#proveedor').value;
      let precio=document.querySelector('#precio').value;
      let cantidad=document.querySelector('#cantidad').value;
      let material=document.querySelector('#material').value;
      let nombre=document.querySelector('#material');
      let nombre_material=nombre.options[nombre.selectedIndex].textContent;
      if(compra==null){
      compra={
        factura,
        proveedor,
        precio,
        cantidad,
        material,
        nombre_material
      }
    }else{
      let aux={
        factura,
        proveedor,
        precio,
        cantidad,
        material,
        nombre_material      
      }
      detalle.style.display='block';
      compra.push(aux)
    }
      
      e.preventDefault();
      formulario.reset();
      add_detail_purchase(compra);
    }
  });
});
function add_detail_purchase(lista){
  let lista_compra=document.querySelector('#detalle');
  lista_compra.innerHTML="";
  for (let i = 0; i < lista.length; i++) {
    lista_compra.innerHTML+=`<tr>
    <td>${lista[i].nombre_material}</td>
    <td>${lista[i].cantidad}</td>
    <td>${lista[i].precio}</td>
    <td>${lista[i].precio*lista[i].cantidad}</td>
    <td><span id=delete_detail class='btn btn-danger'>x</span></td>
    </tr>`;

  }

}
var clicks = 0;
var monto = document.querySelector('#monto');


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
