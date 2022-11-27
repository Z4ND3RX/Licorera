<?php
require "conexion.php";

if (isset($_POST['usuario'], $_POST['password']) and
    !empty($_POST['usuario']) and !empty($_POST['password'])) {
    $usuario = $_POST['usuario'];
    $pass = $_POST['password'];

    $con = new Conexion();
    $pdo = $con->conectar();

    $validation = "CALL loguearse ('$usuario','$pass')";
    $result = mysqli_query($pdo, $validation);
    $estancia = mysqli_num_rows($result);

    if ($estancia) {
        $respuesta['ok'] = true;
        $respuesta['status'] = 200;
        $respuesta['msg'] = "Logueo Exitoso";
        session_start();
        $_SESSION['user'] = $usuario;
    } else {
        $respuesta['msg'] = "Logueo Fallido";
    }
    $con->desconectar($pdo);
} else {
    $respuesta['msg'] = "Debe diligenciar todos los campos";
}
echo json_encode($respuesta);