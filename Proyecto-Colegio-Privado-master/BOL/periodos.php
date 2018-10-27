<?php
//lenguaje logico del negocio
class Periodos
{
  //declaracion de la clase Periodos y dar campos
  private $id_periodo;
  private $descripcion;

  public function __GET($x)
  {
    return $this->$x;
  }

  public function _SET($x, $y)
  {
    return $this->$x = $y;
  }
}

 ?>
