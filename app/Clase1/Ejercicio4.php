<?php
/*
Nombre: Lucas Barbosa
Curso: 3°D
Aplicación No 4 (Calculadora)
Escribir un programa que use la variable $operador que pueda almacenar los símbolos
matemáticos: ‘+’, ‘-’, ‘/’ y ‘*’; y definir dos variables enteras $op1 y $op2. De acuerdo al
símbolo que tenga la variable $operador, deberá realizarse la operación indicada y mostrarse el
resultado por pantalla.
*/

$operador = "*";

$op1 = 5;
$op2 = 2;

switch ($operador) {
    case '+':
        echo $op1 + $op2;
        break;
    case '-':
        echo $op1 - $op2;
        break;
    case '/':
        if ($op2 == 0) {
            echo "No se puede divir por 0.";
        } else {
            echo $op1 / $op2;
        }
        break;
    case '*':
        echo $op1 * $op2;
        break;
    default:
        echo "ingrese un operador";
        break;
}
