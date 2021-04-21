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
