window.addEventListener("load", () => {
  document.getElementById("pdf").addEventListener("click", () => {
    get_pdf();
  });
});

window.addEventListener("load", () => {
  document.getElementById("excel").addEventListener("click", () => {
    get_excel();
  });
});

function selec_report(sel) {
  var opciones = sel.options[sel.selectedIndex].textContent;
  let cliente = document.querySelector("#cliente");
  let fecha = document.querySelector("#fecha");
  let inicio = document.querySelector("#inicio");
  let final = document.querySelector("#final");
  let dia = document.querySelector("#dia");
  dia.setAttribute("type", "date");
  cliente.style.display = "none";
  fecha.style.display = "none";
  inicio.style.display = "none";
  final.style.display = "none";
  let consultar = document.querySelector("#consultar");
  consultar.disabled = false;
  let pdf = document.querySelector("#pdf");
  document.getElementById("cuerpo").innerHTML = '';

  switch (opciones) {
    case "Inventario":
      consultar.disabled = false;
      document.getElementById("excel").hidden = false;
      update_action("Inventory");
      break;

    case "Clientes":
      update_action("Clients");
      consultar.disabled = true;
      document.getElementById("excel").hidden = true;
      update_action("Clients");
      break;

    case "Motos de Cliente":
      update_action("Motos_cliente");
      cliente.style.display = "block";
      document.getElementById("excel").hidden = true;
      break;

    case "Proveedores":
      update_action("Venta_Proveedor");
      consultar.disabled = true;
      document.getElementById("excel").hidden = true;
      break;
    case "Ventas General":
      consultar.disabled = true;
      document.getElementById("excel").hidden = true;
      update_action("Venta_General");
      break;
    case "Ventas Diaria":
      fecha.style.display = "block";
      document.getElementById("excel").hidden = true;
      update_action("Venta_Diaria");
      break;

    case "Ventas Mensuales":
      fecha.style.display = "block";
      document.getElementById("excel").hidden = true;
      dia.setAttribute("type", "month");
      update_action("Venta_Mensuales");
      break;
    case "Ventas Anuales":
      fecha.style.display = "block";
      document.getElementById("excel").hidden = true;
      dia.setAttribute("type", "number");
      dia.setAttribute("min", "2020");
      dia.setAttribute("max", "3000");
      dia.value = "2020";
      update_action("Venta_Anual");
      break;
    case "Ventas Periodica":
      update_action("Venta_Periodica");
      document.getElementById("excel").hidden = true;
      inicio.style.display = "block";
      final.style.display = "block";

      break;
    case "Compras General":
      consultar.disabled = true;
      document.getElementById("excel").hidden = true;
      pdf.setAttribute("href", "pdf.php?data=Compras");
      break;
    case "Compras Diaria":
      fecha.style.display = "block";
      document.getElementById("excel").hidden = true;
      break;

    case "Compras Mensuales":
      fecha.style.display = "block";
      document.getElementById("excel").hidden = true;
      dia.setAttribute("type", "month");
      break;
    case "Compras Anuales":
      fecha.style.display = "block";
      dia.setAttribute("type", "number");
      dia.setAttribute("min", "2020");
      dia.setAttribute("max", "3000");
      document.getElementById("excel").hidden = true;
      dia.value = "2020";
      break;

    case "Compras Periodica":
      inicio.style.display = "block";
      final.style.display = "block";
      document.getElementById("excel").hidden = true;
      break;
    case "Reparaciones General":
      consultar.disabled = true;

      break;
    case "Reparaciones Diaria":
      fecha.style.display = "block";
      document.getElementById("excel").hidden = true;
      break;

    case "Reparaciones Mensuales":
      fecha.style.display = "block";
      dia.setAttribute("type", "month");
      document.getElementById("excel").hidden = true;

      break;
    case "Reparaciones Anuales":
      fecha.style.display = "block";
      dia.setAttribute("type", "number");
      dia.setAttribute("min", "2020");
      dia.setAttribute("max", "3000");
      dia.value = "2020";
      document.getElementById("excel").hidden = true;
      break;
    case "Reparaciones Periodica":
      inicio.style.display = "block";
      final.style.display = "block";
      document.getElementById("excel").hidden = true;
      break;
    default:
      break;
  }
}
function get_client_motorcycle(cliente) {
  document
    .querySelector("#pdf")
    .setAttribute(
      "href",
      "pdf.php?data=Motos_cliente&id=" +
      cliente.options[cliente.selectedIndex].value
    );
}

