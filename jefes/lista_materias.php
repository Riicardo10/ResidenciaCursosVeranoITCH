<?php
	$id_carrera = $_GET['id'];
	$nombre_carrera = $_GET['nombre'];
?>

<?php
	session_start();
	if(!isset($_SESSION['sesion']))
			header("location: ../");	
?>
<?php
	require 'JefeModel.php';
	$jefe = new JefeModel;
	$usuario = $jefe->getJefe($_SESSION['sesion']);
	$lista = $jefe->getListaMateriasPorCarrera( $id_carrera );	
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
				<?php 
					echo "Jefe académico: " . $usuario->nombre . " " . $usuario->apellido_paterno . " " . $usuario->apellido_materno; 
				?>
				<a style="float: right;" href="../admin/cerrar_sesion.php">Cerrar sesion</a>	
			</h4>
			
			<div class="row">
				<div class="col-xs-12">
					<hr>
					<div class="col panel panel-success col-lg-offset-0">
						<div class="panel-heading text-center">
							<?php $anio = Date('Y');?>
							<h3 >Materias solicitadas <?php echo $anio?></h3>
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
														<form action="../jefes/detalles_materia.php" method="POST">
															<input type="hidden" name="id_carrera" value="<?php echo $id_carrera; ?>">
															<input type="hidden" name="nombre_carrera" value="<?php echo $nombre_carrera; ?>">
															<input type="hidden" name="id_materia_solicitada" value="<?php echo $row['id']; ?>">
											 				<input type="hidden" name="id_materia" value="<?php echo $row['clave_materia']; ?>">
											 				<input type="hidden" name="nombre_materia" value="<?php echo $row['nombre_materia']; ?>">
											 				<input type="hidden" name="aprobada_db" value="<?php echo $row['aprobada']; ?>">
											 				<input type="hidden" name="aprobada" value="<?php 
											 					if($row['aprobada'] == '1') echo 'Si'; 
											 					else if($row['aprobada'] == '0') echo 'Pendiente'; 
											 					else echo 'No';  ?>">
											 				<input type="hidden" name="no_control" value="<?php echo $row['no_control']; ?>">
											 				<input type="hidden" name="clave_profesor" value="<?php echo $row['clave_profesor']; ?>">
											 				<input type="hidden" name="nombre_coordinador" value="<?php 
															 	echo $row['nombre'] . ' ' . $row['apellido_paterno'] . ' ' . $row['apellido_materno']  ; ?>">
															 	
															<td>
																<?php echo $row['id']; ?>
															</td>
															<td>
																<?php echo $row['nombre_materia']; ?>
															</td>
															<td>
																<?php echo $row['no_control'] . " - " . $row['nombre'] . " " . $row['apellido_paterno'] . " " . $row['apellido_materno']; ?>
															</td>
															<td>
																<?php 
																	if( $row['clave_profesor'] ) {
																		$profesor = $jefe->getProfesor( $row['clave_profesor'] );
																		echo $profesor->nombre . " " . $profesor->apellido_paterno . " " . $profesor->apellido_materno;
																	}
																	else
																		echo "<h4 style='color:red;'>" . 'Sin profesor asignado' . "</h4>";
																?>
															</td>
															<td>
																<?php 
																	if($row['aprobada'] == '1') echo "<h4 class='aprobada'>" . 'Aprobada' . "</h4>"; 
																	else if($row['aprobada'] == '0') echo "<h4 class='rechazada'>" . 'Rechazada' . "</h4>"; 
																	else echo "<h4 class='pendiente'>" . 'Pendiente' . "</h4>";   ?>
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