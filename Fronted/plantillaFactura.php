<?php 
require_once "../Backend/sesion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <?php include_once "shared/head.php"?>
</head>
<body>

<div class="card">
  <div class="card-header">
    <label id = "current_date"></label>
    <script>
        date = new Date();
        year = date.getFullYear();
        month = date.getMonth() + 1;
        day = date.getDate();
        hour = date.getHours();
        minute = date.getMinutes();
        seconds = date.getSeconds();
        document.getElementById("current_date").innerHTML = "Expedida el " + month + "/" + day + "/" + year + " a las " + hour
        + ":" + minute + ":" + seconds;
    </script>
  </div>
  <div class="card-body">
    <h5 class="card-title">Rapitienda y Licores la 28</h5>
    <p class="card-text">Tuluá - Valle del Cauca. <br> Cl. 12B #28A - 01 <br> Tel: XXX-XXX-XXX <br> Caja 1</p>
    <h6>Detalle de compra</h6>
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
    <div class="text-right" >
      <label for=""></label>
      <br>
        <input type = "hidden" id="total" name="total">
        <label >Dinero recibido en caja: $</label>
        <input type="double" id="caja" name="caja" size="10" oninput="calcular()">
        <br>
        <label >Cambio: $</label>
        <input type="double" id="cambio" name="cambio" size="10" readonly="readonly">
    </div>
    <button type="button" class="btn btn-secondary" id="imprir" onclick="imprimir();">Imprimir</button>
    <button type="button" class="btn btn-primary" id="facturar" onclick="Facturar();">Finalizar venta</button>
  </div>
  <div class="card-footer text-muted">
    Factura de Venta - Gracias por su compra
  </div>
</div>
<?php include_once "shared/script.php"?>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
  <script src="js/datatables.js"></script>
</body>
</html>