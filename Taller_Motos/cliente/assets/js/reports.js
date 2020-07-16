
window.addEventListener('load', () => {
    document.getElementById('pdf').addEventListener('click', () => {
        get_pdf();
    });
});

function selec_report(sel) {
    var opciones = sel.options[sel.selectedIndex].textContent;
    let cliente = document.querySelector("#cliente");
    let fecha = document.querySelector("#fecha");
    let inicio = document.querySelector("#inicio");
    let final = document.querySelector("#final");
    let dia = document.querySelector('#dia');
    dia.setAttribute("type", "date");
    cliente.style.display = 'none';
    fecha.style.display = 'none';
    inicio.style.display = 'none';
    final.style.display = 'none';
    let consultar = document.querySelector('#consultar');
    consultar.disabled = false;
    let pdf = document.querySelector('#pdf');
    switch (opciones) {
        case 'Inventario':
            consultar.disabled = true;

            update_action('Inventory');
            break;

        case 'Clientes':
            update_action('Clients');
            consultar.disabled = true;
            update_action('Clients');
            break;

        case 'Motos de Cliente':
            update_action('Motos_cliente');
            cliente.style.display = "block";
            break;

        case 'Proveedores':
            update_action('Venta_Proveedor');
            consultar.disabled = true;
            break;
        case 'Ventas General':
            consultar.disabled = true;
            update_action('Venta_General');
            break;
        case 'Ventas Diaria':
            fecha.style.display = "block";
            update_action('Venta_Diaria');
            break;

        case 'Ventas Mensuales':
            fecha.style.display = "block";
            dia.setAttribute("type", "month");
            update_action('Venta_Mensuales');
            break;
        case 'Ventas Anuales':
            fecha.style.display = "block";
            dia.setAttribute("type", "number");
            dia.setAttribute("min", "2020");
            dia.setAttribute("max", "3000");
            dia.value = '2020';
            update_action('Venta_Anual');
            break;
        case 'Ventas Periodica':
            update_action('Venta_Periodica');
            inicio.style.display = "block";
            final.style.display = "block";

            break;
        case 'Compras General':
            consultar.disabled = true;
            pdf.setAttribute('href', 'pdf.php?data=Compras');
            break;
        case 'Compras Diaria':
            fecha.style.display = "block";
            break;

        case 'Compras Mensuales':
            fecha.style.display = "block";
            dia.setAttribute("type", "month");
            break;
        case 'Compras Anuales':
            fecha.style.display = "block";
            dia.setAttribute("type", "number");
            dia.setAttribute("min", "2020");
            dia.setAttribute("max", "3000");
            dia.value = '2020';
            break;
        case 'Compras Periodica':
            inicio.style.display = "block";
            final.style.display = "block";
            break;

        case 'Reparaciones Diaria':
            fecha.style.display = "block";
            break;

        case 'Reparaciones Mensuales':
            fecha.style.display = "block";
            dia.setAttribute("type", "month");

            break;
        case 'Reparaciones Anuales':
            document.querySelector('#report').setAttribute('action', '#');
            fecha.style.display = "block";
            dia.setAttribute("type", "number");
            dia.setAttribute("min", "2020");
            dia.setAttribute("max", "3000");
            dia.value = '2020';
            break;
        case 'Reparaciones Periodica':
            document.querySelector('#report').setAttribute('action', '#');
            inicio.style.display = "block";
            final.style.display = "block";
            break;
        default:

            break;
    }

}
function get_client_motorcycle(cliente) {
    document.querySelector('#pdf').setAttribute('href', 'pdf.php?data=Motos_cliente&id=' + cliente.options[cliente.selectedIndex].value);

}

function get_pdf() {
    //let dia = document.getElementById('dia');
    switch ('Motos de Cliente') {
       
        case 'Motos de Cliente':
            motos('motos_cliente');
            break;
    }
}

function motos(action) {
    //let sel = document.getElementById('clientes');
    //let id = sel.options[sel.selectedIndex].value;
    let id = document.getElementById('id').getAttribute('id_usuario');
    $.ajax({
        type: "post",
        url: "controller.php",
        data: { action,  id },
        dataType: "json",
        success: function (response) {
            if (response != false) {
                window.open('pdf.php?data=Motos_cliente&id='+ id,'_blank');
            } else {
                alert('No tiene motos registradas');
            }
        }
    });
}
function motos_consulta(action) {
    let sel = document.getElementById('clientes');
    let id = sel.options[sel.selectedIndex].value;

    $.ajax({
        type: "post",
        url: "controller.php",
        data: { action, id },
        dataType: "json",
        success: function (response) {
            let tabla = document.getElementById('cuerpo');
            tabla.innerHTML = '';
            if (response != false) {
                document.getElementById('encabezado').innerHTML = `<th>#Placa</th>
                <th>Moto</th>
                <th>Kilometraje</th>
                <th>Eliminar</th>
                <th>Editar</th>
                <th>Exportar</th>`;

                if (response != false) {
                    response.forEach(list => {
                        tabla.innerHTML += `  <tr>
                        <td>${list.placa}</td>
                        <td>${list.moto}</td>
                        <td>${list.kilometraje}</td>
                        <td><a href="sale.php?action=delete&id=<?=${list.id}" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                        <td><a href="sale.php?action=update_sale&id=<?=${list.id}" class="btn btn-warning text-white"><i class="fas fa-edit"></i></a></td>
                        <td><a href="pdf.php?data=Venta&id=${list.id}" target="blank" class="btn btn-secondary text-white"><i class="fa fa-download" aria-hidden="true"></i></a></td>
                    </tr>`
                    });
                }
            } else {
                alert('No tiene motos registrada de momento');
            }
        }
    });
}

