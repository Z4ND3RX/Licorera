function mostrarConfirmation(mensaje) {
    Swal.fire({
        title: mensaje,
        icon: 'success',
        padding: '0.5cm',
        position: 'center',
        confirmButtonText: 'Aceptar',
    })
}

function faltanDatos(mensaje) {
    Swal.fire({
        title: mensaje,
        icon: 'info',
        padding: '0.5cm',
        position: 'center',
        confirmButtonText: 'Aceptar',
    })
}

function validarEliminacionProducto() {
    codigo = document.getElementById("codigo").value
    Swal.fire({
        title: '¿Está seguro de que quiere eliminar el producto de código: ' + codigo,
        showDenyButton: true,
        showCancelButton: true,
        icon: 'warning',
        confirmButtonText: 'SI',
        denyButtonText: 'NO',
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            eliminarProductoInventario(codigo);
        } else if (result.isDenied) {
            Swal.fire('Ok, no se ha eliminado', '', 'info')
        }
    })
}

function validarActualizacionProducto() {
    codigo = document.getElementById("codigo").value
    Swal.fire({
        title: '¿Está seguro de que quiere actualizar el producto de código: ' + codigo,
        showDenyButton: true,
        showCancelButton: true,
        icon: 'warning',
        confirmButtonText: 'SI',
        denyButtonText: 'NO',
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            validarCamposProductoM();
        } else if (result.isDenied) {
            Swal.fire('Ok, no se ha actualizado', '', 'info')
        }
    })
}


function validarCarrito(data) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })
    const { value: cantidad } = swalWithBootstrapButtons.fire({
        title: 'Ingresa la cantidad de ' + data.nombreProducto + ' a facturar ',
        input: 'text',
        inputLabel: 'cantidad',
        inputPlaceholder: 'Ingrese la Cantidad',
        inputAttributes: {
            maxlength: 100,
            minlenght: 1,
        },
        showCancelButton: true,
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar',
        reverseButtons: true,
        inputValidator: (value) => {
            if (!value) {
                return 'Tienes que escribir la cantidad!'
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            console.log(result)
            agregarProductoCarrito(data.codProducto, parseInt(result.value))
        } else if (
            /*Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
                'Cancelado',
                'No se ha agregado el producto a la factura.',
                'error'
            )

        }
    })
}

function validarEliminacionCarrito(data) {
    Swal.fire({
        title: '¿Quieres eliminar el producto: ' + data.nombreProducto + ' de la facuración?',
        icon: 'warning',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'SI',
        denyButtonText: 'NO',
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            eliminarProductocarrito(data.codProductoC);
            reiniciarTablaCarrito();
        } else if (result.isDenied) {
            Swal.fire('Ok, no se ha eliminado', '', 'info')
        }
    })
}

function validarEliminacionTodoCarrito() {
    Swal.fire({
        title: '¿Quieres eliminar todo lo del carrito?',
        icon: 'warning',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'SI',
        denyButtonText: 'NO',
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            eliminarTodocarrito()
            reiniciarTablaCarrito();
        } else if (result.isDenied) {
            Swal.fire('Ok, no se ha eliminado nada', '', 'info')
        }
    })
}

function validarFacturacion() {
    rows = obtenerDatosCarrito();
    if (rows.length > 0) {
        Swal.fire({
            title: '¿Seguro de que quieres facturar?',
            icon: 'warning',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'SI',
            denyButtonText: 'NO',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                window.location.href = "plantillaFactura.php";
                /*Facturar(); */
            } else if (result.isDenied) {
                Swal.fire('Ok, no se ha facturado nada', '', 'info')
            }
        })
    } else {
        faltanDatos("No hay productos en el carrito");
    }
}