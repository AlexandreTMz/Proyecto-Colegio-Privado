<?php
require_once('../DAL/DBconexion.php');
require_once('../BOL/grados_curso.php');

class grados_cursoDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBconexion();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Grados_curso $grados_cursos)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL addgrados_cursos(?,?,?)");
    $statement->bindParam(1,$apoderado->__GET('id_gcurso'));
		$statement->bindParam(2,$apoderado->__GET('id_grado'));
		$statement->bindParam(3,$apoderado->__GET('id_curso'));
    $statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}
}
?>
