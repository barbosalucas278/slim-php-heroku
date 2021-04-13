<?php
require_once "./Entidades/Interfaces/IComerciable.php";
require_once "Gestor.php";
require_once "Usuario.php";
require_once "Producto.php";

define("RUTA_CLIENTE", "./Usuarios/usuarios.json");
define("RUTA_PRODUCTO", "./Productos/productos.json");
define("RUTA_VENTAS", "./Ventas/ventas.txt");
define("VENDIDA", false);
define("COMPRADA", true);
class PuestoTrabajo implements IComerciable
{
    //
    //  ATRIBUTOS
    //
    private $_Cliente;
    private $_Producto;
    private $_GestorCliente;
    private $_GestorProducto;
    //
    //  CONSTRUCTOR
    //
    public function __construct($codigoProducto, $idCliente)
    {
        $this->_GestorCliente = new Gestor(new Usuario($idCliente), RUTA_CLIENTE);
        $this->_GestorProducto = new Gestor(new Producto($codigoProducto), RUTA_PRODUCTO);
        if ($this->_GestorCliente->GetEntidad() != null && $this->_GestorProducto->GetEntidad() != null) {
            $this->_Producto = $this->_GestorProducto->GetEntidad();
            $this->_Cliente = $this->_GestorCliente->GetEntidad();
        } else {
            return false;
        }
    }
    //
    // METODOS
    //

    /**
     *  Realiza una venta de un producto, cantidad debe ser mayor a 0 y 
     * el producto tiene que haber sido encontrado por el gestor.
     *  
     */
    public function Venta($cantidad)
    {
        if ($cantidad > 0 && $this->_Producto != null) {
            $this->_Producto->ModificarStock($cantidad, VENDIDA);
            $this->_GestorProducto->Modificar($this->_Producto);
            $this->_GestorProducto->Guardar();
            $this->GuardarVenta(Entidad::GenerarId(), $this->_Cliente->GetNombre(), $this->_Producto->GetNombre(), $this->_Producto->GetPrecio(), $cantidad);
            return true;
        }
        return false;
    }

    /**
     * Guarda la informacion de la venta realizada, 
     */
    public function GuardarVenta($nroOperacion, $cliente, $producto, $precio, $cantidad)
    {
        $fecha = date('d-m-y h:i:s');
        $monto = $cantidad * $precio;
        $datos = $nroOperacion . "," . $cliente . "," . $producto . "," . $cantidad . "," . $monto . "," . $fecha . "\n";

        $archivo = fopen(RUTA_VENTAS, "a");
        if (fwrite($archivo, $datos)) {
            fclose($archivo);
        }
    }
}
