<?php
require "conexion.php";

if (isset($_POST['codigo'], $_POST['nombre'], $_POST['precioVenta'], $_POST['precioCompra'], $_POST['distribuidor'], $_POST['cantidad']) and
    !empty($_POST['codigo']) and !empty($_POST['nombre']) and !empty($_POST['precioVenta']) and
    !empty($_POST['precioCompra']) and !empty($_POST['distribuidor']) and !empty($_POST['cantidad'])) {
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $precioVenta = $_POST['precioVenta'];
    $precioCompra = $_POST['precioCompra'];
    $distribuidor = $_POST['distribuidor'];
    $cantidad = $_POST['cantidad'];

    $con = new Conexion();
    $pdo = $con->conectar();

    $validation = "CALL validarProductoRegistrado ('$codigo')";
    $result = mysqli_query($pdo, $validation);
    $estanciaCodigo = mysqli_num_rows($result);

    $con->desconectar($pdo);
    $pdo = $con->conectar();
    if ($estanciaCodigo) {
        $respuesta['msg'] = "codigo ya registrado";
    } else {
        $sql = "CALL registrarProducto('$codigo', '$nombre', '$distribuidor','$precioVenta', '$precioCompra', '$cantidad')";
        if (mysqli_query($pdo, $sql)) {
            $respuesta['ok'] = true;
            $respuesta['status'] = 200;
            $respuesta['msg'] = "Producto Registrado";
        } else {
            $respuesta['msg'] = "Problemas al registrar el producto";
        }
    }
    $con->desconectar($pdo);

} else {
    $respuesta['msg'] = "Debe diligenciar todos los campos";
}
echo json_encode($respuesta);