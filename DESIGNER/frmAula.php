<?php
require_once('../BOL/aula.php');
require_once('../DAO/aulaDAO.php');

require_once('../BOL/grado.php');
require_once('../DAO/gradoDAO.php');

require_once('../BOL/seccion.php');
require_once('../DAO/seccionDAO.php');



$gra = new Grado();
$gradoDAO = new GradoDAO();

$resultado_grado = array();
$resultado_grado = $gradoDAO->Listar();

$sec = new Seccion();
$seccionDAO = new SeccionDAO();

$resultado_seccion = array();
$resultado_seccion = $seccionDAO->Listar();



//if(!empty($resultado))
//{

/*if(isset($_POST['guardar']))
{
	$aul->__SET('idAula',          $_POST['idAula']);
	$aul->__SET('descripcion',        $_POST['descripcion']);
	$aul->__SET('numeroAula', $_POST['numeroAula']);
	$aul->__SET('numeroAlumno',          $_POST['numeroAlumno']);
	$aul->__SET('turno',          $_POST['turno']);
	$aul->__SET('idDocente',          $_POST['idDocente']);
	$aul->__SET('idGrado',          $_POST['idGrado']);
	$aul->__SET('idSeccion',          $_POST['idSeccion']);

	$aulDAO->Registrar($aul);
	header('Location: frmAula.php');
}*/
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>CRUD</title>
	<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
</head>
<body style="padding:15px;">
	<div class="pure-g">
		<div class="pure-u-1-12">
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
				<table style="width:500px;" border="0">
					<tr>
						<th style="text-align:left;">Descripción:</th>
						<td><input type="hidden" name="id_aula" value="" style="width:100%;" />
						<input type="text" name="descripcion" value="" style="width:100%;" /></td>
					</tr>
					<tr>
						<th style="text-align:left;">Número de Aula:</th>
						<td><input type="text" name="numero_aula" value="" style="width:100%;" /></td>
					</tr>
					<tr>
						<th style="text-align:left;">Número de Alumnos:</th>
						<td><input type="text" name="numero_alumno" value="" style="width:100%;" /></td>
					</tr>
					<tr>
						<th style="text-align:left;">Turno:</th>
						<td><select name="id_turno" style="width:100%;">
							<option value="m">M</option>
							<option value="t">T</option>
						</select></td>
					</tr>
					<tr>
						<th style="text-align:left;">Docente:</th>
						<td><select name="id_docente" style="width:100%;">
							<option value="m">M</option>
							<option value="t">T</option>
						</select></td>
					</tr>
					<tr>
						<th style="text-align:left;">Grado:</th>
						<td><select name="id_grado" style="width:100%;">
							<?php
							if(!empty($resultado_grado))
							{
								foreach( $resultado_grado as $r_g):
							?>
									<option value="<?php echo $r_g->__GET('id_grado');?>"><?php echo $r_g->__GET('grado');?></option>
							<?php
								endforeach;
							}else
							{
							?>
								<option value="0">No hay opciones</option>
							<?php
							}
							?>
						</select></td>
					</tr>
					<tr>
						<th style="text-align:left;">Sección:</th>
						<td><select name="id_seccion" style="width:100%;">
							<?php
							if(!empty($resultado_seccion))
							{
								foreach( $resultado_seccion as $r_s):
							?>
									<option value="<?php echo $r_s->__GET('id_seccion');?>"><?php echo $r_s->__GET('seccion');?></option>
							<?php
								endforeach;
							}else
							{
							?>
								<option value="0">No hay opciones</option>
							<?php
							}
							?>
						</select></td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="submit" value="GUARDAR" name="guardar"class="pure-button pure-button-primary">
							<input type="submit" value="BUSCAR" name="buscar"class="pure-button pure-button-primary">
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>

	<?php
	$aul = new Aula();
	$aulaDAO = new AulaDAO();

	$resultado_aula = array();
	$resultado_aula = $aulaDAO->Listar();

	if(!empty($resultado_aula)) //PREGUNTAMOS SI NO ESTA VACIO EL ARRAY
	{
			?>
			<table class="pure-table pure-table-horizontal">
					<thead>
							<tr>
									<th style="text-align:left;">Id Aula</th>
									<th style="text-align:left;">Descripción</th>
									<th style="text-align:left;">Número de Aula</th>
									<th style="text-align:left;">Número de Alumno</th>
									<th style="text-align:left;">Turno</th>
									<th style="text-align:left;">Docente</th>
									<th style="text-align:left;">Grado</th>
									<th style="text-align:left;">Seccion</th>
							</tr>
					</thead>
			<?php
			foreach( $resultado_aula as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
				?>
					<tr>
							<td><?php echo $r->__GET('id_aula'); ?></td>
							<td><?php echo $r->__GET('descripcion'); ?></td>
							<td><?php echo $r->__GET('numero_aula'); ?></td>
							<td><?php echo $r->__GET('numero_alumno'); ?></td>
							<td><?php echo $r->__GET('turno'); ?></td>
							<td><?php echo $r->__GET('id_docente')->__GET('id_persona')->__GET('apellidosP')
							. " " . $r->__GET('id_docente')->__GET('id_persona')->__GET('apellidosM')
							. ", ". $r->__GET('id_docente')->__GET('id_persona')->__GET('nombres'); ?></td>
							<td><?php echo $r->__GET('id_grado')->__GET('grado'); ?></td>
							<td><?php echo $r->__GET('id_seccion')->__GET('seccion'); ?></td>
					</tr>
			<?php endforeach;
		}
		else
		{
			echo 'no se encuentra en la base de datos!';
		}
		?>
		</table>


				<!--ESTA CONDICION SIRVE PARA REALIZAR BUSQUEDA POR DNI-->

				<?php
				/*if(isset($_POST['buscar']))
				{
					$resultado = array();//VARIABLE TIPO RESULTADO
					$aul->__SET('idAula',          $_POST['idAula']);//ESTABLECEMOS EL VALOR DEL DNI
					$resultado = $aulDAO->Listar($aul); //CARGAMOS LOS REGISTRO EN EL ARRAY RESULTADO
					if(!empty($resultado)) //PREGUNTAMOS SI NO ESTA VACIO EL ARRAY
					{*/
						?>
						<!--<table class="pure-table pure-table-horizontal">
								<thead>
										<tr>
												<th style="text-align:left;">Id Aula</th>
												<th style="text-align:left;">Descripción</th>
												<th style="text-align:left;">Número de Aula</th>
												<th style="text-align:left;">Número de Alumno</th>
												<th style="text-align:left;">Turno</th>
												<th style="text-align:left;">Id Docente</th>
												<th style="text-align:left;">Id Grado</th>
												<th style="text-align:left;">Id Seccion</th>
										</tr>
								</thead>-->
						<?php
						//foreach( $resultado as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
							?>
								<tr>
										<!--<td><?php echo $r->__GET('idAula'); ?></td>
										<td><?php echo $r->__GET('descripcion'); ?></td>
										<td><?php echo $r->__GET('numeroAula'); ?></td>
										<td><?php echo $r->__GET('numeroAlumno'); ?></td>
										<td><?php echo $r->__GET('turno'); ?></td>
										<td><?php echo $r->__GET('idDocente'); ?></td>
										<td><?php echo $r->__GET('idGrado'); ?></td>
										<td><?php echo $r->__GET('idSeccion'); ?></td>-->
								</tr>
						<?php /*endforeach;
					}
					else
					{
						echo 'no se encuentra en la base de datos!';
					}*/
					?>
					</table>
					<?php
				//}
				?>

    </body>
</html>