function get_pdf() {
  let sel = document.getElementById("tipo");
  var opciones = sel.options[sel.selectedIndex].textContent;
  let dia = document.getElementById("dia");
  switch (opciones) {
    case "Inventario":
      window.open("pdf.php?data=inventario", "_blank");
      break;

    case "Clientes":
      window.open("pdf.php?data=Clients", "_blank");
      break;

    case "Motos de Cliente":
      motos("motos_cliente");
      break;

    case "Proveedores":
      window.open("pdf.php?data=Venta_Proveedor", "_blank");
      break;
    case "Ventas General":
      window.open("pdf.php?data=ventas", "_blank");
      break;
    case "Ventas Diaria":
      Ventas_pdf(dia.value, "venta_diaria");
      break;
    case "Ventas Mensuales":
      Ventas_pdf(dia.value + "-01", "venta_mensual");
      break;
    case "Ventas Anuales":
      Ventas_pdf(dia.value, "venta_anual");
      break;

    case "Ventas Periodica":
      Ventas_periodo_pdf(
        document.getElementById("fecha_inicio").value,
        document.getElementById("fecha_final").value,
        "venta_periodo"
      );
      break;
    case "Compras General":
      window.open("pdf.php?data=compras", "_blank");
      break;
    case "Compras Diaria":
      Compras_pdf(dia.value, "compra_diaria");
      break;

    case "Compras Mensuales":
      Compras_pdf(dia.value + '-01', "compra_mensual");
      break;

    case "Compras Anuales":
      Compras_pdf(dia.value, "compra_anual");
      break;
    case "Compras Periodica":
      compras_periodo_pdf(
        document.getElementById("fecha_inicio").value,
        document.getElementById("fecha_final").value,
        "compra_periodo"
      );
      break;
    case "Reparaciones General":
      window.open("pdf.php?data=reparacion", "_blank");
      break;
    case "Reparaciones Diaria":
      reparaciones_pdf(dia.value, "reparacion_diaria");
      break;

    case "Reparaciones Mensuales":
      reparaciones_pdf(dia.value + '-01', "reparacion_mensual");
      break;

    case "Reparaciones Anuales":
      reparaciones_pdf(dia.value, "reparacion_anual");
      break;
    case "Reparaciones Periodica":
      reparaciones_pdf(
        document.getElementById("fecha_inicio").value,
        document.getElementById("fecha_final").value,
        "reparacion_periodo"
      );
      break;
  }
}

function get_excel() {
  let sel = document.getElementById("tipo");
  var opciones = sel.options[sel.selectedIndex].textContent;
  switch (opciones) {
    case "Inventario":
      inventario_excel("inventario");
      break;
  }
}

function get_consulta() {
  let sel = document.getElementById("tipo");
  var opciones = sel.options[sel.selectedIndex].textContent;
  let dia = document.getElementById("dia");
  switch (opciones) {
    case "Inventario":
      inventario("inventario");
      break;

    case "Motos de Cliente":
      motos_consulta("motos_cliente");
      break;

    case "Ventas Diaria":
      ventas_consulta(dia.value, "venta_diaria");
      break;
    case "Ventas Mensuales":
      ventas_consulta(dia.value + "-01", "venta_mensual");
      break;
    case "Ventas Anuales":
      ventas_consulta(dia.value, "venta_anual");
      break;
    case "Ventas Periodica":
      ventas_consulta_periodo(
        document.getElementById("fecha_inicio").value,
        document.getElementById("fecha_final").value,
        "venta_periodo"
      );
      break;
    case "Compras Diaria":
      compras_consulta(dia.value, "compra_diaria");
      break;

    case "Compras Mensuales":
      compras_consulta(dia.value + "-01", "compra_mensual");
      break;

    case "Compras Anuales":
      compras_consulta(dia.value, "compra_anual");
      break;
    case "Compras Periodica":
      compras_consulta_periodo(
        document.getElementById("fecha_inicio").value,
        document.getElementById("fecha_final").value,
        "compra_periodo"
      );
      break;
    case "Reparaciones Diaria":
      reparaciones_consulta(dia.value, "reparacion_diaria");
      break;

    case "Reparaciones Mensuales":
      reparaciones_consulta(dia.value + "-01", "reparacion_mensual");
      break;

    case "Reparaciones Anuales":
      reparaciones_consulta(dia.value, "reparacion_anual");
      break;
    case "Reparaciones Periodica":
      reparaciones_consulta_periodo(
        document.getElementById("fecha_inicio").value,
        document.getElementById("fecha_final").value,
        "reparacion_periodo"
      );
      break;
  }
}

function update_action(action) {
  document.querySelector("#pdf").setAttribute("href", "pdf.php?data=" + action);
}

