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

    public static function GetAll()
    {
        try {
            $acceso = AccesoDatos::GetAccesoDatos();
            $arrayVentas = array();
            $consulta = $acceso->RetornarConsulta("SELECT id AS Id,
                id_producto AS IdProducto,
                id_usuario AS IdUsuario,
                cantidad AS Cantidad,
                fecha_de_venta AS FechaVenta FROM venta;");
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
