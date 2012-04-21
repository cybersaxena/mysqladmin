<html>
<head>
<title>
Crear Tabla
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
	$numColumnas= htmlspecialchars($_POST['numColumnas']);
	echo "<input type='hidden' name='numColumnas value='".$numColumnas."'/>";
	$sqlTabla=" CREATE TABLE ".$nombreTabla."(\n";
	for($i=1;$i<=$numColumnas;$i++) {
		$nombreCol=htmlspecialchars($_POST['nombreCol'.$i]);
		$tipoDato=htmlspecialchars($_POST['tipoDato'.$i]);
		$longitudCol=htmlspecialchars($_POST['longitudCol'.$i]);
		$precisionCol=htmlspecialchars($_POST['precisionCol'.$i]);
		
		if($nombreCol==""){
			continue;
		}
		if(isset($_POST['noNulo'.$i])){
		$noNulo=true;
		}else{
		$noNulo=false;
		}
		if(isset($_POST['unico'.$i])){
		$unico=true;
		}else{
		$unico=false;
		}
		if(isset($_POST['llavePrimaria'.$i])){
		$llavePrimaria=true;
		}else{
		$llavePrimaria=false;
		}
		if(isset($_POST['increment'.$i])){
		$increment=true;
		}else{
		$increment=false;
		}
		
		if(isset($_POST['default'.$i])){
		$default=true;
		$defaultVal=htmlspecialchars($_POST['defaultVal'.$i]);
		}else{
		$default=false;
		$defaultVal=null;
		}
		$objTipoDato =  copiaDato($tipoDato);
		$objTipoDato->presicion($longitudCol,$precisionCol);
		
		$objColumna= new Columna($nombreCol,!$noNulo,$llavePrimaria,$unico,$increment,$defaultVal);
		$objColumna->tipoDato($objTipoDato);
		//echo sqlColumna($objColumna)."<br>";
		$sqlTabla.=sqlColumna($objColumna);
		//if($numColumnas!=$i){
		$sqlTabla.=",";
		//}	
		/*
		echo $nombreCol."--".$tipoDato."--".$longitudCol."--".$precisionCol."--".$noNulo."--".$unico."--".$llavePrimaria."--".$default."--".$defaultVal."<br>";
		*/
	}
	$mensaje="La tabla $base.$nombreTabla se ha creado correctamente"; 
	
	$sqlTabla = substr_replace($sqlTabla,"",strlen($sqlTabla)-1,1);
	$sqlTabla.=");";
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