function Ventas_pdf(dia, action) {
  $.ajax({
    type: "post",
    url: "controller.php",
    data: { dia, action },
    dataType: "json",
    success: function (response) {
      if (response != false) {
        window.open("pdf.php?data=" + action + "&dia=" + dia, "_blank");
      } else {
        alert("No hay registros de ventas");
      }
    },
  });
}

function inventario_excel(action) {
  $.ajax({
    type: "post",
    url: "controller.php",
    data: { action },
    dataType: "json",
    success: function (response) {
      if (response != false) {
        window.open("excel2.php");
      } else {
        alert("No hay registros de inventario");
      }
    },
  });
}

function Ventas_periodo_pdf(inicio, final, action) {
  $.ajax({
    type: "post",
    url: "controller.php",
    data: { inicio, final, action },
    dataType: "json",
    success: function (response) {
      if (response != false) {
        window.open(
          "pdf.php?data=" + action + "&inicio=" + inicio + "&final=" + final,
          "_blank"
        );
      } else {
        alert("No hay registros de ventas");
      }
    },
  });
}

function compras_periodo_pdf(inicio, final, action) {
  $.ajax({
    type: "post",
    url: "controller.php",
    data: { inicio, final, action },
    dataType: "json",
    success: function (response) {
      if (response != false) {
        window.open(
          "pdf.php?data=" + action + "&inicio=" + inicio + "&final=" + final,
          "_blank"
        );
      } else {
        alert("No hay registros de compras");
      }
    },
  });
}
function reparaciones_periodo_pdf(inicio, final, action) {
  $.ajax({
    type: "post",
    url: "controller.php",
    data: { inicio, final, action },
    dataType: "json",
    success: function (response) {
      if (response != false) {
        window.open('pdf.php?data=' + action + '&inicio=' + inicio + '&final=' + final, '_blank');
      } else {
        alert('No hay registros de reparaciones');
      }
    }
  });
}
function reparaciones_pdf(dia, action) {
  $.ajax({
    type: "post",
    url: "controller.php",
    data: { dia, action },
    dataType: "json",
    success: function (response) {
      if (response != false) {
        window.open('pdf.php?data=' + action + '&dia=' + dia, '_blank');
      } else {
        alert('No hay registros de Reparaciones');
      }
    }
  });
}
function Compras_pdf(dia, action) {
  $.ajax({
    type: "post",
    url: "controller.php",
    data: { dia, action },
    dataType: "json",
    success: function (response) {
      if (response != false) {
        window.open("pdf.php?data=" + action + "&dia=" + dia, "_blank");
      } else {
        alert("No hay registros de Compras");
      }
    },
  });
}

function motos(action) {
  let sel = document.getElementById("clientes");
  let id = sel.options[sel.selectedIndex].value;

  $.ajax({
    type: "post",
    url: "controller.php",
    data: { action, id },
    dataType: "json",
    success: function (response) {
      if (response != false) {
        window.open("pdf.php?data=Motos_cliente&id=" + id, "_blank");
      } else {
        alert("No tiene motos registradas");
      }
    },
  });
}
function motos_consulta(action) {
  let sel = document.getElementById("clientes");
  let id = sel.options[sel.selectedIndex].value;

  $.ajax({
    type: "post",
    url: "controller.php",
    data: { action, id },
    dataType: "json",
    success: function (response) {
      let tabla = document.getElementById("cuerpo");
      tabla.innerHTML = "";
      if (response != false) {
        document.getElementById("encabezado").innerHTML = `<th>#Placa</th>
                <th>Moto</th>
                <th>Kilometraje</th>
                <th>Historial</th>
                <th>Eliminar</th>
                <th>Editar</th>`;

        if (response != false) {
          response.forEach((list) => {
            tabla.innerHTML += `  <tr>
                        <td>${list.placa}</td>
                        <td>${list.moto}</td>
                        <td>${list.kilometraje}</td>
                        <td><a href="historial.php?moto=${list.placa}" target="_blank" class="btn btn-info"><i class="far fa-eye"></i></a></td>
                        <td><a href="motorcycle.php?action=delete&id=${list.id}" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                        <td><a href="manage_motorcycle.php?action=update_moto&id=${list.id}" class="btn btn-warning text-white"><i class="fas fa-edit"></i></a></td>         
                    </tr>`;
          });
        }
      } else {
        alert("No tiene motos registrada de momento");
      }
    },
  });
}

