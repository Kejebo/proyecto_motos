$(document).ready(function () {
  var printCounter = 0;
  $("#Motos").append(
    '<caption style="caption-side: bottom">Mygthy Motors / Telefono:83595176 / Correo:mannolo@gmail.com.</caption>'
  );
  $("#Motos").DataTable({
    dom: "Bfrtip",
    buttons: [
      {
        extend: "copyHtml5",
        exportOptions: {
          columns: [0, 1, 2, 3],
        },
      },
      {
        extend: "excelHtml5",
        messageTop: "Reporte de Inventario.",
        exportOptions: {
          columns: [0, 1, 2, 3],
        },
      },

      {
        extend: "print",
        exportOptions: {
          columns: [0, 1, 2, 3, 4],
        },
        messageTop: function () {
          printCounter++;

          if (printCounter === 1) {
            return "Esta es la primera ves usted imprime este documento.";
          } else {
            return "Este documento se ha impirmido " + printCounter + " veces";
          }
        },
        messageBottom: null,
      },
    ],
    language: {
      decimal: "",
      emptyTable: "No hay información",
      info: "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
      infoEmpty: "Mostrando 0 to 0 of 0 Entradas",
      infoFiltered: "(Filtrado de _MAX_ total entradas)",
      infoPostFix: "",
      thousands: ",",
      lengthMenu: "Mostrar _MENU_ Entradas",
      loadingRecords: "Cargando...",
      processing: "Procesando...",
      search: "Buscar:",
      zeroRecords: "Sin resultados encontrados",
      paginate: {
        first: "Primero",
        last: "Ultimo",
        next: "Siguiente",
        previous: "Anterior",
      },
    },
  });
  table.buttons().container().appendTo("#example_wrapper .col-md-6:eq(0)");
});
