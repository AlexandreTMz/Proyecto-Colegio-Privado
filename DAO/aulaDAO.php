<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/aula.php');

class AulaDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Aula $aula)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL up_insertar_aulas(?,?,?,?,?,?,?,?)");
    $statement->bindParam(1,$aula->__GET('idAula'));
		$statement->bindParam(2,$aula->__GET('descripcion'));
		$statement->bindParam(3,$aula->__GET('numeroAula'));
		$statement->bindParam(4,$aula->__GET('numeroAlumno'));
		$statement->bindParam(5,$aula->__GET('turno'));
		$statement->bindParam(6,$aula->__GET('idDocente'));
		$statement->bindParam(7,$aula->__GET('idGrado'));
		$statement->bindParam(8,$aula->__GET('idSeccion'));
    $statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(Aula $aula)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call up_buscar_aulas(?)");
			$statement->bindParam(1,$aula->__GET('idAula'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
							$aul = new Aula();

		    $aul->__SET('idAula', $r->id_aula);
				$aul->__SET('descripcion', $r->descripcion);
				$aul->__SET('numeroAula', $r->numero_aula);
				$aul->__SET('numeroAlumno', $r->numero_alumnos);
        $aul->__SET('turno', $r->turno);
        $aul->__SET('idDocente', $r->id_docente);
        $aul->__SET('idGrado', $r->id_grado);
        $aul->__SET('idSeccion', $r->id_seccion);

				$result[] = $aul;
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