function inventario(action) {
  $.ajax({
    type: "post",
    url: "controller.php",
    data: { action },
    dataType: "json",
    success: function (response) {
      let tabla = document.getElementById("cuerpo");
      tabla.innerHTML = "";
      if (response != false) {
        document.getElementById("encabezado").innerHTML = `<th>Venta</th>
                <th>Compra</th>
                <th>Nombre</th>
                <th>Medida</th>
                <th>Total</th>
                <th>Marca</th>
                <th>Saldo</th>
                <th>Cantidad</th>`;
        if (response != false) {
          response.forEach((list) => {
            tabla.innerHTML += `<tr>
                        <td>${list.venta}</td>
                        <td>${list.compra}</td>
                        <td>${list.nombre}</td>
                        <td>${list.medida}</td>
                        <td>${list.total}</td>
                        <td>${list.marca}</td>
                        <td>${list.saldo}</td>
                        <td>${list.cantidad}</td>
                        <td><a href="sale.php?action=delete&id=<?=${list.id}" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                        <td><a href="sale.php?action=update_sale&id=<?=${list.id}" class="btn btn-warning text-white"><i class="fas fa-edit"></i></a></td>
                        <td><a href="pdf.php?data=Venta&id=${list.id}" target="blank" class="btn btn-secondary text-white"><i class="fa fa-download" aria-hidden="true"></i></a></td>
                    </tr>`;
          });
        }
      } else {
        alert("No tiene motos registrada de momento");
      }
    },
  });
}

function ventas_consulta(dia, action) {
  $.ajax({
    type: "post",
    url: "controller.php",
    data: { action, dia },
    dataType: "json",
    success: function (response) {
      document.getElementById("encabezado").innerHTML = `<th>Fecha</th>
            <th>Cliente</th>
            <th>Total</th>
            <th>Eliminar</th>
            <th>Editar</th>
            <th>Exportar</th>`;
      let tabla = document.getElementById("cuerpo");
      tabla.innerHTML = "";
      if (response != false) {
        response.forEach((list) => {
          tabla.innerHTML += `  <tr>
                    <td>${list.fecha}</td>
                    <td>${list.cliente}</td>
                    <td>${list["saldo"]}</td>
                    <td><a href="sale.php?action=delete&id=${list.id}" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                    <td><a href="sale.php?action=update_sale&id=${list.id}" class="btn btn-warning text-white"><i class="fas fa-edit"></i></a></td>
                    <td><a href="pdf.php?data=venta&id=${list.id}" target="blank" class="btn btn-secondary text-white"><i class="fa fa-download" aria-hidden="true"></i></a></td>
                </tr>`;
        });
      } else {
        alert("No se generaron ventas la fecha solicitada");
      }
    },
  });
}
function ventas_consulta_periodo(inicio, final, action) {
  $.ajax({
    type: "post",
    url: "controller.php",
    data: { inicio, final, action },
    dataType: "json",
    success: function (response) {
      document.getElementById("encabezado").innerHTML = `<th>Fecha</th>
            <th>Cliente</th>
            <th>Total</th>
            <th>Eliminar</th>
            <th>Editar</th>
            <th>Exportar</th>`;
      let tabla = document.getElementById("cuerpo");
      tabla.innerHTML = "";
      if (response != false) {
        response.forEach((list) => {
          tabla.innerHTML += `  <tr>
                    <td>${list.fecha}</td>
                    <td>${list.cliente}</td>
                    <td>${list["saldo"]}</td>
                    <td><a href="sale.php?action=delete&id=${list.id}" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                    <td><a href="sale.php?action=update_sale&id=${list.id}" class="btn btn-warning text-white"><i class="fas fa-edit"></i></a></td>
                    <td><a href="pdf.php?data=venta&id=${list.id}" target="blank" class="btn btn-secondary text-white"><i class="fa fa-download" aria-hidden="true"></i></a></td>
                </tr>`;
        });
      } else {
        alert("No hay registro de ventas");
      }
    },
  });
}

