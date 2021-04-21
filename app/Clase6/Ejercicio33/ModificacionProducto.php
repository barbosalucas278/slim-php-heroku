<?php
require_once "./Clases/Validacion.php";
require_once "./Clases/ProductoPDO.php";

if (!isset($_POST["nombre"]) && !isset($_POST["tipo"]) && !isset($_POST["stock"]) && !isset($_POST["precio"]) && !Validacion::EsCodigoDeBarras($_POST["codigo"])) {
    echo "Ingrese datos válidos";
    return http_response_code(400);
}

$codigo = $_POST["codigo"];
$nombre = $_POST["nombre"];
$tipo = $_POST["tipo"];
$stock = $_POST["stock"];
$precio = $_POST["precio"];

try {
    if (ModificacionProducto($codigo, $nombre, $tipo, $stock, $precio)) {
        echo "actualizado";
    }
} catch (Exception $ex) {
    echo "No se pudo hacer" . $ex->getMessage();
}

function ModificacionProducto($codigo, $nombre, $tipo, $stock, $precio)
{
    try {
        $producto = ProductoPDO::FindByCodigo($codigo);
        if ($producto) {
            $producto->Nombre = $nombre;
            $producto->Tipo = $tipo;
            $producto->Stock = $stock;
            $producto->Precio = $precio;
            return $producto->Modificar();
        } else {
            throw new Exception("No existe el producto");
        }
    } catch (\Throwable $th) {
        throw new Exception($th->getMessage(), 1, $th);
    }
}
