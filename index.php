<?php
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);
$messagesOK = array();
$messagesWarning = array();
$messagesError = array();
$messagesSQL = array();
$m_err;
include_once("db/mysql.php");
include_once("classes/classes.php");
include_once("action/session_mgmt.php");


//set_error_handler('handleError');
if(!$loggedin && $_GET['action']!='login'){
    $title = "PHP App on Openshift!!!";
    $view = "login";
}else if($action=$_GET['action']){
    try {
        include("action/$action.php");
    } catch (Exception $e) {
        $title = "Error";
        $view = "index";
        $messagesError[] =  'Excepci&oacute;n capturada: '.  $e->getMessage(). "\n";
    }       
        
}else {
    $view="ind";
}

include("view/main.php");



function handleError($errno, $errstr, $errfile, $errline, array $errcontext)
{
    // error was suppressed with the @-operator
    if (0 === error_reporting()) {
        return false;
    }

    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}





?>
