<?php
	session_start();
	if(!isset($_SESSION['sesion']))
			header("location: ../");
?>
<?php
	require '../subdirector/SubdirectorModel.php';
	$sub = new SubdirectorModel;
	$usuario = $sub->getSubdirector($_SESSION['sesion']);
?>
<?php
	require '../carreras/CarreraModel.php';
	$carreras = new CarreraModel; 
	$listaCarreras = $carreras->getListaCarreras();
	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Inicio</title>
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
					echo "Bienvenido subdirector: " . $usuario->nombre . " " . $usuario->apellido_paterno . " " . $usuario->apellido_materno; 
					// $usuario->no_control
				?>
				<a style="float: right;" href="../admin/cerrar_sesion.php">Cerrar sesion</a>	
			</h4>
			
			<div class="row">
				<div class="col-xs-2"></div>
				<div class="col-xs-8">
					<form action="configuracion.php" method="POST">
						<input type="hidden" value="<?php echo $usuario->email ?>" name="txt_email">
						<input type="submit" value="Configurar cuenta" class="btn-link">
					</form>
					<hr>
					<div class="col panel panel-success col-lg-offset-0">
						<div class="panel-heading text-center">
							<?php $anio = Date('Y');?>
							<h3 >Verano <?php echo  $anio; ?> </h3>
						</div>
						<div class="panel-body ">
							<table class="table">
									<tr style="text-align: center;">
										<td><b>Selecciona plan de estudios</b></td>
									</tr>
								<tbody>
									<?php  
										if ( $listaCarreras ){
											while($row = $listaCarreras->fetch_assoc()) { ?>
												<tr style="text-align: center;">
													<td>
														 <form action="../subdirector/materias_solicitadas_por_carrera.php" method="GET">
														 	<input type="hidden" name="txt_carrera_id" value="<?php echo $row['clave']; ?>">
														 	<input type="hidden" name="txt_carrera_nombre" value="<?php echo $row['carrera']; ?>">
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