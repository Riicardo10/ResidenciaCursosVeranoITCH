<?php 
	$id = $_GET['txt_id'];
	$coordinador = $_GET['txt_coordinador'];
	$profesor = $_GET['txt_profesor'];
	$materia = $_GET['txt_materia'];
	$status = $_GET['txt_status'];
	$a = $_GET['txt_carrera_id'];
	$b = $_GET['txt_carrera_nombre'];
?>



<!DOCTYPE html>
<html>
	<head>
		<title>Aprobacion de materia</title>
		<?php	require '../styles-scripts.php';?>
	</head>
	<body>
		<div class="container">
			<?php	require '../banner/banner.php'; ?>
			<div class="row">
				<div class="col panel panel-success col-lg-13 col-lg-offset-0">
					<div class="panel-heading text-center">
						<h1 >Aprobacion de materia</h1>
					</div>
					<div class="panel-body ">
						<form action="SubdirectorModel.php" method="POST">
							<div class="row form-group text-center">
								<div class="col-xs-2">
									<label for="txt_id" style="text-align: left; font-size: 20px;width: 200px;">ID materia:</label>
									<input type="text" name="txt_id" style="width: 200px; font-size: 20px" readonly value="<?php echo $id;?> ">
								</div>
								<div class="col-xs-5">
									<label for="txt_materia" style="text-align: left; font-size: 20px;width: 200px;">Materia:</label>
									<input type="text" name="txt_materia" style="width: 300px; font-size: 20px" readonly value="<?php echo $materia; ?>">
								</div>
								<div class="col-xs-5">
									<label for="txt_coordinador" style="text-align: left; font-size: 20px;width: 200px;">Coordinador :</label>
									<input type="text" name="txt_coordinador" style="width: 300px; font-size: 20px" readonly value="<?php echo $coordinador; ?>">
								</div>
							</div>
							<div class="row form-group text-center">
								<div class="col-xs-2"></div>
								<div class="col-xs-5">
									<label for="txt_profesor" style="text-align: left; font-size: 20px;width: 200px;">Profesor:</label>
									<input type="text" name="txt_profesor" style="width: 300px; font-size: 20px" readonly value="<?php echo $profesor;?>">
									<input type="hidden" name="txt_a" style="width: 300px; font-size: 20px" readonly value="<?php echo $_GET['txt_carrera_id'];?>">
									<input type="hidden" name="txt_b" style="width: 300px; font-size: 20px" readonly value="<?php echo $_GET['txt_carrera_nombre'];?>">
								</div>
								<div class="col-xs-1" style=""></div>
								<div class="col-xs-5" style="">
									<label for="txt_status" style="text-align: left; font-size: 20px;width: 200px;">Aprobada:</label>
									<input type="checkbox" class="form-control" name="txt_status" id="txt_status">
								</div>
							</div>
							<div class="row form-group text-center" style="margin-top: 2%">
								<div class="col-xs-4"></div>
								<div class="col-xs-2"></div>
								<div class="col-xs-6">
									 <div class="form-group col-lg-9 col-lg-offset-3 right text-center" >
							 			<a href="inicio.php" class="btn btn-danger" style="width: 150px">Cancelar</a>
										<input type="submit" name="btt_aprobar_materia" class="btn btn-success" style="width: 150px" value="Aceptar">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>

	<script>
		// PONER EL CHECK ACTIVO / INACTIVO
		var status = "<?php echo $status ?>" ;
		if( status == 1 ) 
			document.getElementById('txt_status').checked = true;
		else if( status == 0 ) 
			document.getElementById('txt_status').checked = false;
	</script>
</html>
