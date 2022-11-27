<?php
require_once "conexion.php";

$con = new Conexion();
$pdo = $con->conectar();

$sql = "CALL obtenerProductos()" ;
$result = mysqli_query($pdo, $sql);
$respuesta = $result->fetch_all(MYSQLI_ASSOC);

if ($result->num_rows <= 0) {
    $respuesta['msg'] = "No hay productos Registrados";
} 
$con->desconectar($pdo);

echo json_encode($respuesta);