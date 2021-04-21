<?php

require_once "./Clases/Usuario.php";

if (!isset($_POST["nombre"]) || !isset($_POST["apellido"]) || !isset($_POST["clave"]) || !isset($_POST["mail"]) || !isset($_POST["localidad"])) {
    echo "Faltan datos del usuario";
    return http_response_code(400);
}

$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$clave = $_POST["clave"];
$mail = $_POST["mail"];
$localidad = $_POST["localidad"];


$usuario = new Usuario(null, $nombre, $apellido, $clave, $mail, $localidad);

try {
    if ($usuario->GuardarUsuario("./registros.csv")) {
        echo "Se agrego correctamente";
        return http_response_code(200);
    }
} catch (Exception $ex) {
    echo $ex->getMessage();
    return http_response_code(500);
}
