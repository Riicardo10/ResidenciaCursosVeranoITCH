<?php
	session_start();
	if(!isset($_SESSION['sesion']))
			header("location: ../");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Administrador</title>
		<?php	require '../styles-scripts.php';?>
	</head>
	<body>
		<div class="container">
			<?php	require '../banner/banner.php'; ?>
			<hr>
			<div class="container">
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a>
					</li>
					<li class="nav-item"> 
						<a class="nav-link" id="usuarios-tab" data-toggle="tab" href="#usuarios" role="tab" aria-controls="usuarios" aria-selected="false">Usuarios</a>
					</li>
					<li class="nav-item"> 
						<a class="nav-link" id="areas-tab" data-toggle="tab" href="#areas" role="tab" aria-controls="areas" aria-selected="false">Areas</a>
					</li>
					<li class="nav-item"> 
						<a class="nav-link" id="carreras-tab" data-toggle="tab" href="#carreras" role="tab" aria-controls="carreras" aria-selected="false">Carreras</a>
					</li>
					<li class="nav-item"> 
						<a class="nav-link" id="semestres-tab" data-toggle="tab" href="#semestres" role="tab" aria-controls="semestres" aria-selected="false">Semestres</a>
					</li>
					<li class="nav-item"> 
						<a class="nav-link" id="materias-tab" data-toggle="tab" href="#materias" role="tab" aria-controls="materias" aria-selected="false">Materias</a>
					</li>
					<li class="nav-item"> 
						<a class="nav-link" id="jefes-depto-tab" data-toggle="tab" href="#jefes-depto" role="tab" aria-controls="jefes-depto" aria-selected="false">Jefes de departamento</a>
					</li>
					<li class="nav-item"> 
						<a class="nav-link" id="profesores-tab" data-toggle="tab" href="#profesores" role="tab" aria-controls="profesores" aria-selected="false">Profesores</a>
					</li>
					<li class="nav-item"> 
						<a class="nav-link" id="coordinadores-tab" data-toggle="tab" href="#coordinadores" role="tab" aria-controls="coordinadores" aria-selected="false">Coordinadores</a>
					</li>
					<li class="nav-item"> 
						<a class="nav-link" id="configuracion-tab" data-toggle="tab" href="#configuracion" role="tab" aria-controls="configuracion" aria-selected="false">Configuracion de cuenta</a>
					</li>
					<li class="nav-item"> 
						<a class="nav-link" href="../admin/cerrar_sesion.php"> Cerrar sesion </a>
					</li>
				</ul>
				<?php require 'tabs.php'; ?>
			</div>
		</div>
	</body>
	<script>
		var hash = window.location.hash;
		$(function () {
			if( hash == "#usuarios" )
				$('#usuarios-tab').tab('show')
			else if( hash == "#areas" )
				$('#areas-tab').tab('show');
			else if( hash == "#carreras" )
				$('#carreras-tab').tab('show');
			else if( hash == "#semestres" )
				$('#semestres-tab').tab('show');
			else if( hash == "#materias" )
				$('#materias-tab').tab('show');
			else if( hash == "#coordinadores" )
				$('#coordinadores-tab').tab('show');
			else if( hash == "#profesores" )
				$('#profesores-tab').tab('show')
			else if( hash == "#jefes-depto" )
				$('#jefes-depto-tab').tab('show')
			else
				$('#general-tab').tab('show')
		})
	</script>
</html>