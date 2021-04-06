<?php
/*
Nombre: Lucas Barbosa
Curso: 3°D
Aplicación No 9 (Arrays asociativos)
Realizar las líneas de código necesarias para generar un Array asociativo $lapicera, que
contenga como elementos: ‘color’, ‘marca’, ‘trazo’ y ‘precio’. Crear, cargar y mostrar tres
lapiceras.
*/

/**EJERCICIO 9 CORREGIDO */

/**Datos Hardcodeados */
$color = array(1 => "rojo", 2 => "azul", 3 => "amarillo", 4 => "verde", 0 => "negro");
$marca = array(0 => "Bic", 1 => "Faber", 2 => "Chirulo");
$trazo = array(0 => "fino", 1 => "mediano", 2 => "grueso");

$lapiceras = array();
$cantidadDeLApiceras = 3;
for ($i = 0; $i < $cantidadDeLApiceras; $i++) {
    $lapiceras[$i] = array("color" => $color[rand(0, 4)], "marca" => $marca[rand(0, 2)], "trazo" => $trazo[rand(0, 2)], "precio" => rand(10, 30));
    foreach ($lapiceras[$i] as $key => $value) {
        echo "$key $value </br>";
    }
    echo "</br>";
}

echo "Prueba de que se agregaron las lapiceras al array </br>";

foreach ($lapiceras as $lapicera) {
    foreach ($lapicera as $key => $value) {
        echo "$key $value </br>";
    }
    echo "</br>";
}
