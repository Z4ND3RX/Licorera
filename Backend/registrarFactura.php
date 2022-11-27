<?php
require "conexion.php";

if (isset($_POST['descripcion'], $_POST['fecha'], $_POST['total'], $_POST['codigos']) and
    !empty($_POST['descripcion']) and !empty($_POST['fecha']) and !empty($_POST['total']) and !empty($_POST['codigos'])) {
    $descripcion = $_POST['descripcion'];
    $fecha = $_POST['fecha'];
    $total = $_POST['total'];
    $array = json_decode($_POST["codigos"]);
    $con = new Conexion();
    for ($i = 0; $i < count($array); $i++) {
        $pdo = $con->conectar();
        $code = intval($array[$i][0]);
        $cant = intval($array[$i][1]);
        $sqlX = "CALL actualizarCantidadStock('$code', '$cant')";
        mysqli_query($pdo, $sqlX);
        $con->desconectar($pdo);
    }

    $pdo = $con->conectar();
    $sql = "CALL insertarFactura('$descripcion', '$fecha', '$total')";
    if (mysqli_query($pdo, $sql)) {
        $respuesta['ok'] = true;
        $respuesta['status'] = 200;
        $respuesta['msg'] = "Factura Registrada";
    } else {
        $respuesta['msg'] = "Problemas al registrar la factura";
    }

    $con->desconectar($pdo);

} else {
    $respuesta['msg'] = "Debe diligenciar todos los campos";
}
echo json_encode($respuesta);
