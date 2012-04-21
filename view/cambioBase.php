<?php 
session_start();
include_once('variables.php');

if(isset($_SESSION['user'])){

$user=$_SESSION['user'];
$pass= $_SESSION['passwd'];
$base= $_SESSION['base'];
$conexion=mysql_pconnect($dbhost,$user,$pass);
	if (!isset($_POST['baseDatos'])){
	?>
	Selecciona la base a usar:
	<form action="../index.php?action=cambioBase" method="post" name="cBase">
		<select name="baseDatos">
			<?php 
				$sql="SHOW DATABASES;";

				$bases= mysql_query($sql,$conexion);
				while (($val = mysql_fetch_array($bases))) {
					if($val['Database']!='information_schema' && $val['Database']!='mysql' && $val['Database']!='performance_schema'
						&& 		$val['Database']!='phpmyadmin'){
						?>
						<option value="<?php echo $val['Database'] ;?>" <?php if($base==$val['Database'])echo "selected"; ?>><?php echo $val['Database'];?></option>
						<?php
					}
				}

			?>
		</select>
		<input type="submit" value="cambiar">
	</form>

	<?php
	}else{
		//echo "post;";
	$base=htmlspecialchars($_POST['baseDatos']);
	$_SESSION['base']=$base;
	header('Location: index.php');
	
	}

}else{
echo "Sin acceso";
}
?>