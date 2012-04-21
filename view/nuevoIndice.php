<html>
<head>
<title>
Agregar Indice
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
	if(trim($_POST['nombreIndice'])!=""){

	?>
	<?php 
	$nombreTabla= htmlspecialchars($_POST['nombreTabla']);
	$sqlIndex=" CREATE ";
	if(isset($_POST['unique'])){
		$sqlIndex.=" UNIQUE ";
	}
	$sqlIndex.="INDEX ".$_POST['nombreIndice']." ON ".$nombreTabla ."(";
			$sqlColumnas=" SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_sCHEMA='".$base."'AND TABLE_NAME='".$nombreTabla."'".
			" ORDER BY ORDINAL_POSITION;";
			$tablasB= mysql_query($sqlColumnas,$conexionRoot);
			$columnaSeleccionada=false;
			while($val = mysql_fetch_array($tablasB)){
				if(isset($_POST[$val['COLUMN_NAME']])){
					$columnaSeleccionada=true;
					$sqlIndex.= $_POST[$val['COLUMN_NAME']]." ".htmlspecialchars($_POST[$val['COLUMN_NAME']."ORDEN"]).",";
					
				}
			}
			$sqlIndex = substr_replace($sqlIndex,"",strlen($sqlIndex)-1,1);
			$sqlIndex.=") USING ".$_POST['tipoIndice'];
	

	if($columnaSeleccionada){
		$mensaje="El INDICE $base.$nombreTabla.".htmlspecialchars($_POST['nombreIndice'])." se ha creado correctamente"; 
		//echo $sqlIndex;
		try{
			$resultado=mysql_query($sqlIndex,$conexion);
				if(!$resultado){
					$mensaje="Error en SQL<br>".mysql_error()."<br>SQL:".$sqlIndex;
				}
		}catch(Exception $ex){
			$mensaje="Error en SQL<br>".mysql_error()."<br>SQL:".$sqlTabla;
		
		}

		echo $mensaje;
	}else{
		echo "Ninguna columna seleccionada para el indice";
	}
	}else{
	 echo "datos insuficientes";
	}

}else{
echo "Sin Acceso";
}
?>

</body>
</html>