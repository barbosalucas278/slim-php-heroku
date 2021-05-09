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

    public function MeterDatosEnUsuario($nombre, $apellido, $clave, $mail, $localidad, $fechaDeRegistro = null)
    {
        $this->Nombre = $nombre;
        $this->Apellido = $apellido;
        $this->Clave = $clave;
        $this->Mail = $mail;
        $this->Localidad = $localidad;
        $this->FechaDeRegistro = $fechaDeRegistro;
    }
    public function SetNombre($nombre)
    {
        if (isset($nombre)) {
            $this->Nombre = $nombre;
        }
    }
    public function SetApellido($apellido)
    {
        if (isset($apellido)) {
            $this->Apellido = $apellido;
        }
    }
    public function SetClave($clave)
    {
        if (isset($clave)) {
            $this->Clave = $clave;
        }
    }
    public function SetMail($mail)
    {
        if (isset($mail)) {
            $this->Mail = $mail;
        }
    }
    public function SetLocalidad($localidad)
    {
        if (isset($localidad)) {
            $this->Localidad = $localidad;
        }
    }
    public function GetClave()
    {
        return $this->Clave;
    }
    public function GetMail()
    {
        return $this->Mail;
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
    public static function ModificarUsuario($usuarioModificado, $id)
    {
        try {
            if ($usuarioDB = Usuario::FindById($id)) {
                $usuarioDB->SetNombre($usuarioModificado->Nombre);
                $usuarioDB->SetApellido($usuarioModificado->Apellido);
                $usuarioDB->SetMail($usuarioModificado->Mail);
                $usuarioDB->SetLocalidad($usuarioModificado->Localidad);
                $acceso = AccesoDatos::GetAccesoDatos();
                $consulta = $acceso->RetornarConsulta("UPDATE usuario SET
                Nombre = :nombre,
                Apellido = :apellido,
                Clave = :clave,
                Mail = :mail,
                Localidad = :localidad WHERE Id = :id");
                $consulta->bindValue(':id', $id, PDO::PARAM_INT);
                $consulta->bindValue(':nombre', $usuarioModificado->Nombre, PDO::PARAM_STR);
                $consulta->bindValue(':apellido', $usuarioModificado->Apellido, PDO::PARAM_STR);
                $consulta->bindValue(':clave', $usuarioModificado->Clave, PDO::PARAM_STR);
                $consulta->bindValue(':mail', $usuarioModificado->Mail, PDO::PARAM_STR);
                $consulta->bindValue(':localidad', $usuarioModificado->Localidad, PDO::PARAM_STR);
                return $consulta->execute();
            }
        } catch (Exception $ex) {
            throw new Exception("No se pudo modificar, " . $ex->getMessage(), 0, $ex);
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
            $usuarioEncontrado = $consulta->fetchObject('Usuario');
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
            $usuarioEncontrado = $consulta->fetchObject('Usuario');
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
            $array = $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");
            if (is_null($array)) {
                return false;
            }
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
            $consulta = $acceso->RetornarConsulta("INSERT INTO usuario(Nombre, Apellido, Clave, Mail, Fecha_De_Registro,Localidad) 
            VALUES (:nombre,:apellido,:clave,:mail,:fecha_de_registro,:localidad);");
            $consulta->bindValue(':nombre', $this->Nombre, PDO::PARAM_STR);
            $consulta->bindValue(':apellido', $this->Apellido, PDO::PARAM_STR);
            $consulta->bindValue(':clave', $this->Clave, PDO::PARAM_STR);
            $consulta->bindValue(':mail', $this->Mail, PDO::PARAM_STR);
            $consulta->bindValue(':fecha_de_registro', $this->FechaDeRegistro, PDO::PARAM_STR);
            $consulta->bindValue(':localidad', $this->Localidad, PDO::PARAM_STR);
            return $consulta->execute();
        } catch (Exception $th) {
            throw new Exception("No agrego correctamente " . $th->getMessage() . $this->Clave, 1, $th);
        }
    }

    public static function BorrarUsuario($id)
    {
        try {
            if (Usuario::FindById($id)) {
                $acceso = AccesoDatos::GetAccesoDatos();
                $consulta = $acceso->RetornarConsulta("DELETE FROM usuario WHERE id = :id");
                $consulta->bindValue(':id', $id, PDO::PARAM_INT);
                return $consulta->execute();
            } else {
                throw new Exception("No se encontro el usuario");
            }
        } catch (Exception $ex) {
            throw new Exception("No se pudo borrar el usuario, " . $ex->getMessage(), 0, $ex);
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
