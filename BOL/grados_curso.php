<?php

class grados_cursos
{
  private $id_gcurso;
	private $id_grado;
	private $id_curso;

public function __GET($x)
{
  return $this->$x;
}

public function __SET($x, $y)
  {
    return $this->$x = $y;
  }
}
 ?>
