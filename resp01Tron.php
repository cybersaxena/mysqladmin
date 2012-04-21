<?php
session_start();

$messagesOK = array();
$messagesWarning = array();
$messagesError = array();
$messagesSQL = array();

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
$mysql_username = $_SESSION['user'];
// MySQL password
$mysql_password = $_SESSION['passwd'];
// Database name
//$mysql_database = '';
//
if($_POST['submit'])
 { 
     $db=$_POST['db'];
     include_once("config.inc.php");
    //$output=shell_exec("d:\apps\mysql-5.0.45-win32\bin\mysqldump.exe -u root -proot ".$db); // WIN
    $output=shell_exec("$dumpPath -u root -p ".$db); // MAC
    //
    if(trim($output)==NULL)
     {
         echo "Error creando el backup de la DB: ".$db;
         exit();
     }else{
    header('Content-type: text/plain');
    header('Content-Disposition: attachment; filename="'.$db.'.sql"');
    echo $output;
    
    $prueba=mysql_select_db('whorestore');
    $insertar= mysql_query("INSERT INTO bitacora (nombre,nomDB,tipo) VALUES('$mysql_username','$db','Respaldo')");
    }die();
 }    

$view = "respaldo";
include_once("view/main.php");
?>