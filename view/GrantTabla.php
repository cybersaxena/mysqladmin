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
	$sqlGrant="";
	$permisoGrant=false;
	$sql="SELECT COUNT(*) AS conteo FROM mysql.user WHERE User='".$user."' AND ( Host='".$ip."'OR Host='%'  ) and Grant_priv='Y';";
	$percount= mysql_query($sql,$conexionRoot);
	$valor = mysql_fetch_array($percount);
	$nivelGrant=0;
	if($valor['conteo']>0){
		$nivelGrant=1;
		$permisoGrant=true;
		$sqlGrant="SELECT table_name as tabla FROM information_schema.tables where table_type='BASE TABLE' AND table_schema='".$base."';";
	}
	if(!$permisoGrant){
		$sql="SELECT COUNT(*) AS conteo FROM mysql.db WHERE User='".$user."' AND ( Host='localhost' OR Host='127.0.0.1' or host='%' or host='::1'  ) and Grant_priv='Y' AND Db='".$base."' ;";
		$percount= mysql_query($sql,$conexionRoot);
		$valor = mysql_fetch_array($percount);
		if($valor['conteo']>0){
			$nivelGrant=2;
			$sqlGrant="SELECT table_name as tabla FROM information_schema.tables where table_type='BASE TABLE' AND table_schema='".$base."';";
			$permisoGrant=true;
		}else{
			$sql="SELECT COUNT(*) AS conteo FROM mysql.tables_priv WHERE User='".$user."' AND ( Host='localhost' OR Host='127.0.0.1' or host='%' or host='::1'  ) and UPPER(table_priv) like '%GRANT%' AND Db='".$base."' ;";
			$percount= mysql_query($sql,$conexionRoot);
			$valor = mysql_fetch_array($percount);
			if($valor['conteo']>0){
				$nivelGrant=3;
				$sqlGrant="SELECT esq.table_name AS tabla FROM information_schema.tables esq INNER JOIN mysql.tables_priv mys ".
				"on esq.table_schema = mys.db and esq.table_name=mys.table_name WHERE esq.table_type='BASE TABLE' AND mys.User='".$user."'". 
				" AND ( mys.Host='localhost' OR mys.Host='127.0.0.1' or mys.host='%' or mys.host='::1' ) and mys.tables_priv like '%GRANT%' AND mys.Db='".$base."';";
				$permisoGrant=true;
			}
		}
	}
	if($permisoGrant)
	{

		?>
		<html>
		<head>
		<title>
		Permiso a Tablas
		</title>
		</head>
		<body>
		<form name="GrantTable" action="index.php?action=GrantTabla2" method="post">
		<input type="hidden" name="nivelPermiso" value="<?php echo $nivelGrant;?>">
		Seleccione la tabla a dar permisos:
		<br>
		<br>
		<?php 
			$tablasB= mysql_query($sqlGrant,$conexionRoot);
			$i=0;
			while($val = mysql_fetch_array($tablasB)){
			$i++;
				echo "<input type='radio' name='NombreTabla' value='".$val['tabla']."'>".$val['tabla']."\t";
				if($i%5==0) echo "<br>";
			}
		?>
		<br>
		
		<input type="submit" value="GenerarPermisosTabla"></input>
		</form>
		</body>
		</html>
		<?php 
	}else{
		echo "Usted no puede DAR PERMISOS a tablas en este servidor";
		}
}else{
	echo "Sin acceso";
}
?>
