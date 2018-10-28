<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/anios_escolares.php');

class anios_escolares
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(anios_escolares $anios_escolares)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL Proc_registrar_anios_escolares(?,?,?,?,?,?)");
   	$statement->bindParam(1,$anios_escolares->__GET('id_escolar'));
		$statement->bindParam(2,$anios_escolares->__GET('codigo'));
		$statement->bindParam(3,$anios_escolares->__GET('descripcion'));
		$statement->bindParam(4,$anios_escolares->__GET('fecha_inicioDATE'));
		$statement->bindParam(5,$anios_escolares->__GET('fecha_finDATE'));
		$statement->bindParam(6,$anios_escolares->__GET('estado'));

    $statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(anios_escolares $anios_escolares)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call up_buscar_anios_escolares(?)");
			$statement->bindParam(1,$anios_escolares->__GET('id_aescolar'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$per = new anios_escolares();

				$per->__SET('id_escolar', $r->id_escolar);
				$per->__SET('codigo', $r->codigo);
				$per->__SET('descripcion', $r->descripcion);
				$per->__SET('fecha_inicioDATE', $r->fecha_inicioDATE);
				$per->__SET('fecha_finDATE', $r->fecha_finDATE);
				$per->__SET('estado', $r->estado);


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
