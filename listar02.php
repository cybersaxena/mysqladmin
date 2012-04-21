<?

$messagesOK = array();
$messagesWarning = array();
$messagesError = array();
$messagesSQL = array();

include("view/main.php");
@session_start(); 
ob_start();

error_reporting(E_ALL);
ini_set("display_errors", 1);

function Connect($host,$user,$passwd)
     {  
      if(!($link=mysql_connect($host,$user,$passwd)))
       {
        echo "Error connecting to DDBB.";
        exit();
       }
       return $link;
     }

function listar()
{
    echo '<select name="lista">';
    $select="show databases";
    $select=mysql_query($select); 
    
    while($row = mysql_fetch_row($select))
   {
       ?>
       <option onclick='form.submit();' value="<?php echo $row[0]; ?>"><?php echo $row[0]; 
       ?></option>
       <?php
   }        
    echo '</select>';
}



$link=Connect('localhost','root','');
echo '<form method="post" action="'.$_SERVER['PHP_SELF'].'?send">';
echo 'Seleciona la Base de Datos que deseas Borrar';
echo'<br>';
echo'<br>';
listar();
global $nueva;
echo '</form>';
if(isset($_GET['send'])){
    echo "Has seleccionado la base ".$_POST['lista']."  para borrar ";
    $nueva = $_POST['lista'];
    $_SESSION['nombre']=$nueva;
    echo "<FORM ACTION=borrar01.php METHOD=post>";
    echo "<INPUT TYPE=submit NAME=submit  VALUE=Borrar><BR>";
    echo "</FORM>";
    echo "<br>";
    }

 echo '<br> <div align="center"><a href="Inicio.html">Regresar Menu Principal</a></div>';




?> 