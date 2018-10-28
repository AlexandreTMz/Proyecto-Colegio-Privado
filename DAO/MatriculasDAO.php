<?php
require_once('../DAL/DBAcces.php');
require_once('../BOL/Matriculas');

class Matricula

{
   private $pdo;

   public function _CONSTRUCT()
   {
   	$dba = new DBAccess();
   	$this->$pdo = $dba->get_connection();

   }
   public function RegistrarMatriculas(matriculas $matriculas)
   {
	try
		{
		$statement = $this->pdo->prepare("CALL up_insertar_matricula(?,?,?,?)");
    $statement->bindParam(1,$matriculas->__GET('id_matriculas'));
		$statement->bindParam(2,$matriculas->__GET('fecha'));
		$statement->bindParam(3,$matriculas->__GET('repiete'));
		$statement->bindParam(4,$matriculas->__GET('apoderado_parentesco'));
    $statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
   }


}

































?>