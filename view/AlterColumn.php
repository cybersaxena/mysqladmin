<?php 
session_start();
include_once('variables.php');
include_once('tipoDato.php');

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
	if(isset($_POST['NombreTabla'])){
		
		?>
		<html>
		<head>
		<title>	
		Modificar Tabla
		</title>
		</head>
		<body>
		<form name="AlteraColumna"  action="../index.php?action=AlterColumn2" method="post">
		<?php 
			$nombreTabla=htmlspecialchars($_POST['NombreTabla']);
			$nombreColumna=htmlspecialchars($_POST['NColumna']);
			$sqlColumna="SELECT * FROM INFORMATION_SCHEMA.COLUMNS where table_schema='$base' AND table_name='$nombreTabla' ".
			" AND COLUMN_NAME='$nombreColumna';";
			$col= mysql_query($sqlColumna,$conexionRoot);
			$valSQL  = mysql_fetch_array($col);
			echo "<tr>";
			echo "<td>Nombre :</td>";
			echo "<td><input type='text' size='15' maxlength='15' name='nombreCol' value='".$valSQL['COLUMN_NAME']."'/>";
			echo "<td><input type='hidden' name='NombreTabla' value='".$nombreTabla."'/>";
			echo "<td><input type='hidden' name='NombreColOrig' value='".$valSQL['COLUMN_NAME']."'/>";
			echo "<select name='tipoDato'>";
			foreach( $arrayTipoDato as $val ){
			echo "<option value='".$val->tipo."'"; 
			if(STRTOUPPER($val->tipo)==STRTOUPPER($valSQL['DATA_TYPE']))  echo "selected";
			echo ">".$val->tipo."</option>";
			}
			echo "</select>";
			$longitud="";
			$precision="";
			$tipodato=$valSQL['COLUMN_TYPE'];
			//echo $tipodato;
			//$tipodato = "INT(11,0) unsigned";
			if(strstr($tipodato,")")){$tipodato=strstr($tipodato,")",true).")"; }
			if(strstr($tipodato,"(")  && strstr($tipodato,",") ){
			//echo "1";
			$longitud=substr_replace(substr_replace(strstr(strstr($tipodato,"("),",",true),'',strlen($tipodato),-1),'',0,1);
			//echo $longitud;
			$temp=strstr($tipodato,",");
			//echo $temp;
			$precision= substr_replace(substr_replace($temp,'',strlen($temp)-1,1),'',0,1);
			}else if(strstr($tipodato,"(")  ){
			//echo strstr(strstr($tipodato,")",true),"(");
			$longitud=substr_replace(strstr(strstr($tipodato,")",true),"("),'',0,1);
			//echo $longitud;
			}
			echo "<input type='text' size='4' maxlength='4' name='longitudCol' value='$longitud'/>";
			echo "<input type='text' size='1' maxlength='1' name='precisionCol' value='$precision'/>";
			
			echo "<input type='checkbox' name='noNulo'";
			if(STRTOUPPER($valSQL['IS_NULLABLE'])=='NO'){ echo " checked";}
			echo ">No Nulo";
			echo "<input type='checkbox' name='default'";
			$default="";
			$tipoDato=$valSQL['DATA_TYPE'];
			if(STRTOUPPER($valSQL['COLUMN_DEFAULT'])!=NULL){ echo " checked";$default=$valSQL['COLUMN_DEFAULT'];
			
			/*if($tipoDato=="BIT" || $tipoDato=="TINYINT" || $tipoDato=="SMALLINT" || $tipoDato=="MEDIUMINT"
			|| $tipoDato=="INT" || $tipoDato=="DOUBLE" || $tipoDato=="FLOAT" || $tipoDato=="NUMERIC"){
				$default=$valSQL['COLUMN_DEFAULT'];
			}else{
				$default="'".$valSQL['COLUMN_DEFAULT']."'";
			}
			*/
			}
			echo ">default";;
			echo "<input type='text' size='30' maxlength='30' name='defaultVal' value='$default'/>";
			echo "<input type='submit' value='ModificarColumna'/>";
			echo "</tr>";
			echo "<br>";
		?>
			</form>
			<form name="BorraColumna"  action="../index.php?action=BorrarColumna" method="post">
			<?php 
			echo "<td><input type='hidden' name='NombreTabla' value='".$nombreTabla."'/>";
			echo "<td><input type='hidden' name='NombreColOrig' value='".$valSQL['COLUMN_NAME']."'/>";
			?>
			<input type='submit' value='EliminarColumna'/>
			</form>
			
		</body>
		</html>
		<?php 
	}else{
		echo "Datos insuficientes";
		}
}else{
	echo "Sin acceso";
}
?>
