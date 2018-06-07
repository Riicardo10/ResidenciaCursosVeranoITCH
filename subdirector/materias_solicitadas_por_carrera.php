<?php
	session_start();
	if(!isset($_SESSION['sesion']))
			header("location: ../");	
?>
<?php
	$id_carrera = $_GET['txt_carrera_id'];
	$nombre_carrera = $_GET['txt_carrera_nombre'];
	require "SubdirectorModel.php";
	$sub = new SubdirectorModel; 
	$lista = $sub->getListaMateriasSolicitadas($id_carrera);
	require "../profesores/ProfesorModel.php";
	$jefe = new ProfesorModel; 
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Carrera</title>
		<?php	require '../styles-scripts.php';?>
		<style>
			.rechazada{
				background: red;
				color: white;
			}
			.aprobada{
				background: #4a6;
				color: white;
			}
			.pendiente{
				background: #4ac;
				color: white;
			}
			h4{
				margin-top: -1px;
				padding: 4px;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<?php require '../banner/banner.php'; ?>
			<hr>
			<h4 style="text-align: center;">
				<a style="float: left;" href="inicio.php">Inicio</a>	
				<a style="float: right;" href="../admin/cerrar_sesion.php">Cerrar sesion</a>	
			</h4>

			
			<div class="row">
				<div class="col-xs-12">
					<hr>
					<div class="col panel panel-success col-lg-offset-0">
						<div class="panel-heading text-center">
							<?php $anio = Date('Y');?>
							<h3 >Materias solicitadas de <?php echo $nombre_carrera?></h3>
						</div>
						<div class="panel-body ">
							<table class="table">
								<thead>
									<tr>
										<th>ID</th>
										<th>Materia</th>
										<th>Coordinador</th>
										<th>Profesor</th>
										<th>Estado</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
										<?php  
											if ( $lista ){
												while($row = $lista->fetch_assoc()) { ?>
													<tr >
														<form action="detalle_materia.php" method="GET">
															<td>
																<input type="hidden" value="<?php echo $id_carrera; ?>" name="txt_carrera_id">
																<input type="hidden" value="<?php echo $nombre_carrera; ?>" name="txt_carrera_nombre">
																<input type="hidden" value="<?php echo $row['id']; ?>" name="txt_id">
																<?php echo $row['id']; ?>
															</td>
															<td>
																<?php echo $row['nombre_materia']; ?>
																<input type="hidden" value="<?php echo $row['nombre_materia']; ?>" name="txt_materia">
															</td>
															<td>
																<?php echo $row['no_control'] . " - " . $row['nombre'] . " " . $row['apellido_paterno'] . " " . $row['apellido_materno']; ?>
																<input type="hidden" value="<?php echo $row['nombre'] . ' ' . $row['apellido_paterno'] . ' ' . $row['apellido_materno']   ; ?>" name="txt_coordinador">
															</td>
															<td>
																<?php 
																	if( $row['clave_profesor'] ) {
																		$profesor = $jefe->getProfesor( $row['clave_profesor'] );
																		echo $profesor->nombre . " " . $profesor->apellido_paterno . " " . $profesor->apellido_materno;
																	}
																	else{
																		echo "<h4 style='color:red;'>" . 'Sin profesor asignado' . "</h4>";
																	}
																?>
																<?php 
																	if( $row['clave_profesor'] ) {
																?>
																<input type="hidden" value="<?php echo $profesor->nombre . ' ' . $profesor->apellido_paterno . ' ' . $profesor->apellido_materno; ?>" name="txt_profesor">
																	<?php } else {?>
																		<input type="hidden" value="SIN PROFESOR" name="txt_profesor">
																	<?php }?>

															</td>
															<td>
																<?php 
																	$bandera = 1;
																	if($row['aprobada'] == '1') {
																		echo "<h4 class='aprobada'>" . 'Aprobada' . "</h4>"; 
																		$bandera = 1;
																	}
																	else if($row['aprobada'] == '0') {
																		echo "<h4 class='rechazada'>" . 'Rechazada' . "</h4>"; 
																		$bandera = 0;
																	}
																	else {
																		echo "<h4 class='pendiente'>" . 'Pendiente' . "</h4>";   
																		$bandera = -1;
																	}
																	
																	?>
																	<input type="hidden" value="<?php echo $bandera;?>" name="txt_status">
															</td>
															<td>
																<input name="btt_ver_detalles" type="submit" class="btn btn-primary" value="Detalles">
															</td>
														</form>
													</tr>
										<?php } } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>