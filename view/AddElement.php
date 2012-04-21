<html>
	<head>
	<title>
	Agregar elementos
	</title>
	</head>
	<body>

<?php
include_once 'Columna.php';
session_start();
include_once('variables.php');

if(isset($_SESSION['user'])){
	//print_r( $_POST);
	$base= $_SESSION['base'];
	$nombreTabla= $_POST['NombreTabla'];
	//$nombreColumna=$_POST['NombreColOrig'];
	include_once 'Columna.php';
	$opcion=$_POST['TElemento'];
	if($opcion=="columna"){
?>
	<form name="generaColumna" action="index.php?action=nuevaColumna" method="post">
	<input type='hidden' size='30' maxlength='30' name='nombreTabla' value="<?php echo $nombreTabla;?>"/><br>
	<?php 
	formColumnaN(1);?>
	<input type="submit" value="CrearColumna"></input>
	</form>

<?php
	}
	if($opcion=="indice"){
?> 
		<form name="generaIndice" action="../index.php?action=nuevoIndice" method="post">
		<input type="hidden" name="nombreTabla" value="<?php echo $nombreTabla;?>"></input>
		Nombre del indice:
		<br>
		<input type='text' size='45' maxlength='45' name='nombreIndice' value=""/><br>
		Selecciona las columnas del indice:
		<br>
	<?php
		$sqlColumnas=" SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_sCHEMA='".$base."'AND TABLE_NAME='".$nombreTabla."'".
		" ORDER BY ORDINAL_POSITION;";
			$tablasB= mysql_query($sqlColumnas,$conexionRoot);
		
			while($val = mysql_fetch_array($tablasB)){
				echo "<input type='checkbox' name='".$val['COLUMN_NAME']."' value='".$val['COLUMN_NAME']."'>".$val['COLUMN_NAME']."</input>";
				echo "<input type='radio' name='".$val['COLUMN_NAME']."ORDEN' VALUE='ASC' checked>ASC</input>";
				echo "<input type='radio' name='".$val['COLUMN_NAME']."ORDEN' VALUE='DESC'>DESC</input>";
				echo "<br>";
			}
	 ?>

		
		<BR>
		Tipo de Indice:
		<input type="radio" name='tipoIndice' VALUE='BTREE' checked>BTREE</input>
		<input type="radio" name='tipoIndice' VALUE='HASH'>HASH</input>
		<br>
		<input type='checkbox' name='unique'> Unique 
		<br>
		<input type="submit" value="CrearIndice"></input>
		</form>
	<?php
	}
	
	if($opcion=="primaryKey"){
		$sqlPK=" SELECT count(*) as conteo FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS WHERE TABLE_sCHEMA='".$base."'AND TABLE_NAME='".$nombreTabla."' and CONSTRAINT_TYPE like '%PRIMARY KEY%'";
			$conteo= mysql_query($sqlPK,$conexionRoot);
			$valor = mysql_fetch_array($conteo);
			if($valor['conteo']==0){
				?>
				<form name="generaPrimary" action="../index.php?action=nuevoPrimary" method="post">
				<input type='hidden' size='30' maxlength='30' name='nombreTabla' value="<?php echo $nombreTabla;?>"/><br>
				Nombre de la llave Primaria:
				<br>
				<input type='text' size='45' maxlength='45' name='nombreIndice' value=""/><br>
				Selecciona las columnas de la llave:
				<br>
			<?php
				$sqlColumnas=" SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_sCHEMA='".$base."'AND TABLE_NAME='".$nombreTabla."'".
				" ORDER BY ORDINAL_POSITION;";
					$tablasB= mysql_query($sqlColumnas,$conexionRoot);
				
					while($val = mysql_fetch_array($tablasB)){
						echo "<input type='checkbox' name='".$val['COLUMN_NAME']."' value='".$val['COLUMN_NAME']."'>".$val['COLUMN_NAME']."</input>";
						echo "<input type='radio' name='".$val['COLUMN_NAME']."ORDEN' VALUE='ASC' checked>ASC</input>";
						echo "<input type='radio' name='".$val['COLUMN_NAME']."ORDEN' VALUE='DESC'>DESC</input>";
						echo "<br>";
					}
			 ?>
		
				<BR>
				Tipo de Llave:
				<input type="radio" name='tipoIndice' VALUE='BTREE' checked>BTREE</input>
				<input type="radio" name='tipoIndice' VALUE='HASH'>HASH</input>
				<br>
				<input type="submit" value="CrearLlavePrimaria"></input>
				</form>
			<?php
			
			}else{
			echo "La Tabla seleccionada ya tiene una llave primaria asignada";
			}
	}
	
}else{
echo "Sin Acceso";
}
?>

</body>
</html>

