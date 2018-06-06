<html>
	<head>
		<script src="../js/sweetalert.min.js"></script>
		<script src="../js/sweetAlert_functions.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/sweetalert.css">
	</head>
</html>
<?php 
	class SemestreModel { 
		function getSemestre ( $clave ) { 
			require '../conexion/conexion_mysqli.php';
			$sql = "SELECT * FROM semestres WHERE clave = '$clave'";
			$result = $conexion->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					return $row['semestre'] ;
				}
			} 
			mysqli_close( $conexion );
			return "--";
		}
		function getListaSemestres () { 
			require '../conexion/conexion_mysqli.php';
			$sql = "SELECT * FROM semestres";
			$result = $conexion->query($sql);
			if ($result->num_rows > 0) {
				return $result;
			}
			mysqli_close( $conexion );
			return null;
		}
		function eliminarSemestre ( $clave ) {
			require '../conexion/conexion_mysqli.php';
			$sql = "DELETE FROM semestres WHERE clave = '$clave'";
			mysqli_query( $conexion, $sql );
			if( mysqli_affected_rows( $conexion ) > 0 ){
				echo "<script>mensajeExitoso( 'Bieen!', 'Registro eliminado.' );</script>";
				header("Refresh:1; url=../admin/inicio.php#semestres");
			}
			else{
				echo "<script>mensajeError( 'Upsss!', 'No se eliminó el registro.' );</script>";
				header("Refresh:1; url=../admin/inicio.php");
			}
			mysqli_close( $conexion );
		}
		function actualizarSemestre ( $clave, $semestre ) {
			require '../conexion/conexion_mysqli.php';
			$sql = "UPDATE semestres SET semestre = '$semestre' WHERE clave = '$clave'";
			mysqli_query( $conexion, $sql );
			if( mysqli_affected_rows( $conexion ) > 0 ){
				echo "<script>mensajeExitoso( 'Bieen!', 'Se actualizó el registro.' );</script>";
				header("Refresh:1; url=../admin/inicio.php#semestres");
			}
			else{
				echo "<script>mensajeError( 'Upsss!', 'No se actualizó el registro.' );</script>";
				header("Refresh:1; url=../admin/inicio.php");
			}
			mysqli_close( $conexion );
		}
		function agregarSemestre ( $clave, $semestre ) {
			require '../conexion/conexion_mysqli.php';
			$sql = "INSERT INTO semestres values ( '$clave', '$semestre' )";
			mysqli_query( $conexion, $sql );
			if( mysqli_affected_rows( $conexion ) > 0 ){
				echo "<script>mensajeExitoso( 'Bieen!', 'Se agregó el nuevo registro.' );</script>";
				header("Refresh:1; url=../admin/inicio.php#semestres");
			}
			else{
				echo "<script>mensajeError( 'Upsss!', 'No se agregó el registro. Verifica clave' );</script>";
				header("Refresh:1; url=../semestres/agregar.php");
			}
			mysqli_close( $conexion );
		}
	} 
	// FUNCION DEL SUBMIT DE ACTUALIZAR AREA
	if(isset($_POST['btt_actualizar'])){
		$clave = $_POST['txt_clave'];
		$semestre = $_POST['txt_semestre'];
		$semestre_obj = new SemestreModel; 
		$semestre_obj->actualizarSemestre( $clave, $semestre );
    	} 
	// FUNCION DEL SUBMIT DE ELIMINAR AREA
	if(isset($_POST['btt_eliminar'])){
		$clave =  $_POST['txt_clave'];
		$semestre_obj = new SemestreModel; 
		$semestre_obj->eliminarSemestre( $clave );
	}
	// FUNCION DEL SUBMIT DE AGREGAR AREA
	if(isset($_POST['btt_agregar'])){
		$clave =  $_POST['txt_clave'];
		$semestre = $_POST['txt_semestre'];
		$semestre_obj = new SemestreModel; 
		$semestre_obj->agregarSemestre( $clave, $semestre );
	}
	/*$obj_semestre = new SemestreModel; 
	$nombre_semestre = $obj_semestre->getSemestre( '1' );
	echo $nombre_semestre;*/
?> 
