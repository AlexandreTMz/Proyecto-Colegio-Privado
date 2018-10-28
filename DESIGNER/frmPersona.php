<?php
require_once('../BOL/persona.php');
require_once('../BOL/ECivil.php');
require_once('../BOL/tipoDocumento.php');
require_once('../DAO/personaDAO.php');
require_once('../DAO/ECivilDAO.php');
require_once('../DAO/TDocumentoDAO.php');

$per = new Persona();
$civ = new estadoCivil();
$doc = new tipoDocumento(); 	
$perDAO = new PersonaDAO();
$civDAO = new CivilDao();
$docDAO = new DocumentoDao();

if(isset($_POST['guardar']))
{
	$per->__SET('nombres',          $_POST['nombres']);
	$per->__SET('apellidoP',        $_POST['apellidoP']);
	$per->__SET('apellidoM',        $_POST['apellidoM']);
	$per->__SET('numero_documento',	$_POST['numeroD']);
	$per->__SET('fecha_nacimiento',	$_POST['fechaNac']);
	$per->__SET('sexo',				$_POST['sexo']);
	$per->__SET('direccion', 		$_POST['direccion']);
	$per->__SET('telefono', 		$_POST['telefono']);
	$per->__SET('id_tDocu', 		$_POST['id_tDocu']);
	$per->__SET('id_eCivil', 		$_POST['id_eCivil']);

	$perDAO->Registrar($per);
	header('Location: frmPersona.php');
}



