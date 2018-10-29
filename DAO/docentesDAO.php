<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/docentes.php');

class DocenteDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Docente $docentes)
	{
		try
		{
			$statement = $this->pdo->prepare("CALL up_registrar_docente(?,?,?)");
   			$statement->bindParam(1,$docentes->__GET('id_persona')->__GET('id_persona'));
			$statement->bindParam(2,$docentes->__GET('estado'));
			$statement->bindParam(3,$docentes->__GET('id_funcion')->__GET('id_funcion'));

   			$statement -> execute();

		} 
			catch (Exception $e)
		{
			die($e->getMessage());
		}
	}


	public function Listar(Docente $docentes)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call up_buscar_docente(?)");
			$tempIdPersona = $docentes->__GET('id_persona')->__GET('id_persona');
			$statement->bindParam(1,$tempIdPersona);
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$per = new Docente();

				$per->__GET('id_persona')->__SET('id_persona', $r->id_persona);
				$per->__SET('estado', $r->estado);
				$per->__GET('id_funcion')->__SET('id_funcion', $r->id_funcion);

				$result[] = $per;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

}

?>
