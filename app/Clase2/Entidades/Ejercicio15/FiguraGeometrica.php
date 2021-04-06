<?php

abstract class FiguraGeometrica
{
    protected $_color;
    protected $_perimetro;
    protected $_superficie;

    public function __construct()
    {
    }

    public function GetColor()
    {
        return $this->_color;
    }
    public function SetColor($color)
    {
        $this->_color = $color;
    }

    public abstract function Dibujar();
    protected abstract function CalcularDatos();

    public function ToString()
    {
        echo "Color: " . $this->_color . "</br>";
        echo "Perimetro: " . $this->_perimetro . "</br>";
        echo "Superficie: " . $this->_superficie . "</br>";
    }
}
