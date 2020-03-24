window.addEventListener('load',()=>{
 // document.getElementById('purchase').style.display='none';
});
var clicks = 0;
var monto = document.querySelector('#monto');


function add() {
  if (clicks == 0) {
    monto.style.display = 'block';
    get_medida()
  }

}
function get_medida() {
  let action='get_medida';
  let id=document.querySelector('#categoria').value;
  $.ajax({
    type: "post",
    url: "controller.php",
    data: { action,id },
    success: function (response) {
      let medida=JSON.parse(response);
      document.querySelector('.medida').textContent=medida.nombre_medida;
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
