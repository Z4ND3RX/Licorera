<?php
require_once "sesion.php";
require_once "conexion.php";

if (isset($_POST['codProducto'])) {
    $codProducto = $_POST['codProducto'];
    $user = $_SESSION['user'];
    $con = new Conexion();
    $pdo = $con->conectar();

    $validation = "CALL validarRolAdmin ('$user')";
    $result = mysqli_query($pdo, $validation);
    $estanciaAdmin = mysqli_num_rows($result);
    $con = new Conexion();
    $pdo = $con->conectar();

    if ($estanciaAdmin) {
        $con = new Conexion();
        $sql = "CALL eliminarProductoInventario ('$codProducto')";
        if (mysqli_query($pdo, $sql)) {
            $respuesta['ok'] = true;
            $respuesta['status'] = 200;
            $respuesta['msg'] = "Producto Eliminado del Inventario";
        } else {
            $respuesta['msg'] = "Problemas al Eliminar el producto del inventario";
        }

        $con->desconectar($pdo);
    } else {
        $respuesta['ok'] = false;
        $respuesta['msg'] = "No Admin";
    }
} else {
    $respuesta['msg'] = "Problemas al Eliminar el producto del inventario";
}

echo json_encode($respuesta);
