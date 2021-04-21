<?php
require_once "AccesoDatos.php";
class UsuarioPDO
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

    public function ModificarClave()
    {
        try {
            $acceso = AccesoDatos::GetAccesoDatos();
            $consulta = $acceso->RetornarConsulta("UPDATE usuario SET 
            clave = '$this->Clave'
            WHERE id = '$this->Id';");
            $consulta->Execute();
            return true;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public static function FindByMailAndNombre($mail, $nombre)
    {
        try {
            $acceso = AccesoDatos::GetAccesoDatos();
            $consulta = $acceso->RetornarConsulta("SELECT 
                id AS Id,
                nombre AS Nombre,
                apellido AS Apellido,
                clave AS Clave,
                mail AS Mail,
                fecha_de_registro AS FechaDeRegistro,
                localidad AS Localidad FROM usuario  WHERE mail = '$mail' AND nombre = '$nombre'");
            $consulta->execute();
            $usuarioEncontrado = $consulta->fetchObject('UsuarioPDO');
            if (isset($usuarioEncontrado)) {
                return $usuarioEncontrado;
            } else {
                throw new Exception("No se encontró el usuario");
            }
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex);
        }
    }

    public static function FindById($id)
    {
        try {
            $acceso = AccesoDatos::GetAccesoDatos();
            $consulta = $acceso->RetornarConsulta("SELECT 
                id AS Id,
                nombre AS Nombre,
                apellido AS Apellido,
                clave AS Clave,
                mail AS Mail,
                fecha_de_registro AS FechaDeRegistro,
                localidad AS Localidad FROM usuario  WHERE id = '$id'");
            $consulta->execute();
            $usuarioEncontrado = $consulta->fetchObject('UsuarioPDO');
            if (isset($usuarioEncontrado)) {
                return $usuarioEncontrado;
            } else {
                throw new Exception("No se encontró el usuario");
            }
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex);
        }
    }
    public static function GetAll()
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
                localidad AS Localidad FROM usuario");
            $consulta->execute();
            $array = $consulta->fetchAll(PDO::FETCH_CLASS, "UsuarioPDO");
            foreach ($array as $usuario) {
                array_push($arrayUsuarios, $usuario);
            }
            return $arrayUsuarios;
        } catch (Exception $th) {
            throw new Exception("No se pudo cargar la lista" . $th->getMessage(), 2, $th);
        }
    }
    public function GuardarUsuario()
    {
        try {
            $acceso = AccesoDatos::GetAccesoDatos();
            $consulta = $acceso->RetornarConsulta("INSERT INTO usuario(Nombre, Apellido, Clave, Mail, Fecha_De_Registro,localidad) 
            VALUES (:nombre,:apellido,:clave,:mail,:fecha_de_registro,:localidad);");
            $consulta->bindValue(':nombre', $this->Nombre, PDO::PARAM_STR);
            $consulta->bindValue(':apellido', $this->Apellido, PDO::PARAM_STR);
            $consulta->bindValue(':clave', $this->Clave, PDO::PARAM_STR);
            $consulta->bindValue(':mail', $this->Mail, PDO::PARAM_STR);
            $consulta->bindValue(':fecha_de_registro', $this->FechaDeRegistro, PDO::PARAM_STR);
            $consulta->bindValue(':localidad', $this->Localidad, PDO::PARAM_STR);
            return $consulta->execute();
        } catch (Exception $th) {
            throw new Exception("No agrego correctamente" . $th->getMessage(), 1, $th);
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
    public static function Login($mail, $clave)
    {
        $respuesta = 0;
        $listado = self::GetAll();
        if (!is_null($listado)) {
            foreach ($listado as $usuario) {
                if ($usuario->GetMail() == $mail) {
                    if ($usuario->GetClave() == $clave) {
                        $respuesta = 1;
                        return $respuesta;
                    } else {
                        $respuesta = -1;
                        break;
                    }
                }
            }
        }
        return $respuesta;
    }
}
