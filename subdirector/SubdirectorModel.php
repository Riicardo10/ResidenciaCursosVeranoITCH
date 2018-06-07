<html>
	<head>
		<script src="../js/sweetalert.min.js"></script>
		<script src="../js/sweetAlert_functions.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/sweetalert.css">
	</head>
</html>
<?php 
	class SubdirectorModel { 
		function getSubdirector ( $email ) { 
			require '../conexion/conexion_mysqli.php';
			$sql = "SELECT * FROM subdirectores WHERE email = '$email'";
			$result = $conexion->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					//return ;
					return (object) array(
						'id' => $row['id'] ,
						'nombre' => $row['nombre'],
						'apellido_paterno' => $row['apellido_paterno'],
						'apellido_materno' => $row['apellido_materno'],
						'email' => $row['email'],
						'telefono' => $row['telefono']
					);
				}
			} 
			mysqli_close( $conexion );
			return null;
		}
		function getListaSubdirectores () { 
			require '../conexion/conexion_mysqli.php';
			$sql = "SELECT * FROM subdirectores";
			$result = $conexion->query($sql);
			if ($result->num_rows > 0) {
				return $result;
			}
			mysqli_close( $conexion );
			return null;
		}
		function getListaMateriasSolicitadas ($id_carrera) { 
			require '../conexion/conexion_mysqli.php';
			$anio = date ("Y");
			$sql = "SELECT 
				  MATERIAS_SOLICITADAS.id, 
				  MATERIAS_SOLICITADAS.clave_materia, 
				  MATERIAS_SOLICITADAS.nombre_materia, 
				  MATERIAS_SOLICITADAS.aprobada, 
				  MATERIAS_SOLICITADAS.anio, 
				  MATERIAS.clave_carrera,  
				  COORDINADORES.no_control,  
				  COORDINADORES.nombre, 
				  COORDINADORES.apellido_paterno, 
				  COORDINADORES.apellido_materno, 
				  MATERIAS_SOLICITADAS.clave_profesor 
				  FROM MATERIAS_SOLICITADAS 
				  JOIN MATERIAS 
				  JOIN COORDINADORES 
				  WHERE MATERIAS_SOLICITADAS.clave_materia = MATERIAS.clave 
				  AND MATERIAS_SOLICITADAS.no_control_coordinador = COORDINADORES.no_control  
				  AND clave_carrera = '$id_carrera' 
				  AND anio = '$anio';";
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
		function aprobarMateria ( $id, $status, $materia_id, $materia_nombre ) {
			require '../conexion/conexion_mysqli.php';
			$sql = "UPDATE materias_solicitadas SET aprobada = '$status' WHERE id = '$id'";
			mysqli_query( $conexion, $sql );
			if( mysqli_affected_rows( $conexion ) > 0 ){
				echo "<script>mensajeExitoso( 'Bieen!', 'Materia aprobada.' );</script>";
				header("Refresh:1; url=../subdirector/materias_solicitadas_por_carrera.php?txt_carrera_id=1&txt_carrera_nombre=Ingenieria");
			}
			else{
				echo "<script>mensajeError( 'Vaya!', 'No se realizaron cambios en el registro.' );</script>";
				header("Refresh:1; url=../subdirector/inicio.php");
			}
			mysqli_close( $conexion );
		}
		function agregarSubdirector (  $nombre, $apellido_paterno, $apellido_materno, $email, $telefono ) {
			require '../conexion/conexion_mysqli.php';
			$sql = "INSERT INTO subdirectores values ( NULL, '$nombre', '$apellido_paterno', '$apellido_materno', '$email', '$telefono', '$email')";
			mysqli_query( $conexion, $sql );
			if( mysqli_affected_rows( $conexion ) > 0 ){
				echo "<script>mensajeExitoso( 'Bieen!', 'Se agregó el nuevo registro.' );</script>";
				header("Refresh:1; url=../admin/inicio.php#subdirectores");
			}
			else{
				echo "<script>mensajeError( 'Upsss!', 'No se agregó el registro. ' );</script>";
				header("Refresh:1; url=../subdirector/agregar.php");
			}
			mysqli_close( $conexion );
		}
		function eliminarSubdirector ( $id ) {
			require '../conexion/conexion_mysqli.php';
			$sql = "DELETE FROM subdirectores WHERE id = '$id'";
			mysqli_query( $conexion, $sql );
			if( mysqli_affected_rows( $conexion ) > 0 ){
				echo "<script>mensajeExitoso( 'Bieen!', 'Se eliminó el registro.' );</script>";
				header("Refresh:1; url=../admin/inicio.php#subdirector");
			}
			else{
				echo "<script>mensajeError( 'Upsss!', 'No se elimino el registro.' );</script>";
				header("Refresh:1; url=../admin/inicio.php#subdirector");
			}
			mysqli_close( $conexion );
		}
		function actualizarContraseniaSubdirector ( $email, $contrasenia, $contrasenia_2 ) {
			if( $contrasenia == $contrasenia_2 ){
				require '../conexion/conexion_mysqli.php';
				$sql = "UPDATE subdirectores SET contrasenia = '$contrasenia' WHERE email = '$email'";
				mysqli_query( $conexion, $sql );
				if( mysqli_affected_rows( $conexion ) > 0 ){
					echo "<script>mensajeExitoso( 'Bieen!', 'Se actualizó la cuenta del subdirector. Inicia sesión de nuevo por favor' );</script>";
					header("Refresh:1; url=../admin/cerrar_sesion.php");
				}
				else{
					echo "<script>mensajeError( 'Vaya!', 'No se realizaron cambios en la cuenta del subdirector.' );</script>";
					header("Refresh:1; url=./inicio.php");
				}
				mysqli_close( $conexion );
			}
			else{
				echo "<script>mensajeError( 'Upsss!', 'Verifica contraseñas ingresadas.' );</script>";
				header("Refresh:1; url=./inicio.php");
			}
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
		$id =  $_POST['txt_id'];
		$sub = new SubdirectorModel; 
		$sub->eliminarSubdirector( $id );
	}
	// FUNCION DEL SUBMIT DE AGREGAR PROFESOR
	if(isset($_POST['btt_agregar'])){
		$nombre =  $_POST['txt_nombre'];
		$apellido_paterno =  $_POST['txt_apellido_paterno'];
		$apellido_materno =  $_POST['txt_apellido_materno'];
		$email =  $_POST['txt_email'];
		$telefono =  $_POST['txt_telefono'];
		$sub = new SubdirectorModel; 
		$sub->agregarSubdirector( $nombre, $apellido_paterno, $apellido_materno, $email, $telefono );
	}
	if(isset($_POST['btt_configurar'])){
		$email =  $_POST['txt_email'];
		$contrasenia_1 = $_POST['txt_contrasenia'];
		$contrasenia_2 = $_POST['txt_contrasenia_2'];
		$sub = new SubdirectorModel; 
		$sub->actualizarContraseniaSubdirector( $email, $contrasenia_1, $contrasenia_2 );
	}
	if(isset($_POST['btt_aprobar_materia'])){
		$id_materia = $_POST['txt_id'];
		$status = "";
		if( isset($_POST['txt_status']))
			$status = 1;
		else
			$status = 0;


		$a = $_POST['txt_a'];
		$b = $_POST['txt_b'];
		
		$sub = new SubdirectorModel; 
		$sub->aprobarMateria( $id_materia, $status, $a, $b );
	}
?> 
