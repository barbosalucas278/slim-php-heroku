<?php
interface IEntidad
{
    public function Mapear($dato);
    public function CriterioBusqueda();
    public function ToArray($lista);
    public function OneToArray();
}
