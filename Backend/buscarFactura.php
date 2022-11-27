<?php
require_once "sesion.php";
require_once "conexion.php";

if (isset($_POST['start'], $_POST['end']) && !empty($_POST['start']) && !empty($_POST['end'])) {
    $con = new Conexion();
    $pdo = $con->conectar();

    $start = $_POST['start'];
    $end = $_POST['end'];
    $sql = "CALL buscarTotalFacturas ('$start', '$end')";
    $result = mysqli_query($pdo, $sql);
    $respuesta = $result->fetch_all(MYSQLI_ASSOC);

    if ($result->num_rows <= 0) {
        $respuesta['ok'] = false;
        $respuesta['msg'] = "Incalculable";
    } else {
        $respuesta['ok'] = true;
        $respuesta['msg'] = "Calculable";
    }
    $con->desconectar($pdo);
}else {
    $respuesta['msg'] = "Problemas al realizar la suma";
}
echo json_encode($respuesta);
