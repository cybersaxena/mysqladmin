<html>
<head>
<title>
Generando Permisos
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
	$nombreTabla= htmlspecialchars($_POST['nombreTabla']);
	
	$privilegios="";
	$grant="";
	for($i=1;$i<=13;$i++){
		if(isset($_POST['p'.$i])){
			if($_POST['p'.$i]=="GRANT"){
				$grant=" WITH GRANT OPTION";
			}else{
				$privilegios.=htmlspecialchars($_POST['p'.$i]).",";
			}
		}
	}
	$privilegios =substr_replace($privilegios,"",strlen($privilegios)-1,1);
	$sqlGrant="GRANT  ".$privilegios." ON ".$base.".".$nombreTabla." TO ".htmlspecialchars($_POST['usuarioP']).$grant;

	if(strlen($privilegios)>0){
		$mensaje="los PERMISOS SOBRE $base.$nombreTabla se han otorgado correctamente"; 
		//echo $sqlGrant;
		try{
			$resultado=mysql_query($sqlGrant,$conexion);
				if(!$resultado){
					$mensaje="Error en SQL<br>".mysql_error()."<br>SQL:".$sqlGrant;
				}
		}catch(Exception $ex){
			$mensaje="Error en SQL<br>".mysql_error()."<br>SQL:".$sqlGrant;
		
		}

		echo $mensaje;
	}else{
		echo "Ninguna permiso seleccionado para la operación";
	}

}else{
echo "Sin Acceso";
}
?>

</body>
</html>