<?php
if($_GET['action']=='logout'){
    session_destroy();
}
include_once("action/login.php");
if(isset($_SESSION['user'])){
    $db = new MySQLdBO();
    $db->connect($_SESSION['user'],$_SESSION['passwd']);
    $m_error = mysql_error();
    if($m_error != null){
        $loggedin = false;
        $messagesError[] = $m_error;
    }else{
        $loggedin = true;
        $_GET['action']=($_GET['action']=='login' || $_GET['action']=='logout') ?null:$_GET['action'];
    }
        
}else
    $loggedin = false;

?>