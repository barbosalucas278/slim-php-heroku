<?php
require_once "./Interfaces/ICliente.php";
require_once "./Entidad.php";

class Usuario extends Entidad implements ICliente
{
    //
    //  PROPIEDADES
    //
    private $_Nombre;
    private $_Clave;
    private $_Mail;
    private $_FechaRegistro;

    //
    //  CONSTRUCTOR
    //
    public function __construct($id, $nombre = null, $clave = null, $mail = null)
    {
        $this->_Id = $id;
        $this->_Nombre = $nombre;
        $this->_Clave = $clave;
        $this->_Mail = $mail;
        $this->_FechaRegistro = date('d-m-y h:m');
    }

    //
    //  GETTERS Y SETTERS
    //
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
    public function GetFechaRegistro()
    {
        return $this->_FechaRegistro;
    }
    public function SetNombre($nombre)
    {
        $this->_Nombre = $nombre;
    }
    public function SetClave($clave)
    {
        $this->_Clave = $clave;
    }
    public function SetMail($mail)
    {
        $this->_Mail = $mail;
    }
    public function SetFechaRegistro($fecha)
    {
        $this->_FechaRegistro = $fecha;
    }
    //
    //  MËTODOS DE INSTANCIA
    //
    public function CriterioBusqueda()
    {
        return $this->GetId();
    }
    public function ToString()
    {
        return parent::ToString() . "," . $this->GetNombre() . "," . $this->GetMail() . "," . $this->GetFechaRegistro();
    }
    public function OneToArray()
    {
        return array("id" => $this->_Id, "nombre" => $this->_Nombre, "clave" => $this->_Clave, "mail" => $this->_Mail);
    }
    public function Mapear($dato)
    {
        if (isset($dato["id"]) && !empty($dato["id"]) && isset($dato["nombre"]) && !empty($dato["nombre"]) && isset($dato["clave"]) && !empty($dato["clave"]) && isset($dato["mail"]) && !empty($dato["mail"])) {
            return new Usuario($dato["id"], $dato["nombre"], $dato["clave"], $dato["mail"]);
        }
    }

    public function ToArray($arrayUsuarios)
    {
        $array = array();

        foreach ($arrayUsuarios as $usuario) {
            array_push($array, $usuario->ToArray());
        }
        return $array;
    }
}
