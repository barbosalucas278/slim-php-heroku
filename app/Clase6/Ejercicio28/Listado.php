<?php
require_once "./Clases/Usuario.php";
require_once "./Clases/Producto.php";
require_once "./Clases/Venta.php";
if (isset($_GET["tipo"])) {
    $tipoListado = $_GET["tipo"];

    switch ($tipoListado) {
        case "usuarios":
            $listado = Usuario::GetAll();
            echo $datos = Usuario::ListarUsuarios($listado);
            break;
        case "productos":
            $listado = Producto::GetAll();
            echo $datos = Producto::ListarProductos($listado);
            break;
        case "ventas":
            $listado = Venta::GetAll();
            echo $datos = Venta::ListarVentas($listado);
            break;
        default:
            return http_response_code(400);
            break;
    }
}
