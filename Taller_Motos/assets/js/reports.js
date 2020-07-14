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

function get_Fecha(dia) {
    let sel = document.getElementById('tipo');
    var opciones = sel.options[sel.selectedIndex].textContent;

    switch (opciones) {
        case 'Ventas Diaria':
            document.querySelector('#pdf').setAttribute('href', 'pdf.php?data=Venta_diaria&dia=' + dia.value);
            break;
        case 'Ventas Mensuales':
            document.querySelector('#pdf').setAttribute('href', 'pdf.php?data=Venta_Mensual&dia=' + dia.value + "-01");
            break;
        case 'Ventas Anuales':
            document.querySelector('#pdf').setAttribute('href', 'pdf.php?data=Venta_Anual&year=' + dia.value);
            break;
        case 'Compras Diaria':
            document.querySelector('#pdf').setAttribute('href', 'pdf.php?data=Compra_diaria&dia=' + dia.value);
            break;

        case 'Compras Mensuales':
            document.querySelector('#pdf').setAttribute('href', 'pdf.php?data=Compra_Mensual&dia=' + dia.value + "-01");
            break;

        case 'Compras Anuales':
            document.querySelector('#pdf').setAttribute('href', 'pdf.php?data=Compra_Anual&year=' + dia.value);
            break;

    }
}

function update_action(action) {
    document.querySelector('#report').setAttribute('action', 'reports.php?action=' + action);
    document.querySelector('#pdf').setAttribute('href', 'pdf.php?data=' + action);
}