function Loguearse() {
    var datos = new FormData(document.forms.namedItem("form-login"));
    var ajax = new XMLHttpRequest();
    ajax.open("POST", "../backend/loguearse.php", true)
    ajax.onload = function(event) {
        var obj = JSON.parse(ajax.response);
        console.log(obj);
        if (obj.ok) {
            document.getElementById("errorLogin").style.display = "none";
            location.href = "inventario.php";
        } else {
            document.getElementById("errorLogin").style.display = "block";
        }
    }
    ajax.send(datos);
}

function registrarProducto() {
    var datos = new FormData(document.forms.namedItem("form-registroProducto"));
    var ajax = new XMLHttpRequest();
    ajax.open("POST", "../backend/registrarProducto.php", true)
    ajax.onload = function(event) {
        var obj = JSON.parse(ajax.response);
        console.log(obj);
        if (obj.ok) {
            mostrarConfirmation("Producto Registrado");
            document.forms.namedItem("form-registroProducto").reset();
        }
    }
    ajax.send(datos);
}

function validarCamposProducto() {
    validarCodigo();
    validarPrecioVenta();
    validarPrecioCompra();
    validarCantidad();
    if (validarCodigo() && validarPrecioVenta() && validarPrecioCompra() && validarCantidad()) {
        registrarProducto();
    }
}

function validarCamposProductoM() {
    validarPrecioVentaM();
    validarPrecioCompraM();
    validarCantidadM();
    if (validarPrecioVentaM() && validarPrecioCompraM() && validarCantidadM()) {
        actualizarProductoInventario();
    }
}

function validarCodigo() {
    codigo = document.getElementById("codigo").value;
    const regExp = /^\d+$/;

    if (codigo.match(regExp) != null) {
        document.getElementById("errorCodigo").style.display = "none";
        return true;
    } else {
        document.getElementById("errorCodigo").style.display = "block";
        return false;
    }
}

function validarPrecioVenta() {
    precioVenta = document.getElementById("precioVenta").value;
    const regExp = /^\d+$/;

    if (precioVenta.match(regExp) != null) {
        document.getElementById("errorPrecioVenta").style.display = "none";
        return true;
    } else {
        document.getElementById("errorPrecioVenta").style.display = "block";
        return false;
    }
}

function validarPrecioVentaM() {
    precioVenta = document.getElementById("precioVentaM").value;
    const regExp = /^\d+$/;

    if (precioVenta.match(regExp) != null) {
        document.getElementById("errorPrecioVentaM").style.display = "none";
        return true;
    } else {
        document.getElementById("errorPrecioVentaM").style.display = "block";
        return false;
    }
}

function validarCantidad() {
    precioVenta = document.getElementById("cantidad").value;
    const regExp = /^\d+$/;

    if (precioVenta.match(regExp) != null) {
        document.getElementById("errorCantidad").style.display = "none";
        return true;
    } else {
        document.getElementById("errorCantidad").style.display = "block";
        return false;
    }
}

function validarCantidadM() {
    precioVenta = document.getElementById("cantidadM").value;
    const regExp = /^\d+$/;

    if (precioVenta.match(regExp) != null) {
        document.getElementById("errorCantidadM").style.display = "none";
        return true;
    } else {
        document.getElementById("errorCantidadM").style.display = "block";
        return false;
    }
}

function validarPrecioCompra() {
    precioCompra = document.getElementById("precioCompra").value;
    const regExp = /^\d+$/;

    if (precioCompra.match(regExp) != null) {
        document.getElementById("errorPrecioCompra").style.display = "none";
        return true;
    } else {
        document.getElementById("errorPrecioCompra").style.display = "block";
        return false;
    }
}

function validarPrecioCompraM() {
    precioCompra = document.getElementById("precioCompraM").value;
    const regExp = /^\d+$/;

    if (precioCompra.match(regExp) != null) {
        document.getElementById("errorPrecioCompraM").style.display = "none";
        return true;
    } else {
        document.getElementById("errorPrecioCompraM").style.display = "block";
        return false;
    }
}

