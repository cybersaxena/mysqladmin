<?php
include_once("db/mysql.php");
include_once("classes/classes.php");
if($action=$_GET['action']){
        $messagesOK = array();
        $messagesWarning = array();
        $messagesError = array();
        $messagesSQL = array();
        include("action/$action.php");
        include("view/main.php");
}
?>