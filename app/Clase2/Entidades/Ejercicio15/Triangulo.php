<?php
include_once "FiguraGeometrica.php";

class Triangulo extends FiguraGeometrica
{
    public $_altura;
    public $_base;

    public function __construct($altura, $base, $color)
    {
        parent::__construct();
        $this->_altura = $altura;
        $this->_base = $base;
        $this->CalcularDatos();
        $this->SetColor($color);
    }

    protected function CalcularDatos()
    {
        $this->_superficie = ($this->_base * $this->_altura) / 2;
        $this->_perimetro = ($this->_base + $this->_altura * 2);
    }
    public function ToString()
    {
        parent::ToString();
        $this->Dibujar();
    }
    public function Dibujar()
    {
        $cantidadEspacios = $this->_base - 1;
        for ($i = 0; $i < $this->_altura; $i++) {
            for ($j = 0; $j < $cantidadEspacios; $j++) {
                echo "<span>&nbsp</span>";
            }
            for ($u = 0; $u < $this->_base - $cantidadEspacios; $u++) {
                echo "<span style=\"color :" . $this->GetColor() . "\">*</span>";
            }
            $cantidadEspacios--;
            echo "</br>";
        }
    }
}
