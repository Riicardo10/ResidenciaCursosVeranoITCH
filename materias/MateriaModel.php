<html>
	<head>
		<script src="../js/sweetalert.min.js"></script>
		<script src="../js/sweetAlert_functions.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/sweetalert.css">
	</head>
</html>
<?php 
	class MateriaModel { 
		function getMateria ( $clave ) { 
			require '../conexion/conexion_mysqli.php';
			$sql = "SELECT * FROM materias WHERE clave = '$clave'";
			$result = $conexion->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					return (object) array(
						'clave' => $row['clave'] ,
						'materia' => $row['materia'],
						'creditos' => $row['creditos'],
						'clave_carrera' => $row['clave_carrera'],
						'clave_semestre' => $row['clave_semestre']
					);
				}
			} 
			mysqli_close( $conexion );
			return null;
		}
		function getListaMaterias () { 
			require '../conexion/conexion_mysqli.php';
			$sql = "SELECT materias.clave, materias.materia, carreras.carrera, materias.creditos, materias.clave_semestre FROM materias JOIN semestres JOIN carreras WHERE materias.clave_carrera = carreras.clave AND materias.clave_semestre = semestres.clave ORDER BY carrera ASC, clave_semestre ASC;";
			$result = $conexion->query($sql);
			if ($result->num_rows > 0) {
				return $result;
			}
			mysqli_close( $conexion );
			return null;
		}
		// function darAltaProfesor ( $clave ) {
		// 	require '../conexion/conexion_mysqli.php';
		// 	$sql = "UPDATE profesores SET status = 1 WHERE clave = '$clave'";
		// 	mysqli_query( $conexion, $sql );
		// 	if( mysqli_affected_rows( $conexion ) > 0 ){
		// 		echo "<script>mensajeExitoso( 'Bieen!', 'Registro dado de alta.' );</script>";
		// 		header("Refresh:1; url=../admin/inicio.php#profesores");
		// 	}
		// 	else{
		// 		echo "<script>mensajeError( 'Upsss!', 'No se dió de alta el registro.' );</script>";
		// 		header("Refresh:1; url=../admin/inicio.php");
		// 	}
		// 	mysqli_close( $conexion );
		// }
		function eliminarMateria ( $clave ) {
			require '../conexion/conexion_mysqli.php';
			$sql = "DELETE FROM materias WHERE clave = '$clave'";
			mysqli_query( $conexion, $sql );
			if( mysqli_affected_rows( $conexion ) > 0 ){
				echo "<script>mensajeExitoso( 'Bieen!', 'Registro eliminado.' );</script>";
				header("Refresh:1; url=../admin/inicio.php#materias");
			}
			else{
				echo "<script>mensajeError( 'Upsss!', 'El registro no se pudo eliminar.' );</script>";
				header("Refresh:1; url=../admin/inicio.php#materias");
			}
			mysqli_close( $conexion );
		}
		function actualizarMateria ( $clave, $materia, $creditos, $carrera, $semestre ) {
			require '../conexion/conexion_mysqli.php';
			$sql = "UPDATE materias SET materia = '$materia', creditos = '$creditos', clave_carrera = '$carrera', clave_semestre = '$semestre' WHERE clave = '$clave'";
			mysqli_query( $conexion, $sql );
			if( mysqli_affected_rows( $conexion ) > 0 ){
				echo "<script>mensajeExitoso( 'Bieen!', 'Se actualizó el registro.' );</script>";
				header("Refresh:1; url=../admin/inicio.php#materias");
			}
			else{
				echo "<script>mensajeError( 'Vaya!', 'No se realizaron cambios en el registro.' );</script>";
				header("Refresh:1; url=../admin/materias.php");
			}
			mysqli_close( $conexion );
		}
		function agregarMateria ( $clave, $materia, $creditos, $clave_carrera, $clave_semestre ) {
			require '../conexion/conexion_mysqli.php';
			$sql = "INSERT INTO materias values ( '$clave', '$materia', $creditos, '$clave_carrera', '$clave_semestre')";
			mysqli_query( $conexion, $sql );
			if( mysqli_affected_rows( $conexion ) > 0 ){
				echo "<script>mensajeExitoso( 'Bieen!', 'Se agregó el nuevo registro.' );</script>";
				//header("Refresh:1; url=../admin/inicio.php#materias");
				header("Refresh:1; url=../materias/agregar.php");
			}
			else{
				echo "<script>mensajeError( 'Upsss!', 'No se agregó el registro. Verifica clave' );</script>";
				header("Refresh:1; url=../materias/agregar.php");
			}
			mysqli_close( $conexion );
		}
	} 
	// FUNCION DEL SUBMIT PARA ACTUALIZAR AL PROFESOR
	if(isset($_POST['btt_actualizar'])){
		$clave =  $_POST['txt_clave'];
		$materia =  $_POST['txt_materia'];
		$carrera =  $_POST['txt_carrera'];
		$creditos =  $_POST['txt_creditos'];
		$semestre =  $_POST['txt_semestre'];
		$materia_obj = new MateriaModel; 
		$materia_obj->actualizarMateria( $clave, $materia, $creditos, $carrera, $semestre );
    	} 
	// FUNCION DEL SUBMIT DE DAR DE BAJA AL PROFESOR
	if(isset($_POST['btt_eliminar'])){
		$clave =  $_POST['txt_clave'];
		$materia_obj = new MateriaModel; 
		$materia_obj->eliminarMateria( $clave );
	}
	// FUNCION DEL SUBMIT DE AGREGAR PROFESOR
	if(isset($_POST['btt_agregar'])){
		$clave =  $_POST['txt_clave'];
		$materia =  $_POST['txt_materia'];
		$carrera =  $_POST['txt_carrera'];
		$creditos =  $_POST['txt_creditos'];
		$semestre =  $_POST['txt_semestre'];
		$materia_obj = new MateriaModel; 
		$materia_obj->agregarMateria( $clave, $materia, $creditos, $carrera, $semestre );
	}
	/*$obj_semestre = new SemestreModel; 
	$nombre_semestre = $obj_semestre->getSemestre( '1' );
	echo $nombre_semestre;*/
?> 
