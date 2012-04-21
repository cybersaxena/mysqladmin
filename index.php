<?php
include_once("db/mysql.php");
include_once("classes/classes.php");
//set_error_handler('handleError');
if($action=$_GET['action']){
        $messagesOK = array();
        $messagesWarning = array();
        $messagesError = array();
        $messagesSQL = array();
        try {
        include("action/$action.php");
    } catch (Exception $e) {
        $title = "Error";
        $view = "listUser";
    $messagesError[] =  'Excepci&oacute;n capturada: '.  $e->getMessage(). "\n";
}       
        include("view/main.php");
}


function handleError($errno, $errstr, $errfile, $errline, array $errcontext)
{
    // error was suppressed with the @-operator
    if (0 === error_reporting()) {
        return false;
    }

    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}





?>