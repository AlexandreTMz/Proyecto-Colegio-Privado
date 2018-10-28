<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/niveles_instrucciones.php');

class Niveles_InstruccionesDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Niveles_Instrucciones $ins)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL up_insertar_niveles_instrucciones(?,?)");
    $statement->bindParam(1,$ins->__GET('id_ninstruccion'));
		$statement->bindParam(2,$ins->__GET('nivel_instruccion'));
    $statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(Niveles_Instrucciones $ins)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call up_buscar_niveles_instrucciones(?)");
			$statement->bindParam(1,$ins->__GET('id_ninstruccion'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$ins = new Niveles_Instrucciones();

				$ins->__SET('id_ninstruccion', $r->id_ninstruccion);
				$ins->__SET('nivel_instruccion', $r->nivel_instruccion);

				$result[] = $ins;
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
