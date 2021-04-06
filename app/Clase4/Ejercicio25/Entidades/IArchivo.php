<?php

interface IArchivo
{
    public static function Leer($ruta);
    public static function Guardar($elementos, $ruta);
    public static function Listar($listado);
    public static function Consultar($elemento, $lista);
    public static function Modificar($listaElementos, $elemento);
}
