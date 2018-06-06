<?php
	session_start();
	if(!isset($_SESSION['sesion']))
			header("location: ../");
?>
<?php
	require '../jefes/JefeModel.php';
	$jefe = new JefeModel;
	require '../carreras/CarreraModel.php';
	$carreras = new CarreraModel; 
	$listaCarreras = $carreras->getListaCarreras();
	$usuario = $jefe->getJefe($_SESSION['sesion']);
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
		</style>
	</head>
	<body>
		<div class="container">
			<?php require '../banner/banner.php'; ?>
			<hr>

			<h4 style="text-align: center;">
				<?php 
					echo "Bienvenido jefe académico: " . $usuario->nombre . " " . $usuario->apellido_paterno . " " . $usuario->apellido_materno; 
				?>
				<a style="float: right;" href="../admin/cerrar_sesion.php">Cerrar sesion</a>	
			</h4>
			
			<div class="row">
				<div class="col-xs-2"></div>
				<div class="col-xs-8">
					<hr>
					<div class="col panel panel-success col-lg-offset-0">
						<div class="panel-heading text-center">
							<h3 >Selecciona el plan de estudios de la carrera</h3>
						</div>
						<div class="panel-body ">
							<table class="table">
									<tr style="text-align: center;">
										<td><b>Plan de estudios</b></td>
									</tr>
								<tbody>
									<?php  
										if ( $listaCarreras ){
											while($row = $listaCarreras->fetch_assoc()) { ?>
												<tr style="text-align: center;">
													<td>
														 <form action="../jefes/lista_materias.php" method="GET">
														 	<input type="hidden" name="id" value="<?php echo $row['clave']; ?>">
														 	<input type="hidden" name="nombre" value="<?php echo $row['carrera']; ?>">
														 	<input name="btt_carrera" type="submit" class="carrera btn btn-default" value="<?php echo $row['carrera']; ?>">
														</form>
													</td>
												</tr>
									<?php } } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-xs-1"></div>
			</div>
		</div>
	</body>
</html>