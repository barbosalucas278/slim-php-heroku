<?php
require_once "./Clases/Producto.php";
require_once "./Clases/Validacion.php";

if (!isset($_POST["precio"]) || !isset($_POST["stock"]) || !isset($_POST["tipo"]) || !isset($_POST["nombre"]) || !Validacion::EsCodigoDeBarras(($_POST["codigo"]))) {
    echo "No se pudo hacer";
    return http_response_code(400);
}

$codigo = $_POST["codigo"];
$nombre = $_POST["nombre"];
$tipo = $_POST["tipo"];
$stock = $_POST["stock"];
$precio = $_POST["precio"];

$producto = new Producto($codigo, $nombre, $tipo, $stock, $precio);


try {
    echo $producto->Alta();
} catch (Exception $ex) {
    echo $ex->getMessage();
}
