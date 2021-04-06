<?php
require_once "IArchivo.php";

class RegistroManager
{
    private $_Ruta;
    public function __construct($ruta)
    {
        $this->_Ruta = $ruta;
    }
    public function Alta(IArchivo $elemento)
    {
        return $elemento::Guardar($elemento, $this->_Ruta);
    }
}
