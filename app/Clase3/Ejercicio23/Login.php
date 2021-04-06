<?php
require_once "Usuario2.php";
require_once "Validacion.php";

if (isset($_POST["clave"]) && Validacion::EsMail($_POST["mail"])) {
    $clave = $_POST["clave"];
    $mail = $_POST["mail"];
    $datosUsuario = array("clave" => $clave, "mail" => $mail);
    $respuesta = Usuario::Login($datosUsuario);
    switch ($respuesta) {
        case 1:
            echo "Verificado";
            break;
        case -1:
            echo "Error en los datos, verifique contraseña";
            break;
        case 0:
            echo "Usuario no registrado";
            break;
    }
} else {
    echo "Ingrese datos válidos";
    return http_response_code(400);
}
