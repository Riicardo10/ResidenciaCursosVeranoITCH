<?php
	require 'SemestreModel.php';
	$semestres = new SemestreModel; 
	$listaSemestres = $semestres->getListaSemestres();
?>
<div class="col panel panel-success col-lg-offset-0">
	<div class="panel-heading text-center">
		<h3 >Lista de semestres</h3>
	</div>
	<div class="panel-body ">
		<a href="../semestres/agregar.php"><img src="../img/mas.png" alt="" style="float: right;" title="Agregar" ></a>
		<table class="table">
			<thead>
				<tr>
					<th>Clave</th>
					<th>Semestre</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php  
					if ( $listaSemestres ){
						while($row = $listaSemestres->fetch_assoc()) { ?>
							<tr>
								<th> <?php echo $row['clave']; ?> </th>
								<td> <?php echo $row['semestre']; ?> </td>
								<td>
									<a class="btn btn-primary" href="../semestres/actualizar.php?clave=<?php echo $row['clave']; ?>">Actualizar</a>
								</td>
								<td>
									 <form action="../semestres/SemestreModel.php" method="POST">
									 	<input type="hidden" name="txt_clave" value="<?php echo $row['clave']; ?>">
										<input name="btt_eliminar" type="submit" class="btn btn-danger" value="Eliminar">
									</form>
								</td>
							</tr>
				<?php } } ?>
			</tbody>
		</table>
	</div>
</div>