<?php
require_once('../BOL/apoderado.php');
require_once('../DAO/apoderadoDAO.php');

$apo = new Apoderados();
$apoDAO = new ApoderadoDAO();

if(isset($_POST['guardar']))
{
	$apo->__SET('id_persona',          		  $_POST['id_persona']);
	$apo->__SET('centro_trabajo',           $_POST['centro_trabajo']);
	$apo->__SET('ocupacion',                $_POST['ocupacion']);
	$apo->__SET('correo', 			          	$_POST['correo']);

	$apoDAO->Registrar($apo);
	header('Location: frmApoderado.php');
}

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Apoderado</title>
        <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" ">
	</head>
    <body style="padding:15px;">
        <div class="pure-g">
            <div class="pure-u-1-12">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <table style="width:500px;" border="0">
												<tr>
														<th style="text-align:left;">Codigo:</th>
														<td><input type="text" name="id_persona" value="" style="width:100%;" required="Ingrese su codigo" /></td>
												</tr>
                        <tr>
                            <th style="text-align:left;">Centro de trabajo:</th>
                            <td><input type="text" name="centro_trabajo" value="" style="width:100%;" required="Ingrese centro de trabajo" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Ocupacion:</th>
                            <td><input type="text" name="ocupacion" value="" style="width:100%;" required="Ingrese ocupación"/></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Correo:</th>
                            <td><input type="text" name="correo" value="" style="width:100%;" required="Ingrese correo"/></td>
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
				if(isset($_POST['buscar']))
				{
					$resultado = array();
					$apo->__SET('id_persona',          $_POST['id_persona']);
					$resultado = $apoDAO->Listar($apo);
					if(!empty($resultado))
					{
						?>
						<table class="pure-table pure-table-horizontal">
								<thead>
										<tr>
												<th style="text-align:left;">ID</th>
												<th style="text-align:left;">CENTRO DE TRABAJO</th>
												<th style="text-align:left;">OCUPACIÓN</th>
												<th style="text-align:left;">CORREO</th>
										</tr>
								</thead>
						<?php
						foreach( $resultado as $r):
							?>
								<tr>
										<td><?php echo $r->__GET('idPersona'); ?></td>
										<td><?php echo $r->__GET('centro_trabajo'); ?></td>
										<td><?php echo $r->__GET('ocupacion'); ?></td>
										<td><?php echo $r->__GET('correo'); ?></td>
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
