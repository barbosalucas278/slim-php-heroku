<?php

class Usuario
{
    private $_Id;
    private $_Nombre;
    private $_Clave;
    private $_Mail;
    private $_FechaRegistro;

    public function __construct($id, $nombre, $clave, $mail)
    {
        $this->_Id = $id;
        $this->_Nombre = $nombre;
        $this->_Clave = $clave;
        $this->_Mail = $mail;
        $this->_FechaRegistro = date('dd-mm-yyy hh:mm');
    }
    public function GetId()
    {
        return $this->_Id;
    }
    public function GetNombre()
    {
        return $this->_Nombre;
    }
    public function GetClave()
    {
        return $this->_Clave;
    }
    public function GetMail()
    {
        return $this->_Mail;
    }
    public function GetFechaIngreso()
    {
        return $this->_FechaRegistro;
    }
    public function ToArray()
    {
        return array("id" => $this->_Id, "nombre" => $this->_Nombre, "clave" => $this->_Clave, "mail" => $this->_Mail);
    }

    private static function UsuariosToArray($arrayUsuarios)
    {
        $array = array();

        foreach ($arrayUsuarios as $usuario) {
            array_push($array, $usuario->ToArray());
        }
        return $array;
    }
    private static function MapearUsuarios($dato)
    {
        if (isset($dato["id"]) && !empty($dato["id"]) && isset($dato["nombre"]) && !empty($dato["nombre"]) && isset($dato["clave"]) && !empty($dato["clave"]) && isset($dato["mail"]) && !empty($dato["mail"])) {
            return new Usuario($dato["id"], $dato["nombre"], $dato["clave"], $dato["mail"]);
        }
    }
    public static function GuardarUsuarios($usuarios, $ruta)
    {
        $ret = false;
        $listaUsuarios = self::LeerUsuarios($ruta);
        if ($listaUsuarios) {
            $archivo = fopen($ruta, "w");
            if (isset($archivo)) {
                array_push($listaUsuarios, $usuarios);
                $listaUsuariosArray = Usuario::UsuariosToArray($listaUsuarios);
                $datosJson = json_encode($listaUsuariosArray);
                if (fwrite($archivo, $datosJson)) {
                    if (fclose($archivo)) {
                        return $ret = true;
                    }
                }
                return $ret;
            }
            return $ret;
        } else {
            $archivo = fopen($ruta, "w");
            if (isset($archivo)) {
                $listaUsuariosArray = array($usuarios->ToArray());
                $datosJson = json_encode($listaUsuariosArray);
                if (fwrite($archivo, $datosJson)) {
                    if (fclose($archivo)) {
                        return $ret = true;
                    }
                }
                return $ret;
            }
        }
        return $ret;
    }

    public static function LeerUsuarios($ruta)
    {
        if (file_exists($ruta)) {
            $archivo = fopen($ruta, "r");
            $listaUsuarios = array();
            $tamañoDelArchivo = filesize($ruta);
            if ($tamañoDelArchivo > 0) {
                $lectura = fread($archivo, $tamañoDelArchivo);
                $listaUsuariosArray = json_decode($lectura, true);
                foreach ($listaUsuariosArray as $usu) {
                    $usuario = Usuario::MapearUsuarios($usu);
                    if (!is_null($usuario)) {
                        array_push($listaUsuarios, $usuario);
                    }
                }

                fclose($archivo);
                return $listaUsuarios;
            }
            return false;
        }
        return false;
    }
}
