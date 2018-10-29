<?php
require_once('../BOL/registro_calificacion.php');
require_once('../DAO/registro_calificacionDAO.php');
require_once('../DAO/periodosDAO.php');
require_once('../DAO/gradoDAO.php');
require_once('../DAO/seccionDAO.php');
require_once('../DAO/docentesDAO.php');

$registroCalificacion = new Registro_calificacion();
$registroCalificacionDAO = new Registro_calificacionDAO();
$peridoDao = new PeriodosDAO();
$gradoDao = new GradoDAO();
$seccionDao = new seccionDAO();
$docenteDao = new DocenteDAO();


if(isset($_POST['guardar']))
{
	$registroCalificacion->__SET('fecha',          $_POST['fecha']);
	$registroCalificacion->__SET('hora',        $_POST['hora']);
	$registroCalificacion->__GET('id_periodo')->__SET('id_periodo', 				$_POST['periodo']);
	$registroCalificacion->__GET('id_grado')->__SET('id_grado',          $_POST['grado']);
	$registroCalificacion->__GET('id_seccion')->__SET('id_seccion',        $_POST['seccion']);
	$registroCalificacion->__GET('id_docente')->__SET('id_docente', 				$_POST['docente']);

	$registroCalificacionDAO->Registrar($registroCalificacion);
	header('Location: frmRegistroCalificacion.php');
}



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
                            <th style="text-align:left;">Fecha</th>
                            <td><input type="text" name="fecha" value="" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Hora</th>
                            <td><input type="text" name="hora" value="" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Periodo</th>
                            <td>
                            	<?php
                            		$resultadoPeriodo = array();//VARIABLE TIPO RESULTADO
                            		$periodo = new Periodos();
                            		$periodo->__SET('id_periodo','');
									$resultadoPeriodo = $peridoDao->Listar($periodo); 
                            	 ?>
                            	 <select name="periodo">
                            	 	<?php foreach($resultadoPeriodo as $per):?>
                            	 		<option><?php echo $per->__GET('id_periodo')." - ".$per->__GET('descripcion'); ?></option>
                            	 	<?php endforeach;?>
                            	 </select>

                            </td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Grado</th>
                            <td>
                                 <?php
                            		$resultadoGrado = array();//VARIABLE TIPO RESULTADO
                            		$grado = new Grado();
                            		$grado->__SET('id_grado','');
									$resultadoGrado = $gradoDao->Listar($grado); 
                            	 ?>
                            	 <select name="grado">
                            	 	<?php foreach($resultadoGrado as $per):?>
                            	 		<option><?php echo $per->__GET('id_grado')." - ".$per->__GET('grado'); ?></option>
                            	 	<?php endforeach;?>
                            	 </select>
							</td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Seccion</th>
                            <td>
                                 <?php
                            		$resultadoSeccion = array();//VARIABLE TIPO RESULTADO
                            		$seccion = new Seccion();
                            		$seccion->__SET('id_seccion','');
									$resultadoSeccion = $seccionDao->Listar($seccion); 
                            	 ?>
                            	 <select name="seccion">
                            	 	<?php foreach($resultadoSeccion as $per):?>
                            	 		<option><?php echo $per->__GET('id_seccion')." - ".$per->__GET('seccion'); ?></option>
                            	 	<?php endforeach;?>
                            	 </select>
							</td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Docente</th>
                            <td>
                                 <?php
                            		$resultadoDocente = array();//VARIABLE TIPO RESULTADO
                            		$docente = new Docente();
                            		$docente->__GET('id_persona')->__SET('id_persona','');
									$resultadoDocente = $docenteDao->Listar($docente); 
                            	 ?>
                          <select name="docente">
                           <?php foreach($resultadoDocente as $per):?>
                           <option><?php echo $per->__GET('id_persona')->__GET('id_persona')." - ".$per->__GET('estado'); ?></option>
                           <?php endforeach;?>
                          </select>
							</td>
                        </tr>
                        <tr>
                            <td colspan="2">
								<input type="submit" value="GUARDAR" name="guardar"class="pure-button pure-button-primary">
								<input type="submit" value="BUSCAR" name="buscar"class="pure-button pure-button-primary">
								<input type="hidden" id="id_rcalificacion" name="id_rcalificacion" value="">
                            </td>
                        </tr>
                    </table>
                </form>


            </div>
        </div>

				<!--ESTA CONDICION SIRVE PARA REALIZAR BUSQUEDA POR DNI-->

				<?php
				if(isset($_POST['buscar']))
				{
					$resultado = array();//VARIABLE TIPO RESULTADO
					$registroCalificacion->__SET('id_rcalificacion',$_POST['id_rcalificacion']);//ESTABLECEMOS EL VALOR DEL DNI
					$resultado = $registroCalificacionDAO->Listar($registroCalificacion); //CARGAMOS LOS REGISTRO EN EL ARRAY RESULTADO
					if(!empty($resultado)) //PREGUNTAMOS SI NO ESTA VACIO EL ARRAY
					{
						?>
						<table class="pure-table pure-table-horizontal">
								<thead>
										<tr>
												<th style="text-align:left;">ID</th>
												<th style="text-align:left;">Fecha</th>
												<th style="text-align:left;">Hora</th>
												<th style="text-align:left;">Periodo</th>
												<th style="text-align:left;">Grado</th>
												<th style="text-align:left;">Seccion</th>
												<th style="text-align:left;">Docente</th>
										</tr>
								</thead>
						<?php foreach( $resultado as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
						?>
								<tr>
										<td><?php echo $r->__GET('id_rcalificacion'); ?></td>
										<td><?php echo $r->__GET('fecha'); ?></td>
										<td><?php echo $r->__GET('hora'); ?></td>
										<td><?php echo $r->__GET('id_periodo')->__GET('id_periodo'); ?></td>
										<td><?php echo $r->__GET('id_grado')->__GET('id_grado'); ?></td>
										<td><?php echo $r->__GET('id_seccion')->__GET('id_seccion'); ?></td>
										<td><?php echo $r->__GET('id_docente')->__GET('id_docente'); ?></td>
								</tr>
						<?php endforeach;
					}
					else
					{
						echo 'no se encuentra en la base de datos!';
					}
					?>
					</table>
					<?php
				}
				?>

    </body>
</html>
