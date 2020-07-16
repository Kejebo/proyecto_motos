
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
    let sel = document.getElementById('tipo');
    var opciones = sel.options[sel.selectedIndex].textContent;
    let dia = document.getElementById('dia');
    switch (opciones) {
        case 'Inventario':
            Inventario('inventario');
            break;

        case 'Clientes':
            window.open('pdf.php?data=Clients', '_blank');
            break;

        case 'Motos de Cliente':
            motos('motos_cliente');
            break;

        case 'Proveedores':
            window.open('pdf.php?data=Venta_Proveedor', '_blank');
            break;
        case 'Ventas General':
            window.open('pdf.php?data=Venta_General', '_blank');
            break;
        case 'Ventas Diaria':
            Ventas_pdf(dia.value, 'venta_diaria');
            break;
        case 'Ventas Mensuales':
            Ventas_pdf(dia.value + '-01', 'venta_mensual');
            break;
        case 'Ventas Anuales':
            Ventas_pdf(dia.value, 'venta_anual');
            break;
        case 'Compras Diaria':
            Compras_pdf(dia.value, 'compra_diaria');
            break;

        case 'Compras Mensuales':
            Compras_pdf(dia.value, 'compra_mensual');
            break;

        case 'Compras Anuales':
            Compras_pdf(dia.value, 'compra_anual');
            break;

    }
}

function get_consulta() {
    let sel = document.getElementById('tipo');
    var opciones = sel.options[sel.selectedIndex].textContent;
    let dia = document.getElementById('dia');
    switch (opciones) {
        case 'Inventario':

        case 'Motos de Cliente':
            motos_consulta('motos_cliente');
            break;

        case 'Ventas Diaria':
            ventas_consulta(dia.value, 'venta_diaria');
            break;
        case 'Ventas Mensuales':
            ventas_consulta(dia.value + '-01', 'venta_mensual');
            break;
        case 'Ventas Anuales':
            ventas_consulta(dia.value, 'venta_anual');
            break;
        case 'Compras Diaria':
            compras_consulta(dia.value, 'compra_diaria');
            break;

        case 'Compras Mensuales':
            compras_consulta(dia.value+'-01', 'compra_mensual');
            break;

        case 'Compras Anuales':
            compras_consulta(dia.value, 'compra_anual');
            break;

    }
}

function update_action(action) {
    document.querySelector('#pdf').setAttribute('href', 'pdf.php?data=' + action);
}

function Ventas_pdf(dia, action) {
    console.log(action);
    $.ajax({
        type: "post",
        url: "controller.php",
        data: { dia, action },
        dataType: "json",
        success: function (response) {
            if (response != false) {
                window.open('pdf.php?data=' + action + '&dia=' + dia, '_blank');
            } else {
                alert('No hay registros de ventas');
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
                window.open('pdf.php?data=' + action + '&dia=' + dia, '_blank');
            } else {
                alert('No hay registros de Compras');
            }
        }
    });
}

function motos(action) {
    let sel = document.getElementById('clientes');
    let id = sel.options[sel.selectedIndex].value;

    $.ajax({
        type: "post",
        url: "controller.php",
        data: { action, id },
        dataType: "json",
        success: function (response) {
            if (response != false) {
                window.open('pdf.php?data=Motos_cliente&id=' + id, '_blank');
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

            }
        }
    });
}


