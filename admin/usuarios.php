
<?php
	
	$listaUsuariosCoordinadores = $admin->getListaUsuariosCoordinadoresConDatos();
	$listaUsuariosJefesDepartamento = $admin->getListaUsuariosJefesConDatos();
?>

<div class="row">
	<div class="col-xs-5">
		<hr>
		<input type="button" value="Ver coordinadores" onclick="verCoordinadores()" class="btn btn-success">
		<div id="tabla_coordinadores" style="display: none;">
			<?php
				if ($listaUsuariosCoordinadores){
					$tabla = "<table class='table'>";
					$tabla .= "<th>No. de control</th>";
					$tabla .= "<th>Nombre</th>";
					$tabla .= "<th>Apellidos</th>";
					$tabla .= "<th>Telefono</th>";
					$tabla .= "<th>Email</th>";
					$tabla .= "<th>Contrasenia</th>";
					while($row = $listaUsuariosCoordinadores->fetch_assoc()) {
						$tabla .= "<tr>";
							$tabla .= "<td>" . $row['no_control_coordinador'] . "</td>";
							$tabla .= "<td>" . $row['nombre'] . "</td>";
							$tabla .= "<td>" . $row['apellido_paterno'] . " " . $row['apellido_materno'] . "</td>";
							$tabla .= "<td>" . $row['telefono'] . "</td>";
							$tabla .= "<td>" . $row['email'] . "</td>";
							$tabla .= "<td>" . $row['contrasenia'] . "</td>";
						$tabla .= "</tr>";
					}
					$tabla .= "</table>";
					echo $tabla;
				}
			?>
		</div>
	</div>
	<div class="col-xs-1"></div>
	<div class="col-xs-5">
		<hr>
		<input type="button" value="Ver jefes" onclick="verJefes()" class="btn btn-success">
		<div id="tabla_jefes" style="display: none;">
			<?php
				if ($listaUsuariosJefesDepartamento){
					$tabla = "<table class='table'>";
					$tabla .= "<th>No. de control</th>";
					$tabla .= "<th>Nombre</th>";
					$tabla .= "<th>Apellidos</th>";
					$tabla .= "<th>Telefono</th>";
					$tabla .= "<th>Email</th>";
					$tabla .= "<th>Contrasenia</th>";
					while($row = $listaUsuariosJefesDepartamento->fetch_assoc()) {
						$tabla .= "<tr>";
							$tabla .= "<td>" . $row['clave'] . "</td>";
							$tabla .= "<td>" . $row['nombre'] . "</td>";
							$tabla .= "<td>" . $row['apellido_paterno'] . " " . $row['apellido_materno'] . "</td>";
							$tabla .= "<td>" . $row['telefono'] . "</td>";
							$tabla .= "<td>" . $row['email'] . "</td>";
							$tabla .= "<td>" . $row['contrasenia'] . "</td>";
						$tabla .= "</tr>";
					}
					$tabla .= "</table>";
					echo $tabla;
				}
			?>
		</div>
	</div>
</div>
<script>
	var bandera_coordinadores = 0;
	function verCoordinadores(){
		if(bandera_coordinadores == 0){
			document.getElementById("tabla_coordinadores").style.display = 'block'
			bandera_coordinadores = 1;
		}
		else{
			document.getElementById("tabla_coordinadores").style.display = 'none'
			bandera_coordinadores = 0;	
		}
	}
	var bandera_jefes = 0;
	function verJefes(){
		if(bandera_jefes == 0){
			document.getElementById("tabla_jefes").style.display = 'block'
			bandera_jefes = 1;
		}
		else{
			document.getElementById("tabla_jefes").style.display = 'none'
			bandera_jefes = 0;	
		}
	}
</script>