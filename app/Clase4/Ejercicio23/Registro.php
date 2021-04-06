<?php

require_once "./Entidades/Usuario.php";
require "./Entidades/Validacion.php";

if ($_FILES["archivo"]["error"] != 0 && !isset($_POST["nombre"]) || !isset($_POST["clave"]) || !Validacion::EsMail($_POST["mail"])) {
    return http_response_code(400);
}

$ruta = "./usuarios.json";
$nombre = $_POST["nombre"];
$clave = $_POST["clave"];
$mail = $_POST["mail"];
$foto = $_FILES["archivo"];

$id = rand(1, 10000);

$usuario = new Usuario($id, $nombre, $clave, $mail);

if (RegistrarUsuario($usuario, $ruta, $foto)) {
    echo "Se agrego correctamente";
    return http_response_code(200);
} else {
    echo "No agrego correctamente";
    return http_response_code(500);
}


function RegistrarUsuario($usuario, $ruta, $foto)
{
    $ret = false;
    $destinoFoto = "./Usuario/Fotos/" . $usuario->GetId() . substr($foto["name"], strpos($foto["name"], "."));
    echo $foto["type"];
    if (!is_a($usuario, "Usuario")) {
        return $ret;
    }
    if (Usuario::GuardarUsuarios($usuario, $ruta)) {
        if (move_uploaded_file($foto["tmp_name"], $destinoFoto)) {
            return $ret = true;
        }
        return $ret;
    }
    return $ret;
}
