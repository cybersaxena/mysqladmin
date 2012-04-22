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
	if(isset($_POST['NombreTabla'])){
		$nombreTabla=htmlspecialchars($_POST['NombreTabla']);
		?>
		<html>
		<head>
		<title>	
		Modificar Tabla
		</title>
		</head>
		<body>


		<form name="AlterColumn" action="index.php?action=AlterColumn" method="post">
		<input type="hidden" name="NombreTabla" value="<?php echo $nombreTabla;?>"></input>
		Seleccione la columna A Modificar:
		<SELECT NAME="NColumna">
		<?php 
			$sqlColumnas=" SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_sCHEMA='".$base."'AND TABLE_NAME='".$nombreTabla."'".
		 " ORDER BY ORDINAL_POSITION;";
			$tablasB= mysql_query($sqlColumnas,$conexionRoot);
		
			while($val = mysql_fetch_array($tablasB)){
				echo "<option name='NombreColumna' value='".$val['COLUMN_NAME']."'>".$val['COLUMN_NAME']."</option>";
			}
		?>
		</select>
		<br>
		
		<input type="submit" value="ModificarColumna"></input>
		</form>
		<br>
		<br>
		Agregar elemento:
		<form name="AddElement" action="index.php?action=AddElement" method="post">
		<input type="hidden" name="NombreTabla" value="<?php echo $nombreTabla;?>"></input>
		<SELECT name="TElemento">
		<option value="columna">Columna</option>
		<option value="indice">Indice</option>
		<option value="primaryKey">LlavePrimaria</option>
		<option>
		</select>
		<br>
		
		<input type="submit" value="Agregar Elemento"></input>
		</form>

		<br>
		<br>
		Eliminar elemento:
		<form name="dropElement" action="index.php?action=dropElement" method="post">
		<input type="hidden" name="NombreTabla" value="<?php echo $nombreTabla;?>"></input>
		<SELECT name="TElemento">
		<option value="primaryKey">LlavePrimaria</option>
		<option>
		</select>
		<br>
		
		<input type="submit" value="Eliminar Elemento"></input>
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
