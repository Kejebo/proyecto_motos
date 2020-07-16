
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
            consultar.disabled = true;
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
            document.querySelector('#report').setAttribute('action', '#');
            consultar.disabled = true;
            pdf.setAttribute('href', 'pdf.php?data=Compras');
            break;
        case 'Compras Diaria':
            document.querySelector('#report').setAttribute('action', '#');
            fecha.style.display = "block";
            break;

        case 'Compras Mensuales':
            document.querySelector('#report').setAttribute('action', '#');
            fecha.style.display = "block";
            dia.setAttribute("type", "month");
            break;
        case 'Compras Anuales':
            document.querySelector('#report').setAttribute('action', '#');
            fecha.style.display = "block";
            dia.setAttribute("type", "number");
            dia.setAttribute("min", "2020");
            dia.setAttribute("max", "3000");
            dia.value = '2020';
            break;
        case 'Compras Periodica':
            document.querySelector('#report').setAttribute('action', '#');
            inicio.style.display = "block";
            final.style.display = "block";
            break;

        case 'Reparaciones Diaria':
            document.querySelector('#report').setAttribute('action', '#');
            fecha.style.display = "block";
            break;

        case 'Reparaciones Mensuales':
            document.querySelector('#report').setAttribute('action', '#');
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
            let sel = document.getElementById('clientes');
            var opciones = sel.options[sel.selectedIndex].value;

            window.open('pdf.php?data=Motos_cliente&id=' + opciones, '_blank');
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

function update_action(action) {
    document.querySelector('#report').setAttribute('action', 'reports.php?action=' + action);
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

function Inventario(action) {
    $.ajax({
        type: "post",
        url: "controller.php",
        data: {action },
        dataType: "json",
        success: function (response) {
            if (response != false) {
                window.open('pdf.php?data=' + action, '_blank');
            }
        }
    });
}

