<?php
class Conexion
{
    const DB_SERVER = "localhost";
    const DB_USERNAME = "root";
    const DB_PASSWORD = "240877";
    const DB_NAME = "licorera";

    public function conectar()
    {
        $server = self::DB_SERVER;
        $user = self::DB_USERNAME;
        $pass = self::DB_PASSWORD;
        $db = self::DB_NAME;
        $conexion = mysqli_connect($server, $user, $pass, $db) or die("Error en la conexión");
        return $conexion;
    }
    public function desconectar($conexion){
        mysqli_close($conexion);
    }
}