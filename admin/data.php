
<?php
	require 'AdminModel.php';
	$admin = new AdminModel; 
	$listaUsuariosJefesDepartamento = $admin->getListaUsuariosJefesDepartamento();
	$listaUsuariosCoordinadores = $admin->getListaUsuariosCoordinadores();
?>
<div class="row">
	<div class="col-xs-1"></div>
	<div class="col-xs-5">
		<div class="col panel panel-success col-lg-offset-0">
			<div class="panel-heading text-center">
				<h3 >Usuarios de los Jefes de Departamento</h3>
			</div>
			<div class="row">
				<div class="panel-body ">
					<table class="table">
						<thead>
							<tr>
								<th>Usuario</th>
								<th>Contrasenia</th>
								<th>Tipo</th>
							</tr>
						</thead>
						<tbody>
							<?php  
								if ($listaUsuariosJefesDepartamento){
									while($row = $listaUsuariosJefesDepartamento->fetch_assoc()) { ?>
										<tr>
											<td> <?php echo $row['usuario']; ?> </td>
											<td> <?php echo $row['contrasenia']; ?> </td>
											<td> Jefe Académico </td>
										</tr>
							<?php } } ?>
						</tbody>
					</table>
				</div>	
			</div>
		</div>
	</div>
	<div class="col-xs-5">
		<div class="col panel panel-success col-lg-offset-0">
			<div class="panel-heading text-center">
				<h3 >Usuarios de los Coordinadores</h3>
			</div>
			<div class="row">
				<div class="panel-body ">
					<table class="table">
						<thead>
							<tr>
								<th>Usuario</th>
								<th>Contrasenia</th>
								<th>Tipo</th>
							</tr>
						</thead>
						<tbody>
							<?php  
								if ($listaUsuariosCoordinadores){
									while($row = $listaUsuariosCoordinadores->fetch_assoc()) { ?>
										<tr>
											<td> <?php echo $row['no_control_coordinador']; ?> </td>
											<td> <?php echo $row['contrasenia']; ?> </td>
											<td> Coordinador de materia </td>
										</tr>
							<?php } } ?>
						</tbody>
					</table>
				</div>	
			</div>
		</div>
	</div>
</div>