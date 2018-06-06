<?php
	require 'AreaModel.php';
	$areas = new AreaModel; 
	$listaAreas = $areas->getListaAreas();
?>
<div class="col panel panel-success col-lg-offset-0">
	<div class="panel-heading text-center">
		<h3 >Lista de áreas</h3>
	</div>
	<div class="panel-body ">
		<a href="../areas/agregar.php"><img src="../img/mas.png" alt="" style="float: right;" title="Agregar" ></a>
		<table class="table">
			<thead>
				<tr>
					<th>Clave</th>
					<th>Área</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php  
					if ($listaAreas){
						while($row = $listaAreas->fetch_assoc()) { ?>
							<tr>
								<th> <?php echo $row['clave']; ?> </th>
								<td> <?php echo $row['area']; ?> </td>
								<td>
									<a class="btn btn-primary" href="../areas/actualizar.php?clave=<?php echo $row['clave']; ?>">Actualizar</a>
								</td>
								<td>
									 <form action="../areas/AreaModel.php" method="POST">
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