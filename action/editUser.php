<?php
    $user = $_REQUEST['user'];
    $server = $_REQUEST['server'];
    if($_POST['edit']){
        
        $password = $_POST['password'];
        changePassword($user,$server,$password,$db);
        $messagesOK[] = "Se hacambiado la contrase&ntilde;a";
    }
        $view = "userEditForm";
        $title = "Editar usuario";
?>