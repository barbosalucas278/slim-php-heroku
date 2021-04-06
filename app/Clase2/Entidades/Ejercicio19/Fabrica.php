<?php

const MAXIMO_OPERARIOS = 5;

class Fabrica
{
    private $_cantMaxOperarios;
    private $_operarios;
    private $_razonSocial;

    public function __construct($razonSocial)
    {
        $this->_razonSocial = $razonSocial;
        $this->_cantMaxOperarios = MAXIMO_OPERARIOS;
        $this->_operarios = array();
    }
    public function GetOperarios()
    {
        return $this->_operarios;
    }
    private function RetornarCostos()
    {
        $salarios = array();
        foreach ($this->_operarios as $operario) {
            array_push($salarios, $operario->GetSalario());
        }
        return array_sum($salarios);
    }

    private function MostrarOperarios()
    {
        foreach ($this->_operarios as $operario) {
            echo $operario->Mostrar() . "</br>";
        }
    }

    public static function MostrarCosto($fabrica)
    {
        echo $fabrica->RetornarCostos();
    }

    public static function Equals($fabrica, $operario)
    {
        foreach ($fabrica->_operarios as $ope) {
            if ($operario->Equals($ope)) {
                return true;
            }
        }
        return false;
    }

    public function Add($operario)
    {
        if (!Fabrica::Equals($this, $operario) && count($this->_operarios) < $this->_cantMaxOperarios) {
            array_push($this->_operarios, $operario);
        } else {
            echo "No se pudo agregar el operario";
        }
    }

    public function Remove($operario)
    {
        if (Fabrica::Equals($this, $operario)) {
            $indiceOperario = array_search($operario, $this->_operarios);
            unset($this->_operarios[$indiceOperario]);
            if (!Fabrica::Equals($this, $operario)) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function Mostrar()
    {
        echo "Razon social:" . $this->_razonSocial . "</br>";
        echo $this->MostrarOperarios();
    }
}
