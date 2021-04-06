<?php

require_once "Punto.php";

class Rectangulo
{
    private $_Vertice1;
    private $_Vertice2;
    private $_Vertice3;
    private $_Vertice4;

    public $area;
    public $ladoDos;
    public $ladoUno;
    public $perimetro;

    public function __construct($v1, $v3)
    {
        $this->_Vertice1 = $v1;
        $this->_Vertice3 = $v3;
        $this->_Vertice2 = new Punto($v1->GetY(), $v3->GetX());
        $this->_Vertice4 = new Punto($v1->GetX(), $v3->GetY());
        $this->CalcularDatos();
    }

    public function ToString()
    {
        echo "El area del rectangulo es: $this->area </br>";
        echo "El perimetro del rectangulo es: $this->perimetro </br>";
        echo "El lado uno del rectangulo es: $this->ladoUno </br>";
        echo "El lado dos del rectangulo es: $this->ladoDos </br>";
        $this->Dibujar();
    }
    private function CalcularDatos()
    {
        $this->ladoUno = $this->_Vertice1->GetY();
        $this->ladoDos = $this->_Vertice3->GetX();
        $this->area = $this->ladoUno * $this->ladoDos;
        $this->perimetro = ($this->ladoUno + $this->ladoDos) * 2;
    }
    public function Dibujar()
    {
        for ($i = 0; $i < $this->ladoUno; $i++) {
            for ($j = 0; $j < $this->ladoDos; $j++) {
                echo "<span>*</span>";
            }
            echo "</br>";
        }
    }
}
