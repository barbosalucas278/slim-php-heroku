<?php
/*
Nombre: Lucas Barbosa
Curso: 3°D
Aplicación No 10 (Arrays de Arrays)
Realizar las líneas de código necesarias para generar un Array asociativo y otro indexado que
contengan como elementos tres Arrays del punto anterior cada uno. Crear, cargar y mostrar los
Arrays de Arrays.
*/

/**Sin querer hice el ejercicio 10 en el ejercicio 9 */

/**Datos Headcodeados */
$color = array(1 => "rojo", 2 => "azul", 3 => "amarillo", 4 => "verde", 0 => "negro");
$marca = array(0 => "Bic", 1 => "Faber", 2 => "Chirulo");
$trazo = array(0 => "fino", 1 => "mediano", 2 => "grueso");

$lapiceras = array();
$cantidadDeLApiceras = 3;
for ($i = 0; $i < $cantidadDeLApiceras; $i++) {
    $lapiceras[$i] = array("color" => $color[rand(0, 4)], "marca" => $marca[rand(0, 2)], "trazo" => $trazo[rand(0, 2)], "precio" => rand(10, 30));
}

foreach ($lapiceras as $lapi) {
    foreach ($lapi as $key => $value) {
        echo "$key $value </br>";
    }
    echo "</br>";
}
