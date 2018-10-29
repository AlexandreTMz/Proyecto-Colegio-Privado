<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/apoderado.php');
require_once('../BOL/niveles_instrucciones.php');

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
<<<<<<< HEAD
		$statement = $this->pdo->prepare("CALL up_insertar_apoderados(?,?,?,?,?,?)");
    $statement->bindParam(1,$apoderado->__GET('id_persona')->__GET('id_persona'));
		$statement->bindParam(1,$apoderado->__GET('id_ninstruccion')->__GET('id_ninstruccion'));
    $statement->bindParam(2,$apoderado->__GET('id_apoderados'));
		$statement->bindParam(2,$apoderado->__GET('centro_trabajo'));
		$statement->bindParam(3,$apoderado->__GET('ocupacion'));
		$statement->bindParam(4,$apoderado->__GET('correo'));
=======
		$statement = $this->pdo->prepare("CALL up_insertar_apoderados(?,?,?,?,?)");
		$statement->bindParam(1,$apoderado->__GET('id_persona')->__GET('id_persona'));
		$statement->bindParam(2,$apoderado->__GET('centro_trabajo'));
		$statement->bindParam(3,$apoderado->__GET('ocupacion'));
		$statement->bindParam(4,$apoderado->__GET('correo'));
		$statement->bindParam(5,$apoderado->__GET('id_ninstruccion')->__GET('id_ninstruccion'));
>>>>>>> 802743be71d0bd29c5c6c8b441a0d050677691f1
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
<<<<<<< HEAD
		    $apo->__GET('id_persona')->__SET('id_persona', $r->id_persona);
        $apo->__GET('id_ninstruccion')->__SET('id_ninstruccion', $r->id_ninstruccion);
       	$apo->__SET('id_apoderados', $r->id_apoderados);
=======
				$apo->__GET('id_persona')->__SET('id_persona', $r->id_persona);
>>>>>>> 802743be71d0bd29c5c6c8b441a0d050677691f1
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
