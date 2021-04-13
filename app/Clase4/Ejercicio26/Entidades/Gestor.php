<?php
require_once "./Entidades/Interfaces/IArchivo.php";
require_once "Entidad.php";


define("ACTUALIZADO", 1);
define("DESACTUALIZADO", 0);
define("MAX_LENGTH_ARCHIVO", 50000);
class Gestor implements IArchivo
{
    //
    //  PROPIEDADES
    //
    private $_ListaEntidad;
    private $_Ruta;
    private $_Entidad;
    private $_Estado;

    //
    //  CONSTRUCTOR
    //
    public function __construct(Entidad $entidad, $ruta)
    {
        if ($this->SetRuta($ruta) && isset($entidad)) {
            $this->_Entidad = $entidad;
            $this->_ListaEntidad = array();
            $this->Leer();
            $this->_Entidad = $this->BuscarUno($entidad->CriterioBusqueda());
            $this->_Estado = ACTUALIZADO;
        }
    }

    //
    //  GETTERS Y SETTERS
    //
    public function GetEntidad()
    {
        return $this->_Entidad;
    }
    /**
     * Inicializa el atributo _Ruta con la ruta especificada como parametro si esta 
     * existe y si el tamaño no supera el maximo establecido, si no es asi crea el archivo.     
     */
    public function SetRuta($ruta)
    {
        if (file_exists($ruta) && filesize($ruta) < MAX_LENGTH_ARCHIVO) {
            $this->_Ruta = $ruta;
            return true;
        } else {
            $archivoNuevo = fopen($this->_Ruta, "a");
            return fclose($archivoNuevo);
        }
    }
    public function SetListaEntidad($listaEntidades)
    {
        $this->_ListaEntidad = $listaEntidades;
    }
    public function GetListaEntidad()
    {
        return $this->_ListaEntidad;
    }
    public function GetEstado()
    {
        return $this->_Estado;
    }
    public function SetEstado($estado)
    {
        $this->_Estado = $estado;
    }
    //
    //  MÉTODOS DE INSTANCIA
    //

    /**
     * Agrega una Entidad nueva a el atributo _ListaEntidad (array) establece el estado del gestor en DESACTUALIZADO.
     */
    public function Agregar(Entidad $entidad)
    {
        if (isset($entidad)) {
            if (!array_search($entidad, $this->_ListaEntidad)) {
                $this->SetEstado(DESACTUALIZADO);
                return array_push($this->_ListaEntidad, $entidad);
            }
        }
        return false;
    }
    //
    // MÉTODOS IARCHIVO
    //

    /**
     * si el estado es DESACTUALIZADO, Lee un archivo en formato json y retorna una lista de Entidades con los objetos leidos.
     * actualiza el estado a ACTUALIZADO
     * 
     */
    public function Leer()
    {
        $lecturaListaEntidades = null;
        if ($this->GetEstado() == DESACTUALIZADO) {
            $archivo = fopen($this->_Ruta, "r");
            $lecturaListaEntidades = json_decode(fread($archivo, MAX_LENGTH_ARCHIVO), true);
            if (!is_null($lecturaListaEntidades)) {
                foreach ($lecturaListaEntidades as $ent) {
                    $entidadAux = $this->_Entidad->Mapear($ent); //
                    if (isset($entidadAux)) {
                        array_push($this->_ListaEntidad, $entidadAux);
                    }
                }
                $this->SetEstado(ACTUALIZADO);
                fclose($archivo);
            } else {
                return false;
            }
        }
        return "No Leyó, esta actualizado";
    }
    /**
     * SI el estado es ACTUALIZADO, Guarda en un archivo en formato json la lista de entidades 
     * que contenga el atributo _ListaEntidad.
     * Establece el estado a DESACTUALIZADO.
     */
    public function Guardar()
    {
        if ($this->GetEstado() == ACTUALIZADO) {
            $archivo = fopen($this->_Ruta, "w");
            if (isset($archivo)) {
                $listaEntidadesArray = $this->_Entidad->ToArray($this->_ListaEntidad);
                $datosJson = json_encode($listaEntidadesArray);
                if (fwrite($archivo, $datosJson)) {
                    $this->SetEstado(DESACTUALIZADO);
                    return fclose($archivo);
                }
            }
        }
    }
    /**
     * Busca una Entidad en la lista de entidades. y retorna esa entidad si el id coincide 
     * con el criterio de busqueda de la Entidad.
     */
    public function BuscarUno($id)
    {
        if (isset($id) && !empty($id)) {
            foreach ($this->GetListaEntidad() as $ent) {
                if ($ent->CriterioBusqueda() == $id) {
                    return $ent;
                }
            }
        }
        return false;
    }
    /**
     * Si el estado del gestor es ACTUALIZADO, Lista todas las entidades que contenga _ListaEntidad.
     */
    public function ListarTodos()
    {
        if ($this->GetEstado() == DESACTUALIZADO) {
            return false;
        }
        $salida = "<ul>";
        foreach ($this->GetListaEntidad() as $ent) {
            $salida .= "<li>" . $ent->ToString() . "</li>";
        }
        $salida .= "</ul>";
        return $salida;
    }
    /**
     * Modifica una entidad del array de _ListaEntidad y establece el estado en DESACTUALIZADO.
     */
    public function Modificar($entidadNueva)
    {
        if (isset($entidadNueva)) {
            foreach ($this->GetListaEntidad() as $ent) {
                if ($ent->CriterioBusqueda() == $entidadNueva->CriterioBusqueda()) {
                    $ent = $entidadNueva;
                    $this->SetEstado(DESACTUALIZADO);
                    return true;
                }
            }
        }
    }
}
