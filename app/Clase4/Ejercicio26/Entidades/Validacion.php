<?php

class Validacion
{
    public static function EsMail($mail)
    {
        if (isset($mail)) {
            $regEx = "/\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,6}\b/";
            return preg_match($regEx, $mail);
        }
        return false;
    }

    public static function EsCodigoDeBarras($codigo)
    {
        if (isset($codigo) && is_string($codigo) && strlen($codigo) == 6) {
            $regEx = "/\d/m";
            return preg_match_all($regEx, $codigo);
        }
        return false;
    }
}
