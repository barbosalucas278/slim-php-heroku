<?php
include_once "FiguraGeometrica.php";
class Rectangulo extends FiguraGeometrica
{
    public $_ladoDos;
    public $_ladoUno;

    public function __construct($ladoUno, $ladoDos, $color)
    {
        parent::__construct();
        $this->_ladoUno = $ladoUno;
        $this->_ladoDos = $ladoDos;
        $this->CalcularDatos();
        $this->SetColor($color);
    }

    protected function CalcularDatos()
    {
        $this->_superficie = $this->_ladoUno * $this->_ladoDos;
        $this->_perimetro = ($this->_ladoUno + $this->_ladoDos) * 2;
    }
    public function ToString()
    {
        parent::ToString();
        $this->Dibujar();
    }
    public function Dibujar()
    {
        for ($i = 0; $i < $this->_ladoUno; $i++) {
            for ($j = 0; $j < $this->_ladoDos; $j++) {
                echo "<span style=\"color :" . $this->GetColor() . "\">*</span>";
            }
            echo "</br>";
        }
    }
}
