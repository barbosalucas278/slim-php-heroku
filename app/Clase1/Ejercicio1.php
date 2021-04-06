
<?php
$cantidadDeNumeros = 0;
$numero = 0;

for ($i = 1; $numero <= 1000; $i++) {
    $numero = $numero + $i;
    if ($numero <= 1000) {
        $cantidadDeNumeros++;
        echo "$numero </br>";
    } else {
        break;
    }
}

echo "Cantidad de numeros sumados $cantidadDeNumeros";


?>
