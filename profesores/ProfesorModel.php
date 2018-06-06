<html>
	<head>
		<script src="../js/sweetalert.min.js"></script>
		<script src="../js/sweetAlert_functions.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/sweetalert.css">
	</head>
</html>
<?php 
	class ProfesorModel { 
		function getProfesor ( $clave ) { 
			require '../conexion/conexion_mysqli.php';
			$sql = "SELECT * FROM profesores WHERE clave = '$clave'";
			$result = $conexion->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					//return ;
					return (object) array(
						'clave' => $row['clave'] ,
						'nombre' => $row['nombre'],
						'apellido_paterno' => $row['apellido_paterno'],
						'apellido_materno' => $row['apellido_materno'],
						'email' => $row['email'],
						'telefono' => $row['telefono'],
						'status' => $row['status'],
						'clave_area' => $row['clave_area'],
					);
				}
			} 
			mysqli_close( $conexion );
			return null;
		}
		function getListaProfesores () { 
			require '../conexion/conexion_mysqli.php';
			$sql = "SELECT * FROM profesores";
			$result = $conexion->query($sql);
			if ($result->num_rows > 0) {
				return $result;
			}
			mysqli_close( $conexion );
			return null;
		}
		function darAltaProfesor ( $clave ) {
			require '../conexion/conexion_mysqli.php';
			$sql = "UPDATE profesores SET status = 1 WHERE clave = '$clave'";
			mysqli_query( $conexion, $sql );
			if( mysqli_affected_rows( $conexion ) > 0 ){
				echo "<script>mensajeExitoso( 'Bieen!', 'Registro dado de alta.' );</script>";
				header("Refresh:1; url=../admin/inicio.php#profesores");
			}
			else{
				echo "<script>mensajeError( 'Upsss!', 'No se dió de alta el registro.' );</script>";
				header("Refresh:1; url=../admin/inicio.php");
			}
			mysqli_close( $conexion );
		}
		function darBajaProfesor ( $clave ) {
			require '../conexion/conexion_mysqli.php';
			$sql = "UPDATE profesores SET status = 0 WHERE clave = '$clave'";
			mysqli_query( $conexion, $sql );
			if( mysqli_affected_rows( $conexion ) > 0 ){
				echo "<script>mensajeExitoso( 'Bieen!', 'Registro dado de baja.' );</script>";
				header("Refresh:1; url=../admin/inicio.php#profesores");
			}
			else{
				echo "<script>mensajeError( 'Upsss!', 'El registro ya está dado de baja.' );</script>";
				header("Refresh:1; url=../admin/inicio.php#profesores");
			}
			mysqli_close( $conexion );
		}
		function actualizarProfesor ( $clave, $nombre, $apellido_paterno, $apellido_materno, $email, $telefono, $status, $area ) {
			require '../conexion/conexion_mysqli.php';
			$sql = "UPDATE profesores SET nombre = '$nombre', apellido_paterno = '$apellido_paterno', apellido_materno = '$apellido_materno', email = '$email', telefono = '$telefono', status = $status, clave_area = '$area' WHERE clave = '$clave'";
			mysqli_query( $conexion, $sql );
			if( mysqli_affected_rows( $conexion ) > 0 ){
				echo "<script>mensajeExitoso( 'Bieen!', 'Se actualizó el registro.' );</script>";
				header("Refresh:1; url=../admin/inicio.php#profesores");
			}
			else{
				echo "<script>mensajeError( 'Vaya!', 'No se realizaron cambios en el registro.' );</script>";
				header("Refresh:1; url=../admin/inicio.php");
			}
			mysqli_close( $conexion );
		}
		function agregarProfesor (  $clave, $nombre, $apellido_paterno, $apellido_materno, $email, $telefono, $status, $area ) {
			require '../conexion/conexion_mysqli.php';
			$sql = "INSERT INTO profesores values ( '$clave', '$nombre', '$apellido_paterno', '$apellido_materno', '$email', '$telefono', $status, '$area' )";
			mysqli_query( $conexion, $sql );
			if( mysqli_affected_rows( $conexion ) > 0 ){
				echo "<script>mensajeExitoso( 'Bieen!', 'Se agregó el nuevo registro.' );</script>";
				header("Refresh:1; url=../admin/inicio.php#profesores");
			}
			else{
				echo "<script>mensajeError( 'Upsss!', 'No se agregó el registro. Verifica clave' );</script>";
				header("Refresh:1; url=../profesores/agregar.php");
			}
			mysqli_close( $conexion );
		}
	} 
	// FUNCION DEL SUBMIT PARA ACTUALIZAR AL PROFESOR
	if(isset($_POST['btt_actualizar'])){
		$clave =  $_POST['txt_clave'];
		$nombre =  $_POST['txt_nombre'];
		$apellido_paterno =  $_POST['txt_apellido_paterno'];
		$apellido_materno =  $_POST['txt_apellido_materno'];
		$email =  $_POST['txt_email'];
		$telefono =  $_POST['txt_telefono'];
		$area =  $_POST['txt_area'];
		$status = -1;
		if( isset($_POST['txt_status']) && $_POST['txt_status'] == '1' )
			$status = 1;
		else
			$status = 0;
		$profesor_obj = new ProfesorModel; 
		$profesor_obj->actualizarProfesor( $clave, $nombre, $apellido_paterno, $apellido_materno, $email, $telefono, $status, $area );
    	} 
	// FUNCION DEL SUBMIT DE DAR DE BAJA AL PROFESOR
	if(isset($_POST['btt_eliminar'])){
		$clave =  $_POST['txt_clave'];
		$profesor_obj = new ProfesorModel; 
		$profesor_obj->darBajaProfesor( $clave );
	}
	// FUNCION DEL SUBMIT DE AGREGAR PROFESOR
	if(isset($_POST['btt_agregar'])){
		$clave =  $_POST['txt_clave'];
		$nombre =  $_POST['txt_nombre'];
		$apellido_paterno =  $_POST['txt_apellido_paterno'];
		$apellido_materno =  $_POST['txt_apellido_materno'];
		$email =  $_POST['txt_email'];
		$telefono =  $_POST['txt_telefono'];
		$area =  $_POST['txt_area'];
		$status = -1;
		if( isset($_POST['txt_status']) && $_POST['txt_status'] == '1' )
			$status = 1;
		else
			$status = 0;
		$profesor_obj = new ProfesorModel; 
		$profesor_obj->agregarProfesor( $clave, $nombre, $apellido_paterno, $apellido_materno, $email, $telefono, $status, $area );
	}
	/*$obj_semestre = new SemestreModel; 
	$nombre_semestre = $obj_semestre->getSemestre( '1' );
	echo $nombre_semestre;*/
?> 
