<?php
require_once "Usuario.php";
require_once "Validacion.php";
require_once "./Clases/Interfaces/IApiUsable.php";
class UsuarioAPI extends Usuario implements IApiUsable
{
    public function TraerUno($request, $response, $args)
    {
        try {

            $id = $args["id"];
            $datos = Usuario::FindById($id);
            if (!$datos) {
                $datosError = ["Error" => $datos];
                return $newResponse = $response->withJson($datosError, 404);
            }
            $newResponse = $response->withJson($datos, 200);
            return $newResponse;
        } catch (Exception $ex) {
            $error = $ex->getMessage();
            $datosError = ["Error" => $error];
            return $newResponse = $response->withJson($datosError, 500);
        }
    }
    public function TraerTodos($request, $response, $args)
    {
        try {

            $datos = Usuario::GetAll();
            if (!$datos) {
                $datosError = ["Error" => $datos];
                return $newResponse = $response->withJson($datosError, 404);
            }
            $newResponse = $response->withJson($datos, 200);
            return $newResponse;
        } catch (Exception $ex) {
            $error = $ex->getMessage();
            $datosError = ["Error" => $error];
            return $newResponse = $response->withJson($datosError, 500);
        }
    }
    public function CargarUno($request, $response, $args)
    {
        $datosIngresados = $request->getParsedBody();
        if (
            !isset($datosIngresados["nombre"]) || !isset($datosIngresados["apellido"]) || !isset($datosIngresados["clave"]) ||
            !Validacion::EsMail($datosIngresados["mail"]) || !isset($datosIngresados["mail"]) || !isset($datosIngresados["localidad"])
        ) {
            $error = ["Error" => "Datos incompletos"];
            return $response->withJson($error, 400);
        }
        try {
            $nombre = $datosIngresados["nombre"];
            $apellido = $datosIngresados["apellido"];
            //para comparar en hash usamos password_verify(pass, passIngresada)
            $clave = password_hash($datosIngresados["clave"], PASSWORD_DEFAULT);
            $mail = $datosIngresados["mail"];
            $localidad = $datosIngresados["localidad"];
            $fechaDeRegistro = date("y-m-d");
            $newUsuario = new Usuario();
            $newUsuario->MeterDatosEnUsuario($nombre, $apellido, $clave, $mail, $localidad, $fechaDeRegistro);
            if ($newUsuario->GuardarUsuario()) {
                $newResponse = ["Resultado" => "Agregado"];
            }
            return $response->withJson($newResponse, 200);
        } catch (Exception $ex) {
            $error = $ex->getMessage();
            $datosError = ["Error" => $error];
            return $newResponse = $response->withJson($datosError, 500);
        }
    }
    public function BorrarUno($request, $response, $args)
    {
        $datosIngresados = $request->getParsedBody();
        if (!isset($datosIngresados["id"])) {
            $error = ["Error" => "Datos incompletos"];
            return $response->withJson($error, 400);
        }
        try {
            $id = $datosIngresados["id"];
            if (Usuario::BorrarUsuario($id)) {
                $resultado = ["Resultado" => "Borrado con exito"];
                return $response->withJson($resultado, 200);
            }
        } catch (Exception $ex) {
            $error = $ex->getMessage();
            $datosError = ["Error" => $error];
            return $newResponse = $response->withJson($datosError, 500);
        }
    }
    public function Login($request, $response, $args)
    {
        $datosIngresados = $request->getParsedBody();
        if (!isset($datosIngresados["clave"]) && !Validacion::EsMail($datosIngresados["mail"])) {
            $error = ["Error" => "Datos incompletos"];
            return $response->withJson($error, 400);
        }
        try {
            $clave = $datosIngresados["clave"];
            $mail = $datosIngresados["mail"];
            $listado = Usuario::GetAll();
            if (!is_null($listado)) {
                foreach ($listado as $usuario) {
                    if ($usuario->GetMail() == $mail) {
                        if ($clave == $usuario->GetClave()) {
                            return $response->withJson($usuario, 200);
                        } else {
                            throw new Exception("La contraseña es incorrecta" . $usuario->GetClave(), 0);
                        }
                    }
                }
                throw new Exception("El mail no existe", 0);
            }
        } catch (Exception $ex) {
            throw new Exception("Ocurrio un problema al logear " . $ex->getMessage(), 0, $ex);
        }
    }
    public function ModificarUno($request, $response, $args)
    {
        $datosIngresados = $request->getParsedBody();
        if (!isset($datosIngresados["id"])) {
            $error = ["Error" => "Datos incompletos"];
            return $response->withJson($error, 400);
        }
        try {
            $id = $datosIngresados["id"];
            $nombreNuevo = $datosIngresados["nombre"];
            $apellidoNuevo = $datosIngresados["apellido"];
            $mailNuevo = $datosIngresados["mail"];
            $localidadNuevo = $datosIngresados["localidad"];
            $claveNueva = $datosIngresados["clave"];
            $usuarioModificado = new Usuario;
            $usuarioModificado->MeterDatosEnUsuario($nombreNuevo, $apellidoNuevo, $claveNueva, $mailNuevo, $localidadNuevo);
            if (Usuario::ModificarUsuario($usuarioModificado, $id)) {
                $resultado = ["Resultado" => "Modificado con exito"];
                return $response->withJson($resultado, 200);
            }
        } catch (Exception $ex) {
            $error = $ex->getMessage();
            $datosError = ["Error" => $error];
            return $response->withJson($datosError, 500);
        }
    }
}
