<?php 
	try {
		require 'datos_conexion.php';

		$conexion = new PDO( 'mysql:host=' . $DB_HOST . '; dbname=' . $DB_NOMBRE, $DB_USUARIO, $DB_CONTRASENIA );
		$conexion->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$conexion->exec( "SET CHARACTER SET utf8" );

		/*$consulta_sql = "SELECT * FROM tabla WHERE id=?";
		$resultado = $conexion->prepare( $consulta_sql );
		$resultado->execute( array( '1' ) );*/

		/*$consulta_sql = "SELECT * FROM tabla";
		$resultado = $conexion->prepare( $consulta_sql );
		$resultado->execute( );*()*/

		/*$consulta_sql = "SELECT * FROM tabla WHERE id = :id OR 1=1";
		$resultado = $conexion->prepare( $consulta_sql );
		$resultado->execute( array( ':id'=>1 ) );

		while ( $filas = $resultado->fetch( PDO::FETCH_ASSOC ) ) {
			echo $filas[ 'id' ] . " - " . $filas[ 'nombre' ] . "<br>";
		}

		$resultado->closeCursor();*/

	}
	catch ( Exception $e ) {
		die( 'Error: ' . $e->GetMessage() );
	}
	finally{
		$conexion =  null;
	}
?>