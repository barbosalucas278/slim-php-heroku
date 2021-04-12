<?php
interface IArchivo
{
    public function Leer();
    public function Guardar();
    public function BuscarUno($id);
    public function ListarTodos();
    public function Modificar($entidadNueva);
}
