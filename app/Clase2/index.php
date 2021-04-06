<?php
require "Entidades/Ejercicio18/Auto.php";
require "Entidades/Ejercicio18/Garage.php";

$auto1 = new Auto("Renault", "Rojo", 1200, new DateTime("13-12-2021"));
$auto2 = new Auto("Fiat", "Azul", 1050, new DateTime("12-12-2021"));

$auto3 = new Auto("Audi", "Rojo", 1050, new DateTime("12-12-2021"));
$auto4 = new Auto("Audi", "Rojo", 1050, new DateTime("12-12-2021"));

$fecha = null;
$precio = null;
$auto5 = new Auto("Renault", "Rojo", $precio, $fecha);

$auto3->AgergarImpuestos(1500.5);
$auto4->AgergarImpuestos(1500.50);
$auto5->AgergarImpuestos(1500.50);

$garage = new Garage("pepito");

$garage->Add($auto1);
$garage->Add($auto2);
$garage->Add($auto3);
$garage->Add($auto4);

$garage->MostrarGarage();

echo "</br>";

$garage->Remove($auto1);
$garage->Remove($auto1);

$garage->MostrarGarage();
