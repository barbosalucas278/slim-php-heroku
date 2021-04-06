<?php

define("RUTA", "./registros.csv");

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

    public function GetMail()
    {
        return $this->_Mail;
    }
    public function GetClave()
    {
        return $this->_Clave;
    }
    public function MostrarDatos()
    {
        return "$this->_Nombre\n $this->_Clave\n $this->_Mail\n";
    }

    private function ToCvs()
    {
        $datos = "$this->_Nombre,$this->_Clave,$this->_Mail\n";
        return $datos;
    }

    public function GuardarUsuario()
    {
        $ret = false;
        $archivo = fopen(RUTA, "a");
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

    public static function LeerUsuarios($ruta = RUTA)
    {
        $archivo = fopen($ruta, "r");
        if ($archivo != null) {
            $datos = array();
            while (!feof($archivo)) {
                $aux = fgets($archivo);
                $lectura = explode(",", $aux);
                if (isset($lectura[0]) && !empty($lectura[0]) && isset($lectura[1]) && !empty($lectura[1]) && isset($lectura[2]) && !empty($lectura[2])) {

                    $usuario = new Usuario($lectura[0], $lectura[1], $lectura[2]);
                    if (!is_null($usuario)) {
                        array_push($datos, $usuario);
                    }
                }
            }
            fclose($archivo);
            return $datos;
        }
        return false;
    }

    public static function ListarUsuarios($listado)
    {
        $salida = "";
        foreach ($listado as $usuario) {

            $salida .= $usuario->MostrarDatos();
        }
        return $salida;
    }
}
