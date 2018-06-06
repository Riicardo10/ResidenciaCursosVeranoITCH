<?php
	session_start();
	if(!isset($_SESSION['sesion']))
			header("location: ../");
?>

<?php
	require 'CoordinadorModel.php';
	//$carrera_id = $_GET['c'];
	$objeto = new CoordinadorModel; 
	$lista_materias_solicitadas = $objeto->getMateriasSolicitadas( $_SESSION['sesion'] );
	$usuario = $objeto->getCoordinador($_SESSION['sesion']);
?>


<!DOCTYPE html>
<html>
	<head>
		<title>Carrera</title>
		<?php	require '../styles-scripts.php';?>
		<style>
			.carrera{
				width: 80%;
			}
			.materia{
				width: 55%;
			}
			.notificacion{
				padding: 1%;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<?php	require '../banner/banner.php'; ?>
			<hr>
			<div class="row">
				<div class="col-xs-2"></div>
				<div class="col-xs-8">
					<div class="col panel panel-success col-lg-offset-0">
						<div class="panel-heading text-center">
							<h3 >Materias a solicitar</h3>
						</div>
						<h4 style="text-align: center;">
							<?php 
								echo "Coordinador: " . $usuario->nombre . " " . $usuario->apellido_paterno . " " . $usuario->apellido_materno; 
							?>
						</h4>
						<div class="panel-body ">
							<table class="table">
								<tbody>
									<?php  
										if( $lista_materias_solicitadas ){
											while($row = $lista_materias_solicitadas->fetch_assoc()) {
									?>
											<tr style="text-align: center;">
												<td>
													<form action="lista_materia.php" method="POST">
														<input type="hidden" name="txt_carrera_id" value="<?php echo $carrera_id ?>">
														<input type="hidden" name="txt_id_materia_solicitada" value="<?php echo $row['id'] ?>">
													 	<input type="hidden" name="txt_materia_id" value="<?php echo $row['clave_materia'] ?>">
													 	<input type="hidden" name="txt_materia_nombre" value="<?php echo $row['nombre_materia'] ?>">
													 	<?php 
													 		if ( $row['aprobada'] == 0 ) 
													 			echo "<b class='notificacion'>Pendiente</b>";
													 		else if ( $row['aprobada'] == 1 ) 
													 			echo "<b class='notificacion' style='background: green; color: white;'>Aprobada</b>";
													 		else
													 			echo "<b class='notificacion' style='background: red; color: white;'>Rechazada</b>";
													 	?>
													 	<input type="button" class="materia btn btn-primary" name="txt_materia_nombre" value="<?php echo $row['nombre_materia'] ?>">
													 	<input type="submit" class="btn btn-success" name="btt_lista_materia_solicitada" value="Lista">
													 	<!-- <input type="submit" class="btn btn-danger" name="btt_eliminar_materia_solicitada" value="Eliminar"> -->
													 	<a href="eliminar_materia.php?materia=<?php echo $row['id'];  ?>" class="btn btn-danger">Eliminar</a>
													 	<a href="pdf_materia.php?materia=<?php echo $row['id'];  ?>" class="btn btn-info">PDF</a>
													</form>
												</td>
											</tr>
									<?php }}
									else{
										echo "<center><h3>AUN NO HAS SOLICITADO MATERIAS</h3></center>";
									} ?>
								</tbody>
							</table>
							<a class=""  href="inicio.php">Cancelar</a>
						</div>
					</div>
				</div>
				<div class="col-xs-1"></div>
			</div>
		</div>
	</body>
</html>