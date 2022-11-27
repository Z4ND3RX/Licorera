<?php
require_once "sesion.php";
require_once "conexion.php";

if (isset($_POST['codigo']) && !empty($_POST['codigo'])) {
    $con = new Conexion();
    $pdo = $con->conectar();

    $codProducto = $_POST['codigo'];
    $sql = "CALL buscarProducto ('$codProducto')";
    $result = mysqli_query($pdo, $sql);
    $respuesta = $result->fetch_all(MYSQLI_ASSOC);

    if ($result->num_rows <= 0) {
        $respuesta['ok'] = false;
        $respuesta['msg'] = "No se encuentra";
    } else {
        $respuesta['ok'] = true;
        $respuesta['msg'] = "Encontrado";
    }
    $con->desconectar($pdo);
}else {
    $respuesta['msg'] = "Problemas al buscar el producto";
}
echo json_encode($respuesta);
