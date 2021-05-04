<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once '../vendor/autoload.php';
require_once './Clases/AccesoDatos.php';
require_once './Clases/UsuarioAPI.php';


$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;


$app = new \Slim\App(["settings" => $config]);

/*LLAMADA A METODOS DE INSTANCIA DE UNA CLASE*/
$app->group('/usuario', function () {

  $this->get('/', \UsuarioAPI::class . ':traerTodos');

  $this->get('/{id}', \UsuarioAPI::class . ':traerUno');

  $this->post('/', \UsuarioAPI::class . ':CargarUno');

  $this->delete('/', \UsuarioAPI::class . ':BorrarUno');

  $this->put('/', \UsuarioAPI::class . ':ModificarUno');
});

$app->run();
