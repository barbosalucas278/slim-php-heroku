<?php

/**Aplicación No 12 (Invertir palabra)
Realizar el desarrollo de una función que reciba un Array de caracteres y que invierta el orden
de las letras del Array.
Ejemplo: Se recibe la palabra “HOLA” y luego queda “ALOH”. */

function InvertirPalabra($palabra)
{
    $len = count($palabra);
    $palabraAlReves = array();

    for ($i = 0; $i < $len; $i++) {
        $palabraAlReves[$i] = $palabra[$len - 1 - $i];
        echo $palabraAlReves[$i];
    }
}
