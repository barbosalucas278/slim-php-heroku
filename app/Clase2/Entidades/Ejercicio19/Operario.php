<?php

class Operario
{
    private $_apellido;
    private $_legajo;
    private $_nombre;
    private $_salario;

    public function __construct($legajo, $apellido, $nombre)
    {
        $this->_legajo = $legajo;
        $this->_apellido = $apellido;
        $this->_nombre = $nombre;
        $this->_salario = 45000;
    }

    public function GetLegajo()
    {
        return $this->_legajo;
    }
    public function GetSalario()
    {
        return $this->_salario;
    }

    public function SetAumentarSalario($aumento)
    {
        $this->_salario = $this->GetSalario() + ($this->GetSalario() * ($aumento / 100));
    }

    public function GetNombreApellido()
    {
        return $this->_nombre . "," . $this->_apellido;
    }
    public function Mostrar()
    {
        $datos = "Operario: " . $this->GetNombreApellido() . "</br>Legajo:" . $this->GetLegajo() . " Salario: " . $this->GetSalario();
        return $datos;
    }

    public static function __Mostrar($operario)
    {
        return $operario->Mostrar();
    }

    public function Equals($operario)
    {
        if ($this->GetNombreApellido() == $operario->GetNombreApellido() && $this->GetLegajo() == $operario->GetLegajo()) {
            return true;
        }
        return false;
    }
}
