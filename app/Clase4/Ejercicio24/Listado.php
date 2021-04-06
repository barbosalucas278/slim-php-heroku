<?php
require_once "./Entidades/Usuario.php";
require_once "./Entidades/Validacion.php";

define("RUTA", "./usuarios.json");
if (isset($_GET["tipo"])) {
    $tipoListado = $_GET["tipo"];

    switch ($tipoListado) {
        case "usuarios":
            $listado = Usuario::LeerUsuarios(RUTA);
            echo $datos = Usuario::ListarUsuarios($listado);
            break;
        default:
            return http_response_code(400);
            break;
    }
}
