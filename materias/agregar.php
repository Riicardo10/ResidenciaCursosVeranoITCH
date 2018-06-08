<?php
	session_start();
	if(!isset($_SESSION['sesion']))
			header("location: ../");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Registro de materias</title>
		<?php	require '../styles-scripts.php';?>
		<?php 
			require '../carreras/CarreraModel.php';
			$carreras = new CarreraModel; 
			$listaCarreras = $carreras->getListaCarreras();
		?>
		<?php 
			require '../semestres/SemestreModel.php';
			$semestres = new SemestreModel; 
			$listaSemestres = $semestres->getListaSemestres();
		?>
	</head>
	<body>
		<div class="container">
			<?php	require '../banner/banner.php'; ?>
			<div class="row">
				<div class="col panel panel-success col-lg-13 col-lg-offset-0">
					<div class="panel-heading text-center">
						<h1 >Registro de materias</h1>
					</div>
					<div class="panel-body ">
						<form action="MateriaModel.php" method="POST">
							<div class="row form-group text-center">
								<div class="col-xs-2"></div>
								<div class="col-xs-4">
									<label for="txt_clave" style="text-align: left; font-size: 20px;width: 200px;">Clave:</label>
									<input type="text" name="txt_clave" style="width: 200px; font-size: 20px" required>
								</div>
								<div class="col-xs-4">
									<label for="txt_materia" style="text-align: left; font-size: 20px;width: 200px;">Materia:</label>
									<input type="text" name="txt_materia" style="width: 200px; font-size: 20px" required>
								</div>
							</div>
							<div class="row form-group text-center">
								<div class="col-xs-4" style="">
									<label for="txt_carrera" style="text-align: left; font-size: 20px;width: 200px;">Carrera:</label>
									<select name="txt_carrera" class="form-control" style="width: 280px">
										<?php
											while($row = $listaCarreras->fetch_assoc()) 
												echo "<option value=". $row['clave'] .">" . $row['carrera'] . "</option>";
										?>
									</select>
								</div>
								<div class="col-xs-4" style="">
									<label for="txt_semestre" style="text-align: left; font-size: 20px;width: 200px;">Semestre:</label>
									<select name="txt_semestre" class="form-control" style="width: 280px">
										<?php
											while($row = $listaSemestres->fetch_assoc()) 
												echo "<option value=". $row['clave'] .">" . $row['semestre'] . "</option>";
										?>
									</select>
								</div>
								<div class="col-xs-4" style="">
									<label for="txt_creditos" style="text-align: left; font-size: 20px;width: 200px;">Créditos:</label>
									<input type="number" name="txt_creditos" style="width: 200px; font-size: 20px" min="1" max="10" required>
								</div>
							</div>
							<div class="row form-group text-center">
								<div class="col-xs-2"></div>
								<div class="col-xs-4">
									<label for="txt_horas_teoricas" style="text-align: left; font-size: 20px;width: 200px;">Horas teoricas:</label>
									<input type="number" name="txt_horas_teoricas" style="width: 200px; font-size: 20px" required>
								</div>
								<div class="col-xs-4">
									<label for="txt_horas_practicas" style="text-align: left; font-size: 20px;width: 200px;">Horas practicas:</label>
									<input type="number" name="txt_horas_practicas" style="width: 200px; font-size: 20px" required>
								</div>
							</div>
							<div class="row form-group text-center" style="margin-top: 2%">
								<div class="form-group col-lg-6 col-lg-offset-3 right text-center"> 
									<a href="../admin/inicio.php#materias" class="btn btn-danger" style="width: 150px">Cancelar</a>
									<input type="submit" name="btt_agregar" class="btn btn-success" style="width: 150px" value="Registrar">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>