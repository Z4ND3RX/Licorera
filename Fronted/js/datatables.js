$(document).ready(function() {
    $('#tablaProductos').DataTable({
        lengthChange: true,
        buttons: ['copy', 'excel', 'pdf', 'colvis'],
        "ajax": {
            "url": "../backend/cargarProducto.php",
            "dataSrc": ""
        },
        columns: [
            { "data": "codProducto" },
            { "data": "nombreProducto" },
            { "data": "distribuidor" },
            { "data": "precioVenta" },
            { "data": "precioCompra" },
            { "data": "cantidadStock" },
        ],
    });

    var table = $('#tablaProductos').DataTable();

    table.buttons().container()
        .appendTo('#example_wrapper .col-md-6:eq(0)');

    $('#tablaProductos tbody').on('click', 'tr', function() {
        datos = table.row(this).data()
        console.log(datos);
        validarCarrito(datos);
    });

    $('#tablaCarrito').DataTable({
        destroy: true,
        searching: true,
        responsive: false,
        "ajax": {
            "url": "../backend/obtenerProductosCarrito.php",
            "dataSrc": ""
        },
        columns: [
            { "data": "codProductoC" },
            { "data": "nombreProducto" },
            { "data": "cantidad" },
            { "data": "precioVenta" },
            { "data": "total" },
        ],
        footerCallback: function(row, data, start, end, display) {
            var api = this.api();

            // Remove the formatting to get integer data for summation
            var intVal = function(i) {
                return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
            };
            // Total over all pages
            total = api
                .column(4)
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer
            $(api.column(4).footer()).html(' Total: $' + total);
            $('#total').val(total);

        },
    });

    var tableDos = $('#tablaCarrito').DataTable();

    $('#tablaCarrito tbody').on('click', 'tr', function() {
        datosDos = tableDos.row(this).data()
        console.log(datosDos);
        validarEliminacionCarrito(datosDos);
    });
});

function reiniciarTablaCarrito() {
    $('#tablaCarrito').DataTable().ajax.reload()
}

function reiniciarTablaInventario() {
    $('#tablaProductos').DataTable().ajax.reload()
}

function validarProductosEnCarrito() {
    var table = $('#tablaCarrito').DataTable();
    return table.rows().any();
}

function obtenerDatosCarrito() {
    var table = $('#tablaCarrito').DataTable();
    return table.rows().data();
}