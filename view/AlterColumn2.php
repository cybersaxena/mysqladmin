<html>
<head>
<title>
Modificar Columna
</title>
</head>
<body>
<?php include_once 'Columna.php';
session_start();
include_once('variables.php');

if(isset($_SESSION['user'])){

	if(isset($_POST['NombreTabla']) && isset($_POST['nombreCol']) && isset($_POST['tipoDato'])){
		$user=$_SESSION['user'];
		$pass= $_SESSION['passwd'];
		$conexion=mysql_pconnect($dbhost,$user,$pass);
		$base=$_SESSION['base'];
		mysql_select_db($base);
		$nombreTabla= htmlspecialchars($_POST['NombreTabla']);
		$sqlTabla=" ALTER TABLE ".$nombreTabla;
		
		
		$tipoDato = copiaDato($_POST['tipoDato']);
		$longitudCol=htmlspecialchars($_POST['longitudCol']);
		$precisionCol=htmlspecialchars($_POST['precisionCol']);
		$nombreViejo=null;
		$nombreCol=htmlspecialchars($_POST['nombreCol']);
		$noNulo=false;
		if($nombreCol!=$_POST['NombreColOrig'] ){$nombreViejo= htmlspecialchars($_POST['NombreColOrig']);
		$sqlTabla.= " CHANGE COLUMN";
		}else{
		$sqlTabla.= " MODIFY COLUMN";
		}
		if(isset($_POST['noNulo'])){ $noNulo=true; }
		if(isset($_POST['default'])){
		$default=true;
		$defaultVal=htmlspecialchars($_POST['defaultVal']);
		}else{
		$default=false;
		$defaultVal=null;
		}
		$tipoDato->presicion($longitudCol,$precisionCol);
		
		$objColumna= new Columna($nombreCol,!$noNulo,false,false,false,$defaultVal);
		$objColumna->tipoDato($tipoDato);
		//echo sqlColumna($objColumna)."<br>";
		?>
		<?php 
	
		
		
		$sqlTabla.=sqlColumnaAlter($objColumna,$nombreViejo);
		//echo $sqlTabla;
		$mensaje="La columna $base.$nombreTabla.$nombreCol se ha ALTERADO correctamente"; 
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


function sqlColumnaAlter($columna,$viejoNombre=NULL){
	$cadena=" ";
	if($viejoNombre!=NULL){
	$cadena .=$viejoNombre." ";
	}
	$cadena .=$columna->name;
	
	$cadena .=sqlDato($columna->tipoDato);
	
	
		if(!$columna->isNull){
		$cadena .=" NOT NULL ";
	}
	$valor=" ";
	if($columna->auto!=NULL){
		if($columna->tipoDato->tipo=="BIT" || $columna->tipoDato->tipo=="TINYINT" || $columna->tipoDato->tipo=="SMALLINT" || $columna->tipoDato->tipo=="MEDIUMINT"
		|| $columna->tipoDato->tipo=="INT" || $columna->tipoDato->tipo=="DOUBLE" || $columna->tipoDato->tipo=="FLOAT" || $columna->tipoDato->tipo=="NUMERIC"){
			$valor.=$columna->auto;
		}else{
			$valor="'".$columna->auto."'";
		}
		$cadena .=" DEFAULT ".$valor;
	}

	return $cadena;
}

?>

</body>
</html>