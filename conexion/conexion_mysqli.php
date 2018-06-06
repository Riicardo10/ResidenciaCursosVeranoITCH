<?php 
	try {
		require 'datos_conexion.php';
		$conexion = mysqli_connect( $DB_HOST, $DB_USUARIO, $DB_CONTRASENIA );
		if( mysqli_connect_errno() ){
			echo "ERROR";
			exit();
		}
		mysqli_select_db( $conexion, $DB_NOMBRE ) or die( "No se encuentra la bd" );
		mysqli_set_charset( $conexion, 'utf8' );
	}
	catch ( Exception $e ) {
		die( 'Error: ' . $e->GetMessage() );
	}
?>