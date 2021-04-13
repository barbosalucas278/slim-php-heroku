<?php
require_once "./Entidades/Interfaces/IEntidad.php";
abstract class Entidad implements IEntidad
{
    //
    //  PROPIEDADES
    //
    protected $_Id;

    //
    //  CONSTRUCTOR
    //
    public function __construct($id)
    {
        $this->_Id = $id;
    }
    //
    //  GETTERS Y SETTERS
    //
    /**
     * Retorna el Id.
     */
    public function GetId()
    {
        return $this->_Id;
    }
    /**
     * Asigna un Id.
     */
    public function SetId($id)
    {
        $this->_Id = $id;
    }
    //
    // METODOS
    //

    /**
     * FUncion para establecer el criterio de busqueda.
     */
    public abstract function CriterioBusqueda();
    /**
     * Funcion para poder mapear un array asociativo en un objeto de tipo Entidad.    
     */
    public function Mapear($dato)
    {
        if (isset($dato["id"]) && !empty($dato["id"])) {
            return new Entidad($dato["id"]);
        }
    }
    /**
     * Retorna los datos de una Entidad como string.
     */
    public function ToString()
    {
        return $this->_Id;
    }
    /**
     * Retorna el objeto de isntancia Entidad como un array asociativo.
     */
    public function OneToArray()
    {
        return array("id" => $this->GetId());
    }
    /**
     * Recibe un array de Entidad y lo convierte en un array asociativo.
     */
    public function ToArray($lista)
    {
        $array = array();
        foreach ($lista as $entidad) {
            array_push($array, $entidad->OneToArray());
        }
        return $array;
    }
    /**
     * Genera un Id aleatoriamente entre 1 y 100000.
     */
    public static function GenerarId()
    {
        return rand(1, 100000);
    }
}
