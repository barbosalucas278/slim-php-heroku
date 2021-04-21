<?php
require_once "AccesoDatos.php";
class Usuario
{
    private $_Id;
    private $_Nombre;
    private $_Apellido;
    private $_Clave;
    private $_Mail;
    private $_FechaDeRegistro;
    private $_Localidad;

    public function __construct($id = null, $nombre, $apellido, $clave, $mail, $localidad)
    {
        $this->_Id = $id;
        $this->_Nombre = $nombre;
        $this->_Apellido = $apellido;
        $this->_Clave = $clave;
        $this->_Mail = $mail;
        $this->_FechaDeRegistro = date("y-m-d h:m:s");
        $this->_Localidad = $localidad;
    }

    public function GuardarUsuario()
    {
        try {
            $acceso = AccesoDatos::GetAccesoDatos();
            $consulta = $acceso->RetornarConsulta("INSERT INTO usuario(Nombre, Apellido, Clave, Mail, Fecha_De_Registro,localidad) 
            VALUES (:nombre,:apellido,:clave,:mail,:fecha_de_modificacion,:localidad);");
            $consulta->bindValue(':nombre', $this->_Nombre, PDO::PARAM_STR);
            $consulta->bindValue(':apellido', $this->_Apellido, PDO::PARAM_STR);
            $consulta->bindValue(':clave', $this->_Clave, PDO::PARAM_STR);
            $consulta->bindValue(':mail', $this->_Mail, PDO::PARAM_STR);
            $consulta->bindValue(':fecha_de_modificacion', $this->_FechaDeRegistro, PDO::PARAM_STR);
            $consulta->bindValue(':localidad', $this->_Localidad, PDO::PARAM_STR);
            $consulta->execute();
            return true;
        } catch (Exception $th) {
            throw new Exception("No agrego correctamente", 1, $th);
        }
    }
}
