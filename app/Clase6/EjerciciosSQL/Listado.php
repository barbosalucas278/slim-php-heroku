<?php
require_once "./Clases/Usuario.php";
require_once "./Clases/Producto.php";
require_once "./Clases/Venta.php";

try {
    if (isset($_GET["ejercicio"])) {
        $ejercicio = $_GET["ejercicio"];
        switch ($ejercicio) {
            case "a":
                echo json_encode(Usuario::GetUsuariosOrderByApellido());
                break;
            case "b":
                echo json_encode(Producto::GetProductosORderByNombre());
                break;
            case "c":
                if (isset($_GET["minimo"]) && isset($_GET["maximo"])) {
                    $cantidadMinima = $_GET["minimo"];
                    $cantidadMaxima = $_GET["maximo"];
                    echo json_encode(Venta::GetVentasBetweenCantidades($cantidadMinima, $cantidadMaxima));
                }
                break;
            case "d":
                if (isset($_GET["fechaInicio"]) && isset($_GET["fechaFin"])) {
                    $fechaInicio = $_GET["fechaInicio"];
                    $fechaFin = $_GET["fechaFin"];
                    echo json_encode(Venta::GetCantidadesBetweenFechas($fechaInicio, $fechaFin));
                }
                break;
            case "e":
                if (isset($_GET["limit"])) {
                    $limit = $_GET["limit"];
                    echo json_encode(Venta::GetAll($limit));
                }
                break;
            case "f":
                echo json_encode(Venta::GetAllFull());
                break;
            case "g":
                echo json_encode(Venta::GetAllMontos());
                break;
            case "h":
                if (isset($_GET["idProducto"]) && isset($_GET["idUsuario"])) {
                    $idProducto = $_GET["idProducto"];
                    $idUsuario = $_GET["idUsuario"];
                    echo json_encode(Venta::GetVentasByCodigoIdUsuario($idProducto, $idUsuario));
                }
                break;
            case "i":
                if (isset($_GET["localidad"])) {
                    $localidad = $_GET["localidad"];
                    echo json_encode(Venta::GetByLocalidad($localidad));
                }
                break;
            case "j":
                if (isset($_GET["apellido"])) {
                    $apellido = $_GET["apellido"];
                    echo json_encode(Usuario::GetByApellido($apellido));
                }
                break;
            case "k":
                if (isset($_GET["fechaInicio"]) && isset($_GET["fechaFin"])) {
                    $fechaInicio = $_GET["fechaInicio"];
                    $fechaFin = $_GET["fechaFin"];
                    echo json_encode(Venta::GetVentasBetweenFechas($fechaInicio, $fechaFin));
                }
                break;
            default:
                return http_response_code(400);
                break;
        }
    }
} catch (\Throwable $th) {
    echo $th->getMessage();
}
