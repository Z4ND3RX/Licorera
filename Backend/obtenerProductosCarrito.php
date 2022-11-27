<?php
require_once "sesion.php";
require_once "conexion.php";

$con = new Conexion();
$pdo = $con->conectar();

$user = $_SESSION['user'];
$sql = "CALL obtenerProductosCarrito ('$user')";
$result = mysqli_query($pdo, $sql);
$respuesta = $result->fetch_all(MYSQLI_ASSOC);

if ($result->num_rows <= 0) {
    $respuesta['ok'] = false;
    $respuesta['msg'] = "No hay productos Registrados";
} 
$con->desconectar($pdo);

echo json_encode($respuesta);
