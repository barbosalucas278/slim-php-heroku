<?php
require_once "./PuestoTrabajo.php";
require_once "./Validacion.php";

if (!isset($_POST["id"]) || !Validacion::EsCodigoDeBarras($_POST["codigo"]) || !isset($_POST["cantidad"])) {
    return http_response_code(400);
}


$idComprador = $_POST["id"];
$codigo = $_POST["codigo"];
$cantidadVendida = $_POST["cantidad"];

$puestoTrabajo = new PuestoTrabajo($codigo, $idComprador);
if ($puestoTrabajo->Venta($cantidadVendida)) {
    echo "Se realizó una venta";
} else {
    echo "No se pudo hacer";
}
