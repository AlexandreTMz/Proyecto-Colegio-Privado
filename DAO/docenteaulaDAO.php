<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/docentes.php');

class DocenteAulaDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Listar()
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call up_listar_docente()");
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$doc = new Docente();

		    $doc->__GET('id_persona')->__SET('id_persona', $r->id_persona);
				$doc->__GET('id_persona')->__SET('nombres', $r->nombre);
				$doc->__GET('id_persona')->__SET('apellidosP', $r->apellido_paterno);
				$doc->__GET('id_persona')->__SET('apellidosM', $r->apellido_materno);

				$result[] = $doc;
			}

			return $result;
		} catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
}
?>
