<?php
session_start();

$messagesOK = array();
$messagesWarning = array();
$messagesError = array();
$messagesSQL = array();


//include("view/main.php");
    function Connect($host,$user,$passwd)
     {  
      if(!($link=mysql_connect($host,$user,$passwd)))
       {
        echo "Error connecting to DDBB.";
        exit();
       }
       return $link;
     }
$link=Connect('localhost','root','');


$mysql_host = 'localhost';
// MySQL username
$mysql_username = 'root';
// MySQL password
$mysql_password = '';
// Database name
//$mysql_database = '';
//
if($_POST['submit'])
 { 
     $db=$_POST['db'];
    //$output=shell_exec("d:\apps\mysql-5.0.45-win32\bin\mysqldump.exe -u root -proot ".$db); // WIN
    $output=shell_exec("/xamppfiles/bin/mysqldump -u root -p ".$db); // MAC
    //
    if(trim($output)==NULL)
     {
         echo "Error creando el backup de la DB: ".$db;
         include("view/main.php");
         ///exit();
     }else
     {
     
     
     
    header('Content-type: text/plain');
    header('Content-Disposition: attachment; filename="'.$db.'.sql"');
    echo $output;
    //exit();
    
    //record in bitacora
    
      $prueba=mysql_select_db('whorestore');
    $insertar= mysql_query("INSERT INTO bitacora (nombre,nomDB,tipo) VALUES('$mysql_username','$db','Respaldo')");
    }
    //
    
 }    

 
$select="show databases";
$select=mysql_query($select); 
echo 'Selecciona tu base de datos que deseas respaldar <br>';
echo '<br>';


 


?>
<html>
<head>
</head>
<body>
 <form action="" method="post">  
  <select name="db">
  <?php
  while($row = mysql_fetch_row($select))
   {
       ?>
       <option value="<?php echo $row[0]; ?>"><?php echo $row[0]; 
       
       if($row[0]==$base)
        { echo 'hay almenos una base';
            }
       
       
       ?></option>
      
      
       
       <?php
   }    
  ?>
  </select>
  <input type="submit" name="submit" value="Crear backup" />  
 </form>
    <div align="center"><a href="Inicio.html">Regresar Menu Principal</a></div>
</body>
</html>