<?php

class Usuario
{
    private $_Nombre;
    private $_Clave;
    private $_Mail;

    public function __construct($nombre, $clave, $mail)
    {
        $this->_Nombre = $nombre;
        $this->_Clave = $clave;
        $this->_Mail = $mail;
    }

    private function ToCvs()
    {
        $datos = "$this->_Nombre,$this->_Clave,$this->_Mail\n";
        return $datos;
    }

    public function GuardarUsuario($ruta)
    {
        $ret = false;
        $archivo = fopen($ruta, "a");
        if ($archivo != null) {
            $datos = $this->ToCvs();
            if (fwrite($archivo, $datos,)) {
                if (fclose($archivo)) {
                    return $ret = true;
                }
            }
            return $ret;
        }
        return $ret;
    }
}
