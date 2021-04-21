<?php
require_once "ProductoPDO.php";
class Producto
{
    private $_Codigo;
    private $_Nombre;
    private $_Tipo;
    private $_Stock;
    private $_Precio;
    private $_FechaCreacion;
    public function __construct($codigo, $nombre, $tipo, $stock, $precio)
    {
        $this->_Codigo = $codigo;
        $this->_Nombre = $nombre;
        $this->_Tipo = $tipo;
        $this->_Stock = $stock;
        $this->_Precio = $precio;
        $this->_FechaCreacion = date("y-m-d h:i:s");
    }

    public function GetCodigo()
    {
        return $this->_Codigo;
    }
    public function GetStock()
    {
        return $this->_Stock;
    }
    public function GetTipo()
    {
        return $this->_Tipo;
    }
    public function GetPrecio()
    {
        return $this->_Precio;
    }
    public function GetFechaCreacion()
    {
        return $this->_FechaCreacion;
    }
    public function Alta()
    {
        try {
            $productoPDO = ProductoPDO::FindByCodigo($this->GetCodigo());
            if (!$productoPDO) {
                $productoPDO = new ProductoPDO();
                $productoPDO->Codigo = $this->_Codigo;
                $productoPDO->Nombre = $this->_Nombre;
                $productoPDO->Tipo = $this->_Tipo;
                $productoPDO->Stock = $this->_Stock;
                $productoPDO->Precio = $this->_Precio;
                $productoPDO->FechaCreacion = $this->_FechaCreacion;
                if ($productoPDO->GuardarProducto()) {
                    return "Ingresado";
                }
            } else {
                $productoPDO->Stock = $this->GetStock();
                if ($productoPDO->Modificar()) {
                    return "Actualizado";
                }
            }
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), 9, $ex);
        }
    }
}
