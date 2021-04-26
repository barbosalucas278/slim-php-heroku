<?php
require_once "AccesoDatos.php";
class Usuario
{
    public $Id;
    public $Nombre;
    public $Apellido;
    public $Clave;
    public $Mail;
    public $FechaDeRegistro;
    public $Localidad;

    public function __construct()
    {
    }

    public static function GetAll()
    {
        try {
            $acceso = AccesoDatos::GetAccesoDatos();
            $arrayUsuarios = array();
            $consulta = $acceso->RetornarConsulta("SELECT id AS Id,
                nombre AS Nombre,
                apellido AS Apellido,
                clave AS Clave,
                mail AS Mail,
                fecha_de_registro AS FechaDeRegistro,
                localidad AS Localidad FROM usuario");
            $consulta->execute();
            $array = $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");
            foreach ($array as $usuario) {
                array_push($arrayUsuarios, $usuario);
            }
            return $arrayUsuarios;
        } catch (Exception $th) {
            throw new Exception("No se pudo cargar la lista", 2, $th);
        }
    }
    public static function GetByApellido($apellido)
    {
        try {
            $acceso = AccesoDatos::GetAccesoDatos();
            $arrayUsuarios = array();
            $consulta = $acceso->RetornarConsulta("SELECT 
                id AS Id,
                nombre AS Nombre,
                apellido AS Apellido,
                clave AS Clave,
                mail AS Mail,
                fecha_de_registro AS FechaDeRegistro,
                localidad AS Localidad FROM usuario 
                WHERE apellido LIKE :apellido;");
            $apellido .= "%";
            $consulta->bindValue("apellido", $apellido, PDO::PARAM_STR);
            $consulta->execute();
            $array = $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");
            foreach ($array as $usuario) {
                array_push($arrayUsuarios, $usuario);
            }
            return $arrayUsuarios;
        } catch (Exception $th) {
            throw new Exception("No se pudo cargar la lista", 2, $th);
        }
    }
    /**
     * @param bool $asc ordena de manera ascendente, false de manera descendente.
     */
    public static function GetUsuariosOrderByApellido($asc = true)
    {
        $orderBy = "ORDER BY apellido ASC, nombre ASC;";
        if (!$asc) {
            $orderBy = "ORDER BY apellido DESC, nombre DESC;";
        }
        try {
            $acceso = AccesoDatos::GetAccesoDatos();
            $arrayUsuarios = array();
            $consulta = $acceso->RetornarConsulta("SELECT id AS Id,
                nombre AS Nombre,
                apellido AS Apellido,
                clave AS Clave,
                mail AS Mail,
                fecha_de_registro AS FechaDeRegistro,
                localidad AS Localidad FROM usuario $orderBy");
            $consulta->execute();
            $array = $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");
            foreach ($array as $usuario) {
                array_push($arrayUsuarios, $usuario);
            }
            return $arrayUsuarios;
        } catch (Exception $th) {
            throw new Exception("No se pudo cargar la lista", 2, $th);
        }
    }
    public static function ListarUsuarios($listado)
    {
        $salida = "<ul>";
        foreach ($listado as $usuario) {

            $salida .= "<li>" . $usuario->MostrarDatos() . "</li>";
        }
        return $salida . "</ul>";
    }
    public function MostrarDatos()
    {
        return "$this->Nombre,$this->Apellido,$this->Clave,$this->Mail,$this->FechaDeRegistro,$this->Localidad";
    }
}
