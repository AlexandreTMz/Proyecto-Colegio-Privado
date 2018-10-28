<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/apoderado.php');

class ApoderadoDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Apoderados $apoderado)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL up_insertar_apoderados(?,?,?,?,?)");
		$statement->bindParam(1,$apoderado->__GET('id_persona')->__GET('id_persona'));
		$statement->bindParam(2,$apoderado->__GET('centro_trabajo'));
		$statement->bindParam(3,$apoderado->__GET('ocupacion'));
		$statement->bindParam(4,$apoderado->__GET('correo'));
		$statement->bindParam(5,$apoderado->__GET('id_ninstruccion')->__GET('id_ninstruccion'));
    $statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(Apoderados $apoderado)
	{
		try
		{
			$result = array();
			$statement = $this->pdo->prepare("call up_buscar_apoderados(?)");
			$statement->bindParam(1,$apoderado->__GET('id_persona'));
			$statement->execute();
			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$apo = new Apoderados();
				$apo->__GET('id_persona')->__SET('id_persona', $r->id_persona);
				$apo->__SET('centro_trabajo', $r->centro_trabajo);
				$apo->__SET('ocupacion', $r->ocupacion);
				$apo->__SET('correo', $r->correo);
				$apo->__GET('id_ninstruccion')->__SET('id_ninstruccion', $r->id_ninstruccion);
				$result[] = $apo;
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
