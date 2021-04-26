<?php
require_once "AccesoDatos.php";
class Venta
{
    public $Id;
    public $IdProducto;
    public $IdUsuario;
    public $Cantidad;
    public $FechaVenta;

    public function __construct()
    {
    }

    public static function GetAll($limit = null)
    {
        try {
            $queryLimit = "";
            if (isset($limit)) {
                $queryLimit = "LIMIT $limit";
            }
            $acceso = AccesoDatos::GetAccesoDatos();
            $arrayVentas = array();
            $consulta = $acceso->RetornarConsulta("SELECT id AS Id,
                id_producto AS IdProducto,
                id_usuario AS IdUsuario,
                cantidad AS Cantidad,
                fecha_de_venta AS FechaVenta FROM venta $queryLimit;");
            $consulta->execute();
            $array = $consulta->fetchAll(PDO::FETCH_CLASS, 'Venta');
            foreach ($array as $venta) {
                array_push($arrayVentas, $venta);
            }
            return $arrayVentas;
        } catch (Exception $th) {
            throw new Exception("No se pudo cargar la lista" . $th->getMessage(), 2, $th);
        }
    }

    public static function GetAllMontos($limit = null)
    {
        try {
            $acceso = AccesoDatos::GetAccesoDatos();
            $arrayVentas = array();
            $queryLimit = "";
            if (isset($limit)) {
                $queryLimit = "LIMIT $limit";
            }
            $consulta = $acceso->RetornarConsulta("SELECT 
                venta.id AS Id,
                venta.id_producto AS IdProducto,
                producto.nombre AS NombreProducto,
                venta.id_usuario AS IdUsuario,
                venta.cantidad AS Cantidad,
                ROUND(producto.precio * venta.cantidad,2) AS Monto,
                venta.fecha_de_venta AS FechaVenta FROM venta 
                INNER JOIN producto ON venta.id_producto = producto.id $queryLimit;");
            $consulta->execute();
            $array = $consulta->fetchAll(PDO::FETCH_CLASS, 'Venta');
            foreach ($array as $venta) {
                array_push($arrayVentas, $venta);
            }
            return $arrayVentas;
        } catch (Exception $th) {
            throw new Exception("No se pudo cargar la lista" . $th->getMessage(), 2, $th);
        }
    }
    public static function GetAllFull($limit = null)
    {
        try {
            $acceso = AccesoDatos::GetAccesoDatos();
            $arrayVentas = array();
            $queryLimit = "";
            if (isset($limit)) {
                $queryLimit = "LIMIT $limit";
            }
            $consulta = $acceso->RetornarConsulta("SELECT 
                venta.id AS Id,
                venta.id_producto AS IdProducto,
                producto.nombre AS NombreProducto,
                venta.id_usuario AS IdUsuario,
                usuario.nombre AS NombreUsuario,
                venta.cantidad AS Cantidad,
                venta.fecha_de_venta AS FechaVenta FROM venta 
                INNER JOIN producto ON venta.id_producto = producto.id INNER JOIN usuario ON venta.id_usuario = usuario.id $queryLimit;");
            $consulta->execute();
            $array = $consulta->fetchAll(PDO::FETCH_CLASS, 'Venta');
            foreach ($array as $venta) {
                array_push($arrayVentas, $venta);
            }
            return $arrayVentas;
        } catch (Exception $th) {
            throw new Exception("No se pudo cargar la lista" . $th->getMessage(), 2, $th);
        }
    }
    public static function GetByLocalidad($localidad, $limit = null)
    {
        try {
            $acceso = AccesoDatos::GetAccesoDatos();
            $arrayVentas = array();
            $queryLimit = "";
            if (isset($limit)) {
                $queryLimit = "LIMIT $limit";
            }
            $consulta = $acceso->RetornarConsulta("SELECT 
                venta.id AS Id,
                venta.id_producto AS IdProducto,
                venta.id_usuario AS IdUsuario,
                venta.cantidad AS Cantidad,
                venta.fecha_de_venta AS FechaVenta FROM venta
                INNER JOIN usuario ON venta.id_usuario = usuario.id WHERE usuario.localidad = :localidad 
                $queryLimit;");
            $consulta->bindValue("localidad", $localidad, PDO::PARAM_STR);
            $consulta->execute();
            $array = $consulta->fetchAll(PDO::FETCH_CLASS, 'Venta');
            foreach ($array as $venta) {
                array_push($arrayVentas, $venta);
            }
            return $arrayVentas;
        } catch (Exception $th) {
            throw new Exception("No se pudo cargar la lista" . $th->getMessage(), 2, $th);
        }
    }
    public static function GetVentasByCodigoIdUsuario($idProducto, $idUsuario, $limit = null)
    {
        try {
            $acceso = AccesoDatos::GetAccesoDatos();
            $arrayVentas = array();
            $queryLimit = "";
            if (isset($limit)) {
                $queryLimit = "LIMIT $limit";
            }
            $consulta = $acceso->RetornarConsulta("SELECT 
                venta.id AS Id,
                venta.id_producto AS IdProducto,
                venta.id_usuario AS IdUsuario,
                venta.cantidad AS Cantidad,
                venta.fecha_de_venta AS FechaVenta FROM venta
                WHERE venta.id_producto = :idProducto && venta.id_usuario = :idUsuario 
                $queryLimit;");
            $consulta->bindValue(":idProducto", $idProducto, PDO::PARAM_INT);
            $consulta->bindValue(":idUsuario", $idUsuario, PDO::PARAM_INT);
            $consulta->execute();
            $array = $consulta->fetchAll(PDO::FETCH_CLASS, 'Venta');
            foreach ($array as $venta) {
                array_push($arrayVentas, $venta);
            }
            return $arrayVentas;
        } catch (Exception $th) {
            throw new Exception("No se pudo cargar la lista" . $th->getMessage(), 2, $th);
        }
    }
    public static function GetVentasBetweenCantidades($cantidadMinima, $cantidadMaxima)
    {
        if ($cantidadMinima >= 0 && $cantidadMaxima > $cantidadMinima) {
            try {
                $acceso = AccesoDatos::GetAccesoDatos();
                $arrayVentas = array();
                $consulta = $acceso->RetornarConsulta("SELECT 
                    id AS Id,
                    id_producto AS IdProducto,                    
                    id_usuario AS IdUsuario,
                    cantidad AS Cantidad,
                    fecha_de_venta AS FechaVenta FROM venta WHERE cantidad BETWEEN :cantidadMinima AND :cantidadMaxima;");
                $consulta->bindValue(":cantidadMinima", $cantidadMinima, PDO::PARAM_INT);
                $consulta->bindValue(":cantidadMaxima", $cantidadMaxima, PDO::PARAM_INT);
                $consulta->execute();
                $array = $consulta->fetchAll(PDO::FETCH_CLASS, 'Venta');
                foreach ($array as $venta) {
                    array_push($arrayVentas, $venta);
                }
                return $arrayVentas;
            } catch (Exception $th) {
                throw new Exception("No se pudo cargar la lista", 2, $th);
            }
        }
    }
    public static function GetVentasBetweenFechas($fechaInicio, $fechaFin)
    {
        try {
            $acceso = AccesoDatos::GetAccesoDatos();
            $arrayVentas = array();
            $consulta = $acceso->RetornarConsulta("SELECT 
                    id AS Id,
                    id_producto AS IdProducto,
                    id_usuario AS IdUsuario,
                    cantidad AS Cantidad,
                    fecha_de_venta AS FechaVenta FROM venta WHERE fecha_de_venta BETWEEN :fechaInicio AND :fechaFin;");
            $consulta->bindValue(":fechaInicio", $fechaInicio, PDO::PARAM_STR);
            $consulta->bindValue(":fechaFin", $fechaFin, PDO::PARAM_STR);
            $consulta->execute();
            $array = $consulta->fetchAll(PDO::FETCH_CLASS, 'Venta');
            foreach ($array as $venta) {
                array_push($arrayVentas, $venta);
            }
            return $arrayVentas;
        } catch (Exception $th) {
            throw new Exception("No se pudo cargar la lista", 2, $th);
        }
    }
    public static function GetCantidadesBetweenFechas($fechaInicio, $fechaFin)
    {
        try {
            $acceso = AccesoDatos::GetAccesoDatos();
            $consulta = $acceso->RetornarConsulta("SELECT id_producto AS Producto,SUM(cantidad) AS Cantidades FROM venta 
            WHERE fecha_de_venta BETWEEN :fechaInicio AND :fechaFin 
            GROUP BY venta.id_producto");
            $consulta->bindValue(":fechaInicio", $fechaInicio, PDO::PARAM_STR);
            $consulta->bindValue(":fechaFin", $fechaFin, PDO::PARAM_STR);
            $consulta->execute();
            return $consulta->fetchall();
        } catch (Exception $th) {
            throw new Exception("No se pudo cargar la lista" . $th->getMessage(), 2, $th);
        }
    }
    public static function ListarVentas($listado)
    {
        $salida = "<ul>";
        foreach ($listado as $venta) {

            $salida .= "<li>" . $venta->MostrarDatos() . "</li>";
        }
        return $salida . "</ul>";
    }
    public function MostrarDatos()
    {
        return "$this->IdProducto,$this->IdUsuario,$this->Cantidad,$this->FechaVenta";
    }
}
