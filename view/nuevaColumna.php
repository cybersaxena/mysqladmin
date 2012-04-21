<html>
<head>
<title>
Agregar Columna
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
	$nombreTabla= $_POST{'nombreTabla'};
	$sqlTabla=" ALTER TABLE ".$nombreTabla." ADD COLUMN ";
	
		$nombreCol=htmlspecialchars($_POST['nombreCol1']);
		$tipoDato=htmlspecialchars($_POST['tipoDato1']);
		$longitudCol=htmlspecialchars($_POST['longitudCol1']);
		$precisionCol=htmlspecialchars($_POST['precisionCol1']);
		if(isset($_POST['noNulo1'])){
		$noNulo=true;
		}else{
		$noNulo=false;
		}
		if(isset($_POST['unico1'])){
		$unico=true;
		}else{
		$unico=false;
		}
		if(isset($_POST['llavePrimaria1'])){
		$llavePrimaria=true;
		}else{
		$llavePrimaria=false;
		}
		if(isset($_POST['increment1'])){
		$increment=true;
		}else{
		$increment=false;
		}
		
		if(isset($_POST['default1'])){
		$default=true;
		$defaultVal=$_POST['defaultVal1'];
		}else{
		$default=false;
		$defaultVal=null;
		}
		$objTipoDato =  copiaDato($tipoDato);
		$objTipoDato->presicion($longitudCol,$precisionCol);
		
		$objColumna= new Columna($nombreCol,!$noNulo,$llavePrimaria,$unico,$increment,$defaultVal);
		$objColumna->tipoDato($objTipoDato);
		//echo sqlColumna($objColumna)."<br>";
		$sqlTabla.=sqlColumna($objColumna).";";
			
		/*
		echo $nombreCol."--".$tipoDato."--".$longitudCol."--".$precisionCol."--".$noNulo."--".$unico."--".$llavePrimaria."--".$default."--".$defaultVal."<br>";
		*/
	
	$mensaje="La columna $base.$nombreTabla.$nombreCol se ha creado correctamente"; 
	//echo $sqlTabla;
	if(trim($nombreCol)!=""){
		try{
			$resultado=mysql_query($sqlTabla,$conexion);
				if(!$resultado){
					$mensaje="Error en SQL<br>".mysql_error()."<br>SQL:".$sqlTabla;
				}
		}catch(Exception $ex){
			$mensaje="Error en SQL<br>".mysql_error()."<br>SQL:".$sqlTabla;
		
		}
	}else {
		$mensaje=" No ingreso un nombre de columna";
	}
	
	echo $mensaje;


}else{
echo "Sin Acceso";
}
?>

</body>
</html>