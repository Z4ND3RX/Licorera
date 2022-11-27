<?php
require_once "../Backend/sesion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas - Rapitienda y Licores la 28</title>
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
      <a class="nav-link" href="regisProducto.php">Registrar Producto</a>
        <a class="nav-link" href="inventario.php">Inventario y Ventas</a>
        <a class="nav-link active" aria-current="page" href="facturas.php">Facturas</a>
      </nav>
    </div>
  </header>
  <!-- FIN MENÚ -->

  <h1 class="text-center mt-5 mb-5">Ventas y Facturas</h1>
  <p> En este apartado se reflejan todas las facturas expedidas. </p>
  <!-- INICIO TABLA -->
  <table id="tablaFacturas" class="table text-dark" style="width:150% text-dark">
      <thead id="fila">
          <tr>
              <th>IDVenta</th>
              <th>Descripcion</th>
              <th>Fecha</th>
              <th>Total</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="3" style="text-align:right"></th>
            <th></th>
          </tr>
        </tfoot>
  </table>
  <!-- FIN TABLA-->

  <!-- CALCULADOR FECHAS -->
  <div class="card">
    <div class="card-header">
      Calculador total facturas
    </div>
    <div class="card-body">
      <form action="#" enctype="multipart/form-data" name="form-facturas" method="POST">
        <div class="row">
          <div class="col-md-6 mb-4">
            <label for="start" class="form-label">Inicio</label>
            <input type="date" class="form-control" id="start" name="start" placeholder="Fecha de inicio" required>
          </div>
          <div class="col-md-6 mb-4">
            <label for="end" class="form-label">Fin</label>
            <input type="date" class="form-control" id="end" name="end" placeholder="Fecha de fin" required>
          </div>
        </div>
        <button type="button" class="btn btn-primary" id="buscarTotal" onclick="buscarFactura();">Buscar</button>
    </form>
    </div>
   <!-- FIN CALCULADOR-->
</div>
  <?php include_once "shared/script.php"?>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
  <script src="js/facturas.js"></script>
</body>
</html>