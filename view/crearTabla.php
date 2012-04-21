<?php 
session_start();
include_once('variables.php');

if(isset($_SESSION['user'])){
	$user=$_SESSION['user'];
	$pass= $_SESSION['passwd'];
	$conexion=mysql_pconnect($dbhost,$user,$pass);
	$base=$_SESSION['base'];
	mysql_select_db($base);
	$ip=$_SERVER['REMOTE_ADDR'];
	$ip2="";
	if($ip=="127.0.0.1" ){
		$ip2="localhost";
	}else if($ip=="localhost" ){
		$ip2="127.0.0.1";
	}
	$permisoCreate=false;
	$sql="SELECT COUNT(*) AS conteo FROM mysql.user WHERE User='".$user."' AND ( Host='".$ip."' OR Host='".$ip2."' ) and Create_priv='Y';";
	$percount= mysql_query($sql,$conexionRoot);
	$valor = mysql_fetch_array($percount);
	if($valor['conteo']>0){
		$permisoCreate=true;
	}else{
		$sql="SELECT COUNT(*) AS conteo FROM mysql.db WHERE User='".$user."' AND ( Host='".$ip."' OR Host='".$ip2."' ) and Create_priv='Y' AND Db='".$base."' ;";
		$percount= mysql_query($sql,$conexionRoot);
		$valor = mysql_fetch_array($percount);
		if($valor['conteo']>0){
			$permisoCreate=true;
		}
	}
	if($permisoCreate)
	{
		?>
		<html>
		<head>
		<title>
		Crear Tabla
		</title>
		</head>
		<body>
		<form name="NumColumnas" action="../index.php?action=crearTabla2" method="post">
		Numero de Columnas:
		<select name="numcols">
		<?php for($i=1;$i<=100;$i++) echo "<option value='".$i."'/>".$i;?>
		</select>
		<input type="submit" value=" Configurar Tabla"></input>
		</form>

		</body>
		</html>
		<?php 
	}else{
		echo "Usted no puede crear tablas en este servidor";
		}
}else{
	echo "Sin acceso";
}
?>
