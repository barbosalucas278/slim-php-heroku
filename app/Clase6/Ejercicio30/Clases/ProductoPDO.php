<?php
require_once "AccesoDatos.php";
class ProductoPDO
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
    public static function FindByCodigo($codigo)
    {
        $arrayProducto = self::GetAll();
        if (is_array($arrayProducto)) {
            foreach ($arrayProducto as $producto) {
                if ($producto->Codigo == $codigo) {
                    return $producto;
                }
            }
        }
        return false;
    }
    public function Modificar()
    {
        try {
            //echo var_dump($this);
            $fechaActual = date("y-m-d h:i:s");
            $acceso = AccesoDatos::GetAccesoDatos();
            $consulta = $acceso->RetornarConsulta("UPDATE producto SET 
            stock = '$this->Stock',
            fecha_de_modificacion = '$fechaActual'
            WHERE codigo_de_barra = '$this->Codigo';");
            $consulta->Execute();
            return true;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    public function GuardarProducto()
    {
        try {
            $acceso = AccesoDatos::GetAccesoDatos();
            $consulta = $acceso->RetornarConsulta("INSERT INTO producto(codigo_de_barra, nombre, tipo, stock, precio, fecha_de_creacion) 
            VALUES (:codigo,:nombre,:tipo,:stock,:precio,:fecha_de_creacion);");
            $consulta->bindValue(':codigo', $this->Codigo, PDO::PARAM_STR);
            $consulta->bindValue(':nombre', $this->Nombre, PDO::PARAM_STR);
            $consulta->bindValue(':tipo', $this->Tipo, PDO::PARAM_STR);
            $consulta->bindValue(':stock', $this->Stock, PDO::PARAM_INT);
            $consulta->bindValue(':precio', $this->Precio, PDO::PARAM_INT);
            $consulta->bindValue(':fecha_de_creacion', $this->FechaCreacion, PDO::PARAM_STR);
            $consulta->execute();
            return true;
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), 3, $ex);
        }
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
            $array = $consulta->fetchAll(PDO::FETCH_CLASS, 'ProductoPDO');
            foreach ($array as $prod) {
                array_push($arrayProducto, $prod);
            }
            return $arrayProducto;
        } catch (Exception $th) {
            throw new Exception($th->getMessage(), 2, $th);
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
