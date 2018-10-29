<?php
session_start();
$_SESSION["id_curso"] = $_GET['id_curso'];
header('Location: frmCompetencia.php');

?>
