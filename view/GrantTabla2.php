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
		$nivelPermiso=htmlspecialchars($_POST['nivelPermiso']);
		$pDelete=false;
		$pCreate=false;
		$pDrop=false;
		$pGrant=false;
		$pIndex=false;
		$pAlter=false;
		$pCView=false;
		$pSView=false;
		$pTrigger=false;
		$pSelect=false;
		$pInsert=false;
		$pUpdate=false;
		$pReferences=false;
		
		// nivel 3 siempre se hace
		$sqlPermisos ="SELECT mys.table_priv AS privilegios FROM information_schema.tables esq INNER JOIN mysql.tables_priv mys ".
				"on esq.table_schema = mys.db and esq.table_name=mys.table_name WHERE esq.table_type='BASE TABLE' AND mys.User='".$user."'". 
				" AND ( mys.Host='localhost' OR mys.Host='127.0.0.1' or mys.host='%' or mys.host='::1' ) and mys.tables_priv like '%GRANT%' AND mys.Db='".$base."' and mys.table_name ='".$nombreTabla."'";
			$perValor= mysql_query($sqlPermisos,$conexionRoot);
			if($perValor!=null){
			$valor = mysql_fetch_array($perValor);
				if(trim($valor['privilegios'])!="" or $valor['privilegios']!=null){
					$privs = split(",",$valor['privilegios']);
					foreach($privs as $per){
						if(strtoupper($per)=="DELETE") $pDelete =true;
						if(strtoupper($per)=="CREATE") $pCreate =true;
						if(strtoupper($per)=="DROP") $pDrop =true;
						if(strtoupper($per)=="GRANT") $pGrant =true;
						if(strtoupper($per)=="INDEX") $pIndex =true;
						if(strtoupper($per)=="ALTER") $pAlter =true;
						if(strtoupper($per)=="CREATE VIEW") $pCView =true;
						if(strtoupper($per)=="SHOW VIEW") $pSView =true;
						if(strtoupper($per)=="TRIGGER") $pTrigger =true;
						if(strtoupper($per)=="SELECT") $pSelect =true;
						if(strtoupper($per)=="INSERT") $pInsert =true;
						if(strtoupper($per)=="UPDATE") $pUpdate =true;
						if(strtoupper($per)=="REFERENCES") $pReferences =true;
					}
				}
			}
			if($nivelPermiso<=2){
			
				$sqlPermisos ="SELECT *  FROM mysql.db WHERE User='".$user."' AND ( Host='localhost' OR Host='127.0.0.1' or host='%' or host='::1' ) and Grant_priv='Y' AND Db='".$base."'" ;
				$perValor= mysql_query($sqlPermisos,$conexionRoot);
				if($perValor!=null){
				$valor = mysql_fetch_array($perValor);
					if(isset($valor) && $valor!=null){
						if($valor['Delete_priv']=="Y") $pDelete =true;
						if($valor['Create_priv']=="Y") $pCreate =true;
						if($valor['Drop_priv']=="Y") $pDrop =true;
						if($valor['Grant_priv']=="Y") $pGrant =true;
						if($valor['Index_priv']=="Y") $pIndex =true;
						if($valor['Alter_priv']=="Y") $pAlter =true;
						if($valor['Create_view_priv']=="Y") $pCView =true;
						if($valor['Show_view_priv']=="Y") $pSView =true;
						if($valor['Trigger_priv']=="Y") $pTrigger =true;
						if($valor['Select_priv']=="Y") $pSelect =true;
						if($valor['Insert_priv']=="Y") $pInsert =true;
						if($valor['Update_priv']=="Y") $pUpdate =true;
						if($valor['References_priv']=="Y") $pReferences =true;
					
					}
				}
			
			}
			if($nivelPermiso==1){
			
			$sqlPermisos ="SELECT * FROM mysql.user WHERE User='".$user."' AND ( Host='localhost' OR Host='127.0.0.1' or host='%' or host='::1' ) and Grant_priv='Y' LIMIT 0,1;";
				$perValor= mysql_query($sqlPermisos,$conexionRoot);
				$valor = mysql_fetch_array($perValor);
				if(isset($valor) && $valor!=null){
					if($valor['Delete_priv']=="Y") $pDelete =true;
					if($valor['Create_priv']=="Y") $pCreate =true;
					if($valor['Drop_priv']=="Y") $pDrop =true;
					if($valor['Grant_priv']=="Y") $pGrant =true;
					if($valor['Index_priv']=="Y") $pIndex =true;
					if($valor['Alter_priv']=="Y") $pAlter =true;
					if($valor['Create_view_priv']=="Y") $pCView =true;
					if($valor['Show_view_priv']=="Y") $pSView =true;
					if($valor['Trigger_priv']=="Y") $pTrigger =true;
					if($valor['Select_priv']=="Y") $pSelect =true;
					if($valor['Insert_priv']=="Y") $pInsert =true;
					if($valor['Update_priv']=="Y") $pUpdate =true;
					if($valor['References_priv']=="Y") $pReferences =true;
				}
			}
			
			
	
		if($pDelete || $pCreate || $pDrop || $pGrant || $pIndex || $pAlter || $pCView || $pSView || $pTrigger || $pSelect || $pInsert || $pUpdate || $pReferences )
		{
			?>
			<html>
			<head>
			<title>
			Permiso a Tablas
			</title>
			</head>
			<body>
			<form name="GrantTabla" action="index.php?action=GrantTabla3" method="post">
			<input type="hidden" name="nombreTabla" value="<?php echo $nombreTabla;?>"></input>
			<br>
			Seleccione el usuario a dar permisos:
			<br>
			<select name="usuarioP">
			<?php 
				$sqlUsers=" Select Host,User from mysql.user where user<>'root' and user <>'".$user."'" ;
				$users= mysql_query($sqlUsers,$conexionRoot);
			
				while($val = mysql_fetch_array($users)){
					echo "<option name='opUsuarioP' value=\"'".$val['User']."'@'".$val['Host']."'\">".$val['User']."@".$val['Host']."</option>";
				}
			?>
			</select>
			<br>
			Seleccione los permisos que quiere otorgar:
			<br>
			<?php 
			if($pDelete){ echo "<input type='radio' name='p1' value='DELETE'>Borrar</input>";}
			if($pCreate){ echo "<input type='radio' name='p2' value='CREATE'>Crear</input>";}
			if($pDrop){ echo "<input type='radio' name='p3' value='DROP'>Tirar</input>";}
			if($pGrant){ echo "<input type='radio' name='p4' value='GRANT'>Dar Permiso</input>";}
			echo "<br>";
			if($pIndex){ echo "<input type='radio' name='p5' value='INDEX'>Indice</input>";}
			if($pAlter){ echo "<input type='radio' name='p6' value='ALTER'>Alterar</input>";}
			if($pCView){ echo "<input type='radio' name='p7' value='CREATE VIEW'>Crear Vista</input>";}
			if($pSView){ echo "<input type='radio' name='p8' value='SHOW VIEW'>Mostrar Vista</input>";}
			echo "<br>";
			if($pTrigger){ echo "<input type='radio' name='p9' value='TRIGGER'>Trigger</input>";}
			if($pSelect){ echo "<input type='radio' name='p10' value='SELECT'>Seleccionar</input>";}
			if($pInsert){ echo "<input type='radio' name='p11' value='INSERT'>Insertar</input>";}
			if($pUpdate){ echo "<input type='radio' name='p12' value='UPDATE'>Actualizar</input>";}
			echo "<br>";
			if($pReferences){ echo "<input type='radio' name='p13' value='REFERENCES'>Referenciar</input>";}
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
		echo "Datos Insuficientes";
	}
}else{
	echo "Sin acceso";
}
?>
