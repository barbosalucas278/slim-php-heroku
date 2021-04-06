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
}
