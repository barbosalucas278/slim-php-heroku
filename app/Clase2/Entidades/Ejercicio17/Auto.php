<?php

class Auto
{
    private $_color;
    private $_precio;
    private $_marca;
    private $_fecha;

    public function __construct($marca, $color, $precio, $fecha)
    {

        if (!is_null($marca) && is_string($marca) && !is_null($color) && is_string($color)) {
            $this->_color = $color;
            $this->_marca = $marca;

            if (!is_null($precio) && is_double($precio)) {
                $this->_precio = $precio;
            } else {
                $this->_precio = 1000;
            }

            if (!is_null($fecha) && is_a($fecha, "DateTime")) {
                $this->_fecha = $fecha;
            } else {
                $this->_fecha = new DateTime('now');
            }
        }
    }
    public function GetMarca()
    {
        return $this->_marca;
    }
    public function GetPrecio()
    {
        return $this->_precio;
    }
    public function GetColor()
    {
        return $this->_color;
    }
    public function GetFecha()
    {
        return date_format($this->_fecha, "d-m-y");
    }
    public function AgergarImpuestos($aumento)
    {
        if (is_double($aumento)) {
            $this->_precio += $aumento;
        } else {
            echo "El importe de aumento es incorrecto";
        }
    }

    public static function MostrarAuto($auto)
    {
        if (is_null($auto) || !isset($auto)) {
            echo "Auto no ingresado";
        } else if (is_a($auto, "Auto")) {
            echo "Marca: " . $auto->GetMarca() . "</br>";
            echo "Precio: " . $auto->GetPrecio() . "</br>";
            echo "Color: " . $auto->GetColor() . "</br>";
            echo "Fecha: " . $auto->GetFecha() . "</br>";
        } else {
            echo "no es un auto";
        }
    }

    public function Equals($auto)
    {
        $return = false;
        if (is_a($auto, "Auto") && !is_null($auto)) {
            if ($auto->GetMarca() == $this->GetMarca()) {
                $return = true;;
            }
        }
        return $return;
    }

    public static function Add($auto1, $auto2)
    {
        $return = 0;
        if ($auto1->Equals($auto2) && $auto1->GetColor() == $auto2->GetColor()) {
            $return = $auto1->GetPrecio() + $auto2->GetPrecio();
        }
        return $return;
    }
}
