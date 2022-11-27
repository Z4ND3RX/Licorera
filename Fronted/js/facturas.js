$(document).ready(function() {
    $('#tablaFacturas').DataTable({
        destroy: true,
        searching: true,
        responsive: true,
        dom: 'Bfrtilp',
        buttons: [{
            extend: 'print',
            footer: true,
            type: 'button',
            text: 'imprimir',
            titleAttr: 'Imprimir',
            className: 'btn btn-success',
            messageTop: "Calle 12B #28A-01 "

        }],
        "ajax": {
            "url": "../backend/obtenerFacturas.php",
            "dataSrc": ""
        },
        columns: [
            { "data": "idVenta" },
            { "data": "descripcion" },
            { "data": "fechaVenta" },
            { "data": "totalVenta" },
        ],
        footerCallback: function(row, data, start, end, display) {
            var api = this.api(),
                data;

            // Remove the formatting to get integer data for summation
            var intVal = function(i) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '') * 1 :
                    typeof i === 'number' ?
                    i : 0;
            };
            // Total over all pages
            total = api
                .column(3)
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Total over this page
            pageTotal = api
                .column(3, { page: 'current' })
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer
            $(api.column(3).footer()).html(
                'Total: $' + pageTotal
            )
        },
    });
});

function buscarFactura() {
    var datos = new FormData(document.forms.namedItem("form-facturas"));
    var ajax = new XMLHttpRequest();
    ajax.open("POST", "../backend/buscarFactura.php", true)
    ajax.onload = function(event) {
        var obj = JSON.parse(ajax.response);
        console.log(obj);
        if (obj.ok) {
            Swal.fire({
                title: "Total facturas: $" + obj[0].totalVentas,
                icon: 'success',
                padding: '0.5cm',
                position: 'center',
                confirmButtonText: 'Aceptar',
            })
            $('#modalProductos').modal('hide');
        } else {
            Swal.fire({
                title: "No se ha podido actualizar el producto",
                icon: 'error',
                padding: '0.5cm',
                position: 'center',
                confirmButtonText: 'Aceptar',
            })
        }
    }
    ajax.send(datos);
}