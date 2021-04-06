<?php
require_once "Usuario2.php";
if (isset($_GET["tipo"])) {
    $tipoListado = $_GET["tipo"];

    switch ($tipoListado) {
        case "usuarios":
            $listado = Usuario::LeerUsuarios("./registros.csv");
            echo var_dump($listado);
            echo $datos = Usuario::ListarUsuarios($listado);
            break;
        default:
            return http_response_code(400);
            break;
    }
}
