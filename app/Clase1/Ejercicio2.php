<?php
/*
Alumno: Lucas Barbosa
Curso: 3°D
Ejercicio:
Aplicación No 2 (Mostrar fecha y estación)
Obtenga la fecha actual del servidor (función date) y luego imprímala dentro de la página con
distintos formatos (seleccione los formatos que más le guste). Además indicar que estación del
año es. Utilizar una estructura selectiva múltiple.
*/

$fechaActual = date("d-m-y H:m:s");
echo "$fechaActual </br>";

$fechaActual = date("D-M-Y H:m:s");
echo "$fechaActual </br>";

$mesActual = date("m");
$diaActual = date("d");

switch ($mesActual) {
    case 12:
        if ($diaActual < 21) {
            echo "Primavera";
        } else {
            echo "Verano";
        }
        break;
    case 1:
    case 2:
        echo "Verano";
    case 3:
        if ($diaActual < 21) {
            echo "Verano";
        } else {
            echo "Otoño";
        }
        break;
    case 4:
    case 5:
        echo "Otoño";
        break;
    case 6:
        if ($diaActual < 21) {
            echo "Otoño";
        } else {
            echo "Invierno";
        }
        break;
    case 7:
    case 8:
        echo "Invierno";
        break;
    case 9:
        if ($diaActual < 21) {
            echo "Invierno";
        } else {
            echo "Primavera";
        }
        break;
    case 10:
    case 11:
        echo "Primavera";
        break;
}
