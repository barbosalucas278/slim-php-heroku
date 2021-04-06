<?php
require_once "./Entidades/Producto.php";
require_once "./Entidades/RegistroManager.php";
require_once "./Entidades/Validacion.php";

if (!isset($_POST["precio"]) || !isset($_POST["stock"]) || !isset($_POST["tipo"]) || !isset($_POST["nombre"]) || !Validacion::EsCodigoDeBarras(($_POST["codigo"]))) {
    echo "No se pudo hacer";
    return http_response_code(400);
}

$codigo = $_POST["codigo"];
$nombre = $_POST["nombre"];
$tipo = $_POST["tipo"];
$stock = $_POST["stock"];
$precio = $_POST["precio"];

$ruta = "./Productos/productos.json";
$producto = new Producto(Producto::GenerarId(), $codigo, $nombre, $tipo, $stock, $precio);

$registro = new RegistroManager($ruta);


echo $registro->Alta($producto);
