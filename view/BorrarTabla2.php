<html>
<head>
<title>
Borrar Tabla
</title>
</head>
<body>
<?php include_once 'Columna.php';
session_start();
include_once('variables.php');

if(isset($_SESSION['user'])){
	$user=$_SESSION['user'];
	$pass= $_SESSION['passwd'];
	$conexion=mysql_pconnect($dbhost,$user,$pass);
	$base=$_SESSION['base'];
	mysql_select_db($base);

	?>
	<?php 
	$nombreTabla= htmlspecialchars($_POST['NombreTabla']);
	$sqlTabla=" DROP TABLE ".$nombreTabla;
	if(!isset($_POST['cascade'])){
	$sqlTabla.=" CASCADE;";
	
	}
	$mensaje="La tabla $base.$nombreTabla se ha BORRADO correctamente"; 
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
echo "Sin Acceso";
}
?>

</body>
</html>