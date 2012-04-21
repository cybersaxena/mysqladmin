<html>
	<head>
	<title>
	Eliminar elementos
	</title>
	</head>
	<body>
<?php
include_once 'Columna.php';
session_start();
include_once('variables.php');

if(isset($_SESSION['user'])){
	$user=$_SESSION['user'];
	$pass= $_SESSION['passwd'];
	$conexion=mysql_pconnect($dbhost,$user,$pass);
	$base=$_SESSION['base'];
	mysql_select_db($base);
	$nombreTabla= htmlspecialchars($_POST['NombreTabla']);
		
	//$nombreColumna=$_POST['NombreColOrig'];
	include_once 'Columna.php';
	$opcion=$_POST['TElemento'];
	
	if($opcion=="primaryKey"){
		$sqlPK=" SELECT count(*) as conteo FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS WHERE TABLE_sCHEMA='".$base."'AND TABLE_NAME='".$nombreTabla."' and CONSTRAINT_TYPE like '%PRIMARY KEY%'";
			$conteo= mysql_query($sqlPK,$conexionRoot);
			$valor = mysql_fetch_array($conteo);
			if($valor['conteo']>0){
				$mensaje="La llave Primaria de la tabla $base.$nombreTabla se ha eliminado correctamente";
				$sqlTabla=" ALTER TABLE ".$base.".".$nombreTabla." DROP PRIMARY KEY;";
				try{
					$resultado=mysql_query($sqlTabla,$conexion);
						if(!$resultado){
							$mensaje="Error en SQL<br>".mysql_error()."<br>SQL:".$sqlTabla;
						}
				}catch(Exception $ex){
					$mensaje="Error en SQL<br>".mysql_error()."<br>SQL:".$sqlTabla;
				
				}

			echo $mensaje;

			}else{
			echo "La Tabla seleccionada no tiene una llave primaria asignada";
			}
	}
	
}else{
echo "Sin Acceso";
}
?>

</body>
</html>

