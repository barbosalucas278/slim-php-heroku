<?php

/**Aplicación No 11 (Potencias de números)
Mostrar por pantalla las primeras 4 potencias de los números del uno 1 al 4 (hacer una función
que las calcule invocando la función pow). */
function CalcularPotencias()
{
    for ($i = 1; $i < 5; $i++) {
        echo "Numero :$i </br>";
        for ($j = 0; $j < 4; $j++) {
            $resultado = pow($i, $j);
            echo "$resultado </br>";
        }
    }
}
