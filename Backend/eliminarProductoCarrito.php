<?php
require_once "sesion.php";
require_once "conexion.php";

if (isset($_POST['codProducto']) && !empty($_POST['codProducto'])) {
    $codProducto = $_POST['codProducto'];
    $user = $_SESSION['user'];
    $con = new Conexion();
    $pdo = $con->conectar();

    $sql = "CALL eliminarProductoCarrito ('$user', '$codProducto')";
    if (mysqli_query($pdo, $sql)) {
        $respuesta['ok'] = true;
        $respuesta['status'] = 200;
        $respuesta['msg'] = "Producto Eliminado del Carrito";
    } else {
        $respuesta['msg'] = "Problemas al Eliminar el producto del carrito";
    }

    $con->desconectar($pdo);

} else {
    $respuesta['msg'] = "Problemas al Eliminar el producto del carrito";
}

echo json_encode($respuesta);

