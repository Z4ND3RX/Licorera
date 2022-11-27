<?php 
require_once "../Backend/sesion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturación - Rapitienda y Licores la 28</title>
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
  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" >
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Carrito</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body d-flex justify-content-center align-items-center">
            <!-- INICIO TABLA -->
            <table id="tablaCarrito" class="table text-dark" style="width:150% text-dark">
                <thead id="fila">
                    <tr>
                        <th>Codigo</th>
                        <th>Producto</th>
                        <th>cantidad</th>
                        <th>Precio Unidad</th>
                        <th>Precio Cantidad x Unidad</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                  <tr>
                  <th colspan="4" style="text-align:right"></th>
                  <th></th>
                  </tr>
                </tfoot>
             </table>
            <!-- FIN TABLA-->
        </div>
        <p>En esta tabla se reflejan los productos que serán expedidos en la factura <br>
             Si desea eliminar alguno, de click sobre él</p>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" id="facturar" onclick="validarFacturacion();">Facturar</button>
            <button type="button" class="btn btn-danger" id="eliminarTodo" onclick= "validarEliminacionTodoCarrito();">Eliminar Todo</button>
          </div>
        </div>
  </div>
</div>
    <!-- Fin Modal -->
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
  <!-- INICIO MENÚ -->
  <header class="mb-auto">
  <div>
    <h5 class="float-md-start mb-0"><?php echo $_SESSION['user']; ?></h5>
    <div>
      <nav class="nav nav-masthead justify-content-center float-md-end">
      <a class="nav-link" href="login.php">Cerrar Sesión</a>
      <a class="nav-link" href="regisProducto.php">Registrar Producto</a>
        <a class="nav-link active" aria-current="page" href="inventario.php">Inventario y Ventas</a>
        <a class="nav-link" href="facturas.php">Facturas</a>
      </nav>
    </div>
  </header>
  <!-- FIN MENÚ -->

  <h1 class="text-center mt-5 mb-5">Facturación</h1>
  <p>En el buscador (search) puedes poner el código o nombre del producto que deseas buscar en la tabla<br> 
    Para añadirlo a la factura, simplemente da click sobre él y en la pantalla emergente digita la cantidad. <br>
    Para terminar el proceso, da click en el botón "Carrito" que se encuentra en la parde de abajo </p>
  <!-- INICIO TABLA -->
  <table id="tablaProductos" class="table text-dark" style="width:150% text-dark">
      <thead id="fila">
          <tr>
              <th>Codigo</th>
              <th>Nombre</th>
              <th>Distribuidor</th>
              <th>Precio Venta</th>
              <th>Precio Compra</th>
              <th>CantidadStock</th>
          </tr>
      </thead>
      <tbody>
      </tbody>
  </table>
  <!-- FIN TABLA-->
</div>
<button class="btn btn-primary" type="button" onclick="ejecutarModal()">Carrito</button>
<div><p></p></div>


  <?php include_once "shared/script.php"?>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
  <script src="js/datatables.js"></script>
</body>
</html>