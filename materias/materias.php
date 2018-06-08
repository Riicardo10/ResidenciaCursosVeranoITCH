<?php
	require 'MateriaModel.php';
	$materias = new MateriaModel; 
	$count = 0;
	$contador = $materias->getListaMaterias();
	if ($contador){
		while($row = $contador->fetch_assoc()) {
			$count = $count + 1;
		}
	}

	$listaMaterias = $materias->getListaMaterias();
?>
<div class="col panel panel-success col-lg-offset-0">
	<div class="panel-heading text-center">
		<h3>Lista de materias</h3>
	</div>
	<div class="panel-body ">
		<?php echo "<u>Materias: $count</u>";?>
		<a href="../materias/agregar.php"><img src="../img/mas.png" alt="" style="float: right;" title="Agregar" ></a>
		<table class="table">
			<thead>
				<tr>
					<th>Clave</th>
					<th>Materia</th>
					<th>Carrera</th>
					<th>Créditos</th>
					<th>HT / HP</th>
					<th>Semestre</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<?php  
				if ($listaMaterias){
					while($row = $listaMaterias->fetch_assoc()) { ?>
						<tr>
							<th> <?php echo $row['clave']; ?> </th>
							<td> <?php echo $row['materia']; ?> </td>
							<td> <?php echo $row['carrera']; ?> </td>
							<td> <?php echo $row['creditos']; ?> </td>
							<td> <?php echo "ht: " . $row['horas_teoricas'] . ' / hp: ' . $row['horas_practicas'] ; ?> </td>
							<td> <?php echo $row['clave_semestre']; ?> </td>
							<td>
								<a class="btn btn-primary" href="../materias/actualizar.php?clave=<?php echo $row['clave']; ?>">Actualizar</a>
							</td>
							<td>
								 <form action="../materias/MateriaModel.php" method="POST">
								 	<input type="hidden" name="txt_clave" value="<?php echo $row['clave']; ?>">
									<input name="btt_eliminar" type="submit" class="btn btn-danger" value="Eliminar">
								</form>
							</td>
						</tr>
			<?php } } ?>
		</table>
	</div>
</div>

