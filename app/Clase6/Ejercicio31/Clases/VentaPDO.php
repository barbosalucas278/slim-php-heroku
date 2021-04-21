<?php
class VentaPDO
{
    public $Id;
    public $IdProducto;
    public $IdUsuario;
    public $Cantidad;
    public $FechaVenta;

    public function __construct()
    {
    }

    public function GuardaVenta()
    {
        try {
            $acceso = AccesoDatos::GetAccesoDatos();
            $consulta = $acceso->RetornarConsulta("INSERT INTO venta(id_producto, id_usuario,cantidad,fecha_de_venta) 
            VALUES (:id_producto,:id_usuario,:cantidad,:fecha_de_venta);");
            $consulta->bindValue(':id_producto', $this->IdProducto, PDO::PARAM_INT);
            $consulta->bindValue(':id_usuario', $this->IdUsuario, PDO::PARAM_INT);
            $consulta->bindValue(':cantidad', $this->Cantidad, PDO::PARAM_INT);
            $consulta->bindValue(':fecha_de_venta', $this->FechaVenta, PDO::PARAM_STR);
            return $consulta->execute();
        } catch (Exception $th) {
            echo $th->getMessage();
            throw new Exception($th->getMessage(), 1, $th);
        }
    }
}
