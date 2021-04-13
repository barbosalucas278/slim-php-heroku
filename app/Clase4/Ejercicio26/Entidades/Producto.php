<?php
require_once "./Entidades/Interfaces/IProducto.php";
require_once "Entidad.php";

class Producto extends Entidad implements IProducto
{
    //
    //  PROPIEDADES
    //
    private $_CodigoBarras;
    private $_Nombre;
    private $_Tipo;
    private $_Stock;
    private $_Precio;
    //
    //  CONTRUCTOR
    //
    public function __construct($codigo, $id = null, $nombre = null, $tipo = null, $stock = null, $precio = null)
    {
        $this->_CodigoBarras = $codigo;
        $this->_Id = $id;
        $this->_Nombre = $nombre;
        $this->_Tipo = $tipo;
        $this->SetStock($stock);
        $this->_Precio = $precio;
        echo "SE CREO";
    }

    //
    //  GETTERS Y SETTERS
    //

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
    /**
     * El stock no puede ser menor a 0(cero)
     */
    public function SetStock($stock)
    {
        if ($stock <= 0) {
            $this->_Stock = 0;
        } else {
            $this->_Stock = $stock;
        }
    }
    public function GetPrecio()
    {
        return $this->_Precio;
    }
    public function SetPrecio($precio)
    {
        $this->_Precio = $precio;
    }
    //
    //  MËTODOS DE INSTANCIA
    //
    public function ToString()
    {
        return parent::ToString() . ",$this->_CodigoBarras,$this->_Nombre,$this->_Tipo,$this->_Stock,$this->_Precio";
    }
    public function OneToArray()
    {
        return array("id" => $this->_Id, "codigo" => $this->_CodigoBarras, "nombre" => $this->_Nombre, "tipo" => $this->_Tipo, "stock" => $this->_Stock, "precio" => $this->_Precio);
    }
    public function Mapear($dato)
    {
        echo var_dump($dato);
        if (isset($dato["id"]) && !empty($dato["id"]) && isset($dato["codigo"]) && !empty($dato["codigo"]) && isset($dato["nombre"]) && !empty($dato["nombre"]) && isset($dato["tipo"]) && !empty($dato["tipo"]) && isset($dato["stock"]) && isset($dato["precio"]) && !empty($dato["precio"])) {
            $aux = new Producto($dato["codigo"], $dato["id"], $dato["nombre"], $dato["tipo"], $dato["stock"], $dato["precio"]);
            echo var_dump($aux);
            return $aux;
        }
    }

    public function CriterioBusqueda()
    {
        return $this->_CodigoBarras;
    }
    /**
     * Modifica el stock del producto segun el tipo de operacion comercial (Vendida = false | Comprada = true)
     * Si el producto esta siendo comprado, el stock se suma.
     * si esta siendo vendida, se resta. A menos que sea mayor o igual al stock actual.
     */
    public function ModificarStock($cantidad, bool $comprada)
    {
        if ($comprada) {
            return $this->_Stock += $cantidad;
        } else if ($this->_Stock == $cantidad || $this->_Stock < $cantidad) {
            $this->_Stock = 0;
            return true;
        } else {
            return $this->_Stock -= $cantidad;
        }
        return false;
    }

    public function ToArray($arrayProductos)
    {
        $array = array();
        foreach ($arrayProductos as $producto) {
            array_push($array, $producto->OneToArray());
        }
        return $array;
    }
}
