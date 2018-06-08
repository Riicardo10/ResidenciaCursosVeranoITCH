<html>
	<head>
		<script src="../js/sweetalert.min.js"></script>
		<script src="../js/sweetAlert_functions.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/sweetalert.css">
	</head>
</html>
<?php 
	class AdminModel { 
		function getListaUsuariosCoordinadoresConDatos () { 
			require '../conexion/conexion_mysqli.php';
			$sql = "SELECT no_control_coordinador, contrasenia, nombre, apellido_paterno, apellido_materno, email, telefono FROM usuarios_coordinadores JOIN coordinadores WHERE no_control_coordinador = no_control;";
			$result = $conexion->query($sql);
			if ($result->num_rows > 0) {
				return $result;
			}
			mysqli_close( $conexion );
			return null;
		}
		function getListaUsuariosJefesConDatos () { 
			require '../conexion/conexion_mysqli.php';
			$sql = "SELECT clave, contrasenia, nombre, apellido_paterno, apellido_materno, email, telefono FROM usuarios_jefes_departamento JOIN jefes_departamento WHERE clave = clave_profesor;";
			$result = $conexion->query($sql);
			if ($result->num_rows > 0) {
				return $result;
			}
			mysqli_close( $conexion );
			return null;
		}
		function getListaUsuariosJefesDepartamento () { 
			require '../conexion/conexion_mysqli.php';
			$sql = "SELECT usuario, contrasenia FROM usuarios_jefes_departamento";
			$result = $conexion->query($sql);
			if ($result->num_rows > 0) {
				return $result;
			}
			mysqli_close( $conexion );
			return null;
		}
		function getListaUsuariosCoordinadores () { 
			require '../conexion/conexion_mysqli.php';
			$sql = "SELECT * FROM usuarios_coordinadores";
			$result = $conexion->query($sql);
			if ($result->num_rows > 0) {
				return $result;
			}
			mysqli_close( $conexion );
			return null;
		}
		function iniciarSesion ( $usuario, $contrasenia ) { 
			require '../conexion/conexion_mysqli.php';
			// admin
			$sql_admin = "SELECT * FROM admin WHERE usuario = '$usuario' AND contrasenia = '$contrasenia'";
			$result_admin = $conexion->query($sql_admin);
			// coordinador
			$sql_coordinador = "SELECT * FROM usuarios_coordinadores WHERE no_control_coordinador = '$usuario' AND contrasenia = '$contrasenia'";
			$result_coordinador = $conexion->query($sql_coordinador);
			// jefe
			$sql_jefe = "SELECT * FROM usuarios_jefes_departamento WHERE usuario = '$usuario' AND contrasenia = '$contrasenia'";
			$result_jefe = $conexion->query($sql_jefe);
			// subdirector
			$sql_sub = "SELECT * FROM subdirectores WHERE email = '$usuario' AND contrasenia = '$contrasenia'";
			$result_sub = $conexion->query($sql_sub);

			session_start();
			$_SESSION["sesion"] = $usuario;
			// redireccionando
			if ($result_admin->num_rows > 0) {
				header("Refresh:0; url=../admin/inicio.php");
			}
			else if ($result_coordinador->num_rows > 0) {
				header("Refresh:0; url=../coordinadores/inicio.php");
			}
			else if ($result_jefe->num_rows > 0) {
				header("Refresh:0; url=../jefes/inicio.php");
			}
			else if ($result_sub->num_rows > 0) {
				header("Refresh:0; url=../subdirector/inicio.php");
			}
			else{
				echo "<script>mensajeError( 'Error!', 'Datos incorrectos. Verifícalos!' );</script>";
				header("Refresh:1; url=../");
			}
			
			mysqli_close( $conexion );
			return null;
		}
		function getAdmin ( $usuario ) { 
			require '../conexion/conexion_mysqli.php';
			$sql = "SELECT * FROM admin WHERE usuario = '$usuario'";
			$result = $conexion->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					return (object) array(
						'usuario' => $row['usuario'] ,
						'contrasenia' => $row['contrasenia']
					);
				}
			} 
			mysqli_close( $conexion );
			return null;
		}
		function getListaAdmin () { 
			require '../conexion/conexion_mysqli.php';
			$sql = "SELECT * FROM admin";
			$result = $conexion->query($sql);
			if ($result->num_rows > 0) {
				return $result;
			}
			mysqli_close( $conexion );
			return null;
		}
		function actualizarAdmin ( $usuario, $contrasenia, $contrasenia_2 ) {
			if( $contrasenia == $contrasenia_2 ){
				require '../conexion/conexion_mysqli.php';
				$sql = "UPDATE admin SET contrasenia = '$contrasenia' WHERE usuario = '$usuario'";
				mysqli_query( $conexion, $sql );
				if( mysqli_affected_rows( $conexion ) > 0 ){
					echo "<script>mensajeExitoso( 'Bieen!', 'Se actualizó la cuenta del admin. Inicia sesión de nuevo por favor' );</script>";
					header("Refresh:1; url=../admin/cerrar_sesion.php");
				}
				else{
					echo "<script>mensajeError( 'Vaya!', 'No se realizaron cambios en la cuenta del admin.' );</script>";
					header("Refresh:1; url=../admin/inicio.php");
				}
				mysqli_close( $conexion );
			}
			else{
				echo "<script>mensajeError( 'Ups!', 'No se realizaron cambios en la cuenta del admin. Verifica contraseñas ingresadas.' );</script>";
				header("Refresh:2; url=../admin/inicio.php");
			}
		}
		function agregarMonto ( $creditos, $horas, $monto ) {
				require '../conexion/conexion_mysqli.php';
				$sql = "INSERT INTO montos VALUES (NULL, '$creditos', '$horas' , '$monto')";
				mysqli_query( $conexion, $sql );
				if( mysqli_affected_rows( $conexion ) > 0 ){
					echo "<script>mensajeExitoso( 'Bieen!', 'Se agregó nuevo monto' );</script>";
					header("Refresh:1; url=../admin/inicio.php");
				}
				else{
					echo "<script>mensajeError( 'Vaya!', 'No se registró.' );</script>";
					header("Refresh:1; url=../admin/inicio.php");
				}
				mysqli_close( $conexion );
		}
		function eliminarMonto ( $id ) {
				require '../conexion/conexion_mysqli.php';
				$sql = "DELETE FROM montos WHERE id=$id";
				mysqli_query( $conexion, $sql );
				if( mysqli_affected_rows( $conexion ) > 0 ){
					header("Refresh:0; url=../admin/inicio.php");
				}
				else{
					echo "<script>mensajeError( 'Vaya!', 'No se elimino.' );</script>";
					header("Refresh:1; url=../admin/inicio.php");
				}
				mysqli_close( $conexion );
		}
		function getListaMontos () { 
			require '../conexion/conexion_mysqli.php';
			$sql = "SELECT * FROM montos ORDER BY creditos";
			$result = $conexion->query($sql);
			if ($result->num_rows > 0) {
				return $result;
			}
			mysqli_close( $conexion );
			return null;
		}
	} 
	// FUNCION DEL SUBMIT PARA ACTUALIZAR AL PROFESOR
	if(isset($_POST['btt_actualizar'])){
		$usuario =  $_POST['txt_usuario'];
		$contrasenia =  $_POST['txt_contrasenia'];
		$contrasenia_2 =  $_POST['txt_contrasenia_2'];
		$admin_obj = new AdminModel; 
		$admin_obj->actualizarAdmin( $usuario, $contrasenia, $contrasenia_2 );			
    	} 
    	if(isset($_POST['btt_ingresar'])){
    		$usuario =  $_POST['txt_usuario'];
			$contrasenia =  $_POST['txt_contrasenia'];
			$admin_obj = new AdminModel; 
			$admin_obj->iniciarSesion( $usuario, $contrasenia );
    	}

    	if(isset($_POST['btt_agregar_monto'])){
			$admin_obj = new AdminModel; 
			$admin_obj->agregarMonto( $_POST['txt_creditos'], $_POST['txt_horas'], $_POST['txt_monto'] );
    	}
?> 
