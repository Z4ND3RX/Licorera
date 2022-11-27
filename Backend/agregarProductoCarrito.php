<?php
require_once "sesion.php";
require_once "conexion.php";

if (isset($_POST['codProducto'], $_POST['cantidad']) && !empty($_POST['codProducto']) && !empty($_POST['cantidad'])) {
    $codProducto = $_POST['codProducto'];
    $cantidad = $_POST['cantidad'];
    $user = $_SESSION['user'];
    $con = new Conexion();
    $pdo = $con->conectar();

    $validation = "CALL validarProductoCarrito ('$codProducto', '$user')";
    $result = mysqli_query($pdo, $validation);
    $estanciaProducto = mysqli_num_rows($result);
    $con->desconectar($pdo);
    $pdo = $con->conectar();

    if ($estanciaProducto) {
        $respuesta['ok'] = false;
        $respuesta['msg'] = "el producto ya se encuentra en el carrito";
    } else {
        $sql = "CALL agregarProductoCarrito ('$user', '$codProducto', '$cantidad')";
        if (mysqli_query($pdo, $sql)) {
            $respuesta['ok'] = true;
            $respuesta['status'] = 200;
            $respuesta['msg'] = "Producto Registrado en el Carrito";
        } else {
            $respuesta['msg'] = "Problemas al registrar el producto al carrito";
        }
    }
    $con->desconectar($pdo);

} else {
    $respuesta['msg'] = "Problemas al registrar el producto al carrito, hay datos nulos";
}

echo json_encode($respuesta);
