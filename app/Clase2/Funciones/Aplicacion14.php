<?php

/**Aplicación No 14 (Par e impar)
Crear una función llamada esPar que reciba un valor entero como parámetro y devuelva TRUE
si este número es par ó FALSE si es impar.
Reutilizando el código anterior, crear la función esImpar.*/

function esPar($numero)
{
    if ($numero % 2 == 0) {
        return true;
    }
    return false;
}
function esImpar($numero)
{
    return !esPar(($numero));
}
