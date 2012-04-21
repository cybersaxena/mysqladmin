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
	$sqlDelete="";
	$permisoDelete=false;
	$sql="SELECT COUNT(*) AS conteo FROM mysql.user WHERE User='".$user."' AND ( Host='".$ip."' OR Host='".$ip2."' ) and Drop_priv='Y';";
	$percount= mysql_query($sql,$conexionRoot);
	$valor = mysql_fetch_array($percount);
	if($valor['conteo']>0){
		$permisoDelete=true;
		$sqlDelete="SELECT table_name as tabla FROM information_schema.tables where table_type='BASE TABLE' AND table_schema='".$base."';";
	}
	if(!$permisoDelete){
		$sql="SELECT COUNT(*) AS conteo FROM mysql.db WHERE User='".$user."' AND ( Host='".$ip."' OR Host='".$ip2."' ) and Drop_priv='Y' AND Db='".$base."' ;";
		$percount= mysql_query($sql,$conexionRoot);
		$valor = mysql_fetch_array($percount);
		if($valor['conteo']>0){
			$sqlDelete="SELECT table_name as tabla FROM information_schema.tables where table_type='BASE TABLE' AND table_schema='".$base."';";
			$permisoDelete=true;
		}else{
			$sql="SELECT COUNT(*) AS conteo FROM mysql.tables_priv WHERE User='".$user."' AND ( Host='".$ip."' OR Host='".$ip2."' ) and table_priv like '%DROP%' AND Db='".$base."' ;";
			$percount= mysql_query($sql,$conexionRoot);
			$valor = mysql_fetch_array($percount);
			if($valor['conteo']>0){
				$sqlDelete="SELECT esq.table_name AS tabla FROM information_schema.tables esq INNER JOIN mysql.tables_priv mys ".
				"on esq.table_schema = mys.db and esq.table_name=mys.table_name WHERE esq.table_type='BASE TABLE' AND mys.User='".$user."'". 
				" AND ( mys.Host='".$ip."' OR mys.Host='".$ip2."' ) and mys.tables_priv like '%DROP%' AND mys.Db='".$base."';";
				$permisoDelete=true;
			}
		}
	}
	if($permisoDelete)
	{

		?>
		<html>
		<head>
		<title>
		Borrar Tablas
		</title>
		</head>
		<body>
		
		<form name="BorrarTAbla" action="../index.php?action=BorrarTabla2" method="post">
		Seleccione la tabla a borrar:
		<br>
		<br>
		<?php 
			$tablasB= mysql_query($sqlDelete,$conexionRoot);
			$i=0;
			while($val = mysql_fetch_array($tablasB)){
			    $i++;	
				echo "<input type='radio' name='NombreTabla' value='".$val['tabla']."'>".$val['tabla']."\t";
				if($i%5==0) echo "<br>";
			}
		?>
		<br>
		<input type="checkbox" name="cascade" value="cascade">Cascade</input>
		<br>
		<input type="submit" value="BorrarTabla"></input>
		</form>
		</body>
		</html>
		<?php 
	}else{
		echo "Usted no puede BORRAR tablas en este servidor";
		}
}else{
	echo "Sin acceso";
}
?>
