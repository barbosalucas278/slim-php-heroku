<?php
/*
Nombre: Lucas Barbosa
Curso: 3°D
Aplicación No 6 (Carga aleatoria)
Definir un Array de 5 elementos enteros y asignar a cada uno de ellos un número (utilizar la
función rand). Mediante una estructura condicional, determinar si el promedio de los números
son mayores, menores o iguales que 6. Mostrar un mensaje por pantalla informando el
resultado.
*/

$numeros = array();
$acumulador = 0;
$cantidadDeNumeros = 5;
$rangoMinimo = 0;
$rangoMaximo = 10;

for ($i = 0; $i < $cantidadDeNumeros; $i++) {
    $numeros[$i] = rand($rangoMinimo, $rangoMaximo);
    $acumulador += $numeros[$i];
}


if ($cantidadDeNumeros != 0) {
    $promedio = $acumulador / $cantidadDeNumeros;
    echo $promedio;
    if ($promedio > 6) {
        echo "El promedio es mayor a 6";
    } else if ($promedio < 6) {
        echo "El promedio es menor a 6";
    } else {
        echo "El promedio es igual a 6";
    }
} else {
    echo "La cantidad de números debe ser distinta de cero";
}
