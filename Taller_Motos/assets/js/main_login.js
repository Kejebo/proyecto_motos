
var formulario = document.querySelector("#formulario");
var formulario_validar_codigo = document.querySelector(
  "#formulario_validar_codigo"
);

var formulario_enviar = document.querySelector("#formulario_enviar_correo");
var valor = null;
var id = null;
var correo_electronico_link = null;

window.addEventListener("load", function() {
  if (formulario != null) {
    formulario.addEventListener("submit", function() {
      validacionContrasenas();
    });
  }
});

window.addEventListener("load", function() {
  if (formulario != null) {
    formulario_validar_codigo.addEventListener("submit", function() {
      validar_codigo();
    });
  }
});

window.addEventListener("load", function() {
  if (formulario != null) {
    formulario_enviar.addEventListener("submit", function() {
      enviar_correo();
    });
  }
});

function validar_codigo() {
  event.preventDefault();
  var codigo = document.getElementById("codigo").value;

  $.ajax({
    data: {
      codigo: codigo,
      correo_electronico_link: correo_electronico_link,
      id: id
    },
    url: "security.php?action=validar",
    type: "post",
    datatype: "json",
    success: function(response) {
      let resultado = JSON.parse(response);
      if (resultado.result == "false") {
        alertar_validar_codigo();
      } else {
        document.querySelector("#div_form_validacion").style.display = "none";
        document.getElementById("div_form_cambio").style.display = null;
      }
    }
  });
}

function enviar_correo() {
  animacion_enviado_codigo_primero();
  event.preventDefault();
 
  $.ajax({
    data: $("#formulario_enviar_correo").serialize(),
    url: "security.php?action=enviar_correo",
    type: "post",
    datatype: "json",
    success: function(response) {
     let resultado = JSON.parse(response);
      if (resultado.result == "true") {
     correo_electronico_link = resultado.correo;
      id = resultado.id_usuario;
        document.querySelector("#div_form_completa").style.display = "none";
       document.getElementById("div_form_validacion").style.display = null;
     } else if (resultado.result == "codigo_activo") {
    restaurar_icono_enviar();
    alertar_validar_codigo_activo();
    }else if (resultado.resultDos == "false"){
      alert("Problemas con el Proveedor de Correos")
   }
    }
  });
}

function reenviar_codigo() {
  animacion_enviado_codigo();
  event.preventDefault();

  $.ajax({
    data: { id: id, correo_electronico_link: correo_electronico_link },
    url: "security.php?action=reenviar_correo",
    type: "post",
    datatype: "json",
    success: function(response) {
      let resultado = JSON.parse(response);
      if (resultado.result == "true") {
        restaurar_icono_reenviar();
      } else if (resultado.result == "codigo_activo") {
        restaurar_icono_reenviar();
      }
    }
  });
}

function alertar_validar_codigo() {
  var alerta =
    '<div class="toast" id="no_valido">' +
    '<div class="toast-header">' +
    '<strong class="mr-auto text-primary alerta"><i class="fas fa-exclamation-circle icono_alerta"></i> Codigo invalido </strong>' +
    '<button  id ="cerrar_alerta_invalido" type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>' +
    "</div>" +
    "</div>";

  $("#invalido").append(alerta);
  $("#no_valido").toast({ delay: 3000 });
  $("#no_valido").toast("show");
  document.getElementById("boton_validar").disabled = true;
  document
    .getElementById("cerrar_alerta_invalido")
    .addEventListener("click", function() {
      document.getElementById("boton_validar").disabled = false;
    });

  setTimeout(function() {
    $("#no_valido").remove();
  }, 3000);
  setTimeout(function() {
    $("#boton_validar").prop("disabled", false);
  }, 3000);
  document.getElementById("codigo").value = null;
}

function alertar_validar_codigo_activo() {
  var alerta =
    '<div class="toast" id="activo_alerta">' +
    '<div class="toast-header">' +
    '<strong class="mr-auto text-primary alerta"><i class="fas fa-exclamation-circle icono_alerta"></i> Imposible enviar Correo </strong>' +
    '<button  id ="cerrar_alerta_activo" type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>' +
    "</div>" +
    "</div>";

  $("#div_codigo_activo").append(alerta);
  $("#activo_alerta").toast({ delay: 2000 });
  $("#activo_alerta").toast("show");
  document.getElementById("boton_enviar_primera").disabled = true;
  document
    .getElementById("cerrar_alerta_activo")
    .addEventListener("click", function() {
      document.getElementById("boton_enviar_primera").disabled = false;
    });

  setTimeout(function() {
    $("#activo_alerta").remove();
  }, 2000);
  setTimeout(function() {
    $("#boton_enviar_primera").prop("disabled", false);
  }, 2000);
  document.getElementById("correo_enviar_primera").value = null;
  document.getElementById("correo_enviar_primera").focus;
}

function validacionContrasenas() {
  var contrasenaUno = document.getElementById("contrasenaUno").value;
  var contrasenaDos = document.getElementById("contrasenaDos").value;
  event.preventDefault();
  $.ajax({
    data: {
      id: id,
      correo_electronico_link: correo_electronico_link,
      contrasenaUno: contrasenaUno,
      contrasenaDos: contrasenaDos
    },
    url: "security.php?action=cambio_contrasena",
    type: "post",
    datatype: "json",
    success: function(response) {
      let resultado = JSON.parse(response);
      if (resultado.result == "actualizado") {
        contrasena_actualizacion_exitosa();
      } else if (resultado.result == "no iguales") {
        contrasenas_coincidencia_alerta();
      } else if (resultado.result == "no actualizado") {
        contrasena_no_actualizada_alerta();
      }
    }
  });
}