?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>CRUD</title>
        
		<!--Import Google Icon Font-->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
	</head>
    <body>



	<div class="row">
      
      <div class="col s3">
	  
	  </div>
      <div class="col s9">
		<div class="col s12">
			<h1 class="text-center">Formulario de ingreso de Personas</h1>
		</div>
        <div class="pure-g">
            <div class="pure-u-1-12">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">

                    <table style="width:600px; border-collapse: collapse;" border="0" class="striped centered">
                        <!--inicio de los nombres-->
						<tr >
                            <th style="text-align:left;" >Nombres</th>
                            <td>
							<div class="row">								
								<div class="input-field col s12">
								<i class="material-icons prefix">create</i>								
									<input type="text" id="autocomplete-input1" name="nombres" class="autocomplete" require>
									<label for="autocomplete-input1">Ingrese Nombres</label>
								</div>							
							</div>
							</td>
                        </tr>

						<!--Inicio de los apellidos Paternos-->
                        <tr>
                            <th style="text-align:left;">Apellido Paterno</th>
                            <td>
							<div class="row">
								<div class="input-field col s12">
								<i class="material-icons prefix">create</i>									
									<input require type="text" id="autocomplete-input2" name="apellidoP" class="autocomplete">
									<label for="autocomplete-input2">Ingrese Apellido Paterno</label>
								</div>								
							</div>
							</td>
                        </tr>

						<!--Inicio de los apellidos Maternos-->
						<tr>
                            <th style="text-align:left;">Apellido Materno</th>
                            <td>				
							<div class="row">
							<div class="input-field col s12">			
								<i class="material-icons prefix">create</i>						
								<input require type="text" id="autocomplete-input4" name="apellidoM" class="autocomplete">
								<label for="autocomplete-input4">Ingrese Apellido Materno</label>
							</div>
							</div>			
							</td>

                        </tr>

						<!--Inicio del tipo de documento-->
						<tr>
                            <th style="text-align:left;">Tipo de documento</th>
                            <td>
							<div class="input-field col s12"  id="id_tDocu">
								<select name="id_tDocu">
									<option value="" disabled selected>Seleccione documento</option>
									<?php
				
										$resultadoD = array();//VARIABLE TIPO RESULTADO					
										$resultadoD = $docDAO->Listar_Documento(); //CARGAMOS LOS REGISTRO EN EL ARRAY RESULTADO
										if(!empty($resultadoD)) //PREGUNTAMOS SI NO ESTA VACIO EL ARRAY
										{										
											foreach( $resultadoD as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
									?>
										<option value="<?php $r->__GET('id_tdocumento');?>"><?php echo $r->__GET('id_tdocumento').'- '.$r->__GET('tipo_documento'); ?></option>				
									<?php			
											endforeach;
										}
										else
										{
											echo 'no se encuentra en la base de datos!';
										}
									?>
								</select>
								
							</div>
							</td>
                        </tr>

						<!--Inicio del numero del documento-->
                        <tr>
                            <th style="text-align:left;">Número de documento</th>
                            <td>
								<div class="row">
									<div class="input-field col s12">	
									<i class="material-icons prefix">create</i>								
										<input require type="text" id="autocomplete-input3" name="numeroD" class="autocomplete">
										<label for="autocomplete-input3">Ingrese número</label>
									</div>
								</div>
							</td>
                        </tr>

						<!--Inicio del sexo-->
						<tr>
                            <th style="text-align:left;">SEXO</th>
                            <td>
							<div class="row">							
								<div >										
									<select name="sexo">
										<option value="" disabled selected >Seleccione su sexo</option>
										<option value="1">Varon</option>
										<option value="2">Mujer</option>
										<option value="3">otros</option>
									</select>																		
								</div>
							</div>
							</td>
                        </tr>

						<!--Inicio de la fecha de nacimiento-->
						<tr>
                            <th style="text-align:left;">FECHA DE NACIMIENTO</th>
                            <td>
							<div class="row">
								<div class="input-field col s12">
									<i class="material-icons prefix">calendar_today</i>	
									<input require id="fecha" type="text" name="fechaNac" class="datepicker">
									<label for="fecha">Elige la fecha</label>
								</div>
							</div>
							</td>
                        </tr>
                        

						<!-- inicio de la direcion-->							
						<tr>
                            <th style="text-align:left;">Dirección</th>
                            <td>
							<div class="row">
								<div class="input-field col s12">	
									<i class="material-icons prefix">gps_fixed</i>								
									<input require type="text" id="autocomplete-input5" name="direccion" class="autocomplete">
									<label for="autocomplete-input5">Ingrese dirección</label>
								</div>
							</div>							
							</td>

                        </tr>

						<!--inicio del telefono -->
						<tr>
                            <th style="text-align:left;">Teléfono</th>
                            <td>	
							<div class="row">
								<div class="input-field col s12">	
									<i class="material-icons prefix">smartphone</i>						
									<input require type="text" id="autocomplete-input6" name="telefono" class="autocomplete">
									<label for="autocomplete-input6">Ingrese Teléfono</label>
								</div>
							</div>						
							</td>
                        </tr>

						<!--inicio del estado civil 
						<tr>
                            <th style="text-align:left;">Estado Civil</th>
                            <td>
							<div class="input-field col s12" name="id_eCivil">
								<select>
									<option value="" disabled selected>Seleccione su estado</option>
									<option value="1">Soltero/a</option>
									<option value="2">Casado/a</option>
									<option value="3">Divorciado/a</option>
									<option value="4">viudo/a</option>
								</select>
								
							</div>
							</td>
                        </tr>
						-->
						<!-- ingresando datos a las listas de estado civil -->
						<tr>
                            <th style="text-align:left;">Estado Civil</th>
                            <td>
							<div class="input-field col s12" >
								<select name="id_eCivil">
									<option value="" disabled selected>Seleccione su estado</option>									
									<?php
				
										$resultado = array();//VARIABLE TIPO RESULTADO					
										$resultado = $civDAO->Listar_Civil(); //CARGAMOS LOS REGISTRO EN EL ARRAY RESULTADO
										if(!empty($resultado)) //PREGUNTAMOS SI NO ESTA VACIO EL ARRAY
										{										
											foreach( $resultado as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
									?>
										<option value="<?php $r->__GET('id_ecivil');?>"><?php echo $r->__GET('id_ecivil').'- '.$r->__GET('estado_civil'); ?></option>				
									<?php			
											 endforeach;
										}
										else
										{
											echo 'no se encuentra en la base de datos!';
										}
									?>
								</select>
								
							</div>
							</td>
                        </tr>

                            <td colspan="2">
							<button class="btn waves-effect waves-light btn-large" type="submit" name="guardar">Guardar
								<i class="material-icons left">save</i>
							</button>
							<button class="btn waves-effect waves-light btn-large" type="submit" name="buscar">Buscar
								<i class="material-icons left">search</i>
							</button>
							</td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
	  </div>
	  
    </div>
	<div class="parallax-container">
      <div class="parallax"><img src="images/slider-2.jpg"></div>
    </div>	
	

				<!--ESTA CONDICION SIRVE PARA REALIZAR BUSQUEDA POR DNI-->

				<?php
				if(isset($_POST['buscar']))
				{
					$resultado = array();//VARIABLE TIPO RESULTADO
					$per->__SET('dni',          $_POST['dni']);//ESTABLECEMOS EL VALOR DEL DNI
					$resultado = $perDAO->Listar($per); //CARGAMOS LOS REGISTRO EN EL ARRAY RESULTADO
					if(!empty($resultado)) //PREGUNTAMOS SI NO ESTA VACIO EL ARRAY
					{
						?>
						<table class="pure-table pure-table-horizontal">
								<thead>
										<tr>
												<th style="text-align:left;">ID</th>
												<th style="text-align:left;">Nombres</th>
												<th style="text-align:left;">Apellidos</th>
												<th style="text-align:left;">DNI</th>
										</tr>
								</thead>
						<?php
						foreach( $resultado as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
							?>
								<tr>
										<td><?php echo $r->__GET('id'); ?></td>
										<td><?php echo $r->__GET('nombres'); ?></td>
										<td><?php echo $r->__GET('apellidos'); ?></td>
										<td><?php echo $r->__GET('dni'); ?></td>
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



				<?php
				
					$resultado = array();//VARIABLE TIPO RESULTADO					
					$resultado = $civDAO->Listar_Civil(); //CARGAMOS LOS REGISTRO EN EL ARRAY RESULTADO
					if(!empty($resultado)) //PREGUNTAMOS SI NO ESTA VACIO EL ARRAY
					{						
						?>
						<table class="pure-table pure-table-horizontal">
								<thead>
										<tr>
												<th style="text-align:left;">ID</th>
												<th style="text-align:left;">Nombres</th>
												
										</tr>
								</thead>
						<?php
						foreach( $resultado as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
							?>
								<tr>
										<td><?php echo $r->__GET('id_ecivil'); ?></td>
										<td><?php echo $r->__GET('estado_civil'); ?></td>
										
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
				
				?>
	
<!--JavaScript at end of body for optimized loading-->
<script type="text/javascript" src="js/materialize.min.js"></script>
<script>
	   

		document.addEventListener('DOMContentLoaded', function() {
			
			//inicio del combo box
			var elems = document.querySelectorAll('select');
    		var instances = M.FormSelect.init(elems);

			//inicio de la fecha
    		var elems = document.querySelectorAll('.datepicker');
			var instances = M.Datepicker.init(elems,{
				format: 'dd mmmm, yyyy',
				yearRange: 80,
				i18n :{

					months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
					monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
					weekdays: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
					weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
					weekdaysAbbrev:['D','L','M','M','J','V','S'],
					selectMonths: true,
					selectYears: 100, // Puedes cambiarlo para mostrar más o menos años
					today: 'Hoy',
					clear: 'Limpiar',
					cancel: 'Cerrar',
					done: 'Ok',
					labelMonthNext: 'Siguiente mes',
					labelMonthPrev: 'Mes anterior',
					labelMonthSelect: 'Selecciona un mes',
					labelYearSelect: 'Selecciona un año',
				}
			});
 		});

		// Or with jQuery

		$(document).ready(function(){
			$('.datepicker').datepicker();
		});
      

</script>
</body>
</html>
