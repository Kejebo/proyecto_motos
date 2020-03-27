
var clicks = 0;
var monto = document.querySelector('#monto');
var formulario = document.querySelector('#formulario');
var valor= null;



window.addEventListener("load",function() {
  formulario.addEventListener("submit",function() {
   validacionContrasenas();
  });
});



function validacionContrasenas(){
       
           event.preventDefault();
            $.ajax({
            data:  $("#formulario").serialize(),
            url:   'security.php?action=cambio_contrasena', 
            type:  'post', 
            datatype: 'json',
            success: function (response){
              
              let resultado =JSON.parse(response);
               if(resultado.result=="actualizado"){
                
              contrasena_actualizacion_exitosa()

             }else if(resultado.result=="no iguales"){

              contrasnas_coincidencia_alerta();
              
             }else if(resultado.result=="no actualizado"){

                contrasena_no_actualizada_alerta();
             }

            }
            });
          
}

function contrasena_no_actualizada_alerta(){

  var alerta = '<div class="toast" id="no_actualizada">'
  +'<div class="toast-header">'
  +'<strong class="mr-auto text-primary">Error</strong>'
  +'<small class="text-muted">Ahora</small>'
  +'<button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>'
  +'</div>'
  +'<div class="toast-body">'
  +'Las contraseña no se pudo actualizar'
  +'</div>'
  +'</div>'
  +'</div>';

  $('#cambio_correcto').append(alerta);
  $('#no_actualizada').toast({ delay: 3000 });
  $('#no_actualizada').toast('show');
  
  setTimeout(function(){ $('#no_actualizada').remove(); }, 3000);
  document.getElementById("contrasenaUno").value = null;
  document.getElementById("contrasenaUno").focus();
  document.getElementById("contrasenaDos").value = null;
  
  
}

function contrasena_actualizacion_exitosa(){

  var alerta =    '<div class="toast" data-autohide="false" id="actualizada">'
  +'<div class=""toast-header">'
  +'<strong class="mr-auto text-primary">Actualizacion Exitosa</strong>'
  +'<hr>'
  +'<a href="index.php">Inciar Sesion</a>'
  +'</div>'
  +'<div class="toast-body">'
  +'Su contraseña ha sido actualizada con exito'
 +'</div>'
  +'</div>'
  +'</div>';

  $('#cambio_correcto').append(alerta);

$('#actualizada').toast('show'); 
document.getElementById("bcambio").disabled = true;
document.getElementById("contrasenaUno").disabled = true;
document.getElementById("contrasenaDos").disabled = true;

}

function contrasnas_coincidencia_alerta(){

  var alerta = '<div class="toast" id="coincidencia">'
  +'<div class="toast-header">'
  +'<strong class="mr-auto text-primary">Error</strong>'
  +'<small class="text-muted">Ahora</small>'
  +'<button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>'
  +'</div>'
  +'<div class="toast-body">'
  +'Las contraseñas no coinciden'
  +'</div>'
  +'</div>'
  +'</div>';

  $('#no_iguales').append(alerta);
  $('#coincidencia').toast({ delay: 3000 }); 
  $('#coincidencia').toast('show');

  setTimeout(function(){ $('#coincidencia').remove(); }, 3000);
  document.getElementById("contrasenaDos").value = null;
  document.getElementById("contrasenaUno").focus();

}

function cambiarojo(x) {

  var valor = x;

  if(valor.type === 'string'){
    valor = document.getElementById(x)
    valor.classList.toggle("fa-eye-slash");

  }else{
   valor.classList.toggle("fa-eye-slash");
}
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

function mostrarPass(x,y) {
  var valor = document.getElementById(x);
  var valorDos = document.getElementById(y);
  if (valor.type === "password") {
    valor.type = "text";
    cambiarojo(valorDos);
  } else {
    valor.type = "password";
    cambiarojo(valorDos);
  }
}

function ponerborde(x,y) {
  var x = document.getElementById(x);
  var valor = document.getElementById(y);
  if(valor.focus){
  x.style.borderColor ="#00b894";
  x.style.boxShadow = "inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(0, 184, 148, 0.6)";

  }

}

function quitarborde(y) {
var x = document.getElementById(y);
x.style.borderColor ="";
x.style.boxShadow = "none";

}