function restaurar_icono_reenviar() {
  var boton_real =
    '<div id="total"><strong> <a id="boton_reenviar"  onclick="reenviar_codigo()" class = " pregunta_contrasena link"><div id="div_icono_reenviar"><i id="icono_reenviar"class="fas fa-share"></i></div> reenviar codigo</a></strong></div>';
  $("#falso").remove();
  $("#div_reenviar").append(boton_real);
}

function animacion_enviado_codigo() {
  var boton_falso =
    '<div id="falso"><strong> <a id="boton_reenviar"class = " pregunta_contrasena link"><div id="div_icono_reenviar"><span  id = "animacion" class="spinner-border spinner-border-sm"></span></div> reenviar codigo</a></strong></div>';
  $("#total").remove();
  $("#div_reenviar").append(boton_falso);
}

function animacion_enviado_codigo_primero() {
  $("#boton_enviar_primera").remove();
  var boton_falso =
    '<button id = "boton_enviar_falso" disabled class="btn btn-primary  boton_success"> <span class="spinner-border spinner-border-sm"></span> enviando correo</button>';
  $("#enviar_correo_boton").append(boton_falso);
  
}

function restaurar_icono_enviar() {
  var boton_real =
    '<button  id = "boton_enviar_primera" type="submit" class="btn btn-primary boton_success"><i id="icono_reenviar"class="fas fa-share"></i> enviar correo</button>';
  $("#boton_enviar_falso").remove();
  $("#enviar_correo_boton").append(boton_real);
}

function contrasena_no_actualizada_alerta() {
  var alerta =
    '<div class="toast" id="no_actualizada">' +
    '<div class="toast-header">' +
    '<strong class="mr-auto text-primary alerta"><i class="fas fa-exclamation-circle icono_alerta"></i> La contraseña no se pudo actualizar</strong>' +
    '<button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>' +
    "</div>" +
    "</div>" +
    "</div>";

  $("#cambio_correcto").append(alerta);
  $("#no_actualizada").toast({ delay: 7000 });
  $("#no_actualizada").toast("show");

  setTimeout(function() {
    $("#no_actualizada").remove();
  }, 7000);
  document.getElementById("contrasenaUno").value = null;
  document.getElementById("contrasenaUno").focus();
  document.getElementById("contrasenaDos").value = null;
}

function contrasena_actualizacion_exitosa() {
  var alerta =
    '<div class="toast" data-autohide="false" id="actualizada">' +
    '<div class=""toast-header">' +
    "<br>" +
    '<strong class="mr-auto text-primary">Recuperacion Exitosa</strong>' +
    "<hr>" +
    "</div>" +
    '<div class="toast-body">' +
    "Su contraseña ha sido Recuperada con exito" +
    "<hr>" +
    '<a href="index.php">Iniciar Sesion</a>' +
    "</div>" +
    "</div>" +
    "</div>";

  $("#cambio_correcto").append(alerta);

  $("#actualizada").toast("show");
  document.getElementById("bcambio").disabled = true;
  document.getElementById("contrasenaUno").disabled = true;
  document.getElementById("contrasenaDos").disabled = true;
  removeElementsByClass("body_cambio");
  removeElementsByClass("card-title");
}

function removeElementsByClass(className) {
  var elements = document.getElementsByClassName(className);
  while (elements.length > 0) {
    elements[0].parentNode.removeChild(elements[0]);
  }
}

function contrasenas_coincidencia_alerta() {
  var alerta =
    '<div class="toast" id="coincidencia">' +
    '<div class="toast-header">' +
    '<strong class="mr-auto text-primary alerta"><i class="fas fa-exclamation-circle icono_alerta"></i> Las contraseña no coinciden </strong>' +
    '<button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>' +
    "</div>" +
    "</div>" +
    "</div>";

  $("#no_iguales").append(alerta);
  $("#coincidencia").toast({ delay: 3000 });
  $("#coincidencia").toast("show");

  setTimeout(function() {
    $("#coincidencia").remove();
  }, 3000);
  document.getElementById("contrasenaDos").value = null;
  document.getElementById("contrasenaUno").focus();
}

function cambiarojo(x) {
  var valor = x;

  if (valor.type === "string") {
    valor = document.getElementById(x);
    valor.classList.toggle("fa-eye-slash");
  } else {
    valor.classList.toggle("fa-eye-slash");
  }
}

function mostrar_contrasena_diferentes() {
  $(".toast").toast("show");
}

function delete_span(e) {
  clicks = 0;
  monto.style.display = "none";

  e.parentElement.parentElement.remove();
}

function selec(sel) {
  var value = sel.options[sel.selectedIndex].value;
  add();
}

function mostrarPass(x, y) {
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

function ponerborde(x, y) {
  var x = document.getElementById(x);
  var valor = document.getElementById(y);
  if (valor.focus) {
    x.style.borderColor = "#00b894";
    x.style.boxShadow =
      "inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(0, 184, 148, 0.6)";
  }
}

function quitarborde(y) {
  var x = document.getElementById(y);
  x.style.borderColor = "";
  x.style.boxShadow = "none";
}
