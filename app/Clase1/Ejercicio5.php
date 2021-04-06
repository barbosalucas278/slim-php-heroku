<?php
/*
Nombre: Lucas Barbosa
Curso: 3°D
Aplicación No 5 (Números en letras)
Realizar un programa que en base al valor numérico de una variable $num, pueda mostrarse
por pantalla, el nombre del número que tenga dentro escrito con palabras, para los números
entre el 20 y el 60.
Por ejemplo, si $num = 43 debe mostrarse por pantalla “cuarenta y tres”.
*/


/* FUNCIONA CON TODOS LOS NUMEROS de 0 al 99*/

$num = 43;
if ($num < 10) {
    $unidad = $num;
    $decena = 0;
} else {
    $unidad = $num % 10;
    $decena = $num / 10 - ($unidad / 10);
}

if ($num >= 20 && $num <= 60) {


    switch ($decena) {
        case 0:
            echo "";
            break;
        case 1:
            if ($unidad == 0) {
                echo "diez";
            } else {
                switch ($unidad) {
                    case 1:
                        echo "once";
                        break;
                    case 2:
                        echo "doce";
                        break;
                    case 3:
                        echo "trece";
                        break;
                    case 4:
                        echo "catorce";
                        break;
                    case 5:
                        echo "quince";
                        break;
                    default:
                        echo "dieci";
                        break;
                }
            }
            break;
        case 2:
            if ($unidad == 0) {
                echo "veinte";
            } else {
                echo "venti";
            }
            break;
        case 3:
            if ($unidad == 0) {
                echo "treinta";
            } else {
                echo "treinta y ";
            }
            break;
        case 4:
            if ($unidad == 0) {
                echo "cuarenta";
            } else {
                echo "cuarenta y ";
            }
            break;
        case 5:
            if ($unidad == 0) {
                echo "cincuenta";
            } else {
                echo "cincuenta y ";
            }
            break;
        case 6:
            if ($unidad == 0) {
                echo "sesenta";
            } else {
                echo "sesenta y ";
            }
            break;
        case 7:
            if ($unidad == 0) {
                echo "setenta";
            } else {
                echo "setenta y ";
            }
            break;
        case 8:
            if ($unidad == 0) {
                echo "ochenta";
            } else {
                echo "ochenta y ";
            }
            break;
        case 9:
            if ($unidad == 0) {
                echo "noventa";
            } else {
                echo "noventa y ";
            }
            break;
    }

    switch ($unidad) {
        case 0:
            if ($decena == 0) {
                echo "cero";
            } else {
                echo "";
            }
            break;
        case 1:
            echo "uno";
            break;
        case 2:
            echo "dos";
            break;
        case 3:
            echo "tres";
            break;
        case 4:
            echo "cuatro";
            break;
        case 5:
            echo "cinco";
            break;
        case 6:
            echo "seis";
            break;
        case 7:
            echo "siete";
            break;
        case 8:
            echo "ocho";
            break;
        case 9:
            echo "nueve";
            break;
    }
} else {
    echo "El numero es incorrecto";
}
