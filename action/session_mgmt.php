<?php
include_once("action/login.php");
if(isset($_SESSION['user'])){ 
    $db = new MySQLdBO($_SESSION['user'],$_SESSION['passwd']);
    $db->connect();
    $m_err = mysql_error();
    if($m_error != null){
        $loggedin = false;
    }else{
        $loggedin = true;
        $_GET['action']=($_GET['action']=='login') ?null:$_GET['action'];
    }
        
}else
    $loggedin = false;

?>