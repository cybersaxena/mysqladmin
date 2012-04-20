<?php
    if($_POST['create']){
        $db= new MySQLdBO();
        echo $db->connect();
        $user = $_POST['user'];
        $server = $_POST['server'];
        $password = $_POST['password'];
        createUser($user,$server,$password,$db);
        $messagesOK[] = "User $user@$server successfully created";
    }
        $view = "userCreateForm";
        $title = "Crear usuario";
?>