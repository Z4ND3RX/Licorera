<?php
require "conexion.php";

if (isset($_POST['codigoM'], $_POST['nombreM'], $_POST['precioVentaM'], $_POST['precioCompraM'], $_POST['distribuidorM'], $_POST['cantidadM']) and
    !empty($_POST['codigoM']) and !empty($_POST['nombreM']) and !empty($_POST['precioVentaM']) and
    !empty($_POST['precioCompraM']) and !empty($_POST['distribuidorM']) and !empty($_POST['cantidadM'])) {
    $codigo = $_POST['codigoM'];
    $nombre = $_POST['nombreM'];
    $precioVenta = $_POST['precioVentaM'];
    $precioCompra = $_POST['precioCompraM'];
    $distribuidor = $_POST['distribuidorM'];
    $cantidad = $_POST['cantidadM'];

    $con = new Conexion();
    $pdo = $con->conectar();

    $sql = "CALL actualizarProductoInventario('$codigo', '$nombre', '$distribuidor','$precioVenta', '$precioCompra', '$cantidad')";
    if (mysqli_query($pdo, $sql)) {
        $respuesta['ok'] = true;
        $respuesta['status'] = 200;
        $respuesta['msg'] = "Producto Actualizado";
    } else {
        $respuesta['msg'] = "Problemas al actualizar el producto";
    }

    $con->desconectar($pdo);

} else {
    $respuesta['msg'] = "Debe diligenciar todos los campos";
}
echo json_encode($respuesta);
