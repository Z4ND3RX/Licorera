<?php
require_once "../Backend/sesion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include_once "shared/head.php"?>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
</head>
<body class="h-100 text-center">
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
  <!-- INICIO MENÚ -->
  <header class="mb-auto">
  <div>
    <h5 class="float-md-start mb-0"><?php echo $_SESSION['user']; ?></h5>
    <div>
      <nav class="nav nav-masthead justify-content-center float-md-end">
      <a class="nav-link" href="login.php">Cerrar Sesión</a>
      <a class="nav-link active" aria-current="page" href="regisProducto.php">Registrar Producto</a>
        <a class="nav-link" href="inventario.php">Inventario y Ventas</a>
        <a class="nav-link" href="facturas.php">Facturas</a>
      </nav>
    </div>
  </header>
  <!-- FIN MENÚ -->

  <!-- Modal -->
<div class="modal fade text-black" id="modalProductos" tabindex="-1" aria-labelledby="modalProductosLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalProductosLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-black">
        <form action="#" method="POST" name="form-registroProductoM">
                    <!-- 2 column grid layout with text inputs for the first and last names -->
                    <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                        <label for="codigoM"> Codigo</label>
                        <input type="text" class="form-control" name="codigoM" id="codigoM" placeholder="Codigo" readonly="readonly">
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                        <label for="nombreM"> Nombre</label>
                        <input type="text" class="form-control" name="nombreM" id="nombreM" placeholder="Nombre" required>
                        </div>
                    </div>
                    </div>

                    <div class="form-outline mb-4">
                    <label for="distribuidorM"> Distribuidor</label>
                    <input type="text" class="form-control" name="distribuidorM" id="distribuidorM" placeholder="Distribuidor" required>
                    </div>

                    <!-- 2 column grid layout with text inputs for the prices -->
                    <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                        <label for="precioVentaM"> precio Venta</label>
                        <input type="text" class="form-control" name="precioVentaM" id="precioVentaM" placeholder="Precio de venta" required>
                        <p id="errorPrecioVentaM" class="errorCampos">Solo se aceptan números.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                        <label for="precioCompraM"> precio Compra</label>
                        <input type="text" class="form-control" name="precioCompraM" id="precioCompraM" placeholder="Precio de compra" required>
                        <p id="errorPrecioCompraM" class="errorCampos">Solo se aceptan números.</p>
                        </div>
                    </div>
                    <div class="mb-4">
                    <div class="form-outline">
                    <label for="cantidadM"> Cantidad en Stock</label>
                        <input type="text" class="form-control" name="cantidadM" id="cantidadM" placeholder="Cantidad" required>
                        <p id="errorCantidadM" class="errorCantidadM">Solo se aceptan números.</p>
                    </div>
                    </div>
                    </div>
                </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" id="guardarEvento" onclick="validarActualizacionProducto();">Guardar Cambios</button>
            <button type="button" class="btn btn-danger" id="eliminarEvento" onclick="validarEliminacionProducto();">Eliminar</button>
        </div>
        </div>

    </div>
    </div>
    <!-- Fin Modal -->

    <!-- INICIO REGISTER-->

    <!-- Section: Design Block -->
    <section class="">
    <!-- Jumbotron -->
    <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
        <div class="container">
        <div class="row gx-lg-5 align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
            <h1 class="my-5 display-3 fw-bold ls-tight">
                Gestiona tus<br />
                <span class="text-primary">Productos</span>
            </h1>
            <p style="color: hsl(217, 10%, 50.8%)">
                Ten en cuenta que usando la "pistola" puedes escanear el código de barras
                que por lo general se encuentra en la parte trasera de los productos y así,
                conseguir de manera fácil el número de referencia del mismo. (Si el producto
                no cuenta con esto, simplemente inventate un código)
            </p>
            </div>

            <div class="col-lg-6 mb-5 mb-lg-0">
            <div class="card">
                <div class="card-body py-5 px-md-5">
                <form action="#" method="POST" name="form-registroProducto">
                    <!-- 2 column grid layout with text inputs for the first and last names -->
                    <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                        <input type="text" class="form-control" name="codigo" id="codigo" placeholder="Codigo" required>
                        <p id="errorCodigo" class="errorCampos">Solo se aceptan números.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" required>
                        </div>
                    </div>
                    </div>

                    <div class="form-outline mb-4">
                    <input type="text" class="form-control" name="distribuidor" id="distribuidor" placeholder="Distribuidor" required>
                    </div>

                    <!-- 2 column grid layout with text inputs for the prices -->
                    <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                        <input type="text" class="form-control" name="precioVenta" id="precioVenta" placeholder="Precio de venta" required>
                        <p id="errorPrecioVenta" class="errorCampos">Solo se aceptan números.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                        <input type="text" class="form-control" name="precioCompra" id="precioCompra" placeholder="Precio de compra" required>
                        <p id="errorPrecioCompra" class="errorCampos">Solo se aceptan números.</p>
                        </div>
                    </div>
                    <div class="mb-4">
                    <div class="form-outline">
                        <input type="text" class="form-control" name="cantidad" id="cantidad" placeholder="Cantidad" required>
                        <p id="errorCantidad" class="errorCantidad">Solo se aceptan números.</p>
                    </div>
                    </div>
                    </div>

                    <!-- Submit button -->
                    <button class="btn btn-primary" type="button" onclick="validarCamposProducto();">
                    Registrar
                    </button>
                    <button class="btn btn-primary" type="button" onclick="buscarProducto();">
                    Buscar
                    </button>
                </form>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    <!-- Jumbotron -->
    </section>
    <!-- Section: Design Block -->

    <!-- FIN REGISTER -->
    <?php include_once "shared/script.php"?>
</body>
</html>