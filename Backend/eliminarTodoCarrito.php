<?php
require_once "sesion.php";
require_once "conexion.php";

$user = $_SESSION['user'];
$con = new Conexion();
$pdo = $con->conectar();

$sql = "CALL eliminarTodoCarrito ('$user')";
if (mysqli_query($pdo, $sql)) {
    $respuesta['ok'] = true;
    $respuesta['status'] = 200;
    $respuesta['msg'] = "Productos Eliminados del Carrito";
} else {
    $respuesta['msg'] = "Problemas al Eliminar los productos del carrito";
}

$con->desconectar($pdo);

echo json_encode($respuesta);
