<?php
require_once "./Clases/VentaPDO.php";
require_once "./Clases/UsuarioPDO.php";
require_once "./Clases/ProductoPDO.php";
require_once "./Clases/Validacion.php";

if (!isset($_POST["id"]) || !Validacion::EsCodigoDeBarras($_POST["codigo"]) || !isset($_POST["cantidad"])) {
    return http_response_code(400);
}


$idComprador = $_POST["id"];
$codigo = $_POST["codigo"];
$cantidadVendida = $_POST["cantidad"];

try {
    if (Venta($idComprador, $codigo, $cantidadVendida)) {
        echo "Se realizó una venta";
    } else {
        echo "No se pudo hacer";
    }
} catch (Exception $ex) {
    throw $ex->getMessage();
}


function Venta($idComprador, $codigo, $cantidadVendida)
{
    try {
        $usuario = UsuarioPDO::FindById($idComprador);
        $producto = ProductoPDO::FindByCodigo($codigo);
        if (isset($usuario) && isset($producto)) {
            $nuevaVenta =  new VentaPDO();
            $nuevaVenta->IdProducto = $producto->Id;
            $nuevaVenta->IdUsuario = $usuario->Id;
            $nuevaVenta->FechaVenta = date("y-m-d");
            if ($producto->Stock > $cantidadVendida) {
                $producto->Stock -= $cantidadVendida;

                $nuevaVenta->Cantidad = $cantidadVendida;
                $nuevaVenta->GuardaVenta();
                $producto->Modificar();
            } else if ($producto->Stock == 0) {
                return false;
            } else if ($producto->Stock <= $cantidadVendida) {
                $cantidad = $producto->Stock;
                $producto->Stock = 0;

                $nuevaVenta->Cantidad = $cantidad;
                $nuevaVenta->GuardaVenta();
                $producto->Modificar();
            }
        }
        return true;
    } catch (Exception $ex) {
        throw new Exception($ex->getMessage(), $ex);
    }
}