function eliminarProductoInventario(codProducto) {
    var datos = new FormData();
    datos.append("codProducto", codProducto);
    var ajax = new XMLHttpRequest();
    ajax.open("POST", "../backend/eliminarProductoInventario.php", true)
    ajax.onload = function(event) {
        var obj = JSON.parse(ajax.response);
        console.log(obj);
        if (obj.ok) {
            Swal.fire({
                title: "Producto eliminado del inventario",
                icon: 'success',
                padding: '0.5cm',
                position: 'center',
                confirmButtonText: 'Aceptar',
            })
            $('#modalProductos').modal('hide');
        } else if (!obj.ok && obj.msg == 'No Admin') {
            Swal.fire({
                title: "No tienes permisos de Administrador para realizar esta acción",
                icon: 'error',
                padding: '0.5cm',
                position: 'center',
                confirmButtonText: 'Aceptar',
            })
        }
    }
    ajax.send(datos);
}

function actualizarProductoInventario() {
    var datos = new FormData(document.forms.namedItem("form-registroProductoM"));
    var ajax = new XMLHttpRequest();
    ajax.open("POST", "../backend/actualizarProductoInventario.php", true)
    ajax.onload = function(event) {
        var obj = JSON.parse(ajax.response);
        console.log(obj);
        if (obj.ok) {
            Swal.fire({
                title: "Producto actualizado correctamente",
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

function eliminarProductocarrito(codProducto) {
    var datos = new FormData();
    datos.append("codProducto", codProducto);
    var ajax = new XMLHttpRequest();
    ajax.open("POST", "../backend/eliminarProductoCarrito.php", true)
    ajax.onload = function(event) {
        var obj = JSON.parse(ajax.response);
        console.log(obj);
        if (obj.ok) {
            Swal.fire({
                title: "Producto eliminado del carrito",
                icon: 'success',
                padding: '0.5cm',
                position: 'center',
                confirmButtonText: 'Aceptar',
            });
            reiniciarTablaCarrito();
        } else {
            Swal.fire({
                title: "Producto no eliminado del carrito",
                icon: 'error',
                padding: '0.5cm',
                position: 'center',
                confirmButtonText: 'Aceptar',
            });
        }
    }
    ajax.send(datos);
}

function eliminarTodocarrito() {
    if (validarProductosEnCarrito()) {
        var datos = new FormData();
        var ajax = new XMLHttpRequest();
        ajax.open("POST", "../backend/eliminarTodoCarrito.php", true)
        ajax.onload = function(event) {
            var obj = JSON.parse(ajax.response);
            console.log(obj);
        }
        ajax.send(datos);
    }
    reiniciarTablaCarrito();
}

function obtenerProductosCarrito() {
    var ajax = new XMLHttpRequest();
    ajax.open("POST", "../backend/obtenerProductosCarrito.php", true)
    ajax.onload = function(event) {
        var obj = JSON.parse(ajax.response);
        console.log(obj);
        return obj;
    }
}

function agregarProductoCarrito(codProducto, cantidad) {
    var datos = new FormData();
    datos.append("codProducto", codProducto);
    datos.append("cantidad", cantidad);
    console.log(datos)
    var ajax = new XMLHttpRequest();
    ajax.open("POST", "../backend/agregarProductoCarrito.php", true)
    ajax.onload = function(event) {
        var obj = JSON.parse(ajax.response);
        console.log(obj);
        if (obj.ok) {
            Swal.fire({
                title: "Producto añadido al carrito",
                icon: 'success',
                padding: '0.5cm',
                position: 'center',
                confirmButtonText: 'Aceptar',
            })
        } else {
            Swal.fire({
                title: "Producto ya se encuentra en el carrito",
                icon: 'error',
                padding: '0.5cm',
                position: 'center',
                confirmButtonText: 'Aceptar',
            })
        }
    }
    ajax.send(datos);
}

function ejecutarModal() {
    var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
    reiniciarTablaCarrito();
    myModal.show();
    /* alert('Clicked on: ' + info.dateStr);
    alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
    alert('Current view: ' + info.view.type); */
    // change the day's background color just for fun
}

function ejecutarModalProductos() {
    var myModal = new bootstrap.Modal(document.getElementById('modalProductos'));
    myModal.show();
    /* alert('Clicked on: ' + info.dateStr);
    alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
    alert('Current view: ' + info.view.type); */
    // change the day's background color just for fun
}

function buscarProducto() {
    codigo = document.getElementById("codigo").value
    var datos = new FormData();
    datos.append("codigo", codigo);
    var ajax = new XMLHttpRequest();
    ajax.open("POST", "../backend/buscarProducto.php", true)
    ajax.onload = function(event) {
        var obj = JSON.parse(ajax.response);
        if (obj.ok) {
            console.log(obj);
            $('#codigoM').val(obj[0].codProducto);
            $('#nombreM').val(obj[0].nombreProducto);
            $('#distribuidorM').val(obj[0].distribuidor);
            $('#precioVentaM').val(obj[0].precioVenta);
            $('#precioCompraM').val(obj[0].precioCompra);
            $('#cantidadM').val(obj[0].cantidadStock);
            ejecutarModalProductos();
        } else {
            Swal.fire({
                title: "No se ha encontrado ningún producto con el código ingresado",
                icon: 'error',
                padding: '0.5cm',
                position: 'center',
                confirmButtonText: 'Aceptar',
            })
        }
    }
    ajax.send(datos);
}

function Facturar() {
    caja = document.getElementById("caja").value;
    const regExp = /^\d+$/;
    if (caja.match(regExp) != null) {
        resultado = $('#cambio').val();
        if (resultado >= 0) {
            rows = obtenerDatosCarrito();
            console.log(rows.length);
            console.log(rows);
            let date = new Date();
            console.log(date.toISOString().split('T')[0]);
            mensaje = "";
            total = 0;
            var codigos = new Array();
            for (var i = 0; i < rows.length; i++) {
                mensaje = mensaje + rows[i].cantidad + " " + rows[i].nombreProducto + " $" + rows[i].precioVenta + " - ";
                total = total + parseInt(rows[i].total);
                codigos.push([rows[i].codProductoC, rows[i].cantidad]);
            }
            var arrayJson = JSON.stringify(codigos);
            console.log(arrayJson);
            console.log(mensaje);
            console.log(total);
            var datos = new FormData();
            datos.append("descripcion", mensaje);
            datos.append("fecha", date.toISOString().split('T')[0]);
            datos.append("total", total);
            datos.append("codigos", arrayJson);
            var ajax = new XMLHttpRequest();
            ajax.open("POST", "../backend/registrarFactura.php", true)
            ajax.onload = function(event) {
                var obj = JSON.parse(ajax.response);
                console.log(obj);
                if (obj.ok) {
                    Swal.fire({
                        title: "Factura registrada correctamente",
                        icon: 'success',
                        padding: '0.5cm',
                        position: 'center',
                        confirmButtonText: 'Aceptar',
                    })
                    eliminarTodocarrito();
                    window.location.href = "inventario.php";
                } else {
                    Swal.fire({
                        title: "Factura No Registrada",
                        icon: 'error',
                        padding: '0.5cm',
                        position: 'center',
                        confirmButtonText: 'Aceptar',
                    })
                }
            }
            ajax.send(datos);
        } else {
            faltanDatos("El dinero ingresado no cumple con el total de la factura");
        }

    } else {
        faltanDatos("Debes rellenar el campo de dinero recibido en caja");
    }

}

function calcular() {
    caja = $('#caja').val();
    total = $('#total').val();
    resultado = caja - total;
    console.log(resultado);
    $('#cambio').val(resultado);
}

function imprimir() {
    caja = document.getElementById("caja").value;
    const regExp = /^\d+$/;
    if (caja.match(regExp) != null) {
        resultado = $('#cambio').val();
        if (resultado >= 0) {
            document.getElementById("imprir").style.visibility = "hidden";
            document.getElementById("facturar").style.visibility = "hidden";
            print();
            document.getElementById("imprir").style.visibility = "visible";
            document.getElementById("facturar").style.visibility = "visible";
        } else {
            faltanDatos("El dinero ingresado no cumple con el total de la factura");
        }

    } else {
        faltanDatos("Debes rellenar el campo de dinero recibido en caja");
    }
}