function ventas_consulta(dia, action) {
    $.ajax({
        type: "post",
        url: "controller.php",
        data: { action, dia },
        dataType: "json",
        success: function (response) {
            document.getElementById('encabezado').innerHTML = `<th>Fecha</th>
            <th>Cliente</th>
            <th>Total</th>
            <th>Eliminar</th>
            <th>Editar</th>
            <th>Exportar</th>`
            let tabla = document.getElementById('cuerpo');
            tabla.innerHTML = '';
            if (response != false) {
                response.forEach(list => {
                    tabla.innerHTML += `  <tr>
                    <td>${list.fecha}</td>
                    <td>${list.cliente}</td>
                    <td>${list['saldo']}</td>
                    <td><a href="sale.php?action=delete&id=<?=${list.id}" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                    <td><a href="sale.php?action=update_sale&id=<?=${list.id}" class="btn btn-warning text-white"><i class="fas fa-edit"></i></a></td>
                    <td><a href="pdf.php?data=Venta&id=${list.id}" target="blank" class="btn btn-secondary text-white"><i class="fa fa-download" aria-hidden="true"></i></a></td>
                </tr>`
                });

            } else {
                alert('No se generaron ventas la fecha solicitada')
            }
        }
    });
}
function ventas_consulta_periodo(inicio, final, action) {
    $.ajax({
        type: "post",
        url: "controller.php",
        data: { inicio, final, action },
        dataType: "json",
        success: function (response) {
            document.getElementById('encabezado').innerHTML = `<th>Fecha</th>
            <th>Cliente</th>
            <th>Total</th>
            <th>Eliminar</th>
            <th>Editar</th>
            <th>Exportar</th>`
            let tabla = document.getElementById('cuerpo');
            tabla.innerHTML = '';
            if (response != false) {
                response.forEach(list => {
                    tabla.innerHTML += `  <tr>
                    <td>${list.fecha}</td>
                    <td>${list.cliente}</td>
                    <td>${list['saldo']}</td>
                    <td><a href="sale.php?action=delete&id=<?=${list.id}" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                    <td><a href="sale.php?action=update_sale&id=<?=${list.id}" class="btn btn-warning text-white"><i class="fas fa-edit"></i></a></td>
                    <td><a href="pdf.php?data=Venta&id=${list.id}" target="blank" class="btn btn-secondary text-white"><i class="fa fa-download" aria-hidden="true"></i></a></td>
                </tr>`
                });

            } else {
                alert('No hay registro de ventas');
            }
        }
    });
}

function compras_consulta(dia, action) {
    $.ajax({
        type: "post",
        url: "controller.php",
        data: { action, dia },
        dataType: "json",
        success: function (response) {
            document.getElementById('encabezado').innerHTML = `<th>Fecha</th>
            <th>#Factura</th>
            <th>Proveedor</th>
            <th>Total</th>
            <th>Eliminar</th>
            <th>Editar</th>
            <th>Exportar</th>`
            let tabla = document.getElementById('cuerpo');
            tabla.innerHTML = '';
            if (response != false) {
                response.forEach(list => {
                    tabla.innerHTML += `  <tr>
                    <td>${list.fecha}</td>
                    <td>${list.factura}</td>
                    <td>${list.proveedor}</td>
                    <td>${list.saldo}</td>
                    <td><a href="purchases.php?action=delete&id=${list.id}" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                    <td><a href="purchase.php?action=update_purchase&id=${list.id}" class="btn btn-warning text-white"><i class="fas fa-edit"></i></a></td>
                    <td><a href="pdf.php?data=Compra&id=${list.id}" target="blank" class="btn btn-secondary text-white"><i class="fa fa-download" aria-hidden="true"></i></a></td>
                </tr>`
                });

            }else{
                alert('No hay compras registradas')
            }
        }
    });
}
function compras_consulta_periodo(inicio, final, action) {
    $.ajax({
        type: "post",
        url: "controller.php",
        data: { action, inicio, final },
        dataType: "json",
        success: function (response) {
            document.getElementById('encabezado').innerHTML = `<th>Fecha</th>
            <th>#Factura</th>
            <th>Proveedor</th>
            <th>Total</th>
            <th>Eliminar</th>
            <th>Editar</th>
            <th>Exportar</th>`
            let tabla = document.getElementById('cuerpo');
            tabla.innerHTML = '';
            if (response != false) {
                response.forEach(list => {
                    tabla.innerHTML += `  <tr>
                    <td>${list.fecha}</td>
                    <td>${list.factura}</td>
                    <td>${list.proveedor}</td>
                    <td>${list.saldo}</td>
                    <td><a href="purchases.php?action=delete&id=${list.id}" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                    <td><a href="purchase.php?action=update_purchase&id=${list.id}" class="btn btn-warning text-white"><i class="fas fa-edit"></i></a></td>
                    <td><a href="pdf.php?data=Compra&id=${list.id}" target="blank" class="btn btn-secondary text-white"><i class="fa fa-download" aria-hidden="true"></i></a></td>
                </tr>`
                });

            }
        }
    });
}


