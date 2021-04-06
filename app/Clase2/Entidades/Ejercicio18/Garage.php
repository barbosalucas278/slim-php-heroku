<?php
class Garage
{
    private $_razonSocial;
    private $_precioPorHora;
    private $_autos;

    public function __construct($razonSocial, $precioPorHora = 10)
    {
        $this->_razonSocial = $razonSocial;
        $this->_precioPorHora = $precioPorHora;
        $this->_autos = array();
    }


    public function MostrarGarage()
    {
        echo "Razon social: " . $this->_razonSocial . "</br>";
        echo "Precio por hora: " . $this->_precioPorHora . "</br>";
        echo "Autos: </br>";
        foreach ($this->_autos as $auto) {
            echo Auto::MostrarAuto($auto);
            echo "</br>";
        }
    }

    public function Equals($auto)
    {
        foreach ($this->_autos as $autoEnGarage) {
            if ($auto->Equals($autoEnGarage)) {
                return true;
            }
        }
        return false;
    }
    public function Add(Auto $auto)
    {
        if (!$this->Equals($auto)) {
            array_push($this->_autos, $auto);
        } else {
            echo "El auto ya existe en el garage.</br>";
        }
    }
    public function Remove($auto)
    {
        if ($this->Equals($auto)) {
            $indiceAutoBuscada = array_search($auto, $this->_autos);
            if ($indiceAutoBuscada >= 0) {
                unset($this->_autos[$indiceAutoBuscada]);
            }
        } else {
            echo "El auto no existe en el garage </br>";
        }
    }
}