function compras_consulta(dia, action) {
  $.ajax({
    type: "post",
    url: "controller.php",
    data: { action, dia },
    dataType: "json",
    success: function (response) {
      document.getElementById("encabezado").innerHTML = `<th>Fecha</th>
            <th>#Factura</th>
            <th>Proveedor</th>
            <th>Total</th>
            <th>Eliminar</th>
            <th>Editar</th>
            <th>Exportar</th>`;
      let tabla = document.getElementById("cuerpo");
      tabla.innerHTML = "";
      if (response != false) {
        response.forEach((list) => {
          tabla.innerHTML += `  <tr>
                    <td>${list.fecha}</td>
                    <td>${list.factura}</td>
                    <td>${list.proveedor}</td>
                    <td>${list.saldo}</td>
                    <td><a href="purchases.php?action=delete&id=${list.id}" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                    <td><a href="purchase.php?action=update_purchase&id=${list.id}" class="btn btn-warning text-white"><i class="fas fa-edit"></i></a></td>
                    <td><a href="pdf.php?data=compra&id=${list.id}" target="blank" class="btn btn-secondary text-white"><i class="fa fa-download" aria-hidden="true"></i></a></td>
                </tr>`;
        });
      } else {
        alert("No hay compras registradas");
      }
    },
  });
}
function compras_consulta_periodo(inicio, final, action) {
  $.ajax({
    type: "post",
    url: "controller.php",
    data: { action, inicio, final },
    dataType: "json",
    success: function (response) {
      document.getElementById("encabezado").innerHTML = `<th>Fecha</th>
            <th>#Factura</th>
            <th>Proveedor</th>
            <th>Total</th>
            <th>Eliminar</th>
            <th>Editar</th>
            <th>Exportar</th>`;
      let tabla = document.getElementById("cuerpo");
      tabla.innerHTML = "";
      if (response != false) {
        response.forEach((list) => {
          tabla.innerHTML += `  <tr>
                    <td>${list.fecha}</td>
                    <td>${list.factura}</td>
                    <td>${list.proveedor}</td>
                    <td>${list.saldo}</td>
                    <td><a href="purchases.php?action=delete&id=${list.id}" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                    <td><a href="purchase.php?action=update_purchase&id=${list.id}" class="btn btn-warning text-white"><i class="fas fa-edit"></i></a></td>
                    <td><a href="pdf.php?data=compra&id=${list.id}" target="blank" class="btn btn-secondary text-white"><i class="fa fa-download" aria-hidden="true"></i></a></td>
                </tr>`;
        });
      }
    },
  });
}


function reparaciones_consulta(dia, action) {
  $.ajax({
    type: "post",
    url: "controller.php",
    data: { action, dia },
    dataType: "json",
    success: function (response) {
      document.getElementById('encabezado').innerHTML = `  <th>Fecha Entrada</th>
            <th>Cliente</th>
            <th>Moto</th>
            <th>Placa</th>
            <th>Precio</th>
            <th>Estado</th>
            <th>Editar</th>
            <th>Eliminar</th>
            <th>Exportar</th>`

      let tabla = document.getElementById('cuerpo');
      tabla.innerHTML = '';
      if (response != false) {
        response.forEach(repair => {
          tabla.innerHTML += `  <td>${repair.fecha}</td>
                    <td>${repair.cliente}</td>
                    <td>${repair.moto}</td>
                    <td>${repair.placa}</td>
                    <td>${repair.monto}</td>
                      <td class="text-center">${repair.estado}</td>
                    <td><a href="workshop.php?action=update&id=${repair.id}" class="btn btn-warning text-white"><i class="fas fa-edit"></i></a></td>
                    <td><a href="repairs.php?action=delete&id=${repair.id}" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                    <td><a href="pdf.php?data=info_reparacion&id=${repair.id}" target="blank" class="btn btn-secondary text-white"><i class="fa fa-download" aria-hidden="true"></i></a></td>

                    </tr>`
        });

      } else {
        alert('No hay reparaciones registradas')
      }
    }
  });
}


function reparaciones_consulta_periodo(inicio, final, action) {
  $.ajax({
    type: "post",
    url: "controller.php",
    data: { action, inicio, final },
    dataType: "json",
    success: function (response) {
      document.getElementById('encabezado').innerHTML = `  <th>Fecha Entrada</th>
            <th>Cliente</th>
            <th>Moto</th>
            <th>Placa</th>
            <th>Precio</th>
            <th>Estado</th>
            <th>Editar</th>
            <th>Eliminar</th>`
      let tabla = document.getElementById('cuerpo');
      tabla.innerHTML = '';
      if (response != false) {
        response.forEach(repair => {
          tabla.innerHTML += `  <td>${repair.fecha}</td>
                    <td>${repair.cliente}</td>
                    <td>${repair.moto}</td>
                    <td>${repair.placa}</td>
                    <td>${repair.monto}</td>
                      <td class="text-center">${repair.estado}</td>
                    <td><a href="workshop.php?action=update&id=${repair.id}" class="btn btn-warning">+</a></td>
                    <td><a href="repairs.php?action=delete&id=${repair.id}" class="btn btn-danger">X</a></td>
                </tr>`
        });

      } else {
        alert('No hay reparaciones registradas')
      }
    }
  });
}
