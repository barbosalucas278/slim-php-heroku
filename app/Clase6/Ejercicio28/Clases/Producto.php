<?php
require_once "AccesoDatos.php";
class Producto
{
    public $Id;
    public $Codigo;
    public $Nombre;
    public $Tipo;
    public $Stock;
    public $Precio;
    public $FechaCreacion;
    public $FechaModificacion;

    public function __construct()
    {
    }

    public static function GetAll()
    {
        try {
            $acceso = AccesoDatos::GetAccesoDatos();
            $arrayProducto = array();
            $consulta = $acceso->RetornarConsulta("SELECT id AS Id,
            codigo_de_barra AS Codigo,
            nombre AS Nombre,
            tipo AS Tipo,
            stock AS Stock,
            precio AS Precio,
            fecha_de_creacion AS FechaCreacion,
            fecha_de_modificacion AS FechaModificacion FROM producto");
            $consulta->execute();
            $array = $consulta->fetchAll(PDO::FETCH_CLASS, 'Producto');
            foreach ($array as $prod) {
                array_push($arrayProducto, $prod);
            }
            return $arrayProducto;
        } catch (Exception $th) {
            throw new Exception("No se pudo cargar la lista", 2, $th);
        }
    }
    public static function ListarProductos($listado)
    {
        $salida = "<ul>";
        foreach ($listado as $prod) {

            $salida .= "<li>" . $prod->MostrarDatos() . "</li>";
        }
        return $salida . "</ul>";
    }
    public function MostrarDatos()
    {
        return "$this->Codigo,$this->Nombre,$this->Tipo,$this->Stock,$this->Precio,$this->FechaCreacion,$this->FechaModificacion";
    }
}
