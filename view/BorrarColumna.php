<html>
<head>
<title>
Eliminar Columna
</title>
</head>
<body>
<?php include_once 'Columna.php';
session_start();
include_once('variables.php');

if(isset($_SESSION['user'])){

	if(isset($_POST['NombreTabla']) && isset($_POST['NombreColOrig'])){
		$user=$_SESSION['user'];
		$pass= $_SESSION['passwd'];
		$conexion=mysql_pconnect($dbhost,$user,$pass);
		$base=$_SESSION['base'];
		mysql_select_db($base);
		$nombreTabla= htmlspecialchars($_POST['NombreTabla']);

		$nombreCol=htmlspecialchars($_POST['NombreColOrig']);
		$sqlTabla=" ALTER TABLE ".$nombreTabla. " DROP COLUMN ".$nombreCol;
		
		
			
		$mensaje="La columna $base.$nombreTabla.$nombreCol se ha ELIMINADO correctamente"; 
		//echo $sqlTabla;
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
		echo "datos insuficientes";
	}
}else{
echo "Sin Acceso";
}

