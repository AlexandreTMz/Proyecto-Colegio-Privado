<?php
require_once('../BOL/competencias.php');
require_once('../DAO/competenciaDAO.php');

require_once('../BOL/curso_competencia.php');
require_once('../DAO/cursos_competenciasDAO.php');

session_start();

$com = new Competencias();
$comDAO = new CompetenciaDAO();

$cc = new Curso_Competencia();
$ccDAO = new Curso_CompetenciaDAO();



if(isset($_POST['guardar']))
{
	$com->__SET('nombreCompetencia',          $_POST['nombre_competencia']);
	$com->__SET('numeroCo',        $_POST['numero_co']);
	$com->__SET('id',        $_SESSION['id_curso']);

	$comDAO->Registrar($com);
	header('Location: frmCompetencia.php');
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
                            <th style="text-align:left;">Nombre:</th>
                            <td><input type="text" name="nombre_competencia" value="" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Numero:</th>
                            <td><input type="text" name="numero_co" value="" style="width:100%;" /></td>
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

				<!--ESTA CONDICION SIRVE PARA REALIZAR BUSQUEDA POR DNI-->

				<?php


				$resultado = array();//VARIABLE TIPO RESULTADO
					$cc->__SET('id_curso',          $_SESSION['id_curso']);
					$resultado = $ccDAO->Listar($cc); //CARGAMOS LOS REGISTRO EN EL ARRAY RESULTADO
					if(!empty($resultado)) //PREGUNTAMOS SI NO ESTA VACIO EL ARRAY
					{
						?>
						<table class="pure-table pure-table-horizontal">
								<thead>
										<tr>
												<th style="text-align:left;">ID</th>
												<th style="text-align:left;">Nombre</th>
												<th style="text-align:left;">Numero</th>
												<th style="text-align:left;">Capacidades</th>
										</tr>
								</thead>
						<?php
						foreach( $resultado as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
							?>
								<tr>
									<td><?php echo $r->__GET('id_ccompetencia'); ?></td>
										<td><?php echo $r->__GET('id_competencia'); ?></td>
										<td><?php echo $r->__GET('id_curso'); ?></td>
										<!--<td><a href="auxiliar.php?id=<?php echo $r->__GET('id_competencia'); ?>">Capacidad</a></td>-->
								</tr>
						<?php endforeach;
					}
					else
					{
						echo 'no se encuentra en la base de datos!';
					}
					?>
					</table>


    </body>
</html>
