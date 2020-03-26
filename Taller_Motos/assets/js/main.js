
var clicks = 0;
var monto = document.querySelector('#monto');
const formulario = document.querySelector('#formulario');


var valor= null;

function validacionContrasenas(contrasena1,contrasena2){
  
  
            var contraUno= contrasena1;
            var contraDos= contrasena2;

            if(contraUno==contraDos){

             $.ajax({
            data:  $("#formulario").serialize(),//datos que se envian a traves de ajax
            url:   'security.php?action=cambio_contrasena', //archivo que recibe la peticion
            type:  'post', //método de envio
             datatype: 'json',
            success: function (response){
              let resultado =JSON.parse(response);
              
           alert(resultado.result);
        
            }
            });
         
           
            }else{
              $('.toast').toast('show');
            }
}



function cambiarojo(x) {
  x.classList.toggle("fa-eye-slash");
}

function mostrar_contrasena_diferentes(){
  $('.toast').toast('show');

  }

function add() {
  if (clicks == 0) {
    let before = document.querySelector('form');
    let general = document.createElement('div');
    general.className = "input-group mb-3";
    general.innerHTML = `<select name="marca" class="form-control">
    <option value="Fox">Fox</option>
    <option value="Suzuki">Suzuki</option>
    <option value="Generica">Generica</option>
  </select>
  <div class="input-group-append">
    <span class="btn btn-danger" id="eliminar" type="submit" onclick="delete_span(this)">-</span>
  </div>`
    clicks = 1;
    monto.style.display = 'block';
    before.insertBefore(general, document.querySelector('#x'));
  }

}

function delete_span(e) {
  clicks = 0;
  monto.style.display = 'none';

  e.parentElement.parentElement.remove();

}


function selec(sel) {
  var value = sel.options[sel.selectedIndex].value;
  add();
}

function mostrarPass() {
  var x = document.getElementById("inputpass");
  if (x.type === "password") {
    x.type = "text";
    cambiarojo(document.getElementById("font_ojo"));
  } else {
    x.type = "password";
    cambiarojo(document.getElementById("font_ojo"));
  }
}

function ponerborde() {
  var x = document.getElementById("grup-pass");
  var valor = document.getElementById("inputpass");
  if(valor.focus){
  x.style.borderColor ="#00b894";
  x.style.boxShadow = "inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(0, 184, 148, 0.6)";

  }

}

function quitarborde() {
var x = document.getElementById("grup-pass");
x.style.borderColor ="";
x.style.boxShadow = "none";

}

