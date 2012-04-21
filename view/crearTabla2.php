<html>
<head>
<title>
Crear Tabla
</title>
</head>
<body>
<?php include_once 'Columna.php';?>
<form name="generaTabla" action="index.php?action=crearTabla3" method="post">
Nombre de la tabla
<input type='text' size='30' maxlength='30' name='nombreTabla'/><br>
<?php 
$numColumnas= htmlspecialchars($_POST['numcols']);
echo "<input type='hidden' name='numColumnas' value='".$numColumnas."'/>";
for($i=1;$i<=$numColumnas;$i++) formColumnaN($i);?>
<input type="submit" value="Crear Tabla"></input>
</form>

</body>
</html>