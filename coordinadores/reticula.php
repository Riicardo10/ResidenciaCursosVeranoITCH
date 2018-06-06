<?php
	session_start();
	if(!isset($_SESSION['sesion']))
			header("location: ../");
?>
<?php
	$carrera_id = $_POST['txt_carrera_id'];
	$carrera_nombre = $_POST['txt_carrera_nombre'];
	require 'CoordinadorModel.php';
	$reticula = new CoordinadorModel; 
	//$listaReticula = $reticula->getReticula( $carrera_id );
	$cantidad_semestres = $reticula->getCantidadSemestresDeLaCarrera($carrera_id)->max;
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Reticula</title>
		<?php	require '../styles-scripts.php';?>
		<style>
			.col-xs-1{
				border: 0px solid black;
			}
			.materia{
				white-space: normal;
				width: 125%;
				height: 15%;
			}
		</style>
	</head>
	<body>
		<?php	require '../banner/banner.php'; ?>
		<hr>
		<h3 style="text-align: center;"> Retícula: <?php echo $carrera_nombre ?> </h3>
		<center>
			<form action="materia_pedida.php" method="POST">
				<input type="hidden" name="txt_carrera_id" value="<?php echo $carrera_id ?>">
			<div class="row">
				<?php
					for($i=1; $i<=$cantidad_semestres; $i++){
						$materias_semestres = $reticula->getListaMateriasPorSemestre($carrera_id, $i);
						echo "<div class='col-xs-1'>";
						echo "<b>Semestre $i</b>";
						if ( $materias_semestres ){
							while($row = $materias_semestres->fetch_assoc()) { 
				?>
				<!-- FORMULARIOS -->
								<input type="hidden" name="txt_materia_id" value=" <?php echo $row['clave'] ?> 
								">
								<input type="hidden" name="<?php echo $row['materia']?>" value="<?php echo $row['materia']?>
								">
								<input class='materia btn btn-primary' type="button" value=" <?php echo $row['materia'];?>">
								<input type="checkbox" name="txt_materia_<?php echo $row['clave'] ?>" value=" <?php echo $carrera_id ?> ">
								<?php echo "<cite>" . "Cred. " . $row['creditos'] . "</cite>"; ?>
				<?php
							}
							echo "</div>";
						}
					}
				?>
			</div>
				<center>
					<a class="btn btn-danger"  href="inicio.php">Salir</a>
					<input type="submit" value=" Guardar " class="btn btn-success" name="btt_registrar_materias">
				</center>
			</form>
		</center>
	</body>
</html>


