<?php
require_once "IArchivo.php";
class Producto implements IArchivo
{
    private $_Id;
    private $_CodigoBarras;
    private $_Nombre;
    private $_Tipo;
    private $_Stock;
    private $_Precio;

    public function __construct($id, $codigo, $nombre, $tipo, $stock, $precio)
    {
        $this->_Id = $id;
        $this->_CodigoBarras = $codigo;
        $this->_Nombre = $nombre;
        $this->_Tipo = $tipo;
        $this->_Stock = $stock;
        $this->_Precio = $precio;
    }
    public function GetId()
    {
        return $this->_Id;
    }
    public function SetId($id)
    {
        $this->_Id = $id;
    }
    public function GetCodigo()
    {
        return $this->_CodigoBarras;
    }
    public function SetCodigo($codigo)
    {
        $this->_CodigoBarras = $codigo;
    }
    public function GetNombre()
    {
        return $this->_Nombre;
    }
    public function SetNombre($nombre)
    {
        $this->_Nombre = $nombre;
    }
    public function GetTipo()
    {
        return $this->_Tipo;
    }
    public function SetTipo($tipo)
    {
        $this->_Tipo = $tipo;
    }
    public function GetStock()
    {
        return $this->_Stock;
    }
    public function SetStock($stock)
    {
        $this->_Stock = $stock;
    }
    public function GetPrecio()
    {
        return $this->_Precio;
    }
    public function SetPrecio($precio)
    {
        $this->_Precio = $precio;
    }
    public function MostrarDatos()
    {
        return "$this->_Id,$this->_CodigoBarras,$this->_Nombre,$this->_Tipo,$this->_Stock,$this->_Precio";
    }
    public static function MapearProductos($dato)
    {
        if (isset($dato["id"]) && !empty($dato["id"]) && isset($dato["codigo"]) && !empty($dato["codigo"]) && isset($dato["nombre"]) && !empty($dato["nombre"]) && isset($dato["tipo"]) && !empty($dato["tipo"]) && isset($dato["stock"]) && !empty($dato["stock"]) && isset($dato["precio"]) && !empty($dato["precio"])) {
            return new Producto($dato["id"], $dato["codigo"], $dato["nombre"], $dato["tipo"], $dato["stock"], $dato["precio"]);
        }
    }
    public static function GenerarId()
    {
        return rand(1, 100000);
    }
    public function ToArray()
    {
        return array("id" => $this->_Id, "codigo" => $this->_CodigoBarras, "nombre" => $this->_Nombre, "tipo" => $this->_Tipo, "stock" => $this->_Stock, "precio" => $this->_Precio);
    }

    private static function ProductosToArray($arrayProductos)
    {
        $array = array();

        foreach ($arrayProductos as $producto) {
            array_push($array, $producto->ToArray());
        }
        return $array;
    }
    public static function Leer($ruta)
    {
        if (file_exists($ruta)) {
            $archivo = fopen($ruta, "r");
            $listaProductos = array();
            $tamañoDelArchivo = filesize($ruta);
            if ($tamañoDelArchivo > 0) {
                $lectura = fread($archivo, $tamañoDelArchivo);
                $listaProductosArray = json_decode($lectura, true);
                if (is_array($listaProductosArray)) {
                    foreach ($listaProductosArray as $prod) {
                        $producto = Producto::MapearProductos($prod);
                        if (!is_null($producto)) {
                            array_push($listaProductos, $producto);
                        }
                    }
                    fclose($archivo);
                    return $listaProductos;
                }
            }
            return false;
        }
        return false;
    }
    public static function Listar($listado)
    {
        $salida = "<ul>";
        foreach ($listado as $producto) {

            $salida .= "<li>" . $producto->MostrarDatos() . "</li>";
        }
        $salida .= "</ul>";
        return $salida;
    }
    public static function Guardar($producto, $ruta)
    {
        $ret = "No se pudo hacer";
        $listaProductos = self::Leer($ruta);
        if (is_array($listaProductos)) {
            $archivo = fopen($ruta, "w");
            if (isset($archivo)) {
                $consulta = self::Consultar($producto->GetCodigo(), $listaProductos);
                echo $consulta;
                if ($consulta == $producto->GetCodigo()) {
                    $listaProductos = self::Modificar($listaProductos, $producto);
                    // echo "</br> modificó</br>";
                    // echo var_dump($listaProductos);
                    $ret = "Actualizado";
                } else {
                    array_push($listaProductos, $producto);
                    // echo "</br> no modificó</br>";
                    // echo var_dump($listaProductos);
                    $ret = "Ingresado";
                }
                $listaProductosArray = self::ProductosToArray($listaProductos);
                $datosJson = json_encode($listaProductosArray);
                if (fwrite($archivo, $datosJson)) {
                    if (fclose($archivo)) {
                        return $ret;
                    }
                }
                return $ret;
            }
            return $ret;
        } else {
            $archivo = fopen($ruta, "w");
            if (isset($archivo)) {
                $listaProductosArray = array($producto->ToArray());
                $datosJson = json_encode($listaProductosArray);
                if (fwrite($archivo, $datosJson)) {
                    if (fclose($archivo)) {
                        return $ret = "Ingresado";
                    }
                }
                return $ret;
            }
        }
        return $ret;
    }
    public static function Consultar($codigo, $listaProductos)
    {
        if (is_array($listaProductos)) {
            foreach ($listaProductos as $prod) {
                if ($prod->GetCodigo() == $codigo) {
                    return $prod->GetCodigo();
                }
            }
            return false;
        }
    }
    public static function Modificar($listaProductos, $producto)
    {
        foreach ($listaProductos as $prod) {
            if ($prod->GetCodigo() == $producto->GetCodigo()) {
                $prod->SetStock($producto->GetStock());
                return $listaProductos;
            }
        }
        return false;
    }
}
