<?php
/*
Nombre: Lucas Barbosa
Curso: 3°D
Aplicación No 7 (Mostrar impares)
Generar una aplicación que permita cargar los primeros 10 números impares en un Array.
Luego imprimir (utilizando la estructura for) cada uno en una línea distinta (recordar que el
salto de línea en HTML es la etiqueta <br/>). Repetir la impresión de los números utilizando
las estructuras while y foreach.
*/

$numerosImpares = array();
$cantidadNumerosImpares = 0;
$i = 0;
$a = 0;
while ($cantidadNumerosImpares < 10) {
    if ($i % 2 != 0) {
        $numerosImpares[$cantidadNumerosImpares] = $i;
        $cantidadNumerosImpares++;
    }
    $i++;
}
echo " FOR</br>";
/*ESTRUCTURA FOR */
for ($i = 0; $i < $cantidadNumerosImpares; $i++) {
    echo "$numerosImpares[$i] </br>";
}
echo " FOREACH</br>";
/*ESTRUCTURA FOREACH */
foreach ($numerosImpares as $num) {
    echo "$num </br>";
}
echo "WHILE</br>";
/*ESTRUCTURA WHILE */

while ($a < 10) {

    echo "$numerosImpares[$a] </br>";

    $a++;
}
