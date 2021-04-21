<?php
require_once "./Clases/Validacion.php";
require_once "./Clases/UsuarioPDO.php";
if (!isset($_POST["nombre"]) && !isset($_POST["claveVieja"]) && !isset($_POST["clave"]) && !Validacion::EsMail($_POST["mail"])) {
    echo "Ingrese datos válidos";
    return http_response_code(400);
}

$claveNueva = $_POST["clave"];
$mail = $_POST["mail"];
$claveVieja = $_POST["claveVieja"];
$nombre = $_POST["nombre"];

try {
    echo ModificacionClaveUsuario($mail, $claveNueva, $claveVieja, $nombre);
} catch (\Throwable $th) {
    echo $th->getMessage();
}

function ModificacionClaveUsuario($mail, $claveNueva, $claveVieja, $nombre)
{
    try {
        $usuario = UsuarioPDO::FindByMailAndNombre($mail, $nombre);
        if ($usuario) {
            if ($usuario->Clave == $claveVieja) {
                $usuario->Clave = $claveNueva;
                if ($usuario->ModificarClave()) {
                    return "Se modifico correctamente";
                }
            } else {
                throw new Exception("La clave no coincide");
            }
        } else {
            throw new Exception("El usuario no existe");
        }
    } catch (Exception $th) {
        throw new Exception($th->getMessage(), 1, $th);
    }
}
