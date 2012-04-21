<HTML>
<HEAD>
<TITLE>Mostrar Registros.php</TITLE>
</HEAD>
<BODY bgcolor = "000000" text = "FFFFFF">
<h1>Mostrar Contenido de la Bade de Datos</h1>
<br>


<?php
// Conectando, seleccionando la base de datos

$mysql_host = 'localhost';
// MySQL username
$mysql_username = 'root';
// MySQL password
$mysql_password = '';


$link = mysql_connect($mysql_host, $mysql_username, $mysql_password)
    or die('No se pudo conectar: ' . mysql_error());
//echo 'Connected successfully </br>';
mysql_select_db('whorestore') or die('No se pudo seleccionar la base de datos');

// Realizar una consulta MySQL
$query = '	SELECT nombre, fecha, nomDB, tipo
			FROM bitacora';
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());


echo "<table>\n";
        echo "\t\t<td>Usuario &nbsp &nbsp</td>\n";
        echo "\t\t<td>Fecha y Hora &nbsp &nbsp</td>\n";
        echo "\t\t<td>Base de Datos &nbsp &nbsp</td>\n";
        echo "\t\t<td>Accion &nbsp &nbsp</td>\n";
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
    echo "\t<tr>\n";
	
    //foreach ($line as $col_value) {
       	//echo "\t\t<td>$col_value</td>\n";
    //}
	//echo "Nombre:";
	echo "\t\t<td>{$line['nombre']}&nbsp &nbsp</td>\n";
        echo "\t\t<td>{$line['fecha']}&nbsp &nbsp</td>\n";
        echo "\t\t<td>{$line['nomDB']}&nbsp &nbsp</td>\n";
        echo "\t\t<td>{$line['tipo']}&nbsp &nbsp</td>\n";
	
    echo "\t</tr>\n";
}
echo "</table>\n";

// Liberar resultados
mysql_free_result($result);

// Cerrar la conexión
mysql_close($link);
?>

	<div align="center"><a href="Inicio.html">Regresar Menu Principal</a></div>

	</BODY>
	</HTML>
