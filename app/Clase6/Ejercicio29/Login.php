<?php
require_once "./Clases/Usuario.php";
require_once "./Clases/Validacion.php";

if (isset($_POST["clave"]) && Validacion::EsMail($_POST["mail"])) {
    $clave = $_POST["clave"];
    $mail = $_POST["mail"];
    $respuesta = Usuario::Login($mail, $clave);
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
